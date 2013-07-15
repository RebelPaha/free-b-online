
function start_upload()
{
                var formData = new FormData($('#auth_conf form')[0]);
                $.ajax(
                        {
                        url: 'php/index.php',
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


var reg_param_cnt = 2;

function add_reg_param() 
{
	var last_p = $(".reg_param_last");
	
	$param = $("<tr class=\"reg_param_last\"><td><input name=\"reg_full_name"+reg_param_cnt+"\" type=\"text\" id=\"reg_full_name\"></td>\
					<td><input name=\"reg_table_name"+reg_param_cnt+"\" type=\"text\" id=\"reg_table_name\"></td></tr>");
	last_p.after($param);
	last_p.attr("class","");	
	reg_param_cnt++;
	return false;
}

function submit_forms() 
{
	$.ajax({type:'POST', url: 'php/index.php',dataType : "json", data:
	$("#login_by form").serialize()+"&"+$("#reg_by form").serialize()+"&reg_param_cnt="+reg_param_cnt+
								"&"+$("#auth_conf form").serialize(),
	success: 
		function(response) 
			{
				var archive_link = $("<a>  Собранный модуль (.ZIP)</a>").attr("href",response.archive);
				var test_link = $("<a>  Демо модуля  </a>").attr("href",response.test_url);
				var div = $("<div id=\"result\"></div>").append(archive_link);
				div.append(test_link);
					$("body").append(div);
			}
	});
}

/*
var login_param_cnt = 2;
function add_login_param() 
{
	var last_p = $(".login_param_last");
	
	$param = $("<tr class=\"login_param_last\"><td><input name=\"auth_full_name"+login_param_cnt+"\" type=\"text\" id=\"auth_full_name\"</td>\
				<td><input name=\"auth_table_name"+login_param_cnt+"\" type=\"text\" id=\"auth_table_name\"></td></tr>");
	last_p.after($param);
	last_p.attr("class","");	
	login_param_cnt++;
	return false;
}*/