<?php

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
        DB::table('categories')->insert([
            ['name'=>'Мобильные телефоны', 'code'=>'Mobiles', 'description'=>'Описание мобил'],
            ['name'=>'Техника на грани фантастики', 'code'=>'Portable', 'description'=>'Описание портативной техники'],
            ['name'=>'Бытовая техника', 'code'=>'Appliances', 'description'=>'Описание бытовой техники']
        ]);
    }
}
