<?php


require_once '../../Control/productDA_Facade.php';

$productDAFacade = new productDA_Facade();
$result = $productDAFacade->retrieveProductList();
//create xml file
// Step 3: Use PHP's XMLWriter class to create a new XML file and write data to it
$xml = new XMLWriter();
$xml->openURI("Product.xml");
$xml->startDocument();
$xml->setIndent(true);

// Step 4: Loop through the data retrieved by the SQL query and write it to the XML file
$xml->startElement("productList");
while ($row = $result->fetch_object()) {
    $xml->startElement("Product");
    $xml->writeElement("productID", $row->productID);
    $xml->writeElement("productName", $row->productName);
    $xml->writeElement("productPrice", $row->productPrice);
    $xml->writeElement("productDesc", $row->productDesc);
    $xml->writeElement("stockQuantity", $row->stockQuantity);
    $xml->endElement();
}
$xml->endElement();

// Step 5: Close the XML file and any database connections
$xml->endDocument();
$xml->flush();
