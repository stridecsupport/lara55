<!-- Styles -->
<style>
#chartdiv {
    width   : 100%;
    height  : 500px;
}                                                   
</style>

<!-- Resources -->
<!-- https://www.amcharts.com/kbase/dynamically-updated-sliding-chart/-->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />

<!-- Chart code -->
<script>
var chartData = generateChartData();

var chart = AmCharts.makeChart("chartdiv", {
    "type": "serial",
    "theme": "light",
    "legend": {
        "useGraphSettings": true
    },
    "dataProvider": chartData,
    "synchronizeGrid":true,
    "valueAxes": [{
        "id":"v1",
        "axisColor": "#FF6600",
        "axisThickness": 2,
        "axisAlpha": 2,
        "position": "left"
    }, {
        "id":"v2",
        "axisColor": "#FCD202",
        "axisThickness": 2,
        "axisAlpha": 1,
        "position": "left"
    }, {
        "id":"v3",
        "axisColor": "#B0DE09",
        "axisThickness": 2,
        "gridAlpha": 0,
        "offset": 50,
        "axisAlpha": 1,
        "position": "left"
    },

    {
        "id":"v4",
        "axisColor": "#9999ff",
        "axisThickness": 2,
        "gridAlpha": 0,
        "offset": 50,
        "axisAlpha": 1,
        "position": "left"
    }

    ],
    "graphs": [{
        "valueAxis": "v1",
        "lineColor": "#FF6600",
        "bullet": "round",
        "bulletBorderThickness": 1,
        "hideBulletsCount": 30,
        "title": "Fuel Level ",
        "valueField": "visits",
        "fillAlphas": 0
    }, {
        "valueAxis": "v2",
        "lineColor": "#FCD202",
        "bullet": "square",
        "bulletBorderThickness": 1,
        "hideBulletsCount": 30,
        "title": "Coolant Temp",
        "valueField": "hits",
        "fillAlphas": 0
    }, {
        "valueAxis": "v3",
        "lineColor": "#B0DE09",
        "bullet": "triangleUp",
        "bulletBorderThickness": 1,
        "hideBulletsCount": 30,
        "title": "Battery Voltage ",
        "valueField": "views",
        "fillAlphas": 0
    },

    {
        "valueAxis": "v4",
        "lineColor": "#9999ff",
        "bullet": "triangleUp",
        "bulletBorderThickness": 1,
        "hideBulletsCount": 30,
        "title": "Runnning Hours",
        "valueField": "views1",
        "fillAlphas": 0
    }],
    "chartScrollbar": {},
    "chartCursor": {
        "cursorPosition": "mouse"
    },
    "categoryField": "date",
    "categoryAxis": {
        "parseDates": true,
        "axisColor": "#DADADA",
        "minPeriod": "mm",
        "minorGridEnabled": true
    },
    "export": {
        "enabled": true,
        "position": "bottom-right"
     }
});

chart.addListener("dataUpdated", zoomChart);
zoomChart();


// generate some random data, quite different range
function generateChartData() {

    var chartData = [];
    

   // var newDate = [new Date(2017, 10, 15, 0, 30),new Date(2017, 10, 16, 0, 30)];
        var visits = 20;
        var hits = 100;
        var views = 150;
        var views1=35;

         var firstDate = new Date();

         var second=new Date();
  // now set 500 minutes back
  firstDate.setMinutes( firstDate.getDate() - 200 );

  var newDate = new Date( firstDate );

   var newSecond = new Date( second );



 for ( var i = 0; i <= 1440; i++ ) {
    var newDate = new Date( firstDate );
    // each time we add one minute
    newDate.setMinutes( newDate.getMinutes() + i );

     var newDates = new Date( second );
    // each time we add one minute

       
    if(i>500)
    {
        newDate.setDate( newDates.getDate() + 2 );


       newDate.setMinutes( newDates.getMinutes() + i );

    }

    if(i>1000)
    {
     
     newDate.setDate( newDates.getDate() + 3 );


       newDate.setMinutes( newDates.getMinutes() + i );
         
    }

        visits += 0.2;
        hits += 0.5;
        views += 0.6;
        views1 += 0.8;


            chartData.push({
            date: newDate,
            visits: visits,
            hits: hits,
            views: views,
            views1:views1

        });



}
    


    



 /*   for (var i = 0; i < 6; i++) {
        // we create date objects here. In your data, you can have date strings
        // and then set format of your dates using chart.dataDateFormat property,
        // however when possible, use date objects, as this will speed up chart rendering.
        var newDate = new Date(firstDate);
        newDate.setDate(newDate.getDate() + i);


        visits += i;
        hits += i;
        views += i;
        views1 += i;
       

        chartData.push({
            date: newDate,
            visits: visits,
            hits: hits,
            views: views,
            views1:views1

           
        });
    }*/
    return chartData;
}



/**
 * An interval to add new data points
 */
/*var timeout;
setInterval( function() {
  // normally you would load new data points via AJAX
  // for the sake of this demo we will just generate random values

  // remove one data point from beginning
  chart.dataProvider.shift();

  // add new data point to the end
  var newDate = new Date( chart.dataProvider[ chart.dataProvider.length - 1 ].date );
  // each time we add one minute
  newDate.setMinutes( newDate.getMinutes() + 1 );
  // some random number
  var visits = Math.round( Math.random() * 40 + 100 );
   var hits = Math.round( Math.random() * 80 + 100 );
    var views = Math.round( Math.random() * 90 + 100 );
     var views1 = Math.round( Math.random() * 30 + 100 );
  // add data item to the array
  chart.dataProvider.push( {
    date: newDate,
    visits: visits,
     hits: hits,
            views: views,
            views1:views1
  } );
    
  if (timeout)
    clearTimeout(timeout);
  timeout = setTimeout(function () {
    chart.validateData();
  });
}, 100 );

Rerun


*/




function zoomChart(){
    chart.zoomToIndexes(chart.dataProvider.length - 20, chart.dataProvider.length - 1);
}

function setPanSelect() {
                if (document.getElementById("rb1").checked) {
                    chartCursor.pan = false;
                    chartCursor.zoomable = true;

                } else {
                    chartCursor.pan = true;
                }
                chart.validateNow();
            }

</script>

<!-- HTML -->
<div id="chartdiv"></div>                                                   