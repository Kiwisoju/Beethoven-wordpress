<div class="wrap">
    <h2 class="title">Students Overview</h2>
    <?php if($message) echo '<div class="updated notice notice-success is-dismissible"><p>'.$message.'</p></div>';?>
    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th>Edit Profile</th>
                <th>Name</th>
                <th>Class</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($students as $student): ?>
            <tr>
                <td><a href="../../student?edit=<?php echo $student['user_id'] ?>">Edit Profile</a></td>
                <td><?php echo $student['name'] ?></td>
                <td><?php echo $student['classroom'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>