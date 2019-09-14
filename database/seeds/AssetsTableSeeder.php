<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AssetsTableSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker::create();
        $users = User::all()->pluck("id")->toArray();
        $testUserId = User::where('email', 'test@user.com')->first()["id"];

        foreach (range(1,20) as $index) {
            DB::table("assets")->insert([
                "label" => $faker->domainName,
                "currency" => $faker->randomElement(["BTC" ,"ETH", "IOTA"]),
                "value" => $faker->randomFloat(6,0,10),
                "user_id"=> $faker->randomElement($users),
                "created_at" => $faker->dateTime($max = "now"),
                "updated_at" => $faker->dateTime($max = "now"),
            ]);
        }

        foreach (range(1,3) as $index) {
            DB::table("assets")->insert([
                "label" => $faker->domainName,
                "currency" => $faker->randomElement(["BTC" ,"ETH", "IOTA"]),
                "value" => $faker->randomFloat(6,0,10),
                "user_id"=> $testUserId,
                "created_at" => $faker->dateTime($max = "now"),
                "updated_at" => $faker->dateTime($max = "now"),
            ]);
        }
    }
}
