@extends('layouts.app')
@section('title')
    Dashboard
@endsection
@section('page_css')
    <style>

    </style>
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Tableau de bord</h3>

        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Projets</h4>
                            </div>
                            <div class="card-body">
                                {{$projectCount}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="far fa-newspaper"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Tâches</h4>
                            </div>
                            <div class="card-body">
                                {{$tasksCount}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Budget <sup>DT</sup></h4>
                            </div>
                            <div class="card-body">
                                {{number_format($totalBudget, 2, ',', ' ')  }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Membre actifs</h4>
                            </div>
                            <div class="card-body">
                                {{ $actifUsersCount  }} / {{ $usersCount }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body ">
                            <div class="section-title mt-2 mb-2 ">{{ $projectsByMonth->options['chart_title'] }}</div>

                            {!! $projectsByMonth->renderHtml() !!}
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 ">
                    <div class="card">
                        <div class="card-body">
                            <div
                                class="section-title mt-2 mb-2 ">{{ $projectStatusByMonth->options['chart_title'] }}
                                : {{ date('m/ Y') }}</div>

                            {!! $projectStatusByMonth->renderHtml() !!}
                        </div>
                    </div>
                </div>
            </div>
            @if(auth()->user()->hasRole('Admin'))
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div
                                    class="section-title mt-2 mb-2">{{ $projectsByDepartment->options['chart_title'] }}</div>

                                {!!    $projectsByDepartment->renderHtml() !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

@section('scripts')
    {!! $projectsByMonth->renderChartJsLibrary() !!}
    {!! $projectsByMonth->renderJs() !!}
    {!! $projectStatusByMonth->renderJs() !!}
    {!! $projectsByDepartment->renderJs() !!}
@endsection
