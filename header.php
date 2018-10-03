<?php include_once'cipherLibrary.php'; ?>
<?php session_start(); ?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Crypto - Ciphers & Algorithms</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.dropotron.min.js"></script>
        <script src="js/skel.min.js"></script>
        <script src="js/skel-layers.min.js"></script>
        <script src="js/init.js"></script>
        <script src="sj/jquery.form-validator.js"></script>      
        <noscript>
            <link rel="stylesheet" href="css/skel.css" />
            <link rel="stylesheet" href="css/style.css" />
            <link rel="stylesheet" href="css/style-xlarge.css" />
        </noscript>
    </head>
    <body id="top">
<!-- Header -->
    <header id="header" class="skel-layers-fixed">
        <img src="./images/oc.png">
        <h1><a href="index.php">&nbsp&nbsp&nbsp&nbsp Online Crypto</a></h1>
        <nav id="nav">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="ciphers.php">Ciphers</a>
                    <ul>
                        <?php echo getCipherList(); ?>
                    </ul>
                </li>
                <?php 
                    if(isset($_SESSION['SuccessfullLogin'])) {
                        if($_SESSION['SuccessfullLogin'] === true) {
                            echo "<li>Logged in as : ".$_SESSION['userEmail']."</li>";
                            echo "<li><a href=\"dashboard.php\" class=\"button special\">Dashboard</a></li>\n";
                            echo "<li><a href=\"logout.php\" class=\"button special\">Log Out</a></li>\n";
                        }  
                    } else {
                        echo "<li><a href=\"signup.php\" class=\"button special\">Sign Up</a></li>\n"; 
                        echo "<li><a href=\"dashboard.php\" class=\"button special\">Sign In</a></li>\n";
                    }
                ?>
            </ul>
        </nav>
    </header>
    <br>
    <br>