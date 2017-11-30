<?php

include '../connection/connect.php';
//$link = @mysqli_connect($mysql_host, $mysql_user, $mysql_password, 'ajax');
session_start();

if (isset($_POST['invoice_number']) && isset($_POST['number']))
    {
        echo $invoivenum = $_POST['invoice_number'];
        echo $numofsupgoods = $_POST['number'];
        //$supgudname = $_POST['goodname'];
        //$supgudmodel = $_POST['model'];
        //$supgudcost = $_POST['cost'];
        ////$supgudamount = $_POST['amount'];
        //$supgudamount = $numofsupgoods * $supgudcost;
        ////$suppidfk = $_POST['invoice_number'];
        //$suppidfk = 2;
        //$supguddate = date("Y-m-d");
        //$areaidfk = 3;
        //$comment = $_POST['comment'];
        if (!empty($invoivenum))
        {
            
            //$query = "INSERT INTO data VALUES (NUll, '$text')";
            //$query = "INSERT INTO suppliedgood VALUES (NUll, 10, '', '', '', '', '', '', '', '', '')";
            if ($query_run = mysqli_query($link, $query))
            {
                //echo 'Data inserted';
                echo "<div class=\"alert alert-success\"><strong>Successfully added</strong></div>";
            }
            else
            {
                echo 'Failed';
            }
        }
        else
        {
            echo 'Please type something';
        }
    }else{
        echo "It is not set!";
    }
?>