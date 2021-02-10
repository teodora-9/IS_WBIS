<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Number of invoices per month</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
        <div class="chart">
            <canvas id="invoiceNumber" style="height: 201px; width: 478px;" height="251" width="597"></canvas>
        </div>
    </div>
    <!-- /.box-body -->
</div>

<script>
    $(document).ready(function (){

        var urlActive = "/invoicesPerMonth";

        $.getJSON(urlActive, function (result){
            var labelsActive = result.map(function (e){
                return e.month;
            });

            var numberOfInvoices = result.map(function (e){
                return e.numberOfInvoices;
            });

            var setData = {
                labels: labelsActive,
                datasets: [
                    {

                        data: numberOfInvoices,
                        backgroundColor: ["#89cff0"],
                        hoverBackgroundColor: ["#66A2EB"]
                    }]
            }

            var graphActive = $("#invoiceNumber").get(0).getContext('2d');

            createBarGraph(setData, labelsActive, graphActive);
        });
    });

    function createBarGraph(setData, labelsActive, graphActive){
        new Chart(graphActive, {

            type: 'line',
            data: setData
        });
    }




</script>