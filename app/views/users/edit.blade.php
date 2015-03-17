@extends('layouts.main')
@section('title')
    Actualizar Usuario
@stop
@section('body')
    <h1>Actualizar Usuario</h1>
    {{ Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT']) }}
    @include('users.partials._form')
    {{ Form::submit('Actualizar') }}
    {{ Form::close() }}
@stop