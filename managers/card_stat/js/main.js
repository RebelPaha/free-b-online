			
				
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

$(document).ready(function() {
 	
//part 1. getting vendors names 
var vendors = {};
var stat = {};			  
$.ajax({async: false, type:'POST', url: 'php/index.php',dataType : "json", data:"get_card_ven_data=1", success: 
	 	 	function(response) 
	 	 		{
	 	 	   vendors = response; 
				}
		});			
				//part 2. creating @stat table with vendor names  			
				var table = $('<table></table>').attr('id','stat');
				for(var i in vendors)
					{
		 			var row = $('<tr></tr>').attr('id','s_row');
  					var name_col = $('<td></td>').attr('id','name_col');
					var name_div = $("<div></div>").attr('id','name_div');
					name_div.html(vendors[i])
					name_col.html(name_div);
					var stat_div = $('<div></div>').attr('id','stat_div');
					//there might be stat_col table;
					//part 3. getting data to specific vendor (i) in xml or json	
					var stat={};
					$.ajax({async: false, type:'POST', url: 'php/index.php',dataType : "json", data:"get_card_stat_data="+i, success: 
					function(response) 
						{
						stat = response;
						}
					});
					//part 4  create vendor stat table
					var stat_table = $('<table></table>').attr('id','card_stat');
					var price_per_period = 0;
					stat_table.html("<tr><td>Дата</td><td>Карта</td><td>Сумма</td>");	
					for( var i in stat)
						{
						var cnt_buy = 0;
						var price_per_day = 0;
						for(var info in stat[i])
							{		
							if(info!="date")
								{
								cnt_buy++;
								price_per_day+=stat[i][info].price;
								var stat_row = $('<tr></tr>');
								var stat_date_col = $('<td></td>').append(stat[i].date);
								stat[i].date="";
								stat_row.append(stat_date_col);
								var stat_card_col = $('<td></td>').append(stat[i][info].card);
								var stat_price_col = $('<td></td>').append(stat[i][info].price);
								stat_row.append(stat_card_col);
								stat_row.append(stat_price_col);
								stat_table.append(stat_row);
								}
							}	
						price_per_period+=price_per_day;
						if(cnt_buy>1)
							{
							stat_table.append("<tr style='background-color: #d5d5d5;'><td>Сумма за день</td><td></td><td>"+price_per_day+"</td></tr>");
							}						
						stat_table.append("<tr><td></td><td></td><td></td></tr>");
						}
					stat_table.append("<tr style='background-color: #dcda9e;'><td>Сумма за весь период</td><td></td><td>"+price_per_period+"</td></tr>");
	//				stat_col.html(stat_table);
					stat_div.html(stat_table);
					name_col.append(stat_div);
					row.append(name_col);
  					//part 5. put it together
  					table.append(row);
  					}
				$("#main").append(table);
				table_ready();  
});
	
function table_ready() 
{
	var trig=true;
	$("#stat #name_col #name_div").click(function () 
				{
				$("#stat #name_col #stat_div").hide(400);
				$("#stat #name_col").css("backgroundImage","url(img/hide.png)");
				$("#stat #name_col").css("backgroundColor","#e3e3e3");
				$(this).parent().css("backgroundImage","url(img/show.png)");
				$(this).parent().css("backgroundColor","#fa8f8f");
				$(this).parent().children("#stat_div").show(400);
     			});	
}