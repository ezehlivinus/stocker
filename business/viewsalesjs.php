<?php
include '../connection/connect.php';

if(isset($_POST['from']) and isset($_POST['to'])){
    echo $from = $_POST['from'];
    $to = $_POST['to'];
    $output = '';
    $query = "SELECT * FROM item WHERE itemdate = '$from'";
    $result = mysqli_query($link, $query);
    $output = '
    <br />
    <h3 align="center">Item Data</h3>
    <table class="table table-bordered table-hover table-striped">
        <tr>
            <th>Number</th>
            <th>Name</th>
            <th>Model No</th>
            <th>Cost</th>
            <th>Amount</th>
            <th>Supplier</th>
            <th>Date</th>
            <th>Comments</th>
        </tr>
    ';
    while($row = mysqli_fetch_array($result))
    {
     $output .= '
        <tr>
            <td>'.$row["itemnum"].'</td>
            <td>'.$row["itemname"].'</td>
            <td>'.$row["itemmodel"].'</td>
            <td>'.$row["itemprice"].'</td>
            <td>'.$row["itemamount"].'</td>
            <td>'.$row["itemprofit"].'</td>
            <td>'.$row["itemdate"].'</td>
            <td>'.$row["itemcomment"].'</td>
        </tr>
     ';
    }
    $output .= '</table>';
    echo $output;
}else{
    echo 'Noting to show, please enter date range';

}

?>