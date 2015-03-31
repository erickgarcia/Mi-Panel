<?php

class SectorController extends CatalogController {

    function __construct() {
        parent::__construct('sectors', 'simple', true);
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('catalogs.sectors.index')
            ->with('sectors', Sector::all());
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('catalogs.sectors.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $rules = [
            'name' => 'required|unique:sectors'
        ];
        $validator = Validator::make(Input::all(),$rules);
        if($validator->fails()){
            return Redirect::route('catalogs.sectors.create')
                ->withErrors($validator)
                ->withInput();
        }

        $name = Input::get('name');
        $description = (Input::has('description'))? Input::get('description') : '';

        $sector = new Sector();
        $sector->name = $name;
        $sector->description = $description;

        if($sector->save()) {
            return Redirect::route('catalogs.sectors.index')
                ->with('global', 'Nuevo Sector Creado');
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
        return View::make('catalogs.sectors.show');
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($sector_id)
	{
        $sector = Sector::findOrFail($sector_id);
        return View::make('catalogs.sectors.edit')
            ->with('sector', $sector);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($sector_id)
	{
        $rules = [
            'name' => 'required|unique:sectors,name,'.$sector_id,
        ];
        $validator = Validator::make(Input::all(),$rules);
        if($validator->fails()){
            return Redirect::route('catalogs.sectors.edit', $sector_id)
                ->withErrors($validator)
                ->withInput();
        }

        $name = Input::get('name');
        $description = Input::get('description');

        $sector = Sector::findOrFail($sector_id);
        $sector->name = $name;
        $sector->description = $description;

        if($sector->update([])) {
            return Redirect::route('catalogs.sectors.index')
                ->with('global', 'Sector Actuaizado');
        }
        return App::abort(404);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($sector_id)
	{
        $sector = Sector::findOrFail($sector_id);
        $sector->name = $sector->name.'_'.time();

        if($sector->update([])) {
            $sector->delete();
            return Redirect::route('catalogs.sectors.index')
                ->with('global', 'Sector Eliminado');
        }
	}


}
