@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <form class="form-inline">
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <input type="hidden" class="form-control flatpickr-input" id="dash-daterange" readonly="readonly"/>
                            <div class="input-group-append">
                                <span class="input-group-text bg-blue border-blue text-white">
                                    <i class="mdi mdi-calendar-range"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <h4 class="page-title">Dashboard</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-xl-4">
        <div class="widget-rounded-circle card-box">
            <div class="row slimscroll row-1-items">
                <div class="table-responsive ml-2">
                    <table class="table table-borderless table-hover table-centered m-0 slimScrollBar">
                        <thead class="thead-light">
                        <tr>
                            <th>{{ trans('global.category') }}</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @for($index = 0; $index < sizeof($detection_cnt) - 1; $index+=2)
                            <tr>
                                <td title="{{ session('dec_type')[$detection_cnt[$index]->type] }}">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="avatar-md rounded-circle border-dark border">
                                                <i class="{{ $notification_icons[$detection_cnt[$index]->type] }} font-22 avatar-title text-dark"></i>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-left icon-left">
                                                <h3 class="text-dark mt-1">{{ number_format($detection_cnt[$index]->count) }}</h3>
                                                <p class="text-muted mb-1 text-truncate">{{ session('dec_type')[$detection_cnt[$index]->type] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td title="{{ session('dec_type')[$detection_cnt[$index + 1]->type] }}">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="avatar-md rounded-circle border-dark border">
                                                <i class="{{ $notification_icons[$detection_cnt[$index + 1]->type] }} font-22 avatar-title text-dark"></i>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-left icon-left">
                                                <h3 class="text-dark mt-1">{{ number_format($detection_cnt[$index + 1]->count) }}</h3>
                                                <p class="text-muted mb-1 text-truncate">{{ session('dec_type')[$detection_cnt[$index + 1]->type] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endfor
                        </tbody>
                    </table>
                </div>
            </div> <!-- end row-->
        </div> <!-- end widget-rounded-circle-->
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-3" id="morris-donut-dec-div">
        <!-- Portlet card -->
        <div class="card-box">
            <div class="m-auto">
                <h4 class="header-title mb-2">{{ trans('cruds.detections.fields.detection_level') }}</h4>
                <div id="morris-donut-dec-level" class="morris-chart m-auto" style="height: 220px;"></div>
                <div class="row mt-3">
                    @foreach($detection_count_level as $key => $row)
                    <div class="col-4">
                        <p class="text-muted font-15 mb-1 text-center text-truncate" title="{{ session('dec_level')[$row->detection_level] }}">{{ session('dec_level')[$row->detection_level] }}</p>
                        <h4 class="text-center">{{ $row->count }}</h4>
                    </div>
                    @endforeach
                </div>

            </div> <!-- end row-->
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="widget-rounded-circle card-box">
            <div class="row align-items-center row-1-items">
                <div class="col">
                    <h3 class="ml-3 mb-lg-2" style="font-size: 2rem;">{{ number_format($takedown_cnt) }}
                        <p class="ml-0 text-muted mb-5" style="font-size: 1rem;">{{ trans('global.take_down') }}</p>
                    </h3>
                </div>
                <div class="col">
                    <div class="bomb-lg m-auto">
                        <img src="{{ asset('assets/images/bomb-drop.png') }}" class="img-fluid">
                    </div>
                </div>
            </div> <!-- end row-->
        </div> <!-- end widget-rounded-circle-->
    </div>

    <div class="col-md-6 col-xl-2">
        <div class="widget-rounded-circle card-box">
            <div class="row slimscroll row-1-items">
                <div class="table-responsive ml-2">
                    <table class="table table-borderless table-hover table-centered m-0 slimScrollBar">
                        <thead class="thead-light">
                            <tr>
                                <th>{{ trans('global.tags') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                          $index = 0;
                        @endphp
                        @foreach($tag_ranking as $key => $val)
                            @php
                                $index ++;
                            @endphp
                        <tr>
                            <td>
                                <h5 class="m-0 font-weight-normal">{{ $index.'. '.$key.' ('.$val.')' }}</h5>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div> <!-- end row-->
        </div> <!-- end widget-rounded-circle-->
    </div> <!-- end col-->
</div>

<div class="row">
    <div class="col-md-6 col-xl-4">
        <div class="widget-rounded-circle card-box">
            <div class="row-2-items">
                <div id="morris-donut-dec-type" class="morris-chart"></div>
            </div> <!-- end row-->
        </div> <!-- end widget-rounded-circle-->
    </div>

    <div class="col-md-6 col-xl-4">
        <div class="widget-rounded-circle card-box">
            <div class="row slimscroll row-2-items">
                <div class="table-responsive ml-2">
                    <table class="table table-borderless table-hover table-centered m-0 slimScrollBar">
                        <thead class="thead-light">
                        <tr>
                            <th>{{ trans('global.ioc_type') }}</th>
                            <th>{{ trans('global.content') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($iocRes as $key => $val)
                        <tr>
                            <td>
                                <h5 class="m-0 font-weight-normal">{{ session('ioc')[explode('|*\/*|', $key)[0]] }}</h5>
                            </td>
                            <td>
                                {{ explode('|*\/*|', $key)[1] }} ({{ $val }})
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div> <!-- end row-->
        </div> <!-- end widget-rounded-circle-->
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="float-right d-md-inline-block">
                    <div class="btn-group mb-1">
                        <button type="button" class="btn btn-xs btn-secondary" id="btn_weekly">Weekly</button>
                        <button type="button" class="btn btn-xs btn-light" id="btn_monthly">Monthly</button>
                    </div>
                </div>
                <div class="mt-4">
                    <div id="area-dec-chart" class="morris-chart"></div>
                </div>
            </div> <!-- end card-body-->
        </div>
    </div> <!-- end col-->
</div>
@endsection
@push('css')
    <!-- third party css -->
    <link href="{{ asset('assets/libs/jquery-toast/jquery.toast.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Flat Picker -->
    <link href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- third party css end -->
    <style>
        .row-1-items {
            min-height: 332px;
            max-height: 332px;
        }
        .row-2-items {
            min-height: 377px;
            max-height: 377px;
        }
        .bomb-lg
        {
            height: 1.5rem;
            width: 5.2rem;
        }
        .icon-left
        {
            margin-left: -1.5vw;
        }
        .border
        {
            border: 2px solid !important;
        }

        .flatpickr-input
        {
            width: 210px !important;
        }

        @media only screen and (max-width: 1024px) {

        }

    </style>
@endpush

@push('js')
        <!-- third party js -->
        <script src="{{ asset('assets/libs/jquery-toast/jquery.toast.min.js') }}"></script>
        <script src="{{ asset('assets/libs/morris-js/morris.min.js') }}"></script>
        <script src="{{ asset('assets/libs/raphael/raphael.min.js') }}"></script>

        <!-- Flat Picker -->
        <!-- https://cdnjs.com/libraries/flatpickr  Flatpickr js cnd library-->
        <script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
        <script src="{{ asset('assets/libs/flatpickr/lang/pt.min.js') }}"></script>

        <!-- Flot chart -->
        <script src="{{ asset('assets/libs/flot-charts/jquery.flot.js') }}"></script>
        <script src="{{ asset('assets/libs/flot-charts/jquery.flot.tooltip.min.js') }}"></script>

        <script src="{{ asset('assets/libs/flot-charts/jquery.flot.pie.js') }}"></script>

        <!-- third party js ends -->

        <!-- Datatables init -->
        <script>
            $(document).ready(function(){
                $("#dash-daterange").flatpickr({
                    altInput: true,
                    dateFormat: 'Y-m-d',
                    mode: "range",
                    altFormat: "m/d/Y",
                    defaultDate: "today",
                    locale: '{{ session('cur_lang') }}',
                    onChange: function(selectedDates, dateStr, instance) {
                        console.log(selectedDates);
                    }
                });

                let pie_color = ['#ff0000', '#3498DB', '#ffe971'];
                var data = [
                        @foreach($detection_count_level as $key => $row)
                            {label: "{{ session('dec_level')[$row->detection_level] }}", data: "{{ $row->count }}", color: pie_color[{{ $key }}]},
                        @endforeach
                    ];

                var options = {
                    series: {
                        pie: {
                            show: true,
                            label: {show: true},
                            innerRadius: 0.87,
                            radius: 1,
                        },
                    },
                    legend: {show: false},
                    grid: {
                        hoverable: true
                    },
                    tooltip: false,
                    tooltipOpts: {
                        content: "%s: %p.0%",
                        defaultTheme: false,
                    }
                };

                $.plot($("#morris-donut-dec-level"), data, options);

                var barColorsArray = ['#ff0000', '#3498DB', '#ffe971','#26B99A', '#DE8244',
                    '#1fc02f', '#887aff','#DE8244'];
                var colorIndex = -1;
                data = [
                    @foreach($detection_cnt as $row)
                        { y: '{{ session('dec_type')[$row->type] }}', a: '{{ $row->count }}'},
                    @endforeach
                    ],
                config = {
                    data: data,
                    xkey: 'y',
                    ykeys: ['a'],
                    labels: ['{{ trans('global.count') }}'],
                    fillOpacity: 0.6,
                    hideHover: 'auto',
                    behaveLikeLine: true,
                    resize: true,
                    pointFillColors:['#ffffff'],
                    pointStrokeColors: ['black'],
                    lineColors:['gray','red'],
                    barColors: function (row) {
                        return barColorsArray[row.x];
                    },
                };
                config.element = 'morris-donut-dec-type';
                Morris.Bar(config);

                data = [
                    @foreach($decWeeklyCount as $key=>$val)
                    { y: '{{ $key }}', a: '{{ $val }}'},
                    @endforeach
                ];
                config = {
                    data: data,
                    xkey: 'y',
                    ykeys: ['a'],
                    labels: ['{{ trans('global.count') }}'],
                    fillOpacity: 0.6,
                    hideHover: 'auto',
                    behaveLikeLine: true,
                    resize: true,
                    pointFillColors:['#ffffff'],
                    pointStrokeColors: ['black'],
                    lineColors:['#eaca06','grey']
                };
                config.element = 'area-dec-chart';
                Morris.Area(config);

                $('#btn_weekly').click(function(){
                    $('#area-dec-chart').empty();
                    $(this).removeClass('btn-light');
                    $(this).addClass('btn-secondary');
                    $('#btn_monthly').removeClass('btn-secondary');
                    $('#btn_monthly').addClass('btn-light');
                    data = [
                            @foreach($decWeeklyCount as $key=>$val)
                        { y: '{{ $key }}', a: '{{ $val }}'},
                        @endforeach
                    ];
                    config = {
                        data: data,
                        xkey: 'y',
                        ykeys: ['a'],
                        labels: ['{{ trans('global.count') }}'],
                        fillOpacity: 0.6,
                        hideHover: 'auto',
                        behaveLikeLine: true,
                        resize: true,
                        pointFillColors:['#ffffff'],
                        pointStrokeColors: ['black'],
                        lineColors:['#eaca06','grey']
                    };
                    config.element = 'area-dec-chart';
                    Morris.Area(config);
                });

                $('#btn_monthly').click(function(){
                    $('#area-dec-chart').empty();
                    $(this).removeClass('btn-light');
                    $(this).addClass('btn-secondary');
                    $('#btn_weekly').removeClass('btn-secondary');
                    $('#btn_weekly').addClass('btn-light');
                    data = [
                            @foreach($decMonthlyCount as $key=>$val)
                        { y: '{{ $key }}', a: '{{ $val }}'},
                        @endforeach
                    ];
                    config = {
                        data: data,
                        xkey: 'y',
                        ykeys: ['a'],
                        labels: ['{{ trans('global.count') }}'],
                        fillOpacity: 0.6,
                        hideHover: 'auto',
                        behaveLikeLine: true,
                        resize: true,
                        pointFillColors:['#ffffff'],
                        pointStrokeColors: ['black'],
                        lineColors:['#eaca06','grey']
                    };
                    config.element = 'area-dec-chart';
                    Morris.Area(config);

                });


            });
        </script>
@endpush

