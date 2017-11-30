<?php

include '../connection/connect.php';

//fetch company id using the owners details during company registration
function get_comp_id($onweremail, $compname){
    global $link;
    $query_run = mysqli_query($link, "SELECT * FROM company WHERE owneremail = '$onweremail' AND compname='$compname'");
    if($query_run){
        if(mysqli_num_rows($query_run) == 1){
            $row = mysqli_fetch_array($query_run);
        }else{
            throw new Exception("Error occurred while fetching company data to match with owner details.
                                <br/>The company's data might have not been properly inserted/registerd.");
        }
        return $row['compid'];
    }else{ /*echo "Error";*/ }
}


//get company's name

//function get_comp_name($compid, $onweremail){
//	global $link;
//	$query = "SELECT * FROM company WHERE compid='$compid' AND owneremail='$onweremail'";
//    $query_run = mysqli_query($link, $query);
//	if(mysqli_num_rows($query_run) == 1){
//        $row = mysqli_fetch_array($query_run);
//    }
//	return $row['compname'];
//}

//this was adopted instead of the above inother to enable other user
//to login
function get_comp_name($compid){
	global $link;
	$query = "SELECT * FROM company WHERE compid='$compid'";
    $query_run = mysqli_query($link, $query);
	if(mysqli_num_rows($query_run) == 1){
        $row = mysqli_fetch_array($query_run);
    }
	return $row['compname'];
}



?>