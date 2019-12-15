<?php 

require_once 'app/init.php';

if(isset($_GET['as'], $_GET['item'])) {
    $as = $_GET['as'];
    $item = $_GET['item'];

    switch($as){
        case 'done':
            $doneQuery = $db->prepare("
            UPDATE items
            SET done = 1
            WHERE  id = :item
            AND user = :user
            ");

            $doneQuery->execute([
                'item' => $item,
                'user' => $_SESSION['user_id']
            ]);
        break;

        case 'notdone':
            $notdoneQuery = $db->prepare("
            UPDATE items
            SET done = 0
            WHERE  id = :item
            AND user = :user
            ");

            $notdoneQuery->execute([
                'item' => $item,
                'user' => $_SESSION['user_id']
            ]);
        break;

        case 'remove':
            $removeQuery = $db->prepare("
            DELETE FROM items
            WHERE id = :item
            AND user = :user
            ");

            $removeQuery->execute([
                'item' => $item,
                'user' => $_SESSION['user_id']
            ]);
        break;
    }
}

header('Location: ToDoList.php')

?>