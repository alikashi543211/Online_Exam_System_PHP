<?php session_start(); // Start the session
if (!$_SESSION['user_name']) {
header("Location:../index.php");
exit();
}
else
{ 
include_once 'connection.php';
}
?>
<html>
<head>
<link rel="stylesheet" href="stylesheet.css" type="text/css" />
<link rel="shortcut icon" href="d.jpg" />
</head>

</html>
<title>
Admin
</title>
<html>
<body bgcolor="maroon">
<form action="../index.php" method="post">
<table id="table1" style="background-color:lightgrey;">
<tr>
<td style="height:100px;width:1100px;">
<?php echo "<h1 style='color:maroon'>Welcome ".($_SESSION['user_name']."</h1>"); ?>
</td>
<td style="height:70px; width:250px;text-align:center;"><button style="width:120px;cursor:pointer;" class="testbutton" name="sign_out" />Sign Out </button>
</td>
</tr>
<tr>
<td colspan="2">
<?php
include "header.php";
?>
</td>
</tr>
</table>
</form>

	<br>
</body>
</html>