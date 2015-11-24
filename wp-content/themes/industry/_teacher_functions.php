<?php
class TeacherFunctions{
    
   public function TeacherFunctions(){
       // Shortcodes
       add_shortcode('student_form', array(&$this, 'industry_student_form') );
       
   } 
   
    // [student_form] Shortcode
    public function industry_student_form(){
        ob_start();
        include '_student_form.php';
        return ob_get_clean();
    }
    
    /**
     * Function for registration of student profile
     **/ 
    public function create_student(){
        
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

