<?php

class UserTableSeeder extends Seeder {
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i = 0; $i < 10; $i++)
        {
            $user = User::create(array(
                'email'     => $faker->email,
                'username'  => $faker->unique->userName,
                'password'  => Hash::make($faker->word),
                'code'      => '',
                'active'    => 1
            ));
        }
    }
}