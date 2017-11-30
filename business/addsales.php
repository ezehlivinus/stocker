
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


if(is_loggedin()){ }else{ header('Location: ../resource/index.php'); }
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
        <?php

        if(isset($_POST['submit'])){
            $inumber=$_POST['inumber'];
            //This hold the item/stockid
            $stockid=$_POST['iname'];
            //$stockid=$_POST['stockid'];
            $iprice=$_POST['iprice'];
            $iamount = $inumber * $iprice;
            $idate = date('d/m/Y');
            $icomment=$_POST['icomment'];
            //$scomment=$_POST['scomment'];
            //mysqli_real_escape_string($link, $invoice_num[$count])
            
            //fetch sold item info from stock
            
            $areaid = get_user_compareaidfk($username);
            $query=$link->query("SELECT * FROM stock WHERE stockid='$stockid' AND '$areaid'");
            if($query->num_rows == 1){
                $row = $query -> fetch_assoc();
                $sid=$row['stockid'];
                $stotal=$row['stocktotal'];
                $iname=$row['stockname'];
                $imodel=$row['stockmodel'];
                $stockcost=$row['stockcost'];
                $stockamount=$row['stockamount'];
                $compid=$row['compidfk'];
                if(!($inumber > $stotal)){
                    $compid = get_user_compidfk($username);
                    $userid= get_user_userid($username);
                    $iprofit=$stockcost-$iprice;
                    $query = "INSERT INTO item (itemid, itemnum, itemname, itemmodel, itemprice, itemamount, itemprofit, itemdate, itemcomment, useridfk, compidfk, areaidfk)
                            VALUES (NULL, '$inumber', '$iname', '$imodel', '$iprice', '$iamount', '$iprofit', '$idate', '$icomment', '$userid', '$compid', '$areaid')";
                    if(mysqli_query($link, $query)){
                        
                        //ones success, then proceed and subtract the item from stock
                        //$query = "SELECT * FROM stock WHERE stockid='$stockid' AND areaidfk='$areaid'";
                        $new_stotal=$stotal-$inumber;
                        $update="UPDATE stock SET stocktotal='$new_stotal' WHERE stockname='$iname' AND stockmodel='$imodel' AND compidfk='$compid' AND areaidfk='$areaid'";
                        if(mysqli_query($link, $update)){
                            //successful subtracted
                            
                            //delete a stock whos number==0
                            $query=$link->query("SELECT * FROM stock WHERE stockid='$stockid' AND '$areaid'");
                            if($query->num_rows == 1){
                                $row = $query -> fetch_assoc();
                                $sid=$row['stockid'];
                                $sstotal=$row['stocktotal'];
                                if($sstotal==0){
                                    $del="DELETE FROM stock WHERE stockid='$sid' AND compidfk='$compid' AND areaidfk='$areaid'";
                                    mysqli_query($link, $del);
                                }else{}
                            }
                            
                            echo "<div align='center' class=\"alert alert-success\"><strong>Successful sold!</strong></div>";
                        }
                    }else{
                        echo 'Error';
                    }
            }else{ echo "<div align='center' class=\"alert alert-success\"><strong>We only have {$stotal} of '{$iname} {$imodel}' currently!</strong></div>"; }
                
            }
            
            
            
            //check if the area exist
            //$query = "SELECT * FROM area WHERE locationidfk='$alocation' AND areaname='$aname'";
            //$query_run = mysqli_query($link, $query);
            //if(mysqli_num_rows($query_run) == 1){
            //    //area already exist
            //    echo "<div align='center' class=\"alert alert-info\"><strong>Error: The area '{$aname}' already exist on this company, choose another name!</strong></div>";
            //}else{
            //    $compid = get_user_compidfk($username);
            //    $query = "INSERT INTO area (areaid, areaname, compidfk, locationidfk, areaaddress)
            //                VALUES (NULL, '$aname', '$compid', '$alocation', '$aaddress')";
            //    if(mysqli_query($link, $query)){
            //        echo "<div align='center' class=\"alert alert-success\"><strong>Successful inserted!</strong></div>";
            //    }else{
            //        echo "<div align='center' class=\"alert alert-danger\"><strong>Error</strong>E</div>";
            //    }
            //}
        }else{ /*echo 'All Fields are Required';*/}
        
        
        //Update daily
        
        ?>
	<div class="container-fluid">
        <div class="row">
            <h3 align="center">Add new sale</h3>
            <!--<div class="row">-->
                <div class="col-md-6">
                    <div class="addstock-col">
                            <div id = "feedback"></div>
                            <form role="form" class="form-horizontal" action="" method="POST">
                            <!--<form role="form" class="form-horizontal"  action="" method="post">-->
                                <div class="form-group">
                                    <label for="sname" class="col-sm-4 control-label">Item number:</label>
                                    <div class="col-sm-8">
                                      <input class="form-control" name="inumber" required id="inumber" onkeyup="amount();" type="text" placeholder="number of items sold">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="slocation" class="col-sm-4 control-label">Item name/model:</label>
                                    <div class="col-sm-8">
                                        <select name="iname" class="form-control">
                                            <?php  ?>
                                                    <option>select item</option>
                                                <?php
                                                //$compname = get_comp_name(get_user_compidfk($username), $username);
                                                $compid = get_user_compidfk($username);
                                                $areaid = get_user_compareaidfk($username);
                                                $query=$link->query("SELECT stockid, stockname, stockmodel FROM stock WHERE areaidfk ='$areaid'");
                                                if($query->num_rows > 0){
                                                    while ($row = $query -> fetch_assoc()) { $_SESSION['smodel']=$row['stockmodel']; ?>
                                                        <option  value="<?php echo $row['stockid']; ?>" ><?php echo $row['stockname']." ".$row['stockmodel']; ?></option>
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
                                    <label for="aaddress" class="col-sm-4 control-label">Cost:</label>
                                    <div class="col-sm-8">
                                      <input class="form-control" required id="iprice" name="iprice" onkeyup="amount();" type="text"
                                             placeholder="Area address" >
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="aaddress" class="col-sm-4 control-label">Amount:</label>
                                    <div class="col-sm-8" id="iamount">
                                      <!--<input class="form-control" required  name="aaddress" disabled type="text"
                                             placeholder="amount" >-->
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="aaddress" class="col-sm-4 control-label">Comment:</label>
                                    <div class="col-sm-8">
                                      <input class="form-control" id="icomment" name="icomment" type="text"
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
            <!--</div>-->
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