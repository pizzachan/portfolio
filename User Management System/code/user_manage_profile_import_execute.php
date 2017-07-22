<?php 
include './import_php_javascript_css.php'; //import all the import of script and link
require_once('./import_php_javascript_css.php');
			include '../Connection_DB/connect.php';
			$conn = database_connect();
			if (!$conn) {
					die("Connection failed: " . mysqli_connect_error());
			}
			if(isset($_POST['csv_data'])){
				$lines = unserialize(base64_decode($_POST['csv_data']));
			
				
					$problem = false;
					echo '<center><h1>Result</h1></center>';
					foreach ($lines as $line) 
					{   // check syntax error first 
						$line_object =(str_getcsv($line));
						if(sizeof($line_object)==1){
							break;
						}
					 
						if((
						(    isset ($line_object[0]) //check if syntax error (eg. less than 5 field etc)
							&& isset ($line_object[1])
							&& isset ($line_object[2])
							&& isset ($line_object[3])
							&& isset ($line_object[4])
						)
						&&
						( $line_object[0]!=""  //check if empty 
						  && $line_object[1]!=""
						  && $line_object[2]!=""
						  && $line_object[3]!=""
						  && $line_object[4]!=""
						)
						))	{//insert db here
								$id = $line_object[0];
								$name= $line_object[1];
								$password= $line_object[2];
								$phone= $line_object[3];
								$userType= $line_object[4];
								$sql = "INSERT INTO user (userID,userName,Password,phone,userType)"
								."VALUES ( '$id','$name','$password','$phone','$userType')";

								if (mysqli_query($conn, $sql)) {
									echo  "<text style='color:green;'>".$id ." :  New record created successfully</text>";
									
								} else {
									
									echo "<text style='color:red;'>Error: " . $sql . "<br>" . mysqli_error($conn)."</text>";
									$problem=true; //some problem
								}
													
											
							}
						
						echo "<br>";
					
				
					}
					if($problem){//if any syntax error
					 
					}
					else{ // no error
					
					}
				
			}
		echo '<button class="btn btn-danger" onclick="location.href=\'user_manage.php\'" <div class="glyphicon glyphicon-plus-sign"></div>Back</button>';
	

?>

<html>
<head>
<script src="./js/jquery-1.11.2.min.js"></script>
<link rel="stylesheet" type="text/css"  href="css/bootstrap.css">



</head>
</html>