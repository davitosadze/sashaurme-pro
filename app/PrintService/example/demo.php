<?php
/**
 * This is a demo script for the functions of the PHP ESC/POS print driver,
 * Escpos.php.
 *
 * Most printers implement only a subset of the functionality of the driver, so
 * will not render this output correctly in all cases.
 *
 * @author Michael Billington <michael.billington@gmail.com>
 */
require __DIR__ . '/../autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintBuffers\ImagePrintBuffer;
use Carbon\Carbon;


$connector = new WindowsPrintConnector("POS-58-Series");
$printer = new Printer($connector);


/* Initialize */
$printer -> initialize();
$printer -> setJustification(Printer::JUSTIFY_CENTER);


/* Font modes */
$modes = array(
    Printer::MODE_FONT_B,
    Printer::MODE_EMPHASIZED,
    Printer::MODE_DOUBLE_HEIGHT,
    Printer::MODE_DOUBLE_WIDTH,
    Printer::MODE_UNDERLINE);
for ($i = 0; $i < pow(2, count($modes)); $i++) {
    $bits = str_pad(decbin($i), count($modes), "0", STR_PAD_LEFT);
    $mode = 0;
    for ($j = 0; $j < strlen($bits); $j++) {
        if (substr($bits, $j, 1) == "1") {
            $mode |= $modes[$j];
        }
    }
    $printer -> selectPrintMode($mode);
    $printer -> text("ABCDEFGHIJabcdefghijk\n");
}
$printer -> selectPrintMode(); // Reset
$printer -> cut();
