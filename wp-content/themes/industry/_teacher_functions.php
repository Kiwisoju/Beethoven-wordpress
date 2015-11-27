<?php
class TeacherFunctions{
    private $db;    
   public function TeacherFunctions(){
       global $wpdb;
       $this->db = $wpdb;
        // Shortcodes
        add_shortcode('student_form', array(&$this, 'industry_student_form') );
        add_shortcode('classroom_form', array(&$this, 'industry_classroom_form') );
        add_shortcode('lesson_form', array(&$this, 'industry_lesson_form') );
        add_shortcode('overview_student', array(&$this, 'industry_overview_student') );
        add_shortcode('overview_classrooms', array(&$this, 'industry_overview_classrooms') );
        add_shortcode('overview_lessons', array(&$this, 'industry_overview_lessons') );
       
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
                case 'create-classroom':
                    wp_send_json($this->create_classroom($data) );
                    break;
                case 'update-classroom':
                    wp_send_json($this->update_classroom($data) );
                    break;
                case 'create-lesson':
                    wp_send_json($this->create_lesson($data) );
                    break;
                case 'update-lesson':
                    $this->update_lesson();
                    break;
                case 'results':
                    wp_send_json($this->store_results($data) );
                    break;
            }
        }
        die(json_encode(array('test' => 'hovercraft is full of eeels')));
    }
   
   
    public function store_results(){
        return $response['message'] = 'this is coming form php';
    }   
    
    // [student_form] shortcode
    public function industry_student_form(){
        $classrooms = $this->get_all_from_classroom();
        ob_start();
        include '_student_form.php';
        return ob_get_clean();
    }
    
    // [classroom_form] shortcode
    public function industry_classroom_form(){
        
        $students = $this->get_all_from_students();
        if($_GET['edit']){
            $classrooms = $this->get_all_from_classroom();
        }
        
        ob_start();
        include ('_classroom_form.php');
        return ob_get_clean();
    }
    
    // [overview_classrooms] shortcode
    public function industry_overview_classrooms(){
        
        $classrooms = $this->get_all_from_classroom();
        
        ob_start();
        include('_overview_classrooms.php');
        return ob_get_clean();
    }
    
    // [lesson_form] shortcode
    public function industry_lesson_form(){
        $lessons = $this->get_all_from_lesson();
        $classrooms = $this->get_all_from_classroom();
        
        ob_start();
        include('_lesson_form.php');
        return ob_get_clean();
    }
    
    // [overview_lessons] shortcode
    public function industry_overview_lessons(){
        $lessons = $this->get_all_from_lesson();
        
        ob_start();
        include('_overview_lessons.php');
        return ob_get_clean();
    }
    
    public function get_all_from_lesson(){
        $sql = "SELECT * FROM lessons WHERE teacher_id = '" . get_current_user_id() . "'";
        $lessons = $this->db->get_results($sql, ARRAY_A);
        return $lessons;
    }
    
    public function get_all_from_classroom(){
        $classNumbers = get_user_meta(get_current_user_id(), 'classroom');
        $classrooms = [];
        for($i = 0; $i < count($classNumbers); $i++){
            // Assigning class name
            $classrooms[$i]['class_name'] = $classNumbers[$i];
            
            $sql = "SELECT user_id 
                    FROM `wp_usermeta` 
                    WHERE meta_key = 'classroom'
                    AND meta_value = '" . $classrooms[$i]['class_name'] . "'
                    AND user_id != '" . get_current_user_id() . "'";
                
            $usersEnrolled = $this->db->get_results($sql);
            
            // Getting number of students for class
            $classrooms[$i]['number_of_students'] = count($usersEnrolled);
            
            // Getting the student ids
            $classrooms[$i]['student_id'] = $usersEnrolled;
            
            // TODO gather all the lessons.
            $sql = "SELECT lesson_id FROM lessons WHERE classroom_name = '" . $classrooms[$i]['class_name'] . "'";
            
            $numberOfLessons = $this->db->get_results($sql);
            
            $classrooms[$i]['number_of_lessons'] = count($numberOfLessons);
        }
        
        return $classrooms;
        
    }
    
    public function get_all_from_students(){
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
        
        return $students;
    }
    
    // [overview_student] shortcode
    public function industry_overview_student(){
        
        $students = $this->get_all_from_students();
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
    public function create_classroom($formData){
        $teacherID = get_current_user_id();
        
        $className = strtolower($formData['class_name']); 
        
        // First create the classroom for the teacher
        add_user_meta($teacherID, 'classroom', $className);
        
        // For each of the items in the array of $formdata['students'], assign them
        // to the classroom
        for($i = 0; $i < count($formData['students']); $i++){
            if($formData['students'][$i]){
                $this->assign_classroom($formData['students'][$i], $className);
            }
        }
        return $response['message'] = 'You have successfully created your classroom.';
    }
    
    /**
     * Function for updating classroom
     **/ 
    public function update_classroom($formData){
        $teacherID = get_current_user_id();
        
        $className = strtolower($formData['class_name']);
        
        
        $sql = "UPDATE wp_usermeta
                SET meta_value = '" . $className . "'
                WHERE meta_key = 'classroom'
                AND meta_value = '" . $formData['old_class_name'] . "'
                AND user_id = '" . $teacherID . "'";
                
                
        // First update the classroom for the teacher
        $this->db->query($sql);
        
        // Then update any field in the lessons table which is attached to the class.
        $sql2 = "UPDATE lessons
                 SET classroom_name = '" . $className . "'
                 WHERE classroom_name = '" . $formData['old_class_name'] . "'";
        $this->db->query($sql2);
        
        
        // For each of the items in the array of $formData['students'], assign them
        // to the updated classroom name.
        for($i = 0; $i < count($formData['students']); $i++){
            if($formData['students'][$i]){
                $this->assign_classroom($formData['students'][$i], $className);
            }
        }
        return $response['message'] = 'You have successfully updated your classroom.';
    }
    
    /**
     * Function for creating lesson
     **/
    public function create_lesson($formData){
        // Create an entry into the lessons table, with the lesson name
        // the exercise type and the classroom name, also add the teacher's ID
        //<?php $wpdb->insert( $table, $data, $format );
        $lessonData['lesson_name'] = $formData['lesson_name'];
        $lessonData['classroom_name'] = $formData['classroom'];
        $lessonData['exercise_type'] = $formData['exercise_type'];
        $lessonData['teacher_id'] = get_current_user_id();
        
        // Check whether a lesson already exists with the name
        $sql = "SELECT * FROM lessons
                WHERE lesson_name = '" . $lessonData['lesson_name'] . "'";
        
        
        if($this->db->query($sql) ){
            return $response['message'] = 'A lesson already exists with this name';
        }        
        
        if(!$this->db->insert('lessons', $lessonData)){
            return $response['message'] = 'There was an error in creating your lesson we apologise for any inconvenience';
        };
        
        $lessonId =  $this->db->insert_id;
        
        // Then create an entry in the exercise table with the corresponding
        // lesson id which was just created. And fill this one up with
        // the questions and answers. That should be enough really.
        
        for($i = 0; $i < count($formData['questions']); $i++){
            if($formData['questions'][$i]){
                $exerciseData['question'] = $formData['questions'][$i];
                $exerciseData['answer'] = $formData['answers'][$i];
                $exerciseData['lesson_id'] = $lessonId;
                
                $this->db->insert('exercises', $exerciseData);
            }
        }
        return $response['message'] = "Your lesson has been created";
    }
    
    /**
     * Function for updating lesson
     **/ 
    public function update_lesson($formData){
        
    }
}

$teacherFunctions = new TeacherFunctions();

?>

