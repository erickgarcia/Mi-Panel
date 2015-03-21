@extends('layouts.main')
@section('title')
    Usuarios
@stop
@section('body')
<div class="col-xs-12">
    <h1>Usuarios</h1>
    <ul class="list-unstyled">
        @foreach($users as $user)
            <li>{{ $user->username }} | {{ $user->email }}</li>
            <li>
                <ul class="list-inline">
                    @if(Auth::user()->can('users:edit'))
                    <li>{{ HTML::linkRoute('users.edit', 'Editar', [$user->id]) }}</li>
                    @endif
                    @if(Auth::user()->can('users:destroy'))
                    <li>
                        {{ Form::model($user, ['route' => ['users.destroy', $user->id], 'method' => 'DELETE']) }}
                        {{ Form::submit('Eliminar', ['class' => 'btn btn-link']) }}
                        {{ Form::close() }}
                    </li>
                    @endif
                </ul>
            </li>
        @endforeach
    </ul>
    {{ $users->links() }}
</div>
@stop