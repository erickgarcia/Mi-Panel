@extends('layouts.main')
@section('title')
    Editar Rol
@stop
@section('body')
    <h1>Editar Rol</h1>
    {{ Form::model($role, ['route' => ['roles.update', $role->id], 'method' => 'PUT']) }}
    @include('roles.partials._form')
    {{ Form::submit('Actualizar') }}
    {{ Form::close() }}
@stop