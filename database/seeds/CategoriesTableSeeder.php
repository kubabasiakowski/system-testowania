<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	//TPI

        $category = new Category();
        $category->name = 'Algorytmy';
        $category->subject_id = 1;
        $category->save();

        $category = new Category();
        $category->name = 'Modele danych';
        $category->subject_id = 1;
        $category->save();

        //Podstawy programowania

        $category = new Category();
        $category->name = 'Instrukcje warunkowe';
        $category->subject_id = 2;
        $category->save();

        $category = new Category();
        $category->name = 'Pętle';
        $category->subject_id = 2;
        $category->save();

        $category = new Category();
        $category->name = 'Funkcje';
        $category->subject_id = 2;
        $category->save();

        $category = new Category();
        $category->name = 'Procedury';
        $category->subject_id = 2;
        $category->save();

        //Analiza

        $category = new Category();
        $category->name = 'Pochodne';
        $category->subject_id = 3;
        $category->save();

        $category = new Category();
        $category->name = 'Całki';
        $category->subject_id = 3;
        $category->save();
    }
}
