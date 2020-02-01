<?php

namespace App\Http\Controllers\API\Product;

use App\Http\Controllers\Controller;
use App\Models\Products\Product;
use App\Http\Resources\Items\Product\Delete as ProductDeleteItemResource;

class DeleteController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Product $product)
    {
        $product = $product->retrieve($id);
        $product->delete();

        return new ProductDeleteItemResource($product);
    }
}
