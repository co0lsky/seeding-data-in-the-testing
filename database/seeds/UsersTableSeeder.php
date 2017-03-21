<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(User::class, 10)
	        ->create()

	        // define relationships
	        ->each(function($user) {
	        	// first user has no one to follow
	        	if ($user->id == 1) {
	        		return;
	        	}

	        	$user->following()->attach($user->id - 1);
        	});
    }
}
