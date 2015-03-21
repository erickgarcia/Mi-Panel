@extends('layouts.main')
@section('title')
    Inicia Sesión
@stop
@section('body')
<div class="col-xs-12">
    <div class="center-block" style="width: 35%">
        {{ Form::open(array('route'=>'account.sign-in.process', 'class'=> 'form-signin')) }}
            <h2 class="form-signin-heading">Por favor ingresa tus datos</h2>
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

            {{ Form::checkbox('remember', 'remember-me', null, ['class' => 'checkbox pull-left']) }}
            {{ Form::label('remember', 'Recordar', ['class'=>'pull-left']) }}
            {{ Form::submit('Entrar', array('class' => 'btn btn-lg btn-primary btn-block')) }}
        {{ Form::close() }}
        <div class="clearfix"></div>
    </div>
</div> <!-- /container -->
@stop