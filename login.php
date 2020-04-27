<!DOCTYPE html>
<html>
<head>
	<title>login</title>
</head>
<style type="text/css">
	*{
		font-family: arial;
		font-size: 20px;
	}
	div{ border-bottom: 3px solid darkorange; margin-bottom: 20px; }
	input{
		width: auto;
		padding: 10px 20px;
	}
	#links{
		padding: 10px 15px;
		color: black;
		text-decoration: none;
		background-color: orange;
		margin: 10px;
	}
	a:hover{
		background-color: darkorange;
	}
	#btns{
		background-color: orange;
		float: right;
	}
	h1{ font-size: 50px; color: darkorange;}
	body{
		background-color: rgba(255,180,0,0.3);
	}
	form{
		width: 25%;
		margin: 0 auto;
		padding: 30px;
		border: 3px solid darkorange;
	}
</style>
<body>
	<?php include ("server.php"); ?>
	<div >
		<a href="home.php"><img src="sharks_logo.png"></a>
	</div>
	<form action="server.php" method="post">
		<h1>Login</h1>
		<label style="color: red"><?php if (isset($_SESSION['sign_in'])) {
			echo $_SESSION['sign_in'];
			unset($_SESSION['sign_in']);
			echo "<br><br>";
		} ?></label>
		<label for="name">Username:</label>
		<input type="text" name="name" id="name" required>
		<br><br>
		<label for="pass">Password:</label>
		<input type="password" name="pass" id="pass" required>
		<br><br>
		<label>Don't have an account?</label><br><br>
		<a id="links" href="register.php">Sign up</a>
		<input id="btns" type="submit" name="login" value="Login">
		<br><br>
	</form>
</body>
</html>