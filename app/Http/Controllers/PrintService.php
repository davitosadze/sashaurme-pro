<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use charlieuki\ReceiptPrinter\ReceiptPrinter as ReceiptPrinter;

class PrintService extends Controller
{
    public function print() {
        include(app_path().'/PrintService/example/demo.php');
     }
 
}
