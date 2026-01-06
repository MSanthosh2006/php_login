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
	$query="select ifnull(max(id),0) from tbl_course";
	$exec=mysqli_query($conn,$query);
	$res=mysqli_fetch_row($exec);
	$autoid=$res[0]+1;
	$courseid="COURSE".$autoid;
	
	
	?>
<html>
  <head>
  <title>
  Ecommerce
  </title>
  <link rel=stylesheet type="text/css" href="css/style.css">
  <script src="js/script.js"></script>
  </head>
	
  <body>
   <form method="post" action="courseinsert.php" name="loginform" enctype="multipart/form-data">
   <div id="container">
   <div id="header">
   <table id="headertable">
   <tr><td>
   Welcome :<?=$sessionname?></td>
   <td>
   <a href="logout.php">Logout</a>
   </td>
   </tr>
   </table>
   </div>
   <div id="menus">
   <nav>
		<ul>
			<li><a href="#">Home</a></li>
				<li><a href="">Master</a></li>
				<li><a href="addCourse.php">Add Course</a></li>
				<li><a href="">Transaction</a></li>
				<li><a href="">Report</a></li>
			</ul>
		</nav>
   </div>
   <div id="content">
   <br><br>
   <table id="logintable">
<tr><th colspan=2>Add Course Details<hr></th></tr>
<tr><td><input type="hidden" name="autoid" value="<?php echo $autoid;?>" ></td></tr>
<tr><td>CourseId:</td><td><input type="text" name="courseid" value="<?php echo $courseid;?>" ></td></tr>	
<tr><td>CourseName:</td><td><input type="text" name="coursename" value="" ></td></tr>	
<tr><td>Course Image</td><td><input type="file" name="courseimg"></td></tr>	
<tr><td colspan =2><input type="submit" value="Submit">
</td></tr>
		  
   </table>
   </div>
   <div id="footer">
   </div>
   </div>
   </form>
  </body>
</html>
<?php
}
}


?>