<?php
include './import_php_javascript_css.php'; //import all the import of script and link
require_once('./import_php_javascript_css.php');
    $result = "";
    
    session_start();
	/*if ($_POST['loginname']!=null  && $_POST['loginpassword']!=null ){
	}
	
	else{header("Location: user_manage.php"); }
    */
if (	$_POST['loginname']!=null 		//id
	&&  $_POST['loginpassword']!=null //password
	&&  $_POST['fullname']!=null 	  //name
	&&  $_POST['permission']!=null    // user type
	&&  $_POST['phone']!=null    // phone
	){
			//	$action = $_POST['action'];
				 $id = $_POST['loginname'];
				 echo $id;
				 $password = $_POST['loginpassword'];
				 echo $password;
				 $name = $_POST['fullname'];
				 echo $name;
				 $userType = $_POST['permission'];
				 echo $userType;
				 $phone = $_POST['phone'];
				 echo $phone;
				 
						$length=20;
						$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
						$charactersLength = strlen($characters);
						$randomString = '';
						for ($i = 0; $i < $length; $i++) {
							$randomString .= $characters[rand(0, $charactersLength - 1)];
						}
				$token= $randomString;
				echo $token;
}	
   
/*
	$address = $_POST['address'];
	echo $address;
	$email_name = $_POST['email_name'];
  $email_domain= $_POST['email_domain'];
  $email = $email_name.'@'.$email_domain;
  echo $email;
  */


 if (isset($_FILES['photo'])) {
        if (substr($_FILES['photo']['type'], 0, 5) == 'image') {

           //$image = addslashes(file_get_contents($_FILE['photo']['tmp_name']));
						$image =file_get_contents($_FILES['photo'][tmp_name]);
            //echo '<img src="data:image/jpeg;base64,'.base64_encode( file_get_contents($_FILES['photo'][tmp_name]) ).'"/>';
            //$temp = explode(".", $_FILES["photo"]["name"]);
           // $newfilename = $name . '.' . end($temp);
           // move_uploaded_file($_FILES["photo"]["tmp_name"], "./img/" . $newfilename);
           // $imgURL = "img/" . $newfilename;            
          //  echo "<script type='text/javascript'>alert('Product created'); window.history.back()";
        } 
    }
	       include '../Connection_DB/connect.php';
		   $conn = database_connect();
	       if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
		}

			$sql = "INSERT INTO user (userID,userName,Password,phone,userType,token,img)"
			."VALUES ( '$id','$name','$password','$phone','$userType','$token','" . mysql_escape_string($image). "')";

			if (mysqli_query($conn, $sql)) {
				echo "New record created successfully";
	   		header("Location: user_manage.php?reply=cs");
			} else {
				
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				header("Location: user_manage_create.php?reply=e");
			}
	    
		
		?>