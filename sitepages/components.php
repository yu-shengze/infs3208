<?php
session_start();
require_once('dbconnect.php');
$curSQL = "SELECT current_step FROM user WHERE id = ".$_SESSION['id'];
$usrResult = mysqli_query($connection, $curSQL);
$usrRow = mysqli_fetch_array($usrResult);
$_SESSION['currentStep']=$usrRow['current_step'];

$sql = "SELECT MAX(step_number) AS stepCount FROM config_steps";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_array($result);
$_SESSION['finalScreen']=$row['stepCount']+1;

if($_SESSION['currentStep']>=$_SESSION['finalScreen']){
    header('Location: final.php');
}

$stepSQL = 'SELECT * FROM config_steps WHERE step_number='.$_SESSION['currentStep'];
$stepDetail = mysqli_query($connection, $stepSQL);
if (!$stepDetail) {
    printf("Error: %s\n", mysqli_error($connection));
    exit();
}
while($dtl = mysqli_fetch_array($stepDetail)){
    $heading = $dtl['heading'];
    $subheading = $dtl['subheading'];
    $target = $dtl['name'];
}

switch ($target) {
    case 'motherboard':
        $criteria = 'WHERE chipset = "'.$_SESSION['chipset'].'"'; 
        break;
    
    case 'cpu':
        $criteria = 'WHERE socket = "'.$_SESSION['cpuSocket'].'"'; 
        break;

    default:
        $criteria="";
        break;
}

$componentSQL = 'SELECT ID, name FROM '.$target.'s '.$criteria;
$component = mysqli_query($connection, $componentSQL);
if (!$component) {
    printf("Error: %s\n", mysqli_error($connection));
    exit();
}
?>
<?php include('head.php'); ?>
<?php include('navbar.php'); ?>
<script>
    function showValue(selectedID){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("details").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","getdetails.php?ID=" + selectedID + "&target=<?php echo $target ?>",true);
    xmlhttp.send();
    if (selectedID==0){
        document.getElementById("btnNext").style.display="none";
    } else {
        document.getElementById("btnNext").style.display="block";
    };
    };
    function submitValue(){
        var xmlhttp = new XMLHttpRequest();
        var selectionList = document.getElementById("selectionList");
        var selectedValue = selectionList.value;
        xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("details").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("POST","update.php?ID=" + selectedValue + "&target=<?php echo $target ?>",true);
    xmlhttp.send();
    window.location.reload();
    }

</script>
<body>
        <div class="container">

            <h1 class="text-center"><?php echo $heading ?></h1>
            <h2 class="text-center"><?php echo $subheading ?></h1>
            <form>
            <div class="dropdown show">
                <select name="selectionList" id="selectionList" onchange="showValue(this.value)">
                    <option value="0">Please select ...</option>
                    <?php while($row = mysqli_fetch_array($component)){
                        echo '<option value="'.$row['ID'].'" class="dropdown-item" href="#">'.$row['name'].'</option>';
                    }  ?>
                </select>
            </div>            
            </form>
            <div id="details">...</div>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" style="display: none" id="btnNext" onClick=submitValue()>Looks good - what's next <span class="fa  fa-arrow-right"></button>
        
<?php include('footer.php'); ?>       