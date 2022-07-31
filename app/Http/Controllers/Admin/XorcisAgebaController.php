<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ageba;
use App\SawyobisProduct;

class XorcisAgebaController extends Controller
{
    public function index() {
        $ageba = Ageba::orderBy("id", "desc")->get();

        return view('admin.ageba.index', compact('ageba'));
    }

    public function add() {
        return view('admin.ageba.add');
    }

    public function insert(Request $req) {
        $ageba = new Ageba();
        $ageba->amount = $req->amount;

        $xorci = SawyobisProduct::find(3);
        $xorci->product_quantity -= $req->amount;
        $xorci->save();

        $ageba->save();

        return redirect('/back/ageba')->with('message', 'Category Succesfully added!');

    }
}
