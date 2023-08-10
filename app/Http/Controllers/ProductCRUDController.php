<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use App\Services\CRUDProductService;
use Illuminate\Http\Request;

class ProductCRUDController extends Controller
{
    private CRUDProductService $product_Service;

    public function __construct(CRUDProductService $productService)
    {
        $this->product_Service = $productService;
    }


    public function store(ProductStoreRequest $request)
    {
        $this->product_Service->store($request);
        return response()->json(['message'=>'Product Added']);
    }
    public function edit(Request $request)
    {
        $html_edit_product = $this->product_Service->edit($request);
        return response()->json(['html'=>$html_edit_product]);
    }
    public function update(Request $request,$id)
    {
       $this->product_Service->update($request,$id);
//        return response()->json(['message'=>'Product Updated']);
        return redirect()->route('products');
    }
    public function delete(Request $request)
    {
        $this->product_Service->delete($request);
        return response()->json(['message'=>'Product deleted']);
    }


}
