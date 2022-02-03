<?php
  /*Import PHPMailer classes into the global namespace
                   // These must be at the top of your script, not inside a function
                    use PHPMailer\PHPMailer\PHPMailer;
                    use PHPMailer\PHPMailer\SMTP;
                    use PHPMailer\PHPMailer\Exception;*/
 session_start(); ?>
<html>
<head>
    <title>ONLINE EXAMINATION SYSTEM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<style>
    @media screen and (max-width: 620px) {
        input {
            height: 6vw !important;
        }

        .seluser {
            display: grid;
        }

        .sub {
            width: 20vw !important;
        }
    }

    .inp {
        width: 30vw;
        height: 3vw;
        border-radius: 10px;
        border: 2px solid black;
        padding-left: 2vw;
        font-weight: bolder;
        outline: none;
    }

    ::placeholder {
        font-weight: bold;
        font-family: 'Courier New', Courier, monospace;
    }

    label {
        font-weight: bolder;
    }

    button:hover {
        background-color:#fff !important;
    }

    .bg {
        background-size: 100%;
    }

    .login {
        width: 40vw;
        background-color:#fff;
        padding: 2vw;
        font-weight: bolder;
        margin-top: 6vh;
        border-radius: 10px;
        display: block;
    }
</style>

<?php global $message;?>
<body style="margin:0;height: 100%;outline: none;color: #042A38 !important;">
    <div class="bg" style="font-weight: bolder;background-image: url(./images/rakesh.png);background-repeat: no-repeat;padding: 0;margin: 0;background-size: cover;font-family: 'Courier New', Courier, monospace;opacity: 0.9;height: auto;padding-bottom: 5vw;">
        <center>
            <h1 style=" color:#042A38;text-transform: uppercase;width: auto;background:#fff;padding: 1vw;">ONLINE
                Examination System</h1>
        </center>
        <center>
            <div class="login">
                <div id="getcode" style="display: initial">
                    <form method="POST">
                        <h1>Reset the Password</h1>
                        <div class="seluser">
                            <input type="radio" name="usertype" value="student" required>STUDENT
                            <input type="radio" name="usertype" value="staff" required>STAFF
                        </div><br><br>
                        <input name="code" id="usercode1" value="" style="display:none;">
                        <div class="signin">
                            <label for="email1" style="text-transform: uppercase;">Email</label><br><br>
                            <input type="email" name="email1" placeholder=" Email" class="inp" required>
                            <br><br>
                            <label for="pass1" style="text-transform: uppercase;">Password</label><br><br>
                            <input type="password" name="pass1" placeholder="******" class="inp" required>
                            <br><br>
                            <label for="cpass1" style="text-transform: uppercase;">Confirm Password</label><br><br>
                            <input type="password" name="cpass1" placeholder="******" class="inp" required>
                            <br><br>
                            <input name="submit" class="sub" type="submit" value="Get the Code" style="height: 3vw;width: 10vw;font-family: 'Courier New', Courier, monospace;font-weight: bolder;border-radius: 10px;border: 2px solid black;background-color: lightblue;">
                    </form><br><br>
                </div>
                <a href="signup.php">SIGN UP</a> &nbsp;&nbsp; <a href="index.php">Cancel</a>

            </div>
    </div>
    </center>
    </div>
    <?php require("footer.php");?>

</body>
<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['email1']) && isset($_POST['pass1']) && isset($_POST['cpass1'])) {
        require_once 'sql.php';
        $conn = mysqli_connect($host, $user, $ps, $project);
        if (!$conn) {
            echo "<script>alert(\"Database error retry after some time !\")</script>";
        }
        $type = mysqli_real_escape_string($conn, $_POST['usertype']);
        $username = mysqli_real_escape_string($conn, $_POST['email1']);
        $password = mysqli_real_escape_string($conn, $_POST['pass1']);
        $password = crypt($password, 'rakeshmariyaplarrakesh');
        $cpassword = mysqli_real_escape_string($conn, $_POST['cpass1']);
        $cpassword = crypt($cpassword, 'rakeshmariyaplarrakesh');
        if ($password === $cpassword) {
            $sql = "select * from " . $type . " where mail='{$username}'";
            $res =   mysqli_query($conn, $sql);
            if ($res == true) {
                global $dbmail, $dbpw;
                while ($row = mysqli_fetch_array($res)) {
                    $dbmail = $row['mail'];
                    $dbname = $row['name'];

                }
                if ($dbmail === $username) {
                    $otp = mt_rand(100000, 999999);
                    require 'PHPMailer/PHPMailerAutoload.php';
                    $mail = new PHPMailer;
                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = $_ENV["gmail"];
                    $mail->Password = $_ENV["ps"];                        // SMTP password
                    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 465;                                    // TCP port to connect to
                    $mail->setFrom('osesvit2021@gmail.com');
                    $mail->addAddress($dbmail);
                    $mail->addReplyTo('osesvit2021@gmail.com');
                    $mail->isHTML(true);
                    $mail->Subject = 'Reset your Online Examination system password';
                    $mail->Body = '<center><div style="width:100%;background-color:#042A38;color: #fff;height:auto; "><h1>Hello ' . $dbname . '<br></h1><br>here is your security code to reset the password <h1>' . $otp . '</h1><br>  don\'t share security code with any one. <br><br><br>Thank You<br>Online Examination System<br><br><a href="mailto:osesvit2021@gmail.com">Contact Us</a></div></center>';
                    if (!$mail->send()) {
                        echo "<script>alert("+$mail->ErrorInfo+"<)</script>";
                    } else {
                       $_SESSION["otp"]=$otp;
                        $_SESSION["username"]=$dbmail;
                        $_SESSION["pw"]=$password;
                        $_SESSION["type"]=$type;
                        header("location: updatepw.php");
                    }
                } else {
                    echo "<script>alert('not a user ,Please Sign up');</script>";
                }
            }
        } else {
            echo "<script>alert('Both password should be same');</script>";
        }
    }
}
?>
</html>
