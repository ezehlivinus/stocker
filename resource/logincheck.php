<?php

    //checks if a user is logged in
    function reporter_logincheck() {
        if (isset($_SESSION['reporter'])) {
            return true;
        }
        else {
            return false;
        }
    }
    
    //checks if a basic user is logged in
    function basic_user_logincheck() {
        if (isset($_SESSION['basicuser'])) {
            return true;
        }
        else {
            return false;
        }
    }
    
    //checks if the manager is logged in
    function manager_logincheck() {
        if (isset($_SESSION['manager'])) {
            return true;
        }
        else {
            return false;
        }
    }
    
    //checks if the owner is logged in
    function owner_logincheck() {
        if (isset($_SESSION['owner'])){
            return true;
        }
        else{
            return false;
        }
    }
    
    function is_loggedin(){
        if(isset($_SESSION['username'])){
            return true;
        }else{
            return false;
        }
    }
    
    //function  supervisorn_logincheck() {
    //    if (isset($_SESSION['supervisor_staffno'])){
    //        return true;
    //    }
    //    else{
    //        return false;
    //    }
    //}
?>