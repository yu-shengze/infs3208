<?php
session_start();
require_once('dbconnect.php');
$ID = intval($_GET['ID']);
$target = $_GET['target'];
$_SESSION[$target] =$ID;

echo 'target is '.$target.' value is '.$ID;

$sql = 'SELECT * FROM '.$target.'s WHERE id='.$ID;

try {
    $result = mysqli_query($connection, $sql);
    while($row = mysqli_fetch_array($result)){
        if ($target=='motherboard'){
            $_SESSION['cpuSocket'] = $row['socket'];
        }
        echo $row['details'];
    }

}
catch(PDOException $e) {
	echo getMessage();
	die();
}
echo "";
?>