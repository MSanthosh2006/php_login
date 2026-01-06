<?php
session_start();
$sessionname=$_SESSION["sessname"];
if($sessionname=="")
{
echo "<script>alert('Session is Destroyed');location.href='index.html';</script>";   
}
else
{
require_once("dbconnection.php");
if($conn)
{
	$userid=$_REQUEST['q'];
	//echo $userid;
	$query="update tbl_user set status=1 where userid='$userid'";
	//echo $query;
$exec=mysqli_query($conn,$query);
echo "<script>location.href='adminmainpage.php';</script>"; 
}
}


?>