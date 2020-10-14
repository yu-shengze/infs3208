<?php 
    session_start(); 
    include('head.php'); 
    include('navbar.php');
    require_once('dbconnect.php');
    $sql = "SELECT MAX(step_number) AS stepCount FROM config_steps";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_array($result);
    $_SESSION['finalScreen']=$row['stepCount']+1;
    if ($_SESSION['currentStep']>1){
       header('Location: components.php');
    }
    
?>
    <body>
        <div class="container">
            <h1 class="text-center">Welcome <?php echo $_SESSION['firstName']; ?>!</h1>
            <h1 class="text-center">Let's begin configuring your computer</h1>
            <h2 class="text-center">First select Intel or AMD as your base platform</h2>
            <div class="btn-group btn-group-lg text-center center col-sm-6" role="group" aria-label="Chip Maker">
                <button type="button" class="btn btn-primary" id="intel">Intel</button>
                <button type="button" class="btn btn-danger" id="amd">AMD</button>
            </div>
        </div>
        <script>
            $(document).ready(function(){
                $("#intel").click(function()
                {
                    $("#amd").hide();
                    $.post("./update.php", {chipType: 'intel'});
                    
                    document.location.href="components.php";
                });
            });
            $(document).ready(function(){
                $("#amd").click(function()
                {
                    $("#intel").hide();
                    $.post("./update.php", {chipType: 'amd'});
                    document.location.href="components.php";
                });
            });
             
        </script>
    </body>
</html>