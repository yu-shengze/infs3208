<?php 
session_start();
require_once('dbconnect.php');
require_once('utility.php');

$ID = intval($_GET['ID']);
$target = $_GET['target'];
$_SESSION[$target] =$ID;

$_SESSION['currentStep']+=1;

$_SESSION[$target] = $ID;
$sql = 'UPDATE user SET '.$target.' = '.$ID.', current_step='.$_SESSION['currentStep'].' WHERE id ='.$_SESSION['id'];
if (mysqli_query($connection, $sql)) {
    //echo "Record updated successfully";
 } else {
    echo "Error updating record: " . mysqli_error($connection);
 }


?>