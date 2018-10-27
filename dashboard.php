<?php include'header.php'; ?>
<?php include_once'config.php'; ?>
<?php
if(isset($_SESSION["userEmail"])){
    //echo "<!-- Dashboard ->\n"; 
    echo "        <header class=\"major\">\n"; 
    echo "            <h2>Account Dashboard</h2>\n"; 
    echo "            <p>Download the Source Code & View History</p>\n"; 
    echo "        </header>\n"; 
    echo "        <div class=\"container\">\n"; 
    echo "            <div class=\"row\">\n"; 
    echo "                <div class=\"4u\">\n"; 
    echo "                    <section>\n"; 
    echo "                        <h3>Operations</h3>\n"; 
    echo "                        <ul class=\"alt\">\n"; 
    echo "                            <li><a href=\"#userprofile\">Profile</a></li>\n";
    echo "                            <li><a href=\"#userhistory\">History</a></li>\n";
    echo "                        </ul>\n"; 
    echo "                    </section>\n"; 
    echo "                </div>\n"; 
    echo "                <div class=\"8u skel-cell-important\">\n"; 
    echo "                    <section id=userprofile >\n"; 
                                        echo getProfile();
    echo "                    </section>\n"; 
	echo "                    <section id=userhistory >\n"; 
                                    echo deactivate();
									echo confirmDeactivate();
    echo "                    </section>\n"; 
    echo "                    <section id=userhistory >\n"; 
    echo "                          <br><br>";
                                    echo getHistory();
    echo "                          <br><br>";                                
    echo "                    </section>\n"; 
    echo "                </div>\n"; 
    echo "            </div>\n"; 
    echo "        </div>\n";
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