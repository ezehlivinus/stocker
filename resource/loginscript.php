<?php
//This script logs user wherever it is called

$query = "SELECT * FROM login WHERE username = '$username' AND password = '$password'";
if($query_run = mysqli_query($link, $query)){
    if(mysqli_num_rows($query_run) == 1){
    $row = mysqli_fetch_array($query_run, MYSQLI_ASSOC);
    $userid = $row['loginid'];
    $_SESSION['username'] = $row['username'];
    //from usertable.php
    $role = get_user_role($username);//if user logs in, then $username is valid

    if($role == 'Owner'){
       $_SESSION['owner']=$role; 
    }elseif($role == 'Manager'){
        $_SESSION['manager']=$role;
    }elseif($role == 'Basic User'){
        $_SESSION['basicuser'] = $role;
    }else{
        $_SESSION['reporter'] = $role;
    }
    
    echo "<div class=\"alert alert-success\"><p>Login Successful!</p></div>";
    header('Refresh: 2; url=../business/dashboard.php');
    //header('Refresh: 5; url=../business/dashboard.php', false);
    }else{
        echo "<div class=\"alert alert-warning\"><p>Wrong username or password</p></div>";
         header('Refresh: 5; url=../resource/index.php');
    }
}else{
    //the query did not run
}
?>