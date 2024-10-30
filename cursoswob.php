<?php
/*
 * Este archivo es el responsable del inicio del plugin Cursos Wob
 * 
 * Este archivo es responsable de incluir las dependencias necesarias e iniciar el plugin
 * 
 * Plugin Name: Cursos Wob
 * Plugin URI: https://www.wpwob3.com/
 * Version: 1.8
 * Description: Cursos Wob es un plugin para crear y vender tus cursos de manera sencilla.
 * Author: Wob3 Creatius
 * Author URI: https://www.wpwob3.com/
 * License: GPLv2
 * Text Domain: cursoswob
 * Domain Path: /languages
 */


//para no poder acceder directamente al plugin desde el navegador
if(!defined('WPINC')){
    die;
}


function cursoswob_load_textdomain() {
    $locale = get_locale();
    load_textdomain( 'cursoswob', plugin_basename( dirname( __FILE__ ) ).'/languages/cursoswob-'.$locale.'.mo' );
    load_plugin_textdomain( 'cursoswob', false, plugin_basename( dirname( __FILE__ ) ).'/languages' ); 
}
add_action('init', 'cursoswob_load_textdomain');


require_once plugin_dir_path( __FILE__ ) . 'includes/class-cursoswob.php';
function run_cursoswob() {
        
	$spmm = new CursosWob();
	$spmm->run();

}
run_cursoswob();


function add_action_links ( $links ) {
    $mylinks = array(
    '<a href="edit.php?post_type=cursos&page=cursoswob-configuracion-woocommerce">Ajustes</a>',
    );
    return array_merge( $links, $mylinks );
}
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'add_action_links' );


