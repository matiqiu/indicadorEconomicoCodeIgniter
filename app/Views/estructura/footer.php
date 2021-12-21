

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
<!-- <canvas id="myChart" width="400" height="400"></canvas> -->
<canvas id="grafico" width="400" height="300"></canvas>
<script type="text/javascript">
    /* function datos(tipo) {
        let enti = new Array(); */
    let prueba

    var select = document.getElementById('select');
    let chart

    select.addEventListener('change',
        function() {
            var selectedOption = this.options[select.selectedIndex];
            console.log(selectedOption.text)
            $.ajax({
                type: "GET",
                async: false,
                url: `https://mindicador.cl/api/${selectedOption.text}`,
                dataType: "json",

                success: function(data) {

                    console.log(data)

                    let fecha = new Array()
                    let valor = new Array()

                    $.each(data.serie, function(i, item) {
                        fecha.push(item.fecha)
                        valor.push(item.valor)
                    })
                    console.log(valor)
                    const grafico = document.getElementById('grafico').getContext('2d');
                    if (chart) {
                        chart.destroy();
                    }
                    chart = new Chart(grafico, {
                        type: "bar",
                        data: {
                            labels: fecha,
                            datasets: [{
                                label: data.nombre,
                                backgroundColor: "rgb(0,0,0)",
                                borderColor: "rgb(0,255,0)",
                                data: valor
                            }]
                        }
                    })
                },
            });
        });
</script>