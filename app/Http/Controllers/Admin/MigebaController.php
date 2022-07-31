<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SawyobisProduct;
use App\Models\Migeba;
use App\SubProduct;

class MigebaController extends Controller
{
    public function index() {
        $products = SubProduct::where("is_shaurma", 0)->get();
        $ingredientebi = SawyobisProduct::all();

        

        return view("admin.migeba.index", compact("products", "ingredientebi"));
    }

    public function ingredientisMigeba() {
        $ingredientebi = SawyobisProduct::all();
        return view("admin.migeba.ingredienti", compact("ingredientebi"));
    }

    public function insertIngredienti(Request $req) {
        $migeba = new Migeba();
        $migeba->is_ingredienti = 1;
        $migeba->product_id = $req->product_id;
        $migeba->erteuli = $req->erteuli;
        if($req->erteuli == 0) {
            $erteuli_var = "ცალი";
        }
        else {
            $erteuli_var = "კგ";
        }
        $migeba->erteuli_var = $erteuli_var;
        $migeba->quantity = $req->quantity;
        $migeba->erteulis_fasi = $req->price;
        $migeba->total = $req->quantity * $req->price;
        $migeba->save();

        $ingredienti = SawyobisProduct::find($req->product_id);
        $ingredienti->product_quantity += $req->quantity;
        $ingredienti->save();


        return redirect("/back/migeba")->with("message", "ინგრედიენტი მიღებულია წარმატებით");
    }

    public function productisMigeba() {
        $products = SubProduct::where("is_shaurma", 0)->get();
        return view("admin.migeba.product", compact("products"));
    }

    public function cancelMigeba($migeba_id) {
        $migeba = Migeba::find($migeba_id);
        if($migeba->is_ingredienti) {
            $product = SawyobisProduct::find($migeba->product_id);
            $product->product_quantity -= $migeba->quantity;
        }
        else {
            $product = SubProduct::find($migeba->product_id);
            $product->product_quantity -= $migeba->quantity;
        }
        $product->save();
        $migeba->delete();
        return redirect("/back/migeba")->with("message", "პროდუქტის მიღება წარმატებით გაუქმდა");
    }

    public function insertProduct(Request $req) {
        $migeba = new Migeba();
        $migeba->is_ingredienti = 0;
        $migeba->product_id = $req->product_id;
        $migeba->erteuli = $req->erteuli;
        if($req->erteuli == 0) {
            $erteuli_var = "ცალი";
        }
        else {
            $erteuli_var = "კგ";
        }
        $migeba->erteuli_var = $erteuli_var;
        $migeba->quantity = $req->quantity;
        $migeba->erteulis_fasi = $req->price;
        $migeba->total = $req->quantity * $req->price;
        $migeba->save();

        $product = SubProduct::find($req->product_id);
        $product->product_quantity += $req->quantity;
        $product->save();

        return redirect("/back/migeba")->with("message", "პროდუქტი მიღებულია წარმატებით");
    }

    public function ingredientisChasworeba($ingredientis_id) {
        $ingredient = SawyobisProduct::find($ingredientis_id);
        return view("admin.migeba.ingredientis-chasworeba", compact("ingredient"));
    }

    public function ingredientisUpdate(Request $req,$ingredientis_id) {
        $ingredient = SawyobisProduct::find($ingredientis_id);
        $ingredient->product_quantity = $req->quantity;
        $ingredient->save();
        return redirect("/back/migeba")->with("message", "პროდუქტის რაოდენობა წარმატებით განახლდა");
    }


    public function migebaArchiveIngredienti(Request $req) {
        $migebaIngredienti = SawyobisProduct::join("migeba", "migeba.product_id", "sawyobis_products.id")
        ->whereDate('migeba.created_at', '>=', $req->from)
        ->whereDate('migeba.created_at', '<=', $req->to)
        ->where("migeba.is_ingredienti", 1)
        ->orderBy("migeba.id", "desc")
        ->get();

        $migebaProduct = SubProduct::join("migeba", "migeba.product_id", "sub_products.id")
        ->whereDate('migeba.created_at', '>=', $req->from)
        ->whereDate('migeba.created_at', '<=', $req->to)
        ->where("migeba.is_ingredienti", 0)
        ->orderBy("migeba.id", "desc")
        ->get();

        $arrayIngredienti["ingredienti"] = $migebaIngredienti;
        $arrayIngredienti["products"] = $migebaProduct;

        return response()->json($arrayIngredienti, 200);
    }


    public function productisChasworeba($product_id) {
        $product = SubProduct::find($product_id);
        return view("admin.migeba.productis-chasworeba", compact("product"));
    }

    public function productUpdate(Request $req,$product_id) {
        $product = SubProduct::find($product_id);
        $product->product_quantity = $req->quantity;
        $product->save();
        return redirect("/back/migeba")->with("message", "პროდუქტის რაოდენობა წარმატებით განახლდა");
    }

}
