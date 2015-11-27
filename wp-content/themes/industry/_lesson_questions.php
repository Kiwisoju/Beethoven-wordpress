<?php
//foreach($lessonQuestions as $question){ var_dump($question); }
//die(var_dump($lessonQuestions));
?><div class="header-fixed">
    <div id="title-container">
        <h2 class="text-uppercase"><?php echo $lessonQuestions[0]->lesson_name ?></h2>
    </div>
    <div class="progress">
        <div class="progress-bar progress-bar-info"></div>
    </div>
</div>
<!-- Main Content Area -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-offset-3 col-md-7 col-xs-12">
                    <input type="hidden" id="lesson_id" value="<?php echo $lessonQuestions[0]->lesson_id ?>" name="form['lesson_id']"/><?php
                    switch($lessonQuestions[0]->exercise_type):
                        case 'interval_recognition':
                            include('_lesson_question_interval.php');
                            break;
                        case 'note_identification':
                            include('_lesson_question_note.php');
                            break;
                        case 'chord_recognition':
                            include('_lesson_question_chord.php');
                            break;
                    endswitch;?>
                        <div class="results toggle">
                            <div class="results-container">
                                <h3>You have completed your lesson</h3>
                                <span>You can see your results in your past lessons table.</span>
                                <div>
                                    <a class="btn primary-button" href="<?php echo home_url('/')?>student/lessons">Go back to Lessons</a>
                                </div>
                            </div>
                        </div>