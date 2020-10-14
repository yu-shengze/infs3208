<?php
require_once('dbconnect.php');
$response = null;
if(isset($_POST) & !empty($_POST)){

    if($response != null && $response->success){
		$username = mysqli_real_escape_string($connection, $_POST['username']);
		$verification_key = md5($username);
		$email = mysqli_real_escape_string($connection, $_POST['email']);
		$password = md5($_POST['password']);
		$passwordCheck = md5($_POST['passwordCheck']);
		if($password == $passwordCheck){
			$fmsg = "";
			
			$usernamesql = "SELECT * FROM `user` WHERE username='$username'";
			$usernameres = mysqli_query($connection, $usernamesql);
			$count = mysqli_num_rows($usernameres);
			if($count == 1){
				$fmsg .= "Sorry - That username is taken";
			}

			$emailsql = "SELECT * FROM `user` WHERE email='$email'";
			$emailres = mysqli_query($connection, $emailsql);
			$emailcount = mysqli_num_rows($emailres);
			if($emailcount == 1){
				$fmsg .= "This email address is already registered - use the forgot username/password links to login";
			}


			echo $sql = "INSERT INTO `user` (username, email, password) VALUES ('$username', '$email', '$password')";
			$result = mysqli_query($connection, $sql);
			if($result){
				$smsg = "User Registered succesfully";
				$id = mysqli_insert_id($connection);
					
			}else{
				$fmsg .= "Failed to register user";
			}
		}else{
			$fmsg = "The passwords you have entered don't match - please try again";
		}
	}
}
?>
<?php include('head.php'); ?>


<body>
    <div class="container">
        <?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
        <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
        <form class="forms-signin" method="POST">
            <h2 class="form-signin-heading">Signup Form</h2>

            <input type="text" name="username" id="username" class="form-control" placeholder="Username"
                value="<?php if(isset($username) & !empty($username)){ echo $username; } ?>" required>
            <span id="usernameCheck"></span>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password"
                required>
            <label for="inputPassword" class="sr-only">Retype Password</label>
            <input type="password" name="passwordCheck" id="inputPassword" class="form-control"
                placeholder="Please type your password again" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
            <a class="btn btn-lg btn-primary btn-block" href="login.php">Login</a>
        </form>
    </div>
<?php include('footer.php'); ?>