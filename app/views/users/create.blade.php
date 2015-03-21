@extends('layouts.main')
@section('title')
    Nuevo Usuario
@stop
@section('body')
<div class="col-xs-12">
    <h1>Nuevo Usuario</h1>
    {{ Form::open(array('route'=>'users.store', 'class'=> 'form-signin')) }}
    @include('users.partials._form')
    {{ Form::submit('Crear', ['class'=>'btn btn-primary']) }}
    {{ Form::close() }}
</div>
@stop