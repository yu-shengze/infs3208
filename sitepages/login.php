<?php 
session_start();
require_once('dbconnect.php');

if(isset($_POST) & !empty($_POST)){
	$username = mysqli_real_escape_string($connection, $_POST['username']);
	$password = $_POST['password'];
	$sql = "SELECT * FROM `user` WHERE username='$username' AND password='$password'";
	
	$result = mysqli_query($connection, $sql);
	$returnedUsers = mysqli_num_rows($result);

	if($returnedUsers == 1){
		while($row = mysqli_fetch_array($result)){
			$_SESSION['id'] = $row['id'];
			$_SESSION['username'] = $username;
			$_SESSION['firstName'] = $row['firstName'];
			$_SESSION['currentStep'] = is_null($row['current_step']) ? 1 : $row['current_step'];			
			$_SESSION['chipset'] = is_null($row['chipset']) ? "" : $row['chipset'];
			$_SESSION['motherboard'] = is_null($row['motherboard']) ? 0 : $row['motherboard'];
			if($_SESSION['motherboard']>0){
				$mbSQL = 'SELECT * FROM motherboards WHERE ID = '.$_SESSION['motherboard'];
				$mbResult = mysqli_query($connection, $mbSQL);
				$mbRow =mysqli_fetch_array($mbResult);
				$_SESSION['cpuSocket']=$mbRow['socket'];
			}
			$_SESSION['cpu'] = is_null($row['cpu']) ? 0 : $row['cpu'];

		}		
		$successMessage="logged in";
		$failMessage=null;
		// echo 'at step '.$_SESSION['currentStep'];
		// echo 'chipset: '.$_SESSION['chipset'];
		// echo 'motherboard: '.$_SESSION['motherboard'];
		header('location: components.php');
	}else{
		$successMessage=null;
		$failMessage = "Incorrect Login Details - please try again";
	}
  }
  ?>
<?php include('head.php'); ?>
<?php include('navbar.php'); ?>
<body>
	<div class="container">
		<form class="loginForm" method="POST">
			<?php if(isset($successMessage)){ ?><div class="alert alert-success" role="alert"> <?php echo $successMessage; ?> </div><?php } ?>
			<?php if(isset($failMessage)){ ?><div class="alert alert-danger" role="alert"> <?php echo $failMessage; ?> </div><?php } ?>
			<h2 class="form-signin-heading">Please Login</h2>
			<label for="username"></span>Login:</label>
			<input type="text" name="username" class="form-control" placeholder="Username" required>
			<label for="password">Password</label>
			<input type="password" name="password" id="loginPassword" class="form-control" placeholder="Password" required>
			<button class="btn btn-lg btn-primary btn-block" type="submit">Login <span class="fa fa-sign-in-alt"></button>
			<a class="btn btn-lg btn-primary btn-block" href="signup.php">Sign-up <span class="fa fa-clipboard-list"></a>
		</form>
	</div>
<?php include('footer.php'); ?>