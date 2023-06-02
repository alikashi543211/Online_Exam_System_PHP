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
<!----------------------------------------------------------------------------------------------------------------------------->
<!--This is the user_type.php page and this page includes user type table of database exam_system and we will perform
   here add data in user_type table , display data , edit data , update data and delete data . User_type table of 
   database exam_system contains two coloumns in one row first is "user_type_id" and second is "user_type_name"..-->
<!----------------------------------------------------------------------------------------------------------------------------->

<!---------------------------------------------Start Section----------------------------------------------------------------->
<?php
                                      // session start
                             // connection to database
$btn="Add";                                           // initial value of $btn="Add"
?>
<html>
   <head>  
<link rel="stylesheet" href="style.css" type="text/css" />  <?php // head start ?>
 <link rel="stylesheet" href="stylesheet.css" />                                    <?php // linked stylesheet ?>
<title>
    Admin/User Type
</title>
   </head>
<!---------------------------------------------End Section------------------------------------------------------------------->













<!-----------------------------------------------Section 2------------------------------------------------------------------>
<?php
                                      // Insertion into Database
									  
if(isset($_POST['Add']))
{                                   
     $u_type=$_POST['u_type'];                                               // from user interface to variable
	 $status=$_POST['status'];                                              // query to insert
	 $query_a="INSERT INTO user_type (u_type,status)
					        VALUES  ('$u_type','$status')";
    $result_a=mysqli_query($con,$query_a);
    if($result_a)
	{
    $check_insert="Successfully inserted into database";                       //check true case
	}
	else
	{
    $check_insert="Failed";                                                   // check false case
	}
}
?>        
<!-----------------------------------------------Section 2 End-------------------------------------------------------------->		  


		  
		  
		  
		  
		  
		  
		  
		  
		  
		  

<!-----------------------------------------------Section 4------------------------------------------------------------------>
<?php
if(isset($_REQUEST['edit_id']) && !isset($_POST['Update']) )
{
	$btn="Update";
 $edit_id=$_REQUEST['edit_id'];
 $query_c="SELECT * FROM user_type WHERE u_type_id = $edit_id";
 $result_c=mysqli_query($con,$query_c);
 while($row_c=mysqli_fetch_array($result_c))
 {
	$edit_u_type=$row_c["u_type"];
	$edit_status=$row_c["status"];
 }
 $check_edit="Ready to edit and update";
}
?>
<!-----------------------------------------------Section 4 End-------------------------------------------------------------->
<?php
if(isset($_REQUEST['delt_id'])) 
{
	$refresh="Refresh";
	$delete_id=$_REQUEST['delt_id'];
	$query_e="DELETE FROM user_type WHERE u_type_id=$delete_id";
	$result_e=mysqli_query($con,$query_e);
	if($result_e)
	{
		$check_delete="Deleted successfully from database";
	}
	else
	{
		$check_delete="Failed";
	}
}
?>












<!-----------------------------------------------Section 5-------------------------------------------------------------->
<?php

if(isset($_POST['Update']))
{
	$refresh="Refresh";
	$update_id=$_REQUEST['edit_id'];
	$u_type=$_POST['u_type'];
	$up_status=$_POST['status'];
	$query_d=" UPDATE user_type  
	           SET u_type='$u_type',status='$up_status' WHERE u_type_id='$update_id' ";
	$result_d=mysqli_query($con,$query_d);
	if($result_d)
	{
		$check_update="Updated successfully into database";
	}
	else
	{
		$check_update="Failed";
	}
}
?>
		  
<!-----------------------------------------------Section 1----------------------------------------------------------------->	
		  <body bgcolor="maroon">
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
<?php
include "header.php";
?>
</td>
</tr>
</table>
</form>

	<br>
	<?php
if(isset($check_edit))
{ 
	echo "<h1 align='center'>".$check_edit."</h1>";
}
?>
<h1 align="center" style="color:white;" >User type Details</h1>
    <form method="post"> 

          <table align="center" >
      <tr>
       <td id="td3">Enter user type name :</td>
       <td>
	      <input class="userid" type="text" 
                  name="u_type"
                  placeholder =	 "Enter-user-type"	
                  value="<?php if(isset($edit_u_type)) { echo $edit_u_type; } ?>"     				  
									  />
	                       </td>
						   </tr>
						   <tr>
						   <td style="color:white;">Select status :</td>
						   <td><select name="status">
						   <option <?php if(isset($edit_status) && ($edit_status=='Active')) { ?> selected <?php } ?> >Active</option>
						   <option <?php if(isset($edit_status) && ($edit_status=='Block')) { ?> selected <?php } ?>>Block</option>
						   </select>
						   </td>
						   </tr>
			<?php if(!isset($refresh)) { ?>			   
		<tr>
		<td colspan="2" align="right">
		   <input style="height:40px;width:100px;cursor:pointer;" type="submit"                                              <?php //  $button ?>
				   class="testbutton"
		           name="<?php echo $btn; ?>"
				   value="<?php echo $btn; ?>"
				   />                   
					       </td>
       </tr>
			<?php } ?>
       </table>
       </form>
	   
	   
	   <?php // ----------------------------------------- Refresh Button --------------------------------------------- ?>
		  <?php if(isset($refresh)) { ?>
  <form align="center">
  <button style       =   "cursor:pointer;"
	        class       =   "testbutton"
	        name        =   "<?php echo $refresh; ?>" >                      <?php //initially $btn="Add" on edit $btn="Update" ?>
	        <?php   echo $refresh; ?>
    </button>
  </form>
  <?php } ?>
  <?php // ----------------------------------------- Refresh Button --------------------------------------------- ?>
	   
	   
         </body>
         </html>
<!-----------------------------------------------Section 1 End-------------------------------------------------------------->



<?php

if(isset($check_insert))
{
	echo "<h1>".$check_insert."</h1>";
}
else if(isset($check_update))
{
	echo "<h1>".$check_update."</h1>";
}
else if (isset($check_delete))
{
  echo "<h1>".$check_delete."</h1>";  
}
?>









<!-----------------------------------------------Section 3------------------------------------------------------------------>

<?php 
                                    // Display user type table from database
									
	$query_b="SELECT * FROM user_type";
	$result_b=mysqli_query($con,$query_b);
	?>
	<table align="center" border="5" style="color:white" >
	<tr>
	<td>User type ID</td>
	<td>User type Name</td>
	<td>Status</td>
	<td colspan="2">Operations</td>
	</tr>
	<?php
	while($row_b=mysqli_fetch_array($result_b))
	{
		?>
		<tr>
		<td align="center"> <?php echo $row_b["u_type_id"]; ?></td>
		<td align="left"> <?php echo $row_b["u_type"]; ?></td>
		<td align="center"> <?php echo $row_b["status"]; ?></td>
		<td align="center">
		<a  style="color:white;" href="user_type.php?edit_id=<?php echo $row_b["u_type_id"]; ?>" >Edit</a>
				     	                                     </td>
		<td align="center" >
		<a  style="color:white;" href ="user_type.php?delt_id=<?php echo $row_b["u_type_id"]; ?>">Delete</a>         
		                                                         </td>
		</tr>
		<?php
	}
	?>
	</table>

</table>


<!-----------------------------------------------Section 3 End-------------------------------------------------------------->


