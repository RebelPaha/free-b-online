

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

$(function() {

var g1 = [];
var g2 = [];

var sin = [],cos = [];

		for (var i = 0; i < 14; i += 0.5) {
			sin.push([i, Math.sin(i)]);
			cos.push([i, Math.cos(i)]);
		}

		var plot = $.plot("#placeholder", [
			{ data: sin, label: "sin(x)"},
			{ data: cos, label: "cos(x)"}
		], {
			series: {
				lines: {
					show: true
				},
				points: {
					show: true
				}
			},
			grid: {
				hoverable: true,
				clickable: true
			},
			yaxis: {
				min: -1.2,
				max: 1.2
			}
		});






$.ajax({
		type: "GET",
		url: "data.xml", 
		dataType: "xml", 
		success: 
				function(xml) 
				{ 
				$(xml).find('mm').each(
							function()
								{
									var num = $(this).find('num').text();
									var v1 = $(this).find('va0').text();
									var v2 = $(this).find('va1').text();
									g1.push([num,v1]);
									g2.push([num,v2]);
								}
						);
				
					$.plot("#placeholder", [{label: "U0",data: g1},
												{label: "U1",data: g2}],
												{grid: {
														 hoverable: true
														 }}
												);
				var yaxisLabel = $("<div class='axisLabel yaxisLabel'></div>")
				.text("Напряжение")
				.appendTo("#placeholder");
								
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
			   			item.series.label + " of " + x + " = " + y);
							}
						}
					else 
		 				{
						$("#tooltip").remove();
						previousPoint = null;            
						}
					});
												
												
				}
		});
});