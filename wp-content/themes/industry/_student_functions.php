<?php
class StudentFunctions{
    private $db;  
    private $classroom;
    
    public function StudentFunctions(){
        global $wpdb;
        $this->db = $wpdb;
        $this->classroom = $this->get_classroom();
        
        // Shortcodes
        add_shortcode('lessons', array(&$this, 'industry_lessons') );
        add_shortcode('lesson', array(&$this, 'industry_lesson') );
        add_shortcode('results', array(&$this, 'industry_results') );
        add_shortcode('student', array(&$this, 'industry_student') );
        
        add_action('wp_ajax_processor', array(&$this, 'industry_ajax_processor') );
        add_action('wp_ajax_nopriv_processor', array(&$this, 'industry_ajax_processor') );
        
    } 
    
    //[teacher] shortcode - Holds all dashboard modules
   public function industry_student(){
       ob_start();
       include '_student_dashboard.php';
       return ob_get_clean();
   }
    
    public function industry_results(){
        $lessonId = $_GET['lesson'];
        $results = [];
        
        // Grab the answers for the lesson being shown.
        $sql = "SELECT answer FROM exercises WHERE lesson_id = '" . $lessonId . "'";
        $answers = $this->db->get_results($sql, ARRAY_A);
        // Grab the students answers from the lesson being shown.
        $sql = "SELECT student_answer FROM results WHERE lesson_id = '" . $lessonId . "'";
        $studentAnswers = $this->db->get_results($sql, ARRAY_A);
        
        for ($i = 0; $i < count($answers); $i++) {
             $results[$i]['answer'] = $answers[$i]['answer'];
             $results[$i]['studentAnswer'] = $studentAnswers[$i]['student_answer'];
        }
        
        $lessonName = $this->db->get_results("SELECT lesson_name FROM lessons WHERE lesson_id = '" . $lessonId . "'");
        
        $sql = "SELECT correct 
                    FROM results 
                    WHERE lesson_id = '" . $lessonId . "' 
                    AND student_id = '" . get_current_user_id() . "'
                    AND correct = '1'";
                              
        $score = $this->db->query($sql);
       
        $results['lesson_name'] = $lessonName;
        $results['score'] = $score;
        
        
        ob_start();
        include '_results.php';
        return ob_get_clean();
    }
    
    //[lesson] shortcode
    public function industry_lesson(){
        $lessonId = $_GET['lesson'];
        
        $sql = "SELECT *
                FROM lessons
                INNER JOIN exercises
                ON lessons.lesson_id=exercises.lesson_id
                WHERE lessons.lesson_id = '" . $lessonId . "'";
                
        $lessonQuestions = $this->db->get_results($sql);
        
        ob_start();
        include '_lesson_questions.php';
        return ob_get_clean();
        
        // $lessonData = [];
        // $lessonData['lesson_id'] = $lessonId;
        // $lessonData['lesson_name'] = $lessonQuestions[0]['lesson_name'];
        // $lessonData['exercise_type'] = $lessonQuestions[0]['exercise_type'];
        
        // for($i = 0; $i < count($lessonQuestions); $i++){
        //     $lessonData['question'][$i] = $lessonQuestions[$i]['question'];
        //     $lessonData['answer'][$i] = $lessonQuestions[$i]['answer'];
        // }
        
        // ob_start();
        // include '_lesson_questions.php';
        // return ob_get_clean();
    }
    
    // [lessons] shortcode
    public function industry_lessons(){
        $lessons = $this->get_all_lessons_from_student();
        ob_start();
        include '_lessons.php';
        return ob_get_clean();
    }
    
    public function get_classroom(){
        return get_user_meta(get_current_user_id(), 'classroom', true);
    }
    
    public function get_all_lessons_from_student(){
        
        $sql = "SELECT lesson_id FROM lessons WHERE classroom_name = '" . $this->classroom . "'";
        $studentLessonIds = $this->db->get_results($sql, ARRAY_A);
        
        $studId = [];
        for ($i = 0; $i < count($studentLessonIds); $i++) {
             $studId[$i] = $studentLessonIds[$i]['lesson_id'];
        }
        
        // Getting the past lessons
        $pastLessons = [];
        $pastLessonIds = get_user_meta(get_current_user_id(), 'lesson_completed');
        
        for($i = 0; $i < count($pastLessonIds); $i++ ){
            $sql = "SELECT * FROM lessons WHERE lesson_id = '" . $pastLessonIds[$i] . "'";
            $pastLessons[$i] = $this->db->get_results($sql);
            
            $sql = "SELECT correct 
                    FROM results 
                    WHERE lesson_id = '" . $pastLessonIds[$i] . "' 
                    AND student_id = '" . get_current_user_id() . "'
                    AND correct = '1'";
                    
            $pastLessons[$i]['score'] = $this->db->query($sql);
        }
        
        // Getting the current lessons
        
        $currentLessonIds = array_diff($studId, $pastLessonIds);
        $currentLessons = [];
        
        for($i = 0; $i < count($currentLessonIds); $i++ ){
            $sql = "SELECT * FROM lessons WHERE lesson_id = '" . $currentLessonIds[$i] . "'";
            $currentLessons[$i] = $this->db->get_results($sql);
        }
        
        $lessons = [];
        $lessons['past_lessons'] = $pastLessons;
        $lessons['current_lessons'] = $currentLessons;
        return $lessons;
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
            }
        }
        die(json_encode(array('test' => 'hovercraft is full of eeels')));
    }
}

$studentFunctions = new StudentFunctions();

?>

