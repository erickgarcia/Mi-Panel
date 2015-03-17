@extends('layouts.main')
@section('title')
Roles
@stop
@section('body')
<h1>Roles</h1>
<ul class="list-unstyled">
    @foreach($roles as $role)
    <li>{{ $role->name }}</li>
    <li>
        <ul class="list-inline">
            @if(Auth::user()->can('roles:edit'))
            <li>{{ HTML::linkRoute('roles.edit', 'Editar', [$role->id]) }}</li>
            @endif
            @if(Auth::user()->can('roles:destroy'))
            <li>
                {{ Form::model($role, ['route' => ['roles.destroy', $role->id], 'method' => 'DELETE']) }}
                {{ Form::submit('Eliminar', ['class' => 'btn btn-link']) }}
                {{ Form::close() }}
            </li>
            @endif
        </ul>
    </li>
    @endforeach
</ul>
@stop