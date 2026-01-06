<?php
require("dbconnection.php");
if($conn)
{
	$query="select distinct * from tbl_course";
	$exec=mysqli_query($conn,$query);
	
}
else
{
	echo "DB Connection Error";
}
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
   <form method="post"action="registernewuser.php" name="registerform">
   <div id="container">
   <div id="header">
   </div>
   <div id="menus">
   </div>
   <div id="content">
   <br><br>
   <table id="registertable">
		<tr><th>Register Here<hr></th></tr>
		<tr><td>
  <input type="text" name="uname" id="uname" placeholder="Enter UserName" onKeyPress='return onlyAlphabet(event);' ></td></tr>
  <tr><td id="uerr"></td></tr>
  <tr><td>
  <input type="password" name="upwd" id="upwd" placeholder="Enter password"></td></tr>
  <tr><td id="perr"></td></tr>
  <tr><td>
  <input type="password" name="ucpwd" id="ucpwd" placeholder="Enter Confirm password" required onBlur='return checkPassword();'></td></tr>
  <tr><td id="perr"></td></tr>
  <tr><td>
  <input type="email" name="uemail" id="uemail" placeholder="Enter EmailId" required></td></tr>
  
  <tr><td>
  <input type="text" name="umobile" id="umobile" placeholder="Enter Mobile Number" required maxlength=10 onKeyPress="return onlyNumber(event);"></td></tr>
  
  <tr><td>
  
  <select name="course" id="course">
  <option value="0">---select course---</option>
  <?php
  while($rs=mysqli_fetch_array($exec))
  {
	  $courseid=$rs[1];
	  $coursename=$rs[2];
?>
<option value="<?php echo $courseid;?>">
<?php echo $coursename;?></option>
 <?php
  }
?>  
  <tr><td>
 <input type="submit" name="lbutton" value="SignUp" onClick='return registerSubmit();'>
  </td></tr>
  
  <tr><td>If Exists <a href="index.html"> Click Here </a>
  </td></tr>
   </table>
   </div>
   <div id="footer">
   </div>
   </div>
   </form>
  </body>
</html>
