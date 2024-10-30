<?php

class CursosWob_Admin{
    
    protected $version;
    
    public function __construct($version){
        $this->version = $version;
        
    }
    
    
    
    
    
    /*
     * Creando el menu de opciones de configuración del plugin
     */    
    public function cursoswob_pagina_de_opciones(){
        global $cursoswob_options;
        
        $cursoswob_opciones = get_option( 'cursoswob_configuracion' );
        
        if(!$cursoswob_opciones){
            $cursoswob_options['cursoswob_version_type'] = 'Premium';
            $cursoswob_options['cursoswob_last_updated'] = time();
            $cursoswob_options['cursoswob_activado'] = 1;

            update_option( 'cursoswob_configuracion', $cursoswob_options );
        }
        
        add_submenu_page(
            'edit.php?post_type=cursos',
            'Cursos Wob 1.0',
            __('Ayuda', 'cursoswob'),
            'manage_options',
            'cursoswob-configuracion-woocommerce',
            array($this, 'cursoswob_configuracion_woocommerce')
        );
        
        add_submenu_page(
            null,
            'Cursos Wob 1.0',
            __('Configuración Cursos Wob', 'cursoswob'),
            'manage_options',
            'cursoswob-configuracion-cursoswob',
            array($this, 'cursoswob_configuracion_cursoswob')
        );
        
        add_submenu_page(
            null,
            'Cursos Wob 1.0',
            __('Crear un curso', 'cursoswob'),
            'manage_options',
            'cursoswob-crear-un-curso',
            array($this, 'cursoswob_crear_un_curso')
        );
        add_submenu_page(
            null,
            'Cursos Wob 1.0',
            __('Vincular los cursos con la tienda', 'cursoswob'),
            'manage_options',
            'cursoswob-vincular-los-cursos-con-la-tienda',
            array($this, 'cursoswob_vincular_curso_con_tienda')
        );
        
    }
    
    /*
     * creando la página de opciones de configuración del plugin
     */
    public function cursoswob_configuracion_woocommerce(){
    
        if(!current_user_can('manage_options')){
            wp_die('You do not have sufficient permissions to access this page.');
        }
        
        //$cursoswob_options = get_option( 'cursoswob_configuracion' );

        
        require_once plugin_dir_path(__FILE__).'partials/cursoswob-pagina-de-configuracion-woocommerce.php';
    }
    
    /*
     * creando la página de opciones de configuración de Cursoswob
     */
    public function cursoswob_configuracion_cursoswob(){
    
        if(!current_user_can('manage_options')){
            wp_die('You do not have sufficient permissions to access this page.');
        }
        
        require_once plugin_dir_path(__FILE__).'partials/cursoswob-pagina-de-configuracion-cursoswob.php';
    }
    
    /*
     * Ayuda para crear un curso
     */
    public function cursoswob_crear_un_curso(){
    
        if(!current_user_can('manage_options')){
            wp_die('You do not have sufficient permissions to access this page.');
        }
        
        require_once plugin_dir_path(__FILE__).'partials/cursoswob-pagina-de-ayuda-crear-un-curso.php';
    }
    /*
     * Ayuda para crear un curso
     */
    public function cursoswob_vincular_curso_con_tienda(){
    
        if(!current_user_can('manage_options')){
            wp_die('You do not have sufficient permissions to access this page.');
        }
        
        require_once plugin_dir_path(__FILE__).'partials/cursoswob-pagina-de-ayuda-vincular-los-cursos-con-la-tienda.php';
    }
   
    
    
    
    /*
     * Cargando estilos css de la zona de administracions
     */
    public function enqueue_styles(){
        wp_enqueue_style(
            'coursewob-admin', 
            plugin_dir_url(__FILE__).'css/cursoswob-admin.css',
            array(),
            $this->version,
            FALSE
        );
        wp_enqueue_script(
            'cursoswobjs', 
            plugin_dir_url(__FILE__).'js/cursoswob.js',
            array(),
            $this->version,
            TRUE
        );
        /*wp_enqueue_script(
            'cursoswotablednd', 
            plugin_dir_url(__FILE__).'js/tablednd/jquery.tablednd.0.9.rc1.js',
            array(),
            $this->version,
            TRUE
        );*/
        
    }
    /*
     * Creando los tipos de post de cursos y clases
     */
    public function cursoswob_custom_post_types(){
        
        $labels = array(
            'name' => _x( 'Cursos', 'post type general name' ),
            'singular_name' => _x( 'Curso', 'post type singular name' ),
            'add_new' => _x( 'Añadir nuevo', 'curso' ),
            'add_new_item' => __( 'Añadir nuevo Curso' ),
            'edit_item' => __( 'Editar Curso' ),
            'new_item' => __( 'Nuevo Curso' ),
            'view_item' => __( 'Ver Curso' ),
            'search_items' => __( 'Buscar Cursos' ),
            'menu_name' => __( 'Cursos Wob' ),
            'not_found' =>  __( 'No se han encontrado Cursos' ),
            'not_found_in_trash' => __( 'No se han encontrado Cursos en la papelera' ),
            'parent_item_colon' => ''
        );
        
        $args = array( 
            'labels' => $labels,
            'public' => true,
            'exclude_from_search' => false,
            'has_archive' => true,
            'show_ui' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'hierarchical' => true,
            'menu_position' => null,
            'show_in_admin_bar' => true,
            'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
        );
        
        register_post_type('cursos', $args);
        
        $labels = array(
            'name' => _x( 'Clases', 'post type general name' ),
            'singular_name' => _x( 'Clase', 'post type singular name' ),
            'add_new' => _x( 'Añadir nueva', 'clase' ),
            'add_new_item' => __( 'Añadir nueva Clase' ),
            'edit_item' => __( 'Editar Clase' ),
            'new_item' => __( 'Nueva Clase' ),
            'view_item' => __( 'Ver Clase' ),
            'search_items' => __( 'Buscar Clases' ),
            'not_found' =>  __( 'No se han encontrado Clases' ),
            'not_found_in_trash' => __( 'No se han encontrado Clases en la papelera' ),
            'parent_item_colon' => ''
        );
        
        $args = array( 'labels' => $labels,
            'public' => true,
            'exclude_from_search' => false,
            'has_archive' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'hierarchical' => true,
            'menu_position' => null,
            'show_in_menu' => false,
            'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
        );
        
        register_post_type('clases', $args);
        
    }
    
    
         
    /*
     * creanco taxonomias del tipo de post cursoss
     */
    public function cursoswob_create_curso_taxonomies() {
        $labels = array(
                'name' => _x( 'Formadores', 'taxonomy general name' ),
                'singular_name' => _x( 'Formador', 'taxonomy singular name' ),
                'search_items' =>  __( 'Buscar Formadores' ),
                'popular_items' => __( 'Formadores populares' ),
                'all_items' => __( 'Todos los Formadores' ),
                'parent_item' => null,
                'parent_item_colon' => null,
                'edit_item' => __( 'Editar Formador' ),
                'update_item' => __( 'Actualizar Formador' ),
                'add_new_item' => __( 'Añadir nuevo Formador' ),
                'new_item_name' => __( 'Nombre del nuevo Formador' ),
                'separate_items_with_commas' => __( 'Separar Formadores por comas' ),
                'add_or_remove_items' => __( 'Añadir o eliminar Formadores' ),
                'choose_from_most_used' => __( 'Escoger entre los Formadores más utilizados' )
        );

        register_taxonomy( 'formador', 'cursos', array(
                'hierarchical' => true, //en false como las etiquetas
                'labels' => $labels, 
                'show_ui' => true,
                'query_var' => true,
                'rewrite' => array( 'slug' => 'formador' ),
        ));
    }
    
    
    /*
     * Crando las diferentes metaboxex para cada tipo de post
     */
    public function cursoswob_add_meta_boxes(){
        
        $post = get_post();
        $post_type = $post->post_type;
        
        if($post_type == 'cursos'){
            add_meta_box(
                'cursoswob-video-del-curso',
                'Video público del Curso',
                array($this, 'render_video_del_curso'),
                'cursos',
                'normal',
                'core'
            );
            add_meta_box(
                'cursoswob-clases-del-curso-admin',
                'Clases del Curso',
                array($this, 'render_clases_del_curso'),
                'cursos',
                'normal',
                'core'
            );
        }
        
        if($post_type == 'clases'){
            add_meta_box(
                'cursoswob-opciones-de-la-clase',
                'CursosWob Opciones de la Clase',
                array($this, 'cursoswob_opciones_de_la_clase'),
                'clases',
                'normal',
                'core'
            );
        }
        
    }
    
    
    
    /*
     * Aqui tenemos las diferentes funciones para el renderizado de los metaboxes     * 
     */
    
    //metabox para el video publico del curso
    public function render_video_del_curso(){
        $values = get_post_custom($post->ID);
        require_once plugin_dir_path(__FILE__).'partials/cursoswob-video-del-curso.php';
    }
    
    //metabox para mostrar el listado de las clases que pertenecen al curso
    public function render_clases_del_curso(){
        $post = get_post();
        $args = array (
            'orderby'       => 'ID',
            'order'         => 'ASC',
            'post_type'     => 'clases',
            'meta_key'      => 'cursoswob_id_curso',
            'meta_value'    => $post->ID,
            'meta_compare'  => '=='
        );
        $query = new WP_Query( $args );
        require_once plugin_dir_path(__FILE__).'partials/cursoswob-clases-del-curso.php';
        
    }
    
    
    //metabox para el video de la clase
    public function cursoswob_opciones_de_la_clase(){
        $values = get_post_custom($post->ID);
        require_once plugin_dir_path(__FILE__).'partials/cursoswob-video-de-la-clase.php';
        require_once plugin_dir_path(__FILE__).'partials/cursoswob-archivos-de-la-clase.php';
    }
    
    
    /*
     * Funcion para guardar los metadatos de cada tipo de post
     */
    public function cursoswob_add_post_meta_id($post_id){
        
        if (defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
            return;
	}
        if (!current_user_can('edit_post', $post_id)){
            return;
        }
        
        $post_type = get_post_type($post_id);
        
        
        /************* META DATOS CURSO **************/
        if("cursos" == $post_type){
            $video_mp4 = sanitize_text_field($_POST["cursoswob_mp4_publico"]);
            $video_vimeo = sanitize_text_field($_POST["cursoswob_vimeo_publico"]);
            $video_youtube = sanitize_text_field($_POST["cursoswob_youtube_publico"]);
            update_post_meta($post_id, 'cursoswob_mp4_publico', $video_mp4);
            update_post_meta($post_id, 'cursoswob_youtube_publico', $video_youtube);
            update_post_meta($post_id, 'cursoswob_vimeo_publico', $video_vimeo);
        }
            
        /************* META DATOS CLASE **************/
        if("clases" == $post_type){
            $id_curso = get_post_meta(get_the_ID(), 'cursoswob_id_curso', true );
            
            if($id_curso == ''){
                $post_id_curso = $_POST['cursoswob_id_curso'];
                update_post_meta ( $post_id, 'cursoswob_id_curso', $post_id_curso);
            }
            
            $cursoswob_archivo_de_la_clase = $_POST['cursoswob_archivo_de_la_clase'];
            $cursoswob_video_de_la_clase = $_POST['cursoswob_video_de_la_clase'];
            $cursoswob_video_de_la_clase_youtube = $_POST['cursoswob_video_de_la_clase_youtube'];
            $cursoswob_video_de_la_clase_vimeo = $_POST['cursoswob_video_de_la_clase_vimeo'];
            
            update_post_meta ( $post_id, 'cursoswob_archivo_de_la_clase', $cursoswob_archivo_de_la_clase);
            update_post_meta ( $post_id, 'cursoswob_video_de_la_clase', $cursoswob_video_de_la_clase);
            update_post_meta ( $post_id, 'cursoswob_video_de_la_clase_youtube', $cursoswob_video_de_la_clase_youtube);
            update_post_meta ( $post_id, 'cursoswob_video_de_la_clase_vimeo', $cursoswob_video_de_la_clase_vimeo);
        }

    }
    
    
    

}
