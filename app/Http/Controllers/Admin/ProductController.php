<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SubProduct;
use App\ProductCategory;
use App\SawyobisProduct;

class ProductController extends Controller
{
    public function index() {
        $products = ProductCategory::join("sub_products", "product_categories.id", "sub_products.product_category")
        ->orderBy("sub_products.id", "desc")
        ->get();
        return view("admin.products.index", compact('products'));
    }

    public function add() {
        $categories = ProductCategory::all();
        $puri = SawyobisProduct::where("is_puri", 1)->get();
        return view("admin.products.add", compact("categories", "puri"));
    }

    public function insert(Request $req) {
        $product = new SubProduct();
        $product->product_category = $req->productCategory;
        $product->product_name = $req->productName;
        $product->product_price = $req->productPrice;
        $product->product_quantity = $req->productQuantity;
        $product->puris_id = $req->puris_id;

        $product->is_shaurma = $req->is_shaurma;
        if(!$req->is_shaurma) {
            $product->is_shaurma = 0;
        }


        if ($req->hasFile('productImage')) {
            $req->productImage->store('product_images', 'public');
            $image_name = $req->productImage->hashName();
            $product->product_image = url('/') . "/storage/product_images/" . $image_name;
        }
        $product->save();

        return redirect('/back/products')->with('message', 'Category Succesfully added!');

    }

    public function edit($product_id) {
        $puri = SawyobisProduct::where("is_puri", 1)->get();

        $product = SubProduct::find($product_id);
        $categories = ProductCategory::all();

        return view("admin.products.edit", compact("product", "categories", "puri"));
    }

    public function update(Request $req, $category_id) {
        $product = SubProduct::find($category_id);

        $product->product_category = $req->productCategory;
        $product->product_name = $req->productName;
        $product->product_price = $req->productPrice;
        $product->puris_id = $req->puris_id;
        $product->product_quantity = $req->productQuantity;

        $product->is_shaurma = $req->is_shaurma;
        if(!$req->is_shaurma) {
            $product->is_shaurma = 0;
        }




        if ($req->hasFile('productImage')) {
            $req->productImage->store('product_images', 'public');
            $image_name = $req->productImage->hashName();
            $product->product_image = url('/') . "/storage/product_images/" . $image_name;
        }
        $product->save();

        return redirect('/back/products')->with('message', 'Category Succesfully Updated!');
    }

    public function delete($category_id) {
        SubProduct::find($category_id)->delete();
        return redirect('/back/products')->with('message', 'Category Succesfully deleted!');

    }

}
