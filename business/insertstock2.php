<?php

include '../connection/connect.php';
//$link = @mysqli_connect($mysql_host, $mysql_user, $mysql_password, 'ajax');
session_start();
?>


<?php
//insert.php

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