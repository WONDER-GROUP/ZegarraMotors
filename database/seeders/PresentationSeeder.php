<?php

namespace Database\Seeders;

use App\Models\Presentation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PresentationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $presentation = new Presentation();
        $presentation->name = 'Sin presentación';
        $presentation->save();
    }
}
