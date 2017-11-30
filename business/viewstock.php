<?php
//This help to view available stock on the stock table
?>


<?php
ob_start(); 
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
	<!--<main>-->
	<div class="container-fluid">
        <!--<div class="row">-->
			<h3 align="center">View stock</h3>
                    <br/>
                    <form action="" class="form-inline" method="POST">
                        <!--<div class="form-group">-->
                        <!--    <label for="sname" class="control-label">From:</label>-->
                        <!--    <input class="form-control fromdate" name="from" required id="fromdate" onkeyup="amount();" type="text" placeholder="dd/mm/yyyy">-->
                        <!--</div>-->
                        
                        <!--<div class="form-group">-->
                        <!--    <label for="sname" class="control-label">To:</label>-->
                        <!--    <input class="form-control todate" name="to" required id="todate" onkeyup="amount();" type="text" placeholder="dd/mm/yyyy">-->
                        <!--</div>-->
                        
                        <!--<div class="form-group">-->
                            <!--<label for="sname" class="control-label">Item number:</label>-->
                        <!--    <input class="form-control" name="submit" required id="submit" onkeyup="amount();" type="submit" value="View sales">-->
                        <!--</div>-->
                        
                    </form>
            <br>
            
            <?php
            $output = '';
                if(isset($_POST["submit"]) and isset($_POST['from']) and isset($_POST['to'])){
                    //if(isset($_POST['from']) and isset($_POST['to'])){
                        $from = $_POST['from'];
                        $to = $_POST['to'];
                        
                        $query = "SELECT * FROM stock WHERE areaidfk='$areaid'";
                }elseif(!isset($_POST["submit"]) and !isset($_POST['from']) and !isset($_POST['to'])){
                    $todate = date('d/m/Y');
                    $query = "SELECT * FROM stock WHERE areaidfk='$areaid'";
                }
                        $result = mysqli_query($link, $query);
                        
                        //echo mysqli_num_rows($result);
                        $output = '
                        <table class="table table-bordered">
                            <tr>
                                <th>S/N</th>
                                <th>Number</th>
                                <th>Name</th>
                                <th>Model No</th>
                                <th>Cost</th>
                                <th>Amount</th>
                                <th>Comments</th>
                            </tr>
                        ';
                        $samount = $snum = $tprofit = $scost = $count = 0;

                        while($row = mysqli_fetch_array($result))
                        {
                            $count += 1;
                         $output .= '
                            <tr>
                                <td>'.$count.'</td>
                                <td>'.$row["stocktotal"].'</td>
                                <td>'.$row["stockname"].'</td>
                                <td>'.$row["stockmodel"].'</td>
                                <td>'.$row["stockcost"].'</td>
                                <td>'.$row["stockamount"].'</td>
                                <td>'.$row["stockcomment"].'</td>
                            </tr>
                         ';
                         
                         $scost += $row["stockcost"];
                         $snum += $row["stocktotal"];
                         $samount += $row["stockamount"];
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
                        $output .= '
                            
                            <tr>
                                <td><strong>'.$count.'</strong></td>
                                <td><strong>'.$snum.'</strong></td>
                                <td><strong>XXXXXX</strong></td>
                                <td><strong>XXXXXX</strong></td>
                                <td><strong>'.$scost.'</strong></td>
                                <td><strong>'.$samount.'</strong></td>
                                <td><strong>XXXXXX</strong></td>
                            </tr>
                            
                         ';
                        $output .= '</table>';
                        if(isset($from)){
                            echo "<div align='center'> {$count} items found {$from} to {$to}</div>";
                        }else{
                            
                          echo "<div align='center'> {$count} items found for {$todate} </div>";  
                        }
                        
                        echo "<div style='overflow-y: scroll;'>{$output}</div>";
                    
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
        <script>

        </script>
	<!--
	This file is together with the footers' contents 
		<script src="jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
	-->
</footer>

</body>
</html>
<?php
ob_end_flush();
?>