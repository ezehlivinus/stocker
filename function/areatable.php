<?php
//
//get areaid 
function get_comp_areaid($compid){
	global $link;
	$query = "SELECT * FROM area WHERE compidfk='$compid'";
    $query_run = mysqli_query($link, $query);
	if(mysqli_num_rows($query_run) == 1){
        $row = mysqli_fetch_array($query_run);
    }
	return $row['areaid'];
}

//get area name
function get_areaname($areaid){
	global $link;
	$query=$link->query("SELECT * FROM area WHERE areaid ='$areaid'");
	if($query->num_rows == 1){
		$row = $query -> fetch_assoc();
	}else{
		die("<p style='color: red'>Error occured! Please select a correct area.</p>");
	}
	return $row['areaname'];
}

?>