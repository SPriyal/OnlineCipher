<?php include 'header.php'; ?>
<?php include_once 'config.php'; ?>
<?php


if (($_SERVER['REQUEST_METHOD'] === 'POST')) {
    $userName = htmlspecialchars($_POST["userName"]);
    $userPassword = $_POST["pass_confirmation"];
    $target_dir = "uploads/";
    $userEmail = $_POST["userEmailid"];
    $target_file = $target_dir . "$userEmail-" . basename($_FILES["fileToUpload"]["name"]);

    $qry = mysqli_query($con, "SELECT email FROM userinfo WHERE email = '$userEmail';");
    $check = mysqli_fetch_assoc($qry);


    if (!($userEmail == $check["email"])) {
        //passing the current date and time as a hidden parameter
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $stmt = $con->prepare(
                "
                    INSERT INTO userinfo(
                    name,
                    email, 
                    password,
                    datecreated,
                    profilepic
                    ) 
					VALUES (
					?,
					?,
					?,
					NOW(),
					?)"
            );
            $stmt->bind_param("ssss", $userName, $userEmail, $userPassword,$target_file);
            $stmt->execute();
            $stmt->close();


        } else {
            $stmt = $con->prepare(
                "
                    INSERT INTO userinfo(
                    name, 
                    email, 
                    password,
                    datecreated
                    )
                    VALUES 
                    ( 
                    ?,
                    ?,
                    ?,
                    NOW()
                    )");
                    $stmt->bind_param("sss", $userName, $userEmail, password_hash($userPassword, PASSWORD_DEFAULT));
                    $stmt->execute();
                    $stmt->close();

        }
        $_SESSION['userEmail'] = $userEmail;
        $_SESSION['SuccessfullLogin'] = true;
        setcookie("lastloginday", date("Y-m-d"), time() + (86400 * 30), "/");
        echo "<script type=\"text/javascript\">location.href = 'dashboard.php';</script>";
        exit();


//        header("Location: dashboard.php");
    } else {
        header("Location:email.php");
    }
}

?>
    <form action="" method="post" enctype="multipart/form-data" style="padding : 0em 5em 0em 5em;">
        <p>
            <b>Name</b>
            <input type=text name="userName" placeholder="3-12 characters" data-validation="length alphanumeric"
                   data-validation-length="3-12"
                   data-validation-error-msg="The name has to be an alphanumeric value between 3-12 characters">
        </p>
        <p>
            <b>Email-id</b>
            <input type=text name="userEmailid" placeholder="hello@example.com" data-validation="email">
        </p>
        <p>
            <b>Password</b>
            <input type="password" name="pass_confirmation" placeholder="atleast 8 alpha-numeric characters"
                   data-validation="strength" data-validation-strength="2" data-validation-length="min8">
        </p>
        <p>
            <b>Retype-Password</b>
            <input type="password" name="pass" placeholder="Same as password" data-validation="confirmation">
        </p>
        <p>
            <b>Profile Picture</b>
            <input type="file" name="fileToUpload" placeholder="Upload Image"
                   data-validation="mime size" data-validation-allowing="jpg, png" data-validation-max-size="1024kb">
        </p>
        <input type="submit" value="Submit" name="submit"> &nbsp
        <input type=reset>
    </form>
    <script type="text/javascript"> $.validate({
            modules: 'security,file', onModulesLoaded: function () {
                var optionalConfig = {
                    fontSize: '12pt',
                    padding: '4px',
                    bad: 'Weak Password :( ',
                    weak: 'Weak Password :( ',
                    good: 'Good Password :) ',
                    strong: 'Strong Password :D '
                };

                $('input[name="pass_confirmation"]').displayPasswordStrength(optionalConfig);
            }
        });
    </script>
<?php include 'footer.php'; ?>