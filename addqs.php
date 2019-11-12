<html>

<head>
    <title>
        Onine examination System
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'project');
if (!$conn) {
    echo "<script>alert(\"Database error retry after some time !\")</script>";
} else {
    $type1 = $_SESSION["type"];
    $username1 = $_SESSION["username"];
    $sql = "select * from " . $type1 . " where mail='{$username1}'";
    $res =   mysqli_query($conn, $sql);
    if ($res == true) {
        global $dbmail, $dbpw, $dbusn;
        while ($row = mysqli_fetch_array($res)) {
            $dbmail = $row['mail'];
            $dbname = $row['name'];
            $dbusn = $row['staffid'];
            $dbphno = $row['phno'];
            $dbgender = $row['gender'];
            $dbdob = $row['DOB'];
            $dbdept = $row['dept'];
        }
    }
    $qname = $_SESSION['qname'];
    $sql = "select quizid from quiz where quizname='{$qname}'";
    $res =   mysqli_query($conn, $sql);
    if ($res == true) {
        global $qid;
        while ($row = mysqli_fetch_array($res)) {
            $qid = $row['quizid'];
        }
    }
    if (isset($_POST['submit'])) {
        $qs = $_POST["qs"];
        $op1 = $_POST["op1"];
        $op2 = $_POST["op2"];
        $op3 = $_POST["op3"];
        $ans = $_POST["ans"];
        $sql = "insert into questions(qs,op1,op2,op3,answer,quizid) values('$qs','$op1','$op2','$op3','$ans','$qid');";
        $res =   mysqli_query($conn, $sql);
        if ($res == true) {
            echo '<script>history.pushState({}, "", "");</script>';
        } elseif ($res != true) {
            echo '<script>alert("Question already exsits");</script>';
        }
    }
    if (isset($_POST['submit1'])) {
        $qs = $_POST["qs"];
        $op1 = $_POST["op1"];
        $op2 = $_POST["op2"];
        $op3 = $_POST["op3"];
        $ans = $_POST["ans"];
        $sql = "insert into questions(qs,op1,op2,op3,answer,quizid) values('$qs','$op1','$op2','$op3','$ans','$qid');";
        $res =   mysqli_query($conn, $sql);
        if ($res == true) {
            header("Location: homestaff.php");
        } elseif ($res != true) {
            echo '<script>alert("Question already exsits");</script>';
        }
    }
}
?>
<style>
    li {
        margin: 1.5vw;
    }

    ul {
        list-style: none;
        width: auto !important;
    }

    .navbar {
        background-color: rgba(26, 201, 134, 0.801) !important;
    }

    .navbar>ul>li:hover {
        color: black;
        text-decoration: underline;
        font-weight: bold;

    }

    .navbar>ul>li>a:hover {
        color: black;
        text-decoration: underline;
        font-weight: bold !important;
    }

    a {
        text-decoration: none;
        color: white;
    }

    .prof,
    #score {
        width: 50vw !important;
        margin-left: 25vw !important;
        margin-right: 25vw !important;
        background-color: rgba(26, 201, 134, 0.801) !important;
        display: none !important;
        border-radius: 10px;
        margin-top: 2vw;
        z-index: 1;
        padding: 1vw;
        padding-left: 2vw;
        color: white;
    }

    button {
        height: 5vh;
        width: 10vw;
        background-color: lightgoldenrodyellow;
        color: black;
        outline: none;
        border: none;
        border-radius: 10px;
        margin: 2vw;
    }

    input {
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

    @media screen and (max-width: 450px) {
        .navbar {
            display: initial !important;

        }

        .navbar>ul {
            display: initial !important;
            left: 25vw !important;
            text-align: center;
            right: 25vw !important;
        }

        .navbar>ul>li {
            background-color: orange !important;
        }

        section {
            text-align: center;
            margin-top: 0 !important;
            background-color: orange !important;
            width: 100vw;
            margin: 0 !important;
        }

        p {
            color: white !important;
        }

    }
</style>

<body style="margin: 0 !important;font-weight: bolder !important;font-family: 'Courier New', Courier, monospace;">
    <div style="background-color: green;height: 100%;">
        <div class="navbar" style="display: inline-flex;width: 100%;color:white;position:fixed;">
            <section style="margin: 1.5vw;">ONLINE EXAMINATION SYSTEM</section>
            <ul style="display: inline-flex;padding: 0 !important;margin: 0;float: right;right: 0;position: fixed;width: 50vw;">
                <li onclick="dash()">Dashbord</li>
                <li onclick="prof()">profile</li>
                <li onclick="score()">Quiz's</li>
                <li onclick="lo()">Sign Out</li>
            </ul>
        </div><br><br>
        <section class="dash" style="margin-top:3vw">
            <section id="ans">
                <center>
                    <form style="margin: 0vw;width: 100vw" method="post">

                        <label for="quizname">Add Questions</label><br><br>
                        <div id="QS">
                            <label for="qs">Question</label>
                            <input type="text" name="qs" placeholder="enter question " required><br><br>
                            <label for="op1">Option 1</label>
                            <input type="text" name="op1" placeholder="option1" required><br><br>
                            <label for="op2">Option 2</label>
                            <input type="text" name="op2" placeholder="option2" required><br><br>
                            <label for="op3">Option 3</label>
                            <input type="text" name="op3" placeholder="option3" required><br><br>
                            <label for="ans">Answer &nbsp;</label>
                            <input type="text" name="ans" placeholder="answer" required><br><br>
                        </div>
                        <input type="submit" name="submit" value="add 1 more question" style="height: 3vw;width: auto;font-family: 'Courier New', Courier, monospace;font-weight: bolder;border-radius: 10px;border: 2px solid black;background-color: rgb(77, 77, 236);">
                        <input type="submit" name="submit1" value="Done" style="height: 3vw;width: auto;font-family: 'Courier New', Courier, monospace;font-weight: bolder;border-radius: 10px;border: 2px solid black;background-color: rgb(77, 77, 236);">
                    </form>
                </center>
            </section>
        </section>
        <section class="prof" id="prof" style="display: none;color:white;">
            <p><b>Type of User&nbsp;:&nbsp;<?php echo $type1 ?></b></p>
            <p><b>NAME&nbsp;:&nbsp;<?php echo $dbname ?></b></p>
            <p><b>EMAIL&nbsp;:&nbsp;<?php echo $dbmail ?></b></p>
            <p><b>Ph No.&nbsp;:&nbsp;<?php echo $dbphno ?></b></p>
            <p><b>USN&nbsp;:&nbsp;<?php echo $dbusn ?></b></p>
            <p><b>GENDER&nbsp;:&nbsp;<?php echo $dbgender ?></b></p>
            <p><b>DOB&nbsp;:&nbsp;<?php echo $dbdob ?></b></p>
            <p><b>Dept.&nbsp;:&nbsp;<?php echo $dbdept ?></b></p>
        </section>
        <section id="score" style="display:none;">
        </section>
    </div>
</body>
<?php
echo '<script>' .
    "function prof(){" .
    "document.getElementById(\"prof\").style=\"display: block !important;\";" .
    "document.getElementById(\"score\").style=\"display: none !important;\";" .
    "}" .
    "function score(){" .
    "document.getElementById(\"prof\").style=\"display: none !important;\";" .
    "document.getElementById(\"score\").style=\"display: block !important;\";" .
    "}" .
    "function dash(){" .
    "document.getElementById(\"prof\").style=\"display: none !important;\";" .
    "document.getElementById(\"score\").style=\"display: none !important;\";" .
    "}" .
    "function lo(){" .
    "alert(\"Thank You for Using our Online Examination System\");";
//session_unset();
//session_destroy();
echo "window.location.replace(\"http://localhost/DBMSproject/DBMS-MINI-project/index.php\");" .
    "}" .
    "function addquiz(){" .
    "document.getElementById(\"addq\").style=\"display: initial;\";" .
    "}" .

    "</script>";
?>

</html>