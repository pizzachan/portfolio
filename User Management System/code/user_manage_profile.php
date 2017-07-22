
<?php
session_start();
include './import_php_javascript_css.php'; //import all the import of script and link
require_once('./import_php_javascript_css.php');

if(@$_GET['id']==null){
	$id='1';
}
else{$id=$_GET['id'];}
/*
if(@$_SESSION['loginname']==null || @$_SESSION['permission']==null || @$_SESSION['userid']==null){
header("Location: http://".getHTTPPath()."/home.php");
}
else{
	$id=$_GET['id'];

}
if( $_SESSION['permission'] != 'admin' && $_SESSION['userid'] != $id){
	header("Location: http://".getHTTPPath()."/home.php");
}
else if($_SESSION['permission'] != 'admin') {
	$isAdmin="0"; // not admin but his profile
}
if($_SESSION['permission'] == 'admin'){
	$isAdmin="1"; // is admin
}
*/
?>


<html>
<head>
<script src="./js/jquery-1.11.2.min.js"></script>
<script src="./js/user_manage_profile.js"></script>
<link rel="stylesheet" type="text/css"  href="css/bootstrap.css">
<link rel="stylesheet" type="text/css"  href="css/user_manage_profile.css">
<script>
function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

</script>
</head>

<body style="background-color:grey;">
<?php

$lang_i=0;
$text_profile= array("'s Profile","的個人資料")[$lang_i];
$button_save= array("SAVE","儲存")[$lang_i];
$button_modify= array("MODIFY","編輯")[$lang_i];
$button_close= array("CLOSE","關閉")[$lang_i];
$text_userId= array("User ID", "用戶編號")[$lang_i];
$text_account= array("Account", "帳號")[$lang_i];
$text_fullName= array("Full Name", "姓名")[$lang_i];
$text_password= array("Password", "密碼")[$lang_i];
$text_email= array("Email", "電郵")[$lang_i];
$text_address= array("Address", "住址")[$lang_i];
$text_jailed= array("Blocked", "封鎖")[$lang_i];
$text_role= array("Role", "身份")[$lang_i];
$message_saveModify= array("Nothing had to be changed","沒有任何修改")[$lang_i];
$message_successModify= array("Modify User Information Successfully","已修改用戶資料")[$lang_i];
$message_exist= array("Account Name is Already Exist","用戶名已存在")[$lang_i];
$message_email= array("Invalid email address","郵件錯誤")[$lang_i];
$error_input_all=array("Please input all the information!","請輸入所有資料!")[$lang_i];
$error_password=array("Confirm password not the same!","密碼不符!")[$lang_i];
$text_phone=array("Phone","")[$lang_i];
echo '<script>message_email="'.$message_email.'" ;</script>';
echo '<script>error_input_all="'.$error_input_all.'" ;</script>';
echo '<script>error_password="'.$error_password.'" ;</script>';

if(isset($_GET['reply'])){
	/*if($_GET['reply'] == 'cs')
	echo "<script>alert('New user created successfully');</script>";
	*/
}

include 'user_manage_controller.php';
$data = user_manage_getUser($id);

?>




<div  id="user_manage_profile" style="background-color:white;height:auto;width:100%; min-height:99%;position: absolute;">





        <h1 style="width=100&;text-align:center;"><?php echo $data[0]['userName'];?> <?php echo $text_profile;?></h1>
		<button class="btn btn-success" id="user_manage_profile_save" style="color:white; margin-left:60%;" onclick="user_manage_profile_save_onclick();"><div class='glyphicon glyphicon-ok'></div>&nbsp<?php echo $button_save;?></button>
		<button class="btn btn-warning" id="user_manage_profile_modify" style="color:white;" onclick="user_manage_profile_modify_onclick();" ><div class='glyphicon glyphicon-wrench'></div>&nbsp<?php echo $button_modify;?></button>
		<button class="btn btn-danger" style="color:white;" onclick="user_manage_profile_back_onclick();">
		<div class='glyphicon glyphicon-remove'></div>&nbsp<?php echo $button_close; ?></button>


	<form id="user_manage_profile_modify_form" action="user_manage_profile_modify.php" method="post" enctype="multipart/form-data">
			<div id="user_manage_profile_elements" style="width:80%;position:relative;">

					<div class="user_manage_profile_elements"id="user_manage_profile_photo" style="float:right;">
					<?php
					$image = base64_encode( $data[0]['img'] );
					echo '<img src="data:image/jpeg;base64,'.$image.'" id="img" style="height:200px;width:250px;"/>';

					?>
					<input id="user_manage_profile_photo" type="file" name="photo" required="required" onchange="readURL(this);"/>
					</div>


				<table id="profile_table" style="text-align:center;width:70%;">
					<tr>
						<td> <?php echo $text_userId;?>:     </td>
						<td><input id="user_manage_profile_userid_input" name="id" value="<?php echo $data[0]['userID'] ;?>" disabled/></td>
					</tr>

					<!--<tr>
						<td> <?php echo $text_account;?>:  </td>
						<td><input id="user_manage_profile_loginname" name="loginname" value="<?php echo $data[0]['AC'] ;?>" disabled/></td>
					</tr>-->

					<tr>
						<td> <?php echo $text_fullName;?>:  </td>
						<td>	<input id="user_manage_profile_fullname" name="fullname" value="<?php echo $data[0]['userName'];?>" disabled/></td>
					</tr>

					<tr id="user_manage_profile_password">
						<td> <?php echo $text_password; ?>:    </td>
						<td><input  class="noselect"  name="loginpassword" type="password" oninput="user_manage_profile_password_onclick();"
						 value="<?php echo $data[0]['Password'];?>" disabled/></td>
					</tr>
					<tr>
						<td> <?php echo $text_phone;?>:  </td>
						<td>	<input id="user_manage_profile_phone" type="number" name="phone" value="<?php echo $data[0]['phone'];?>" disabled/></td>
					</tr>
				   <!--
					<tr>
						<td><?php echo $text_email; ?>: </td>
						<?php $email = explode('@',  $data[0]['email']); ?>
						<td><input id="user_manage_profile_email_name" name="email_name" value="<?php echo $email[0];?>" disabled/> @
							  <input style="width:150px;" id="user_manage_profile_email_domain" name="email_domain" value="<?php echo $email[1];?>" disabled/>
						</td>

					</tr>

					<tr>
						<td><?php echo $text_address; ?>:    </td>
						<td><input id="user_manage_profile_address" name="address" value="<?php echo $data[0]['address'];?>" disabled/></td>
					</tr>

					<tr>
						<td><?php echo $text_jailed; ?>:</td>
						<td><input name="jail" id="jailed_checkbox" type="checkbox" disabled/>
						 <?php
						  if($data[0]['jail'] == '1'){
							  echo "<script> $('#jailed_checkbox').prop('checked', true); </script>";
						  }


						 ?></td>
					</tr>
					-->
					<tr>
						<td><?php echo $text_role; ?>:</td>
						<td>

							<select id="user_manage_profile_role_select" name="permission"  disabled>
							 	<option value="student">student</option>
								<option value="teacher">teacher</option>
								<option value="admin">admin</option>
							</select>
							<?php
								  echo "<script> $('#user_manage_profile_role_select').val('".$data[0]['userType']."'); </script>";

							?>
						</td>
					</tr>







				</table>
			</div>
		</form>

</div>

</body>


</html>
