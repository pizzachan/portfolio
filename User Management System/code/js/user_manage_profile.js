$( document ).ready(function() 
{
		window.addEventListener("resize", function(event) 
		{
		user_manage_profile_onResizing();
	    }
		);
		user_manage_profile_onResizing();
		$('#user_manage_profile_save').prop('disabled', true);
		$('#user_manage_profile_save').css({'background-color':'lightgrey','color':'grey','cursor':'auto'});
		
		$("#user_manage_search").keyup(function() {
        user_manage_profile_search_onchange();
		
});
	
});


function user_manage_profile_onResizing(){
					var screen =  $('#user_manage_profile');
					var border_width =($('html').width() - screen.width() )/2;
					var border_height =($('html').height() - screen.height() )/3;
					screen.css({"margin-left":""+border_width+""}); 
	        screen.css({"margin-top":"-20px"});
	       // screen.css({"margin-top":"-"+$('#wrapper').height()/6});
	
					
					
					
					
					var elements = $('#user_manage_profile_elements');
					var border_width =(screen.width() - elements.width() )/2;
					var border_height =(screen.height() - elements.height() )/3;
					elements.css({"margin-left":""+border_width+""}); 
					elements.css({"margin-top":""+100+"px"}); 
					/*
					var table = $('#user_manage_table');
					var border_width =(screen.width() - table.width() )/2;
					var border_height =(screen.height() - table.height() )/3;
					table.css({"margin-left":""+border_width+""}); 
					*/
					
					

}
function user_manage_profile_back_onclick(){
	location.replace("user_manage.php");
}

function user_manage_profile_modify_onclick(){
	$('#user_manage_profile_elements input,select').prop('disabled', false);
	
	$('#user_manage_profile_save').prop('disabled', false);
	$('#user_manage_profile_save').css({'background-color':'green','color':'white','cursor':'pointer'});
	$('#user_manage_profile_userid_input').prop('disabled', true);
	
}
function user_manage_profile_save_onclick(){
	//get the modified value from the field
	//ajax database update , check whatever.
	$("#user_manage_profile_loginname").prop('disabled', false);
	$('#user_manage_profile_userid_input').prop('disabled', false);
	if ($('#user_manage_profile_confirmpassword').length > 0){
		
		
		if($('#user_manage_profile_confirmpassword').val()
			!=
		   $('#user_manage_profile_password input').val()){
			alert("Password must be the same!");
			return;
		}
		else{document.forms["user_manage_profile_modify_form"].submit();}
	}
/*	else if( !$('#user_manage_profile_confirmpassword').length )        
		{
				 alertErrorMessage("Confirm password not the same");
			   return;
		}
*/
	/*
	 var re = /\S+@\S+\.\S+/;
    if( !re.test($("#user_manage_profile_email_name").val()+"@"+$("#user_manage_profile_email_domain").val())){
				alertErrorMessage(message_email);
		}
	else*/ 
	if
		(
		$("#user_manage_profile_loginname").val()==""
		|| $("#user_manage_profile_fullname").val()==""
		|| $("#user_manage_profile_password input").val()==""
		/*
		|| $("#user_manage_profile_email_name").val()==""
		|| $("#user_manage_profile_email_domain").val()==""
		|| $("#user_manage_profile_address").val()==""
		|| $("#jailed_checkbox").val()==""
		*/
		|| $("#user_manage_profile_role_select").val()==""
		|| $("#user_manage_profile_phone").val()==""
		)
		{
		 alert("Please input all the field!");
		 
		
	  }
	else{
	document.forms["user_manage_profile_modify_form"].submit();
	}
	
}
function user_manage_profile_password_onclick(){
	if ($('#user_manage_profile_confirmpassword').length > 0){}
	
	else{
		$( "#user_manage_profile_password" ).after( 
		'<tr><td> Confirm Password:</td><td><input type="password" id="user_manage_profile_confirmpassword" /></td>></tr>'
	
	 );
	 }
	 
}
function  user_manage_profile_search_onchange(){
	//alert("vbvg");
}
