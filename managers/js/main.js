$(document).ready(function()
{
$("#vendor").validate({
       rules:{
            ven_name:{
                required: true,
                minlength: 4,
                maxlength: 64,
            },
            ven_gift:{
                required: true,
            },
	    ven_logo:{
		required: true,
	    }
       },

       messages:{
            ven_name:{
                required: " Это поле обязательно для заполнения",
                minlength: "Название меньше 4-х символов",
                maxlength: "Максимальное число символов - 64",
            },
            ven_gift:{
                required: "  Введите скидку",
            },
	    ven_logo:{
		required: "  Выберите логотип",
	    }
	}
    });
});

function start_upload()
{
                var formData = new FormData($('#vendor')[0]);
                $.ajax(
                        {
                        url: 'php/upload.php',
                        type: 'POST',
                        xhr: function()
                                {
                                myXhr = $.ajaxSettings.xhr();
                if(myXhr.upload)
                        {
                        $('body').append("<div id=\"progress_bar_div\"><img src=\"img/wait.gif\"></div>");
                        }
                return myXhr;
                                },
                        success: completeHandler,
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false
                        });
}

function completeHandler()
{
        $('#progress_bar_div').remove();
}


function submit_login_window()
	 {
	 	 $.ajax({type:'POST', url: 'php/index.php',dataType : "json", data:$('#login_form').serialize(), success: 
	 	 	function(response) 
	 	 			{
        			if(response.login)
        				{
        					$("#lock_screen").css("visibility","hidden");
        					$("#login_form").hide(200);
        					fill_data();
        				}
        			else 
        				{
        				 alert("Неправильный логин/пароль");
        				}
    				}
    			});
		return false;
	 }


function fill_data() 
{
	$.ajax({type:'POST', url: 'php/index.php',dataType : "json", data:"get_ven_data=1", success: 
	 	 		function(response) 
	 	 			{
	 	 				for (var i in response[0]) 
	 	 					{
    						$("#ven_city").append("<option>"+response[0][i]+"</option>");
							}
						
						for (var i in response[1]) 
	 	 					{
    						$("#ven_cat").append("<option>"+response[1][i]+"</option>");
							}
	 	 			}
	 	 	});
}

