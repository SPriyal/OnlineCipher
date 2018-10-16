<?php


function getCipherList()
{
    $html = "";
    $html .= "<li><a href=\"#\">Caesar Cipher</a></li>";
    $html .= "<li><a href=\"#\">Vigenere Cipher (PolyAlphabetic)</a></li>";
    $html .= "<li><a href=\"#\">MonoAlphabetic Cipher</a></li>";
    $html .= "<li><a href=\"#\">Rail Fence Cipher</a></li>";
    return $html;
}

function getAlgoList()
{
    $html = "";
    $html .= "<li><a href=\"#\">PublicKey algorithms</a></li>";
    $html .= "<li><a href=\"#\">Hash Algorithms</a></li>";
    $html .= "<li><a href=\"#\">Symmetric Key algorithms</a></li>";
    $html .= "<li><a href=\"#\">Integrity Checking</a></li>";
    return $html;
}


?>