<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProductCategory;

class CategoryController extends Controller
{
    public function index() {
        $categories = ProductCategory::all();
        return view("admin.categories.index", compact('categories'));
    }

    public function add() {
        return view("admin.categories.add");
    }

    public function insert(Request $req) {
        $category = new ProductCategory();
        $category->category_name = $req->categoryName;

        if ($req->hasFile('categoryImage')) {
            $req->categoryImage->store('category_images', 'public');
            $image_name = $req->categoryImage->hashName();
            $category->category_image = url('/') . "/storage/category_images/" . $image_name;
        }
        $category->save();

        return redirect('/back/categories')->with('message', 'Category Succesfully added!');

    }

    public function edit($category_id) {
        $category = ProductCategory::find($category_id);
        return view("admin.categories.edit", compact("category"));
    }

    public function update(Request $req, $category_id) {
        $category = ProductCategory::find($category_id);

        $category->category_name = $req->categoryName;

        if ($req->hasFile('categoryImage')) {
            $req->categoryImage->store('category_images', 'public');
            $image_name = $req->categoryImage->hashName();
            $category->category_image = url('/') . "/storage/category_images/" . $image_name;
        }
        $category->save();

        return redirect('/back/categories')->with('message', 'Category Succesfully Updated!');
    }

    public function delete($category_id) {
        ProductCategory::find($category_id)->delete();
        return redirect('/back/categories')->with('message', 'Category Succesfully deleted!');

    }
}
