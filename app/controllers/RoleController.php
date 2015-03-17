<?php

class RoleController extends \BaseController {

    public function __construct()
    {
        $this->beforeFilter('csrf', ['on' => ['post', 'put', 'patch', 'delete']]);
        $this->beforeFilter('roles_view', ['only' => ['index', 'show']]);
        $this->beforeFilter('roles_create', ['only' => ['create', 'store']]);
        $this->beforeFilter('roles_edit', ['only' => ['edit', 'update']]);
        $this->beforeFilter('roles_destroy', ['only' => ['destroy']]);
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('roles.index')
            ->with('roles', Role::all());
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $role = new Role();
        $permissions = Permission::all();

        foreach($permissions as $permission) {
            $permission->value = 0;
        }

        $role->permissions = $permissions;

        return View::make('roles.create')
            ->with('role', $role);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $permissions = array();
        if(Input::has('permission')) {
            $permissions = Input::get('permission');
        }

		$rules = [
            'name' => 'required', 'unique:roles'
        ];
        $validator = Validator::make(Input::all(),$rules);
        if($validator->fails()){
            return Redirect::route('roles.create')
                ->withErrors($validator)
                ->withInput();
        }

        $role_name = Input::get('name');
        $role = new Role;
        $role->name = $role_name;

        if($role->save()) {
            if($role->perms()->sync($permissions)){
                return Redirect::route('roles.index')
                    ->with('global', 'Nuevo Rol Creado');
            }
            return Redirect::route('roles.index')
                ->with('global', 'Error al asignar permisos.');
        }
        return App::abort(404);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($role_id)
	{
        $role = Role::findOrFail($role_id);
        $role->permissions = $this->getPermissions($role->id);

        return View::make('roles.edit')
            ->with('role', $role);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($role_id)
	{
        $permissions = array();
        if(Input::has('permission')) {
            $permissions = Input::get('permission');
        }

        $rules = [
            'name' => 'required', 'unique:roles'
        ];
        $validator = Validator::make(Input::all(),$rules);
        if($validator->fails()){
            return Redirect::route('roles.edit', $role_id)
                ->withErrors($validator)
                ->withInput();
        }

        $role_name = Input::get('name');
        $role = Role::findOrFail($role_id);
        $role->name = $role_name;

        if($role->update([])) {
            if($role->perms()->sync($permissions)){
                return Redirect::route('roles.index')
                    ->with('global', 'Rol Actualizado');
            }
            return Redirect::route('roles.index')
                ->with('global', 'Error al asignar permisos.');
        }
        return App::abort(404);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($role_id)
	{
		$role = Role::findOrFail($role_id)->delete();
        return Redirect::route('roles.index')
            ->with('global', 'Rol Eliminado');
	}

    public function getPermissions($role_id)
    {
        $attach_permissions = $this->getAttachPermissions($role_id);
        $permissions = Permission::all();

        foreach($permissions as $permission) {
            $value = 0;
            foreach($attach_permissions as $role_permission){
                if($role_permission->id == $permission->id){
                    $value = 1;
                    break;
                }
            }
            $permission->value = $value;
        }

        return $permissions;
    }

    public function getAttachPermissions($role_id)
    {
        $rolePermissions = RolePermission::where('role_id', '=', $role_id)->get();
        $attach = array();
        foreach($rolePermissions as $p){
            foreach (Permission::all() as $key => $value){
                if($value->id == $p->permission_id){
                    $attach[] = $value;
                }
            }
        }

        return $attach;
    }
}
