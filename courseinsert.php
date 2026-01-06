<?php
require_once("dbconnection.php");
if($conn)
{
  //echo "Database is Connected";
  $autoid=$_REQUEST['autoid'];
  $courseid=$_REQUEST['courseid'];
  $coursename=$_REQUEST['coursename'];
  $courseimage=@$_FILES['courseimg'];
  $imgname=@$_FILES["courseimg"]["name"];
  $imgtype=@$_FILES["courseimg"]["type"];
  $imgsize=@$_FILES["courseimg"]["size"]/1024;
  $tmplocname=@$_FILES["courseimg"]["tmp_name"];
 /* echo "Name:".$coursename;
  echo "Image Name:".$imgname;
  echo "Image Type:".$imgtype;
  echo "Image Size:".$imgsize;
  echo "Temporary Location:".$tmplocname;*/
  $uploadimage=$coursename.".png";
  $uploaddir="FileUploads/";
  $query="insert into tbl_course values('$autoid','$courseid','$coursename','$uploadimage',0)";
  $res=mysqli_query($conn,$query);
  if($res>0)
  {
 
  move_uploaded_file($_FILES['courseimg']['tmp_name'], $uploaddir . $uploadimage);
  echo "<script>alert('Course  is Added');location.href='addCourse.php';</script>";   
  }
  else{
	  echo "Error in Insertion";
	  
  }
}
else
{
	echo "Error in Db Connection";
}

?>