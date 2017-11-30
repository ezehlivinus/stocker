<?php
ob_start();
	//Login users into to the system
	include '../connection/connect.php';
	session_start();
	include '../resource/logincheck.php';
	//search the folder(function) and include all file in there
foreach(glob('../function/*.php') as $filename){
    include $filename;
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
	<div class="container">
    <?php
        //Check if a user entered something from ../resource/header.php
		if(!isset($_POST['email']) || !isset($_POST['password'])){

			echo ("<div class=\"alert alert-info login-sign-error\"><strong>Login error!</strong> Please enter your login details to continue</div>");

		}else{

			$username = $_POST['email'];
			$password = $_POST['password'];
			//This contains the necessary code that logs user-in
			include '../resource/loginscript.php';
			
		}
    ?>
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

<?php ob_end_flush(); ?>