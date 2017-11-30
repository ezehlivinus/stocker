<?php

include '../connection/connect.php';

//fetch company location id using the owners details during company registration
function get_location_id($compidfk, $locationname){
    global $link;
    $query_run = mysqli_query($link, "SELECT * FROM location WHERE  compidfk='$compidfk' AND locationname='$locationname'");
    if($query_run){
        if(mysqli_num_rows($query_run) == 1){
            $row = mysqli_fetch_array($query_run);
        }else{
            throw new Exception("Error occurred while fetching company's location data. 
                                <br/>Wrong company id or location supplied");
        }
        return $row['locationid'];
    }else{ /*echo "Error";*/ }
}

//get user location name
//function get_userlocation_name($compid, )

?>