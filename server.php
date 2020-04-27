<?php 

include ("connection.php");
session_start();

#REGISTER CODE...

if (isset($_POST['register'])) {
	$passwd= $_POST['pass'];
	$confirm= $_POST['conpass'];
	if ($passwd == $confirm) {
		$passwd = md5($passwd);
		$sql= "INSERT INTO users(fname, lname, sname, pass, type) VALUES ('".$_POST['fname']."','".$_POST['sname']."','".$_POST['name']."','".$passwd."','".$_POST['user']."')";
		if ($conn->query($sql) == TRUE) {
			$_SESSION['register_con'] = "Successful!";
			header("location: register.php");
			die();
		}
	}
	else{
		$_SESSION['register_fail'] = "Passwords don't match!";
		header("location: register.php");
		die();
	}
	$conn->close();
}

# ADD ITEM CODE...

if (isset($_POST['itemin'])) {
	$sql = "INSERT INTO items (item,pic,price) VALUES ('".$_POST['item']."','".$_POST['pic']."','".$_POST['price']."')";
	if ($conn->query($sql) == TRUE) {
		$_SESSION['update_con'] = "Item added successfully";
    	header("location: items.php");
		die();
	}
	else{
		$_SESSION['update_con'] = "Couldn't add Item!";
    	header("location: items.php");
		die();
	}
	$conn-> close();
}

#DELETE ITEM CODE...

if (isset($_GET['action'])) {
	$sql="DELETE FROM items WHERE item='".$_GET['name']."'";
	if ($conn->query($sql) == TRUE) {
		$_SESSION['update_con'] = "Item Deleted!";
		header("location: items.php");
		die();
	}
	else{
		$_SESSION['update_con'] = "Failed to Delete!";
		header("location: items.php");
		die();
	}
	$conn->close();
}

#EDIT VALUES CODE...

if (isset($_POST['edit'])) {
	
	$sql="UPDATE `items` SET `item`='".$_POST['item']."', `pic`='".$_POST['pic']."',`price`='".$_POST['price']."' WHERE `id`= '".$_POST['id']."'";

	$push= $conn->query($sql);
	if ($push == TRUE) {
		$_SESSION['update_con'] = "Update Successful!";
		header("location: items.php");
	}else{
		$_SESSION['update_con'] = "Update failed!";
		header("location: items.php");
	}
	$conn->close();
	die();
}

#LOGIN CODE...

if (isset($_POST['login'])) {
	$sql="SELECT * FROM users WHERE sname='".$_POST['name']."'";
	$grab = $conn->query($sql);
	if ($grab != TRUE) {
			$_SESSION['sign_in'] = "Invalid credentials!";
			header("location: login.php");
			die();
	}

	$data=$grab->fetch_assoc();
	$user=$data['type'];
	$pass=$data['pass'];
	$pass_in = $_POST['pass'];
	$pass_in = md5($pass_in);
	if (isset($pass_in) && $pass_in == $pass) {
		if ($user == "Admin") {
			$_SESSION['uid'] = $data['id'];
			$_SESSION['user'] = $data['sname'];
			$_SESSION['type'] = $user;
			header("location: items.php");
			die();
		}
		else{
			$_SESSION['user'] = $data['sname'];
			$_SESSION['type'] = $user;
			$_SESSION['uid'] = $data['id'];
			header("location: home.php");
			die();
		}
	}else{
		$_SESSION['sign_in'] = "Invalid credentials!";
		header("location: login.php");
	}
	$conn->close();
	
}

#ADD TO CART CODE...

if (isset($_GET['buy'])) {
	if (isset($_GET['id']) && $_GET['id'] == $_SESSION['uid']) {
		$sql= "INSERT INTO orders(item_id, user_id) VALUES ('".$_GET['buy']."','".$_GET['id']."')";
		$finish = $conn->query($sql);
		$_SESSION['cart'] = "Item added to cart";
		header("location: home.php");
		$conn->close();
	}
	else{
		$_SESSION['sign_in'] = "You are not logged in!";
		header("location: login.php");
	}
}

#DELETE ORDER CODE

if (isset($_GET['del_order'])) {
	$sql= "DELETE FROM orders WHERE id= '".$_GET['del_order']."'";
	$deleted = $conn->query($sql);
	$_SESSION['del_con'] = "Item removed from cart!";
	header("location: cart.php");
	$conn->close();
	die();
}

#DESTROY ORDER...

if (isset($_GET['kill_order'])) {
	$sql= "DELETE FROM orders WHERE user_id= '".$_GET['kill_order']."'";
	$deleted = $conn->query($sql);
	$_SESSION['del_con'] = "Thank you for shopping with us! <br> your order will arrive in a few minutes";
	header("location: cart.php");
	$conn->close();
	die();
}

#LOGOUT CODE...

if (isset($_GET['out'])) {
	session_destroy();
	header("location: home.php");
}

?>