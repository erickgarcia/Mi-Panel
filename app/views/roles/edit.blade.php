@extends('layouts.main')
@section('title')
    Editar Rol
@stop
@section('body')
<div class="col-xs-12">
    <h1>Editar Rol</h1>
    {{ Form::model($role, ['route' => ['roles.update', $role->id], 'method' => 'PUT']) }}
    @include('roles.partials._form')
    {{ Form::submit('Actualizar', ['class'=>'btn btn-primary']) }}
    {{ Form::close() }}
</div>
@stop