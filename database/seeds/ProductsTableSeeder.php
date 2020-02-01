<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App/Models/Product/Product');

        $json = File::get("database/data/spicy-deli.json");

        $data = json_decode($json);

        $collection = collect($data);

        $chunks = $collection->chunk(100);

        //first insert product categories
        // iterate over the categories. seperate each category and get id of the categories
        // store that ids into arrys for the future user
        foreach($chunks as $rows){
            DB::table('categories')->insert($rows);
        }

        //inser products
        // store each product id into seperate arrays
        foreach($chunks as $rows){
            DB::table('products')->insert($rows);
        }

        //associate product with the product categories.
        foreach($chunks as $rows){
            DB::table('products_categories')->insert($rows);
        }
    }
}
