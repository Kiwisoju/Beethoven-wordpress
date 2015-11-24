<div class="wrap">
    <h2>Contact Logs</h2>
    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th scope="col" class="manage-column column-primary ">ID</th>
                <th scope="col" class="manage-column">Name</th>
                <th scope="col" class="manage-column">Email</th>
                <th scope="col" class="manage-column">Message</th>
                <th scope="col" class="manage-column">IP</th>
                <th scope="col" class="manage-column">Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($logs as $log): ?>
            <tr>
                <td><?php echo $log->id ?></td>
                <td><?php echo $log->name ?></td>
                <td><?php echo $log->email ?></td>
                <td><?php echo $log->message ?></td>
                <td><?php echo $log->ip ?></td>
                <td><?php echo $log->date ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>