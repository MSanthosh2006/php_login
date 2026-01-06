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
	$query="select * from tbl_course where status=0";
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
				<li><a href="">Transaction</a></li>
				<li><a href="report.php">Report</a></li>
			</ul>
		</nav>
   </div>
   <div id="content">
   <?php
   while($rs=mysqli_fetch_array($exec))
   {
	   $courseid=$rs["courseid"];
	   $coursename=$rs["coursename"];
	   $courseimg=$rs["courseimg"];
	   
	   $imgdir="FileUploads/".$courseimg;
	   ?>
   <div id="gallerydiv">
   <div id="galimg">
   <a href="<?php echo $imgdir;?>" target='_blank'>
   <?php echo "<img src=$imgdir>";?>
   <div id="imgdesc"><?php echo $coursename."," .$courseid;?></div>
   </a>
   </div>
   </div>
   <?php
   }
   ?>
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