<?php
// filename: connect.php
/* This provide database conection service  for "unn",
 * 'A project directory for computer science'.
 */
    
    $mysql_host = 'localhost';
    $mysql_user = 'ezeh';
    $mysql_password = '';
    $conn_error = 'Could not connect to the server!';
    $mysql_db = 'stocker';
    
    //connect to the database
    $link = @mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);

    //check if connection to the server and the database was successful
    if (!$link) {
        die($conn_error);
    }
    else{
        //connection was successful
    }

?>