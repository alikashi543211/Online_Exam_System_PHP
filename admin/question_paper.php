<!----------------------------------------------------Start Section-------------------------------------------------------->

<?php //  This is user page which provide user add data , display data , edit data , update data
//                                  and delete data from database                    ?>
<?php
session_start();            // start of session
include "connection.php";   //connection file 
?>
<html>
   <head>
   
       <link rel="shortcut icon" href="d.jpg" />                        <?php // short cut icon ?>
	   <link rel="stylesheet" href="style.css" type="text/css" />
       <link rel="stylesheet" href="stylesheet.css" type="text/css" />  <?php // stylesheet linked ?>
    <title>
Admin/Question Paper
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
                                                       
	
	$q_p_name    =   $_POST['q_p_name'];                          
	$t_m         =   $_POST['t_m'];                           
	$t_n_q       =   $_POST['t_n_q'];                            // values from user-interface to variables
	$u_type_id   =   $_POST['u_type_id'];                           
	$session_id  =   $_POST['session_id'];                          
	$q_t_id      =   $_POST['q_t_id'];                         
	$status      =   $_POST['status'];                             

	      
    $query_a = "INSERT INTO 
	          q_paper(q_paper_name, total_marks ,total_num_question ,u_type_id ,q_paper_type_id ,session_id ,status)     
	          VALUES('$q_p_name','$t_m','$t_n_q','$u_type_id','$q_t_id','$session_id','$status')";  //insertion query
			  
	$result_a = mysqli_query($con,$query_a);                                    //query run
?>                                
<?php		 
		  if($result_a) // check insertion
		  {
			  $check_insert="Successfully inserted into Database.";              // true case              
		  }
		  else
		  {
			  $check_insert="Failed.";                                           // false case
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
		   $query_e      =    "SELECT * FROM q_paper where q_paper_id=$edit_id ";    //select row from database on particular id query
		   $result_e     =    mysqli_query($con,$query_e);                    // query run
		   while($row_e  =    mysqli_fetch_array($result_e))               // row on particular id is fetching
		   
		   {
			// coloumns data is fetching and saving into variable from a particular row id
		   $edit_q_paper_name      =   $row_e['q_paper_name'];
		   $edit_total_marks       =   $row_e['total_marks'];
		   $edit_total_num_question=   $row_e['total_num_question'];
		   $edit_u_type_id         =   $row_e['u_type_id'];
		   $edit_q_paper_type_id   =   $row_e['q_paper_type_id'];
		   $edit_session_id        =   $row_e['session_id'];
		   $edit_status              =   $row_e['status'];
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
	           $q_p_name    =   $_POST['q_p_name'];                          
	$up_t_m         =   $_POST['t_m'];                           
	$up_t_n_q       =   $_POST['t_n_q'];                            // values from user-interface to variables
	$up_u_type_id   =   $_POST['u_type_id'];                           
	$up_session_id  =   $_POST['session_id'];                          
	$up_q_t_id      =   $_POST['q_t_id'];                         
	$up_status      =   $_POST['status'];                             
                                                                             // update query
	   $query_f      =    "UPDATE q_paper SET q_paper_name='$q_p_name', 
	                      total_num_question='$up_t_n_q',u_type_id='$up_u_type_id',q_paper_type_id='$up_q_t_id',
	                      session_id='$up_session_id',status='$up_status'
	                      WHERE q_paper_id='$update_id' ";
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
	   $query_g      =   "DELETE FROM q_paper WHERE q_paper_id='$delete_id'";                     //delete query
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
<?php echo "<h1 style='color:maroon'>Wellcome ".($_SESSION['user_name']."</h1>"); ?>
</td>
<td style="height:70px; width:250px;text-align:center;"><button style="width:120px;cursor:pointer;" class="testbutton" name="sign_out" />Sign Out </button>
</td>
</tr>
<tr>
<td colspan="2">
<div id="stylefour">
	<ul>
	<li><a href="user.php" title=""><span>User</span></a></li>
	<li><a href="user_type.php" title=""><span>User type</span></a></li>
	<li><a href="session.php" title=""><span>Session</span></a></li>
	<li><a href="program.php" title="" class="current"><span>Program</span></a></li>
	<li><a href="course.php" title=""><span>Course</span></a></li>
	<li><a href="std_course_alloc.php" title=""><span>Student Course Allocation</span></a></li>
	<li><a href="teach_course_alloc.php" title=""><span>Teacher Course Allocation</span></a></li>
	<li><a href="question_paper_type.php" title=""><span>Question-Paper-Type</span></a></li>
	<li><a href="question_paper.php" title=""><span>Question-Paper</span></a></li>
	<li><a href="questions.php" title=""><span>Questions</span></a></li>
	<li><a href="date_sheet.php" title=""><span>Date-Sheet</span></a></li>
	</ul>
	</div>
</td>
</tr>
</table>
</form>

	<br>
<h1 align="center" style="color:white;" >Question Paper Details</h1>
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
     <table align="center">
   
  <tr align="right">
                                 
                                   <td id="td3">Question-Paper Name :</td>
                                   <td>
	 
	 <input type                  =                "text"
	        name                  =                "q_p_name"
	        placeholder           =                "Qusetion-Paper Name"
	        value                 =                "<?php if(isset($edit_q_paper_name)) echo $edit_q_paper_name; ?>"
	        required                                />
	                                                      </td>
														  
                                   <td id="td3">Total Marks :</td>
                                   <td>
	 <input type                  =                 "text" 
	        name                  =                 "t_m" 
	        placeholder           =                 "Total Marks" 
	        value                 =                 "<?php if(isset($edit_total_marks)) echo $edit_total_marks; ?>" 
	        required                                 />
			                                                 </td>
															 </tr>
															 <tr align="right">
                    <td id="td3">Total Number Of Questions :</td>
                <td >
	<input type                   =                  "text"
	       name                   =                  "t_n_q"
	       placeholder            =                  "Total Number Of Questions"
	       value                  =                  "<?php if(isset($edit_total_num_question)) echo $edit_total_num_question; ?>"
	       required                                   />
		                                                   </td>
					<td id="td3">Select User :</td>
                                    <td>
	<select style="float:right;" name   =  "u_type_id">                                     <?php // select user type  
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
		     <?php if(isset($edit_u_type_id) && ($edit_u_type_id==$row_c["u_type_id"]))
				 { ?> selected <?php } ?> >
		     <?php echo $row_c["u_type"]; ?>
    </option>
		<?php
	}                         
	?>
	</select>
	                                                          </td>
									
  </tr>
  
  <tr align="right">
                                    <td id="td3">Session :</td>
                                    <td><select style="float:right;" name    =     "session_id" >                                              <?php // Select Program ?>

                                                                                    	<?php // send primary key to foreign key ?>
	<?php                                                                    
	$query_d="SELECT * FROM session";                             
	$result_d=mysqli_query($con,$query_d);
	while($row_d=mysqli_fetch_array($result_d))             //fetch program_id and program_name from program table row by row
	{
		?>                                                                  <?php//drop down of options from program table ?>
		                                                                    <?php//selected attribute use on condition ?>
		<option value="<?php echo $row_d["session_id"]; ?>" 
		<?php if(isset($edit_session_id) && ($edit_session_id==$row_d["session_id"]))
			{ ?> selected <?php } ?> > 
		<?php echo $row_d["a_session"]; ?></option>                         
		<?php
	}
	?>
	</select>
	
	                                </td>
															  
                                          <td id="td3"> Select Question Paper Type :</td>
                                          <td>
	<select style="float:right;" 
	name    =     "q_t_id" >                                              <?php // Select Program ?>

                                                                                    	<?php // send primary key to foreign key ?>
	<?php                                                                    
	$query_d="SELECT * FROM q_paper_type";                             
	$result_d=mysqli_query($con,$query_d);
	while($row_d=mysqli_fetch_array($result_d))             //fetch program_id and program_name from program table row by row
	{
		?>                                                                  <?php//drop down of options from program table ?>
		                                                                    <?php//selected attribute use on condition ?>
		<option value="<?php echo $row_d["q_paper_type_id"]; ?>" 
		<?php if(isset($edit_q_paper_type_id) && ($edit_q_paper_type_id==$row_d["q_paper_type_id"]))
			{ ?> selected <?php } ?> > 
		<?php echo $row_d["ques_type"]; ?></option>                         
		<?php
	}
	?>
	</select>
	                                                           </td>
  </tr>
  
  <tr align="right">
                          
															 
                                   <td id="td3">Status :</td>
                                   <td >
								   <select style="float:right;" name   =   "status">
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
		                                                  
  </tr>
  
  <tr>                                                                               <?php// button?>
    <td     colspan     =   "4"
            id          =   "td4" ><br><br>
	<button style       =   "cursor:pointer;"
	        class       =   "testbutton"
	        name        =   "<?php echo $btn; ?>" >                      <?php //initially $btn="Add" on edit $btn="Update" ?>
	        <?php   echo $btn; ?>
    </button>
			                                                    </td>
  </tr>
  
      </table>
        </form>
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
   $query_b="SELECT u.u_type_id,u.u_type,s.session_id,s.a_session,t.q_paper_type_id,t.ques_type,
   p.q_paper_id,p.q_paper_name,p.total_marks,p.total_num_question,p.u_type_id,
   p.q_paper_type_id,p.session_id,p.status From user_type u, session s,q_paper_type t,q_paper p WHERE
   (u.u_type_id=p.u_type_id && t.q_paper_type_id=p.q_paper_type_id && s.session_id=p.session_id)";               // query for display all data
   $result_b=mysqli_query($con,$query_b);
?>
 <table align="center" border="5"  class="pclr" >
  <tr align="center">
    <td>Question Paper ID</td>
    <td>Question Paper Name</td>
    <td>Total Marks</td>
    <td>Total No of Questions</td>
    <td>User Type</td>
    <td>Question Paper Type</td>
    <td>Session</td>
    <td>Status</td>
    <td colspan="2">Operations</td>
</tr>
<?php
  while($row_b=mysqli_fetch_array($result_b))
  {
	 ?>
  <tr align="center">
            
			 <td align="center">    <?php echo $row_b["q_paper_id"];            ?>        </td>
             <td align="left">      <?php echo $row_b["q_paper_name"];          ?>        </td>
             <td align="center">    <?php echo $row_b["total_marks"];           ?>        </td>
             <td align="center">    <?php echo $row_b["total_num_question"];    ?>        </td>
             <td align="left">      <?php echo $row_b["u_type"];                ?>        </td>
             <td align="center">    <?php echo $row_b["ques_type"];             ?>        </td>
             <td align="center">    <?php echo $row_b["a_session"];             ?>        </td>
             <td align="center">    <?php echo $row_b["status"];                ?>        </td>
			 <td>
			 <a style="color:white" href="question_paper.php?edit_id=<?php echo $row_b["q_paper_id"]; ?>">Edit</a>
			                                                                      </td>
             <td>
			 <a style="color:white" href="question_paper.php?delt_id=<?php echo $row_b["q_paper_id"]; ?>">Delete</a>
			                                                                      </td>
  </tr>
	<?php
}
?>
            
</table>
                                             
<!---------------------------------------------------Section 3 End----------------------------------------------------------->




									 
									 