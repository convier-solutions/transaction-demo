<div class="mx-auto col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <div class="card">
        <div class="card-header">

            <div class="col-6 text-left">
                <h4>Pie Chart</h4>
            </div>
            <div class="col-6 text-right">
                <select class="form-control-sm" name="pie_chart" id="pie_chart_days">
                    <option value="1">Today</option>
                    <option value="2">All</option>
                </select>
            </div>



        </div>
        <div class="card-body">
            <div id="echart_pie" class="chartsh chart-shadow2"></div>
        </div>
    </div>
</div>
<script>
    $(function(e) {
        'use strict'

        // Assuming your JSON data is stored in a variable named 'dataArray'
        var dataArray = <?= $pie_chart ?>;

        // Extract the data you want to use in the pie chart
        var pieData = [{
                value: parseFloat(dataArray[0].total_cost) ? parseFloat(dataArray[0].total_cost) : 0,
                name: "Total Cost"
            },
            {
                value: parseFloat(dataArray[0].pay_out) ? parseFloat(dataArray[0].pay_out) : 0,
                name: "Pay Out"
            },
            {
                value: parseFloat(dataArray[0].profit) ? parseFloat(dataArray[0].profit) : 0,
                name: "Profit"
            }
        ];

        /* Pie Chart */
        var chart = document.getElementById('echart_pie');
        var pieChart = echarts.init(chart);

        pieChart.setOption({
            tooltip: {
                trigger: "item",
                formatter: function(params) {
                    return params.seriesName + '<br/>' + params.name + ' : ' + params.value
                        .toLocaleString() + ' (' + params.percent + '%)';
                }
            },
            legend: {
                x: "center",
                y: "bottom",
                data: ["Total Cost", "Pay Out", "Profit"]
            },
            calculable: !0,
            series: [{
                name: "Chart Data",
                type: "pie",
                radius: "55%",
                center: ["50%", "48%"],
                data: pieData, // Use the dynamic data here 
            }],
            color: ['#c31111', '#1074e1', '#a9b7d0']
        });

        function updatePieChart(newData) {

            var dataArray = newData;

            // Extract the data you want to use in the updated pie chart
            var pieData = [{
                    value: parseFloat(dataArray[0].total_cost) ? parseFloat(dataArray[0].total_cost) : 0,
                    name: "Total Cost"
                },
                {
                    value: parseFloat(dataArray[0].pay_out) ? parseFloat(dataArray[0].pay_out) : 0,
                    name: "Pay Out"
                },
                {
                    value: parseFloat(dataArray[0].profit) ? parseFloat(dataArray[0].profit) : 0,
                    name: "Profit"
                }
            ];

            // Get the existing pie chart instance
            var pieChart = echarts.init(document.getElementById('echart_pie'));

            // Update the series data with the new data
            pieChart.setOption({
                series: [{
                    data: pieData,
                }]
            });
        }
        $('#pie_chart_days').change(function() {
            // Get the selected option's value
            var selectedValue = $(this).val();
            $.ajax({
                type: 'POST',
                url: '<?= site_url() . 'pie_chartsByValue' ?>',
                data: {
                    pie_chart: selectedValue
                },
                success: function(response) {
                    var newData = JSON.parse(response);
                    updatePieChart(newData);
                },
                error: function() {
                    // Handle errors, if any
                    $('#result').html('An error occurred.');
                }
            });
        });

    });
</script>