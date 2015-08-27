<?php
session_start();
if(isset($_SESSION["sess_user"])){
	header("location:home.php");
}
	$Err = '';
			
	if(isset($_POST["submit"])){

		if(!empty($_POST['user']) && !empty($_POST['pass'])) {
			$user=$_POST['user'];
			$pass=$_POST['pass'];

			$con=mysqli_connect('lean.mk','mktour@lean.mk','mktour123mktour!@','mktour'); 

			$query=mysqli_query($con,"SELECT * FROM Korisnik WHERE username='".$user."' AND password='".$pass."'");
			
			$numrows=mysqli_num_rows($query);
			
			if($numrows!=0)
			{	
				while($row=mysqli_fetch_assoc($query))
				{
					$dbusername=$row['username'];
					$dbpassword=$row['password'];
				}

				if($user == $dbusername && $pass == $dbpassword)
				{
					session_start();
					$_SESSION['sess_user'] = $user;
					//redirect
					header("Location: home.php");
				}
			} 
			else {
				$Err = "Incorrect username or password.";
			}

		} 
		else {
			$Err = "Please fill all fields.";
		}
	}
	?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="js/prefixfree.min.js"></script>
    <style>
    @import url(http://fonts.googleapis.com/css?family=Exo:100,200,400);
    @import url(http://fonts.googleapis.com/css?family=Source+Sans+Pro:700,400,300);
    body {
        /*  margin: 0;
    padding: 0;
    background: #fff;
    color: #fff;
    font-family: Arial;
    font-size: 12px;*/
    }
    .body {
        /*  position: absolute;
/*  top: -20px;
    left: -20px;
    right: -20px;
    bottom: -20px;*/
        width: 100%;
        height: 100%;
        background: url('./images/login-bg.jpg') no-repeat center center fixed;
        background-size: cover;
        -webkit-filter: blur(3px);
        z-index: 0;
        */ background: url('../images/login-bg.jpg') center center;
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        min-height: 360px;
        z-index: 0;
        background-size: cover;
        background-attachment: fixed;
        text-align: center;
    }
    .grad {
        /*position: absolute;*/
        /*  top: -20px;
    left: -20px;
    right: -40px;
    bottom: -40px; */
        /*width: 100%;*/
        height: 100%;
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgba(0, 0, 0, 0)), color-stop(100%, rgba(0, 0, 0, 0.65)));
        /* Chrome,Safari4+ */
        z-index: 1;
        opacity: 0.7;
    }
    .login {
        position: absolute;
        top: calc(50% - 75px);
        left: calc(50% - 150px);
        height: 40%;
        width: 35%;
        padding: 10px;
        z-index: 2;
    }
    .login input[type=text] {
        width: 250px;
        height: 30px;
        background: transparent;
        border: 1px solid rgba(255, 255, 255, 0.6);
        border-radius: 2px;
        color: #fff;
        font-family: 'Exo', sans-serif;
        font-size: 16px;
        font-weight: 400;
        padding: 4px;
    }
    .login input[type=password] {
        width: 250px;
        height: 30px;
        background: transparent;
        border: 1px solid rgba(255, 255, 255, 0.6);
        border-radius: 2px;
        color: #fff;
        font-family: 'Exo', sans-serif;
        font-size: 16px;
        font-weight: 400;
        padding: 4px;
        margin-top: 10px;
    }
    .login input[type=submit] {
        width: 260px;
        height: 35px;
        background: #fff;
        border: 1px solid #fff;
        cursor: pointer;
        border-radius: 2px;
        color: #a18d6c;
        font-family: 'Exo', sans-serif;
        font-size: 16px;
        font-weight: 400;
        padding: 6px;
        margin-top: 10px;
    }
    .login input[type=submit]:hover {
        opacity: 0.8;
    }
    .login input[type=submit]:active {
        opacity: 0.6;
    }
	.login input[type=button] {
        width: 260px;
        height: 35px;
        background: #fff;
        border: 1px solid #fff;
        cursor: pointer;
        border-radius: 2px;
        color: #a18d6c;
        font-family: 'Exo', sans-serif;
        font-size: 16px;
        font-weight: 400;
        padding: 6px;
        margin-top: 10px;
    }
    .login input[type=button]:hover {
        opacity: 0.8;
    }
    .login input[type=button]:active {
        opacity: 0.6;
    }
    .login input[type=text]:focus {
        outline: none;
        border: 1px solid rgba(255, 255, 255, 0.9);
    }
    .login input[type=password]:focus {
        outline: none;
        border: 1px solid rgba(255, 255, 255, 0.9);
    }
    .login input[type=submit]:focus {
        outline: none;
    }
	.login input[type=button]:focus {
        outline: none;
    }
    ::-webkit-input-placeholder {
        color: rgba(255, 255, 255, 0.6);
    }
    ::-moz-input-placeholder {
        color: rgba(255, 255, 255, 0.6);
    }
    .account {
        color: #fff;
        margin-top: 13px;
        margin-bottom: -8px;
        font-family: Arial;
        font-size: 10px
    }
	.error {
		font-family: 'Exo', sans-serif;
        font-size: 16px;
        font-weight: 400;
		color:red;
	}
    </style>
</head>
<body>
    <div class="body"></div>
    <div class="grad"></div>
    <br>
    <div class="login">
		<form action="" method="POST">
			<input type="text" placeholder="username" name="user">
			<br>
			<input type="password" placeholder="password" name="pass">
			<br>
			<input type="submit" value="Login" name="submit">
			
			<div class="account">Don't have an account?</div>
			<a href="signup.php">
				<input type="button" value="Sign Up">
			</a>
		</form>
		<br>
		<span class="error"><?php echo $Err; ?></span>
	</div>
    <script src='http://codepen.io/assets/libs/fullpage/jquery.js'></script>
</body>
</html>
