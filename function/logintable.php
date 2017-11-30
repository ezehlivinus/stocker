<?php
include '../connection/connect.php';
//logs user-in
function user_login($username, $password){
    global $link;
    $query = "SELECT * FROM login WHERE username = '$username' AND password = '$password'";
    if($query_run = mysqli_query($link, $query)){
        if(mysqli_num_rows($query_run) == 1){
            $row = mysqli_fetch_array($query_run, MYSQLI_ASSOC);
			return $_SESSION['username'] = $row['username'];
        }
        
    }
}

//echo login('ezsv@yahoo.com', '1234');
?>