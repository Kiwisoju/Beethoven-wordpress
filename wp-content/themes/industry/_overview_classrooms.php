<div class="wrap">
    <h2 class="title">Classrooms Overview</h2>
    <?php if($message) echo '<div class="updated notice notice-success is-dismissible"><p>'.$message.'</p></div>';?>
    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th>Edit</th>
                <th>Name</th>
                <th>Number of Students</th>
                <th>Number of Lessons</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($classrooms as $classroom): ?>
            <tr>
                <td><a href="../../classrooms?edit=<?php echo $classroom['class_name'] ?>">Edit Classroom</a></td>
                <td><?php echo $classroom['class_name'] ?></td>
                <td><?php echo $classroom['number_of_students'] ?></td>
                <td><?php echo $classroom['number_of_lessons'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>