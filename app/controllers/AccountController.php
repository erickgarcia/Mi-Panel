<?php

class AccountController extends BaseController {

    public function showRegister()
    {
        return View::make('account.register');
    }

    public function processRegister()
    {
        $validator = Validator::make(Input::all(),
            array(
                'username' => 'required|max:100|min:4|unique:users',
                'email' => 'required|max:50|email|unique:users',
                'password' => 'required|min:6',
                'password_again' => 'required|same:password'
            )
        );

        if($validator->fails()) {
            return Redirect::route('account.register')
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
                return Redirect::route('account.register')
                    ->with('global', '¡Cuenta creada! Revisa tu email para activar.');
            }
        }
    }

    public function activateAccount($code)
    {
        $user = User::where('code', '=', $code)->where('active', '=', 0);

        if($user->count()) {
            $user = $user->first();

            //Update user to active state
            $user->active = 1;
            $user->code = '';

            if($user->save()) {
                return Redirect::route('home')
                    ->with('global', 'Cuenta activada.');
            }
        }
        return Redirect::route('account.register')
            ->with('global', 'No es posible activar su cuenta. Intenta nuevamente.');
    }

    public function showSignIn()
    {
        return View::make('login');
    }

    public function processSignIn()
    {
        $validator = Validator::make(Input::all(),
            [
                'email' => 'required|email',
                'password' => 'required'
            ]
        );

        if($validator->fails()) {
            return Redirect::route('account.sign-in')
                ->withErrors($validator)
                ->withInput();
        } else {
            $remember = (Input::has('remember'))? true: false;
            $auth = Auth::attempt(array(
                'email' => Input::get('email'),
                'password' => Input::get('password'),
                'active' => 1
            ), $remember);

            if($auth) {
                //Redirect to intented page
                return Redirect::intended('/');
            } else {
                return Redirect::route('account.sign-in')
                    ->with('global', 'Email/Contraseña equivocada, o la cuenta no ha sido activada.');
            }
        }

        return Redirect::route('account.sign-in')
            ->with('global', 'Error al iniciar sesión.');
    }

    public function signOut()
    {
        Auth::logout();
        return Redirect::route('home');
    }

    public function changePassword()
    {
        return View::make('account.password');
    }

    public function changePasswordProcess() {
        $validator = Validator::make(Input::all(),
            array(
                'old_password'      => 'required|min:6',
                'password'          => 'required|min:6',
                'password_again'    => 'required|same:password'
            )
        );

        if($validator->fails()) {
            return Redirect::route('account.change.password')
                ->withErrors($validator)
                ->withInput();
        } else {
            $user           = User::find(Auth::user()->id);
            $old_password   = Input::get('old_password');
            $password       = Input::get('password');

            if(Hash::check($old_password, $user->getAuthPassword())){
                $user->password = Hash::make($password);

                if($user->save()) {
                    return Redirect::route('home')
                        ->with('global', 'Contraseña actualizada.');
                }
            } else {
                return Redirect::route('account.change.password')
                    ->with('global', 'Tu antigua contraseña no es correcta.');
            }
        }

        return Redirect::route('account.change.password')
            ->with('global', 'Tu contraseña no ha podido ser actualizada.');
    }

    public function forgotPassword() {
        return View::make('account.forgot');
    }

    public function forgotPasswordProcess() {
        $validator = Validator::make(Input::all(),
            array(
                'email'      => 'required|email'
            )
        );

        if($validator->fails()){
            return Redirect::route('account.forgot.password')
                ->withErrors($validator)
                ->withInput();
        } else {
            $user = User::where('email', '=', Input::get('email'));
            if($user->count()) {
                $user = $user->first();

                //Activation code
                $code       = str_random(60);
                $password   = str_random(10);

                $user->code = $code;
                $user->password_temp = Hash::make($password);

                if($user->save()) {
                    Mail::send('emails.auth.forgot', ['link' => URL::route('account.recover', $code), 'username' => $user->username, 'password' => $password], function($message) use ($user) {
                        $message->to($user->email, $user->username)->subject('Nueva contraseña');
                    });
                    return Redirect::route('home')
                        ->with('global', 'Hemos enviado una nueva contraseña.');
                }
            }
        }

        return Redirect::route('account.forgot.password')
            ->with('global', 'No se ha podido recuperar la contraseña');
    }

    public function recover($code) {
        $user = User::where('code', '=', $code)
            ->where('password_temp', '!=', '');

        if($user->count()){
            $user = $user->first();
            $user->password         = $user->password_temp;
            $user->password_temp    = '';
            $user->code             = '';

            if($user->save()) {
                return Redirect::route('home')
                    ->with('global', 'Cuenta activada. Puede usar su nueva contraseña.');
            }
        }

        return Redirect::route('home')
            ->with('global', '');
    }
}