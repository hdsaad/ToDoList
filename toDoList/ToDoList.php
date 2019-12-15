<?php

require_once 'app/init.php';

$itemsQuery = $db->prepare("
    SELECT id, taskName, done
    FROM items
    WHERE user=:user
    ");

$itemsQuery->execute([
    'user' => $_SESSION['user_id']
]);

$items = $itemsQuery->rowCount() ? $itemsQuery : [];

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>To Do List</title>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans|Shadows+Into+Light+Two&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="list">
            <h1 class="header">To Do List</h1>
            <?php if(!empty($items)): ?>
            <ul class="items">
                <?php foreach($items as $item): ?> 
                    <li>
                        <span class="item<?php echo $item['done'] ? ' done': '' ?>"><?php echo $item['taskName']; ?></span>
                        <?php if(!$item['done']): ?>
                            <a href="mark.php?as=done&item=<?php echo $item['id']; ?>" class="done-button">Mark as done</a>
                        <?php else: ?>
                            <a href="mark.php?as=notdone&item=<?php echo $item['id']; ?>" class="done-button">Not done</a>
                        <?php endif; ?>
                        <a href="mark.php?as=remove&item=<?php echo $item['id']; ?>" class="remove-button">Remove from List</a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php else: ?>
                <p>You have not added any tasks to complete yet.</p>
            <?php endif; ?>

            <form class="item-add" action="add.php" method="post">
                <input type="text" name="taskName" placeholder="Type your task here." class="input" autocomplete="off" required>
                <input type="submit" value="Add" class="submit">
            </form>
        </div>
    </body>
</html>