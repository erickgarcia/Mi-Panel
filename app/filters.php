<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
    if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('/account/sing-in');
		}
	}
});

Route::filter('users_view', function()
{
    //Request::method()
    if (! Entrust::can('users:view') ) // Checks the current user
    {
        return Redirect::route('home')
            ->with('global', 'No autorizado.');
    }
});

Route::filter('users_create', function()
{
    if(! Entrust::can('users:create'))
    {
        return Redirect::route('home')
            ->with('global', 'No autorizado.');
    }
});

Route::filter('users_edit', function()
{
    if(! Entrust::can('users:edit'))
    {
        return Redirect::route('home')
            ->with('global', 'No autorizado.');
    }
});

Route::filter('users_destroy', function()
{
    if(! Entrust::can('users:destroy'))
    {
        return Redirect::route('home')
            ->with('global', 'No autorizado.');
    }
});

Route::filter('roles_view', function()
{
    if (! Entrust::can('roles:view') ) // Checks the current user
    {
        return Redirect::route('home')
            ->with('global', 'No autorizado.');
    }
});

Route::filter('roles_create', function()
{
    if (! Entrust::can('roles:create') ) // Checks the current user
    {
        return Redirect::route('home')
            ->with('global', 'No autorizado.');
    }
});

Route::filter('roles_edit', function()
{
    if (! Entrust::can('roles:edit') ) // Checks the current user
    {
        return Redirect::route('home')
            ->with('global', 'No autorizado.');
    }
});

Route::filter('roles_destroy', function()
{
    if (! Entrust::can('roles:destroy') ) // Checks the current user
    {
        return Redirect::route('home')
            ->with('global', 'No autorizado.');
    }
});

Route::filter('permissions_view', function()
{
    if (! Entrust::can('permissions:view') ) // Checks the current user
    {
        return Redirect::route('home')
            ->with('global', 'No autorizado.');
    }
});

Route::filter('permissions_create', function()
{
    if (! Entrust::can('permissions:create') ) // Checks the current user
    {
        return Redirect::route('home')
            ->with('global', 'No autorizado.');
    }
});

Route::filter('permissions_edit', function()
{
    if (! Entrust::can('permissions:edit') ) // Checks the current user
    {
        return Redirect::route('home')
            ->with('global', 'No autorizado.');
    }
});

Route::filter('permissions_destroy', function()
{
    if (! Entrust::can('permissions:destroy') ) // Checks the current user
    {
        return Redirect::route('home')
            ->with('global', 'No autorizado.');
    }
});

Route::filter('update_profile', function()
{
    if (! Entrust::can('users:changeownprofile') ) // Checks the current user
    {
        return Redirect::route('home')
            ->with('global', 'No autorizado.');
    }
});

Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() !== Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
