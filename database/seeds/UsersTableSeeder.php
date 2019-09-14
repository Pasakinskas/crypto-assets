<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,20) as $index) {
            DB::table("users")->insert([
                "email" => $faker->email,
                "password" => Hash::make("password"),
                "created_at" => $faker->dateTime($max = "now"),
                "updated_at" => $faker->dateTime($max = "now"),
            ]);
        }

        DB::table("users")->insert([
            "email" => "test@user.com",
            "password" => Hash::make("password"),
            "created_at" => $faker->dateTime($max = "now"),
            "updated_at" => $faker->dateTime($max = "now"),
        ]);
    }
}
