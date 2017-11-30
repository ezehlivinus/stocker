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
if(isset($_POST["good_name"]))
{
    
    $invoice_num = $_POST["invoice_num"];
    $good_num = $_POST["good_num"];
    $good_name = $_POST["good_name"];
    $good_model = $_POST["good_model"];
    
    $good_cost = $_POST["good_cost"];
    $good_amount = $_POST["good_amount"];
    $good_date = date("Y/m/d");
    $g=$good_date;
    $good_comment = $_POST["good_comment"];
    $query = "";
    $suppidfk = 3;
    $areaidfk = 1;
    for($count = 0; $count<count($good_name); $count++)
    {
        $invoice_num_clean = mysqli_real_escape_string($link, $invoice_num[$count]);
        $good_num_clean = mysqli_real_escape_string($link, $good_num[$count]);
        $good_name_clean = mysqli_real_escape_string($link, $good_name[$count]);
        $good_model_clean = mysqli_real_escape_string($link, $good_model[$count]);
        
        $good_cost_clean = mysqli_real_escape_string($link, $good_cost[$count]);
        $good_amount_clean = mysqli_real_escape_string($link, $good_amount[$count]);
        //$good_date_clean = mysqli_real_escape_string($link, $good_date[$count]);
        $good_comment_clean = mysqli_real_escape_string($link, $good_comment[$count]);
        
        //$suppidfk=[$count];
        $suppidfk = mysqli_real_escape_string($link, $suppidfk[$count]);
        
        //$areaidfk=[$count];
        $areaidfk = mysqli_real_escape_string($link, $areaidfk[$count]);
        $good_date = $good_date[$count];
        $good_date=mysqli_real_escape_string($link, $good_date[$count]);

        if($invoice_num_clean != '' && $good_num_clean != '' && $good_name_clean != '' && $good_model_clean != ''
           && $good_amount_clean != '')
        {
            
            $query .= "
            INSERT INTO suppliedgood (supgudid, invoicenum, supgudnum, supgudname, supgudmodel, supgudcost, supgudamount, suppidfk, supguddate, areaidfk, supgudcomment) 
            VALUES (NULL, '$invoice_num_clean', '$good_num_clean', '$good_name_clean', '$good_model_clean',
            '$good_cost_clean', '$good_amount_clean', '$suppidfk', '$g', '$areaidfk', '$good_comment_clean'); 
            ";
            //echo 'hello';
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
                    <?php echo $good_date = date("Y/m/d"); ?>
                    <br/><br/>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="stock_table">
                            <tr>
                                <th>Invoice No</th>
                                <th>Number</th>
                                <th>Name</th>
                                <th>Model No</th>
                                <th>Cost</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Comments</th>
                                <th></th>
                            </tr>
                            <tr>
                                <td contenteditable="true" class="invoice_num"></td>
                                <td contenteditable="true" class="good_num"></td>
                                <td contenteditable="true" class="good_name"></td>
                                <td contenteditable="true" class="good_model"></td>
                                <td contenteditable="true" class="good_cost"></td>
                                <td contenteditable="true" class="good_amount"></td>
                                <td contenteditable="true" class="good_date"></td>
                                <td contenteditable="true" class="good_comment"></td>
                                <td></td>
                            </tr>
                        </table>
                        <div align="right">
                         <button type="button" name="add" id="add" class="btn btn-success btn-xs">+</button>
                        </div>
                        <div align="center">
                         <button type="button" name="save" id="save" class="btn btn-info">Save</button>
                        </div>
                        <br />
                        <div id="inserted_good_data"></div>
                    </div>
   
  <!--</div>-->
                
            
                <!--<div class="col-md-6">-->
                    <!--<div class="addstock-col">
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
                    </div>-->
               <!-- </div>-->
            </div>
        <!--</div>-->
	<!--</main>-->

	<footer>
        <?php include '../resource/footer.php'; ?>
        <script src="../js/addstock2.js"></script>
	<!--
	This file is together with the footers' contents 
		<script src="jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
	-->
	</footer>
    
    
</body>
</html>


		
        <!--<script src="../js/addstock2.js"></script>-->