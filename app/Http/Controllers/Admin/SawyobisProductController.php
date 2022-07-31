<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SawyobisProduct;
use App\Models\Migeba;
use App\SubProduct;

class SawyobisProductController extends Controller
{
    public function index() {
        $sproducts = SawyobisProduct::all();
        return view("admin.sawproducts.index", compact('sproducts'));
    }

    public function add() {
        return view("admin.sawproducts.add");
    }

    public function insert(Request $req) {
        $sproduct = new SawyobisProduct();
        $sproduct->product_name = $req->sproductName;
        $sproduct->is_puri = $req->is_puri;

        $sproduct->save();

        return redirect('/back/sproducts')->with('message', 'Category Succesfully added!');

    }

    public function edit($sproduct_id) {
        $sproduct = SawyobisProduct::find($sproduct_id);
        return view("admin.sawproducts.edit", compact("sproduct"));
    }

    public function update(Request $req, $sproduct_id) {
        $sproduct = SawyobisProduct::find($sproduct_id);

        $sproduct->product_name = $req->sproductName;
        $sproduct->is_puri = $req->is_puri;

        $sproduct->save();

        return redirect('/back/sproducts')->with('message', 'Category Succesfully Updated!');
    }

    public function sawyobiArchive(Request $req) {
        $products = SawyobisProduct::all();
        $prodArr = array();
        $prodArr["ingredientebi"] = [];
        $prodArr["products"] = [];
        $front_products = SubProduct::where("is_shaurma", 0)->get();

        foreach ($products as $product) {
            $product_buy_count = Migeba::whereDate('created_at', '>=', $req->from)
            ->whereDate('created_at', '<=', $req->to)
            ->where("product_id", $product->id)
            ->where("is_ingredienti", 1)
            ->sum("quantity");
            $object["product_name"] = $product->product_name;
            $object["buyQuantity"] = $product_buy_count;  
            $migebaCount = Migeba::whereDate('created_at', '>=', $req->from)->where("is_ingredienti", 1)->whereDate('created_at', '<=', $req->to)->where("product_id", $product->id)->count();
            if($migebaCount != 0) {
                $prodPrice = Migeba::whereDate('created_at', '>=', $req->from)->where("is_ingredienti", 1)->whereDate('created_at', '<=', $req->to)->where("product_id", $product->id)->first();

                $object["erteulisFasi"] = $prodPrice->erteulis_fasi;  
            }
            else {
                $object["erteulisFasi"] = 0;  

            }
            
            array_push($prodArr["ingredientebi"], $object);
        }

        foreach ($front_products as $pr) {
            $pr_buy_count = Migeba::whereDate('created_at', '>=', $req->from)
            ->whereDate('created_at', '<=', $req->to)
            ->where("product_id", $pr->id)
            ->where("is_ingredienti", 0)
            ->sum("quantity");
            $object["product_name"] = $pr->product_name;
            $object["buyQuantity"] = $pr_buy_count;  
            $migebaCount = Migeba::whereDate('created_at', '>=', $req->from)->where("is_ingredienti", 0)->whereDate('created_at', '<=', $req->to)->where("product_id", $pr->id)->count();
            if($migebaCount != 0) {
                $prodPrice = Migeba::whereDate('created_at', '>=', $req->from)->where("is_ingredienti", 0)->whereDate('created_at', '<=', $req->to)->where("product_id", $pr->id)->first();
                $object["erteulisFasi"] = $prodPrice->erteulis_fasi;  
            }
            else {
                $object["erteulisFasi"] = 0;  

            }

            array_push($prodArr["products"], $object);
        }


        return response()->json($prodArr, 200);
 
    }

    public function delete($sproduct_id) {
        SawyobisProduct::find($sproduct_id)->delete();
        return redirect('/back/sproducts')->with('message', 'Category Succesfully deleted!');

    }}
