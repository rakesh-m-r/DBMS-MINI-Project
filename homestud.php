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
    .prof,#score{
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
        p{
            color:white !important;
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
                <li onclick="score()">Score</li>
                <li onclick="lo()">Sign Out</li>
            </ul>
        </div><br><br>
        <?php
        $type1 = $_SESSION["type"];
        $username1 = $_SESSION["username"];
        $sql = "select * from " . $type1 . " where mail='{$username1}'";
        $res =   mysqli_query($conn, $sql);
        if ($res == true) {
            global $dbmail, $dbpw;
            while ($row = mysqli_fetch_array($res)) {
                $dbmail = $row['mail'];
                $dbname = $row['name'];
                $dbusn = $row['usn'];
                $dbphno = $row['phno'];
                $dbgender = $row['gender'];
                $dbdob = $row['DOB'];
                $dbdept = $row['dept'];
            }
        }
        ?>
        <section>
        <?php 
            $sql ="select * from quiz";
            $res=mysqli_query($conn,$sql);
            if($res)
            {
                echo "<h1>Take any Quiz</h1>";
                echo "<table><thead><tr><td>Quiz Title</td><td>Created on</td><td>Created By</td><td></td></tr></thead>";
                while ($row = mysqli_fetch_assoc($res)) {                
                    echo "<tr><td>".$row["quizname"]."</td><td>".$row["date_created"]."</td><td>".$row["mail"]."</td><td><a href='takeq.php?qid=".$row['quizid']."'>Take Quiz</button></tr>"; 
                }
                echo "</table>";
            }
            ?>
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
echo '<script>alert("Welcome to Online Examination System ' . $_SESSION['name'] . '");'.
"function prof(){".
"document.getElementById(\"prof\").style=\"display: block !important;\";".
"document.getElementById(\"score\").style=\"display: none !important;\";".
"}".
"function score(){".
"document.getElementById(\"prof\").style=\"display: none !important;\";".
"document.getElementById(\"score\").style=\"display: block !important;\";".
"}".
"function dash(){".
    "document.getElementById(\"prof\").style=\"display: none !important;\";".
    "document.getElementById(\"score\").style=\"display: none !important;\";".
    "}".
"function lo(){".
"alert(\"Thank You for Using our Online Examination System\");";
//session_unset();
//session_destroy();
echo "window.location.replace(\"http://localhost/DBMSproject/DBMS-MINI-project/index.php\");".
"}</script>";
?>

</html>