<?php
session_start();
require_once("dbconnection.php");

if (!isset($_SESSION["sessname"])) {
    header("Location: index.html");
    exit;
}

$userid = $_POST['userid'];
$mark1  = $_POST['mark1'];
$mark2  = $_POST['mark2'];
$mark3  = $_POST['mark3'];
$total  = $_POST['total'];
$avg    = $_POST['avg'];
$grade  = $_POST['grade'];

/* CHECK DUPLICATE MARKS FOR SAME USER */
$check = "SELECT userid FROM tbl_marks WHERE userid='$userid'";
$res = mysqli_query($conn, $check);

if (mysqli_num_rows($res) > 0) {
    echo "<script>alert('Marks already added for this user');location.href='adminmainpage.php';</script>";
    exit;
}

/* ✅ CORRECT INSERT (ONLY EXISTING COLUMNS) */
$sql = "
INSERT INTO tbl_marks
(userid, mark1, mark2, mark3, total, avg, grade)
VALUES
('$userid', '$mark1', '$mark2', '$mark3', '$total', '$avg', '$grade')
";

if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Marks Inserted Successfully');location.href='adminmainpage.php';</script>";
} else {
    die(mysqli_error($conn));
}
?>
