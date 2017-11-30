<?php
	include '../connection/connect.php';
session_start();
include '../resource/logincheck.php';
//search the folder(function) and include all file in there.
foreach(glob('../function/*.php') as $filename){
    include $filename;
}
if(is_loggedin()){
	/*from login.php*/$username = $_SESSION['username'];
//used in header2.php, dashboared title
$compname = get_comp_name(get_user_compidfk($username), $username);
$fullname = get_user_name($username);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Stocker</title>
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
			
			<!--div class="col-md-2">side bar
			<div class="col1">
				<p>
				Bootstrap is the most popular HTML, CSS, and JavaScript
				framework for developing responsive, mobile-first web sites.
				Bootstrap is completely free to download and use!
				</p>
			</div>
			</div -->
			
			<div class="col-md-12">
			<div class="col2">
				<h1>Stocker</h1>
				<p>
				Bootstrap is the most popular HTML, CSS, and JavaScript
				framework for developing responsive, mobile-first web sites.
				Bootstrap is completely free to download and use!
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