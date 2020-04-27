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
		.intro{
			padding: 50px;
			text-align: center;
			margin: 0 auto;
			width: 50%;
		}input{
			padding: 10px 20px;
			width: 300px;
		}
		body{
			background-color: rgba(255,180,0,0.3);
		}
		.active{
			background-color: orange;
			padding: 20px 20px;
			border-radius: 10px;
		}
		#search_button{
			width: auto;
			background-color: orange;
		}
		.top_flow{
			text-align: center;
			margin: 0 auto;
			width: 80%;
		}
		.top_flow div{
			padding: 40px;
			display: inline-grid;
			width: 20%;
			text-align: center;
		}
		.top_flow img{
			width: 100%;
			height: 180px;
		}
		.top_flow a{
			background-color: orange;
		}
		.contacts{
			padding: 10px;
			background-color: orange;
			text-align: center;
			width: 100%;
		}
		.contacts div{
			width: 25%;
			text-align: left;
			margin-left: 100px;
			display: inline-grid;
		}
		.contacts input{
			width: 180px;
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
				<li class="active"><a href="">Home</a></li>
				<li><a href="cart.php">Cart</a></li>
				<?php if (isset($_SESSION['user'])) :?>
				<li><a href="server.php?out=y">logout: <?php echo $_SESSION['user']; ?></a></li>
				<?php else : ?>
				<li><a href="login.php">login/register</a></li>
			<?php endif; ?>
			</ul>
		</div>
		<div class="intro">
			<?php $_SESSION['welcome'] = "" ?>
			<h1>Sharks Online Shop</h1>
			<h2>Sharks Shop Online is here to satisfy your taste and diet at the comfort of your living room. All you need to do is scroll, select your desired meal and it will be right at your doorstep ASAP! </h2>
			<form action="home.php" method="post">
				<input type="text" name="search" id="search_box" placeholder="Search your taste..." required>
				<input type="submit" name="search_button" id="search_button" value="search">
			</form>
		</div>
	</div>
</div>
	<div class="top_flow">

		<?php 
		if (isset($_SESSION['user'])) {
			$user = $conn->query("SELECT * FROM users WHERE sname= '".$_SESSION['user']."'");
			$row = $user->fetch_assoc();
			$id = $row['id'];
		}

		#NOTIFICATION FOR ADDED ITEMS..

		if (isset($_SESSION['cart'])) {
			echo "<h2 style='background-color: lightgreen;padding: 20px;'>".$_SESSION['cart']."</h2>";
			unset($_SESSION['cart']);
		}

		#SEARCH DIV.....

		if (isset($_POST['search'])) :
			$result = $conn->query("SELECT * from items where item LIKE '%".$_POST['search']."%'");
			
			echo "<h1>Search Results</h1>";
			while($item = $result->fetch_assoc()) :
			echo "<div><img src='".$item['pic']."'>";
		 ?>
		 <p><?php echo $item['item']; ?></p>
		 <br>
		 <a href="server.php?buy=<?php echo $item['id'] ?>&id=<?php echo $id; ?>">BUY <br>Ksh: <?php echo $item['price']; ?>.00/= <s>tax</s></a>
		 <br>
		</div>
		<?php endwhile; else :
		
		#DISPLAY PRODUCTS...

		 ?>
		<h1>Products</h1>
		<?php 
		$sql = "SELECT * FROM items";
		$grab = $conn->query($sql);

		while ($pic = $grab->fetch_assoc()) :
			echo "<div><img src='".$pic['pic']."'>";
		 ?>
		 <p><?php echo $pic['item']; ?></p>
		 <br>
		 <a href="server.php?buy=<?php echo $pic['id'] ?>&id=<?php echo $id; ?>">BUY <br>Ksh: <?php echo $pic['price']; ?>.00/= <s>tax</s></a>
		 <br>
		 </div>
		<?php endwhile; endif;
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