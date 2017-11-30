<?php
include '../connection/connect.php';

//check if the company is registered/exist
function comp_exist($compname){
    global $link;
    $query = "SELECT * FROM company WHERE compname = '$compname'";
    $query_run = mysqli_query($link, $query);
    
    if(mysqli_num_rows($query_run) == 1){
        //the company exist
        return true;
    }else{
        //go ahead and registered the company
        return false;
    }
    
}

?>