<?php
/**
 * Created by PhpStorm.
 * User: sPriyal
 * Date: 10/30/18
 * Time: 12:00 AM
 */




$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "oc";

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}


// prepare and bind
$stmt = $con->prepare("INSERT INTO userhistory(email, cipher, userstring, datetime, cipherkey, encryptedtext)  VALUES (?, ?, ?, NOW(), ?, ?)");
$stmt->bind_param("sssss", $email, $lastname, $firstname, $firstname, $lastname);

// set parameters and execute
$firstname = "John";
$lastname = "Doe";
$email = "john@example.com";
$stmt->execute();
$stmt->close();




//$stmt = $con->prepare(
//    "INSERT INTO userhistory('id','email', 'cipher', 'userstring','cipherkey','datetime','encryptedtext')
//     VALUES(        '',
//                    'A',
//                    'B',
//                    'C',
//                    'D',
//                    'E',
//                    NOW(),
//                    'F'
//                    )");
////$stmt->bind_param("ssssss", '', $uemail, 'Caesar Cipher', $str, $n, $ret);
//$stmt->execute();
//$stmt->close();
