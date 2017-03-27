<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}



function seconddb(){
	global $seconddb;
	$seconddb = new wpdb('root', '', 'bandb', 'localhost');
}

add_action('init', 'seconddb')

/*add jquery ui*/

//add_action('wp_enqueue_script' );
?>