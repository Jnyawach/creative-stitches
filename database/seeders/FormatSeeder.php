<?php

namespace Database\Seeders;

use App\Models\Format;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //Format::truncate();
        $formats=[
            ['name'=>'Tajima','abbreviation'=>'DST'],
            ['name'=>'Wilcom','abbreviation'=>'EMB'],
            ['name'=>'Artista Design','abbreviation'=>'ART'],
            ['name'=>'Melco','abbreviation'=>'CND'],
            ['name'=>'Melco','abbreviation'=>'EXP'],
            ['name'=>'Husqvarna/Viking ','abbreviation'=>'HUS'],
            ['name'=>'Deco, Brother, Babylock','abbreviation'=>'PES'],
            ['name'=>'Janome/Elna/Kenmore ','abbreviation'=>'SEW'],
            ['name'=>'Compucon','abbreviation'=>'XXX'],
            ['name'=>'Pfaff','abbreviation'=>'PCS'],
        ];

        foreach ($formats as $format){
            Format::create([
                'name'=>$format['name'],
                'abbreviation'=>$format['abbreviation']
            ]);
        }
    }
}
