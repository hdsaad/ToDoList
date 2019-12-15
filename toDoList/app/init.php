<?php

session_start();

$_SESSION['user_id'] = 1;

$db = new PDO('mysql:dbname=toDoList;host=localhost', 'root', '');

//Handle this in another way later
if(!isset($_SESSION['user_id']))
{
    die('You are not logged in.');
}
