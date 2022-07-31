<?php
require __DIR__ . '/../autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use mikehaertl\wkhtmlto\Pdf;
 
    $source = __DIR__ . "/resources/document.html";
    $pdf = new Pdf($source);
    if (!$pdf->saveAs('/path/to/page.pdf')) {
        $error = $pdf->getError();
        // ... handle error here
    }

