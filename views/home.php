<?php
use app\core\Application;
?>

<?php

$success = Application::$app->session->getAuth('user');

?>


<div class="row">
    <div class="card card-default col-md-12">
        <div class="card-header">
            <h3 class="card-title">Sales by months</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="chart">
                <div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand">
                        <div class=""></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink">
                        <div class=""></div>
                    </div>
                </div>
                <canvas id="sumSales" style="min-height: 450px; height: 450px; max-height: 450px; max-width: 100%; display: block; width: 634px;" width="634" height="250" class="chartjs-render-monitor"></canvas>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
</div>



<script>
    $(document).ready(function (){
        var url = "/totalSalesPerMonth";

        $.getJSON(url, function (result){
            var labels = result.map(function (e){
                return e.month;
            });

            var sumSales = result.map(function (e){
                return e.totalSum;
            });

            var graph = $("#sumSales").get(0).getContext('2d');

            createGraph(sumSales, labels, graph);
        });



    });


    function createGraph(sumSales, labels, graph){
        new Chart(graph, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    data: sumSales,
                    label: "Monthly sales",
                    backgroundColor: 'rgb(173, 5, 5)',
                    borderColor: 'rgb(173, 5, 5)',
                    fill: false
                }]
            },
            options: {

                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            min: 0,
                        }
                    }]
                },
                legend: {
                    display: true
                }
            }
        });
    }
</script>