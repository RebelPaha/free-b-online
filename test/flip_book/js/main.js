$(document).ready(function() 
{
for(var i = 226; i!=236;i++)
{
$.ajax({type:'POST', async: false, url: 'php/index.php',dataType : "json", data:"id="+i, success: 
	 	 	function(response) 
	 	 			{
	 	 			if(response)
	 	 				{
	 	 				$("#magazine").append("<div style=\"background-color:#fff; padding: 25px;\" class='"+((i%2==0) ? 'even' : 'odd')+"'><img src=\"http://free-b.com.ua/img/partner/"+response.logo+
	 	 											"\"><hr>Адрес:"+response.adress+
	 	 											"<br>Телефон:"+response.phones+
	 	 											"<br><br>"+response.description+"</div>");
						}					
					}
				});
}			
	
	
	
$('#magazine').turn
	({
	display: 'double',
	acceleration: true,
	gradients: !$.isTouch,
	elevation:50,
	when: {
			turned: function(e, page) 
				{
				/*console.log('Current view: ', $(this).turn('view'));*/
				}
			}
	});
			
});
	
	
	$(window).bind('keydown', function(e){
		
		if (e.keyCode==37)
			$('#magazine').turn('previous');
		else if (e.keyCode==39)
			$('#magazine').turn('next');
			
	});

function prev() 
{
	$("#magazine").turn('previous');
}


function next() 
{
	$('#magazine').turn('next');
}
