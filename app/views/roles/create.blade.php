@extends('layouts.main')
@section('title')
    Nuevo Rol
@stop
@section('body')
    <h1>Nuevo Rol</h1>
    {{ Form::open(['route'=>'roles.store']) }}
    @include('roles.partials._form')
    {{ Form::submit('Crear') }}
    {{ Form::close() }}
@stop