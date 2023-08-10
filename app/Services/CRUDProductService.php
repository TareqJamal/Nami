<?php

namespace App\Services;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class CRUDProductService
{
    public function store(ProductStoreRequest $request)
    {
        $data = $request->all();
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName().uniqid();
            $location = $image->move('Product_images',$image_name);
            $data['image'] = $location;
        }
        Product::create($data);
    }

    public function delete(Request $request)
    {
        Product::destroy($request->id);
    }

    public function edit(Request $request)
    {
        $product = Product::findorfail($request->id);
        $html_edit_product = view('edit_product',compact('product'))->render();
        return $html_edit_product;

    }
    public function update(Request $request , $id)
    {
        $product = Product::findorfail($id);
        $data = $request->all();
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName().uniqid();
            $location = $image->move('Product_images',$image_name);
            $data['image'] = $location;
        }
       $product->update($data);
    }

}
