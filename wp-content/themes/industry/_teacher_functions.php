<?php
class TeacherFunctions{
    
   public function TeacherFunctions(){
        // Shortcodes
        add_shortcode('student_form', array(&$this, 'industry_student_form') );
       
        add_action('wp_ajax_processor', array(&$this, 'industry_ajax_processor') );
        add_action('wp_ajax_nopriv_processor', array(&$this, 'industry_ajax_processor') );
   } 
   
   public function industry_ajax_processor(){
        
        if($_POST['formData']){
            $data = $_POST['formData'];
            // Routing the type of processing depending on the type of form.
            switch($data['type']){
                case 'enrolment':
                    wp_send_json($this->create_student($data));
                    break;
                case 'create_classroom':
                    $this->create_classroom();
                    break;
                case 'create_lesson':
                    $this->create_lesson();
                    break;
            }
        }
        die(json_encode(array('test' => 'hovercraft is full of eeels')));
    }
   
    // [student_form] Shortcode
    public function industry_student_form(){
        ob_start();
        include '_student_form.php';
        return ob_get_clean();
    }
    
    /**
     * Function for registration of student profile.
     * This needs to take all of the form Data from the ajax request and process
     * it with wordpresses register new user function. Also assigning the type of
     * user to be a student. Assignment of classroom is not necessary.
     **/ 
    public function create_student($formData){
        // $user_id = register_new_user($formData['user_email'], $formData['user_email']);
        // return $user_id;
        // if ( !is_wp_error($user_id) ) {
        //     // Set first and last name based on the user_id
        //     wp_update_user(
        //         array(
        //             'ID' => $user_id,
        //             'first_name' => $formData['first_name'],
        //             'last_name' => $formData['last_name'],
        //             'role' => 'student'
        //             )
        //         );
            
            // Also assign the student to a classroom if a classroom is present to
            // assign to.
                
            // // return a succcess message.
            // return 'You have success with a new student creation mang!';
       // }
        
        
        
        if(null == username_exists($formData['user_email']) ){
            $password = wp_generate_password(12, false);
            $user_id = wp_create_user($formData['user_email'], $password, $formData['user_email']);
            
            // Setting First and Last names
            wp_update_user(
                array(
                    'ID' => $user_id,
                    'first_name' => $formData['first_name'],
                    'last_name' => $formData['last_name'],
                    'role' => 'student'
                    )
            );
            wp_new_user_notification($user_id, '', 'both');
            return 'it worked?';
            //wp_mail($formData['user_email'], 'Welcome!', 'Your Password is: ' . $password );
        }
    }
    
    /**
     * Function for updating student's profile
     **/ 
    public function update_student(){
        
    }
    
    /**
     * Function for deleting student's profile
     **/ 
    public function delete_student(){
        
    }
    
    /**
     * Function for creation of classroom
     **/ 
    public function create_classroom(){
        
    }
    
    /**
     * Function for updating classroom
     **/ 
    public function update_classroom(){
        
    }
}

$teacherFunctions = new TeacherFunctions();

?>

