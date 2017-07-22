
<?php
/*error_reporting(E_ERROR | E_WARNING | E_PARSE);*/
session_start();
include './import_php_javascript_css.php'; //import all the import of script and link
require_once('./import_php_javascript_css.php');


?>
<html>
<head>
<script src="./js/jquery-1.11.2.min.js"></script>
<script src="./js/user_manage.js"></script>
<link rel="stylesheet" type="text/css"  href="css/bootstrap.css">
<link rel="stylesheet" type="text/css"  href="css/user_manage.css">
</head>
<script type="text/javascript">
	function onChangeTest()
	{
		user_manage_reload_table($("#user_manage_search").val());
	}
	function changePage(pageNum)
	{
		$('.allpage').hide();
		$('.page'+pageNum).fadeIn( "slow" );
	}


</script>
<?php
$lang_i=0;
$text_topic= array("User Administration", "用戶管理")[$lang_i];
$message_post_searchBox= array("Search name", "搜索名稱")[$lang_i];
$button_create= array("CREATE","新增")[$lang_i];
$button_import= array("IMPORT CSV","新增")[$lang_i];
$button_remove= array("REMOVE","刪除")[$lang_i];
$text_userId= array("User ID", "用戶編號")[$lang_i];
$text_userName= array("User Name", "用戶名稱")[$lang_i];
$text_userType= array("User Type", "用戶類別")[$lang_i];
$button_public= array("public","一般用家")[$lang_i];
$button_staff= array("staff","職員")[$lang_i];
$button_admin= array("admin","管理員")[$lang_i];

if(isset($_GET['reply'])){
	if($_GET['reply'] == 'cs')
	echo "<script>alert('New user created successfully');</script>";
}
?>
<script>
function user_manage_reload_table(keyword){
	if (keyword === undefined || keyword === null || keyword.length<1)
	{
		keyword=" ";
    }

	 $("#pageHyperLink font" ).remove();
	 $("#user_manage_table tr").remove();
	 $( "#user_manage_table" ).append
	(
		'<tr>'
	  +'<th>&nbsp</th>'
	  +'<th><?php echo $text_userId; ?></th>'
	  +'<th><?php echo $text_userName; ?></th>'
	  +'<th><?php echo $text_userType; ?></th>'
	  +'</tr>'
	);

	  var data =$.ajax
({
    type: "POST",
    url: "user_manage_controller.php",
    data: 'keyword=' + keyword,
    dataType: "json", // Set the data type so jQuery can parse it for you
    success: function(data) {
		

		var pageNum = 0;
		var pageSize =15;
				 for( i = 0 ; i < data.length; i++)
				 {
					 if(i%pageSize==0) {pageNum++;}
					 //userID,userName,Password,phone,userType,token
					 var id = data[i]['userID'];
					 var name = data[i]['userName'];
					 var userType =  data[i]['userType'];
					 $( "#user_manage_table" ).append(
					 "<tr class='allpage page"+pageNum+"'>"
					 +"<td> <input id='checkbox_"+id+"_"+name+"' name='checkbox_group[]' type='checkbox'/></td>"
					 +"<td onclick='user_manage_tr_onclick(\""+ id +"\");'>"+ id +"</td>"
					 +"<td onclick='user_manage_tr_onclick(\""+ id +"\");'>"+ name +"</td>"
					 +"<td onclick='user_manage_tr_onclick(\""+ id +"\");'>"+ userType +"</td>"
					 +"</tr>"
					 );






					}
					if(pageNum>1){
						for( pageSize = 1 ; pageSize < pageNum+1; pageSize++)
							{
							   $( "#pageHyperLink" ).append( "<font id='pageLink"+pageSize+"' style='cursor:pointer;font-size:20px;' onclick='changePage("+pageSize+");'>"+pageSize+"</font>&nbsp");
							}
					}
					$('.page1').show();
        return data;
    }
	,
    error: function (jqXHR, textStatus, errorThrown) {
														document.write(jqXHR.responseText);
														/*alert(jqXHR.status);
														alert(jqXHR.readyState);
														alert(jqXHR.statusText);
														alert(textStatus);*/
														document.write(errorThrown);
														
													}
});







}
</script>
</head>

<body style="background-color:grey;">
	<form id="import_form" action="user_manage_profile_import.php" method="post" enctype="multipart/form-data">
	<input type="file" accept=".csv" id="csvupload" name="csvupload" style="display:none"/>
	</form>
	<script>$('#csvupload').change(function () {
		$('#import_form').submit();
	});
	</script>

<div  id="user_manage" style="background-color:white;height:auto;width:100%; min-height:99%;position: absolute;">
<h1 style="width=100&;text-align:center;"><?php echo $text_topic;?></h1>
<input style="" id="user_manage_search"type="Search" onchange="onChangeTest();" placeholder="<?php echo $message_post_searchBox;?>" "/>
<img src="Search-icon.png" style="height:20px;width:20px;" id="search" name="search" onclick="onChangeTest();"/>
<button class="btn btn-success" style="margin-left:40%;" onclick="user_manage_create_onclick();"><div class="glyphicon glyphicon-plus-sign"></div> &nbsp <?php echo $button_create;?></button>
<button id="import_upload" class="btn btn-primary"  onclick="$('#csvupload').trigger('click');"><div class="glyphicon glyphicon-plus-sign"></div> &nbsp <?php echo $button_import;?></button>
<button class="btn btn-danger" style="" onclick="user_manage_remove_onclick();"><div class="glyphicon glyphicon-minus-sign"></div> &nbsp <?php echo $button_remove;?></button>

		<table id="user_manage_table">
			<tr>
			<th>&nbsp</th>
			<th><?php echo $text_userId;?></th>
			<th><?php echo $text_userName;?></th>
			<th><?php echo $text_userType;?></th>
		  </tr>
		</table
</div>
<br>
<center>
<div id="pageHyperLink" style="color:blue;font-weight:bold;">
</div>
</center>


 <script>user_manage_reload_table();</script>
</body>


</html>
