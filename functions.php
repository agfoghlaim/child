<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}



function seconddb(){
	global $seconddb;
	$seconddb = new wpdb('root', '', 'bandb', 'localhost');
}

add_action('init', 'seconddb');

/*add jquery ui*/

//add_action('wp_enqueue_script' );

 function divi_child_scripts(){
 	wp_enqueue_script('js', get_stylesheet_directory_uri() . '/js/js.js');
 	wp_enqueue_script('jquery');
 }



add_action( 'wp_enqueue_scripts', 'divi_child_scripts');
?>