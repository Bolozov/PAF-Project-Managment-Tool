<div class="card-body">
    <ul class="nav nav-pills mb-2" id="project-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active show" id="project-overview" data-toggle="tab" href="#overview" role="tab"
               aria-controls="home" aria-selected="true"><i class="fas fa-bullseye"></i> Aperçu général</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="project-tasks" data-toggle="tab" href="#tasks" role="tab" aria-controls="profile"
               aria-selected="false"> <i class="fas fa-tasks"></i> Tâches</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="projects-statistics" data-toggle="tab" href="#statistics" role="tab"
               aria-controls="contact" aria-selected="false"><i class="far fa-chart-bar"></i> Statistiques</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active show" id="overview" role="tabpanel" aria-labelledby="project-overview">
            @include('projects.details.overveiew')
        </div>
        <div class="tab-pane fade" id="tasks" role="tabpanel" aria-labelledby="project-tasks">
            @include('projects.details.tasks')
        </div>
        <div class="tab-pane fade" id="statistics" role="tabpanel" aria-labelledby="projects-statistics">
            @include('projects.details.statiscs')
        </div>
    </div>
</div>
@section('page_js')
<script>
    // Javascript to enable link to tab
    var hash = location.hash.replace(/^#/, ''); // ^ means starting, meaning only match the first hash
    
    if (hash) {
        $('.nav-pills a[href="#' + hash + '"]').tab('show');

    }

</script>

@endsection




