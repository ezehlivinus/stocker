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
if(is_loggedin()){ }else{ header('Location: ../resource/index.php'); }
?>

<?php



?>

<!DOCTYPE HTML>
<html>
<head>
	<title>Stocker | <?php  /*from header2.php */echo $compname; /*from login*//*$role = $_SESSION['role'];*/ ?> | Stock</title>
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
			<h3>Add new stock</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="addstock-col">
                            <div id = "feedback"></div>
                            <div role="form" class="form-horizontal">
                            <!--<form role="form" class="form-horizontal"  action="" method="post">-->
                                <div class="form-group">
                                    <label for="invoice_number" class="col-sm-4 control-label">Receipt (Invoice) Number:</label>
                                    <div class="col-sm-8">
                                      <input class="form-control" required id="invoice_number" name="invoice_number" min="0" type="number" placeholder="Enter the invoice number" >
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="number" class="col-sm-4 control-label">Number:</label>
                                    <div class="col-sm-8">
                                      <input class="form-control" required id="number" name="number" type="text" placeholder="Total number for each item/good: 5" >
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="goodname" class="col-sm-4 control-label">Name:</label>
                                    <div class="col-sm-8">
                                      <input class="form-control" required id="goodname" type="text" placeholder="Goods name. e.g: Nokia">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="model" class="col-sm-4 control-label">Model:</label>
                                    <div class="col-sm-8">
                                      <input class="form-control" required id="model" name="model" type="text" placeholder="Goods model number. e.g: 1200" />
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="cost" class="col-sm-4 control-label">Cost:</label>
                                    <div class="col-sm-8">
                                      <input class="form-control" required id="cost" name="cost" type="text" placeholder="The unit cost of the good">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="amount" class="col-sm-4 control-label">Amount:</label>
                                    <div class="col-sm-8">
                                      <input class="form-control" required id="amount" name="amount" type="number"
                                             placeholder="This will be calculated for you" disabled >
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="comment" class="col-sm-4 control-label">Comments:</label>
                                    <div class="col-sm-8">
                                      <input class="form-control" id="comment" name="comment" type="text" >
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="submit" class="col-sm-4 control-label"></label>
                                    <div class="col-sm-8">
                                      <input class="form-control" id="submit" type="submit" name="submit" onclick = "insert();" value="Submit" >
                                    </div>
                                </div>
                                
                            <!--</form>-->	
                            </div>
                    </div>
                </div>

			
            
            
                <div class="col-md-6">
                    <div class="addstock-col">
                        <p>
                        Bootstrap is the most popular HTML, CSS, and JavaScript
                        framework for developing responsive, mobile-first web sites.
                        Bootstrap is completely free to download and use!
                        </p>
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
        <script src="../js/addstock.js"></script>
        <script src="../js/amount.js"></script>
		<?php include '../resource/footer.php'; ?>
	<!--
	This file is together with the footers' contents 
		<script src="jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
	-->
	</footer>
    
</body>
</html>
