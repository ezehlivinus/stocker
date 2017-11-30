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

?>

<?php
if(isset($_POST["submit"]))
{

    $invoice_num = $_POST["invoice_num"];
    $good_num = $_POST["good_num"];
    $good_name = $_POST["good_name"];
    $good_model = $_POST["good_model"];
    
    $good_cost = $_POST["good_cost"];
    //$good_amount = $_POST["good_amount"];

    $good_date = date("d/m/Y");
    //$good_date = $good_date;
    //$g=$good_date;
    $good_comment = $_POST["good_comment"];
    $_POST['suppid'];
    $suppidfk = $_POST['suppid'];
    $areaidfk = get_user_compareaidfk($username);

    $query = "";
    for($count = 0; $count< (sizeof($good_cost)); $count++)
    {

        
        $good_num_clean = mysqli_real_escape_string($link, $good_num[$count]);
        $good_name_clean = mysqli_real_escape_string($link, $good_name[$count]);
        $good_model_clean = mysqli_real_escape_string($link, $good_model[$count]);
        //echo (sizeof($invoice_num));
        $good_cost_clean = mysqli_real_escape_string($link, $good_cost[$count]);
        //$good_amount_clean = mysqli_real_escape_string($link, $good_amount[$count]);
        $good_amount_clean = $good_num_clean * $good_cost_clean;
        //echo $good_date_clean = mysqli_real_escape_string($link, $good_date[$count]);
        $good_comment_clean = mysqli_real_escape_string($link, $good_comment[$count]);
        $date=$good_date;
        //$good_date = $good_date[$count];
        //$good_date=mysqli_real_escape_string($link, $good_date[$count]);

        if($good_num_clean != '' && $good_name_clean != '' && $good_model_clean != ''
           && $good_amount_clean != '')
        {
            
            //for suppliegood table
            $invoice_num_clean = mysqli_real_escape_string($link, $invoice_num);
            $query .= "
            INSERT INTO suppliedgood (supgudid, invoicenum, supgudnum, supgudname, supgudmodel, supgudcost, supgudamount, suppidfk, supguddate, areaidfk, supgudcomment) 
            VALUES (NULL, '$invoice_num_clean', '$good_num_clean', '$good_name_clean', '$good_model_clean',
            '$good_cost_clean', '$good_amount_clean', '$suppidfk', '$date', '$areaidfk', '$good_comment_clean'); 
            ";
            
            //for stock
            
            $compid = get_user_compidfk($username);
            //get_location_id($compid, $locationname);
            $getlocation = "SELECT * FROM area WHERE areaid='$areaidfk' AND compidfk='$compid'";
            if($getlocation_run = mysqli_query($link, $getlocation)){
                $row=mysqli_fetch_array($getlocation_run);
                $locationidfk=$row['locationidfk'];
            }
            
            //before insertion check for existence
            $stockexist="SELECT * FROM stock WHERE stockname='$good_name_clean' AND stockmodel='$good_model_clean' AND compidfk='$compid' AND areaidfk='$areaidfk' AND locationidfk='$locationidfk'";
            if($stockexist_run=mysqli_query($link, $stockexist)){
                if(mysqli_num_rows($stockexist_run) == 1){
                    //get the total stock number of the specified goods
                    $stockcount = mysqli_fetch_array($stockexist_run);
                    $number = $stockcount['stocktotal']."<br/>";
                    //$good_num_clean;
                    echo $good_num_clean += $number."<br/>"; //new number of available stock
                    //stock exist. update the number of the particular stock
                    $update="UPDATE stock SET stocktotal='$good_num_clean' WHERE stockname='$good_name_clean' AND stockmodel='$good_model_clean' AND compidfk='$compid' AND areaidfk='$areaidfk' AND locationidfk='$locationidfk'";
                    mysqli_query($link, $update);
                }else{
                    //else insert
                    //echo $good_num_clean;
                    $squery = "INSERT INTO stock (stockid, stocktotal, stockname, stockmodel, stockcost, stockamount, compidfk, areaidfk, locationidfk, stockcomment)
                    VALUES (NULL, '$good_num_clean', '$good_name_clean', '$good_model_clean', '$good_cost_clean', '$good_amount_clean', '$compid', '$areaidfk', '$locationidfk', '$good_comment_clean')";
                    mysqli_query($link, $squery);
                }
            }else{ echo 'error'; } 
            
        }
        
           
    } 
    
     if($query != "")
        {
            if(mysqli_multi_query($link, $query))
            {
                echo 'Item Data Inserted';
            }
            else
            {
                echo 'Error';
            }
        }
        else
        {
            echo 'All Fields are Required';
        }
}
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
			<h3 align="center">Add new stock</h3>
                    <br/>
            <div class="row">
                        <div class="col-md-6">
                        <p>Hello</p>
                        </div>
                <div class="col-md-6">
                    
                    <form role="form" class="form-horizontal" action="" method="POST">
                       <div class="form-group col-sm-10">
                         <?php echo $good_date = "<div align=\"left\" >Date (dd/mm/yyyy): ".date("d/m/Y"). "</div>"; ?>
                       </div>
                        <div class="form-group col-sm-10">
                            <select class="form-control" name ="suppid">
                                <option>select the supplier</option>
                            <?php
                            $compid = get_user_compidfk($username);
                            $query=$link->query("SELECT suppname, suppid FROM supplier WHERE compidfk='$compid'");
                            if($query->num_rows > 0){
                                while ($row = $query -> fetch_assoc()) { ?>
                                    <option  value="<?php echo $row['suppid']; ?>" ><?php echo $row['suppname']; ?></option>
                                <?php    
                                }
                            }
                            ?>
                         </select>
                        </div>
                <div id="stock_div">        
                     <div class="form-group col-sm-10">
                     <input type="text" name="invoice_num" id="invoice" class="form-control" placeholder="Invoice/reciept number:" />
                     <span class="help-block">This is the invoice number that was issued to you when you purchased the goods. Enter the suppliers name/phone number if no invoice given.</span>
                     </div>
                    
                    <div class="form-group col-sm-10">
                        <input class="form-control" name="good_num[]" required id="num" onkeyup="amount();" onchange="amount();" type="text" placeholder="e.g: 5">
                        <span class="help-block">This is the total number of a specific kind of goods.</span>
                    </div>
                    <div class="form-group col-sm-10">
                        <input class="form-control" name="good_name[]" required id="inumber" onkeyup="amount();" type="text" placeholder="e.g: Nokia">
                        <span class="help-block">This is the name of the specific kind of goods.</span>
                    </div>
                    <div class="form-group col-sm-10">
                        <input class="form-control" name="good_model[]" required  type="text" placeholder="e.g: 210">
                        <span class="help-block">This is the model number of the goods. From the above examples, this means: 5 Nokia 210</span>
                    </div>
                    <div class="form-group col-sm-10">
                        <input class="form-control" name="good_cost[]" required id="cost" onkeyup="amount();" type="text" placeholder="Unit cost">
                        <span class="help-block">How much did you bought the goods each.</span> 
                    </div>
                    <div class="form-group col-sm-10">
                        <div class="form-control" disabled id="amount" name="good_amount[]"></div>
                        <!--<input class="form-control" name="good_amount[]" required id="amount" onkeyup="amount();" type="text" placeholder="amount=unit cost times number of goods">-->
                        <span class="help-block">This is the total amount of the number of the goods. This will be calculated for you.</span> 
                    </div>
                    <div class="form-group col-sm-10">
                        <input class="form-control" name="good_comment[]" required id="inumber" type="text" placeholder="comment">
                        <span class="help-block">Write a comment about this goods.</span> 
                    </div>
                    <div></div>
                </div>
                    <div class="divider form-group col-sm-10"></div>
                    <div class="form-group col-sm-10">
                        <div align="right"><span>Add another good</span>
                         <button type="button" name="add" id="add" class="btn btn-success btn-xs">+</button>
                        </div>
                        <!--<span class="help-block">This is some help text that breaks onto a new line and may extend more than one line.</span>--> 
                    </div>
                    
                    <div class="form-group col-sm-10">
                        <div align="center">
                         <button type="submit" name="submit"  class="btn btn-info">Stock the goods</button>
                        </div>
                    </div> 
                    
                        <!--<input type="submit" name="add">-->
                       <!-- <div align="right">
                         <button type="button" name="add" id="add" class="btn btn-success btn-xs">+</button>
                        </div>
                        <div align="center">
                         <button type="submit" name="submit"  class="btn btn-info">Save</button>
                        </div>
                        <br />-->
                        <div id="inserted_good_data"></div>
               
                </form>
            </div>
            </div>

  <!--</div>-->
    </div>
        <!--</div>-->
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
        <!--<script src="../js/addstock3.js"></script>-->
        <script src="../js/addstock2.js"></script>
        <script>
            //This for the cuurent html
            function amount(){
                var x;
                x = document.getElementById("num").value;
                var y = document.getElementById("cost").value;
                var z = x * y;
                document.getElementById("amount").innerHTML=z;
            }
            //This is for jquery
            function amountt(){
                //count number of rows
                var c = document.getElementsByName("good_num[]");
                var cc = c.length;
                for(var count=2; count<=cc; count++){
                    var x;
                    x = document.getElementById("num"+count).value;
                    var y = document.getElementById("cost"+count).value;
                    var z = x * y;
                    document.getElementById("amount"+count).innerHTML=z;
                    
                } 
            }
            
        </script>
	<!--
	This file is together with the footers' contents 
		<script src="jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
	-->
</footer>

</body>
</html>


		
        <!--<script src="../js/addstock2.js"></script>-->