<!-- Ref Project Field -->
<div class="form-group col-sm-4">
    {!! Form::label('ref_project', ' Référence du projet:') !!}
    <div class="input-group">
        <input type="text" class="form-control" placeholder="" id="ref_project" name="ref_project">

        <div class="input-group-append">
            <button class="btn btn-primary" type="button" onclick="getRndInteger()">Générer</button>
        </div>
    </div>
    <script>
        function getRndInteger(min, max) {
            let randomRef = Math.floor(Math.random() * (9999 - 999999)) + 999999;
            $('#ref_project').val(randomRef)
        }

    </script>

</div>

<!-- Name Project Field -->
<div class="form-group col-sm-4">
    {!! Form::label('name_project', 'Nom du Projet:') !!}
    {!! Form::text('name_project', null, ['class' => 'form-control']) !!}
</div>

<!-- Budget Project Field -->
<div class="form-group col-sm-4">
    {!! Form::label('budget_project', 'budget:') !!}
    {!! Form::number('budget_project', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-3">
    {!! Form::label('departement', 'Département:') !!}
    {!! Form::select('departement_id',$departements,null, ['class' => 'form-control' , 'placeholder' => '']) !!}


</div>
<div class="form-group col-sm-3">
    {!! Form::label('service', 'Service:') !!}
    {!! Form::select('service_id',$services,null, ['class' => 'form-control' , 'placeholder' => '']) !!}


</div>
<div class="form-group col-sm-6">
    {!! Form::label('team', 'Équipe:') !!}
    {!! Form::select('users_id',$users,null, ['class' => 'form-control select2' , 'name'=>"users_id[]" , 'multiple'=>"multiple"]) !!}

    <script>

    </script>


</div>


<!-- Start Date Project Field -->
<div class="form-group col-sm-6">
    {!! Form::label('start_date_project', 'Date de début:') !!}
    {!! Form::date('start_date_project', null, ['class' => 'form-control datepicker','id'=>'start_date_project']) !!}

</div>


<!-- End Date Project Field -->
<div class="form-group col-sm-6">
    {!! Form::label('end_date_project', 'Date de fin:') !!}
    {!! Form::date('end_date_project', null, ['class' => 'form-control','id'=>'end_date_project']) !!}

</div>


<!-- Responsible Id Project Field -->
<div class="form-group col-sm-6">
    {!! Form::label('responsible_id_project', 'Responsable du projet:') !!}
    {!! Form::select('responsible_id_project', $chefProjectUsers, null, ['class' => 'form-control']) !!}

</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('projects.index') }}" class="btn btn-light">Cancel</a>
</div>
