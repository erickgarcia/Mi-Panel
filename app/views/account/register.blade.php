@extends('layouts.main')
@section('title')
    Registro
@stop
@section('body')
<div class="container">
    <div class="center-block" style="width: 35%">
        {{ Form::open(array('route'=>'account.register.process', 'class'=> 'form-signin')) }}
        <h2 class="form-signin-heading">Registro</h2>
        {{ Form::label('username', 'Nombre de Usuario', ['class'=>'sr-only']) }}
        @if($errors->has('username'))
            <span class="small text-danger">{{ $errors->first('username') }}</span>
        @endif
        {{ Form::text('username', null, ['class'=>'form-control', 'placeholder' => 'usuario', 'required'=>'', 'autofocus'=>'']) }}

        {{ Form::label('email', 'Correo Electrónico', ['class'=>'sr-only']) }}
        @if($errors->has('email'))
            <span class="small text-danger">{{ $errors->first('email') }}</span>
        @endif
        {{ Form::text('email', null, ['class'=>'form-control', 'placeholder' => 'correo@dominio.com', 'required'=>'', 'autofocus'=>'']) }}

        {{ Form::label('password', 'Contraseña', ['class'=>'sr-only']) }}
        @if($errors->has('password'))
            <span class="small text-danger">{{ $errors->first('password') }}</span>
        @endif
        {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'contraseña', 'required'=>'']) }}

        {{ Form::label('password_again', 'Contraseña', ['class'=>'sr-only']) }}
        @if($errors->has('password_again'))
            <span class="small text-danger">{{ $errors->first('password_again') }}</span>
        @endif
        {{ Form::password('password_again', ['class' => 'form-control', 'placeholder' => 'contraseña', 'required'=>'']) }}

        {{ Form::submit('Enviar', array('class' => 'btn btn-lg btn-primary btn-block')) }}
        {{ Form::close() }}
        <div class="clearfix"></div>
    </div>
</div> <!-- /container -->
@stop