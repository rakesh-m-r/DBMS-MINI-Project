<?php session_start(); ?>
<html>

<head>
    <title>Online Examination System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head><?php
if (isset($_POST['login'])) {
    if (isset($_POST['usertype']) && isset($_POST['username']) && isset($_POST['pass'])) {
        $conn = mysqli_connect('localhost', 'root', '', 'project');
        if (!$conn) {
            echo "<script>alert(\"Database error retry after some time !\")</script>";
        }
        $type = mysqli_real_escape_string($conn, $_POST['usertype']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['pass']);
        $password = crypt($password, 'rakeshmariyaplarrakesh');
        $sql = "select * from " . $type . " where mail='{$username}'";
        $res =   mysqli_query($conn, $sql);
        if ($res == true) {
            global $dbmail, $dbpw;
            while ($row = mysqli_fetch_array($res)) {
                $dbpw = $row['pw'];
                $dbmail = $row['mail'];
                $_SESSION["name"] = $row['name'];
                $_SESSION["type"]=$type;
                $_SESSION["username"]=$dbmail;
            }
            if ($dbpw === $password) {
                if($type==='student'){
                    header("location:homestud.php");
                }elseif($type==='staff'){
                    header("Location: homestaff.php");
                }
            } elseif ($dbpw !== $password && $dbmail === $username) {
                echo "<script>alert('password is wrong');</script>";
            } elseif ($dbpw !== $password && $dbmail !== $username) {
                echo "<script>alert('username name not found sing up');</script>";
            }
        }
    }
}
?>
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
        background-color: rgba(26, 201, 134, 0.801) !important;
    }

    .bg {
        background-size: 100%;
    }
</style>

<body style="margin:0;height: 100%;ouline:none;">
    <div class="bg" style="font-weight: bolder;background-image: url(./images/rakesh.png);background-repeat: no-repeat;padding: 0;margin: 0;background-size: cover;font-family: 'Courier New', Courier, monospace;opacity: 0.9;height: 100%;">
        <center>
            <h1 style=" color:white;text-transform: uppercase;width: auto;background:rgba(26, 201, 134, 0.801);padding: 1vw;">ONLINE
                Examination System</h1>
        </center>
        <center>
            <div class="login" style="width: 40vw;background-color: rgba(26, 201, 134, 0.801);padding: 2vw;font-weight: bolder;margin-top: 20vh;border-radius: 10px;">
                <form method="POST">
                    <div class="seluser">
                        <input type="radio" name="usertype" value="student" required>STUDENT
                        <input type="radio" name="usertype" value="staff" required>STAFF
                    </div><br><br>
                    <div class="signin">

                        <label for="username" style="text-transform: uppercase;">Username</label><br><br>
                        <input type="email" name="username" placeholder=" Email" class="inp" required>
                        <br><br>
                        <label for="password" style="text-transform: uppercase;">Password</label><br><br>
                        <input type="password" name="pass" placeholder="******" class="inp" required>
                        <br><br>
                        <input name="login" class="sub" type="submit" value="Login" style="height: 3vw;width: 10vw;font-family: 'Courier New', Courier, monospace;font-weight: bolder;border-radius: 10px;border: 2px solid black;background-color: rgb(77, 77, 236);"><br>

                </form><br>
                <a href="reset.php">Forgot password?</a> &nbsp; New user! <a href="signup.php">SIGN UP</a>
            </div>
    </div>
    </center>
    </div>
</body>

</html>