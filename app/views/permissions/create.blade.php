@extends('layouts.main')
@section('title')
    Nuevo Permiso
@stop
@section('body')
    <h1>Nuevo Permiso</h1>
    {{ Form::open(['route'=>'permissions.store']) }}
    @include('permissions.partials._form')
    {{ Form::submit('Crear') }}
    {{ Form::close() }}
@stop