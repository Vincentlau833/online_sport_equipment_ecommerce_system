<?php

require_once '../../Control/DAFacade.php';
function generateProductXML() {
    

    $DAFacade = new DAFacade();
    $result = $DAFacade->retrieveProductList();
    
    //create xml file
    // Step 3: Use PHP's XMLWriter class to create a new XML file and write data to it
    $xml = new XMLWriter();
    $xml->openURI("Product.xml");
    $xml->startDocument("1.0", "UTF-8");
    $xml->writePi("xml-stylesheet", "type='text/xsl' href='Product.xsl'");
    $xml->setIndent(true);

    // Step 4: Loop through the data retrieved by the SQL query and write it to the XML file
    $xml->startElement("Products");
    while ($row = $result->fetch_object()) {
        $xml->startElement("Product");
        $xml->writeElement("id",$row->productID);
        $xml->writeElement("name",$row->productName);
        $xml->writeElement("price",$row->productPrice);
        $xml->writeElement("desc",$row->productDesc);
        $xml->writeElement("stockQuantity",$row->stockQuantity);
        $xml->endElement();
    }
    $xml->endElement();

    // Step 5: Close the XML file and any database connections
    $xml->endDocument();
    $xml->flush();
}

generateProductXML();

