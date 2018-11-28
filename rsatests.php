<?php
// use PHPUnit\Framework\TestCase\TestCaseTest;
// use PHPUnit\Runner\BaseTestRunner;

 
include 'cipherLibrary.php';

 class rsaTest extends PHPUnit_Framework_TestCase
{
      
    public function test_rsaEncryption()
    {  
       $res= rsa('text','somekey');
      

       $this->assertTrue(is_array($res));
    }

    public function test_rsaformatedkeyTrue()
    {      

        $pk ='-----BEGIN PUBLIC KEY----- MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCogtWSQ5NMGrfH5eChXrltMB8R Ldqbt/qWjHw6bTmn1jfArCm0MXVIT3P8HOrw1DU7Vg37f2YwmxSz+0KeAY6TbCH2 y4PdYCv6MPsqw06xKHQw0tSn0qx2d63mjv1qS0m6ySBgZtUUzGvCKYnPsil7bfgb ktNt6xkmMgKGM//A5QIDAQAB -----END PUBLIC KEY----';

        $key = get_rsaKeyFormated($pk);

        $actualkey = 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCogtWSQ5NMGrfH5eChXrltMB8R Ldqbt/qWjHw6bTmn1jfArCm0MXVIT3P8HOrw1DU7Vg37f2YwmxSz+0KeAY6TbCH2 y4PdYCv6MPsqw06xKHQw0tSn0qx2d63mjv1qS0m6ySBgZtUUzGvCKYnPsil7bfgb ktNt6xkmMgKGM//A5QIDAQAB';

        $this->assertSame($actualkey, $key);
    }
    
    public function test_rsaDecryption()
    {
        //ciphertext for terrafrost
        $ciphertext='1d5b11b1f1f718d2d6d195ce34805687fe9ea9d6c7eca798f278e2e7a1852d1815496feb20150d09330cb19ea919e9d07da47a10e15a210337f8b7868469a434ad0d52e20b0d58e5338a818eca4322cb80a8f6064b11019f6accfd5c6b87b1a8a1c4d4715f9190cbddf2b4698d3318b83a85711ecbc5dec431eb482e5bbab659';
        $key = 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCogtWSQ5NMGrfH5eChXrltMB8R Ldqbt/qWjHw6bTmn1jfArCm0MXVIT3P8HOrw1DU7Vg37f2YwmxSz+0KeAY6TbCH2 y4PdYCv6MPsqw06xKHQw0tSn0qx2d63mjv1qS0m6ySBgZtUUzGvCKYnPsil7bfgb ktNt6xkmMgKGM//A5QIDAQAB';
 
        $result = rsa_decrypt($ciphertext,$key);

        $this->assertSame($result, 'terrafrost');
    }

    public function test_rsaDecryption_incorrectkey()
    {
        //ciphertext for terrafrost
        $ciphertext='1d5b11b1f1f718d2d6d195ce34805687fe9ea9d6c7eca798f278e2e7a1852d1815496feb20150d09330cb19ea919e9d07da47a10e15a210337f8b7868469a434ad0d52e20b0d58e5338a818eca4322cb80a8f6064b11019f6accfd5c6b87b1a8a1c4d4715f9190cbddf2b4698d3318b83a85711ecbc5dec431eb482e5bbab659';
        $key = 'M__IGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCogtWSQ5NMGrfH5eChXrltMB8R Ldqbt/qWjHw6bTmn1jfArCm0MXVIT3P8HOrw1DU7Vg37f2YwmxSz+0KeAY6TbCH2 y4PdYCv6MPsqw06xKHQw0tSn0qx2d63mjv1qS0m6ySBgZtUUzGvCKYnPsil7bfgb ktNt6xkmMgKGM//A5QIDAQAB';
 
        $result = rsa_decrypt($ciphertext,$key);

        $this->assertFalse($result);
    }

}