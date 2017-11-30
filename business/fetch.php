<?php
include '../connection/connect.php';
//fetch.php
//$connect = mysqli_connect("localhost", "root", "", "testing");
$output = '';
$query = "SELECT * FROM suppliedgood ORDER BY supgudid DESC";
$result = mysqli_query($link, $query);
$output = '
<br />
<h3 align="center">Item Data</h3>
<table class="table table-bordered table-hover table-striped">
    <tr>
        <th>Invoice No</th>
        <th>Number</th>
        <th>Name</th>
        <th>Model No</th>
        <th>Cost</th>
        <th>Amount</th>
        <th>Supplier</th>
        <th>Date</th>
        <th>Area</th>
        <th>Comments</th>
    </tr>
';
while($row = mysqli_fetch_array($result))
{
 $output .= '
    <tr>
        <td>'.$row["invoicenum"].'</td>
        <td>'.$row["supgudnum"].'</td>
        <td>'.$row["supgudname"].'</td>
        <td>'.$row["supgudmodel"].'</td>
        <td>'.$row["supgudcost"].'</td>
        <td>'.$row["supgudamount"].'</td>
        <td>'.$row["suppidfk"].'</td>
        <td>'.$row["supguddate"].'</td>
        <td>'.$row["areaidfk"].'</td>
        <td>'.$row["supgudcomment"].'</td>
    </tr>
 ';
}
$output .= '</table>';
echo $output;
?>