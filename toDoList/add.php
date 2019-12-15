<?php

require_once 'app/init.php';

if(isset($_POST['taskName'])) {
    $taskName = trim($_POST['taskName']);

    if(!empty($taskName)) {
        $addedQuery = $db->prepare("
        INSERT INTO items (taskName, user, done, created)
        VALUES (:taskName, :user, 0, NOW())
        ");

        $addedQuery->execute([
            'taskName' => $taskName,
            'user' => $_SESSION['user_id']
        ]);
    }
}

header('Location: ToDoList.php');

?>