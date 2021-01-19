<html>
<?php session_start();
$sysotp= $_SESSION["otp"];
$dbmail=$_SESSION["username"];
$password= $_SESSION["pw"];
$type= $_SESSION["type"]; ?>
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
        background-color: #042A38 !important;
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
<body style="margin:0;height: 100%;outline: none;">
    <div class="bg" style="font-weight: bolder;background-image: url(./images/rakesh.png);background-repeat: no-repeat;padding: 0;margin: 0;background-size: cover;font-family: 'Courier New', Courier, monospace;opacity: 0.9;height: auto;padding-bottom: 5vw;">
        <center>
            <h1 style=" color:#042A38;text-transform: uppercase;width: auto;background:#fff;padding: 1vw;">ONLINE
                Examination System</h1>
        </center>
        <center>
            <div class="login">
                <div id="subcode">
                    <form method="post">
                        <label for="otp" style="text-transform: uppercase;">Enter the Code</label><br><br>
                        <input type="number" name="otp1" placeholder=" code" class="inp" required><br><br>
                        <input name="submit1" class="sub" type="submit" value="Reset" style="height: 3vw;width: 10vw;font-family: 'Courier New', Courier, monospace;font-weight: bolder;border-radius: 10px;border: 2px solid black;background-color: rgb(77, 77, 236);">
                        <br><br>
                    </form>
                </div>
                <a href="reset.php">CANCEL</a>

            </div>
    </div>
    </center>
    </div>
    <?php require("footer.php");?>

</body>
<?php
if (isset($_POST['submit1'])) {
    require_once 'sql.php';
    $conn = mysqli_connect($host, $user, $ps, $project);        if (!$conn) {
            echo "<script>alert(\"Database error retry after some time !\")</script>";
        }else{
        if (isset($_POST['submit1'])) {
                            $usercode1 = $_POST['otp1'];
                            if ($usercode1 == $sysotp) {
                                $sql1 = "update " . $type . " set pw='{$password}' where mail='{$dbmail}'";
                                if (mysqli_query($conn, $sql1)) {
                                    session_unset();
                                    session_destroy();
                                    header("location:index.php");
                                    
                                } elseif (!mysqli_query($conn, $sql1)) {
                                    echo "<script>alert('Security code error')</script>";
                                }
                            }else{
                                echo "<script>alert('security code does't match')</script>";
                            }
                        } else {
                            echo "<script>alert('Please enter the Code')</script>";

                        }
                    }
}
?>
</html>