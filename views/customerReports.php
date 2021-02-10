<div class="row">
    <div class="card card-default col-md-12">
        <div class="card-header">
            <h3 class="card-title">Broj novih kupaca u poslednjih mesec dana</h3>
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
                <canvas id="customerNumber" style="min-height: 450px; height: 450px; max-height: 450px; max-width: 100%; display: block; width: 634px;" width="634" height="250" class="chartjs-render-monitor"></canvas>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
</div>

<div class="row">
    <div class="container-fluid col-md-6">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Aktivni-Neaktivni kupci</h3>
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
                    <canvas id="customerActive" style="min-height: 350px; height: 350px; max-height: 350px; max-width: 100%; display: block; width: 634px;" width="634" height="250" class="chartjs-render-monitor"></canvas>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class="container-fluid col-md-6">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Aktivni-Neaktivni kupci pie chart</h3>
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
                    <canvas id="customerActivePie" style="min-height: 350px; height: 350px; max-height: 350px; max-width: 100%; display: block; width: 634px;" width="634" height="250" class="chartjs-render-monitor"></canvas>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

<script>
    $(document).ready(function (){
        var url = "/customersPerDay";

        $.getJSON(url, function (result){
            var labels = result.map(function (e){
               return e.dateCreated;
            });

            var numberOfCustomers = result.map(function (e){
                return e.numberOfCustomers;
            });

            var graph = $("#customerNumber").get(0).getContext('2d');

            createGraph(numberOfCustomers, labels, graph);
        });

        var urlActive = "/customersActive";

        $.getJSON(urlActive, function (result){
            var labelsActive = result.map(function (e){
                return e.active;
            });

            var numberOfCustomersActive = result.map(function (e){
                return e.numberOfCustomers;
            });

            var setData = {
                labels: labelsActive,
                datasets: [
                    {
                        label: "Odnos aktivnih i neaktivnih kupaca",
                        data: numberOfCustomersActive,
                        backgroundColor: ["#669911", "#119966" ],
                        hoverBackgroundColor: ["#66A2EB", "#FCCE56"]
                    }]
            }

            var graphActive = $("#customerActive").get(0).getContext('2d');
            var graphActivePie = $("#customerActivePie").get(0).getContext('2d');

            createBarGraph(setData, labelsActive, graphActive);
            createPieGraph(setData, labelsActive, graphActivePie);
        });
    });

    function createBarGraph(setData, labelsActive, graphActive){
        new Chart(graphActive, {
            type: 'horizontalBar',
            data: setData,
            options: {
                scales: {

                    xAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        })
    }

    function createPieGraph(setData, labelsActive, graphActive){
        new Chart(graphActive, {
            type: 'pie',
            data: setData
        });
    }

    function createGraph(numberOfCustomers, labels, graph){
        new Chart(graph, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    data: numberOfCustomers,
                    label: "Dodati kupci po datumima",
                    backgroundColor: 'rgb(173, 5, 5)',
                    borderColor: 'rgb(173, 5, 5)',
                    fill: false
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "Dodati kupci po datumima u poslednjih mesec dana"
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            max: 50,
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