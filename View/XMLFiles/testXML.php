<?php

require_once 'DOMParser.php';
require_once '../../Model/Product.php';

$xml_parser = new DOMParser('Product.xml');
//echo $xml_parser->getNodeValue('/productList/Product/productID');
$result = $xml_parser->getNodes('/productList/Product');
print_r($result);
