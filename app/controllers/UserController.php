<?php

class UserController extends \BaseController {

    public function __construct()
    {
        $this->beforeFilter('csrf', ['on' => ['post', 'put', 'patch', 'delete']]);
        $this->beforeFilter('users_view', ['only' => ['index', 'show']]);
        $this->beforeFilter('users_create', ['only' => ['create', 'store']]);
        $this->beforeFilter('users_edit', ['only' => ['edit', 'update']]);
        $this->beforeFilter('users_destroy', ['only' => ['destroy']]);
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $users = User::
        select(DB::raw('users.id, users.username, users.email'))
            ->leftJoin('assigned_roles', 'users.id', '=', 'assigned_roles.id')
            ->groupBy('users.id')
            ->paginate(5);
		return View::make('users.index')
            ->with('users', $users);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        /*$options = array(
            'validate_all' => true,
            'return_type' => 'both'
        );
        list($validate,$allValidations) = Auth::user()->ability(array('Administrador','Gestor'), array('users:manage','roles:manage'), $options);

        echo '<pre>';
        var_dump($validate);
        var_dump($allValidations);
        echo '</pre>';*/

        $user = new User();
        $roles = Role::all();

        foreach($roles as $role) {
            $role->value = 0;
        }

        $user->roles = $roles;
		return View::make('users.create')
            ->with('user', $user);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $roles = array();
        if(Input::has('role')) {
            $roles = Input::get('role');
        }

        $validator = Validator::make(Input::all(),
            array(
                'username' => 'required|max:100|min:4|unique:users',
                'email' => 'required|max:50|email|unique:users',
                'password' => 'required|min:6',
                'password_again' => 'required|same:password'
            )
        );

        if($validator->fails()) {
            return Redirect::route('users.create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $username = Input::get('username');
            $email = Input::get('email');
            $password = Input::get('password');

            //Activation code
            $code = str_random(60);

            $user = User::create(array(
                'username' => $username,
                'email' => $email,
                'password' => Hash::make($password),
                'code' => $code,
                'active' => 0
            ));

            if($user) {
                Mail::send('emails.auth.activate', ['link' => URL::route('account.activate', $code), 'username' => $username], function($message) use ($user) {
                    $message->to($user->email, $user->username)->subject('Activa tu cuenta');
                });
                if($user->roles()->sync($roles)){
                    return Redirect::route('users.index')
                        ->with('global', '¡Cuenta creada!.');
                }
                return Redirect::route('users.index')
                    ->with('global', '¡Cuenta creada!, Rol(es) no asignados.');
            }
        }

        return Redirect::route('users.index')
            ->with('global', 'Error al crear cuenta.');
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
	public function edit($user_id)
	{
		$user = User::findOrFail($user_id);
        $user->roles = $this->getRoles($user);

        return View::make('users.edit')
            ->with('user', $user);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($user_id)
	{
        $roles = array();
        if(Input::has('role')) {
            $roles = Input::get('role');
        }

        $validator = Validator::make(Input::all(),
            array(
                'username' => 'required|max:100|min:4|unique:users,username,'.$user_id,
                'email' => 'required|max:50|email|unique:users,email,'.$user_id,
                'password' => 'min:6',
                'password_again' => 'same:password'
            )
        );

        if($validator->fails()) {
            return Redirect::route('users.edit', $user_id)
                ->withErrors($validator)
                ->withInput();
        } else {
            $username = Input::get('username');
            $email = Input::get('email');

            $user = User::findOrFail($user_id);
            $user->username = $username;
            $user->email = $email;

            //Password update
            if(Input::has('password')) {
                //Activation code
                $code = str_random(60);
                $password = Input::get('password');

                $user->code = $code;
                $user->password = Hash::make($password);
                $user->active = 0;
            }

            if($user->update([])) {
                if(Input::has('password')) {
                    Mail::send('emails.auth.passwordupdate', ['link' => URL::route('account.activate', $code), 'username' => $username, 'password' => $password], function ($message) use ($user) {
                        $message->to($user->email, $user->username)->subject('Contraseña actualizada');
                    });
                }
                if($user->roles()->sync($roles)){
                    return Redirect::route('users.index')
                        ->with('global', '¡Cuenta Actualizada!.');
                }
                return Redirect::route('users.index')
                    ->with('global', '¡Cuenta Actualizada!. Los roles no pudieron ser asignados.');
            }
        }

        return Redirect::route('users.index')
            ->with('global', 'Error al actualizar cuenta.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($user_id)
	{
        $user = User::findOrFail($user_id)->delete();
        return Redirect::route('users.index')
            ->with('global', 'Usuario Eliminado');
	}

    public function getRoles($user)
    {
        $attach_roles = $user->roles;
        $roles = Role::all();

        foreach($roles as $role) {
            $value = 0;
            foreach($attach_roles as $user_role){
                if($user_role->id == $role->id){
                    $value = 1;
                    break;
                }
            }
            $role->value = $value;
        }
        return $roles;
    }

}
