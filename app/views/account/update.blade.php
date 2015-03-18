@extends('layouts.main')
@section('title')
    Actualizar perfil
@stop
@section('body')
    <div class="container">
        <div class="center-block" style="width: 35%">
            {{ Form::model($user, ['route' => ['account.update.process', $user->id], 'method' => 'PUT', 'class'=> 'form-signin']) }}
            <h2 class="form-signin-heading">Actualizar Perfil</h2>
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

            {{ Form::submit('Actualizar', array('class' => 'btn btn-lg btn-primary btn-block')) }}
            {{ Form::close() }}
            <div class="clearfix"></div>
        </div>
    </div> <!-- /container -->
@stop