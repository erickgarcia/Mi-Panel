<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/user/{username?}',
    [
        'as' => 'profile.user',
        'uses' => 'ProfileController@user'
    ]
);
/*
 * Authenticated group
 */
Route::group(array('before'=>'auth'), function() {

    /*
     * CSRF protection group
     */
    Route::group(array('before'=>'csrf'), function(){
        /*
         * Change password (POST)
         */
        Route::post('/account/change-password',
            [ 'as' => 'account.change.password.process',
              'uses' => 'AccountController@changePasswordProcess'
            ]
        );
        /*
         * Update profile (POST)
         */
        Route::put('/account/update',
            [ 'as' => 'account.update.process',
              'uses' => 'AccountController@updateProfileProcess'
            ]
        );
    });
    /*
     * Route for home
     */
    Route::get('/',
        [
            'as' => 'home',
            'uses' => 'HomeController@showWelcome'
        ]
    );
    /*
     * Update profile (GET)
     */
    Route::get('/account/update',
        [ 'as' => 'account.update',
          'uses' => 'AccountController@updateProfile'
        ]
    );
    /*
     * Change password (GET)
     */
    Route::get('/account/change-password',
        [ 'as' => 'account.change.password',
          'uses' => 'AccountController@changePassword'
        ]
    );
    /*
     * Sign out (GET)
     */
    Route::get('/account/sing-out',
        [ 'as' => 'account.sign-out',
          'uses' => 'AccountController@signOut'
        ]
    );
    /*Resource for roles*/
    Route::resource('users', 'UserController');
    /*Resource for roles*/
    Route::resource('roles', 'RoleController');
    /*Resource for permissions*/
    Route::resource('permissions', 'PermissionController');
});

/*
 * Unauthenticated group
*/
Route::group(array('before'=>'guest'), function(){
    /*
     * CSRF protection group
     */
    Route::group(array('before'=>'csrf'), function(){
        /*
         * Create Account (POST)
         */
        Route::post('/account/register',
            [ 'as' => 'account.register.process',
              'uses' => 'AccountController@processRegister'
            ]
        );
        /*
         * Sing in (POST)
         */
        Route::post('/account/sign-in',
            [ 'as' => 'account.sign-in.process',
              'uses' => 'AccountController@processSignIn'
            ]
        );
        /*
         * Forgot password (POST)
         */
        Route::post('/account/forgot-password',
            [ 'as' => 'account.forgot.password.process',
              'uses' => 'AccountController@forgotPasswordProcess'
            ]
        );
    });
    /*
     * Forgot password (GET)
     */
    Route::get('/account/forgot-password',
        [ 'as' => 'account.forgot.password',
          'uses' => 'AccountController@forgotPassword'
        ]
    );
    /*
     * Sign in (GET)
     */
    Route::get('/account/recover/{code}',
        [ 'as' => 'account.recover',
          'uses' => 'AccountController@recover'
        ]
    );
    /*
     * Sign in (GET)
     */
    Route::get('/account/sing-in',
        [ 'as' => 'account.sign-in',
          'uses' => 'AccountController@showSignIn'
        ]
    );
    /*
     * Show Create Account Form (GET)
     */
    Route::get('/account/register',
        [ 'as' => 'account.register',
          'uses' => 'AccountController@showRegister'
        ]
    );
    /*
     * Activate Account (GET)
     */
    Route::get('/account/activate/{code}',
        [ 'as' => 'account.activate',
          'uses' => 'AccountController@activateAccount'
        ]
    );
});