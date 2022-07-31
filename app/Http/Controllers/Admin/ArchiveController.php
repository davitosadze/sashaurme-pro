<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\ParentOrders;
use App\Models\Migeba;
use App\Models\Orders;
use App\SubProduct;
use App\Models\Ageba;
use App\Models\Xarji;

class ArchiveController extends Controller
{
    public function index() {
        return view("admin.archive.index");
    }

    public function archiveData(Request $req) {
        $from = $req->from;
        $to = $req->to;

        $sul_gayiduli = Orders::whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->sum("quantity");

       // $shemosavali = ParentOrders::whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->sum("sub_total");
        $shemosavali = 0;
        $gasavali = Migeba::whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->sum("total");

        $products = SubProduct::all();
        $prodArr = array();
        foreach ($products as $product) {
            $product_sale_count = Orders::whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->where("product_id", $product->id)->sum("quantity");
            $object["product_name"] = $product->product_name;
            $object["quantity"] = $product_sale_count;
            $object["shemosavali"] = $product_sale_count*$product->product_price;
            $shemosavali += $product_sale_count*$product->product_price;
            array_push($prodArr, $object);
        }

        $shaurmebi = SubProduct::where("is_shaurma", 1)
        ->where("id", "!=", 18)
        ->where("id", "!=", 19)
        ->where("id", "!=", 21)
        ->get();
        $dges_agebuli = Ageba::whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->sum("amount");
        $shaurmebidanShemosuli = 0;
        foreach ($shaurmebi as $sh) {
            $income = Orders::whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->where("product_id", $sh->id)->sum("quantity");
            number_format($shaurmebidanShemosuli += $income * $sh->product_price,2);
        }
        if($dges_agebuli != 0) {
           number_format($shaurmebidanShemosuli /= $dges_agebuli,2);
        }
        else {
            $shaurmebidanShemosuli = "დღეს ხორცი არ აგებულა";
        }

        $damatebiti_xarji = Xarji::whereDate('created_at', '>=', $from)->whereDate('created_at', '<=', $to)->sum("amount");

        $array["damatebiti_xarji"] = $damatebiti_xarji;
        $array["shemosavali"] = number_format($shemosavali, 2);
        $array["sul_gayiduli"] = $sul_gayiduli;
        $array["gasavali"] = number_format($gasavali+$damatebiti_xarji, 2);
        $array["mogeba"] = number_format($shemosavali - $gasavali - $damatebiti_xarji, 2);
        $array["products"] = $prodArr;
        $array["sash_shemosavali"] = $shaurmebidanShemosuli;


        return response()->json($array, 200);
    }
}
