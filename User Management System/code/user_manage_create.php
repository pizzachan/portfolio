
<?php
session_start();
include './import_php_javascript_css.php'; //import all the import of script and link
require_once('./import_php_javascript_css.php');
/*
if(@$_SESSION['loginname']==null || @$_SESSION['permission']==null){
	header("Location: http://".getHTTPPath()."home.php");
}
if( $_SESSION['permission'] != 'admin'){
 header("Location: http://".getHTTPPath()."home.php");
}
*/
?>

<html>
<head>
<script src="./js/jquery-1.11.2.min.js"></script>
<script src="./js/user_manage_create.js"></script>
<link rel="stylesheet" type="text/css"  href="css/user_manage_create.css">
<link rel="stylesheet" type="text/css"  href="css/bootstrap.css">
<script>
function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
</head>

<body style="background-color:grey;">
<?php
$lang_i=0;
$text_create= array("Create New User","新增用戶")[$lang_i];
$button_save= array("CONFIRM","提交")[$lang_i];
$button_close= array("CLOSE","關閉")[$lang_i];
$text_account= array("UserID", "帳號")[$lang_i];
$text_fullName= array("Name", "姓名")[$lang_i];
$text_password= array("Password", "密碼")[$lang_i];
$text_con_password= array("Confirm Password", "再次輸入密碼")[$lang_i];
$text_email= array("Email", "電郵")[$lang_i];
$text_address= array("Address", "住址")[$lang_i];
$text_jailed= array("Blocked", "封鎖")[$lang_i];
$text_role= array("User Type", "身份")[$lang_i];
$error_password=array("Confirm password not the same!","密碼不符!")[$lang_i];
$message_email= array("Invalid email address","郵件錯誤")[$lang_i];
$text_phone= array("Phone","")[$lang_i];
/*echo '<script>error_input_all="'.$error_input_all.'" ;</script>';
echo '<script>error_password="'.$error_password.'" ;</script>';
echo '<script>message_email="'.$message_email.'" ;</script>';
*/
if(isset($_GET['reply'])){
	if($_GET['reply'] == 'e')
	echo "<script>alert('Username Already Exist');</script>";
}

?>




<div  id="user_manage_create" style="background-color:white;height:auto;width:100%; min-height:99%;position: absolute;">

			<h1 style="width=100&;text-align:center;"><?php echo $text_create;?></h1>
			<button class="btn btn-success" id="user_manage_create_confirm" style="color:white; margin-left:70%;" onclick="user_create_profile_confirm_onclick();"><div class='glyphicon glyphicon-ok'></div>&nbsp<?php echo $button_save;?></button>
			<button class="btn btn-danger" style="color:white;" onclick="user_manage_profile_back_onclick();"><div class='glyphicon glyphicon-remove'></div>&nbsp<?php echo $button_close;?></button>
	<center>
			<table id="profile_table" style="text-align:center;width:70%;">


				<form id="user_manage_profile_create_form" action="user_manage_profile_create.php" method="post" enctype="multipart/form-data">
						<div id="user_manage_create_elements" style="width:80%;position:relative;">
						<div class="user_manage_create_elements"id="user_manage_create_photo" style="float:right;">
						<img src="" id="img" style="height:200px;width:250px;"/>
						<input type="file" onchange="readURL(this);" name="photo" required="required"></div>
										<tr>
											<td> <?php echo $text_account;?>:  </th>
											<td><input id="user_create_profile_loginname" name="loginname" value=""/></th>
										</tr>

										<tr>
											<td>  <?php echo $text_fullName;?>:    </td>
											<td><input id="user_create_profile_fullname" name="fullname" value="" /> </td>
										</tr>

										<tr>
											<td>  <?php echo $text_password;?>:    </td>
											<td><input id="user_create_profile_password" name="loginpassword" type="password"   value=""/></td>
										</tr>

										<tr>
											<td> <?php echo $text_con_password;?>: </td>
											<td><input id="user_create_profile_confirmpassword" type="password" /> </td>
										</tr>
										<tr>
											<td> <?php echo $text_phone;?>: </td>
											<td><input id="user_create_profile_phone" type="number" name="phone" /> </td>
										</tr>

										<!--<tr>
											<td><?php echo $text_email;?>: </td>
											<td><input id="user_create_profile_email_name" name="email_name" /> @ <input style="width:150px;" id="user_create_profile_email_domain" name="email_domain" /></td>

										</tr>
										-->

										<!--<tr>
											<td> <?php echo $text_address;?>: </td>
											<td><input id="user_create_profile_address" name="address" style="width:350px;"  > </td>
										</tr>
										-->


										<tr>
												<td>
												<?php echo $text_role;?>: </td>
												<td>
													<select id="user_manage_create_role_select" name="permission">

													<option value="student">student</option>
													<option value="teacher">teacher</option>
													<option value="admin">admin</option>
												</select>
												 </td>
										</tr>

							</div>
					</form>
			</table>
	</center>
</div>

</body>


</html>
