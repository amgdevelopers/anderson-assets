<?php

use App\User;
use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('user:create', function () {
	$email = $this->ask('Email Address');
	$password = $this->secret('Password');
	$user = User::updateOrCreate(
		['email' => $email],
		['password' => bcrypt($password)]
	);
	$this->info('User has been updated or created successfully.');
})->describe('Create or Update a user for the application.');
