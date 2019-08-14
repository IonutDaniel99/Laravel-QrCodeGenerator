<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 450; $i++) { 
            # code...
            DB::table('qrcode')->insert([
                'codes' => Str::random(10),
                'created_at' => Carbon::now()->format('2019-08-'.rand(3,14).' '.rand(00,10).':i:s'),
                'sent' => rand(0,1),
                'sent_at' => Carbon::now()->format('2019-08-'.rand(3,14).' '.rand(00,10).':i:s'),
                'used' => rand(0,1),
                'used_at' => Carbon::now()->format('2019-08-d H:i:s'),
    
            ]);
        }
    }
}
