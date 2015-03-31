@extends('layouts.main')
@section('title')
    Nuevo Sector
@stop
@section('body')
    <div class="col-xs-12">
        <h1>Nuevo Sector</h1>
        {{ Form::open(['route'=>'catalogs.sectors.store']) }}
        @include('catalogs.sectors.partials._form')
        {{ Form::submit('Crear', ['class'=>'btn btn-primary']) }}
        {{ Form::close() }}
    </div>
@stop