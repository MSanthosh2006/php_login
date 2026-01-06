<?php
session_start();
require_once("dbconnection.php");

if (!$conn) {
    die("Database Connection Error");
}
$uname = $_POST['uname'];
$upwd  = $_POST['upwd'];
$utype = $_POST['utype'];

/* ================= ADMIN LOGIN ================= */
if ($utype == "Admin") {

    if ($uname == "Admin" && $upwd == "Admin") {

        $_SESSION["sessname"] = $uname;
        $_SESSION["usertype"] = "Admin";
        $_SESSION["userid"]   = null; // admin has no userid

        echo "<script>alert('Admin Login Success');location.href='adminmainpage.php';</script>";
        exit;
    } else {
        echo "<script>alert('Admin Login Failed');location.href='index.html';</script>";
        exit;
    }
}

/* ================= USER LOGIN ================= */
else if ($utype == "User") {

    $existsquery = "SELECT * FROM tbl_user WHERE username='$uname' AND userpwd='$upwd'";
    $res1 = mysqli_query($conn, $existsquery);

    if (mysqli_num_rows($res1) > 0) {

        $rs = mysqli_fetch_assoc($res1);

        $_SESSION["sessname"]  = $rs['username'];
        $_SESSION["userid"]    = $rs['userid'];     // VERY IMPORTANT
        $_SESSION["usertype"]  = "User";
        $_SESSION["coursename"] = $rs['usercourse'];

        echo "<script>alert('User Login Success');location.href='mainpage.php';</script>";
        exit;
    } else {
        echo "<script>alert('Invalid User or Password');location.href='index.html';</script>";
        exit;
    }
}

/* ================= INVALID TYPE ================= */
else {
    echo "<script>alert('Select The User Type');location.href='index.html';</script>";
    exit;
}
?>
