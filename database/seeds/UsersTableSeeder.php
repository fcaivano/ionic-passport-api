<?php

use Illuminate\Database\Seeder;

use App\Models\User;

use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        \DB::table('users')->truncate();

        \Log::info('asdasdasd');
        collect(range(0, 10))->each(function () {
            $this->createUser();
        });
    }

    public function createUser()
    {
    	$faker = Faker::create();

        $user = User::create([
            'name' => $faker->name,
            'email' => $faker->email,
            'password' => bcrypt('password'),
        ]);

        return $user;
    }
}
