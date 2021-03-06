{{ Form::label('name', 'Nombre del Rol') }}
@if($errors->has('name'))
    <span class="text-danger">{{ $errors->first('name') }}</span>
@endif
{{ Form::text('name', null, ['class'=>'form-control', 'placeholder' => 'rol', 'required'=>'', 'autofocus'=>'']) }}
<ul class="list-unstyled">
@foreach($role->permissions as $permission)
    <li>
    {{ Form::label('permission[]', $permission->display_name) }}
    {{ Form::checkbox('permission[]', $permission->id, $permission->value) }}
    </li>
@endforeach
</ul>