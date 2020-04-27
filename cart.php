<!DOCTYPE html>
<html>
<head>
	<title>Sharks Shop</title>
	<link rel="icon" type="image/png" href="sharks_icon.png">
	<style type="text/css">
		*{
			font-family: arial;
			font-size: 20px;
		}
		body{
			background-color: rgba(255,180,0,0.3);
		}
		h1{ font-size: 50px; color: darkorange;}
		h2{ font-size: 30px; color: white}
		a{ padding: 20px 30px; color: white; text-decoration: none;}
		a:hover{ padding: 20px 30px; color: white; text-decoration: none; background-color: rgba(255,140,0,0.5);}
		.back_top{ background-image: url(food_wall.jpg); background-size: cover;}
		.maincard{
			background-color: rgba(0,0,0,0.6);
			padding: 3% 10%;
			width: 80%;
		}
		.nav{
			border-bottom: 3px solid darkorange;
			width: 100%;
			display: inline-block;
		}
		.nav ul{
			float: right;
		}
		.nav ul li{
			display: inline-block;
		}
		input{
			padding: 10px 30px;
			width: 400px;
		}
		.active{
			background-color: orange;
			padding: 20px 20px;
			border-radius: 10px;
		}
		.top_flow{
			padding: 50px;
			text-align: center;
			margin: 0 auto;
			width: 70%;
		}
		.top_flow table{
			width: 80%;
			border: 4px solid darkorange;
			text-align: center;
			margin: 0 auto;
		}
		table tr th,td{ border-bottom: 3px solid darkorange; }
		.top_flow img{
			width: 100px;
		}
		.top_flow a{
			margin: 10px;
			background-color: orange;
		}
		.contacts{
			background-color: orange;
			text-align: center;
			width: 100%;
		}
		.contacts div{
			width: 25%;
			display: inline-grid;
		}
		.contacts input{
			width: 200px;
		}
		#submit_feed{ width: auto; }
		.contacts img{
			width: 10%;
		}
	</style>
</head>
<body>
	<?php include("connection.php");
	include ("server.php"); ?>
<div class="back_top">
	<div class="maincard">
		<div class="nav">
			<a href=""><img src="sharks_logo.png"></a>
			<ul>
				<li><a href="home.php">Home</a></li>
				<li class="active"><a href="">Cart</a></li>
				<?php if (isset($_SESSION['user'])) :?>
				<li><a href="server.php?out=y">logout: <?php echo $_SESSION['user']; ?></a></li>
				<?php else : ?>
				<li><a href="login.php">login/register</a></li>
			<?php endif; ?>
			</ul>
		</div>
	</div>
</div>
	<div class="top_flow">

		<?php 
		if (isset($_SESSION['del_con'])) {
			echo "<h1>".$_SESSION['del_con']."<h1>";
			unset($_SESSION['del_con']);
		}
		if (isset($_SESSION['user'])) {
			echo "<h1>Order Details</h1>";
			echo "<table><tr><th colspan='2'>item</th><th>price</th></tr>";
			$user = $conn->query("SELECT * FROM users WHERE sname= '".$_SESSION['user']."'");
			$row = $user->fetch_assoc();
			$id = $row['id'];
			$orders = $conn->query("SELECT * FROM orders WHERE user_id='".$id."'");
			$total = 0;
			while ($myrow = $orders->fetch_assoc()) {
				$grabb = $conn->query("SELECT * FROM items WHERE id='".$myrow['item_id']."'");
				$item = $grabb->fetch_assoc();
				echo "<tr><td><img src=\"".$item['pic']."\"></td><td>".$item['item']."</td><td>Ksh. ".$item['price']."</td><td><a href='server.php?del_order=".$myrow['id']."'>REMOVE</a></td></tr>";
				$total = $total + $item['price'];
			}
			echo "<tr><th colspan='2'>Total </th><th>Ksh. ".$total."</th><tr>";
			echo "</table><br><br><br><a href='server.php?kill_order=".$id."'>FINISH ORDER</a><a href='home.php'>CONTINUE SHOPPING</a>";

		}
		else{
			$_SESSION['sign_in'] = "You are not logged in!";
			header("location: login.php");
		}
		?>
	</div>
	<div class="contacts">
		<div>
			<h2>contacts</h2>
			<ul>
				<li>Email: info@sharksonlineshop.com</li>
				<li>Tel: 088632-4544532-76523</li>
				<li>Address: 765432-6541232 </li>
			</ul>
			<h2>about us</h2>
			<p>Sharks online shop has everything you need from the best hotels and restaurants you could think of all around the continent. Most importantly our flexible and broad transport facilities will ensure you get your order as soon as possible anywhere anytime. Don't be left out!</p>
		</div>
		<div>
			<h2>supporters</h2>
			<ul>
				<li>Sikia Fine Dining</li>

				<li>Bonds Garden Restaurant</li>
				<li>Road House Grill</li>
				<li>The Lord Erroll</li>
				<li>Tamarind Restaurant</li>
				<li>Tatu Restaurant</li>
				<li>The Talisman</li>
			</ul>
		</div>
		<div>
			<h2>feedback</h2>
			<p>tell us how you feel about our services</p>
			<form>
				<input type="text" name="feedback" required>
				<input type="submit" name="feed" value="send" id="submit_feed">
			</form>
			<a target="_blank" href="https://www.facebook.com"><img src="facebook.png"></a><label>facebook.com</label>
			<a target="_blank" href="https://www.instagram.com"><img src="instagram.png"></a><label>instagram.com</label>
			<a target="_blank" href="https://www.twitter.com"><img src="twitter.png"></a><label>twitter.com</label>
			
		</div>
	</div>
</body>
</html>