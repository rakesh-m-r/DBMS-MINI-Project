<html>

<head>
    <title>
        Onine examination System
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<?php
session_start();
?>
<style>
    li {
        margin: 1.5vw;
    }

    ul {
        list-style: none;
        width: auto !important;
    }
    .navbar{
        background-color: orange !important;
    }
    .navbar>ul>li:hover{
        color: blue;
        text-decoration: underline;
    }
    a{
        text-decoration: none;
        color: black;
    }
    @media screen and (max-width: 450px) {
        .navbar{
            display: initial !important;
           
        }
        .navbar>ul{
            display: initial !important;
            left: 25vw !important;
            text-align: center;
            right: 25vw !important;
        }
        .navbar>ul>li{
            background-color: orange !important;
        }
        section{
            text-align: center;
            margin-top: 0 !important;
            background-color: orange !important;
            width: 100vw;
            margin: 0 !important;
        }
    }
</style>
<body style="margin: 0 !important;font-weight: bolder !important;font-family: 'Courier New', Courier, monospace;">
    <div style="background-color: rgba(41, 187, 212, 0.63);height: 100%;">
        <div class="navbar" style="display: inline-flex;width: 100%;">
            <section style="margin: 1.5vw;">ONLINE EXAMINATION SYSTEM</section>
            <ul style="display: inline-flex;padding: 0 !important;margin: 0;float: right;right: 0;position: fixed;width: 50vw;">
                <li>Home</li>
                <li>profile</li>
                <li>Score</li>
                <li><a href="index.php">Sign Out<?php session_destroy(); ?></a></li>
            </ul>
        </div>
    </div>
</body>
<script>
            alert("Welcome to Online Examination System <?php $_SESSION["name"] ?>") 
</script>

<?php
session_unset();
 session_destroy(); ?>

</html>