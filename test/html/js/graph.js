$(function() {

var g1 = [];
var g2 = [];
var conf_window = false;

function showTooltip(x, y, contents) 
	{
	$("<div id='tooltip'>" + contents + "</div>").css({
		position: "absolute",
		display: "none",
		top: y + 5,
		left: x + 5,
		border: "1px solid #fdd",
		padding: "2px",
		"background-color": "#fee",
		opacity: 0.80
		}).appendTo("body").fadeIn(200);
	}

function make_graph() 
{
 $.getJSON('data.jsn', 
	 	 	function(response) 
	 	 			{
	 	 				
					for (var i in response) 
					{
					var num = i;
					var v1 = response[i]["0"];
					var v2 = response[i]["1"];
					g1.push([num,v1]);
					g2.push([num,v2]);
					}
    			$.plot("#placeholder", [{label: "АЦП Вход 0",data: g1},
												{label: "АЦП Вход 1",data: g2}],
												{grid: {
														 hoverable: true
														 }}
												);
				var yaxisLabel = $("<div class='axisLabel yaxisLabel'></div>")
				.text("Напряжение мВ.")
				.appendTo("#placeholder");
				
				yaxisLabel.css("padding-left", "40px");				
				yaxisLabel.css("padding-top", "10px") 		
									
				var previousPoint = null;								
				$("#placeholder").bind("plothover", function (event, pos, item) 
					{
					if (item) 
						{
						if (previousPoint != item.dataIndex) 
							{
							previousPoint = item.dataIndex;
							$("#tooltip").remove();
							var x = item.datapoint[0].toFixed(2),
							y = item.datapoint[1].toFixed(2);
							showTooltip(item.pageX, item.pageY,
			   			item.series.label + "<br>Номер измерения: " + x + "<br> Напряжение: " + y+" мВ");
							}
						}
					else 
		 				{
						$("#tooltip").remove();
						previousPoint = null;            
						}
					});
												
												
				}
		);
	}
make_graph();
 window.i = 0
 window.timer1 = window.setInterval(make_graph, 5000)
});