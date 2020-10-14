<?php
$connection = mysqli_connect('127.0.0.1', 'web', '0dWK9fp%wgFN');
if (!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, 'website');
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($connection));
}
?>