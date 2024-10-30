<?php

class CursosWob_Public {
	
	private $version;

	public function __construct( $version ) {
		$this->version = $version;
	}
        
        public function enqueue_scripts(){
            wp_enqueue_style(
                'font-awesome.min', 
                plugin_dir_url(__FILE__).'css/font-awesome.min.css',
                array(),
                $this->version,
                FALSE
            );
            wp_enqueue_style(
                'cursoswob', 
                plugin_dir_url(__FILE__).'css/cursoswob.css',
                array(),
                $this->version,
                FALSE
            );
            wp_enqueue_style(
                'videojscss', 
                plugin_dir_url(__FILE__).'css/video-js.css',
                array(),
                $this->version,
                FALSE
            );
            wp_enqueue_script(
                'videojshead', 
                plugin_dir_url(__FILE__).'js/videojs-ie8.min.js',
                array(),
                $this->version,
                FALSE
            );
            wp_enqueue_script(
                'videojsfooter', 
                plugin_dir_url(__FILE__).'js/video.js',
                array(),
                $this->version,
                FALSE
            );
            
            /*wp_enqueue_script(
                'videojsyoutube', 
                plugin_dir_url(__FILE__).'js/youtube-video-min.js',
                array(),
                $this->version,
                FALSE
            );*/
            
            
        }

        public function cursoswob_cambiar_titulo_clase( $title ){
            
            $post_type = get_post_type(get_the_ID());
            
            if("clases" == $post_type){
                if(is_single(get_the_ID())){
                    $post_clase = get_post(get_the_ID());
                    $title_clase = $post_clase->post_title;
                    $id_curso = get_post_meta(get_the_ID(), 'cursoswob_id_curso', true );

                    $post_curso = get_post($id_curso);

                    $post_title = $post_curso->post_title;

                    return $post_title.' // '. $title_clase;
                }else{
                    return $title;
                }                
            }else{
                return $title;
            }
 
        }


        public function cursoswob_mostrar_clases_public( $content ) {
            
            $post = get_post();
            $post_type = get_post_type($post->ID);
            
            if("cursos" == $post_type){
                $args = array (
                    'orderby'       => 'ID',
                    'order'         => 'ASC',
                    'post_type'     => 'clases',
                    'meta_key'      => 'cursoswob_id_curso',
                    'meta_value'    => $post->ID,
                    'meta_compare'  => '=='
                );
                $query = new WP_Query( $args );

                $values = get_post_custom($post->ID);

                require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/cursoswob-display-curso-public.php';

            }elseif("clases" == $post_type){

                $id_clase = get_the_ID();
                $id_curso = get_post_meta($id_clase, 'cursoswob_id_curso', true );
                
                $detecta_usuario = new CursosWob_Woocommerce();
                $encontrado = $detecta_usuario->detectar_si_el_usuario_tiene_acceso_al_curso($id_curso);
                
                if($encontrado == 1){
                    
                    $user = wp_get_current_user();
                    $id_usuario = $user->data->ID;
                    $usuarios_vistas = "";
                    
                    $usuarios_que_han_visto_la_clase = get_post_meta($post->ID, 'cursoswob_usuarios_que_han_visto_la_clase', true );
                    if (!empty($usuarios_que_han_visto_la_clase)) {
                        array_push($usuarios_que_han_visto_la_clase, $id_usuario);
                        
                        update_post_meta($post->ID, 'cursoswob_usuarios_que_han_visto_la_clase', $usuarios_que_han_visto_la_clase);
                    }else{
                        $usuarios_que_han_visto_la_clase = array();
                        array_push($usuarios_que_han_visto_la_clase, $id_usuario);
                        
                        add_post_meta($post->ID, 'cursoswob_usuarios_que_han_visto_la_clase', $usuarios_que_han_visto_la_clase, true );
                    }
                    
                    $values = get_post_custom($post->ID);
                    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/cursoswob-display-clase-public.php';
                }else{
                    echo 'no tienes acceso a la clase';
                }
                
            }else{
                return $content;
            }

	}
        
        public function cursoswob_ocultar_info_post(){
            $post = get_post();
            $post_type = get_post_type($post->ID);
            if("clases" == $post_type || "cursos" == $post_type){
                $ocultar .="<style> .post-meta{ display:none !important; } </style>";
                echo $ocultar;
            }
        }
        
        
        /*********** CREACIÓN DE LA PÁGINA PÚBLICA QUE LISTARÁ TODOS LOS CURSOS ************/
        
        public function cursoswob_crear_pagina_cursos(){
            
            global $cursoswob_pagina_publica_listado;
            /*
             * buscamos si la página ya está creada
             */
            $cursoswob_existe_la_pagina = get_option('cursoswob_pagina_publica_listado');
            if(!$cursoswob_existe_la_pagina){                
                $pagina_listado = array(
                    'post_title'    => __('Cursos', 'cursoswob'),
                    'post_content'  => '[cursoswob_listado_cursos][/cursoswob_listado_cursos]',
                    'post_status'   => 'publish',
                    'post_name'     => 'listado-de-cursos',
                    'post_type'     => 'page',
                    'post_author'   => 1,
                    'post_category' => array( 8,39 )
                );

                // Insert the post into the database
                $cursoswob_id_pagina_listado = wp_insert_post( $pagina_listado );
                
                if($cursoswob_id_pagina_listado){
                    update_option( 'cursoswob_pagina_publica_listado', $cursoswob_id_pagina_listado );
                }
            }
        }
        
        
        /******* SHORTCODES ********/
        function cursoswob_shortcode_listado_cursos(){
            ob_start();
            
            $args = array (
                'orderby'       => 'ID',
                'order'         => 'ASC',
                'post_type'     => 'cursos',
                'post_status'   => 'publish',
            );
            $lista_de_cursos = new WP_Query( $args );

            require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/cursoswob-display-lista-cursos-public.php';

            $content = ob_get_clean();
            
            return $content;
        }
        
        

}