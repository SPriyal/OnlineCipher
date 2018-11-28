<?php


function getCipherList()
{
    $html = "";
    $html .= "<li><a href=\"caesarcipher.php\">Caesar Cipher</a></li>";
    $html .= "<li><a href=\"vigenerecipher.php\">Vigenere Cipher (PolyAlphabetic)</a></li>";
    $html .= "<li><a href=\"blowfishUI.php\">Blowfish Encryption</a></li>";
    $html .= "<li><a href=\"rsaUI.php\">RSA Encryption</a></li>";
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
    include "config.php";
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

        $stmt = $con->prepare("INSERT INTO userhistory(email, cipher, userstring, datetime, encryptedtext)  VALUES (?, ?, ?, NOW(), ?)");
        $ciphername = 'Caesar Cipher';
        $stmt->bind_param("ssss", $uemail, $ciphername, $str, $ret);
        $stmt->execute();
        $stmt->close();



//        $query = mysqli_query($con, "INSERT INTO userhistory('id','email', 'cipher', 'userstring','cipherkey','datetime','encryptedtext')
//					VALUES ('','$uemail','Caesar Cipher','$str','$n',NOW(),'$ret')");
//        $check = mysqli_fetch_assoc($query);
    }
    return $ret;
}


function caesar_decrypt($str, $offset) {
    $decrypted_text = "";
    $offset = $offset % 26;
    if($offset < 0) {
        $offset += 26;
    }
    $i = 0;
    while($i < strlen($str)) {
        $c = strtoupper($str{$i});
        if(($c >= "A") && ($c <= 'Z')) {
            if((ord($c) - $offset) < ord("A")) {
                $decrypted_text .= chr(ord($c) - $offset + 26);
            } else {
                $decrypted_text .= chr(ord($c) - $offset);
            }
        } else {
            $decrypted_text .= " ";
        }
        $i++;
    }
    return $decrypted_text;
}





function VigenereCipher($plainText,$key)
{
    $key1=$key;
    include "config.php";
    $plainText= strtoupper($plainText);
    $key= strtoupper($key);
    if(ctype_alpha($key)==true)
    {
        $plain_text=str_split($plainText);
        $n=count($plain_text);
        $key=str_split($key);
        $m=count($key);
        $encrypted_text="";
        for ($i=0; $i<$n;$i++)
        {
            $encrypted_text.=chr(((ord($plain_text[$i])-65+ord($key[$i%$m])-65)%26) +65);
        }
        if(isset($_SESSION['userEmail'])){
            $uemail=$_SESSION['userEmail'];

            $stmt = $con->prepare("INSERT INTO userhistory(email, cipher, userstring, datetime, encryptedtext)  VALUES (?, ?, ?, NOW(), ?)");
            $ciphername = 'Vigenere Cipher';
            $stmt->bind_param("ssss", $uemail, $ciphername, $plainText, $encrypted_text);
            $stmt->execute();
            $stmt->close();


//            $query = mysqli_query($con,"INSERT INTO userhistory(`id`,`email`, `cipher`, `userstring`,`cipherkey`,`datetime`,`encryptedtext`)
//					VALUES ('','$uemail','Vegenere Cipher','$plainText','$key1',NOW(),'$encrypted_text')");
        }
        return $encrypted_text;
    }
    else
        return "Please Enter Alphbetic key for Vegenere Cipher or PolyAlphabetic Cipher";
}



function Vigenere_decrypt($text, $pswd)
{
    // change key to lowercase for simplicity
    $pswd = strtolower($pswd);

    // intialize variables
    $code = "";
    $ki = 0;
    $kl = strlen($pswd);
    $length = strlen($text);

    // iterate over each line in text
    for ($i = 0; $i < $length; $i++)
    {
        // if the letter is alpha, decrypt it
        if (ctype_alpha($text[$i]))
        {
            // uppercase
            if (ctype_upper($text[$i]))
            {
                $x = (ord($text[$i]) - ord("A")) - (ord($pswd[$ki]) - ord("a"));

                if ($x < 0)
                {
                    $x += 26;
                }

                $x = $x + ord("A");

                $text[$i] = chr($x);
            }

            // lowercase
            else
            {
                $x = (ord($text[$i]) - ord("a")) - (ord($pswd[$ki]) - ord("a"));

                if ($x < 0)
                {
                    $x += 26;
                }

                $x = $x + ord("a");

                $text[$i] = chr($x);
            }

            // update the index of key
            $ki++;
            if ($ki >= $kl)
            {
                $ki = 0;
            }
        }
    }

    // return the decrypted text
    return $text;
}


function blow($plaintext,$key)
{
    require_once('blowfish.php');
    include "config.php";
    $IV = "What about this initialisation vector?";
    $ciphertext ="";

    $ciphertext = Blowfish::encrypt(
        $plaintext,
        $key, # encryption key
        Blowfish::BLOWFISH_MODE_CBC, # Encryption Mode
        Blowfish::BLOWFISH_PADDING_RFC, # Padding Style
        $IV  # Initialisation Vector - required for CBC
    );

    $ciphertext = bin2hex($ciphertext);

    if (isset($_SESSION['userEmail'])) {
        $uemail = $_SESSION['userEmail'];
        $stmt = $con->prepare("INSERT INTO userhistory(email, cipher, userstring, datetime, encryptedtext)  VALUES (?, ?, ?, NOW(), ?)");
        $ciphername = 'Blowfish';
        $stmt->bind_param("ssss", $uemail, $ciphername, $plaintext, $ciphertext);
        $stmt->execute();
        $stmt->close();
    }

    return $ciphertext;

}

function blow_decrypt($ciphertext,$key)
{
    require_once('blowfish.php');

    $IV = "What about this initialisation vector?";

    $ciphertext = hex2bin($ciphertext);

    $plaintext = Blowfish::decrypt(
        $ciphertext,
        $key,
        Blowfish::BLOWFISH_MODE_CBC, # Encryption Mode
        Blowfish::BLOWFISH_PADDING_RFC, # Padding Style
        $IV  # Initialisation Vector - required for CBC
    );

    return $plaintext;

}

function rsa($plaintext,$key)
{
    include 'vendor/autoload.php';
    include "config.php";
     $rsa = new \phpseclib\Crypt\RSA();
     extract($rsa->createKey());

     $rsa->loadKey($privatekey);

     $ciphertext = $rsa->encrypt($plaintext);

     $pk = $rsa->getpublickey();
     $ct = bin2hex($ciphertext);

     //return $ciphertext;
    // RSA libray generates and expects in a specific format, so we need to extract the key value and rebuild the key in the rsa_decrypt function
    $pk = get_rsaKeyFormated($pk);


     $result = array(
         "key" => $pk,
         "text" => $ct
     );

     if (isset($_SESSION['userEmail'])) {
        $uemail = $_SESSION['userEmail'];
        $stmt = $con->prepare("INSERT INTO userhistory(email, cipher, userstring, datetime, encryptedtext)  VALUES (?, ?, ?, NOW(), ?)");
        $ciphername = 'RSA';
        $stmt->bind_param("ssss", $uemail, $ciphername, $plaintext, $ciphertext);
        $stmt->execute();
        $stmt->close();
    }

    return $result;


}

function get_rsaKeyFormated($k)
{
    $pos1 = strlen('-----BEGIN PUBLIC KEY----- ');
    $pos2 = -strlen(' -----END PUBLIC KEY----');
    $len = strlen($k);
    $length = abs($len -$pos1 + $pos2);
 
   return substr($k, $pos1, $length);


}

function rsa_decrypt($ciphertext,$key)
{
    include 'vendor/autoload.php';
    $rsa = new \phpseclib\Crypt\RSA();

    $ciphertext = hex2bin($ciphertext);

    //rebuilding the key in the format RSA library expects
    $finalkey = '-----BEGIN PUBLIC KEY----- ' . $key . ' -----END PUBLIC KEY----'  ;

    $rsa->setPublicKey($finalkey);
    $rsa->loadKey($finalkey);
   

    $plaintext = $rsa->decrypt($ciphertext);
    
    return $plaintext;

    

}


function getProfile()
{
    $html = "";
    include 'config.php';
    $email = $_SESSION["userEmail"];
    $qry = mysqli_query($con, "SELECT * FROM userinfo WHERE email = '$email';"); //passed as a hidden parameter when user registers.
    $check = mysqli_fetch_assoc($qry);
    $check1 = $check["datecreated"];
    $imagepath = $check['profilepic'];
    $html .= "<h1>Your Current Profile :</h1>\n";
    $html .= "         <table cellpadding=\"15\" cellspacing=\"5\">\n";
    $html .= "         <tr>\n";
    $html .= "             <th width = 31%>Email: </th>\n";
    $html .= "             <td width = 25%>";
    $html .= $email;
    $html .= "             </td>\n";
    if ($imagepath) {
        $html .= "             <td><td rowspan =\"3\">";
        $html .= "                 <br><img src=\"$imagepath\" style=\"max-width:100%; max-height:100%;\">";
        $html .= "             </td>\n";
    }
    $html .= "         </tr>\n";
    $html .= "         <tr>\n";
    $html .= "            <th>Date & Time Of Account Creation :</th>\n";
    $html .= "             <td>";
    $html .= $check1;
    $html .= "             </td>\n";
    if ($imagepath)
        $html .= "             <th width = 15%>Profile Pic: </th>\n";
    $html .= "         </tr>\n";
//    $html .= "         <tr>\n";
//    $html .= "            <th>Last login :</th>\n";
//    $html .= "             <td>";
//    $html .= $_COOKIE["lastloginday"];
//    $html .= "             </td>\n";
//    if ($imagepath)
//        $html .= "             <td></td>";
//    $html .= "         </tr>\n";
    $html .= "         </table>\n";
    return $html;
}

function getHistory()
{
    $html = "";
    include 'config.php';
    $html .= "<h1> Your History : </h1>";
    $html .= "<table id=\"t01\" border=1 >"; // start a table tag in the HTML
    $html .= "<tr>
        <th></th>
		<th>Cipher Used</th>
        <th>Plain Text</th>

        <th>Encrypted Text</th>
        <th>Date & Time</th>
        </tr>";
    if (isset($_SESSION['userEmail'])) {
        $uemail = $_SESSION['userEmail'];
        $html .= "<form action = \"\" method=post>";
        $query = mysqli_query($con, "SELECT * FROM userhistory WHERE email = '$uemail';");
        while ($row = mysqli_fetch_array($query)) {   //Creates a loop to loop through results
            $html .= "
				<tr>
                    <td><input type=\"checkbox\" name=\"selectedCipher[]\" value=\"" . $row['id'] . "\"	></td>
                    <td>" . $row['cipher'] . "</td>
                    <td>" . $row['userstring'] . "</td>

                    <td>" . $row['encryptedtext'] . "</td>
                    <td>" . $row['datetime'] . "</td>
                </tr>";
        }
    }
    $html .= "</table>"; //Close the table in HTML
    $html .= "<input type=submit value=\"Delete Selected Records\"  name=submitDeleteRecord	>";
    $html .= "</form>";
    return $html;
}

function deactivate()
{
    $html = "";
    if (isset($_SESSION['userEmail'])) {
        $uemail = $_SESSION['userEmail'];
        $html .= "<form action = \"\" method=post>";
        $html .= "<input type=submit value=\"Delete Account\"  name=deactivateAccount>";
        $html .= "</form>";
    }
    return $html;
}

function confirmDeactivate()
{
    if (isset($_POST['deactivateAccount'])) {
        $html = "";
        $html .= "<blockquote>";
        $html .= "<h4> This will delete all your records with us, including history.</h4>";
        $html .= "<h4> Are you Sure, You want to permanently Delete Account?</h4>";
        $html .= "</blockquote>";
        $html .= "<form action = \"\" method=post>";
        $html .= "<input type=submit value=\"Yes\"  name=yesDeactivateAccount> &nbsp; &nbsp;";
        $html .= "<input type=submit value=\"Cancel\"  name=cancelDeactivateAccount>";
        $html .= "</form>";
        return $html;
    }
}

?>