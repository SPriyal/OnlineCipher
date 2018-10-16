<?php
session_start();
if (isset($_SESSION['userEmail'])) {
    $_SESSION['userEmail'] = NULL;
    $_SESSION['SuccessfullLogin'] = false;
    session_destroy();
}
header("Location: index.php");
?>
