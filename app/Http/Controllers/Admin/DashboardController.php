<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\ParentOrders;
use Carbon\Carbon;
use App\SubProduct;
use App\ProductCategory;

class DashboardController extends Controller
{
    public function index() {
        #AQ UNDA GAVAMRAVLOT GAYIDVIS RAODENOBAZE
        $today_shaurma = SubProduct::join("orders", "orders.product_id", "sub_products.id")
        ->where("sub_products.is_shaurma", 1)
        ->whereDate("orders.created_at", Carbon::today())
        ->sum("orders.quantity");

        $today_sum = ParentOrders::whereDate("created_at", Carbon::today())
        ->sum("sub_total");

        $categoryArr = array();

        $categories = ProductCategory::all();
        foreach ($categories as $category) {
            $di["category_name"] = $category->category_name;
            $products = SubProduct::where("product_category", $category->id)->get();
            $each_count = 0;
            foreach ($products as $product) {
                $item_count = Orders::whereDate("orders.created_at", Carbon::today())
                ->where("product_id", $product->id)->sum("quantity");
                $each_count += $item_count;
            }

            $di["items_count"] = $each_count;
            array_push($categoryArr, $di);
        }

        $orders =SubProduct::join("orders", "orders.product_id", "sub_products.id")
        ->whereDate("orders.created_at", Carbon::today())
        ->orderBy("orders.id", "desc")
        ->get();

        $today_sum = number_format($today_sum, 2);
 
        return view("admin.dashboard", compact("today_sum", "today_shaurma", "categoryArr", "orders"));
    }

}
