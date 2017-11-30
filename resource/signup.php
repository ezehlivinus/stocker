<?php
session_start();
//start internal buffer for redirection
ob_start();
    //defines a signup script
    
    include '../connection/connect.php';
//search the folder(function) and include all file in there.
foreach(glob('../function/*.php') as $filename){
    include $filename;
}
	
//Check if a user entered something from ../resource/header.php
if(!isset($_POST['email']) || !isset($_POST['password'])){
    //die("<div class=\"alert alert-info\"><strong>Sign error!</strong> Please enter your signup details</div>");
	//header('Location: ../resource/index.php');
    die("email or password cannot be empty");
            
}else{
    
    $fullname = $_POST['fullname'];
    $role = 'Owner';
    $mobile = $_POST['mobile'];
    //$compidfk = ''; is now fetched from db
    $joindate = '';
    $lastseen = '';
    $email = $_POST['email'];
    $compareaidfk = '';
    $areaname=$_POST['areaname'];
    $compname  = $_POST['compname'];
    $password = $_POST['password'];
	
    
    if(comp_exist($compname)){
        echo "The company, '{$compname}', already exist!";
        header('Refresh: 5; url=../resource/index.php');   
    }else{
        //if user already exist, 
        if(user_exist_user($email)==false){ }else{
            echo 'Error: the user already exist!';
            header('Refresh: 5; url=../resource/index.php');
            die();
            }
        //echo 'Comp doest not exist';
        //insert company details into the company table
		$query = "INSERT INTO company (compid, compname, complocation, owneremail)
						VALUES (NULL, '$compname', '', '$email')";
		if(mysqli_query($link, $query)){
			//echo 'Your company have been registered!';
            //fetch company's details so company id can be inserted into insert user's(owners) details
            try{
                $compidfk = get_comp_id($email, $compname);
            }
            //catch exception
            catch(Exception $error) {
              echo 'Error: ' .$error->getMessage();
            }
            
            $locationname = $_POST['location'];
            $lcomment = $_POST['lcomment'];
            //company location(branch) can be inserted from here.
            $query = "INSERT INTO location (locationid, locationname, compidfk, lcomment)
                        VALUES (NULL, '$locationname', '$compidfk', '$lcomment')";
            $query_run = mysqli_query($link, $query);
            
            //get company's location id
            $locationname=$_POST['location'];
            try{
                $locationidfk = get_location_id($compidfk, $locationname);
            }
            //catch exception
            catch(Exception $error) {
              echo 'Error: ' .$error->getMessage();
            }                            
            //insert into area
            $areaaddress=$_POST['areaaddress'];
            $query = "INSERT INTO area (areaid, areaname, compidfk, locationidfk, areaaddress)
                        VALUES (NULL, '$areaname', '$compidfk', '$locationidfk', '$areaaddress')";
            if($query_run = mysqli_query($link, $query)){
                //fetch details
                $query="SELECT * FROM area WHERE compidfk='$compidfk' AND areaname='$areaname' AND locationidfk='$locationidfk' AND areaaddress='$areaaddress'";
                $query_run=mysqli_query($link, $query);
                if(mysqli_num_rows($query_run) == 1){
                    $row=mysqli_fetch_array($query_run);
                    $areaid = $row['areaid'];
                }
                
                $joindate = date('d/m/Y');
                $query = "INSERT INTO user (userid, fullname, role, mobile, compidfk, joindate, lastseen, email, compareaidfk)
                            VALUES (NULL, '$fullname', '$role', '$mobile', '$compidfk', '$joindate', '$lastseen', '$email', '$areaid')";
                if(mysqli_query($link, $query)){
                    //User details has been inserted into the db(suer table)
    
                    //To insert login detail for the user, //check if the user is login member
                    if(user_exist($email)){
                        //the user exist in the login table, dont insert//echo 'User exist'; //no need for this
                    }else{
                        //insert if the user does not exist in the login table//echo 'User does not exist';
                        $query = "INSERT INTO login (loginid, username, password) VALUES (NULL, '$email', '$password')";
                        if($query_run = mysqli_query($link, $query)){
                            //echo "Inserted";
                        }else{
                            //the user's login details are in the db, //echo "Registered already";
                        }
                    }
                    //if user exist then continue here instead
                    echo "The company, '{$compname}', was successfully registered!";
                    //Then log the user in as a result
                    $username = $email;//to be used for login
                    //This contains the necessary code that logs user-in
                    include '../resource/loginscript.php';
                    
                    //header('Refresh: 5; url=../resource/index.php'); 
                }else{
                    //error occured while trying to insert user details
                }
            }else{
                
            }
		}else{
			echo 'Error occurred while registering your company';
            header('Refresh: 5; url=../resource/index.php');
		}

    }
}    
    
ob_end_flush();    
?>