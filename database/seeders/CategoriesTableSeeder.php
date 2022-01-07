<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('Categories')->insert([
            'parent_id' => null,
            'name' => 'Clothes',
            'slug' => 'clothes',
            'description' => null,
            'image' => null
        ]);
    }
}
