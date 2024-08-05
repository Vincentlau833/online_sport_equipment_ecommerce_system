<?php

require_once '../../Control/DAFacade.php';
function generateCustomerXML() {
    

    $DAFacade = new DAFacade();
    $result = $DAFacade->retrieveAllUser();
    
    //create xml file
    // Step 3: Use PHP's XMLWriter class to create a new XML file and write data to it
    $xml = new XMLWriter();
    $xml->openURI("Customer.xml");
    $xml->startDocument("1.0", "UTF-8");
    $xml->writePi("xml-stylesheet", "type='text/xsl' href='Customer.xsl'");
    $xml->setIndent(true);

    // Step 4: Loop through the data retrieved by the SQL query and write it to the XML file
    $xml->startElement("Customers");
    while ($row = $result->fetch_object()) {
        $xml->startElement("Customer");
        $xml->writeElement("id",$row->custID);
        $xml->writeElement("userName",$row->userName);
        $xml->writeElement("email",$row->email);
        $xml->writeElement("gender",$row->gender);
        $xml->writeElement("contactNo",$row->contactNo);
        $xml->endElement();
    }
    $xml->endElement();

    // Step 5: Close the XML file and any database connections
    $xml->endDocument();
    $xml->flush();
}

generateCustomerXML();
