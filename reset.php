<?php session_start(); ?>
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
<body style="margin:0;height: 100%;outline: none;color: #7e7e7e !important;">
    <div class="bg" style="font-weight: bolder;background-image: url(./images/rakesh.png);background-repeat: no-repeat;padding: 0;margin: 0;background-size: cover;font-family: 'Courier New', Courier, monospace;opacity: 0.9;height: auto;padding-bottom: 5vw;">
        <center>
            <h1 style=" color:#7e7e7e;text-transform: uppercase;width: auto;background:#fff;padding: 1vw;">ONLINE
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
                            <label for="cpass1" style="text-transform: uppercase;">Password</label><br><br>
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
</body>
<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['email1']) && isset($_POST['pass1']) && isset($_POST['cpass1'])) {
        $conn = mysqli_connect('localhost', 'root', '', 'project');
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

                    require 'PHPmailer/PHPMailerAutoload.php';
                    $mail = new PHPMailer;
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->Port = 587;
                    $mail->SMTPAuth = true;
                    $mail->SMTPSecure = 'tls';
                    $mail->Username = 'osesvit2021@gmail.com';
                    $mail->Password = 'OSE2021SVIT';
                    $mail->setFrom('osesvit2021@gmail.com');
                    $mail->addAddress($dbmail);
                    $mail->addReplyTo('osesvit2021@gmail.com');
                    $mail->isHTML(true);
                    $mail->Subject = 'Reset your Online Examination system password';


                    $mail->Body = 'hello ' . $dbname . '<br>here is your security code reset the password ' . $otp . '<br>';


                    if (!$mail->send()) {
                        echo "<script>myfun()</script>";
                        echo $mail->ErrorInfo;
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