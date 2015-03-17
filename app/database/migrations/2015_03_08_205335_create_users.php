<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($newtable) {
            $newtable->increments('id');
            $newtable->string('email')->unique();
            $newtable->string('username', 100)->unique();
            $newtable->string('password', 100);
            $newtable->string('password_temp', 100);
            $newtable->string('code', 100);
            $newtable->boolean('active');
            $newtable->rememberToken();
            $newtable->timestamps();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
