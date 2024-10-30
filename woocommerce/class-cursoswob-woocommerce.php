<?php

class CursosWob_Woocommerce{
    
    protected $version;
    
    public function __construct($version){
        $this->version = $version;
    }
    /*
     * Creamos el menu de opciones para la extension WooCommerce 
     */
    public function cursoswob_pagina_de_opciones_woocommerce(){
        add_submenu_page(
            'edit.php?post_type=cursos',
            'Cursos Wob 1.0 with Woocommerce',
            __('Configuración', 'cursoswob'),
            'manage_options',
            'cursoswob-opciones-woocommerce',
            array($this, 'cursoswob_modificar_opciones_woocommerce')
        );
    }
    
    /*
     * Funcion para la página de opciones de la extensión para WooCommerce
     */
    public function cursoswob_modificar_opciones_woocommerce(){
    
        if(!current_user_can('manage_options')){
            wp_die('You do not have sufficient permissions to access this page.');
        }
        global $cursoswob_options_woocommerce;
        $id_number = 1;
        /*
         * Guardamos las claves de la API generadas por el cliente 
         */
        if($_POST['boton_submit'] == 'Guardar Configuración'){
            $cursoswob_options_woocommerce['cursoswob_woocommerce_status'] = 'active';
            $key_client = esc_html($_POST['client_key']);
            $key_client_secret = esc_html($_POST['client_secret_key']);
            
            $cursoswob_options_woocommerce['cursoswob_woocommerce_key_client'] = $key_client;
            $cursoswob_options_woocommerce['cursoswob_woocommerce_key_client_secret'] = $key_client_secret;
            $cursoswob_options_woocommerce['cursoswob_woocommerce_last_updated'] = time();
            
            update_option( 'cursoswob_woocommerce_configuracion', $cursoswob_options_woocommerce );
        }
    
        $cursoswob_options_woocommerce = get_option( 'cursoswob_woocommerce_configuracion' );
        
        $cursoswob_key_client = $cursoswob_options_woocommerce['cursoswob_woocommerce_key_client'];
        $cursoswob_key_client_secret = $cursoswob_options_woocommerce['cursoswob_woocommerce_key_client_secret'];
        
        if($cursoswob_key_client != ''){
            /*
             * Libreria PHP de la API de Woocommerce
             */
            require_once( 'lib/woocommerce-api.php' );
                        
            $options_wo = array(
                'debug'           => true,
                'return_as_array' => false,
                'validate_url'    => false,
                'timeout'         => 30,
                'ssl_verify'      => false,
            );
            /*
             * Conectamos a la API de Woocommerce
             */
            $url = home_url();
            $client = new WC_API_Client( $url, $cursoswob_key_client, $cursoswob_key_client_secret, $options_wo );
            
            /*
             * Al conectar buscamos el listado de cursos publicados
             */
            $args = array (
                'orderby'       => 'ID',
                'order'         => 'ASC',
                'post_type'     => 'cursos',
                'post_status'   => 'publish',
                'showposts'     => $id_number,
            );
            $query = new WP_Query( $args );
        }
        
        /*
         * Creamos el producto a partir de un curso
         */
        if($_POST['boton_submit'] == 'Crear Producto'){
            
            if($_POST['cursoswob_id_curso'] != ''){
                /*
                 * Recogemos datos del curso
                 */
                $id_curso = $_POST['cursoswob_id_curso'];
                $args = array (
                    'post_type' => 'cursos',
                    'p'         => $id_curso,
                );
                $post_info = new WP_Query( $args );
                $curso = $post_info->post;
                
                $thumb = get_the_post_thumbnail_url($curso->ID);
                
                /*
                * creacion del array para crear el producto
                */                
                if($thumb){
                    $producto = array( 
                        'title'         => $curso->post_title, 
                        'type'          => 'simple', 
                        'regular_price' => $_POST['cursoswob_precio'], 
                        'description'   => $curso->post_content,
                        'virtual'       => true,
                        'images' => [
                            [
                                'src' => $thumb,
                                'position' => 0
                            ],
                        ]

                    );
                }else{
                    $producto = array( 
                        'title'         => $curso->post_title, 
                        'type'          => 'simple', 
                        'regular_price' => $_POST['cursoswob_precio'], 
                        'description'   => $curso->post_content,
                        'virtual'       => true,
                    );
                }
                
                /*
                 * Llamamos al método de la libreria PHP de la API para crear el producto
                 */
                $producto = $client->products->create($producto);
                
                /*
                 * Si el producto esta creado correctamente le introducimos el post meta para vincularlo al curso
                 */
                if($producto){
                    $pro = $producto->product;
                    
                    //producto vs. curso
                    update_post_meta($pro->id, 'cursoswob_id_curso', $id_curso);
                    //curso vs. producto
                    update_post_meta($id_curso, 'cursoswob_id_producto', $pro->id);
                    update_post_meta($id_curso, 'cursoswob_url_producto', $pro->permalink);
                }
            }
            
        }
        
        require_once plugin_dir_path(__FILE__).'partials/cursoswob-woocommerce-pagina-de-opciones.php';
    }    

    public function cursoswob_nuevo_pedido_finalizado_correctamente($order_get_id){
        
        $cursoswob_options_woocommerce = get_option( 'cursoswob_woocommerce_configuracion' );
        
        $cursoswob_key_client = $cursoswob_options_woocommerce['cursoswob_woocommerce_key_client'];
        $cursoswob_key_client_secret = $cursoswob_options_woocommerce['cursoswob_woocommerce_key_client_secret'];
        
        if($cursoswob_key_client != ''){
            /*
             * Libreria PHP de la API de Woocommerce
             */
            require_once( 'lib/woocommerce-api.php' );
                        
            $options_wo = array(
                'debug'           => true,
                'return_as_array' => false,
                'validate_url'    => false,
                'timeout'         => 30,
                'ssl_verify'      => false,
            );
            /*
             * Conectamos a la API de Woocommerce
             */
            $url = home_url();
            $client = new WC_API_Client( $url, $cursoswob_key_client, $cursoswob_key_client_secret, $options_wo );
            
            /*
             * Recogemos el pedido que se acaba de realizar
             */
            $pedido = $client->orders->get($order_get_id);
            $usuario = $pedido->order->customer;
            $productos = $pedido->order->line_items;

            foreach ($productos as $producto):
                $id_curso = get_post_meta( $producto->product_id, 'cursoswob_id_curso', true );
                if($id_curso != ''){
                    $permitir_acceso = array(
                        'id_usuario'    => $usuario->id,
                        'email'         => $usuario->email,
                        'usuario'       => $usuario->username,
                        'nombre'        => $usuario->first_name,
                        'apellidos'     => $usuario->last_name,
                    );
                    $usuarios_permitidos = get_post_meta($id_curso, 'cursoswob_usuarios_permitidos', true );
                    if (!empty($usuarios_permitidos)) {
                        array_push($usuarios_permitidos, $permitir_acceso);
                        
                        update_post_meta($id_curso, 'cursoswob_usuarios_permitidos', $usuarios_permitidos);
                    }else{
                        $usuarios_permitidos = array();
                        array_push($usuarios_permitidos, $permitir_acceso);
                        
                        add_post_meta($id_curso, 'cursoswob_usuarios_permitidos', $usuarios_permitidos, true );
                    }
                }
            endforeach;
        }
    }
    
    
    
    //Endpoint personalizado en My account
    function cursoswob_custom_wc_end_point() {
        if(class_exists('WooCommerce')){
            add_rewrite_endpoint( 'listado-de-mis-cursos', EP_ROOT | EP_PAGES );
        }
    }

    function cursoswob_custom_endpoint_query_vars( $vars ) {
        $vars[] = 'listado-de-mis-cursos';
        return $vars;
    }


    function cursoswob_ac_custom_flush_rewrite_rules() {
        flush_rewrite_rules();
    }

    function cursoswob_custom_endpoint_acct_menu_item( $items ) {
        $logout = $items['customer-logout'];
        unset( $items['customer-logout'] );
        $items['listado-de-mis-cursos'] = __( 'Mis cursos', 'woocommerce' );
        $items['customer-logout'] = $logout;
        return $items;
    }

    function cursoswob_fetch_content_custom_endpoint() {
        global $post;
        
        $cursoswob_existe_la_pagina = get_option('cursoswob_pagina_publica_mis_cursos');
        $id = $cursoswob_existe_la_pagina;
        ob_start();
        $output = apply_filters('the_content', get_post_field('post_content', $id));
        $output .= ob_get_contents();
        ob_end_clean();
        
        echo $output;
    }
    
    
    /*********** CREACIÓN DE LA PÁGINA PÚBLICA QUE LISTARÁ TODOS LOS CURSOS ************/
        
        public function cursoswob_crear_pagina_mis_cursos(){
            
            global $cursoswob_pagina_publica_mis_cursos;
            /*
             * buscamos si la página ya está creada
             */
            $cursoswob_existe_la_pagina = get_option('cursoswob_pagina_publica_mis_cursos');
            if(!$cursoswob_existe_la_pagina){                
                $pagina_listado = array(
                    'post_title'    => __('Mis Cursos', 'cursoswob'),
                    'post_content'  => '[cursoswob_listado_mis_cursos][/cursoswob_listado_mis_cursos]',
                    'post_status'   => 'publish',
                    'post_name'     => 'listado-de-mis-cursos',
                    'post_type'     => 'page',
                    'post_author'   => 1,
                    'post_category' => array( 8,39 )
                );

                // Insert the post into the database
                $cursoswob_id_pagina_listado = wp_insert_post( $pagina_listado );
                
                if($cursoswob_id_pagina_listado){
                    update_option( 'cursoswob_pagina_publica_mis_cursos', $cursoswob_id_pagina_listado );
                }
            }
        }
        
        
        /******* SHORTCODES ********/
        function cursoswob_shortcode_listado_mis_cursos(){
            ob_start();
            
            $args = array (
                'orderby'       => 'ID',
                'order'         => 'ASC',
                'post_type'     => 'cursos',
                'post_status'   => 'publish',
            );
            
            $lista_de_cursos = new WP_Query( $args );

            require_once plugin_dir_path( dirname( __FILE__ ) ) . 'woocommerce/partials/cursoswob-display-lista-cursos-public.php';

            $content = ob_get_clean();
            
            return $content;
        }
        
        
        
        public function detectar_si_el_usuario_tiene_acceso_al_curso($id_curso = NULL){
            if($id_curso){
                $usuarios_permitidos = get_post_meta($id_curso, 'cursoswob_usuarios_permitidos', true );
                if(is_user_logged_in()){
                    $user = wp_get_current_user();

                    $tipo_usuario = $user->roles[0];

                    if($tipo_usuario == 'administrator'){
                        $encontrado = 1;
                    }else{
                        $id_usuario = $user->data->ID;
                        $encontrado = 0;
                        if($usuarios_permitidos){
                            foreach ($usuarios_permitidos as $usuario):
                                if($usuario['id_usuario'] == $id_usuario){
                                    $encontrado = 1;
                                }
                            endforeach;
                        }
                    }
                }else{
                    $encontrado = 0;
                }
            }else{
                $encontrado = 0;
            }
            return $encontrado;
        }
    
    
    
}