@extends('layouts.user_type.auth')

@section('content')
    <div class="text-center">
        <h3>Cantidad De Trabajos Segun Su Estado En Base A La Empresa</h3>
        <div id="chart_div" style="width: 100%; height: 600px;"></div>
    </div>
    <div class="mt-4 text-center">
        <h3>Cantidad De Trabajos Habilitados Por Area</h3>
        <div id="chart_div2" style="width: 100%; height: 600px;"></div>
    </div>
@endsection
@push('dashboard')
    <script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
    <script type='text/javascript'>
        google.charts.load('current', {
            'packages': ['geochart', 'corechart'],
            'mapsApiKey': 'AIzaSyA7OuuczmOUALvosZeUooXv421gnVX1zzI'
        });
        google.charts.setOnLoadCallback(function() { // Anonymous function that calls drawChart1 and drawChart2
            drawMarkersMap();
            drawChart();            
        });

        function drawMarkersMap() {
            /* var data = google.visualization.arrayToDataTable([
                ['City', 'Disponibles', 'Finalizados'],
                ['La Paz', 2761477, 1285.31],
                ['Santa Cruz', 1324110, 181.76],
                ['Cochabamba', 959574, 117.27],
            ]); */
            var databody = [];
            var dataRow = [];
            var cantTrabXCiudad = <?php echo json_encode($cantTrabXCiu); ?>;
            var ciudad = cantTrabXCiudad[0].ciudad;
            dataRow.push(ciudad);
            cantTrabXCiudad.forEach(function(cantTrabXCiu) {
                var cantidad = cantTrabXCiu.cantidad_trabajos;
                if (ciudad == cantTrabXCiu.ciudad) {
                    dataRow.push(cantidad);
                } else {
                    if (dataRow.length < 3) {
                        while (dataRow.length < 3) {
                            dataRow.push(0);
                        }
                    } else {
                        databody.push([...dataRow]);
                        dataRow = [];
                        ciudad = cantTrabXCiu.ciudad;
                        dataRow.push(ciudad);
                        dataRow.push(cantidad);
                    }
                }
            });
            while (dataRow.length < 3) {
                dataRow.push(0);
            }
            databody.push(dataRow);
            console.log(databody);
            /* var dataHeader=[];
            dataHeader.push(['City', 'Disponibles', 'Finalizados']); */
            var data = new google.visualization.arrayToDataTable([
                ['City', 'Finalizados', 'Disponibles'],
                ...databody
            ]);
            /* data.addColumn('string', 'City');
            data.addColumn('number', 'Finalizados');
            data.addColumn('number', 'Disponibles');            
            data.addRows([
                ...databody
            ]); */


            var options = {
                region: 'BO',
                displayMode: 'markers',
                colorAxis: {
                    colors: ['green', 'blue']
                }
            };

            var chart = new google.visualization.GeoChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        };

        function drawChart() {

            /* var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['Work', 11],
                ['Eat', 2],
                ['Commute', 2],
                ['Watch TV', 2],
                ['Sleep', 7]
            ]); */
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Nombre');
            data.addColumn('number', 'Cantidad');

            // Agrega las filas de datos desde la variable de Blade
            data.addRows([
                @foreach ($trabajosPorArea as $resultado)
                    ['{{ $resultado->area }}', {{ $resultado->cantidad_de_trabajos }}],
                @endforeach
            ]);

            var options = {
                title: 'Cantidad De Trabajos Habilitados Por Area'
            };

            var chart = new google.visualization.PieChart(document.getElementById('chart_div2'));

            chart.draw(data, options);
        }
    </script>
@endpush
