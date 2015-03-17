@extends('layouts.main')
@section('title')
    Nuevo Usuario
@stop
@section('body')
    <h1>Nuevo Usuario</h1>
    {{ Form::open(array('route'=>'users.store', 'class'=> 'form-signin')) }}
    @include('users.partials._form')
    {{ Form::submit('Crear') }}
    {{ Form::close() }}
@stop