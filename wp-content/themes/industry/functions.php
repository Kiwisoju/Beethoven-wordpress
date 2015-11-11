<?php

class FrontPage{
    
    public $template_name;
    
    public function FrontPage(){
    // Registering and Enqueing styles and scripts
		add_action('init', array(&$this, 'register_styles_and_scripts') );
		add_action( 'wp_enqueue_scripts', array(&$this, 'enqueue_styles_and_scripts') );
		
		//register_nav_menu('primary', __('Primary navigation', 'industry') );
		add_filter( 'wp_nav_menu_args', array(&$this, 'my_wp_nav_menu_args') );
		
		add_shortcode('svg', array(&$this, 'svg') );
		
		
		//$this->template_name= get_post_meta( $wp_query->post->ID, '_wp_page_template', true );
	
    }
    
    public function svg($atts){
    	$atts = shortcode_atts(
		array(
			'type' => $atts
		), $atts, 'svg' );
    	ob_start();
    	include 'images/svg/'.$atts['type'].'.svg';
    	return ob_get_clean();
    }
    
    /* Removing the container div from wp_nav */
    function my_wp_nav_menu_args( $args = '' ) {
		$args['container'] = false;
		return $args;
	}
	
    
    public function register_styles_and_scripts(){
		wp_register_style('bootstrap-css', get_template_directory_uri().'/css/bootstrap.min.css', false);
		wp_register_style('core', get_template_directory_uri().'/style.css', false);
		wp_register_style('main-css', get_template_directory_uri().'/css/main.css', false);
		wp_register_style('front-page-css', get_template_directory_uri().'/css/front-page.css', false);
		
		wp_register_script('bootstrap-js', get_template_directory_uri().'/js/bootstrap.min.js', array('jquery') );
	}
	
	public function enqueue_styles_and_scripts() {
		// If front page, loading front page specific styles
		if(is_front_page() || is_page('about-us') ){
		    wp_enqueue_style('front-page-css');
		}
		
		//die(var_dump($this->template_name));
		
		wp_enqueue_style('bootstrap-css');
		wp_enqueue_style('core');
		wp_enqueue_style('main-css');
		
		wp_enqueue_script('bootstrap-js');
	}	
	
}

$frontPage = new FrontPage();

?>