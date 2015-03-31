@extends('layouts.main')
@section('title')
    Nuevo Sector
@stop
@section('body')
    <div class="col-xs-12">
        <h1>Nuevo Sector</h1>
        {{ Form::model($sector, ['route' => ['catalogs.sectors.update', $sector->id], 'method' => 'PUT']) }}
        @include('catalogs.sectors.partials._form')
        {{ Form::submit('Actualizar', ['class'=>'btn btn-primary']) }}
        {{ Form::close() }}
    </div>
@stop