@section('css')
    <style>
        .charts , #task_by_status{

            height:300px !important;

        }
    </style>
@endsection
<div class="card card-primary">
    <div class="card-body">
        {{--        <div class="row justify-content-center">--}}
        {{--            <div class="col-md-8">--}}
        {{--                <div class="card">--}}
        {{--                    <div class="card-header">Dashboard</div>--}}

        {{--                    <div class="card-body">--}}

        {{--                        <h1>{{ $chart1->options['chart_title'] }}</h1>--}}
        {{--                        {!! $chart1->renderHtml() !!}--}}

        {{--                    </div>--}}

        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card card-light">
                    <div class=" card-header section-title mt-2 mb-2">{{ $chart1->options['chart_title'] }}</div>

                    <div class="card-body ">
                        {!! $chart1->renderHtml() !!}

                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
                <div class=" card-header section-title mt-2 mb-2">Avancement du projet</div>

                <div class="card card-light">

                    <div class="card-body charts">
                        <canvas id="chartProgress" ></canvas>

                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-12">
                <div class=" card-header section-title mt-2 mb-2">{{ $tasksLineChart->options['chart_title']}}</div>

                <div class="card card-light">
                    <div class="card-body ">


                        {!! $tasksLineChart->renderHtml() !!}

                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card-header section-title mt-2 mb-2">{{  $progressLineChart->options['chart_title']}}</div>

                <div class="card card-light">

                    <div class="card-body ">


                        {!!  $progressLineChart->renderHtml() !!}

                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
@section('scripts')
    {!! $chart1->renderChartJsLibrary() !!}

    {!! $chart1->renderJs() !!}
    {!! $tasksLineChart->renderJs() !!}
    {!! $progressLineChart->renderJs() !!}


    {{--    Displaying Progress Chart--}}
    <script>
        let myChartCircle = new Chart('chartProgress', {
            type: 'doughnut',
            data: {
                datasets: [{
                    label: "{{$project->name_project}}",
                    percent: parseFloat( {{ $project->projectProgress }}),
                    backgroundColor: ['#5283ff']
                }]
            },
            plugins: [{
                beforeInit: (chart) => {
                    const dataset = chart.data.datasets[0];
                    chart.data.labels = ["Tâches accomplies %", " Tâches en cours %"];
                    dataset.data = [dataset.percent, 100 - dataset.percent];
                }
            },
                {
                    beforeDraw: (chart) => {
                        var width = chart.chart.width,
                            height = chart.chart.height,
                            ctx = chart.chart.ctx;
                        ctx.restore();
                        var fontSize = (height / 90).toFixed(2);
                        ctx.font = fontSize + "em sans-serif";
                        ctx.fillStyle = "#9b9b9b";
                        ctx.textBaseline = "middle";
                        var text = chart.data.datasets[0].percent + "%",
                            textX = Math.round((width - ctx.measureText(text).width) / 2),
                            textY = height / 2;
                        ctx.fillText(text, textX, textY);
                        ctx.save();
                    }
                }
            ],
            options: {
                maintainAspectRatio: false,
                responsive: true,
                cutoutPercentage: 85,

                rotation: Math.PI / 2,
                tooltips: {
                    mode: 'index'
                },
                legend: {
                    display: false,
                },


            }
        });
        let progress = {{$project->projectProgress}}
        console.log(progress);
    </script>

@endsection
