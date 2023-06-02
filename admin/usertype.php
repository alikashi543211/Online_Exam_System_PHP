<?php
include "connection.php";
if(isset($_POST['add']))
{
$u_type=$_POST['u_type'];
$status=$_POST['status'];
$query_a="INSERT INTO user_type (u_type,status)
                         VALUES('$u_type','$status')";
$result_a=mysqli_query($con,$query_a);
if($result_a)
{
	echo "<h1>Run Successfully...</h1>";
}
else
{
	echo "<h1>Error</h1>";
}	
}
?>
<html>
<head>
<title>
Admin\User type
</title>
</head>
<body bgcolor="pink">
<h1   align="center">User type</h1>
<form method="post">
<table align="center" border="5">
<tr>
<td>Enter user type :</td>
</tr>
<tr>
<td><input type="text" placeholder="User type" name="u_type" /></td>
</tr>
<tr>
<td>Select status :</td>
</tr>
<tr>
<td>
<select name="status">
<option>Active</option>
<option>Block</option>
</select>
</td>
<tr>
<td align="right">
<input type="submit" name="add" value="Add" />
</td>
</tr>
</tr>
</table>
</form>
</body>
</html>