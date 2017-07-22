<?php
include './import_php_javascript_css.php'; //import all the import of script and link
require_once('./import_php_javascript_css.php');
    $result = "";

    session_start();

 if (
		$_POST['id']!=null 		//id
	&&  $_POST['loginpassword']!=null //password
	&&  $_POST['fullname']!=null 	  //name
	&&  $_POST['permission']!=null    // user type
	&&  $_POST['phone']!=null    // phone
	){
			//	$action = $_POST['action'];
				 $id = $_POST['id'];
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





		include 'user_manage_controller.php';
		$data = user_manage_getUser($id);
		$str = "";
		//"INSERT INTO user (userID,userName,Password,phone,userType,token)"
		if($data[0]['userID']!=$id){ 			$str =' '. $str.'userID'." = '".$id."' ,";}
		if($data[0]['userName']!=$name){		$str =' '. $str.'userName'." = '".$name."' ,";}
		//if($data[0]['ID']!=$id){				$str =' '. $str.'ID'." = '".$id."' ,";}
		if($data[0]['Password']!=$password){			$str =' '. $str.'Password'." = '".$password."' ,";}
		if($data[0]['phone']!=$phone){			$str =' '. $str.'phone'." = '".$phone."' ,";}
		//if($data[0]['address']!=$address){			$str =' '. $str.'address'." = '".$address."' ,";}
		//if($data[0]['email']!=$email){			$str =' '. $str.'email'." = '".$email."' ,";}
		if( isset($_POST['permission']) && $data[0]['userType']!=$userType){
												$str =' '. $str.'userType'." = '".$userType."' ,";
			}


    if (strlen($str) < 1){
			  mysqli_close($connect);
											if (isset($_FILES['photo'])) {
												echo '1234';
											if (substr($_FILES['photo']['type'], 0, 5) == 'image') {



									    $image =file_get_contents($_FILES['photo'][tmp_name]);
										//echo '<img src="data:image/jpeg;base64,'.$image.'" style="height:200px;width:250px;"/>';
											$connect2 = database_connect();

											$sql2 = "UPDATE user SET img = '" . mysql_escape_string($image). "' "." WHERE userID= '$id'";

											if (mysqli_query($connect2, $sql2)){}
											else{ echo 'error updating image';}
											mysqli_close($connect2);
				}
			 header("Location: user_manage_profile.php?id=".$id."&message=change");
			break;
		 }
			 header("Location: user_manage_profile.php?id=".$id."&message=change");
			break;
		 }
		$str = substr($str , 0, -1);
		echo $str;

		$connect = database_connect();
		$sql = "UPDATE user SET"
		.$str.""
		." WHERE userID = '$id'";
echo $sql;


		if (mysqli_query($connect, $sql)) {
			echo "Record updated successfully";
			mysqli_close($connect);
											if (isset($_FILES['photo'])) {
												echo '1234';
											if (substr($_FILES['photo']['type'], 0, 5) == 'image') {



									    $image =file_get_contents($_FILES['photo'][tmp_name]);
										//echo '<img src="data:image/jpeg;base64,'.$image.'" style="height:200px;width:250px;"/>';
											$connect2 = database_connect();

											$sql2 = "UPDATE user SET img = '" . mysql_escape_string($image). "' "." WHERE userID='$id'";

											if (mysqli_query($connect2, $sql2)){header("Location: user_manage_profile.php?id=".$id."&message=success");exit;;}
											else{ echo 'error updating image';}
											mysqli_close($connect2);
											}
											}

			header("Location: user_manage_profile.php?id=".$id."&message=success");
		} else {
			echo "Error updating record: " . mysqli_error($connect);
			mysqli_close($connect);
											if (isset($_FILES['photo'])) {
												echo '1234';
											if (substr($_FILES['photo']['type'], 0, 5) == 'image') {



									    $image =file_get_contents($_FILES['photo'][tmp_name]);
										//echo '<img src="data:image/jpeg;base64,'.$image.'" style="height:200px;width:250px;"/>';
											$connect2 = database_connect();

											$sql2 = "UPDATE user SET img = '" . mysql_escape_string($image). "' "." WHERE userID='$id'";

											if (mysqli_query($connect2, $sql2)){header("Location: user_manage_profile.php?id=".$id."&message=success");exit;}
											else{ echo 'error updating image';}
											mysqli_close($connect2);
											}
											}
			header("Location: user_manage_profile.php?id=".$id."&message=exist");
		}





		?>
