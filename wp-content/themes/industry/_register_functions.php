<?php

class RegisterFunctions{
    
    public function RegisterFunctions(){
        // Duplicating user_login to user_email for registration
		add_action( 'init', array(&$this, 'industry_preparing_form') );
		// Adding inputs to registration form
		add_action( 'register_form', array(&$this, 'myplugin_register_form' ) );
		// Adding validation to extra inputs
		add_filter( 'registration_errors', array(&$this, 'myplugin_registration_errors'), 10, 3 );
		// Saving extra inputs to user_meta.
		add_action( 'user_register', array(&$this, 'myplugin_user_register') );
		
		add_action( 'init', array(&$this, 'register_login_styles_and_scripts') );
		add_action( 'login_enqueue_scripts', array(&$this, 'enqueue_login_styles_and_scripts') );
		
		
		
    }
    
    public function register_login_styles_and_scripts(){
        wp_register_style('login-css', get_template_directory_uri().'/css/login.css', false);
    }
    
    public function enqueue_login_styles_and_scripts(){
        wp_enqueue_style('login-css');
    }
    
    public function industry_preparing_form(){
    	
    	if($_POST['user_login']){
    		$_POST['user_email'] = $_POST['user_login'];
    		$_POST['redirect_to'] = $_SERVER['HTTP_REFERER'].'?checkemail=registered';
    		//die(var_dump($_POST));
    	}
    }
    
    public function myplugin_register_form() {
    	
    	$first_name = ( ! empty( $_POST['first_name'] ) ) ? trim( $_POST['first_name'] ) : '';
    	$last_name = ( ! empty( $_POST['last_name'] ) ) ? trim( $_POST['last_name'] ) : '';
        ?>
        <p>
            <label for="first_name"><?php _e( 'First Name', 'mydomain' ) ?><br />
                <input type="text" name="first_name" id="first_name" class="input" value="<?php echo esc_attr( wp_unslash( $first_name ) ); ?>" size="25" /></label>
        </p>
        <p>
            <label for="last_name"><?php _e( 'Last Name', 'mydomain' ) ?><br />
                <input type="text" name="last_name" id="last_name" class="input" value="<?php echo esc_attr( wp_unslash( $last_name ) ); ?>" size="25" /></label>
        </p>
        <?php
    }
    
    public function myplugin_registration_errors( $errors, $sanitized_user_login, $user_email ) {
        
        if ( empty( $_POST['first_name'] ) || ! empty( $_POST['first_name'] ) && trim( $_POST['first_name'] ) == '' ) {
            $errors->add( 'first_name_error', __( '<strong>ERROR</strong>: You must include a first name.', 'mydomain' ) );
        }
        if ( empty( $_POST['last_name'] ) || ! empty( $_POST['last_name'] ) && trim( $_POST['last_name'] ) == '' ) {
            $errors->add( 'last_name_error', __( '<strong>ERROR</strong>: You must include a last name.', 'mydomain' ) );
        }

        return $errors;
    }
    
    public function myplugin_user_register( $user_id ) {
        if ( ! empty( $_POST['first_name'] ) ) {
            update_user_meta( $user_id, 'first_name', trim( $_POST['first_name'] ) );
        }
        if ( ! empty( $_POST['last_name'] ) ) {
            update_user_meta( $user_id, 'last_name', trim( $_POST['last_name'] ) );
        }
    }
}

$registerFunctions = new RegisterFunctions();