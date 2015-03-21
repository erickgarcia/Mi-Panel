@extends('layouts.main')
@section('title')
    Nuevo Permiso
@stop
@section('body')
<div class="col-xs-12">
    <h1>Nuevo Permiso</h1>
    {{ Form::open(['route'=>'permissions.store']) }}
    @include('permissions.partials._form')
    {{ Form::submit('Crear', ['class'=>'btn btn-primary']) }}
    {{ Form::close() }}
</div>
@stop