<?php
require __DIR__ . '/../autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

/* Fill in your own connector here */
$connector = new WindowsPrintConnector("EPSON TM-T20 Receipt");
$printer = new Printer($connector);

/* Height and width */
$printer->selectPrintMode(Printer::MODE_DOUBLE_HEIGHT | Printer::MODE_DOUBLE_WIDTH);

$printer->selectPrintMode();
$heights = array(32);
$widths = array(8);


$standards = array (
       
        Printer::BARCODE_JAN8 => array (
               
                "example" => array (
                       
                        array (
                                "caption" => "8 char numeric including (wrong) check digit",
                                "content" => "01234567"
                        )
                )
        )
        
);
$printer->setBarcodeTextPosition(Printer::BARCODE_TEXT_BELOW);
foreach ($standards as $type => $standard) {
    $printer->selectPrintMode(Printer::MODE_DOUBLE_HEIGHT | Printer::MODE_DOUBLE_WIDTH);
    $printer->text($standard ["title"] . "\n");
    $printer->selectPrintMode();
    $printer->text($standard ["caption"] . "\n\n");
    foreach ($standard ["example"] as $id => $barcode) {
        $printer->setEmphasis(true);
        $printer->text($barcode ["caption"] . "\n");
        $printer->setEmphasis(false);
        $printer->text("Content: " . $barcode ["content"] . "\n");
        $printer->barcode($barcode ["content"], $type);
        $printer->feed();
    }
}
$printer->cut();
$printer->close();
