<?php
session_start();
include ("connection.php");
if(!$_SESSION['email_id'])
{
	header ('Location:index.php');
}
?>
