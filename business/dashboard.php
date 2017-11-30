<?php
include '../connection/connect.php';
session_start();
include '../resource/logincheck.php';
//search the folder(function) and include all file in there.
foreach(glob('../function/*.php') as $filename){
    include $filename;
}

/*from login.php*/$username = $_SESSION['username'];
//used in header2.php, dashboared title
$compname = get_comp_name(get_user_compidfk($username), $username);

/*from login.php*/$username = $_SESSION['username'];

$fullname = get_user_name($username);

if(is_loggedin()){ }else{ header('Location: ../resource/index.php'); }

?>

<!DOCTYPE html>
<html>
<head>
    <title>Stocker | <?php  /*from header2.php */echo $compname; /*from login*//*$role = $_SESSION['role'];*/ ?></title>
    <?php include '../resource/head.php'; ?>
</head>
<body>
	<!-- Navigation menu, website name, search form, login and sign-up form -->
	<header>
		<?php include '../resource/header.php'; ?>
	</header>
    
	
	<!-- Homepage body/content/main container -->
	<main>
	<div class="container-fluid">
		<div class="row">
			
			<!--<div class="col-md-2">
			<div class="dashboard-col1">
				<h1>side bar</h1>
				<?php /*echo get_user_name('y@y.com');*/  ?>
				<p>
				Bootstrap is the most popular HTML, CSS, and JavaScript
				framework for developing responsive, mobile-first web sites.
				Bootstrap is completely free to download and use!
				</p>
			</div>
			</div>-->
			
			<div class="col-md-12">
			<div class="dashboard-col2">
				<h1>Stocker</h1>
				<p>
				<?php echo "Welcome, {$fullname} to your company ({$compname}) dashboard!" ?>
				</p>
                <p>This website is a book keeping system for your business.</p>
                <p>Note that this is on beta stage. Report any error found while using this website!</p>
				<p>
				To get started:
                <ol>
                    <li>Add a supplier</li>
                    <li>Add a stock:</li>
                    <ol>
                        <li>Select a supplier</li>
                        <li>Enter the total number of the item sold</li>
                        <li>Enter the name of the item</li>
                        <li>Enter the model of the item</li>
                        <li>Enter the cost. This is the amount you sold the item</li>
                        <li>The amount will be automatically determined</li>
                        <li>Enter comment concerning the goods/item sold</li>
                    </ol>
                </ol>
				</p>
			</div>
			</div>
		</div>
	</div>
	</main>

	<footer>
		<?php include '../resource/footer.php'; ?>
	<!--
	This file is together with the footers' contents 
		<script src="jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
	-->
	</footer>
    
</body>
</html>
<?php

?>