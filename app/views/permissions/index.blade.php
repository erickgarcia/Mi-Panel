@extends('layouts.main')
@section('title')
    Permisos
@stop
@section('body')
<h1>Permisos</h1>
<ul class="list-unstyled">
    @foreach($permissions as $permission)
        <li>{{ $permission->name }}</li>
        <li>{{ $permission->display_name }}</li>
        <li>
            <ul class="list-inline">
                @if(Auth::user()->can('permissions:edit'))
                <li>{{ HTML::linkRoute('permissions.edit', 'Editar', [$permission->id]) }}</li>
                @endif
                @if(Auth::user()->can('permissions:destroy'))
                <li>
                    {{ Form::model($permission, ['route' => ['permissions.destroy', $permission->id], 'method' => 'DELETE']) }}
                    {{ Form::submit('Eliminar', ['class' => 'btn btn-link']) }}
                    {{ Form::close() }}
                </li>
                @endif
            </ul>
        </li>
    @endforeach
</ul>
@stop