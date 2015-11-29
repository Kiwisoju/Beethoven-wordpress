<div class="wrap">
    <h2 class="title">Lessons Overview</h2>
    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th>Lesson Name</th>
                <th>Classroom</th>
                <th>Type of Exercise</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($lessons as $lesson): ?>
            <tr>
                <td><?php echo $lesson['lesson_name'] ?></td>
                <td><?php echo $lesson['classroom_name'] ?></td>
                <td><?php echo $lesson['exercise_type'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>