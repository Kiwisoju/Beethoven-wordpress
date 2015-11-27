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
                    <span>Ear Trainer</span>
                </div>
                <div class="col-xs-4">
                    <span>Results</span>
                </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="col-xs-4">
                <span>Welcome to your dashboard!<br>Click on the lessons tab to see what lessons you have waiting.</span>
            </div>
                <div class="col-xs-8 text-center">
                    <div class="col-xs-4">
                        <i class="icon-lessons-icon icon-8x module-icon-student"></i>
                        <a class="module-button btn" href="<?php echo home_url();?>/student/lessons">View Lessons</a>
                    </div>
                    <div class="col-xs-4">
                        <i class="icon-headphones icon-8x module-icon-student"></i>
                        <a class="module-button btn" href="<?php echo home_url();?>/student/eartrainer">Practice Exercises</a>
                    </div>
                    <div class="col-xs-4">
                        <i class="icon-classroom-icon icon-8x module-icon-student"></i>
                        <a class="module-button btn" href="<?php echo home_url();?>/student/lessons">View Results</a>
                    </div>
                </div>
          </div>
        </div>
</div>
<div id="lessons-container" class="container">
    <div class="panel panel-default">
          <div class="panel-body panel-body-heading">
            <div class="col-xs-4">
                <span class="left-title">Latest Results</span>
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