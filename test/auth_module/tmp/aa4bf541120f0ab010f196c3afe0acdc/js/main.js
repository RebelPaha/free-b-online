function login_submit()
{
	$.ajax({type:'POST', url: 'php/index.php',dataType : "json", data:$("#login_form").serialize(), success: 
	 	 	function(response) 
	 	 			{
	 	 				if (response.url!="error") 
	 	 					{
	 	 					window.location = response.url;
	 	 					}
	 	 				else 
	 	 					{
	 	 						var err_div = $("<div id=\"err\">Ой, неправильное имя или пароль</div>");
	 	 						$("#main").append(err_div);
	 	 					}                  
	 	 			}
	 	 	});
	return false;
};
