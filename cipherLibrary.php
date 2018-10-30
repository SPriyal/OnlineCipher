<?php


function getCipherList()
{
    $html = "";
    $html .= "<li><a href=\"caesarcipher.php\">Caesar Cipher</a></li>";
    $html .= "<li><a href=\"vigenerecipher.php\">Vigenere Cipher (PolyAlphabetic)</a></li>";
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
    $html .= "         <tr>\n";
    $html .= "            <th>Last login :</th>\n";
    $html .= "             <td>";
    $html .= $_COOKIE["lastloginday"];
    $html .= "             </td>\n";
    if ($imagepath)
        $html .= "             <td></td>";
    $html .= "         </tr>\n";
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
        <th>Cipher Key</th>
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
                    <td>" . $row['cipherkey'] . "</td>
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