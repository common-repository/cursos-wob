<?php
     /**
      * Clase principal del plugin: inclusión e inicializacion del resto del código
      * @since 1.0.0
      */   
class CursosWob{

    protected $loader;
    
    protected $plugin_slug;
    
    protected $version;

    public function __construct() {
        $this->plugin_slug = 'cursoswob';
        $this->version = '1.0.0';
        
        $this->load_dependences();
        $this->define_admin_hooks();
        $this->define_public_hooks();
        $this->define_cursoswob_woocommerce_hooks();
    }
    
    public function load_dependences(){
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-cursoswob-admin.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-cursoswob-public.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'woocommerce/class-cursoswob-woocommerce.php';
        
        require_once plugin_dir_path( __FILE__ ) . 'class-cursoswob-loader.php';
        $this->loader = new CursosWob_Loader();
    }
    
    public function define_admin_hooks(){
        $admin = new CursosWob_Admin($this->get_version());
        $this->loader->add_action('admin_enqueue_scripts', $admin, 'enqueue_styles');
        $this->loader->add_action('init', $admin, 'cursoswob_custom_post_types');
        $this->loader->add_action('init', $admin, 'cursoswob_create_curso_taxonomies');
        $this->loader->add_action('admin_menu', $admin, 'cursoswob_pagina_de_opciones' );
        $this->loader->add_action('add_meta_boxes', $admin, 'cursoswob_add_meta_boxes');
        $this->loader->add_action('save_post', $admin, 'cursoswob_add_post_meta_id');
    }
   
    private function define_public_hooks(){
        $public = new CursosWob_Public($this->get_version());
        $this->loader->add_action('init', $public, 'enqueue_scripts');
        $this->loader->add_action('init', $public, 'cursoswob_crear_pagina_cursos');
        $this->loader->add_action('the_content', $public, 'cursoswob_mostrar_clases_public');
        $this->loader->add_action('wp_head', $public, 'cursoswob_ocultar_info_post');
        $this->loader->add_shortcode('cursoswob_listado_cursos', $public, 'cursoswob_shortcode_listado_cursos');
    }
    
    private function define_cursoswob_woocommerce_hooks(){
        $cursoswob_woocommerce = new CursosWob_Woocommerce($this->get_version());
        $this->loader->add_action('admin_menu', $cursoswob_woocommerce, 'cursoswob_pagina_de_opciones_woocommerce');
        $this->loader->add_action('woocommerce_thankyou', $cursoswob_woocommerce, 'cursoswob_nuevo_pedido_finalizado_correctamente');
        $this->loader->add_action('init', $cursoswob_woocommerce, 'cursoswob_crear_pagina_mis_cursos');
        $this->loader->add_shortcode('cursoswob_listado_mis_cursos', $cursoswob_woocommerce, 'cursoswob_shortcode_listado_mis_cursos');
        $this->loader->add_action('init', $cursoswob_woocommerce, 'cursoswob_custom_wc_end_point' );
        $this->loader->add_filter('query_vars', $cursoswob_woocommerce, 'cursoswob_custom_endpoint_query_vars', 0 );
        $this->loader->add_action('after_switch_theme', $cursoswob_woocommerce, 'cursoswob_ac_custom_flush_rewrite_rules' );
        $this->loader->add_filter('woocommerce_account_menu_items', $cursoswob_woocommerce, 'cursoswob_custom_endpoint_acct_menu_item' );
        $this->loader->add_action('woocommerce_account_slug_endpoint', $cursoswob_woocommerce, 'cursoswob_fetch_content_custom_endpoint' );
    }
    
    public function run(){
        $this->loader->run();
    }
    
    public function get_version(){
        return $this->version;
        
    }
    
    
    
}
