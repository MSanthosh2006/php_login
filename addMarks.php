<?php
session_start();

if (!isset($_SESSION["sessname"]) || $_SESSION["sessname"] == "") {
    echo "<script>alert('Session is Destroyed');location.href='index.html';</script>";
    exit;
}

require_once("dbconnection.php");

$userid = $_REQUEST['q'];
$query = "SELECT * FROM tbl_user WHERE status=0 AND userid='$userid'";
$exec = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ecommerce</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
</head>

<body>
<form method="post" action="insertMarks.php" name="markform">
<div id="container">

<div id="header">
<table id="headertable">
<tr>
<td>Welcome : <?= $_SESSION["sessname"]; ?></td>
<td><a href="logout.php">Logout</a></td>
</tr>
</table>
</div>

<div id="menus">
<nav>
<ul>
<li><a href="#">Home</a></li>
<li><a href="#">Master</a></li>
<li><a href="addCourse.php">Add Course</a></li>
<li><a href="#">Transaction</a></li>
<li><a href="#">Report</a></li>
</ul>
</nav>
</div>

<div id="content">
<br><br>
<table id="marktable">
<tr><th colspan="3">User Marks Details<hr></th></tr>

<?php
if (mysqli_num_rows($exec) > 0) {
    while ($rs = mysqli_fetch_assoc($exec)) {
?>
<tr>
<td colspan="3">
<input type="text" name="userid" value="<?= $rs['userid']; ?>" readonly>
</td>
</tr>

<tr>
<td colspan="3">
<input type="text" name="username" value="<?= $rs['username']; ?>" readonly>
</td>
</tr>

<tr>
<td colspan="3">
<input type="text" name="usercourse" value="<?= $rs['usercourse']; ?>" readonly>
</td>
</tr>

<tr>
<td><input type="number" name="mark1" placeholder="Enter Mark1" onkeyup="calculateMarks()"></td>
<td><input type="number" name="mark2" placeholder="Enter Mark2" onkeyup="calculateMarks()"></td>
<td><input type="number" name="mark3" placeholder="Enter Mark3" onkeyup="calculateMarks()"></td>
</tr>

<tr>
<td colspan="3">
<input type="text" name="total" placeholder="Total" readonly>
</td>
</tr>

<tr>
<td colspan="3">
<input type="text" name="avg" placeholder="Average" readonly>
</td>
</tr>

<tr>
<td colspan="3">
<input type="text" name="grade" placeholder="Grade" readonly>
</td>
</tr>

<tr>
<td colspan="3">
<input type="submit" value="Submit">
</td>
</tr>

<?php
    }
} else {
    echo "<tr><td colspan='3'>No Records Found</td></tr>";
}
?>

</table>
</div>

</div>
</form>
</body>
</html>
