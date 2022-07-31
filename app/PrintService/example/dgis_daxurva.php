<?php
require __DIR__ . '/../autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\CapabilityProfile;
use Mike42\Escpos\PrintBuffers\EscposPrintBuffer;
use Mike42\Escpos\PrintBuffers\ImagePrintBuffer;


function  dgis_daxurva($barati_quantity, $barati_summary, $nagdi_quantity, $nagdi_summary) {




$connector = new WindowsPrintConnector("EPSON TM-T20 Receipt");
$printer = new Printer($connector);
/* Information for the receipt */
$titles = new title('დასახელება', 'ფასი',"რაოდ");
$items = array(
    new item("ბარათით", $barati_summary,$barati_quantity),
    new item("ნაღდი",  $nagdi_summary, $nagdi_quantity),

);
 

$date = date("H:i:s d/m/Y",strtotime('+4 hours'));

/* Start the printer */
$profile = CapabilityProfile::load("simple");
$printer = new Printer($connector, $profile);



/* Print top logo */
$printer -> setJustification(Printer::JUSTIFY_CENTER);

/* Name of shop */

$buffer = new ImagePrintBuffer();
$buffer -> setFont('sylfaen.ttf');
// $buffer -> setFontSize(30);

$printer -> setPrintBuffer($buffer);

$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
$printer -> text("Launderia\n");
$printer -> selectPrintMode();
$printer -> text("Saburtalo\n");
$printer -> feed();

/* Title of receipt */
$printer -> setEmphasis(true);
$printer -> text("დღის დახურვა\n");
$printer -> feed();
$printer -> setEmphasis(false);

/* Items */
$buffer -> setFont('sylfaen.ttf');
// $buffer -> setFontSize(28);
$printer -> setPrintBuffer($buffer);

 

foreach ($items as $item) {
    $printer -> text($item);
}



/* Tax and total */
$buffer -> setFont('sylfaen.ttf');
$buffer -> setFontSize(35);
$printer -> setPrintBuffer($buffer);
$printer -> feed();
$printer -> setJustification(Printer::JUSTIFY_LEFT);
 

$printer = new Printer($connector);
/* Height and width */
$printer->selectPrintMode(Printer::MODE_DOUBLE_HEIGHT | Printer::MODE_DOUBLE_WIDTH);
 
 

$printer -> setJustification(Printer::JUSTIFY_CENTER);

$printer -> text($date . "\n");
$printer -> cut();
$printer -> close();
/* A wrapper to do organise item names & prices into columns */


}

class item
{
    private $name;
    private $price;
    private $raod;

    public function __construct($name = '', $price = '', $raod = "1")
    {
        $this -> name = $name;
        $this -> price = $price;
        $this -> raod = $raod;
    }
    
    public function __toString()
    {
        $rightCols = 30;
        $centerCols = 30;
        $leftCols = 30;
        
        $left = str_pad($this -> name, $leftCols) ;
        $center = 'x' . $this -> raod;
        
       
        $right = str_pad( $this  -> price . " L", $rightCols, ' ', STR_PAD_LEFT);
        $center = str_pad( 'x' . $this ->  raod, $centerCols, ' ', STR_PAD_LEFT );
        
        return "$left$center$right\n";
        
    }
}

class title
{
    private $name;
    private $price;
    private $raod;

    public function __construct($name = '', $price = '', $raod = "")
    {
        $this -> name = $name;
        $this -> price = $price;
        $this -> raod = $raod;
    }
    
    public function __toString()
    {
        $rightCols = 35;
        $centerCols = 35;
        $leftCols = 20;
        
        $left = str_pad($this -> name, $leftCols) ;
        $center = $this -> raod;
        
       
        $right = str_pad( $this  -> price, $rightCols, ' ', STR_PAD_LEFT);
        $center = str_pad( $this ->  raod, $centerCols, ' ', STR_PAD_LEFT );
        
        return "$left$center$right\n";
        
    }
}


class Total
{
    private $name;
    private $price;
    

    public function __construct($name = '', $price = '')
    {
        $this -> name = $name;
        $this -> price = $price;
        
    }
    
    public function __toString()
    {
        
        
        $left = str_pad($this -> name, 30,' ', STR_PAD_RIGHT) ;
        
        
       
        $right = str_pad( $this  -> price, 30,' ', STR_PAD_LEFT);
        
        
        return "$left$right\n";
        
    }
}


