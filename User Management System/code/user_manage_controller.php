<?php
include './import_php_javascript_css.php'; //import all the import of script and link
require_once('./import_php_javascript_css.php');
//remember add it is admin
if (isset($_POST['keyword'])){
	$keyword = $_POST['keyword'];
	echo json_encode(user_manage_getTable($keyword));
	
}
else if ($_POST['action']!=null &&  $_POST['id']!=null){
			$action = $_POST['action'];
			$id = $_POST['id'];
			
			if( $action=="remove")
			echo(user_manage_removeUser($id));		
}



		function user_manage_getTable($keyword){
		include_once '../Connection_DB/connect.php';
		$connect = database_connect();
		$data = array();
		if($keyword == " "){ $sql="SELECT userID,userName,phone,userType,token FROM user";}
		else{$sql="SELECT userID,userName,phone,userType,token FROM user  Where userName LIKE '%$keyword%' ";}
			

		if ($query=mysqli_query($connect,$sql))
			{
			// Return the number of rows in result set
			$rowcount=mysqli_num_rows($query);
				if($rowcount>0){
						while ($row = mysqli_fetch_assoc($query))
						{
									$data[] = $row;
						}	
				}
			}
			else {
			echo "Error updating record: " . mysqli_error($connect);
		}
		mysqli_close($connect);
			
				return $data;
		}

		function user_manage_getUser($id){
include_once '../Connection_DB/connect.php';
		$connect = database_connect();
		$query=mysqli_query($connect,"SELECT * FROM user where userID= '". $id."'");
		if(mysqli_num_rows($query)!=0)
				{
					while ($row = mysqli_fetch_assoc($query))
					{
						$data[] = $row;
					}
				}
		mysqli_close($connect);
				return $data;
		}
		function user_manage_removeUser($id){
include_once '../Connection_DB/connect.php';
		$connect = database_connect();
		$sql = "DELETE FROM user where userID= '". $id."'";
		if (mysqli_query($connect, $sql)) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . mysqli_error($connect);
		}

		mysqli_close($connect);
		
		return '';
}

    
   
	
		
?>