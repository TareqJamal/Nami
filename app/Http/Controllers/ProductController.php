<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\LaravelLocalization;
use Yajra\DataTables\Facades\DataTables;
class ProductController extends Controller
{
   public function index()
   {
       return view('product');
   }

   public function products_data()
   {
       if(\request()->ajax()) {
           $product = Product::get();
           return DataTables::of($product)
               ->addIndexColumn()
               ->editColumn('image', function (Product $product) {
                   return '<img src="' . asset('').$product->image . '" width="100 height="80">';
               })
               ->addColumn('action', function (Product $product) {
                   $btn = "<a id='btn_edit' class='edit btn btn-primary btn-sm' data-id=" . $product->id . " >Edit Product</a>";
                   $btn = $btn . "<a id='btn_delete' class='edit btn btn-danger btn-sm' data-id=" . $product->id . " >Delete Product</a>";
                   return $btn;
               })
               ->rawColumns(['action','image'])
               ->toJSON();
       }
       else
       {
           return view('products');
       }
   }
}
