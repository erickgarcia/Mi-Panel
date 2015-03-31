@extends('layouts.main')
@section('title')
    {{ trans('catalogs.sectors') }}
@stop
@section('body')

    <div class="col-xs-12">
        <table class="table">
            <tr>
                <td><h1 style="margin: 0;">{{ trans('catalogs.sectors') }}</h1></td>
                <td>{{ HTML::link(URL::route('catalogs.sectors.create'), 'Nuevo Sector', ['class'=>'btn btn-primary pull-right']) }}</td>
            </tr>
        </table>
    </div>
    <div class="col-xs-12">
        <br/>
    </div>
    <div class="col-xs-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#id</th>
                        <th>Nombre</th>
                        <th>Decripción</th>
                        <th style="width: 15%;">Editar / Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sectors as $sector)
                        <tr>
                            <th scope="row">{{ $sector->id }}</th>
                            <td>{{ $sector->name }}</td>
                            <td>{{ $sector->description }}</td>
                            <td>
                                <ul class="list-inline">
                                    <li>
                                        {{ HTML::link(URL::route('catalogs.sectors.edit',$sector->id ), 'Editar', ['class'=>'btn btn-link']) }}
                                    </li>
                                    <li>
                                        {{ Form::model($sector, ['route' => ['catalogs.sectors.destroy', $sector->id], 'method' => 'DELETE']) }}
                                        {{ Form::submit('Eliminar', ['class' => 'btn btn-link']) }}
                                        {{ Form::close() }}
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop