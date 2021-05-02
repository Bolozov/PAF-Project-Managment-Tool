@section('page_css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

@stop
<!-- Name Field -->
<div class="form-group col-sm-6 mb-4">
    {!! Form::label('name', 'Nom de la tâche:') !!}
    {!! Form::text('name', $task->name, ['class' => 'form-control']) !!}
</div>

<!-- Deadline Field -->
<div class="form-group col-sm-6 mb-4">
    {!! Form::label('deadline', 'Date limite:') !!}
    {!! Form::date('deadline', $task->deadline->format('Y-m-d') , ['class' => 'form-control','id'=>'deadline' , 'min' => $task->project->start_date_project->format('Y-m-d'),'max' =>  $task->project->end_date_project->format('Y-m-d') ]) !!}
</div>
<!-- Budget Project Field -->
<div class="form-group col-sm-4 mb-4">
    {!! Form::label('budget', 'Budget de cette tâche:') !!} <sup>en DT</sup>
    {!! Form::number('budget', $task->budget, ['class' => 'form-control' , 'max' => $leftBalance, 'min' => 0]) !!}
</div>


<!-- User Id Field -->
<div class="form-group col-sm-4 mb-4">
    {!! Form::label('user_id', 'Affecter à:') !!}
    {!! Form::select('user_id', $projectTeam, $task->assigned_to, ['class' => 'form-control']) !!}

</div>
<!-- User Id Field -->
<div class="form-group col-sm-4 mb-4">
    {!! Form::label('status', 'Statut:') !!}
    {!! Form::select('status', $status, $task->status, ['class' => 'form-control']) !!}


</div>
<div class="form-group col-sm-12 col-md-12 mb-4">
    {!! Form::label('note', 'Notes de tâche:') !!}
    {!! Form::textarea('note') !!}

</div>

{{--@if($task->status != 'validée')--}}
{{--<!-- Verification File Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('verification_file', 'Fichier de vérification:') !!}--}}
{{--    {!! Form::file('verification_file') !!}--}}
{{--</div>--}}
{{--@endif--}}
<!-- Project Id Field -->
<div class="form-group col-sm-6">
    <input type="hidden" name="project_id" value="{{$task->project->id}}">
</div>
<div class="clearfix"></div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Sauvegarder', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('projects.index') }}" class="btn btn-light">Annuler</a>
</div>

@section('page_js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script>
        $('#note').summernote({
            blockquoteBreakingLevel: 2,
            tabsize: 2,
            height: 100,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['fontname', 'strikethrough']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph', 'style']],
                ['height', ['height']]
            ],

        });
        $("#note").summernote('code', );
    </script>
@stop
