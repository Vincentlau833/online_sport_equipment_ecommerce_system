<?php

//DOM parser class
class DOMParser {
    private $xmlDoc;

    public function __construct($xml_file) {
        $this->xmlDoc = new DOMDocument();
        $this->xmlDoc->load($xml_file);
    }

    public function getNodeValue($xpath) {
        $xpathObj = new DOMXPath($this->xmlDoc);
        $nodeList = $xpathObj->query($xpath);

        if ($nodeList->length > 0) {
            return $nodeList->item(0)->nodeValue;
        } else {
            return null;
        }
    }

    public function getNodeAttribute($xpath, $attribute) {
        $xpathObj = new DOMXPath($this->xmlDoc);
        $nodeList = $xpathObj->query($xpath);

        if ($nodeList->length > 0) {
            return $nodeList->item(0)->getAttribute($attribute);
        } else {
            return null;
        }
    }

    public function getNodes($xpath) {
        $xpathObj = new DOMXPath($this->xmlDoc);
        $nodeList = $xpathObj->query($xpath);

        $result = array();
        foreach ($nodeList as $node) {
            $result[] = $this->nodeToArray($node);
        }
        return $result;
    }

    private function nodeToArray($node) {
        $result = array();
        if ($node->hasAttributes()) {
            $attributes = $node->attributes;
            foreach ($attributes as $attr) {
                $result[$attr->name] = $attr->value;
            }
        }
        if ($node->hasChildNodes()) {
            $children = $node->childNodes;
            if ($children->length == 1 && $children->item(0)->nodeType == XML_TEXT_NODE) {
                $result['_value'] = $children->item(0)->nodeValue;
                return count($result) == 1 ? $result['_value'] : $result;
            }
            foreach ($children as $child) {
                if ($child->nodeType != XML_TEXT_NODE) {
                    $result[$child->nodeName] = $this->nodeToArray($child);
                }
            }
        }
        return $result;
    }
}

