<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\XorcisXarji;
use App\SawyobisProduct;

class XorcisXarjiController extends Controller
{
    public function index() {
        $xarji = XorcisXarji::all();
        return view('admin.xorcisxarji.index', compact("xarji"));
    }

    public function add() {
        return view('admin.xorcisxarji.add');

    }

    public function insert(Request $req) {
        $xarji = new XorcisXarji();
        $xarji->amount = $req->amount;

        $pr = SawyobisProduct::find(3);
        $pr->product_quantity -= $req->amount;
        $pr->save();

        $xarji->save();

        return redirect("/back/xorcisxarji");


    }
}
