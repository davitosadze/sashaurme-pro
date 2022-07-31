<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Xarji;

class DXarjiController extends Controller
{
    public function index() {
        $xarji = Xarji::all();
        return view("admin.xarji.index", compact("xarji"));
    }

    public function add() {
        return view('admin.xarji.add');
    }

    public function insert(Request $req) {
        $xarji = new Xarji();
        $xarji->amount = $req->amount;

        $xarji->save();

        return redirect('/back/xarji')->with('message', 'Category Succesfully added!');

    }
}
