<?php 
    session_start(); 
    include('head.php'); 
    include('navbar.php');
    require_once('dbconnect.php');
    $curSQL = "SELECT * FROM user WHERE id = ".$_SESSION['id'];
    $usrResult = mysqli_query($connection, $curSQL);
    $usrRow = mysqli_fetch_array($usrResult);

    $mbSQL = 'SELECT * FROM motherboards WHERE ID = '.$usrRow['motherboard'];
    $mbResult = mysqli_query($connection, $mbSQL);
    $mbRow = mysqli_fetch_array($mbResult);

    $cpuSQL = 'SELECT * FROM cpus WHERE ID = '.$usrRow['cpu'];
    $cpuResult = mysqli_query($connection, $cpuSQL);
    $cpuRow = mysqli_fetch_array($cpuResult);
?>
<body>
    <div class="container">
        <h1 class="text-center">Congratulations, you have reached the end!</h1>
        <h1 class="text-center">Here is the parts list to build your computer</h1>
        <hr>
        <br />
        <h3>Motherboard: <?php echo $mbRow['name'] ?></h3>
        <h3>CPU: <?php echo $cpuRow['name'] ?></h3>
        
    </div>

<?php include('footer.php'); ?>  