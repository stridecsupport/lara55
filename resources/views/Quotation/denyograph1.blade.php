<!doctype html>
<html lang="en">
<head>
	<!-- https://canvasjs.com/docs/charts/how-to/multiple-y-axis/ -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Graph Page</title>

<script type="text/javascript">
window.onload = function () {
	var chart = new CanvasJS.Chart("chartContainer",{              
		title:{
			text: "Denyo Report Graph"
		},
		axisX:{
			valueFormatString: "####",
			interval: 1
		},
		axisY:[{
			title: "Load A L1 (1) [A]",
			lineColor: "#369EAD",
			titleFontColor: "#369EAD",
			labelFontColor: "#369EAD"
		},
		{
			title: "Gen V L1-L2 (1)[V]",
			logarithmic: true,
			lineColor: "#C24642",
			titleFontColor: "#C24642",
			labelFontColor: "#C24642"
		}],
		axisY2:[{
			title: "Load 1W (1)[KW]",
			lineColor: "#7F6084",
			titleFontColor: "#7F6084",
			labelFontColor: "#7F6084"
		},
		{
			title: "Gen Freq (1) [Hz]",
			logarithmic: true,
			interval: 1,
			lineColor: "#86B402",
			titleFontColor: "#86B402",
			labelFontColor: "#86B402"
		}],

	data: [
	{
		type: "spline",
		showInLegend: true,
		//axisYIndex: 0, //Defaults to Zero
		name: "Load A L1 (1) [A]",
		xValueFormatString: "####",
		dataPoints: [
			{ x: 0, y: 0 },
			{ x: 10, y: 20 },
			{ x: 20, y: 40 },
			{ x: 30, y: 45 },
			{ x: 40, y: 50 },
			{ x: 60, y: 55 },
			{ x: 70, y: 60 },
			{ x: 80, y: 80 },
			{ x: 90, y: 90 },
			{ x: 100, y: 100 }
		]
	},
	{
		type: "spline",
		showInLegend: true,
		axisYIndex: 1, //Defaults to Zero
		name: "Gen V L1-L2 (1)[V]",
		xValueFormatString: "####",
		dataPoints: [
			{ x: 0, y: 250 }
			

		]
	},
	{

		// column
		type: "spline",
		showInLegend: true,                  
		axisYType: "secondary",
		//axisYIndex: 0, //Defaults to Zero
		name: "Load 1W (1)[KW]",
		xValueFormatString: "####",
		dataPoints: [
			{ x: 0, y: 6 },
			{ x: 10, y: 2 },
			{ x: 20, y: 5 },
			{ x: 30, y: 7 },
			{ x: 40, y: 1 },
			{ x: 50, y: 5 },
			{ x: 60, y: 5 },
			{ x: 70, y: 2 },
			{ x: 80, y: 2 },
			{ x: 90, y: 2 },
			{ x: 100, y: 2 }
		]
	},
	{
		type: "spline",
		showInLegend: true,                  	
		axisYType: "secondary",
		axisYIndex: 1, //When axisYType is secondary, axisYIndex indexes to secondary Y axis & not to primary Y axis
		name: "Gen Freq (1) [Hz]",
		xValueFormatString: "####",
		dataPoints: [
			{ x: 0, y: 6 },
			{ x: 10, y: 2 },
			{ x: 20, y: 5 },
			{ x: 40, y: 7 },
			{ x: 50, y: 1 },
			{ x: 60, y: 5 },
			{ x: 70, y: 5 },
			{ x: 80, y: 2 },
			{ x: 90, y: 2 },
			{x:100,y:2}

			]
	}
	]
	});

	chart.render();
}
</script>
<script type="text/javascript" src="{{url('assets/denyograph/canvasjs.min.js')}}"></script>
</head>
<body>
<div id="chartContainer" style="height: 300px; width: 100%;">
</div>
</body>
</html>