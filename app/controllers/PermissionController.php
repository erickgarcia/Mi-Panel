<?php

class PermissionController extends \BaseController {

    public function __construct()
    {
        $this->beforeFilter('csrf', ['on' => ['post', 'put', 'patch', 'delete']]);
        $this->beforeFilter('permissions_view', ['only' => ['index', 'show']]);
        $this->beforeFilter('permissions_create', ['only' => ['create', 'store']]);
        $this->beforeFilter('permissions_edit', ['only' => ['edit', 'update']]);
        $this->beforeFilter('permissions_destroy', ['only' => ['destroy']]);
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('permissions.index')
            ->with('permissions', Permission::all());
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('permissions.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $rules = [
            'name' => 'required', 'unique:permissions',
            'display_name' => 'required'
        ];
        $validator = Validator::make(Input::all(),$rules);
        if($validator->fails()){
            return Redirect::route('permissions.create')
                ->withErrors($validator)
                ->withInput();
        }

        $name = Input::get('name');
        $display_name = Input::get('display_name');

        $permission = new Permission;
        $permission->name = $name;
        $permission->display_name = $display_name;

        if($permission->save()) {
            return Redirect::route('permissions.index')
                ->with('global', 'Nuevo Permiso Creado');
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
	public function edit($permission_id)
	{
        $permission = Permission::findOrFail($permission_id);
        return View::make('permissions.edit')
            ->with('permission', $permission);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($permission_id)
	{
        $rules = [
            'name' => 'required', 'unique:permissions',
            'display_name' => 'required'
        ];
        $validator = Validator::make(Input::all(),$rules);
        if($validator->fails()){
            return Redirect::route('permissions.edit', $permission_id)
                ->withErrors($validator)
                ->withInput();
        }

        $name = Input::get('name');
        $display_name = Input::get('display_name');

        $permission = Permission::findOrFail($permission_id);
        $permission->name = $name;
        $permission->display_name = $display_name;

        if($permission->update([])) {
            return Redirect::route('permissions.index')
                ->with('global', 'Permiso Actuaizado');
        }
        return App::abort(404);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($permission_id)
	{
        $permission = Permission::findOrFail($permission_id)->delete();
        return Redirect::route('permissions.index')
            ->with('global', 'Permiso Eliminado');
	}
}
