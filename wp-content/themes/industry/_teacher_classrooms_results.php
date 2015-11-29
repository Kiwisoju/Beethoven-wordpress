<div class="wrap" id="results-overview">
    <h2 class="title"><?php echo $_GET['classroom'] .' '?> Results</h2>
    
    <div class="table-container"><?php
    if(!$lessons):?>
    <span>This classroom has no lessons!</span><br><br>
    
    <div>
        <a class="btn primary-button" href="<?php echo home_url('/')?>teacher/lesson">Create a Lesson</a>
    </div><?php
    else:?>
        <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th class="text-uppercase">Student Name</th>
                <?php foreach($lessons as $lesson): ?>
                <th class="text-uppercase"><?php echo $lesson['lesson_name'] ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach($results as $student):?>
            <tr>
                <td><?php echo $student['student_name']?></td>
                <?php foreach($student['score'] as $score): ?>     
                <td><?php echo $score['answer'] . $score['number_of_questions'] ?></td>
                <?php endforeach; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif;?>
</div>