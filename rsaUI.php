<?php include'header.php'; ?>
    <!-- Main -->
    <header class="major">
        <h2>Ciphers & Algorithms</h2>
        <p>RSA</p>
    </header>
    <div class="container">
        <div class="row">
            <div class="4u">
                <section>
                    <h3>Ciphers</h3>
                    <ul class="alt">
                        <?php echo getCipherList(); ?>
                    </ul>
                </section>
            </div>
            <div class="8u skel-cell-important">

                <h2>Encryption</h2>
                <section>
                    <form action="results.php" method="post" enctype="multipart/form-data">
                        <textarea name="rsaPlaintext" placeholder="Enter the plaintext here to encrypt it" value=""></textarea>
                        <?php
                        if(isset($_SESSION['userEmail'])){
                            echo "<b>OR &nbsp</b><input type=\"file\" name=\"CipherFile\" value=\"Upload File\"
								data-validation=\"mime size\" data-validation-allowing=\"txt\" data-validation-max-size=\"1024kb\"><b>(Supports only 'txt' File!)";
                        }
                        else
                            echo "<b> Sign in <a href =\"dashboard.php\">here</a> to encrypt File-content</b>"
                        ?>
                        <br><br>
                        <input type="text" name="rsaKey" placeholder="Enter key" value="RSA would generate a public key for you">
                        <br>
                        <input type="hidden" name="cipherName" value="rsa">
                        <input type=submit>
                        <input type=reset>
                    </form>
                </section>


                <h2>Decryption</h2>
                <section>
                    <form action="decryptresults.php" method="post" enctype="multipart/form-data">
                        <textarea name="rsaEncryptedtext" placeholder="Enter the encrypted text here to decrypt it" value=""></textarea>
                        <?php
                        if(isset($_SESSION['userEmail'])){
                            echo "<b>OR &nbsp</b><input type=\"file\" name=\"CipherFile\" value=\"Upload File\"
								data-validation=\"mime size\" data-validation-allowing=\"txt\" data-validation-max-size=\"1024kb\"><b>(Supports only 'txt' File!)";
                        }
                        else
                            echo "<b> Sign in <a href =\"dashboard.php\">here</a> to encrypt File-content</b>"
                        ?>
                        <br><br>
                        <input type="text" name="rsaKey" placeholder="Enter key" >
                        <br>
                        <input type="hidden" name="cipherName" value="rsa">
                        <input type=submit>
                        <input type=reset>
                    </form>
                </section>

            </div>


        </div>
    </div>
<?php include'footer.php'; ?>