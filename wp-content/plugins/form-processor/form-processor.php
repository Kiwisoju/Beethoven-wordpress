<?php

/**
 * Plugin Name: Contact Messages
 * Version: 0.0.1
 * Description: Plugin to save messages from contact form into a table, easily visible within WordPress Dashboard
*/

class FormProcessor{
    private $db;

    public function __construct(){
     
        global $wpdb;
        $this->db = $wpdb;
        
        add_action('wp_ajax_login', array(&$this, 'ajax_login') );
        add_action('wp_ajax_nopriv_login', array(&$this, 'ajax_login') );
        
        add_action('wp_ajax_signup', array(&$this, 'ajax_signup') );
        add_action('wp_ajax_nopriv_signup', array(&$this, 'ajax_signup') );
        
        add_action('wp_ajax_test', array(&$this, 'ajax_test') );
        add_action('wp_ajax_nopriv_test', array(&$this, 'ajax_test') );
        
        add_action('wp_ajax_contact_log', array(&$this, 'ajax_contact_log') );
        add_action('wp_ajax_nopriv_contact_log', array(&$this, 'ajax_contact_log') );
        
        add_action('admin_menu', array(&$this, 'register_menu_page') );
        
       
    }
    
    public function ajax_signup(){
        $registerDetails['first_name'] = $_POST['signup']['firstName'];
        $registerDetails['last_name'] = $_POST['signup']['lastName'];
        $registerDetails['user_login'] = $_POST['signup']['email'];
        $registerDetails['user_password'] = $_POST['signup']['password'];
        $account = $_POST['signup']['account'];
        
        // Check if username is taken
        $sql = "SELECT `user_login` FROM `wp_users` WHERE `user_login` = '" . $registerDetails['user_login'] . "'";
        
        if(!($this->db->get_results($sql) ) ){
            // Check if passwords match
            if($registerDetails['user_password'] == $_POST['signup']['passwordAgain']){
                // Create the user 
                $user = wp_insert_user($registerDetails);
                if($user){
                    // Set wp_user_level depending on $account
                    $account == 'teacher' ? $userLevel = 5 : $userLevel = 4; 

                    $sql = "UPDATE wp_usermeta
                            SET meta_value = '" . $userLevel . "'
                            WHERE user_id = '" . $user . "'
                            AND meta_key = 'wp_user_level'";
                            
                    $this->db->query($sql);
                  
                }
                
            }else{
                $message = 'Your passwords do not match';
                die(json_encode($message));
            }
        }else{
            $message = 'This username has been taken';    
        // Sign them in
        }
        // Notify that user has been created
        //die(json_encode($account));
        die(json_encode('you are a fool') );
    }
    
    public function ajax_test(){
        die(json_encode(array('test' => 'My hovercraft is full of eels') ) );
    }
    
    public function register_menu_page(){
        add_menu_page('Contact Logs', 'Contact Logs', 'edit_pages', 'contact logs', array(&$this, 'contact_logs') );
    }
    
    public function contact_logs(){
        $logs = $this->db->get_results('SELECT * FROM `contact_logs`');
        include_once('_contact_logs.php');
    }
    
    public function ajax_login(){
        // Here try the old wp_login with the form details
        $loginDetails = $_POST['login'];
        
        $creds = array( 'user_login' =>  $_POST['log'], 'user_password' => $_POST['pwd'], 'remember' => $_POST['rememberme'] );
        $user = wp_signon( $creds, false );
        
        // Getting user data based on $loginDetails['username']
        $sql = "SELECT wp_users.ID, wp_usermeta.meta_key, wp_usermeta.meta_value
                FROM wp_usermeta
                INNER JOIN wp_users
                ON wp_usermeta.user_id=wp_users.ID
                WHERE wp_users.user_login = '" . $loginDetails['username'] . "'
                AND wp_usermeta.meta_key = 'wp_user_level'";
                
        $user = $this->db->get_results($sql, ARRAY_A);
        
        // Checking if user exists
        if($user){
            // Store wp_login into user array, boolean result if successful or failure.        
            $user[0]['login'] = wp_login($loginDetails['username'], $loginDetails['password']);
            
            // Incorrect password if wp_login is unsuccessful
            $user[0]['login'] ? true : $user[0]['notification'] = 'Incorrect Password';
        }else{
            // Username does not exist.
            $user[0]['notification'] = 'This username does not exist.';
        }
        
        die(json_encode($user) );
    }
     
    public function ajax_contact_log(){
        $log = $_POST['log'];
        if($log){
            $log['ip'] = $_SERVER['REMOTE_ADDR'];
            $result = $this->db->insert('contact_logs', $log);
        }
        die(json_encode(array('result' => $this->db->insert_id)));
    }
    /**
     * This runs when the plugin is activated. Here we are
     * creating a contact logs table. Info found on https://codex.wordpress.org/Creating_Tables_with_Plugins
     */ 
     
    public function install(){
        
        $sql = "CREATE TABLE `contact_logs` (
                    id int(11) NOT NULL AUTO_INCREMENT,
                    name varchar(50) NOT NULL,
                    email varchar(150) NOT NULL,
                    message mediumtext NOT NULL,
                    ip varchar(128) NOT NULL,
                    date TIMESTAMP NOT NULL,
                    UNIQUE KEY id (id)
                ) ".$this->db->get_charset_collate();
                
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
    
    /**
     * This runs when the plugin is deactivated. Here we drop
     * the logs table. If this is a likely plugin to be deactivated
     * and reactivated, prompt user whether they wish to drop the table
     * as all data will be dropped.
     */
     
    public function uninstall(){
        $sql = "DROP TABLE IF EXISTS `contact_logs`";
        $this->db->query($sql);
        
    }
    
    public function init(){
        wp_die(var_dump('oh hey'));
    }
}

/**
 * This makes sure no name collisions occur and only one 
 * instantiation of the class occurs. This is better for
 *  more in depth examples, better for uses such as public
 * releases etc.
 */
 
if(class_exists('FormProcessor')){
    if(!isset($formProcessor)){
        $formProcessor = new FormProcessor();
    }
}


//This hooks onto the action of activating your plugin
register_activation_hook(__FILE__, array(&$formProcessor, 'install') );
//This hooks onto the action of deactivating your plugin
register_deactivation_hook(__FILE__, array(&$formProcessor, 'uninstall') );