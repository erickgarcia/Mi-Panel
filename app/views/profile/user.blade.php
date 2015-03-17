@extends('layouts.main')
@section('title')
    Perfil de usuario
@stop
@section('body')
    <h2>User profile <small>{{ $user->username }}</small></h2>
    <p>{{ $user->email }}</p>
@stop