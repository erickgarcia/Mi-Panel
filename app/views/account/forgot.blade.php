@extends('layouts.main')
@section('title')
    Recuperar contraseña
@stop
@section('body')
<div class="col-xs-12">
    <div class="center-block" style="width: 35%">
        {{ Form::open(array('route'=>'account.forgot.password.process', 'class'=> 'form-signin')) }}
        <h2 class="form-signin-heading">Por favor ingresa tu email</h2>
        {{ Form::label('email', 'Correo Electrónico', ['class'=>'sr-only']) }}
        @if($errors->has('email'))
            <span class="small text-danger">{{ $errors->first('email') }}</span>
        @endif
        {{ Form::text('email', null, ['class'=>'form-control', 'placeholder' => 'correo@dominio.com', 'required'=>'', 'autofocus'=>'']) }}

        {{ Form::submit('Enviar', array('class' => 'btn btn-lg btn-primary btn-block')) }}
        {{ Form::close() }}
        <div class="clearfix"></div>
    </div>
</div> <!-- /container -->
@stop