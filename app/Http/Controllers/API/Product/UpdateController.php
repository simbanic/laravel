<?php

namespace App\Http\Controllers\API\Product;

use App\Http\Controllers\Controller;
use App\Models\Products\Product;
use App\Http\Requests\Product\Update as ProductUpdateRequest;
use App\Http\Resources\Items\Product\Update as ProductUpdateItemResource;
use Carbon\Carbon;

class UpdateController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $product = $product->retrieve($id);

        $product->name = $request->get('name');
        $product->sku = $request->get('sku');
        $product->price = $request->get('price');
        $product->updated_at = Carbon::now();
        $product->update();

        $product->removeOldCategory();
        $product->relateWithCategory($request->get('categories'));

        return new ProductUpdateItemResource($product);
    }
}
