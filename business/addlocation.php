
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
            $lname=$_POST['lname'];
            $lcomment=$_POST['lcomment'];
            
            //check if the area exist
            $compid = get_user_compidfk($username);
            $query = "SELECT * FROM location WHERE compidfk='$compid' AND locationname='$lname'";
            $query_run = mysqli_query($link, $query);
            if(mysqli_num_rows($query_run) == 1){
                //area already exist
                echo "<div align='center' class=\"alert alert-info\"><strong>Error: The location '{$lname}'
                already exist for this company, choose another name or change the name!</strong></div>";
            }else{
                $compid = get_user_compidfk($username);
                $query = "INSERT INTO location (locationid, locationname, compidfk, lcomment)
                            VALUES (NULL, '$lname', '$compid', '$lcomment')";
                if(mysqli_query($link, $query)){
                    echo "<div align='center' class=\"alert alert-success\"><strong>Successful inserted!</strong></div>";
                }else{
                    echo "<div align='center' class=\"alert alert-danger\"><strong>Error</strong></div>";
                }
            }
        }else{ /*echo 'All Fields are Required';*/}
        
        ?>
	<div class="container-fluid">
        <div class="row">
            <h3 align="center">Add location area</h3>
                <div class="col-md-6">
                    <div class="addstock-col">
                            <div id = "feedback"></div>
                            <form role="form" class="form-horizontal" action="" method="POST">
                            <!--<form role="form" class="form-horizontal"  action="" method="post">-->
                                
                                <div class="form-group">
                                    <label for="sname" class="col-sm-4 control-label">Name:</label>
                                    <div class="col-sm-8">
                                      <input class="form-control" name="lname" required id="goodname" type="text" placeholder="Location full name">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="aaddress" class="col-sm-4 control-label">Comment:</label>
                                    <div class="col-sm-8">
                                      <input class="form-control" required id="amount" name="lcomment" type="text"
                                             placeholder="Location comment" >
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