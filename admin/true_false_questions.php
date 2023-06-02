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
<?php            // start of session
   //connection file 
?>
<html>
   <head>
   
       <link rel="shortcut icon" href="d.jpg" />                        <?php // short cut icon ?>
	  
       <link rel="stylesheet" href="stylesheet.css" type="text/css" />  <?php // stylesheet linked ?>
    <title>
Admin/User information
    </title>
  </head>
<?php
$btn="Add";
?>
<!---------------------------------------------------Start Section End-------------------------------------------------------->













<!--------------------------------------------------Section 2----------------------------------------------------------------->
                                          
<?php
    if(isset($_POST['Add'])) 	
{                                                                 // insertion into database
                                                       
	
	$user_name  =   $_POST['user_name'];                          
	$password   =   $_POST['password'];                           
	$contact    =   $_POST['contact'];                            // values from user-interface to variables
	$email_id   =   $_POST['email_id'];                           
	$u_type_id  =   $_POST['u_type_id'];                          
	$program_id =   $_POST['program_id'];                         
	$status     =   $_POST['status'];                             

	      
    $query_a = "INSERT INTO 
	          user(user_name,password,contact_no,email_id,u_type_id,program_id,status)     
	          VALUES('$user_name','$password','$contact','$email_id','$u_type_id','$program_id','$status')"; //insertion query
			  
	$result_a = mysqli_query($con,$query_a); //query run
?>         
                                       
<?php		 
		  if($result_a) // check insertion
		  {
			  $check_insert="Successfully inserted into Database.";  // true case              
		  }
		  else
		  {
			  $check_insert="Failed.";  // false case
		  }
		  ?>                                          		  
		  <?php
	}
	                                                                          // end of insertion into database
?>										 
<!-----------------------------------------------Section 2 End-------------------------------------------------------------->













<!---------------------------------------------------Section 4--------------------------------------------------------------->

								       <!--Edit on particuler user_id-->
<?php
       if(isset($_REQUEST['edit_id']) && !isset($_POST['Update']))
	   {
		   $btn          =    "Update";
		   $edit_id      =    $_REQUEST['edit_id'];                            // edit_id from url
		   $query_e      =    "SELECT * FROM user where user_id=$edit_id ";    //select row from database on particular id query
		   $result_e     =    mysqli_query($con,$query_e);                    // query run
		   while($row_e  =    mysqli_fetch_array($result_e))               // row on particular id is fetching
		   
		   {
			// coloumns data is fetching and saving into variable from a particular row id
		   $up_user_name      =   $row_e['user_name'];
		   $up_password       =   $row_e['password'];
		   $up_contact_no     =   $row_e['contact_no'];
		   $up_email_id       =   $row_e['email_id'];
		   $up_user_type_id   =   $row_e['u_type_id'];
		   $up_program_id     =   $row_e['program_id'];
		   $up_status         =   $row_e['status'];
		   }
		     $check_edit="Ready to edit and update.";                  //check values fetched
	   }
?>
<!----------------------------------------------- ---Section 4 End----------------------------------------------------------->













<!----------------------------------------------- ---Section 5--------------------------------------------------------------->
                                         <!--Updation Of Student Data-->
		<?php
		if(isset($_POST['Update']))
		{
	$update_id   =  $_REQUEST['edit_id'];                                                   // edit_id from url
	$user_name   =  $_POST['user_name'];
	$password    =  $_POST['password'];
	$contact     =  $_POST['contact'];                                                      // values are coming after edit 
	$email_id    =  $_POST['email_id'];
	$u_type_id   =  $_POST['u_type_id'];
	$program_id  =  $_POST['program_id'];
	$status      =  $_POST['status'];         
                                                                                            // update query
	   $query_f      =    "UPDATE user SET user_name='$user_name', 
	                      password='$password',contact_no='$contact',email_id='$email_id',
	                      u_type_id='$u_type_id',program_id='$program_id',status='$status'
	                      WHERE user_id='$update_id' ";
	   $result_f     =     mysqli_query($con,$query_f);                                     // query run
	   
	   if($result_f)
	   {
	   $check_update =    "Successfully updated into database.";                           // check case true
	   }
	   else
	   {
	   $check_update  =   "Failed.";                                                        // check case false
	   }
		}
	// end of update section
		?>	
<!-----------------------------------------------Section 5 End--------------------------------------------------------------->












		
<!----------------------------------------------- ---Section 6--------------------------------------------------------------->										<!--Deletion Of Student Data-->
										
	<?php
   if(isset($_REQUEST['delt_id']) && !isset($_POST['Add']) && !isset($_POST['Update']))
   {
	   $delete_id    =   $_REQUEST['delt_id'];                                              // id from url
	   $query_g      =   "DELETE FROM user WHERE user_id='$delete_id'";                     //delete query
	   $result_g     =   mysqli_query($con,$query_g);                                       // query run
	   if($result_g)
	   {
	   $check_delete =  "Deleted successfully from database.";                             //check result of delete true case
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
<h1 align="center" style="color:white;" >True False ( Questions )</h1>
  <br>
                                             <!--Result Of Edit Check-->
<?php
/*
if(isset($check_edit))
{
echo "<h1 align='center'>".$check_edit."</h1>";
} 
// end of edit check
?>
		                                         
     <form method="post">
     <table align="center">
   
  <tr>
                                 <td id="td3">Question Detail:</td>
     <td>
	 
	 <input type                 =              "text"
	        name                 =              "user_name"
	        placeholder          =              "User Name"
	        value                =              "<?php if(isset($up_user_name))  echo $up_user_name;  ?>"
	        required                             />
			                                             </td>
	                                     
	 
                                   <td id="td3">Question Paper:</td>
                                   <td>
	 
	 <input type                  =                "text"
	        name                  =                "password"
	        placeholder           =                "Password"
	        value                 =                "<?php if(isset($up_password)) echo $up_password; ?>"
	        required                                />
	                                                      </td>
														  
  </tr>
  
  <tr>
                                   <td id="td3">Status:</td>
                                   <td>
	 <input type                  =                 "tel" 
	        name                  =                 "contact" 
	        placeholder           =                 "Contact Number" 
	        value                 =                 "<?php if(isset($up_contact_no)) echo $up_contact_no; ?>" 
	        required                                 />
			                                                 </td>
	<!--														 
                                   <td id="td3">Email-ID:</td>
                                   <td >
	<input type                   =                  "text"
	       name                   =                  "email_id"
	       placeholder            =                  "Email Address"
	       value                  =                  "<?php// if(isset($up_email_id)) echo $up_email_id; ?>"
	       required                                   />
		                                                   </td>
														   -->
  </tr>
  
  <tr>
                                    <td id="td3">Select user-type:</td>
                                    <td>
	<select name   =  "u_type_id">                                     <?php // select user type  
	                                                                  // send value primary key to foreign key                   ?>
	<?php
	$query_c="Select * FROM user_type";                                 
	$result_c=mysqli_query($con,$query_c);                          
	?>
	<?php
	while($row_c=mysqli_fetch_array($result_c))
                                                  		    //fetch user_type_id and user_type_name from user_type_table
	{            
                                                         	//value  user_type_id from user_type table from database
                                                                   //dropdown options are user_type_name from user_type table                                                    
	?>                                                               <?php //options from user_type table  ?>
	<option  value="<?php echo $row_c["u_type_id"]; ?>"   
		     <?php if(isset($up_user_type_id) && ($up_user_type_id==$row_c["u_type_id"]))
				 { ?> selected <?php } ?> >
		     <?php echo $row_c["u_type"]; ?>
    </option>
		<?php
	}                         
	?>
	</select>
	                                                          </td>
															  
                                          <td id="td3"> Select program:</td>
                                          <td>
	<select name    =     "program_id" >                                              <?php // Select Program ?>

                                                                                    	<?php // send primary key to foreign key ?>
	<?php                                                                    
	$query_d="SELECT * FROM program";                             
	$result_d=mysqli_query($con,$query_d);
	while($row_d=mysqli_fetch_array($result_d))             //fetch program_id and program_name from program table row by row
	{
		?>                                                                  <?php//drop down of options from program table ?>
		                                                                    <?php//selected attribute use on condition ?>
		<option value="<?php echo $row_d["program_id"]; ?>" 
		<?php if(isset($up_program_id) && ($up_program_id==$row_d["program_id"]))
			{ ?> selected <?php } ?> > 
		<?php echo $row_d["program_name"]; ?></option>                         
		<?php
	}
	?>
	</select>
	                                                           </td>
  </tr>
  
  <tr>
                                          <td id="td3">Status:</td>
                                          <td>
	<select name   =   "status">
	<option value  =   "Active"
	        class  =   ""
	        <?php if(isset($up_status) && ($up_status=='Active'))
				{ ?> selected <?php } ?> >
			                                                                          <?php//selected attribute on condition?>
			Active</option>
	<option value  =   "Block" 
	       <?php if(isset($up_status) && ($up_status=='Block')) 
		   { ?> selected <?php } ?> >
	        Block</option>
	</select>
	</td>
  </tr>
  
  <tr>                                                                               <?php// button?>
    <td     colspan     =   "4"
            id          =   "td4" >
	<button style       =   "cursor:pointer;"
	        class       =   "testbutton"
	        name        =   "<?php echo $btn; ?>" >                      <?php //initially $btn="Add" on edit $btn="Update" ?>
	        <?php   echo $btn; ?>
    </button>
			                                                    </td>
  </tr>
  
      </table>
        </form>
		*/ ?>
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
  /* $query_b="SELECT u.user_id,u.user_name,u.password,u.contact_no,
   u.email_id,u.u_type_id , u.program_id , u.status , t.u_type_id ,
   t.u_type , p.program_id , p.program_name FROM user u,
   user_type t , program p WHERE u.u_type_id=t.u_type_id && u.program_id=p.program_id";
   // query for display all data
   */
   /*$query_b="SELECT m.t_marks_mcq, m.quan_mcq, m.each_mcq, m.q_p_formate_id,
   f.q_p_formate_id, f.q_paper_id, p.q_paper_id, p.user_name FROM mcq m, q_p_formate f, q_paper p
    WHERE f. ";
	*/
	$query_b="SELECT * FROM tf_questions";
   $result_b=mysqli_query($con,$query_b);
?>
 <table align="center" border="5" class="pclr" >
  <tr align="center">
    <td>Question_Paper_ID</td>
	<td>Question_Detail</td>
	 <td>Question_ID</td>
    <td>Status</td>
	<!--
    <td>Email ID</td>
    <td>User Type</td>
    <td>Program Name</td>
    <td>Status</td>
    <td colspan="2">Operations</td>
	-->
</tr>
<?php
 while($row_b=mysqli_fetch_array($result_b))
  {
	 ?>
  <tr align="center">
             <td align="center">    <?php echo $row_b["q_paper_id"];       ?>        </td>
             <td align="left">      <?php echo $row_b["question"];     ?>        </td>
             <td align="left">      <?php echo $row_b["question_id"];      ?>        </td>
             <td align="center">    <?php echo $row_b["status"];    ?>        </td>
            <?php /*
			 <td align="left">      <?php echo $row_b["email_id"];      ?>        </td>
             <td align="center">    <?php echo $row_b["u_type"]; ?>       </td>
             <td align="center">    <?php echo $row_b["program_name"];    ?>      </td>
             <td align="center">    <?php echo $row_b["status"];        ?>        </td>
			 
             <td>
			 <a style="color:white" href="user.php?edit_id=<?php echo $row_b["user_id"]; ?>">Edit</a>
			                                                                      </td>
             <td>
			 <a style="color:white" href="user.php?delt_id=<?php echo $row_b["user_id"]; ?>">Delete</a>
			                							</td>
														*/ ?>
  </tr>
	<?php
}
?>
            
</table>
                                             
<!---------------------------------------------------Section 3 End----------------------------------------------------------->




									 
									 