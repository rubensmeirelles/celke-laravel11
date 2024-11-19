<?php

namespace Database\Seeders;

use App\Models\Classe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!Classe::where('name', 'Aula 2')->first()){
            Classe::create([
                'name' => 'Aula 2',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Sit maiores perferendis, sed nulla recusandae fuga officiis!
                Perferendis, dolorem a consectetur facilis laudantium laboriosam harum nesciunt mollitia ab non,
                voluptatum minima!',
                'course_id' => 2
            ]);
        }

        if(!Classe::where('name', 'Aula 3')->first()){
            Classe::create([
                'name' => 'Aula 3',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Sit maiores perferendis, sed nulla recusandae fuga officiis!',
                'course_id' => 2
            ]);
        }
    }
}
