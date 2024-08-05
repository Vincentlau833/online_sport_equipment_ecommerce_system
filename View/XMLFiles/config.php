<?php
require_once 'fop-2.8';
define('FOP_LIB_DIR', 'fop-2.8');

// Load the XML input file
$xml = new DOMDocument();
$xml->load('Product.xml');

// Load the XSLT stylesheet
$xsl = new DOMDocument();
$xsl->load('Product.xsl');

// Set up the FOP processor
$fop = new FOPProcessor;
$fop->setBaseURL(FOP_LIB_DIR);
$fop->setXSLT($xsl);

// Generate the PDF output
$pdf = $fop->transformToPDF($xml);

// Output the PDF to the browser
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="output.pdf"');
echo $pdf;
