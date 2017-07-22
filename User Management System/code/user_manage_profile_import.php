<?php
include './import_php_javascript_css.php'; //import all the import of script and link
require_once('./import_php_javascript_css.php');
    $result = "";
    
    session_start();
	 $lines="";
	 $first_request=true;
	 if (isset($_FILES['csvupload'])) {
			if($_FILES['csvupload']['type'] == 'application/vnd.ms-excel'){
				$csv =file_get_contents($_FILES['csvupload']['tmp_name']);
				$lines = explode(PHP_EOL, $csv);
				$array = array();
				
				$problem = false;
				echo '<center><h1>Checking CSV file</h1></center>';
				foreach ($lines as $line) {   // check syntax error first 
					$line_object =(str_getcsv($line));
					if(sizeof($line_object)==1){
						break;
					}
				 
					if(!(
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
					))	{
								if($line_object[0]!="" ||  isset ($line_object[0])){
										$id = $line_object[0];
										
										echo "<text style='color:red;'>".$id ." : "."Syntax error</text>";;
								}
								else{
										echo "<text style='color:red;'>Syntax error</text>";;
								}							
								$problem = true;
							
						}
					else{
						$id = $line_object[0];
						$name= $line_object[1];
						$password= $line_object[2];
						$phone= $line_object[3];
						$userType= $line_object[4];
						echo "<text style='color:green;'>".$id ." : "."No Syntax error</text>";
						
						}
					echo "<br>";
					
				
				}
				if(!$problem){//if any syntax error
				echo '<button class="btn btn-success"  onclick="import_users()"<div class="glyphicon glyphicon-plus-sign"></div>Import</button>';
				}
				echo '<button class="btn btn-danger" onclick="location.replace(\'user_manage.php\');" <div class="glyphicon glyphicon-plus-sign"></div>Back</button>';
				$first_request=false;
				/*if (  isset ($line_object[0])) { $id = $line_object[0];}
					if (  isset ($line_object[1])) { $name= $line_object[1];}
					if (  isset ($line_object[2])) { $password= $line_object[2];}
					if (  isset ($line_object[3])) { $phone= $line_object[3];}
					if (  isset ($line_object[4])) { $userType= $line_object[4];}
					echo $id;
					echo "       ".$name;
					echo "       ".$password;
					echo "       ".$phone;
					echo "       ".$userType;
					echo "<br>";
				*/

			}
		}
		else{
			header("Location: user_manage.php");
		}	

?>

<html>
<head>
<script src="./js/jquery-1.11.2.min.js"></script>
<link rel="stylesheet" type="text/css"  href="css/bootstrap.css">

<script>
function import_users(){
	$('#import_form').submit();
}
</script>

</head>
<form id="import_form" action="user_manage_profile_import_execute.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="csv_data" value="<?php print_r( base64_encode(serialize($lines)));?>"/>
	</form>
</html>
