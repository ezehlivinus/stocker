<?php
//This is the logout script for users

   require_once('../resource/logincheck.php');
   session_start();
   //check if it is a user that want to logout
   if (is_loggedin()){
      if(session_destroy()) {
         header('Location: ../resource/index.php');
      }
   }
   else {
      //the person visited the login page by mistake
      header('Location: ../resource/index.php');
   }
   
   



?>