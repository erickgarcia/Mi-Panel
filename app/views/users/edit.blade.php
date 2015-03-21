@extends('layouts.main')
@section('title')
    Actualizar Usuario
@stop
@section('body')
<div class="col-xs-12">
    <h1>Actualizar Usuario</h1>
    {{ Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT']) }}
    @include('users.partials._form')
    {{ Form::submit('Actualizar', ['class'=>'btn btn-primary']) }}
    {{ Form::close() }}
</div>
@stop