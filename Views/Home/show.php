<h1>Retention Chart</h1>
<div class="form-group">
    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto">
        	
    </div>
</div>


<script type="text/javascript">

$(document).ready(function() {
	$.ajax({
      type: 'POST',
      url: "/home/getData/",
      dataType: "json",
      success: function(resultData) {
      	loadChart(resultData);
      	}
	});
 });

function loadChart(resultData){
	Highcharts.chart('container', {

    title: {
        text: 'Retention Curve, 0-100'
    },

    subtitle: {
        text: 'Weekly cohorts'
    },

    yAxis: {
        title: {
            text: 'Percentage of Users %'
        }
    },
    xAxis: {
        title: {
            text: 'Onboarding Percentage %'        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
            pointStart: 0
        }
    },

    series: resultData,

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});
}


</script>
