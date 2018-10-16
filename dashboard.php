<?php include'header.php'; ?>
<?php include_once'config.php'; ?>
<?php
if(isset($_SESSION["userEmail"])){
    //echo "<!-- Dashboard ->\n";
    echo "This is dashboard for sprint 2";
} else {
    if (($_SERVER['REQUEST_METHOD'] === 'POST')) {
        $userPassword = $_POST["pass_confirmation"];
        $userEmail=$_POST["userEmailid"];
        $qry = mysqli_query($con,"SELECT email,password FROM userinfo WHERE email = '$userEmail';");
        $check = mysqli_fetch_assoc($qry);
        if (($userEmail == $check['email'])
            && ($userPassword == $check['password'])
            && ($userEmail != NULL)
            && ($userPassword != NULL)) {
                $_SESSION['userEmail'] = $userEmail;
                $_SESSION['userPassword']=$userPassword;
                $_SESSION['SuccessfullLogin'] = true;
                setcookie("lastloginday", date("Y-m-d"), time() + (86400 * 30), "/");
                header("Location: dashboard.php");
        } else {
            echo "&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Invalid Email-id / Password. Try Again.<br>";
            echo getSignInForm();
        }
    } else {
        echo getSignInForm();
    }
}

function getSignInForm() 
{
        $html="";
        $html.= "<form action=\"\" method=\"post\"  enctype=\"multipart/form-data\" style=\"padding : 0em 5em 0em 5em;\">\n"; 
        $html.= "      <p>\n"; 
        $html.= "            <b>Email-id</b>\n"; 
        $html.= "            <input type=text name=\"userEmailid\" placeholder=\"hello@example.com\" data-validation=\"email\">\n"; 
        $html.= "      </p>\n"; 
        $html.= "      <p>\n"; 
        $html.= "            <b>Password</b>\n"; 
        $html.= "            <input type=\"password\" name=\"pass_confirmation\" placeholder=\"atleast 8 characters\" \n"; 
        $html.= "            data-validation=\"strength\" data-validation-strength=\"2\" data-validation-length=\"min8\">\n"; 
        $html.= "      </p>\n"; 
        $html.= "      <input type=\"submit\" value=\"Submit\" name=\"submit\"> &nbsp\n"; 
        $html.= "      <input type=reset>\n"; 
        $html.= "    </form>\n";
        $html.= "<script type=\"text/javascript\"> $.validate(); </script>\n";
        return $html;
}
?>
<?php include'footer.php'; ?>