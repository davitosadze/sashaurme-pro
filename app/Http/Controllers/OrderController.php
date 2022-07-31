<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\ParentOrders;
use App\SubProduct;
use App\SawyobisProduct;

class OrderController extends Controller
{
    public function addOrder(Request $req){
        $products = $_GET['products'];
        $pay_method = $_GET['pay_method'];
        $sub_total = $_GET['sub_total'];
        $mevale = $_GET["mevale"];
        $is_nisia = $_GET["is_nisia"];


        $parent_order = new ParentOrders();
        $parent_order->sub_total = $sub_total;
        if($is_nisia) {
            $parent_order->mevale = $mevale;
            $parent_order->is_nisia = 1;
        }

        $parent_order->pay_method = $pay_method;
        $parent_order->save();


        foreach ($products as $product) {
            
            $order_item = new Orders();
            $order_item->product_id = $product['product_id'];
            $order_item->price = $product['each_price'];

            $pr = SubProduct::find($product['product_id']);

            if(!$product['is_shaurma']) {
                $pr->product_quantity -= $product['quantity'];
                $pr->save();
            }
            else {
                $saw_product = SawyobisProduct::find($pr->puris_id);
                $saw_product->product_quantity -= $product["quantity"];
                $saw_product->save();


                #RAODENOBEBIS DAKLEBA
                if($product["product_id"] == 18 or $product["product_id"] == 19 or  $product["product_id"] == 20 or  $product["product_id"] == 57) {
                    $sawProduct = SawyobisProduct::find(9);
                    $sawProduct->product_quantity -= 1*$product["quantity"];
                    $sawProduct->save();   
                }

                if($product["product_id"] == 14) {
                    $sardeli = SawyobisProduct::find(9);
                    $sardeli->product_quantity -= 1*$product["quantity"];

                    $yveli = SawyobisProduct::find(8);
                    $yveli->product_quantity -= 3*$product["quantity"];

                    $yveli->save();
                    $sardeli->save();   
                }


            }

            $order_item->quantity = $product['quantity'];
            $order_item->additional_info = $product['additionalInfo'];
            $order_item->parent_id = $parent_order->id;
            $order_item->pay_method = $pay_method;
            $order_item->save();
        }



        echo "შეკვეთა წარმატებით შეიქმნა";
        
    }

    public function print() {
        include(app_path().'/PrintService/example/receipt-with-logo.php');

        $products = $_GET['products'];
        $order_id = $_GET["order_id"];
        $sub_total = $_GET["sub_total"];

        if($_GET["check_type"] == 1) {
            PrintReceipt($products,$order_id,$sub_total);

        }
        else if ($_GET["check_type"] == 2) { 
            PrintReceipt($products,$order_id,$sub_total);
            PrintReceipt($products,$order_id,$sub_total);

        }



    }
}
