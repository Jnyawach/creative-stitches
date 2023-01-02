<?php

namespace Database\Seeders;

use App\Models\CartStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        CartStatus::truncate();

        $status = [
            ['name' => 'Pending'],
            ['name' => 'Complete'],
            ['name' => 'Mailed_one'],
            ['name' => 'Mailed_two']
        ];
        foreach ( $status as $level){
            CartStatus::create($level);
        }
    }
}
