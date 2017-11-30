<?php
ob_start();    

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


if(is_loggedin()){
    if((reporter_logincheck() || basic_user_logincheck())){
        header('Location: ../business/dashboard.php');
    }
}else{ header('Location: ../resource/index.php'); }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Stocker | <?php  /*from header2.php */echo $compname; /*from login*//*$role = $_SESSION['role'];*/ ?> | Sales</title>
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
            <h3 align="center">Add new sale</h3>
            <!--<div class="row">-->
                <div class="col-md-6">
                    <div class="addstock-col">
                            <div id = "feedback"></div>
                            <form role="form" class="form-horizontal" action="" method="POST">
                            <!--<form role="form" class="form-horizontal"  action="" method="post">-->
                                
                                    <?php
                                    if(isset($_POST['submit'])){
                                        //$compid = get_user_compidfk($username);
                                        //$areaid = get_user_compareaidfk($username);
                                        $uname=$_POST['uname'];
                                        //This hold the areaid
                                        $areaid=$_POST['aname'];
                                        $umobile=$_POST['umobile'];
                                        $uemail=$_POST['uemail'];
                                        $jdate = date('d/m/Y');
                                        $ldate = '';
                                        $urole=$_POST['urole'];
                                        //fetch sold item info from stock
                                        $compid = get_user_compidfk($username);
                                        $areaid = get_user_compareaidfk($username);
                                        $query=$link->query("SELECT * FROM user WHERE email='$uemail' AND mobile='$umobile' AND compidfk='$compid' AND compareaidfk='$areaid'");
                                        if($query->num_rows == 1){
                                            $row = $query -> fetch_assoc();
                                            //user already exist
                                            echo "<div style='color: red;' align=\"center\">User already exist!</div>";
                                            
                                        }else{
                                            //user does not exist
                                            if($query=$link->query("INSERT INTO user(userid, fullname, role, mobile, compidfk, joindate, lastseen, email, compareaidfk)
                                                                VALUES (NULL, '$uname', '$urole', '$umobile', '$compid', '$jdate', '$ldate', '$uemail', '$areaid')")){
                                                echo "Success";
                                                $query=$link->query("SELECT * FROM login WHERE username='$uemail'");
                                                if($query->num_rows == 1){
                                                    //user already exist, perhaps with another company
                                                    //user need to be removed from the database or he should delete his self
                                                    //i will come back to this
                                                }else{
                                                    //user does not exist in login table, insert his details
                                                    if($query=$link->query("INSERT INTO login (loginid, username, password)
                                                                    VALUES (NULL, '$uemail', '$uemail')")){
                                                    echo "<div class=\"alert alert-success\"><p>User added successful!</p></div>";
                                                    }else{
                                                        //failed to insert into login
                                                        echo "Login Error";
                                                    }
                                                }
                                                
                                            }else{
                                                //failed to insert into user
                                                echo "Error";
                                            }
                                            
                                        }
                            
                                    }else{ /*echo 'All Fields are Required';*/}
                            
                                    //Update daily
                                    
                                    ?>
                                
                                <div class="form-group">
                                    <label for="sname" class="col-sm-4 control-label">Name:</label>
                                    <div class="col-sm-8">
                                      <input class="form-control" name="uname" required id="inumber" onkeyup="amount();" type="text" placeholder="New users/employees full name">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="slocation" class="col-sm-4 control-label">Area:</label>
                                    <div class="col-sm-8">
                                        <select name="aname" class="form-control">
                                            <?php  ?>
                                                    <option>select area/branch</option>
                                                <?php
                                                //$compname = get_comp_name(get_user_compidfk($username), $username);
                                                $compid = get_user_compidfk($username);
                                                $areaid = get_user_compareaidfk($username);
                                                $query=$link->query("SELECT areaid, areaname FROM area WHERE compidfk ='$compid' AND areaid='$areaid'");
                                                if($query->num_rows > 0){
                                                    while ($row = $query -> fetch_assoc()) { /*$_SESSION['smodel']=$row['stockmodel'];*/ ?>
                                                        <option  value="<?php echo $row['areaid']; ?>" ><?php echo $row['areaname']; ?></option>
                                                    <?php    
                                                    }
                                                }
                                                ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <!--<label for="sname" class="col-sm-4 control-label">Item model:</label>
                                    <div class="col-sm-8">
                                      <input class="form-control" name="aname" required id="goodname"   type="text" placeholder="item model">
                                    </div>-->
                                </div>
                                
                                <div class="form-group">
                                    <label for="aaddress" class="col-sm-4 control-label">Mobile:</label>
                                    <div class="col-sm-8">
                                      <input class="form-control" required id="iprice" name="umobile" onkeyup="amount();"  min="0" type="number"
                                             placeholder="Users phone number"/>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="aaddress" class="col-sm-4 control-label">Email:</label>
                                    <div class="col-sm-8" id="">
                                      <input class="form-control" required  name="uemail" type="email"
                                             placeholder="email: uses as username and password">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="aaddress" class="col-sm-4 control-label">Role:</label>
                                    <div class="col-sm-8">
                                      <!--<input class="form-control" id="icomment" name="urole" type="text"
                                             placeholder="Write a comment about the user.">-->
                                      <select class="form-control" name="urole">
                                        <option>Select user role</option>
                                        <option>Manager</option>
                                        <option>Basic User</option>
                                        <option>Reporter</option>
                                      </select>
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
           <!-- </div>-->
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
<script>
function amount(){
    var x;
    x = document.getElementById("inumber").value;
    var y = document.getElementById("iprice").value;
    var z = x * y;
    document.getElementById("iamount").innerHTML=z;
}
</script>

<?php
ob_end_flush();
?>