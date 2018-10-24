<?php include'header.php'; ?>
<!-- Main -->
        <header class="major">
            <h2>Ciphers & Algorithms</h2>
            <p><?php echo $_POST["cipherName"] ?></p>
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
                    <section>
                        <?php 
							date_default_timezone_set("Asia/Kolkata");
							if($_POST["cipherName"]=='CAESAR CIPHER'){
								if($_POST["caesarKey"])
								{
									if($_FILES["CipherFile"]["name"])
									{
										if(isset($_SESSION['userEmail'])){
											$uemail=$_SESSION['userEmail'];
											$target_dir = "CipherPlainUploads/";
											$time = date("Y-m-d-His");
											$target_file = $target_dir . "$uemail-".$time."-". basename($_FILES["CipherFile"]["name"]);
										}
									}
									else
									{
										echo "<h3>Encrypted Text : &nbsp</h3>";
										echo "<blockquote><b>".caesar($_POST["caesarPlaintext"],$_POST["caesarKey"])."</b></blockquote>";
									}
								}
								else
									echo "Please Enter Key for Caesar Cipher";
							}
						?>
                    </section>
                </div>
            </div>
        </div>      
<?php include'footer.php'; ?>