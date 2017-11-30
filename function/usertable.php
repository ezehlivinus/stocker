<?php

//get user role
function get_user_userid($username){
    global $link;
	$query = "SELECT * FROM user WHERE email='$username'";
    $query_run = mysqli_query($link, $query);
    if(mysqli_num_rows($query_run) == 1){
        $row = mysqli_fetch_array($query_run);
    }
    return $row['userid'];
}

//get user role
function get_user_role($username){
    global $link;
	$query = "SELECT * FROM user WHERE email='$username'";
    $query_run = mysqli_query($link, $query);
    if(mysqli_num_rows($query_run) == 1){
        $row = mysqli_fetch_array($query_run);
    }
    return $row['role'];
}

//get user's name
function get_user_name($username){
	global $link;
	$query = "SELECT * FROM user WHERE email='$username'";
    $query_run = mysqli_query($link, $query);
	if(mysqli_num_rows($query_run) == 1){
        $row = mysqli_fetch_array($query_run);
    }
	return $row['fullname'];
}

//get user mobile
function get_user_moible($username){
	global $link;
	$query = "SELECT * FROM user WHERE email='$username'";
    $query_run = mysqli_query($link, $query);
	if(mysqli_num_rows($query_run) == 1){
        $row = mysqli_fetch_array($query_run);
    }
	return $row['mobile'];
}

function get_user_compidfk($username){
	global $link;
	$query = "SELECT * FROM user WHERE email='$username'";
    $query_run = mysqli_query($link, $query);
	if(mysqli_num_rows($query_run) == 1){
        $row = mysqli_fetch_array($query_run);
    }
	return $row['compidfk'];
}

function get_user_lastseen($username){
	global $link;
	$query = "SELECT * FROM user WHERE email='$username'";
    $query_run = mysqli_query($link, $query);
	if(mysqli_num_rows($query_run) == 1){
        $row = mysqli_fetch_array($query_run);
    }
	return $row['lastseen'];
}

function get_user_email($username){
	global $link;
	$query = "SELECT * FROM user WHERE email='$username'";
    $query_run = mysqli_query($link, $query);
	if(mysqli_num_rows($query_run) == 1){
        $row = mysqli_fetch_array($query_run);
    }
	return @$row['email'];
}

function get_user_joindate($username){
	global $link;
	$query = "SELECT * FROM user WHERE email='$username'";
    $query_run = mysqli_query($link, $query);
	if(mysqli_num_rows($query_run) == 1){
        $row = mysqli_fetch_array($query_run);
    }
	return $row['joindate'];
}

function get_user_compareaidfk($username){
	global $link;
	$query = "SELECT * FROM user WHERE email='$username'";
    $query_run = mysqli_query($link, $query);
	if(mysqli_num_rows($query_run) == 1){
        $row = mysqli_fetch_array($query_run);
    }
	return $row['compareaidfk'];
}

////////////////////////////////////////////
//if user exist in login table
function user_exist($email){
 global $link;
    $query = "SELECT * FROM login WHERE username='$email'";
    $query_run = mysqli_query($link, $query);
    if(mysqli_num_rows($query_run) == 1){
        return true;
    }else{
        return false;
    }
}

//if user exist in user table
function user_exist_user($email){
 global $link;
    $query = "SELECT * FROM user WHERE email='$email'";
    $query_run = mysqli_query($link, $query);
    if(mysqli_num_rows($query_run) == 1){
        return true;
    }else{
        return false;
    }
}


?>