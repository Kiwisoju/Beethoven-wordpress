<?php

class FrontPage{
    
    public $template_name;
    
    public function FrontPage(){
    // Registering and Enqueing styles and scripts
		add_action( 'init', array(&$this, 'register_styles_and_scripts') );
		add_action( 'wp_enqueue_scripts', array(&$this, 'enqueue_styles_and_scripts') );
		
		//register_nav_menu('primary', __('Primary navigation', 'industry') );
		add_filter( 'wp_nav_menu_args', array(&$this, 'my_wp_nav_menu_args') );
		
		add_shortcode('svg', array(&$this, 'svg') );
		add_shortcode('contact_form', array(&$this, 'industry_contact_form') );
		
		include_once('rollbar.php');
		Rollbar::init(array('access_token' => 'df78d3555a1f4f72a423631a7d7534dd'));
		Rollbar::report_message("SYSTEM: Cron Initialised", 'info');
		//$this->template_name= get_post_meta( $wp_query->post->ID, '_wp_page_template', true );
	
    }
    
    
    

    
    //[svg] Shortcode
    public function svg($atts){
    	$atts = shortcode_atts(
		array(
			'type' => $atts
		), $atts, 'svg' );
    	ob_start();
    	include 'images/svg/'.$atts['type'].'.svg';
    	return ob_get_clean();
    }
    
    // [contact_form] Shortcode
    public function industry_contact_form(){
    	ob_start();
    	include '_contact_form.php';
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
		wp_register_style('signup-css', get_template_directory_uri().'/css/signup.css', false);
		
		wp_register_script('bootstrap-js', get_template_directory_uri().'/js/bootstrap.min.js', array('jquery') );
		wp_register_script('front-page-js', get_template_directory_uri().'/js/front-page.js', false);
		wp_register_script('signup-js', get_template_directory_uri().'/js/signup.js', false);
		wp_register_script('jquery-easing', get_template_directory_uri().'/js/jquery.easing.min.js', false);
		wp_register_script('scrolling-nav', get_template_directory_uri().'/js/scrolling-nav.js', false);
		wp_register_script('waypoint', get_template_directory_uri().'/js/jquery.waypoint.min.js', false);
		wp_register_script( "login-ajax", get_template_directory_uri().'/js/login-ajax.js', false);
	}
	
	public function enqueue_styles_and_scripts() {
		
		
		//die(var_dump($this->template_name));
		
		wp_enqueue_style('bootstrap-css');
		wp_enqueue_style('core');
		wp_enqueue_style('main-css');
		// If front page, loading front page specific styles
		
		if(is_front_page() || is_page('about-us' || is_page('signup')) ){
		    wp_enqueue_style('front-page-css');
		}
		
		wp_enqueue_script('bootstrap-js');
		
		if(is_page('signup')){
			wp_enqueue_style('signup-css');
			wp_enqueue_script('signup-js');
		}
		
		if(is_front_page()){
		    wp_enqueue_script('front-page-js');
		    wp_enqueue_script('jquery-easing');
		    wp_enqueue_script('scrolling-nav');
		    wp_enqueue_script('waypoint');
		    
   			wp_localize_script( 'login-ajax', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
   			wp_enqueue_script('login-ajax');
		    
		}
	}	
	
}

$frontPage = new FrontPage();

include('_register_functions.php');
?>