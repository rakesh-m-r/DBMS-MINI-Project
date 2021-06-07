<html>

<head>
    <title>Online Examination System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<?php

if (isset($_POST['studsu'])) {
    session_start();
    if (isset($_POST['name1']) && isset($_POST['usn1']) && isset($_POST['mail1']) && isset($_POST['phno1']) && isset($_POST['dept1']) && isset($_POST['dob1']) && isset($_POST['gender1']) && isset($_POST['password1']) && isset($_POST['cpassword1'])) {
        require_once 'sql.php';
        $conn = mysqli_connect($host, $user, $ps, $project);       if (!$conn) {
            echo "<script>alert(\"Database error retry after some time !\")</script>";
        }
        $name1 = mysqli_real_escape_string($conn, $_POST['name1']);
        $usn1 = mysqli_real_escape_string($conn, $_POST['usn1']);
        $mail1 = mysqli_real_escape_string($conn, $_POST['mail1']);
        $phno1 = mysqli_real_escape_string($conn, $_POST['phno1']);
        $dept1 = mysqli_real_escape_string($conn, $_POST['dept1']);
        $dob1 = mysqli_real_escape_string($conn, $_POST['dob1']);
        $gender1 = mysqli_real_escape_string($conn, $_POST['gender1']);
        $password1 = mysqli_real_escape_string($conn, $_POST['password1']);
        $cpassword1 = mysqli_real_escape_string($conn, $_POST['cpassword1']);
        $password1 = crypt($password1,'rakeshmariyaplarrakesh');
        $cpassword1 = crypt($cpassword1,'rakeshmariyaplarrakesh');
        if ($password1 == $cpassword1) {
            $sql = "insert into student (usn,name,mail,phno,dept,gender,DOB,pw) values('$usn1','$name1','$mail1','$phno1','$dept1','$gender1','$dob1','$password1')";
            if (mysqli_query($conn, $sql)) {
                echo "<script>
                alert('successful!');
                window.location.replace(\"index.php\");</script>";
                session_destroy();
            } else {
                echo "<script>
                alert('Data enter by you alreay exist in Database please Sign In');
                window.location.replace(\"index.php\");</script>";
                session_destroy();
            }
        } else {
            echo "<script>
                alert(' Password should be same');
                window.location.replace(\"singup.php\");</script>";
            session_destroy();
        }
    }
}

if (isset($_POST['staffsu'])) {
    session_start();
    if (isset($_POST['name2']) && isset($_POST['staffid']) && isset($_POST['mail2']) && isset($_POST['phno2']) && isset($_POST['dept2']) && isset($_POST['dob2']) && isset($_POST['gender2']) && isset($_POST['password2']) && isset($_POST['cpassword2'])) {
require 'sql.php';
        $conn = mysqli_connect($host, $user, $ps, $project);        if (!$conn) {
            echo "<script>alert(\"Database error retry after some time !\")</script>";
        }
        $name2 = mysqli_real_escape_string($conn, $_POST['name2']);
        $usn2 = mysqli_real_escape_string($conn, $_POST['staffid']);
        $mail2 = mysqli_real_escape_string($conn, $_POST['mail2']);
        $phno2 = mysqli_real_escape_string($conn, $_POST['phno2']);
        $dept2 = mysqli_real_escape_string($conn, $_POST['dept2']);
        $dob2 = mysqli_real_escape_string($conn, $_POST['dob2']);
        $gender2 = mysqli_real_escape_string($conn, $_POST['gender2']);
        $password2 = mysqli_real_escape_string($conn, $_POST['password2']);
        $cpassword2 = mysqli_real_escape_string($conn, $_POST['cpassword2']);
        $password2 = crypt($password2,'rakeshmariyaplarrakesh');
        $cpassword2 = crypt( $cpassword2,'rakeshmariyaplarrakesh');
        if ($password2 == $cpassword2) {
            $sql = "insert into staff (staffid,name,mail,phno,dept,gender,DOB,pw) values('$usn2','$name2','$mail2','$phno2','$dept2','$gender2','$dob2','$password2')";
            if (mysqli_query($conn, $sql)) {
                echo "<script>
                alert('successful!');
                window.location.replace(\"index.php\");</script>";
                session_destroy();
            } else {
                echo "<script>
                alert('Data enter by you alreay exist in Database please Sign In');
                window.location.replace(\"index.php\");</script>";
                session_destroy();
            }
        } else {
            echo "<script>
                alert(' Password should be same');
                window.location.replace(\"signup.php\");</script>";
            session_destroy();
        }
    }
}
?>
<style>
    button {
        height: 4vw;
        width: 40vw;
        margin: 0px;
        font-family: 'Courier New', Courier, monospace;
        font-weight: bolder;
        outline: none;
        background-color: lightblue;
        border: none;
    }

    button:active {
        background-color: lightblue;
        color: #fff;
    }

    button:focus {
        background-color: #042A38;
        color: #fff;
    }

    .stud,
    .staff {
        display: none;
    }

    label {
        float: left;
        margin-left: 25vw;
        font-weight: bolder;
    }

    input,
    .selc {
        width: 30vw !important;
        outline: none;
        height: 3vw;
        border: 2px solid black;
        border-radius: 10px;
        padding: 1vw;
    }

    .gen {
        width: 2vw !important;
    }

    form>button {
        width: 20vw;
        height: 2vw;
    }
    a{
        color: #042A38;
        margin: 2vw;
    }
    .su {
        width: 10vw !important;
        background-color: #fff;
        margin-bottom: 1vw;
    }

    .formname {
        text-shadow: 2px 0px black;
    }

    @media screen and (max-width: 620px) {

        input,
        .selc {
            height: 5vw !important;
        }
    }
</style>

<body style="margin: 0;padding: 0;outline: none;height: 100%;min-height: 100%;color: #042A38 !important">
    <div style="font-family: 'Courier New', Courier, monospace;margin: 0;padding: 0;background-color: #fff;height: 100%;width: 100%;padding-bottom: 5vw;background-image: url(images/rakesh.png);height: auto !important;background-repeat: no-repeat;background-size:cover;">
        <center>
            <h1 style="text-transform: uppercase;padding: 2vw;background-color: #fff;color: #042A38;margin-top:0;">ONLINE
                Examination System</h1>
        </center>
        <div class="seluser">
            <center> <button onclick="stud()">STUDENT</button><button onclick="staff()">STAFF</button></center>
        </div>
        <div class="stud" id="stud">
            <center>

                <form name="student" method="POST" style="width: 80vw;background-color:#fff;"><br>
                    <h1 class="formname">Sign-Up as Student</h1><br><br>
                    <label for="name1">NAME</label><br>
                    <input type="text" name="name1" required><br><br>
                    <label for="usn">USN</label><br>
                    <input type="text" name="usn1" required><br><Br>
                    <label for="mail1">Email</label><br>
                    <input type="email" name="mail1" required><br><Br>
                    <label for="phno1">Ph No.</label><br>
                    <input type="tel" name="phno1" required><br><Br>
                    <label for="dept1">Department</label><br>
                    <select name="dept1" class="selc" required>
                        <option value="CSE">CSE</option>
                        <option value="ISE">ISE</option>
                        <option value="ECE">ECE</option>
                        <option value="EEE">EEE</option>
                    </select><br><br>
                    <label for="dob1">DOB</label><br>
                    <input type="date" name="dob1" required><br><Br>
                    <label for="gender1">Gender</label><br>
                    <input type="radio" name="gender1" value="M" class="gen" required style="height: 1vw !important;">MALE
                    <input type="radio" name="gender1" value="F" class="gen" required style="height: 1vw !important;">FEMALE<br><Br>
                    <label for="password1">Password</label><br>
                    <input type="password" name="password1" required><br><Br>
                    <label for="cpassword1">Confirm Password</label><br>
                    <input type="password" name="cpassword1" required><br><Br>
                    <input type="submit" class="su" name="studsu" value="Sign-Up as Student">
                </form>

            </center>
        </div>
        <div class="staff" id="staff">
            <center>

                <form name="staffSIGNUP" method="POST" style="width: 80vw;background-color:#fff;"><br>

                    <h1 class="formname">Sign-Up as Staff</h1><br><br><label for="name">NAME</label><br>
                    <input type="text" name="name2" required><br><br>
                    <label for="staffid">Staff Id</label><br>
                    <input type="text" name="staffid" required><br><Br>
                    <label for="mail2">Email</label><br>
                    <input type="email" name="mail2" required><br><Br>
                    <label for="phno2">Ph No.</label><br>
                    <input type="tel" name="phno2" required><br><Br>
                    <label for="dept2">Department</label><br>
                    <select name="dept2" class="selc" required>
                        <option value="CSE">CSE</option>
                        <option value="ISE">ISE</option>
                        <option value="ECE">ECE</option>
                        <option value="EEE">EEE</option>
                    </select><br><br> <label for="dob2">DOB</label><br>
                    <input type="date" name="dob2" required><br><Br>
                    <label for="gender2">Gender</label><br>
                    <input type="radio" name="gender2" value="M" class="gen" required style="height: 1vw !important;">MALE
                    <input type="radio" name="gender2" value="F" class="gen" required style="height: 1vw !important;">FEMALE<br><Br>
                    <label for="password2">Password</label><br>
                    <input type="password" name="password2" required><br><Br>
                    <label for="cpassword2">Confirm Password</label><br>
                    <input type="password" name="cpassword2" required><br><Br>
                    <input type="submit" name="staffsu" class="su" value="Sign-Up as Staff">
                </form>
            </center>
        </div>
        <center><a href="index.php" style="color:#fff !important;">Cancel</a></center>
    </div>
    <?php require("footer.php");?>

</body>
<script>
    function stud() {
        document.getElementById('stud').style = "display:initial";
        document.getElementById('staff').style = "display:hidden";
    }

    function staff() {
        document.getElementById('stud').style = "display:hidden";
        document.getElementById('staff').style = "display:initial";
    }
</script>

</html>
