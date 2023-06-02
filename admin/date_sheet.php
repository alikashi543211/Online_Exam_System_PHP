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
<?php
            // start of session
			
   //connection file 
?>
<html>
   <head>
   
       <link rel="shortcut icon" href="d.jpg" />                        <?php // short cut icon ?>
	   <link rel="stylesheet" href="style.css" type="text/css" />
       <link rel="stylesheet" href="stylesheet.css" type="text/css" />  <?php // stylesheet linked ?>
    <title>
Admin/Date-Sheet
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
                                                       
	
	$schedule   =   $_POST['schedule'];                          
	$date       =   $_POST['date'];                                                    
	$time       =   $_POST['time']; 
    $q_paper_id =   $_POST['q_paper_name'];	
	$status=$_POST['status'];
    $query_a = "INSERT INTO 
	          date_sheet(schedule,date,time,q_paper_id,status)     
	          VALUES('$schedule','$date','$time','$q_paper_id','$status')"; //insertion query
			  
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
		   $query_e      =    "SELECT * FROM date_sheet where schedule_id = $edit_id ";    //select row from database on particular id query
		   $result_e     =    mysqli_query($con,$query_e);                    // query run
		   while($row_e  =    mysqli_fetch_array($result_e))               // row on particular id is fetching
		   
		   {
		// coloumns data is fetching and saving into variable from a particular row id
		   	$edit_schedule  =   $row_e['schedule'];                          
	           $edit_date   =   $row_e['date'];                                                    
	           $edit_time   =   $row_e['time']; 
          $edit_q_paper     =   $row_e['q_paper_id'];	
	          $edit_status  =   $row_e['status'];
		   }
		     $check_edit="Ready to edit and update.";                  //check values fetched
	   }
?>
<!----------------------------------------------- ---Section 4 End----------------------------------------------------------->













<!---------------------------------------------------Section 5--------------------------------------------------------------->
                                         <!--Updation Of Student Data-->
		<?php
		if(isset($_POST['Update']))
		{
	$update_id        =  $_REQUEST['edit_id'];                                                   // edit_id from url
	$up_schedule      =  $_POST['schedule'];
	$up_time          =  $_POST['time'];
	$up_date          =  $_POST['date'];                                                      // values are coming after edit 
	$up_q_paper_id    =  $_POST['q_paper_name'];
	$status           =  $_POST['status'];         
                                                                                            // update query
	   $query_f       =    "UPDATE date_sheet SET schedule='$up_schedule',date='$up_date'
	                        ,time='$up_time',q_paper_id='$up_q_paper_id',status='$status'
							WHERE schedule_id='$update_id' ";
	   $result_f      =     mysqli_query($con,$query_f);                                     // query run
	   
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
	   $query_g      =   "DELETE FROM date_sheet WHERE schedule_id='$delete_id'";                     //delete query
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
<?php

include "header.php";

?>
</td>
</tr>
</table>
</form>

	<br>
<h1 align="center" style="color:white;" >Exams Schedule</h1>
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
   
  <tr>
                                 <td id="td3">Enter Schedule:</td>
     <td>
	 
	 <input type                 =              "text"
	        name                 =              "schedule"
	        placeholder          =              "Schedule"
	        value                =              "<?php if(isset($edit_schedule))  echo $edit_schedule;  ?>"
	        required                             />
			                                             </td>
	                                     
	 
                                   <td id="td3" >Select Date:</td>
                                   <td>
	 
	 <input type                  =                "date"
	        name                  =                 "date"
	        placeholder           =                "Select Date"
	        value                 =                "<?php if(isset($edit_date)) echo $edit_date; ?>"
	        required                                />
	                                                      </td>
														  
  </tr>
  <tr>
                                   <td id="td3" >Select Time:</td>
                                   <td>
	 <input type                  =                 "time" 
	        name                  =                 "time" 
	        placeholder           =                 "Contact Number" 
	        value                 =                 "<?php if(isset($edit_time)) echo $edit_time; ?>" 
	        required                                 />
			                                                 </td>
															 
                                   <td id="td3">Select Question-Paper:</td>
                                   <td >
	<select name   =  "q_paper_name">                                     <?php // select user type  
	                                                                  // send value primary key to foreign key                   ?>
	<?php
	$query_c="Select * FROM q_paper";                                 
	$result_c=mysqli_query($con,$query_c);                          
	?>
	<?php
	while($row_c=mysqli_fetch_array($result_c))
                                                  		    //fetch user_type_id and user_type_name from user_type_table
	{            
                                                         	//value  user_type_id from user_type table from database
                                                                   //dropdown options are user_type_name from user_type table                                                    
	?>                                                               <?php //options from user_type table  ?>
	<option  value="<?php echo $row_c["q_paper_id"]; ?>"   
		     <?php if(isset($edit_q_paper_id) && ($edit_q_paper_id==$row_c["q_paper_id"]))
				 { ?> selected <?php } ?> >
		     <?php echo $row_c["q_paper_name"]; ?>
    </option>
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
   $query_b="SELECT p.q_paper_id,p.q_paper_name,
   d.schedule_id,d.schedule,d.date,d.time,d.q_paper_id,d.status
   FROM date_sheet d,q_paper p where p.q_paper_id=d.q_paper_id";               // query for display all data
   $result_b=mysqli_query($con,$query_b);
?>
 <table align="center" border="5" class="pclr" >
  <tr align="center">
    <td>Schedule_ID</td>
    <td>Schedule</td>
    <td>Date</td>
    <td>Time</td>
	<td>Question-Paper</td>
    <td>Status</td>
    <td colspan="2">Operations</td>
</tr>
<?php
 while($row_b=mysqli_fetch_array($result_b))
  {
	 ?>
  <tr align="center">
             <td align="center">    <?php echo $row_b["schedule_id"];       ?>        </td>
             <td align="left">      <?php echo $row_b["schedule"];          ?>        </td>
             <td align="left">      <?php echo $row_b["date"];             ?>        </td>
             <td align="center">    <?php echo $row_b["time"];             ?>        </td>
			 <td align="center">    <?php echo $row_b["q_paper_name"];             ?>        </td>
             <td align="center">    <?php echo $row_b["status"];           ?>        </td>
             <td>
			 <a style="color:white" href="date_sheet.php?edit_id=<?php echo $row_b["schedule_id"]; ?>">Edit</a>
			                                                                      </td>
             <td>
			 <a style="color:white" href="date_sheet.php?delt_id=<?php echo $row_b["schedule_id"]; ?>">Delete</a>
			                                                                      </td>
  </tr>
	<?php
}
?>
            
</table>
                                             
<!---------------------------------------------------Section 3 End----------------------------------------------------------->




									 
									 