<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductCategory;
use App\SubProduct;
use App\Models\Orders;
use App\Models\ParentOrders;
use App\SawyobisProduct;

class DashboardController extends Controller
{
    public function index() {
        $last_parent_order = ParentOrders::orderBy("id", "desc")->first();

        $last_order = SubProduct::join("orders", "orders.product_id", "sub_products.id")
        ->where("orders.parent_id", $last_parent_order->id)
        ->orderBy("orders.id", "desc")->get();

        $new_order_id = $last_parent_order->id + 1;

        $categories = ProductCategory::all();
        return view("add-product", compact('new_order_id', "last_parent_order", "last_order", 'categories'));
    }

    public function subProducts($category_id) {

        $table_data = '';      

        $sub_products = SubProduct::where("product_category", $category_id)->orderBy("product_price", "asc")->get();
        foreach ($sub_products as $sub_product) {

            if(!$sub_product->is_shaurma && $sub_product->product_category != 1) {
                $td = '<td class="product_titlec">რაოდ: '.$sub_product->product_quantity.'</td>';
                if($sub_product->product_quantity == 0) {
                    $disabled = 'disabled';
                }
                else {
                    $disabled = '';
                }
                
                
            }
            else {
                $td = '';
                $disabled = '';
            }

            $table_data .= '
            <tr>
            
            <td class="product_titlec">'.$sub_product->product_name.'</td>
            '.$td.'
            <td class="product_pricec">ფასი: '.$sub_product->product_price.'₾</td>
            
            <td><button '.$disabled.' data-toggle="modal" data-target="#product_modal" type="button" class="btn btn-primary" onclick="openDetails('.$sub_product->id.')">არჩევა</button></td>
            </tr>


            ';
        }
        return $table_data;
    }

    public function cancelOrder($order_id) {
 

        $order_item = Orders::find($order_id);
        $parentOrder = ParentOrders::find($order_item->parent_id);
        $amountToDis = $order_item->price*$order_item->quantity;
        $parentOrder->sub_total -= $amountToDis;
        $parentOrder->save();

        if($parentOrder->sub_total == 0) {
            $parentOrder->delete();
        }
  
        if($order_item->product_id == 18 or $order_item->product_id == 19 or  $order_item->product_id == 20 or  $order_item->product_id == 57) {
                $sawProduct = SawyobisProduct::find(9);
                $sawProduct->product_quantity += 1*$order_item->quantity;
                $sawProduct->save();   
        }

        if($order_item->product_id == 14) {
            $sardeli = SawyobisProduct::find(9);
            $sardeli->product_quantity += 1*$order_item->quantity;

            $yveli = SawyobisProduct::find(8);
            $yveli->product_quantity += 3*$order_item->quantity;
            $yveli->save();
            $sardeli->save();   
        }
            $product = SubProduct::find($order_item->product_id);

            if(!$product->is_shaurma){
                $product->product_quantity += $order_item->quantity;

            }
            else {
                $sawProduct = SawyobisProduct::find($product->puris_id);
                $sawProduct->product_quantity += $order_item->quantity;
                $sawProduct->save();
            }
            $product->save();

        $order_item->delete();
        
        return redirect()->back();
    }

    public function cancelOrderFront($order_id) {
        
        $order_items = Orders::where("parent_id", $order_id)->get();
        foreach ($order_items as $item) {
            $product = SubProduct::find($item->product_id);
            if(!$product->is_shaurma){
                $product->product_quantity += $item->quantity;
            }
            else {
                $sawProduct = SawyobisProduct::find($product->puris_id);
                $sawProduct->product_quantity += $item->quantity;
                $sawProduct->save();


                if($item->product_id == 18 or $item->product_id == 19 or  $item->product_id == 20 or  $item->product_id == 57) {
                    $sawProduct = SawyobisProduct::find(9);
                    $sawProduct->product_quantity += 1*$product->quantity;
                    $sawProduct->save();   
                }

                if($item->product_id == 14) {
                    $sardeli = SawyobisProduct::find(9);
                    $sardeli->product_quantity += 1*$item->quantity;

                    $yveli = SawyobisProduct::find(8);
                    $yveli->product_quantity += 3*$item->quantity;

                    $yveli->save();
                    $sardeli->save();   
                }


            }
            $product->save();
        }
        ParentOrders::find($order_id)->delete();

        Orders::where("parent_id", $order_id)->delete();
        

        return redirect()->back();
    }

    public function productDetails($product_id) {
        $product = SubProduct::find($product_id);
        return response()->json($product, 200);
    }
}
