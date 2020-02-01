<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $table = "products";

    public function retrieve(string $id = null)
    {
        return $this->init()->find($id);
    }

    public function relateWithCategory(string $categories)
    {
    	$categories = explode(',', $categories);

    	$insertData = array_map(function($category_id) {
    		return [
    			'product_id' => $this->id,
    			'category_id' => $category_id,
    		];
    	}, $categories);

        DB::table('products_categories')->insert([$insertData]);
    }

    public function removeOldCategory()
    {
        DB::table('products_categories')->where('product_id', $this->id)->delete();
    }
}
