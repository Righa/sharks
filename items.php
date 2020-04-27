<!DOCTYPE html>
<html>
<head>
	<title>Admin Dashboard</title>
	<style type="text/css">
		*{
			font-family: arial;
			font-size: 20px;
		}
		tr td,th{
			border-left: 3px solid darkorange;
			border-bottom: 3px solid darkorange;
			padding: 10px 20px;
		}
		img{
			height: 200px;
			width: 250px;
		}
		body{
		background-color: rgba(255,180,0,0.3);
		}
		a{
			padding: 10px 15px;
			color: white;
			text-decoration: none;
			background-color: orange;
			margin: 10px;
		}
		a:hover{
			background-color: darkorange;
		}
		li{
			display: inline-block;
		}
		#logo{ background-color: rgba(0,0,0,0); height: 100px; }
		#logo:hover{ background-color: rgba(0,0,0,0); }
		.nav{
			width: 100%;
			border-bottom: 3px solid darkorange;
		}
		.actions{
			text-align: center;
			padding: 90px;
			float: left;
			display: inline-grid;
			max-width: 25%;
		}
		input{
			width: auto;
			padding: 10px 20px;
		}
		.menu{
			margin-left: 20px;
			padding: 10px 50px;
			text-align: center;
			border-left: 3px solid darkorange;
			width: 50%;
			float: left;
		}
		table{
			width: 100%;
			border-right: 3px solid darkorange;
			border-top: 3px solid darkorange;
		}
		.path{
			max-width: 300px;
		}
		#btns{
			background-color: orange;
		}
		.pages{
			padding-bottom: 90px;
		}
		.pages a{
			border-radius: 100px;
			padding: 5px 10px;
			font-size: 20px;
		}
		.editform{
			width: 90%;
			padding: 20px;
			border: 3px solid darkorange;
		}
	</style>
</head>
<body>
	<!--include for confirmation messages -->
	<?php include ("server.php");	 ?>
	
		<div class="nav">
			<ul>
				<li><a id="logo" href=""><img id="logo" src="sharks_logo.png"></a></li>
				<li style="float: right;"><a href="server.php?out=y">logout</a></li>
				<li style="float: right;"><?php 
				if (isset($_SESSION['user']) && isset($_SESSION['type']) && $_SESSION['type'] == "Admin") :
					echo "Logged in as : ".$_SESSION['user'];
				 ?></li>
			</ul>
		</div>

	<div class="actions">

		<?php 
		if (isset($_SESSION['update_con'])) {
			echo "<label style=\"background-color: lightgreen; padding: 20px;color: black ;\">".$_SESSION['update_con']."</label><br><br>";
			unset($_SESSION['update_con']);
		}
		if (isset($_GET['edit'])) :

 		?>

		<br>
		<br>
	</form>
		<form class="editform" action="server.php" method="post">
			<input type="text" name="id" value="<?php echo $_GET['edit']; ?>" readonly>
			<br><br>
			<label>Food-Item:</label>
			<input type="text" name="item" value="<?php echo $_GET['name']; ?>" required>
			<br><br>
			<label>Upload image:</label>
			<input class="path" type="file" name="pic" required>
			<br><br>
			<label>Price:</label>
			<input type="text" name="price" value="<?php echo $_GET['price']; ?>" required>
			<br><br>
			<input type="submit" name="edit" id="btns" value="EDIT">
		</form>

		<?php else : ?>

		<form class="editform" action="server.php" method="post">
			<label>Food-Item:</label>
			<input type="text" name="item" required>
			<br><br>
			<label>Upload image:</label>
			<input class="path" type="file" name="pic" required>
			<br><br>
			<label>Price:</label>
			<input type="text" name="price" required>
			<br><br>
			<input type="submit" name="itemin" id="btns" value="Add Item">
		</form>
	<?php endif; ?>
		<br>
	</div>
	<div class="menu">
		<form action="items.php" method="post">
			<input type="text" name="search" placeholder="search..."><input type="submit" id="btns" name="submit" value="Go">
		</form>
		<?php 
		include("connection.php");
		
		# SEARCH RESULTS... 

		if (isset($_POST['search']) && $_POST['search'] != NULL) {
			$result = $conn->query("SELECT * from items where item LIKE '%".$_POST['search']."%'");
			echo "<h2>Search results;</h2><table>";
			while($item = $result->fetch_assoc()){
				echo "<tr><td><img src=\"".$item["pic"]."\"></td><td>".$item["item"]."</td><td>".$item["price"]."</td><td><a href='server.php?action=delete &name=".$item["item"]."'>delete</a><br><br><a href='items.php?edit=".$item["id"]." &price=".$item["price"]." &name=".$item["item"]."'>edit</a></td></tr>";
			}
		}
		echo "</table><br>";

		?>

		<!-- MENU TABLE... -->


	<h1 align="center" >MENU</h1>
	<table>

		 <tr><th colspan="2">Item</th><th>Price</th><th>Action</th></tr> <!-- TABLE HEAD (COLSPAN = COLUMN SPAN) -->

		<?php

		$page_cap = 5; # PAGE CAPACITY

		 # GET CURRENT PAGE...

		 if (!isset($_GET['page'])) {
		 	$current_page = 1;
		 }else{
		 	$current_page = $_GET['page'];
		 }

		 # SETTING LIMITS FOR QUERY...

		$start_limit = ($current_page-1) * $page_cap;

		# LIL CATCHING TO AVOID NULL TABLES AND ERRORS...

		if ($start_limit < 0) {
			$start_limit = 0;
		}

		# GETTING LENGTH OF ARRAY...

		$grabb=$conn->query("SELECT * from items");
		 
		$result_cap = mysqli_num_rows($grabb);
		 
		# LIMITED SELECT AND DISPLAY...

		$grabb=$conn->query("SELECT * from items LIMIT ".$start_limit.",".$page_cap);

		while ($item = $grabb->fetch_assoc()) {
			echo "<tr><td><img src=\"".$item["pic"]."\"></td><td>".$item["item"]."</td><td>".$item["price"]."</td><td><a href=\"server.php?action=delete &name=".$item["item"]."\">delete</a><br><br><a href='items.php?edit=".$item["id"]." &name=".$item["item"]." &price=".$item["price"]."'>edit</a></td></tr>";
		 } 

		 # DISPLAY PAGE NUMBER ...
		 echo "</table> <div class='pages'><br> page ".$current_page;
		 $pages = ceil($result_cap / $page_cap);

		 $prev = $current_page - 1;
		 $next = $current_page + 1;

		 # MORE CATCHING TO AVOID NEXT AND PREV BUTTON MALFUNCTION...

		 if ($next > $pages) {
		 	$next = $pages;
		 }
		 if ($prev < 1) {
		 	$prev = 1;
		 }
		

		 #DISPLAY PAGES...

		 echo "<a href=\"items.php?page=1\"> &lt&ltfirst </a>";
		 echo "<a href=\"items.php?page=". $prev. "\"> &ltprev </a>";
		 for($page = 1; $page <= $pages; $page++){
		 	echo "<a href=\"items.php?page=". $page. "\"> ". $page. " </a>";
		 }
		 echo "<a href=\"items.php?page=". $next. "\"> next> </a>";
		 echo "<a href=\"items.php?page=". $pages. "\"> last>> </a>";

		 $conn->close();

		 ?>
		</div>
		<?php  
		else:
			header("location: home.php");
		endif

			?>
</div>
</body>
</html>