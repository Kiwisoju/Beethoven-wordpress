<?php
    die(var_dump($studentResults));
?>

<div class="wrap" id="results-overview">
    <h2 class="title"><?php echo $_GET['lesson_name'][0]->lesson_name ?> Results</h2>
    <span><?php echo 'names' ?> Score - <?php echo $results['score']?>/<?php echo count($results) - 2?></span>
    
    <div class="table-container">
        <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th class="text-uppercase">Answer</th>
                <th class="text-uppercase">Students Answer</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($results as $result): ?>
            <tr>
                <td><?php echo $result['answer'] ?></td>
                <td><?php echo $result['studentAnswer'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>