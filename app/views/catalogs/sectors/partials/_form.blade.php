{{ Form::label('name', 'Sector') }}
@if($errors->has('name'))
    <span class="text-danger">{{ $errors->first('name') }}</span>
@endif
{{ Form::text('name', null, ['class'=>'form-control', 'placeholder' => 'sector', 'required'=>'', 'autofocus'=>'']) }}

{{ Form::label('description', 'Descripción') }}
@if($errors->has('description'))
    <span class="text-danger">{{ $errors->first('description') }}</span>
@endif
{{ Form::textarea('description', null, ['class' => 'form-control', 'autofocus'=>'']) }}