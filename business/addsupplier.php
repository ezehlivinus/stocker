
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
$fullname = get_user_name($username);
if(is_loggedin()){ }else{ header('Location: ../resource/index.php'); }
?>

<!DOCTYPE html>
<html>
<head>
	<!--<title>Stocker | <?php  /*from header2.php */echo $compname; /*from login*//*$role = $_SESSION['role'];*/ ?> | Stock</title>-->
    <?php include '../resource/head.php'; ?>
</head>
<body>
<!-- Navigation menu, website name, search form, login and sign-up form -->
	<header>
		<?php include '../resource/header.php'; ?>
	</header>
	<!-- Homepage body/content/main container -->
	<main>
        <?php

        if(isset($_POST['submit'])){
            $sname=$_POST['sname'];
            $slocation=$_POST['slocation'];
            $smobile=$_POST['smobile'];
            $saddress=$_POST['saddress'];
            $scomment=$_POST['scomment'];
            $mycompid=get_user_compidfk($username);
            //mysqli_real_escape_string($link, $invoice_num[$count]);
            $query = "INSERT INTO supplier (suppid, suppname, supplocation, suppmobile, suppaddress, scomment, compidfk)
                        VALUES (NULL, '$sname', '$slocation', '$smobile', '$saddress', '$scomment', '$mycompid')";
            if(mysqli_query($link, $query)){
                echo "<div align='center' class=\"alert alert-success\"><strong>Successful inserted!</strong></div>";
            }else{
                echo "<div align='center' class=\"alert alert-danger\"><strong>Error</strong>E</div>";
            }
        }else{ /*echo 'All Fields are Required';*/}
        
        ?>
	<div class="container-fluid">
        <div class="row">
            <h3 align="center">Add new supplier</h3>
                <div class="col-md-6">
                    <div class="addstock-col">
                            <div id = "feedback"></div>
                            <form role="form" class="form-horizontal" action="" method="POST">
                            <!--<form role="form" class="form-horizontal"  action="" method="post">-->
                                
                                <div class="form-group">
                                    <label for="sname" class="col-sm-4 control-label">Name:</label>
                                    <div class="col-sm-8">
                                      <input class="form-control" name="sname" required id="goodname" type="text" placeholder="Suppleir full name">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="slocation" class="col-sm-4 control-label">Location:</label>
                                    <div class="col-sm-8">
                                      <input class="form-control" required id="model" name="slocation" type="text" placeholder="Supplier location: Lagos" />
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="smobile" class="col-sm-4 control-label">Mobile:</label>
                                    <div class="col-sm-8">
                                      <input class="form-control" required id="cost" name="smobile" type="number" placeholder="Supplier mobile phone number">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="saddress" class="col-sm-4 control-label">Address:</label>
                                    <div class="col-sm-8">
                                      <input class="form-control" required id="amount" name="saddress" type="text"
                                             placeholder="Shop address" >
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="comment" class="col-sm-4 control-label">Comments:</label>
                                    <div class="col-sm-8">
                                      <input class="form-control" id="comment" name="scomment" placeholder="Other info related to the supplier" type="text" >
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="submit" class="col-sm-4 control-label"></label>
                                    <div class="col-sm-8">
                                      <input class="form-control" id="submit" type="submit" name="submit" value="Submit" >
                                    </div>
                                </div>
                                
                            <!--</form>-->	
                            </form>
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
        <?php include '../resource/footer.php'; ?>
        </script>
        <script src="../js/addstock3.js"></script>
	<!--
	This file is together with the footers' contents 
		<script src="jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
	-->
</footer>

</body>
</html>


		
        <!--<script src="../js/addstock2.js"></script>-->