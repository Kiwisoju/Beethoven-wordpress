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
        
        // add_action('wp_ajax_login', array(&$this, 'ajax_login') );
        // add_action('wp_ajax_nopriv_login', array(&$this, 'ajax_login') );
        
        // add_action('wp_ajax_signup', array(&$this, 'ajax_signup') );
        // add_action('wp_ajax_nopriv_signup', array(&$this, 'ajax_signup') );
        
        // add_action('wp_ajax_test', array(&$this, 'ajax_test') );
        // add_action('wp_ajax_nopriv_test', array(&$this, 'ajax_test') );
        
        add_action('wp_ajax_contact_log', array(&$this, 'ajax_contact_log') );
        add_action('wp_ajax_nopriv_contact_log', array(&$this, 'ajax_contact_log') );
        
        add_action('wp_ajax_processor', array(&$this, 'industry_ajax_processor') );
        add_action('wp_ajax_nopriv_processor', array(&$this, 'industry_ajax_processor') );
        
        add_action('admin_menu', array(&$this, 'register_menu_page') );
        
        // add_shortcode('registration_form', array($this, 'industry_registration_form'));
        
       
    }
    
    public function industry_ajax_processor(){
        die(json_encode(array('test' => 'hovercraft is full of eeels')));
    }
    
    public function register_menu_page(){
        add_menu_page('Contact Logs', 'Contact Logs', 'edit_pages', 'contact logs', array(&$this, 'contact_logs') );
    }
    
    public function contact_logs(){
        $logs = $this->db->get_results('SELECT * FROM `contact_logs`');
        include_once('_contact_logs.php');
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