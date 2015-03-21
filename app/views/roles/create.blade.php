@extends('layouts.main')
@section('title')
    Nuevo Rol
@stop
@section('body')
<div class="col-xs-12">
    <h1>Nuevo Rol</h1>
    {{ Form::open(['route'=>'roles.store']) }}
    @include('roles.partials._form')
    {{ Form::submit('Crear', ['class'=>'btn btn-primary']) }}
    {{ Form::close() }}
</div>
@stop