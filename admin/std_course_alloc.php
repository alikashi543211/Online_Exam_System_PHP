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
<!----------------------------------------------------Start Section-------------------------------------------------------->

<?php //  This is user page which provide user add data , display data , edit data , update data
//                                  and delete data from database                    ?>
<?php           // start of session
//connection file 
?>
<html>
   <head>
   
       <link rel="shortcut icon" href="d.jpg" />                        <?php // short cut icon ?>
       <link rel="stylesheet" href="stylesheet.css" type="text/css" />  <?php // stylesheet linked ?>
    <title>
Admin/Student-Course-Allocation
    </title>
  </head>
<?php
$btn="Allocate";
?>
<!---------------------------------------------------Start Section End-------------------------------------------------------->













<!--------------------------------------------------Section 2----------------------------------------------------------------->
                                          
<?php
    if(isset($_POST['Allocate'])) 	
{    
   if(!isset($_POST["allocate"]))
   {
	   $check_insert="Error !<br> Please select at least one option.";
   }
   else
	   foreach($_POST['allocate'] as $key=>$course_id )
	   {
		$user_id=$_POST['user_id'];
		$status=$_POST['status'];
        $query_a="INSERT INTO std_course_alloc(user_id,course_id,status)
		                                VALUES('$user_id','$course_id','$status')     ";
        $result_a=mysqli_query($con,$query_a);										
	   }
	   if(isset($result_a)) // check insertion
		  {
			  $check_insert="Successfully inserted into Database.";  // true case              
		  }
	   }
	   
	   
                   	// insertion into database                                                  
?>	
										 
<!-----------------------------------------------Section 2 End-------------------------------------------------------------->













<!---------------------------------------------------Section 4--------------------------------------------------------------->

								       <!--Edit on particuler user_id-->
<?php
      
	  if(isset($_REQUEST['edit_id']) && !isset($_POST['Update']))
	   {
		   $btn          =    "Update";
		   $edit_id=$_REQUEST['edit_id'];
		   $query_b="SELECT * FROM std_course_alloc WHERE std_c_al_id='$edit_id' ";
           $result_b=mysqli_query($con,$query_b);
           while($row_b=mysqli_fetch_array($result_b))
		   {
			   $edit_user_id=$row_b['user_id'];
			   $edit_course_id=$row_b['course_id'];
			   $edit_status=$row_b['status'];
		   }
		   $check_edit="Ready to edit and update.";
		   
		   //check values fetched
	   }
?>
<!----------------------------------------------- ---Section 4 End----------------------------------------------------------->













<!---------------------------------------------------Section 5--------------------------------------------------------------->
                                         <!--Updation Of Student Data-->
		<?php
		if(isset($_POST['Update']))
		{
			if(isset($_POST['allocate']))
			{	
		    $count=0;
			foreach($_POST['allocate'] as $up_course_id )
			{
				$count=$count+1;
			}
			if($count==1)
			{
				$refresh="Refresh";
		     $update_id=$_REQUEST['edit_id'];	
             $up_user_id=$_POST['user_id'];
             $up_status=$_POST['status'];		 
                                                                                            // update query
	         $query_f      =    "update std_course_alloc
	                                SET 
	                      user_id   = '$up_user_id',
                          course_id = '$up_course_id',						  
	                      status    = '$up_status'
                          where                     std_c_al_id='$update_id' ";
	              $result_f     =     mysqli_query($con,$query_f);
                 if($result_f) 
				{
				$check_update =    "Successfully updated into database.";	
				}
				else
				{
				$check_update =    "Failed.";	
				}		
			}
			else
			{
				$check_update="Error !  You can Update only one course.";
				
			 }
			}
			else
			{
			$check_update="Not Updated !  You have not selected any option.";	
			}
		}
					// query run
	   
	   
	// end of update section
		?>	
<!-----------------------------------------------Section 5 End--------------------------------------------------------------->












		
<!----------------------------------------------- ---Section 6--------------------------------------------------------------->										<!--Deletion Of Student Data-->
										
	<?php
   if(isset($_REQUEST['deallocate_id']))
   {
	   $refresh="Refresh";
	   $deallocate_id    =   $_REQUEST['deallocate_id'];                                              // id from url
	   $query_g      =   "DELETE FROM std_course_alloc WHERE std_c_al_id='$deallocate_id'";                     //delete query
	   $result_g     =   mysqli_query($con,$query_g);                                       // query run
	   if($result_g)
	   {
	   $check_delete =  "Deallocated successfully from database.";                             //check result of delete true case
	   }
	   else
	   {
	   $check_delete =  "Failed.";                                                       // check result of delete in false case
	   }
   }

?>	
										
  <!----------------------------------------------Section 6 End--------------------------------------------------------------->
  












                                       
<!------------------------------------------------Section 1------------------------------------------------------------------->									   
                                             <?php// USER INTERFACE  ?>
											 
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
include_once "header.php";
?>
</td>
</tr>
</table>
</form>

	<br>
<h1 align="center" style="color:white;" >Student Course Allocation</h1>
  <br>
                                             <!--Result Of Edit Check-->
<?php
if(isset($check_edit))
{
echo "<h1 align='center'>".$check_edit."</h1>";
} 
// end of edit check
?>
		                                         
    <form method="post">
    <table border="5" align="center" style="color:white;">
    <tr>
	<td>Select Username :</td>
	<td>
	<?php 
    $query_z="SELECT u.user_id,u.user_name,u.u_type_id,t.u_type_id, t.u_type FROM user u,user_type t where 
	         u.u_type_id=t.u_type_id && t.u_type='student' ";
	$run_z=mysqli_query($con,$query_z);
	?>
	<select name="user_id">
	<?php 
	while($row_z=mysqli_fetch_array($run_z))
	{
	?>
	<option value="<?php echo $row_z['user_id']; ?>"  <?php
	if(isset($edit_user_id) && ($edit_user_id==$row_z['user_id'])) { ?> selected <?php } ?> >
	<?php echo $row_z['user_name'];
                           	?></option>
	<?php
	}
	?>
	</select>
	</td>
	</tr>
	<tr>
	<td colspan="2">Select Courses :</td>
	</tr>
	<tr>
	<?php
	$query_y="SELECT course_id,course_name FROM course ";
	$run_y=mysqli_query($con,$query_y);
	?>
	<td colspan="2">
	<?php
	while($row_y=mysqli_fetch_array($run_y))
	{
	?>
	<input type="checkbox" name="allocate['<?php echo $row_y['course_name'];?>']" value="<?php echo $row_y['course_id']; ?>"
    <?php if (isset($edit_course_id) && ($edit_course_id==$row_y['course_id'])) {   ?> checked <?php } ?>	>
	<?php echo $row_y['course_name']."<br>"; ?>
	<?php 
	}
	?>
	</td>
	</tr>
	<tr>
<td id="td3">Status:</td>
                                          <td>
	<select name   =   "status">
	<option value  =   "Active"
	        class  =   ""
	        <?php if(isset($edit_status) && ($edit_status=='Active'))
				{ ?> selected <?php } ?> >
			                                                                          <?php//selected attribute on condition?>
			Active</option>
	<option value  =   "Block" 
	       <?php if(isset($edit_status) && ($edit_status=='Block')) 
		   { ?> selected <?php } ?> >
	        Block</option>
	</select>
	</td>
	</tr>
	
	<?php if(!isset($refresh)) { ?>
	
	 <tr>                                                                               <?php// button?>
    <td     colspan     =   "2"
	        align       =  "right"
            id          =   "td4" ><br><br>
	<button style       =   "cursor:pointer;"
	        class       =   "testbutton"
	        name        =   "<?php echo $btn; ?>" >                      <?php //initially $btn="Add" on edit $btn="Update" ?>
	        <?php   echo $btn; ?>
    </button>
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
											   
<!-------------------------------------------------Section 1 End-------------------------------------------------------------->











<!-------------------------------------------------------------------------------------------------------------------------->
                           				 <!--Result Of insertion Check-->
<?php
if(isset($check_insert))
{
echo "<h1>".$check_insert."</h1>";
}
?>    
                                           <!--Result Of updation Check-->
<?php
if(isset($check_update))
{
echo "<h1>".$check_update."</h1>";
}
?>   
                                             <!--Result Of Deletion Check-->
<?php
if(isset($check_delete))
{
echo "<h1>".$check_delete."</h1>";
}
?>
<!--------------------------------------------------------------------------------------------------------------------------->













<!---------------------------------------------------Section 3--------------------------------------------------------------->
                                           
										   <!--Display Of 'User' Table Of Database-->                                   

	<?php
   $query_b="SELECT a.std_c_al_id,a.user_id,a.course_id,a.status,u.user_id,u.user_name,c.course_id,c.course_name
   From std_course_alloc a,user u,course c where (u.user_id=a.user_id && a.course_id=c.course_id) ";               // query for display all data
   $result_b=mysqli_query($con,$query_b);
?>
 <table align="center" border="5" class="pclr">
  <tr align="center">
    <td>Student_Course_Allocation_ID</td>
    <td>Student_Name</td>
    <td>Course_Name</td>
    <td>Status</td>
    <td colspan="2">Operations</td>
</tr>
<?php
 while($row_b=mysqli_fetch_array($result_b))
  {
	 ?>
  <tr align="center">
             <td align="center">    <?php echo $row_b["std_c_al_id"];       ?>        </td>
             <td align="left">      <?php echo $row_b["user_name"];     ?>        </td>
             <td align="left">      <?php echo $row_b["course_name"];      ?>        </td>
             <td align="center">    <?php echo $row_b["status"];    ?>        </td>
             <td>
			 <a style="color:white" href="std_course_alloc.php?edit_id=<?php echo $row_b["std_c_al_id"]; ?>">Edit</a>
			                                                                      </td>
<td>
			 <a style="color:white" href="std_course_alloc.php?deallocate_id=<?php echo $row_b["std_c_al_id"]; ?>">Deallocate</a>
			                                                                      </td>

  </tr>
	<?php
}
?>
            
</table>
                                             
<!---------------------------------------------------Section 3 End----------------------------------------------------------->




									 
									 