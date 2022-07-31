<?php
require __DIR__ . '/../autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\CapabilityProfile;
use Mike42\Escpos\PrintBuffers\EscposPrintBuffer;
use Mike42\Escpos\PrintBuffers\ImagePrintBuffer;
use Carbon\Carbon;

 
function PrintReceipt($products, $order_id, $sub_total) {
    date_default_timezone_set('Asia/Tbilisi');


    $connector = new WindowsPrintConnector("80mm Series Printer");
    $printer = new Printer($connector);
 

    
    
    /* Initialize */
    $printer -> initialize();
 
    $printer -> setJustification(Printer::JUSTIFY_CENTER);
    
    $printer -> setTextSize(3, 3);
    $printer -> text("GHRELIN\n");

    $printer -> text("#" . $order_id);

    

    $subtotal = new subtotal('ჯამი', $sub_total . ' ლარი');
    $tarigi = new subtotal('თარიღი', Carbon::now());
     
    
    $buffer = new ImagePrintBuffer();
    $draw = new \ImagickDraw();
     $buffer -> setFont('sylfaen.ttf');
    $printer -> selectPrintMode(Printer::MODE_UNDERLINE);
    $printer -> setPrintBuffer($buffer);
    
    $items = array(
 
     
    );
    

    foreach ($products as $product) {
        $name = $product["product_name"] . " - " . $product["quantity"] . " ცალი - " . $product["price"] . " ლარი";
        $item =  new item(wordwrap($name, 120, "\n", true));
        array_push($items, $item);

    }
    $printer -> feed(4);
    foreach ($items as $item) {
        $printer -> text($item);
    
        $printer -> text("--------------------------------------------------------------------");
        $printer -> feed();
    }
    
    $printer -> feed(1);
    $printer -> text($subtotal);
    $printer -> feed(1);
    $printer -> text($tarigi);
    
    
    $printer -> feed(3);
     
    $printer -> cut();
     
    
     
    
    /* Pulse */
    $printer -> pulse();
    
    /* Always close the printer! On some PrintConnectors, no actual
     * data is sent until the printer is closed. */
    $printer -> close();

}


class item
{
    private $name;

    public function __construct($name = '')
    {
        $this -> name = $name;
    }
    
    public function __toString()
    {
        $rightCols = 30;
        $centerCols = 35;
        $leftCols = 70;
        
        $left = str_pad($this -> name, $leftCols) ;

        
               
        return "$left\n";
        
    }
}

class subtotal
{
    private $name;
    private $price;
    private $dollarSign;

    public function __construct($name = '', $price = '', $dollarSign = false)
    {
        $this -> name = $name;
        $this -> price = $price;
        $this -> dollarSign = $dollarSign;
    }
    
    public function __toString()
    {
        $rightCols = 1;
        $leftCols = 70;
        if ($this -> dollarSign) {
            $leftCols = $leftCols / 2 - $rightCols / 2;
        }
        $left = str_pad($this -> name, $leftCols) ;
        
        $sign = ($this -> dollarSign ? '$ ' : '');
        $right = str_pad($sign . $this -> price, $rightCols, ' ', STR_PAD_LEFT);
        return "$left$right\n";
    }
}