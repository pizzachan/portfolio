$( document ).ready(function() 
{
		window.addEventListener("resize", function(event) 
		{
		user_manage_create_onResizing();
		
	    }
		);
		user_manage_create_onResizing();
		
		
});
	



function user_manage_create_onResizing(){
					var screen =  $('#user_manage_create');
					var border_width =($('html').width() - screen.width() )/2;
					var border_height =($('html').height() - screen.height() )/3;
					screen.css({"left":""+border_width+""}); 
	        screen.css({"margin-top":"-20px"});
	        //screen.css({"margin-top":"-"+$('#wrapper').height()/6});
					
					
					
					
					var elements = $('#user_manage_create_elements');
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
function user_create_profile_confirm_onclick(){
	if($('#user_create_profile_password').val()
			!=
		   $('#user_create_profile_confirmpassword').val()){
			alert('Confirm password not the same!');
			return;
		}
	 
	 //var re = /\S+@\S+\.\S+/;
	 if
		(
		$("#user_create_profile_loginname").val()==""
		|| $("#user_create_profile_fullname").val()==""
		|| $("#user_create_profile_password").val()==""
		|| $("#user_create_profile_phone").val()==""
		//|| $("#user_create_profile_email_name").val()==""
		//|| $("#user_create_profile_email_domain").val()==""
		//|| $("#user_create_profile_address").val()==""
		//|| $("#user_create_profile_jailed").val()==""
		|| $("#user_manage_create_role_select").val()==""
		)
		{
		 alert("Please input all the information!");
		 
		
	  }
	/* else if( !re.test($("#user_create_profile_email_name").val()+"@"+$("#user_create_profile_email_domain").val())){
				alertErrorMessage(message_email);
		}
	*/
	else{
	document.forms["user_manage_profile_create_form"].submit();
	}
	
}

