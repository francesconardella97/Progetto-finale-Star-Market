<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->createCategory();
    }
    public function createCategory(){
        Category::create([
            'name'=>'Vari',
            'Spanish'=>'Varios',
            'English'=>'Various',
        ]);
        Category::create([
            'name'=>'Serie TV',
            'Spanish'=>'Series de TV',
            'English'=>'TV Series',
        ]);
        Category::create([
            'name'=>'Giochi da tavolo',
            'Spanish'=>'Juegos de mesa',
            'English'=>'Table games',
        ]);
        Category::create([
            'name'=>'Action Figures',
            'Spanish'=>'Figuras de acción',
            'English'=>'Action Figures',
        ]);
        Category::create([
            'name'=>'Gadget',
            'Spanish'=>'Artilugio',
            'English'=>'Gadget',
        ]);
        Category::create([
            'name'=>'Manga e comics',
            'Spanish'=>'Manga y comics',
            'English'=>'Manga & comics',
        ]);
        Category::create([
            'name'=>'Funko Pop',
            'Spanish'=>'Funko Pop',
            'English'=>'Funko Pop',
        ]);
        Category::create([
            'name'=>'Da Collezione',
            'Spanish'=>'Coleccionable',
            'English'=>'Collectible',
        ]);
        Category::create([
            'name'=>'Introvabili',
            'Spanish'=>'Inalcanzable',
            'English'=>'Inobtainable',

        ]);
        Category::create([
            'name'=>'Videogame e Console',
            'Spanish'=>'Videojuego y Consola',
            'English'=>'Videogames & Console',

        ]);
    }
}
