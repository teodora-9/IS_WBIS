<div class="sparkline" data-type="bar" data-width="97%" data-height="100px" data-bar-width="14" data-bar-spacing="7" data-bar-color="#f39c12">
    <h3>Kolicina aktivnih proizvoda na stanju</h3>
    <canvas id="productsAvailable" width="224" height="100" style="display: inline-block;
    width: 224px; height: 100px; vertical-align: top;"></canvas>
</div>
</div>
<script>
    $(document).ready(function (){

        var urlActive = "/productAmount";

        $.getJSON(urlActive, function (result){
            var labelsActive = result.map(function (e){
                return e.name;
            });

            var productAmount = result.map(function (e){
                return e.unit;
            });

            var dynamicColors = function() {
                var r = Math.floor(Math.random() * 255);
                var g = Math.floor(Math.random() * 255);
                var b = Math.floor(Math.random() * 255);
                return "rgb(" + r + "," + g + "," + b + ")";
            }

            var numOfProducts = productAmount.length;

            let randColor = new Array(numOfProducts);
            let randBackColor = new Array(numOfProducts);

            for (var i = 0; i <= numOfProducts; i++){
                randColor[i] = dynamicColors();
                randBackColor[i] = dynamicColors();
            }


            var setData = {
                labels: labelsActive,
                datasets: [
                    {
                        data: productAmount,
                        backgroundColor: randColor,//["#669911", "#119966", "#123598"],
                        hoverBackgroundColor: randBackColor //["#66A2EB", "#FCCE56"]
                    }]
            }

            var graphActive = $("#productsAvailable").get(0).getContext('2d');

            createBarGraph(setData, labelsActive, graphActive);
        });
    });

    function createBarGraph(setData, labelsActive, graphActive){
        new Chart(graphActive, {

            type: 'bar',
            data: setData
        });
    }


</script>