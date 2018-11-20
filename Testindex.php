<?php
     include 'vendor/autoload.php';
     $rsa = new \phpseclib\Crypt\RSA();
     extract($rsa->createKey());
 
     $plaintext = 'terrafrost';
 
     $rsa->loadKey($privatekey);
     $ciphertext = $rsa->encrypt($plaintext);
    echo gettype($ciphertext);
    //$abc= '�ؗ�Xg0� � ���$~��^F��$ ���x�Ckc�v��n�=`MyݜY�ӶM��@;����]�?"(�I&�;�=��+��w�E�j+�r�q�$p���~O�k/�Rd�!rl4ua���+�)1';
    
     $rsa->loadKey($publickey);
     echo $rsa->decrypt($ciphertext);
  ?>