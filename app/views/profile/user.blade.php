@extends('layouts.main')
@section('title')
    Perfil de usuario
@stop
@section('body')
<div class="col-xs-12">
    <h2>User profile <small>{{ $user->username }}</small></h2>
    <p>{{ $user->email }}</p>
    @if(Auth::user()->can('users:changeownprofile'))
    {{ HTML::linkRoute('account.update', 'Editar') }}
    @endif
</div>
@stop