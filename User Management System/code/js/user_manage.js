$( document ).ready(function() 
{
		window.addEventListener("resize", function(event) 
		{
		user_manage_onResizing();
	    }
		);
		user_manage_onResizing();
	
});


				  function onChangeTest() {
								user_manage_reload_table($("#user_manage_search").val());
					}
			  	function changePage(pageNum){
						  $('.allpage').hide();
						$('.page'+pageNum).fadeIn( "slow" );
						
					}
					
				  
					
function user_manage_onResizing(){
					var screen =  $('#user_manage');
					var border_width =($('html').width() - screen.width() )/2;
					var border_height =($('html').height() - screen.height() )/3;
					screen.css({"margin-left":""+border_width+""}); 
	        screen.css({"margin-top":"-20px"});
	        //screen.css({"margin-top":"-"+$('#wrapper').height()/6});
	
					
					
					var search = $('#user_manage_search');
					var border_width =(screen.width() - search.width() )/7;
					var border_height =(screen.height() - search.height() )/3;
					search.css({"margin-left":""+border_width+""}); 
					search.css({"margin-top":""+50+"px"}); 
					
					var table = $('#user_manage_table');
					var border_width =(screen.width() - table.width() )/2;
					var border_height =(screen.height() - table.height() )/3;
					table.css({"margin-left":""+border_width+""}); 
					
					

}
function user_manage_tr_onclick(id){
location.href='user_manage_profile.php?id='+id;

}
function user_manage_create_onclick(){
	location.href='user_manage_create.php';
}

function user_manage_remove_onclick(){
var values = new Array();
	var message= "";
$.each($("input[name='checkbox_group[]']:checked"), function() {
  var id_name=$(this).attr('id');
	var id = id_name.split('_')[1];
	var name = id_name.split('_')[2];
	message = message +("\nID:"+id + "  Username:"+name);
  values.push($(this).attr('id'));
	
  // or you can do something to the actual checked checkboxes by working directly with  'this'
  // something like $(this).hide() (only something useful, probably) :P
});
	if(values.length>0){
	var  answer =confirm ("Are you sure to Remove these user?"+message);
	if(answer){
		
							$.each($("input[name='checkbox_group[]']:checked"), function() {
							var id_name=$(this).attr('id');
							var id = id_name.split('_')[1];
							var name = id_name.split('_')[2];
							
								          $.ajax({
													type: "POST",
													url: "user_manage_controller.php",
													data: 'action=remove&id='+id,
													dataType: "json", 
													success: function(data) {	
													 alert(data);
													},
													error: function (jqXHR, textStatus, errorThrown) {
														alert(jqXHR.responseText);
														alert(jqXHR.status);
														alert(jqXHR.readyState);
														alert(jqXHR.statusText);
														alert(textStatus);
														alert(errorThrown);
														
													}
    											});
								
					   	});
		alert("Remove User Successfully");
		onChangeTest();//reload table
	}
	}
	
}
