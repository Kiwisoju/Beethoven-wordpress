<table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th class="text-uppercase">Lesson Name</th>
                <th class="text-uppercase">Type of Exercise</th>
                <th class="text-uppercase">Start Lesson</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($lessons as $lesson): ?>
            <tr>
                <td><?php echo $lesson['lesson_name'] ?></td>
                <td><?php echo $lesson['exercise_type'] ?></td>
                <td><a href="<?php echo home_url()?>/student/lessons/lesson?lesson=<?php echo $lesson['lesson_id'] ?>">Start Lesson</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
</table>