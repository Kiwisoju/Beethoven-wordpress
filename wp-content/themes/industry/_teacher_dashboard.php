<div id="welcome-container" class="container">
    <div class="panel panel-default">
          <div class="panel-body panel-body-heading">
            <div class="col-xs-4">
                <span class="left-title">Welcome <?php echo get_user_meta(get_current_user_id(), 'first_name', true)?></span>
            </div> 
            <div class="col-xs-8 text-center">
                <div class="col-xs-4">
                    <span>Lesson</span>    
                </div>
                <div class="col-xs-4">
                    <span>Classroom</span>
                </div>
                <div class="col-xs-4">
                    <span>Students</span>
                </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="col-xs-4">
                <span>Welcome to your dashboard!<br>Create some students profiles, enroll them into a class and create some lessons!</span>
            </div>
                <div class="col-xs-8 text-center">
                    <div class="col-xs-4">
                        <i class="icon-lessons-icon icon-8x module-icon-teacher"></i>
                        <a class="module-button btn" href="<?php echo home_url();?>/teacher/lesson">New Lesson</a>
                    </div>
                    <div class="col-xs-4">
                        <i class="icon-classroom-icon icon-8x module-icon-teacher"></i>
                        <a class="module-button btn" href="<?php echo home_url();?>/teacher/student/overview">View Students</a>
                    </div>
                    <div class="col-xs-4">
                        <i class="icon-students-icon icon-8x module-icon-teacher"></i>
                        <a class="module-button btn" href="<?php echo home_url();?>/teacher/classrooms/overview">View Classrooms</a>
                    </div>
                </div>
          </div>
        </div>
</div>
<div id="lessons-container" class="container">
    <div class="panel panel-default">
          <div class="panel-body panel-body-heading">
            <div class="col-xs-4">
                <span class="left-title">Latest Lessons</span>
            </div> 
            <div class="col-xs-8">
                <span><?php echo 'title of the lesson'?></span>
                <!-- Graph goes here -->
            </div>
          </div>
          <div class="panel-body">
            <div class="col-xs-4 lesson-select">
                <ul>
                    <li>Name of a lesson</li>
                    <li>Another lesson</li>
                    <li>Ba da bing!</li>
                    <li>Anotehr one</li>
                    <li>Ha nice.</li>
                    <li>Name of a lesson</li>
                    <li>Another lesson</li>
                    <li>Ba da bing!</li>
                    <li>Anotehr one</li>
                    <li>Ha nice.</li>
                </ul>
            </div>
                <div class="col-xs-8 text-center">
                    <!-- Graph goes here -->
                </div>
          </div>
        </div>
</div>