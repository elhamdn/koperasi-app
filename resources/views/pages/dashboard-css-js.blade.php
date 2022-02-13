@section('css')
    <style>
        
    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            const dataGrafikSimpanan = {!! json_encode($grafikSimpanan) !!}
            const dataGrafikAngsuran = {!! json_encode($grafikAngsuran) !!}

            const configSimpanan = {
                type: 'bar',
                data: setConfigChart(dataGrafikSimpanan, 'Simpanan', '30, 255, 180'),
                options: {}
            };

            const chartSimpanan = new Chart(
                document.getElementById('grafikSimpanan'),
                configSimpanan
            );

            const configAngsuran = {
                type: 'bar',
                data: setConfigChart(dataGrafikAngsuran, 'Angsuran', '30, 143, 255'),
                options: {}
            };

            const chartAngsuran = new Chart(
                document.getElementById('grafikAngsuran'),
                configAngsuran
            );

            function setConfigChart(dataGrafik, tag, color){
                const labels = [];
                const data_biaya = []

                dataGrafik.reverse().map( (item, index) => {
                    if(index > 0){
                        labels.push(moment().subtract(index, 'months').format('MMMM YYYY'))
                    }else{
                        labels.push(moment().format('MMMM YYYY'))
                    }
                    data_biaya.push(item.total_biaya)
                })

                labels.reverse()
                data_biaya.reverse()

                const data = {
                    labels: labels,
                    datasets: [{
                    label: `Data ${tag} Per Bulan`,
                    backgroundColor: [
                        `rgba(${color}, 0.8)`
                    ],
                    borderColor: [
                        `rgb(${color})`
                    ],
                    data: data_biaya,
                    }]
                };

                return data
            }
        });

    </script>
@stop
