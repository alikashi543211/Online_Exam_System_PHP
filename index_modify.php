<head>
<link rel="shortcut icon" href="d.jpg" />
<link rel="stylesheet" href="admin/stylesheet.css" type="text/css" />
</head>
<body bgcolor="red">
</body>
<?php
session_start();
include ("connection.php");
if(isset($_POST['sign_out']))
{
	$_SESSION['email_id']     = "" ;
	$_SESSION['password']     = "" ;
	$_SESSION['user_type_id'] = "" ;
	$_SESSION['user_name']    = "" ;
}
?>


<?php
 if(isset($_POST['sign_in']))
	{
		
		echo "<h1>KASHIF ALI</h1>";
	   $_SESSION['email_id']=$_POST['email_id'];
	   $_SESSION['password']=$_POST['password'];
	   echo $_SESSION['user_type_id']=$_POST['user_type_id'];
	   $email_id=$_SESSION['email_id'];
	   $password=$_SESSION['password'];
	   $user_type_id=$_SESSION['user_type_id'];
	   $query="SELECT * FROM user,user_type WHERE user.u_type_id=user_type.u_type_id";
		$result=mysqli_query($con,$query);
		
		while($row=mysqli_fetch_array($result))
		{
			
			// --------------------------------------VERIFICATION FROM DATABASE---------------------------
			
			if( $row['email_id']==$email_id )  //CHECK EMAIL FROM DATABASE
			{
				$correct_email="Your Email is correct.";
			}
			if( $row['password']==$password )   //CHECK PASSWORD FROM DATABASE
			{	
				$correct_password="User Password is correct.";
			}
			if( $row['u_type_id']==$user_type_id )     //CHECK USER TYPE FROM DATABASE
			{
				$correct_user_type="User Type Is Correct";
			}
			
			
			
			
			// WHEN ALL CONDITIONS ARE TRUE.......
			if( $row['email_id']==$email_id && $row['password']==$password && $row['u_type_id']==$user_type_id )
			{
				$_SESSION['user_name']=$row['user_name'];
				$_SESSION['user_id']=$row['user_id'];
				$_SESSION['user_type']=$row['u_type'];
				header("Location:".$_SESSION['user_type']."/index.php");
			}
			
			
			
			
		}
		
		//$msg="You have entered wrong id and password....";
	
	
	
	// ' ERROR MESSAGE '
			if(!isset($correct_email))
			{
				$error_msg="Your Email is in-correct.";      
			}
			else if(!isset($correct_password))
			{
				//$correct_email=$row['email_id'];
				$error_msg="Your Password is in-correct.";
			}
			else if(!isset($correct_user_type))
			{
				//$correct_email=$row['email_id'];
				//$correct_password=$row['password'];
				$error_msg="You have selected in-correct user type.";
			}
			
	}
	
?>
<html>
<head>
<title>Examination-System-Sign In</title>
</head>
<div style="background-color:darkblue;">
  <form method="post">
  <table align="center" style="background-color:darkblue;color:white;">
<tr>
   <td colspan="5" id="as"><span id="k"><b>Online Examination System<br><br><br><b></span></td>
</tr>
<tr>
   <td rowspan="3" id="j"></td>
   <td class="userid" ><br>User ID : </td>
   <td class="userid" ><br>User Password :</td><td colspan="2"><br>User Type :</td>
</tr>
<tr>               
   <td class="email" ><input type="email" name="email_id" placeholder="Email Address" 
   value="<?php if(isset($email_id)) echo $email_id; ?>" required ></td>
   <td class="email" ><input type="password" name="password" placeholder="Password"
       value="<?php if(isset($password)) echo $password; ?>"   required ></td>
   <td class="pswrd" align="right">
   <?php
   $query_a="SELECT * FROM user_type";
   $result_a=mysqli_query($con,$query_a);
   ?>
   <select name="user_type_id">
   <?php
   while($row_a=mysqli_fetch_array($result_a))
   {
   ?>
   <option value="<?php echo $row_a['u_type_id'];  ?>" <?php if(isset($user_type_id) && $row_a['u_type_id']==$user_type_id) { ?> selected <?php } ?> ><?php echo $row_a['u_type']; ?></option>
   <?php
   }
   ?>
   </select></td>
   <td class="txt" colspan="2" align="right"><input class="btn"  type="submit" name="sign_in" value="Sign in"></td>
</tr>
<tr>
   <td class="txt1" colspan="5"><a class="pclr" href="forgotpassword.php"><br><?php if(isset($error_msg)) { echo $error_msg; } ?></a></td>                           
</tr>

<tr>
   <td class="txt1" colspan="5"><a class="pclr" href="forgotpassword.php"><u><br>Forgotten Password?</u></a></td>                           
</tr>

</table>
</form>

</div>


</html>