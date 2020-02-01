<?php

namespace App\Http\Controllers\API\Product;

use App\Http\Controllers\Controller;
use App\Models\Products\Product;
use App\Http\Requests\Product\Store as ProductStoreRequest;
use App\Http\Resources\Items\Product\Store as ProductStoreItemResource;
use Carbon\Carbon;

class StoreController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request, Product $product)
    {
        $product->name = $request->get('name');
        $product->sku = $request->get('sku');
        $product->price = $request->get('price');
        $product->created_at = Carbon::now();
        $product->save();
        
        $product->relateWithCategory($request->get('categories'));

        return new ProductStoreItemResource($product);
    }
}
