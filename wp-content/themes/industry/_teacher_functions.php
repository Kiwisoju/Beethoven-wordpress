<?php
class TeacherFunctions{
    private $db;    
   public function TeacherFunctions(){
       global $wpdb;
       $this->db = $wpdb;
        // Shortcodes
        add_shortcode('student_form', array(&$this, 'industry_student_form') );
        add_shortcode('classroom_form', array(&$this, 'industry_classroom_form') );
        add_shortcode('overview_student', array(&$this, 'industry_overview_student') );
        add_shortcode('overview_classrooms', array(&$this, 'industry_overview_classrooms') );
       
        add_action('wp_ajax_processor', array(&$this, 'industry_ajax_processor') );
        add_action('wp_ajax_nopriv_processor', array(&$this, 'industry_ajax_processor') );
   } 
   
   public function industry_ajax_processor(){
        if($_POST['formData']){
            $data = $_POST['formData'];
            // Routing the type of processing depending on the type of form.
            switch($data['type']){
                case 'enrolment':
                    wp_send_json($this->create_student($data) );
                    break;
                case 'update-student':
                    wp_send_json($this->update_student($data) );
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
   
    // [student_form] shortcode
    public function industry_student_form(){
        ob_start();
        include '_student_form.php';
        return ob_get_clean();
    }
    
    // [classroom_form] shortcode
    public function industry_classroom_form(){
        $sql = "SELECT user_id
                FROM wp_usermeta
                WHERE meta_key = 'teacher'
                AND meta_value = '" . get_current_user_id() . "'";
              
        $student_ids = $this->db->get_results($sql);
        $students = array();
        for($i = 0 ; $i < count($student_ids); $i++){
            $fullName = get_user_meta($student_ids[$i]->user_id, 'first_name', true) . ' ' . get_user_meta($student_ids[$i]->user_id, 'last_name', true);
            $students[$i]['name'] = $fullName;
        }
        ob_start();
        include ('_classroom_form.php');
        return ob_get_clean();
    }
    
    // [overview_classrooms] shortcode
    public function industry_overview_classrooms(){
        
        ob_start();
        include('_overview_classrooms.php');
        return ob_get_clean();
    }
    
    // [overview_student] shortcode
    public function industry_overview_student(){
        
        $sql = "SELECT user_id
                FROM wp_usermeta
                WHERE meta_key = 'teacher'
                AND meta_value = '" . get_current_user_id() . "'";
              
        $student_ids = $this->db->get_results($sql);
        $students = array();
        for($i = 0 ; $i < count($student_ids); $i++){
            $fullName = get_user_meta($student_ids[$i]->user_id, 'first_name', true) . ' ' . get_user_meta($student_ids[$i]->user_id, 'last_name', true);
            $students[$i]['name'] = $fullName;
            $students[$i]['classroom'] = get_user_meta($student_ids[$i]->user_id, 'classroom', true);
            $students[$i]['user_id'] = $student_ids[$i]->user_id;
        }
        ob_start();
        include '_overview_student.php';
        return ob_get_clean();
    }
    
    /**
     * Function for registration of student profile.
     * This needs to take all of the form Data from the ajax request and process
     * it with wordpresses register new user function. Also assigning the type of
     * user to be a student. Assignment of classroom is not necessary.
     **/ 
    public function create_student($formData){
       
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
            
            // If there is a profile image, add this.
            if($formData['profile_image']){
                $this->assign_profile_image($user_id, $formData['profile_image']);
            }else{
                $this->assign_profile_image($user_id, 'none');
            }
            
            // Assigning the student to their teacher
            add_user_meta($user_id, 'teacher', get_current_user_id() );
            
            // If no class has been selected, assign to 'none'
            if($formData['classroom'] == 'default'){
                $this->assign_classroom($user_id, 'none');
            }else{
                $this->assign_classroom($user_id, $formData['classroom']);
            }
            
            // Sending notification email for password reset.
            wp_new_user_notification($user_id, '', 'both');
            $response['message'] = 'Student has been created, their password has been emailed to them.';
            //wp_mail($formData['user_email'], 'Welcome!', 'Your Password is: ' . $password );
        }else{
            $response['message'] = 'This email address is already being used.';
        }
        return $response;
    }
    
    /**
     * Function for updating student's profile
     **/ 
    public function update_student($formData){
        // Update classroom
        $this->assign_classroom($formData['user_id'], $formData['classroom']);
        // Update profile image
        $this->assign_profile_image($formData['user_id'], $formData['profile_image']);
        
        $errors = wp_update_user(
                array(
                    'ID' => $formData['user_id'],
                    'first_name' => $formData['first_name'],
                    'last_name' => $formData['last_name'],
                    'user_email' => $formData['user_email'],
                    'user_login' => $formData['user_email'],
                    'nickname' => $formData['user_email']
                    )
            );   
            
            if(!is_wp_error($errors) ){
                $response['message'] = 'Student has been updated';
            }else{
                $response['message'] = 'There was an error in updating this student';
            }
        return $reponse['message'] = 'Student has been updated';
    }
    
    /**
     * Function for assigning profile images. Handles both
     * updates and additions.
     **/ 
    public function assign_profile_image($user_id, $profile_image){
        // Check whether an image has already been assigned for user
        if(get_user_meta($user_id, 'profile_image', true)){
            update_user_meta($user_id, 'profile_image', $profile_image );
        }
        // Otherwise assign profile image as the first
        else{
            add_user_meta($user_id, 'profile_image', $profile_image);
        }
    }
    
    
    /**
     * Function for assigning students to classrooms, if the student
     * already belongs to a classroom, it is updated.
     **/
     
     public function assign_classroom($user_id, $classroom){
         // Check whether student is already assigned to a classroom
        if(get_user_meta($user_id, 'classroom', true)){
            update_user_meta($user_id, 'classroom', $classroom );
        }
        // Otherwise assign profile image as the first
        else{
            add_user_meta($user_id, 'classroom', $classroom);
        }
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

