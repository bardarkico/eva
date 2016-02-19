<?php

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

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
			return Redirect::guest('login');
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

Route::filter('admin', function()
{
	if( !Sesion::isAdmin() ){
		Session::flush();
		Cache::flush();
		return Redirect::to('/', 302)
			->header('cache-control', 'no-store, no-cache, must-revalidate')
			->header('pragma', 'no-cache');
	}
});

Route::filter('asesor', function()
{
	if( !Sesion::isAsesor() ){
		Session::flush();
		Cache::flush();
		return Redirect::to('/', 302)
			->header('cache-control', 'no-store, no-cache, must-revalidate')
			->header('pragma', 'no-cache');
	}
});

Route::filter('usuario', function()
{
	if( !Sesion::isUser() ){
		Session::flush();
		Cache::flush();
		return Redirect::to('/', 302)
			->header('cache-control', 'no-store, no-cache, must-revalidate')
			->header('pragma', 'no-cache');
	}
});

Route::filter('csrf', function()
{
	if (Session::token() !== Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
