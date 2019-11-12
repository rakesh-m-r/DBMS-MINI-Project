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
    if (isset($_POST['submit'])) {
        $qname = strtolower($_POST['quizname']);
        $_SESSION["qname"]=$qname;
        $sql1 = "insert into quiz(quizname,mail) values('$qname','$username1')";
        $res1 = mysqli_query($conn, $sql1);
        if ($res1 == true) {
            $sql = "select quizid from quiz where quizname='" . $qname . "';";
            $res = mysqli_query($conn, $sql);
            if ($res == true) {
                header("location: addqs.php");
            } else {
                echo "<script>alert(\"some error occured\");</script>";
            }
        } else {
            echo "<script>alert(\"Already name exists\");</script>";
        }
    }
}
?>
<style>
    table{
        border: 1px solid black;
        width: 100% !important;
        font-weight: bolder;
        font-size: 2vw;
        color: white;
    }
    td{
        border: 1px solid black;
        width: 20%;
        font-weight: bolder;
        font-size: 2vw;

    }
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
        top: 3vw;
        position: absolute;
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
        margin: 5vw;
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
        <section class="dash" style="margin: 5vw;width: 90vw;">
            <center><h1 style="font-weight:bolder;font-size:3vw">Dashbord</h1></center>
            <button onclick="addquiz()">Add Quiz</button>
            <section id="addq" style="display:none;">
                <form style="margin: 5vw;width: 30vw" method="post">
                    <center>
                        <label for="quizname">Quiz name</label><br><br>
                        <input type="text" name="quizname" placeholder="enter quiz name" required><br><br>
                        <input type="submit" name="submit" value="submit" style="height: 3vw;width: 10vw;font-family: 'Courier New', Courier, monospace;font-weight: bolder;border-radius: 10px;border: 2px solid black;background-color: rgb(77, 77, 236);">
                    </center>
                </form>
            </section>
            <section id="ans" style="display: none;">
            <form style="margin: 5vw;width: 30vw" method="post">
                    <center>
                        <label for="quizname">Questions</label><br><br>
                        <div id="QS">
                        <input type="text" name="qs" placeholder="enter question " required><br><br>
                        <input type="text" name="op1" placeholder="option1" required><br><br>
                        <input type="text" name="op2" placeholder="option2" required><br><br>
                        <input type="text" name="op3" placeholder="option3" required><br><br>
                        <input type="text" name="ans" placeholder="answer" required><br><br>
                        </div>
                        <input type="submit" name="submit" value="submit" style="height: 3vw;width: 10vw;font-family: 'Courier New', Courier, monospace;font-weight: bolder;border-radius: 10px;border: 2px solid black;background-color: rgb(77, 77, 236);">
                    </center>
                </form>
            </section>
        </section>
        <section class="prof" id="prof" style="display: none;color:white;">
            <p><b>Type of User&nbsp;:&nbsp;<?php echo $type1 ?></b></p>
            <p><b>NAME&nbsp;:&nbsp;<?php echo $dbname ?></b></p>
            <p><b>EMAIL&nbsp;:&nbsp;<?php echo $dbmail ?></b></p>
            <p><b>Ph No.&nbsp;:&nbsp;<?php echo $dbphno ?></b></p>
            <p><b>STAFF ID.&nbsp;:&nbsp;<?php echo $dbusn ?></b></p>
            <p><b>GENDER&nbsp;:&nbsp;<?php echo $dbgender ?></b></p>
            <p><b>DOB&nbsp;:&nbsp;<?php echo $dbdob ?></b></p>
            <p><b>Dept.&nbsp;:&nbsp;<?php echo $dbdept ?></b></p>
        </section>
        <section id="score" style="display:none;">
            <?php 
            $sql ="select * from quiz where mail='{$username1}'";
            $res=mysqli_query($conn,$sql);
            if($res)
            {
                echo "<h1>List of Quiz added by U</h1>";
                echo "<table><thead><tr><td>Quiz id</td>&nbsp;<td>Quiz Title</td><td>Created on</td></tr></thead>";
                while ($row = mysqli_fetch_assoc($res)) {                
                    echo "<tr><td>".$row["quizid"]."</td><td>".$row["quizname"]."</td><td>".$row["date_created"]."</td></tr>"; 
                }
                echo "</table>";
            }
            ?>
        </section>
    </div>
</body>
<?php
echo '<script>alert("Welcome to Online Examination System ' . $_SESSION['name'] . '");' .
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