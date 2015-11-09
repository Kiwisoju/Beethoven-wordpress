<?php

class FrontPage{
    
    public function FrontPage(){
    // Registering and Enqueing styles and scripts
		add_action('init', array(&$this, 'register_styles_and_scripts') );
		add_action( 'wp_enqueue_scripts', array(&$this, 'enqueue_styles_and_scripts') );
	
    }
    
    public function register_styles_and_scripts(){
		wp_register_style('foundation-css', get_template_directory_uri().'/css/foundation.css', false);
		wp_register_style('core', get_template_directory_uri().'/style.css', false);
		wp_register_style('main-css', get_template_directory_uri().'/css/main.css', false);
		wp_register_style('front-page-css', get_template_directory_uri().'/css/front-page.css', false);
		
		
		
		wp_register_script('foundation-js', get_template_directory_uri().'/js/foundation.js', array('jquery') );
	}
	
	public function enqueue_styles_and_scripts() {
		wp_enqueue_style('foundation-css');
		wp_enqueue_style('core');
		wp_enqueue_style('main-css');
		
		// If front page, loading front page specific styles
		if(is_front_page() ){
		    wp_enqueue_style('front-page-css');
		}
		
		wp_enqueue_script('foundation-js');
	}	
	
}

$frontPage = new FrontPage();

?>