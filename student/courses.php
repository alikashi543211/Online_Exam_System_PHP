<?php
session_start();
if (!$_SESSION['user_name']) {
header("Location:../index.php");
exit();
}
else
{ 
include_once 'connection.php';
}
?>
<link rel="stylesheet" href="style.css" type="text/css" />
<link rel="stylesheet" href="stylesheet.css" type="text/css" />
<link rel="shortcut icon" href="d.jpg" />
<html>
<head>
<title>
Student/Courses
</title>
</head>
<body bgcolor="red">
<!---------------------------------------------------------------------------------------------------------------------->
<!--                                         Main Maniue                                      -->
<!----------------------------------------------------------------------------------------------------------------------->
<form action="../index.php" method="post">
<table id="table1" style="background-color:lightgrey;">
<tr>
<td style="height:100px;width:1100px;">
<?php echo "<h1 style='color:maroon'>Wellcome ".($_SESSION['user_name']."</h1>"); ?>
</td>
<td style="height:70px; width:250px;text-align:center;"><button style="width:120px;cursor:pointer;" class="testbutton" name="sign_out" />Sign Out </button>
</td>
</tr>
<tr>
<td colspan="2">
<div id="stylefour">
	<ul>
	<li><a href="Courses.php" title=""><span>See Courses</span></a></li>
	</ul>
	</div>
</td>
</tr>
</table>
</form>
<h1 align="center"> Your Courses</h1>
<table align="center" bordercolor="white" style="background-color:darkgreen;color:white;">
<?php
$user_id=$_SESSION['user_id'];
$query_a="SELECT a.user_id,a.course_id,u.user_id,c.course_id,c.course_name FROM std_course_alloc a , user u , course c
                WHERE (a.user_id='$user_id' && u.user_id='$user_id' && a.course_id=c.course_id)";
$result_a=mysqli_query($con,$query_a);
/*                                                 RESULT CHECK
if($result_a)
{
	echo "<h1>SUCCESS</h1>";	
}
else
{
	echo "<h1>FAIL</h1>";
}
*/
while($row_a=mysqli_fetch_array($result_a))
{
?>
<tr>
<td><?php echo ("<h3>".$row_a['course_name']."</h3>"); ?></td>
</tr>
<?php
}
?>
</table>

</body>
</html>