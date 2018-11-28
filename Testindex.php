<?php
     include 'vendor/autoload.php';
     $rsa = new \phpseclib\Crypt\RSA();

    //  //Encryption code:::::::::::::::::::::::::
    // $temp= extract($rsa->createKey());
    // echo $rsa->getpublickey();
 
    //  $plaintext = 'terrafrost';
    
    // $rsa->loadKey($privatekey);
    //  $ciphertext = $rsa->encrypt($plaintext);
     
     
    //  echo $rsa->getpublickey();
    // //echo gettype($ciphertext);
    // $ciphertext = bin2hex($ciphertext);
    // echo $ciphertext;


    
    // //decryption code::::::
    // //$ciphertext = '3851da06cb587f09cd747f2f9b161a64e6004c1b0c4adf0e2774efbad7c14c9d9ce4482f98831941c785874e622532ca8f23e277bc0d437fffb4bebc729a46805a41d618a1a581413e2da01b967385010e1ede8d0dd4390cbb2bd88d25161a2bdc2178c1e7627a9f725f447e6808f57e0a0aecbfdb571c814ace406cabf463d5';
    // $ciphertext= '1ce5fe55aaa5587950f170e2a8b4ee4d2b239aa3ddf45c1ebc5c5f72947439d0b9e09dac4e86876c14be0f58d2082d5f0f08a087dedfb473ed4940042d4a08b7be33c02843b015590547e95358be2bbc623c58e23ffa5f2b7e92ed2697e2d7e6e79410a945cf4c796cc1694b1ee6672cda81c1e51c9330a7bac098c626a7121d';
    // //echo gettype($ciphertext);
    // $ciphertext = hex2bin($ciphertext);
    // $rsa->loadKey($publickey);
     
    // $rsa->decrypt($ciphertext);

    $pk ='-----BEGIN PUBLIC KEY----- MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCogtWSQ5NMGrfH5eChXrltMB8R Ldqbt/qWjHw6bTmn1jfArCm0MXVIT3P8HOrw1DU7Vg37f2YwmxSz+0KeAY6TbCH2 y4PdYCv6MPsqw06xKHQw0tSn0qx2d63mjv1qS0m6ySBgZtUUzGvCKYnPsil7bfgb ktNt6xkmMgKGM//A5QIDAQAB -----END PUBLIC KEY----';

    echo gettype($pk);

    $pos1 = strlen('-----BEGIN PUBLIC KEY----- ');
    $pos2 = -strlen(' -----END PUBLIC KEY----');
    $len = strlen($pk);
    $length = abs($len -$pos1 + $pos2);

   $actualKey = substr($pk, $pos1, $length);

  $final = '-----BEGIN PUBLIC KEY----- ' . $actualKey . ' -----END PUBLIC KEY----'  ;

   if($pk===$final)
    echo 'TRUE';

  else 
    echo 'FALSE';
    //echo $between;

    //echo $final;
    // echo $rsa->setPublicKey($pk);
    // $ciphertext='1d5b11b1f1f718d2d6d195ce34805687fe9ea9d6c7eca798f278e2e7a1852d1815496feb20150d09330cb19ea919e9d07da47a10e15a210337f8b7868469a434ad0d52e20b0d58e5338a818eca4322cb80a8f6064b11019f6accfd5c6b87b1a8a1c4d4715f9190cbddf2b4698d3318b83a85711ecbc5dec431eb482e5bbab659';
    // $rsa->loadKey($pk);
    // $ciphertext = hex2bin($ciphertext);
    // echo $rsa->decrypt($ciphertext);
  ?>