
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
            $aname=$_POST['aname'];
            $alocation=$_POST['alocation'];
            //$smobile=$_POST['smobile'];
            $aaddress=$_POST['aaddress'];
            //$scomment=$_POST['scomment'];
            //mysqli_real_escape_string($link, $invoice_num[$count])

            //check if the area exist
            $query = "SELECT * FROM area WHERE locationidfk='$alocation' AND areaname='$aname'";
            $query_run = mysqli_query($link, $query);
            if(mysqli_num_rows($query_run) == 1){
                //area already exist
                echo "<div align='center' class=\"alert alert-info\"><strong>Error: The area '{$aname}' already exist on this company, choose another name!</strong></div>";
            }else{
                $compid = get_user_compidfk($username);
                $query = "INSERT INTO area (areaid, areaname, compidfk, locationidfk, areaaddress)
                            VALUES (NULL, '$aname', '$compid', '$alocation', '$aaddress')";
                if(mysqli_query($link, $query)){
                    echo "<div align='center' class=\"alert alert-success\"><strong>Successful inserted!</strong></div>";
                }else{
                    echo "<div align='center' class=\"alert alert-danger\"><strong>Error</strong>E</div>";
                }
            }
        }else{ /*echo 'All Fields are Required';*/}
        
        ?>
	<div class="container-fluid">
        <div class="row">
            <h3 align="center">Add new area</h3>
                <div class="col-md-6">
                    <div class="addstock-col">
                            <div id = "feedback"></div>
                            <form role="form" class="form-horizontal" action="" method="POST">
                            <!--<form role="form" class="form-horizontal"  action="" method="post">-->
                                
                                <div class="form-group">
                                    <label for="sname" class="col-sm-4 control-label">Name:</label>
                                    <div class="col-sm-8">
                                      <input class="form-control" name="aname" required id="goodname" type="text" placeholder="Area full name">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="slocation" class="col-sm-4 control-label">Location:</label>
                                    <div class="col-sm-8">
                                        <select name="alocation" class="form-control">
                                            <?php  ?>
                                                    <option>select location</option>
                                                <?php
                                                //$compname = get_comp_name(get_user_compidfk($username), $username);
                                                $compid = get_user_compidfk($username);
                                                $query=$link->query("SELECT locationid, locationname FROM location WHERE compidfk ='$compid'");
                                                if($query->num_rows > 0){
                                                    while ($row = $query -> fetch_assoc()) { ?>
                                                        <option  value="<?php echo $row['locationid']; ?>" ><?php echo $row['locationname']; ?></option>
                                                    <?php    
                                                    }
                                                }
                                                ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="aaddress" class="col-sm-4 control-label">Address:</label>
                                    <div class="col-sm-8">
                                      <input class="form-control" required id="amount" name="aaddress" type="text"
                                             placeholder="Area address" >
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