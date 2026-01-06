<?php
/*
include- if the included page is not available it shows an warning msg and continues the execution.
require -if the included page is not available it shows an Fatal error and stop the execution.
*/
require_once("dbconnection.php");
if($conn)
{
  //echo "Database is Connected";
  $uname=$_POST['uname'];
  $upwd=$_REQUEST['upwd'];
  $uemail=$_POST['uemail'];
  $umobile=$_POST['umobile'];
  $course=$_POST['course'];
  
  //echo $uname;
  $existsquery="select * from tbl_user where useremail='$uemail' and usermobile='$umobile'";
  $res1=mysqli_query($conn,$existsquery);
  if(mysqli_num_rows($res1)>0)
  {
	  //echo "Already Exists";
	 echo "<script>alert('Already Exists');location.href='index.html';</script>";
  }
  else{
  
  $query="insert into tbl_user(username,userpwd,useremail,usermobile,usercourse) values('$uname','$upwd','$uemail','$umobile','$course')";
  $result=mysqli_query($conn,$query);
  if($result)
  {
	   echo "<script>alert('Inserted Successfully');location.href='index.html';</script>";
  }
  else{
	   echo "<script>alert('Error in Registration ');location.href='index.html';</script>";
	  
  }
 
}
}
else
{
	echo "Error in Db Connection";
}

?>