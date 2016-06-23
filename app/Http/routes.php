<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/docs', 'Controllers\SwaggerController@swagger');


Route::get('/laravel/migrate',  function()
{
    try {
        echo '<br>init with app tables migrations...';
        Artisan::call('migrate:refresh', [
            '--path'     => "database/migrations",
            '--seed'    => null
        ]);

        echo 'done';
    } catch (Exception $e) {
        Response::make($e->getMessage(), 500);
    }
});

/**
 * Authentication
 */
Route::group(
    [
        'prefix' => 'auth',
        'namespace' => 'Controllers'
    ],
    function() {

        // Authentication routes...
        Route::get('login', 'Auth\AuthController@getLogin');
        Route::post('login', 'Auth\AuthController@postLogin');
        Route::get('logout', 'Auth\AuthController@logout');

        Route::get('register', 'Auth\AuthController@getRegister');
        Route::post('register', 'Auth\AuthController@postRegister');
    }
);

Route::group(
    [
        'prefix' => 'password',
        'namespace' => 'Controllers'
    ],
    function() {

        // Password reset link request routes...
        Route::get('email', 'Auth\PasswordController@getEmail');
        Route::post('email', 'Auth\PasswordController@postEmail');

        // Password reset routes...
        Route::get('reset/{token}', 'Auth\PasswordController@getReset');
        Route::post('reset', 'Auth\PasswordController@postReset');

    }
);

/**
 * OAuth2 validation
 */
Route::group(
    [
        'prefix' => 'oauth',
        'namespace' => 'Controllers',
        'middleware' => [ 'cors' ],
    ],
    function()
    {
        // Authorize
        Route::get(
            'authorize',
            [
                'as' => 'oauth.authorize.get',
                'middleware' => ['check-authorization-params'],
                'uses' => 'OAuth2Controller@authorizeOauth2'
            ]
        );

        // Process authorization
        Route::post(
            'authorize',
            [
                'as' => 'oauth.authorize.post',
                'middleware' => ['csrf', 'check-authorization-params', 'auth'],
                'uses' => 'OAuth2Controller@processAuthorization'
            ]
        );

        // Generate access token
        Route::post('access_token', 'OAuth2Controller@accessToken');
    }
);

/**
 * Include API routes
 */

$routeTransformer = new \CatLab\Charon\Laravel\Transformers\RouteTransformer();

/** @var \CatLab\Charon\Collections\RouteCollection $routeCollection */
$routeCollection = include 'Api/V1/routes.php';
$routeTransformer->transform($routeCollection);
