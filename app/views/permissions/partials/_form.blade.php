{{ Form::label('name', 'Código del Permiso') }}
@if($errors->has('name'))
    <span class="text-danger">{{ $errors->first('name') }}</span>
@endif
{{ Form::text('name', null, ['class'=>'form-control', 'placeholder' => 'código', 'required'=>'', 'autofocus'=>'']) }}

{{ Form::label('display_name', 'Descripción del Permiso') }}
@if($errors->has('display_name'))
    <span class="text-danger">{{ $errors->first('display_name') }}</span>
@endif
{{ Form::text('display_name', null, ['class'=>'form-control', 'placeholder' => 'descripción', 'required'=>'', 'autofocus'=>'']) }}