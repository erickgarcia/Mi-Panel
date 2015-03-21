@extends('layouts.main')
@section('title')
    Actualizar contraseña
@stop
@section('body')
<div class="col-xs-12">
    <div class="center-block" style="width: 35%">
        {{ Form::open(array('route'=>'account.change.password.process', 'class'=> 'form-signin')) }}
        <h2 class="form-signin-heading">Actualizar contraseña</h2>
        {{ Form::label('old_password', 'Contraseña actual', ['class'=>'sr-only']) }}
        @if($errors->has('old_password'))
            <span class="small text-danger">{{ $errors->first('old_password') }}</span>
        @endif
        {{ Form::password('old_password', ['class' => 'form-control', 'placeholder' => 'contraseña actual', 'required'=>'']) }}

        {{ Form::label('password', 'Nueva Contraseña', ['class'=>'sr-only']) }}
        @if($errors->has('password'))
            <span class="small text-danger">{{ $errors->first('password') }}</span>
        @endif
        {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'nueva contraseña', 'required'=>'']) }}

        {{ Form::label('password_again', 'Nueva Contraseña', ['class'=>'sr-only']) }}
        @if($errors->has('password_again'))
            <span class="small text-danger">{{ $errors->first('password_again') }}</span>
        @endif
        {{ Form::password('password_again', ['class' => 'form-control', 'placeholder' => 'nueva contraseña', 'required'=>'']) }}

        {{ Form::submit('Enviar', array('class' => 'btn btn-lg btn-primary btn-block')) }}
        {{ Form::close() }}
        <div class="clearfix"></div>
    </div>
</div> <!-- /container -->
@stop
