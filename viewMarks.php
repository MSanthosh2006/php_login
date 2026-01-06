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
	$query="select * from tbl_marks";
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
				<li><a href="">Report</a></li>
			</ul>
		</nav>
   </div>
   <div id="content">
   <br><br>
   <table id="logintable">
		<tr><th colspan=9>User Marks Details<hr></th></tr>
		<tr><th>UserId</th><th>User Name</th>
		
		<th>Course</th>
		<th>Mark1</th>
		<th>Mark2</th>
		<th>Mark3</th>
		<th>Total</th>
		<th>Average</th>
		<th>Grade</th>
		</tr>
		<?php
		if(mysqli_num_rows($exec)>0)
		{
		   while($rs=mysqli_fetch_array($exec))
		   {
			   $userid=$rs['userid'];
			   $username=$rs['username'];
			   $usercourse=$rs['usercourse'];
			   $m1=$rs['mark1'];
			   
			   $m2=$rs['mark2'];
			   $m3=$rs['mark3'];
			   $total=$rs['total'];
			   $avg=$rs['average'];
			   $grade=$rs['grade'];
			   echo "<tr><td>$userid</td><td>$username</td>";
			   echo "<td>$usercourse</td><td>$m1</td><td>$m2</td><td>$m3</td><td>$total</td><td>
		$avg</td>
		<td>
		$grade</td>
		</tr>";
		   } 
		}
		else{
		echo "<tr><td colspan=9>No Records Found</td></tr>";	
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