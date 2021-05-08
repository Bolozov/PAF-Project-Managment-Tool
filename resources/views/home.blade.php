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
        @role('Admin')
        <div class="row">
            <div class="col-md-6">
                <div class="card card-hero">
                    <div class="card-header">
                        <div class="card-icon">
                            <i class="fas fa-briefcase"></i>

                        </div>
                        <h4>{{ count($projectsEndingThisWeek) }}</h4>


                        <div class="card-description">Projet(s) se terminent cette semaine.</div>
                    </div>
                    <div class="card-body p-0">
                        <div class="tickets-list">
                            @forelse ( $projectsEndingThisWeek as $endingProject)
                            <a href="{{ route('projects.show' , $endingProject->id) }}" class="ticket-item">
                                <div class="ticket-title">
                                    <h4>{{ $endingProject->name_project }}</h4>
                                </div>
                                <div class="ticket-info">
                                    <div data-toggle="tooltip" title="Département">{{ $endingProject->departement->name ?? '' }}</div>
                                    <div class="bullet"></div>
                                    <div data-toggle="tooltip" title="Progrès">{{ $endingProject->getProjectProgressAttribute() }} %</div>
                                    <div class="bullet"></div>
                                    <div data-toggle="tooltip" title="Responsable">{{ $endingProject->responsible->name ?? '' }}</div>
                                    <div class="bullet"></div>
                                    <div class="text-primary">Date limite : {{ $endingProject->end_date_project->format('Y-m-d') }}</div>
                                </div>
                            </a>
                            @empty
                            <p>Rien à afficher.</p>
                            @endforelse
                            <a href="{{ route('projects.index') }}" class="ticket-item ticket-more">
                                Afficher Tous Les Projets <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card card-hero">
                    <div class="card-header">
                        <div class="card-icon">
                            <i class="fas fa-tasks"></i>


                        </div>
                        <h4>{{ count($tasksEndingThisWeek) }}</h4>



                        <div class="card-description">Tâche(s) se terminent cette semaine.</div>
                    </div>
                    <div class="card-body p-0">
                        <div class="tickets-list">
                            @forelse ( $tasksEndingThisWeek as $endingTask)
                            <a href="{{ route('tasks.show' , $endingTask->id) }}" class="ticket-item">
                                <div class="ticket-title">
                                    <h4>{{ $endingTask->name }}</h4>
                                </div>
                                <div class="ticket-info">
                                    <div data-toggle="tooltip" title="Projet">{{ $endingTask->project->name_project ?? '' }}</div>
                                    <div class="bullet"></div>
                                    <div data-toggle="tooltip" title="Responsable">{{ $endingTask->user->name ?? '' }}</div>
                                    <div class="bullet"></div>
                                    <div class="text-primary">Date limite : {{ $endingTask->deadline->format('Y-m-d') }}</div>
                                </div>
                            </a>
                            @empty
                            <p>Rien à afficher.</p>
                            @endforelse
                            <a href="{{ route('tasks.index') }}" class="ticket-item ticket-more">
                                Afficher Toutes Les Tâches <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        @endrole
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
                        <div class="section-title mt-2 mb-2 ">{{ $projectStatusByMonth->options['chart_title'] }}
                            : {{ date('m/ Y') }}</div>

                        {!! $projectStatusByMonth->renderHtml() !!}
                    </div>
                </div>
            </div>
        </div>
        @if(auth()->user()->hasRole('Admin'))
        {{-- <button onclick="PrintAllChart()">Print All Charts</button> --}}

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="section-title mt-2 mb-2">{{ $projectsByDepartment->options['chart_title'] }}</div>

                        {!! $projectsByDepartment->renderHtml() !!}
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
{{-- <script src="{{ asset('assets/js/jspdf.umd.min.js') }}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>



<script>
    function PrintAllChart() {
        const dateObj = new Date()
        const monthNumber = dateObj.getMonth()
        const year = dateObj.getFullYear()


        var nouveaux_projets_chaque_mois = document.getElementById("nouveaux_projets_chaque_mois");
        var etat_des_projets = document.getElementById("etat_des_projets");
        var projets_par_departement = document.getElementById("projets_par_departement");
        var imgData = nouveaux_projets_chaque_mois.toDataURL()
        var doc = new jsPDF()

        doc.setFontSize(40)
        doc.text(35, 25, 'Paranyan loves jsPDF')
        doc.addImage(imgData, 'JPEG', 15, 40, 180, 160)
        doc.save('Test.pdf');


        /**var win = window.open();

        win.document.write("Nouveaux projets chaque mois : <br><img src='" + nouveaux_projets_chaque_mois.toDataURL() + "' />");


        win.document.write("État des projets - " + monthNumber + '/' + year + " : <br><img src='" + etat_des_projets.toDataURL() + "' />");


        win.document.write("Projets par département : <br><img src='" + projets_par_departement.toDataURL() + "' />");

        win.print();
        win.location.reload();*/
    }

</script>
@endsection
