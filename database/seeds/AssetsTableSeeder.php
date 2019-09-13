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
        $users = User::all()->pluck('id')->toArray();

        foreach (range(1,40) as $index) {
            DB::table('assets')->insert([
                'label' => $faker->domainName,
                'currency' => $faker->randomElement(['BTC' ,'ETH', 'IOTA']),
                'value' => $faker->randomFloat(6,0,1000),
                'user_id'=> $faker->randomElement($users),
                'created_at' => $faker->dateTime($max = 'now'),
                'updated_at' => $faker->dateTime($max = 'now'),
            ]);
        }
    }
}
