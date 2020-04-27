<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
</head>
<style type="text/css">
	*{
		font-family: arial;
		font-size: 20px;
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
	div{ border-bottom: 3px solid darkorange; margin-bottom: 20px; }
	input,select{
		width: auto;
		padding: 10px 20px;
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
		<h1>Register</h1>
		<label style="color: green"><?php if (isset($_SESSION['register_con'])) {
			echo $_SESSION['register_con']."<br><br>";
			unset($_SESSION['register_con']);
		} ?></label>
		<label style="color: red"><?php if (isset($_SESSION['register_fail'])) {
			echo $_SESSION['register_fail']."<br><br>";
			unset($_SESSION['register_fail']);
		} ?></label>
		<label for="fname">First Name:</label>
		<input type="text" name="fname" required>
		<br>
		<br>
		<label for="sname">Second Name:</label>
		<input type="text" name="sname" required>
		<br>
		<br>
		<label for="name">User Name:</label>
		<input type="text" name="name" required>
		<br><br>
		<label for="pass">Password:</label>
		<input type="password" name="pass" required>
		<br><br>
		<label for="conpass">Confirm Password:</label>
		<input type="password" name="conpass" required>
		<br><br>
		<label for="user">User Type:</label>
		<select name="user">
			<option>Customer</option>
			<option>Admin</option>
		</select>
		<br><br><br>
		<a id="links" href="login.php">Login</a>
		<input id="btns" type="submit" name="register" value="REGISTER">
		<br>
		<br>
	</form>
</body>
</html>