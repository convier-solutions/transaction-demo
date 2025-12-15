<div class="row m-auto">
    <div class="mx-auto col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="card mt-4">
            <div class="card-header">
                <div class="col-4 text-left">
                    <h4>Bar Chart</h4>
                </div>
                <div class="col-8 text-right">
                    <div class="row align-items-center text-center">
                        <div class="col-5 ">
                            <input class="form-control" type="date" name="startdate" id="start">
                        </div>
                        <div class="col-5 ">
                            <input class="form-control" type="date" name="enddate" id="end">
                        </div>
                        <div class="col-2">
                            <input class="btn btn-danger shadow-none" type="button" id="bar_chartFilter" value="Apply">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="echart_bar" class="chartsh chart-shadow"></div>
            </div>
        </div>
    </div>
</div>
<script>
$(function() {
    'use strict';

    // JSON data from your PHP code
    var jsonData = <?= $bar_chart ?>; // Ensure proper JSON encoding

    // Extract the relevant data from jsonData
    var transactionDates = jsonData.map(function(item) {
        return item.transaction_date;
    });

    var totalCosts = jsonData.map(function(item) {
        return parseInt(item.total_cost);
    });

    var payouts = jsonData.map(function(item) {
        return parseInt(item.pay_out);
    });

    var profits = jsonData.map(function(item) {
        return parseInt(item.profit);
    });

    var chartdata = [{
            name: 'Total Cost',
            type: 'bar',
            data: totalCosts
        },
        {
            name: 'Pay Out',
            type: 'bar',
            data: payouts
        },
        {
            name: 'Profit',
            type: 'bar',
            data: profits
        }
    ];

    var barChart = echarts.init(document.getElementById('echart_bar'));

    var option = {
        grid: {
            top: '6',
            right: '0',
            bottom: '17',
            left: '25',
        },
        xAxis: {
            data: transactionDates,
            axisLabel: {
                fontSize: 10,
                color: '#000'
            }
        },
        tooltip: {
            show: true,
            trigger: 'axis',
            axisPointer: {
                type: 'shadow'
            }
        },
        yAxis: {
            axisLabel: {
                fontSize: 10,
                color: '#000'
            }
        },
        series: chartdata,
        color: ['#FF00FF', '#800000', '#1074e1']
    };

    barChart.setOption(option);

    function updatebarChart(newData) {
        // Extract the data you want to use in the updated bar chart
        var transactiondates = newData.map(function(item) {
            return item.transaction_date;
        });

        var totalCosts = newData.map(function(item) {
            return parseInt(item.total_cost);
        });

        var payouts = newData.map(function(item) {
            return parseInt(item.pay_out);
        });

        var profits = newData.map(function(item) {
            return parseInt(item.profit);
        });

        var updatedChartdata = [{
                name: 'Total Cost',
                type: 'bar',
                data: totalCosts
            },
            {
                name: 'Pay Out',
                type: 'bar',
                data: payouts
            },
            {
                name: 'Profit',
                type: 'bar',
                data: profits
            }
        ];

        // Update the series data with the new data
        barChart.setOption({
            xAxis: {
                data: transactiondates,
            },
            series: updatedChartdata,
        });
    }

    $('#bar_chartFilter').click(function() {
        // Perform the AJAX request
        var startDate = $('#start').val();
        var endDate = $('#end').val();
        if ($('#start').val() && $('#end').val()) {
            if ($('#start').val() != $('#end').val()) {
                $.ajax({
                    type: 'POST',
                    url: '<?= site_url() . 'bar_chartBydate' ?>',
                    data: {
                        startdate: startDate,
                        enddate: endDate
                    },
                    success: function(response) {
                        var newData = JSON.parse(response);
                        updatebarChart(newData);
                    },
                    error: function() {
                        // Handle errors, if any
                        $('#result').html('An error occurred.');
                    }
                });
            } else {
                sweetAlert("Fail", "Please Select Different Dates", "error");

            }
        } else {
            sweetAlert("Fail", "Please Select Start Date and End Date Both", "error");
        }


    });
});
</script>