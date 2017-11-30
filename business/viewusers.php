<?php
include '../connection/connect.php';
session_start();
include '../resource/logincheck.php';
if(is_loggedin()){ }else{ header('Location: ../resource/index.php'); }
//search the folder(function) and include all file in there.
foreach(glob('../function/*.php') as $filename){
    include $filename;
}
/*from login.php*/$username = $_SESSION['username'];
//used in header2.php, dashboared title
$compname = get_comp_name(get_user_compidfk($username), $username);
$fullname = get_user_name($username);
$areaid = get_user_compareaidfk($username);
$compid = get_user_compidfk($username)

?>



<!DOCTYPE html>
<html>
<head>
	<title>Stocker | <?php  /*from header2.php */echo $compname; /*from login*//*$role = $_SESSION['role'];*/ ?> | View Users</title>
    <?php include '../resource/head.php'; ?>
</head>
<body>
<!-- Navigation menu, website name, search form, login and sign-up form -->
	<header>
		<?php include '../resource/header.php'; ?>
	</header>
	<!-- Homepage body/content/main container -->
	<!--<main>-->
	<div class="container-fluid ">
        <!--<div class="row">-->
			<h3 align="center">View users</h3>
                    <br/>
                    <form action="" class="form-inline" method="POST">
                        <div class="form-group">
                            <label for="sname" class="control-label">Area:</label>
                            <select name="uarea" class="form-control">
                                <?php  ?>
                                        <option>select area</option>
                                    <?php
                                    $query=$link->query("SELECT areaid, areaname FROM area WHERE compidfk='$compid'");
                                    if($query->num_rows > 0){
                                        while ($row = $query -> fetch_assoc()) { ?>
                                            <option  value="<?php echo $row['areaid']; ?>" ><?php echo $row['areaname']; ?></option>
                                        <?php    
                                        }
                                    }
                                    ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <!--<label for="sname" class="control-label">Item number:</label>-->
                            <input class="form-control" name="submit" required id="submit" onkeyup="amount();" type="submit" value="View users">
                        </div>
                        
                    </form>
            <br>
            
            <?php
            $output = '';
                if(isset($_POST["submit"]) and isset($_POST['uarea'])){
                        $uarea = $_POST['uarea'];
                        $areaname = get_areaname($uarea);
                        $query = "SELECT * FROM user WHERE compareaidfk='$uarea' AND compidfk='$compid'";
                }elseif(!isset($_POST["submit"]) and !isset($_POST['uarea'])){
                    //$todate = date('d/m/Y');
                    $query = "SELECT * FROM user WHERE compidfk = '$compid'";
                }
                        $result = mysqli_query($link, $query);
                        
                        //echo mysqli_num_rows($result);
                        $output = '
                        <table class="table table-bordered  ">
                            <tr>
                                <th>S/N</th>
                                <th>Full Name</th>
                                <th>Role/Status</th>
                                <th>Mobile No</th>
                                <th>Company</th>
                                <th>Date Registered</th>
                                <th>Email</th>
                            </tr>
                        ';
                        $tamount = $tnum = $tprofit = $tprice = $count = 0;

                        while($row = mysqli_fetch_array($result))
                        {
                            
                            $count += 1;
                         $output .= '
                            <tr>
                                <td>'.$count.'</td>
                                <td>'.$row["fullname"].'</td>
                                <td>'.$row["role"].'</td>
                                <td>'.$row["mobile"].'</td>
                                <td>'.$row["compidfk"].'</td>
                                <td>'.$row["joindate"].'</td>
                                <td>'.$row["email"].'</td>
                            </tr>
                         ';
                         
                         //$tprice += $row["itemprice"];
                         //$tnum += $row["itemnum"];
                         //$tamount += $row["itemamount"];
                         //$tprofit  += $row["itemprofit"];
                        }
                       
                        $output .= '
                            
                            <tr>
                                <td><strong>------</strong></td>
                                <td><strong>------</strong></td>
                                <td><strong>------</strong></td>
                                <td><strong>------</strong></td>
                                <td><strong>------</strong></td>
                                <td><strong>------</strong></td>
                                <td><strong>------</strong></td>
                            </tr>
                            
                         ';
                        //$output .= '
                        //    
                        //    <tr>
                        //        <td><strong>'.$count.'</strong></td>
                        //        <td><strong>'.$tnum.'</strong></td>
                        //        <td><strong>XXXXXX</strong></td>
                        //        <td><strong>XXXXXX</strong></td>
                        //        <td><strong>'.$tprice.'</strong></td>
                        //        <td><strong>'.$tamount.'</strong></td>
                        //        <td><strong>'.$tprofit.'</strong></td>
                        //        <td><strong>XXXXXX</strong></td>
                        //        <td><strong>XXXXXX</strong></td>
                        //    </tr>
                        //    
                        // ';
                        $output .= '</table>';
                        if(isset($areaname)){
                            echo "<div align='center'> {$count} users found for {$areaname} area</div>";
                        }else{
                            
                          echo "<div align='center'> {$count} users found for all areas</div>";  
                        }
                        
                        //echo $output;
                        echo "<div>{$output}</div>";
                    
                //}
                
            ?>
        </div>
	<!--</main>-->
	<footer>
        <script>
var x = new Date();
x=x.getDate();

var y = new Date();
y=y.getFullYear();

var z = new Date();
z=z.getMonth();

w=x+"/"+z+"/"+ y;
document.getElementById("demo").innerHTML = w;
</script>
        <?php include '../resource/footer.php'; ?>
        <?php $date = date("Y/m/d"); ?>
        </script>
        <!--<script src="../js/viewsales.js"></script>-->

</footer>

</body>
</html>
