<?php

require_once '../../Control/DAFacade.php';
function generatePaymentXML() {
    

    $DAFacade = new DAFacade();
    $result = $DAFacade->retrievePaymentRecords();
    
    //create xml file
    // Step 3: Use PHP's XMLWriter class to create a new XML file and write data to it
    $xml = new XMLWriter();
    $xml->openURI("Payment.xml");
    $xml->startDocument("1.0", "UTF-8");
    $xml->writePi("xml-stylesheet", "type='text/xsl' href='Payment.xsl'");
    $xml->setIndent(true);

    // Step 4: Loop through the data retrieved by the SQL query and write it to the XML file
    $xml->startElement("PaymentRecords");
    while ($row = $result->fetch_object()) {
        $xml->startElement("Payment");
        $xml->writeElement("id",$row->paymentID);
        $xml->writeElement("amount",$row->paymentAmount);
        $xml->writeElement("method",$row->paymentMethod);
        $xml->writeElement("date",$row->paymentDate);
        $xml->writeElement("time",$row->paymentTime);
        $xml->endElement();
    }
    $xml->endElement();

    // Step 5: Close the XML file and any database connections
    $xml->endDocument();
    $xml->flush();
}

generatePaymentXML();
