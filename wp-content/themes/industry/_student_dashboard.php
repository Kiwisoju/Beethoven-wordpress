<div id="welcome-container">
    <div class="panel panel-default">
          <div class="panel-body panel-body-heading">
            <div class="col-md-4 col-xs-12">
                <span class="left-title">Welcome <?php echo get_user_meta(get_current_user_id(), 'first_name', true)?></span>
            </div> 
            <div class="col-md-8 col-xs-12 text-center">
                <div class="col-xs-4 hidden-xs hidden-sm">
                    <span>Lesson</span>    
                </div>
                <div class="col-xs-4 hidden-xs hidden-sm">
                    <span>Ear Trainer</span>
                </div>
                <div class="col-xs-4 hidden-xs hidden-sm">
                    <span>Results</span>
                </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="col-md-4 col-xs-12">
                <span>Welcome to your dashboard!<br>Click on the lessons tab to see what lessons you have waiting.</span>
            </div>
                <div class="col-xs-12 col-md-8 text-center">
                    <div class="col-md-4 col-xs-12">
                        <i class="icon-lessons-icon icon-8x module-icon-student"></i>
                        <a class="module-button btn" href="<?php echo home_url();?>/student/lessons">View Lessons</a>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <i class="icon-headphones icon-8x module-icon-student"></i>
                        <a class="module-button btn" href="<?php echo home_url();?>/student/eartrainer">Practice Exercises</a>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <i class="icon-classroom-icon icon-8x module-icon-student"></i>
                        <a class="module-button btn" href="<?php echo home_url();?>/student/lessons">View Results</a>
                    </div>
                </div>
          </div>
        </div>
</div>
<div id="lessons-container">
    <div class="panel panel-default">
          <div class="panel-body panel-body-heading">
            <div class="col-md-4 col-xs-12">
                <span class="left-title">Latest Results</span>
            </div> 
            <div class="col-md-8 col-xs-12">
                <span id="graph-lesson-title"></span>
                <!-- Graph goes here -->
            </div>
          </div>
          <div class="panel-body panel-body-lesson">
            <div class="col-md-4 col-xs-12 lesson-select">
                <ul>
                    <?php foreach($lessons as $lessonId => $data): ?>
                        <li>
                            <a class="lesson-item" href="#lesson-<?php echo $lessonId ?>" data-lesson-id="<?php echo $lessonId ?>"><?php echo $data['lesson_name'] ?></a>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
                <div class="col-md-8 col-xs-12 text-center">
                    <div class="lesson-results-container">
                        
                    </div>
                    
                </div>
          </div>
        </div>
</div>

<script type="text/javascript">
    window.studentAdminData = {
        lessons: <?php echo json_encode($lessons) ?>
    };
</script>