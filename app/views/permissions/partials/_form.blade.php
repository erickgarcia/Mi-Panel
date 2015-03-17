{{ Form::label('name', 'Código del Permiso') }}
@if($errors->has('name'))
    <span class="text-danger">{{ $errors->first('name') }}</span>
@endif
{{ Form::text('name', null, ['placeholder' => 'Código', 'required'=>'']) }}

{{ Form::label('display_name', 'Nombre del Permiso') }}
@if($errors->has('display_name'))
    <span class="text-danger">{{ $errors->first('display_name') }}</span>
@endif
{{ Form::text('display_name', null, ['placeholder' => 'Permiso', 'required'=>'']) }}