<?php


function getCipherList()
{
    $html = "";
    $html .= "<li><a href=\"caesarcipher.php\">Caesar Cipher</a></li>";
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

function caesar($str, $n)
{
    include 'config.php';
    $ret = "";
    for ($i = 0, $l = strlen($str); $i < $l; ++$i) {
        $c = ord($str[$i]);
        if (97 <= $c && $c < 123) {
            $ret .= chr(($c + $n + 7) % 26 + 97);
        } else if (65 <= $c && $c < 91) {
            $ret .= chr(($c + $n + 13) % 26 + 65);
        } else {
            $ret .= $str[$i];
        }
    }
    if (isset($_SESSION['userEmail'])) {
        $uemail = $_SESSION['userEmail'];
        $query = mysqli_query($con, "INSERT INTO userhistory(`id`,`email`, `cipher`, `userstring`,`cipherkey`,`datetime`,`encryptedtext`)
					VALUES ('','$uemail','Caesar Cipher','$str','$n',NOW(),'$ret')");
    }
    return $ret;
}

?>