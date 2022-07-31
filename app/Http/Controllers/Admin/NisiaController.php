<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ParentOrders;

class NisiaController extends Controller
{
    public function index() {
        $nisia = ParentOrders::where("is_nisia", 1)
        ->where("is_paid", 0)
        ->get();


        $migebuli_nisiebi = ParentOrders::where("is_nisia", 1)
        ->where("is_paid", 1)
        ->get();
        return view("admin.nisia.index", compact("nisia", "migebuli_nisiebi"));
    }

    public function addNisia(){
        return view("admin.nisia.nisia");
    }

    public function insertNisia(Request $req) {
        $parent_order = new ParentOrders();
        $parent_order->sub_total = $req->raodenoba;
        $parent_order->mevale = $req->mevale;
        $parent_order->is_nisia = 1;
        $parent_order->save();

        return redirect("/back/nisia");
        
    } 


    public function mivige($nisia_id) {
        $nisia = ParentOrders::find($nisia_id);
        $nisia->is_paid = 1;
        $nisia->save();

        return redirect()->back();
    }
}
