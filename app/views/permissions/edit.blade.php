@extends('layouts.main')
@section('title')
    Editar Permiso
@stop
@section('body')
    <h1>Editar Permiso</h1>
    {{ Form::model($permission, ['route' => ['permissions.update', $permission->id], 'method' => 'PUT']) }}
    @include('permissions.partials._form')
    {{ Form::submit('Actualizar') }}
    {{ Form::close() }}
@stop