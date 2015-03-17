<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	*/

	public function showWelcome()
	{
        return View::make('home');
	}

}
