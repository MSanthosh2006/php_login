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
	$query="select * from tbl_user where status=0";
	$exec=mysqli_query($conn,$query);
	
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
   <form method="post"action="loginvalidation.php" name="loginform">
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
				<li><a href="viewMarks.php">Transaction</a></li>
				<li><a href="report.php">Report</a></li>


			</ul>
		</nav>
   </div>
   <div id="content">
   <br><br>
   <table id="logintable">
		<tr><th colspan=6>User Registered Details<hr></th></tr>
		<tr><th>UserId</th><th>User Name</th>
		<th>EmailId</th>
		<th>Mobile</th>
		<th>Course</th>
		<th>Action</th>
		</tr>
		<?php
		if(mysqli_num_rows($exec)>0)
		{
		   while($rs=mysqli_fetch_array($exec))
		   {
			   $userid=$rs['userid'];
			   $username=$rs['username'];
			   $useremail=$rs['useremail'];
			   $usermobile=$rs['usermobile'];
			   $usercourse=$rs['usercourse'];
			   echo "<tr><td>$userid</td><td>$username</td>";
			   echo "<td>$useremail</td><td>$usermobile</td><td>$usercourse</td><td>
		<a href='deleteuser.php?q=$userid'>Delete</td>
		<td>
		<a href='addMarks.php?q=$userid'>Add Marks</td>
		</tr>";
		   } 
		}
		else{
		echo "<tr><td colspan=6>No Records Found</td></tr>";	
		}
		  ?>
		  
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