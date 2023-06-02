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
            // start of session  //connection file 
?>
<html>
   <head>
   
       <link rel="shortcut icon" href="d.jpg" />                        <?php // short cut icon ?>
	   <link rel="stylesheet" href="style.css" type="text/css" />
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
    if(isset($_POST['Add']) && !isset($_POST['Refresh']) && !isset($_POST['Update'])) 	
{                                                                 // insertion into database
                                                       
	
	$question  =   $_POST['question'];                          
	$marks   =   $_POST['marks'];                           
	$q_paper_id   =   $_POST['q_paper_id'];                         
	$status     =   $_POST['status'];                             

	      
    $query_a = "INSERT INTO 
	          question(question,q_marks,q_paper_id,status)     
	          VALUES('$question','$marks','$q_paper_id','$status')"; //insertion query
			  
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
       if(isset($_REQUEST['edit_id']) && !isset($_POST['Add']) && !isset($_POST['Refresh']) && !isset($_POST['Update']))
	   {
		   $btn          =    "Update";
		   $edit_id      =    $_REQUEST['edit_id'];                            // edit_id from url
		   $query_e      =    "SELECT * FROM question where question_id=$edit_id ";    //select row from database on particular id query
		   $result_e     =    mysqli_query($con,$query_e);                    // query run
		   while($row_e  =    mysqli_fetch_array($result_e))               // row on particular id is fetching
		   
		   {
			// coloumns data is fetching and saving into variable from a particular row id
		   $edit_question      =   $row_e['question'];
		   $edit_marks      =   $row_e['q_marks'];
		   $edit_q_paper_id     =   $row_e['q_paper_id'];
		   $edit_status         =   $row_e['status'];
		   }
		     $check_edit="Ready to edit and update.";                  //check values fetched
	   }
?>
<!---------------------------------------------------Section 4 End----------------------------------------------------------->
<!--------------------------------------------------------Section 7----------------------------------------------------------->
<?php
if(isset($_POST['Refresh']))
{
	
}
?>
<!----------------------------------------------- ---Section 7 End----------------------------------------------------------->












<!----------------------------------------------- ---Section 5--------------------------------------------------------------->
                                        <!--Updation Of Student Data-->
		<?php
		if(isset($_POST['Update']) && !isset($_POST['Add']) && !isset($_POST['Refresh']))
		{
	$update_id   =  $_REQUEST['edit_id'];          // edit_id from url
	$up_question =  $_POST['question'];
	$up_marks    =  $_POST['marks'];
	$up_q_paper_id =  $_POST['q_paper_id'];
	$up_status     =  $_POST['status'];         
                                                                                            // update query
	   $query_f      =    "UPDATE question SET question='$up_question', 
	                      q_marks='$up_marks',q_paper_id='$up_q_paper_id',status='$up_status'
	                      WHERE question_id='$update_id' ";
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
   if(isset($_REQUEST['delt_id']) && !isset($_POST['Add']) && !isset($_POST['Refresh']) && !isset($_POST['Update']))
   {
	   $delete_id    =   $_REQUEST['delt_id'];                                              // id from url
	   $query_g      =   "DELETE FROM question WHERE question_id='$delete_id'";                     //delete query
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
<h1 align="center" style="color:white;" >Question Details</h1>
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
                                 <td id="td3">Question:</td>
     <td>
	 
	 <input type                 =              "text"
	        name                 =              "question"
	        placeholder          =              "Enter Question"
	        value                =              "<?php if(isset($edit_question))  echo $edit_question;  ?>"
	        required                             />
			                                             </td>
	                                     
	 
                                   <td id="td3">Question Marks</td>
                                   <td>
	 <input type                  =                "text"
	        name                  =                "marks"
	        placeholder           =                "Enter Marks"
	        value                 =                "<?php if(isset($edit_marks)) echo $edit_marks; ?>"
	        required                                />
	                                                      </td>
														  
  </tr>
  
  <tr>
                                    <td id="td3">Select Question Paper :</td>
                                    <td>
	<select name   =  "q_paper_id">                                     <?php // select user type  
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
			                                                    </td></form>
																<form method="post"><td     colspan     =   "4"
            id          =   "td4" >
	<button style       =   "cursor:pointer;"
	        class       =   "testbutton"
	        name        =   "<?php echo "Refresh"; ?>" >                      <?php //initially $btn="Add" on edit $btn="Update" ?>
	        <?php   echo "Refresh"; ?>
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
   $query_b="SELECT p.q_paper_id,p.q_paper_name,q.question_id,q.question,q.q_marks,q.q_paper_id,q.status from question q,q_paper p Where q.q_paper_id=p.q_paper_id";               // query for display all data
   $result_b=mysqli_query($con,$query_b);
?>
 <table align="center" border="5" class="pclr" >
  <tr align="center">
    <td>Question ID</td>
    <td>Question</td>
    <td>Marks</td>
    <td>Question Paper</td>
    <td>Status</td>
    <td colspan="2">Operations</td>
</tr>
<?php
 while($row_b=mysqli_fetch_array($result_b))
  {
	 ?>
  <tr align="center">
             <td align="center">    <?php echo $row_b["question_id"];       ?>        </td>
             <td align="left">      <?php echo $row_b["question"];          ?>        </td>
             <td align="marks">      <?php echo $row_b["q_marks"];      ?>        </td>
             <td align="center">    <?php echo $row_b["q_paper_name"];    ?>        </td>
             <td align="center">    <?php echo $row_b["status"];        ?>        </td>
             <td>
			 <a style="color:white" href="questions.php?edit_id=<?php echo $row_b["question_id"]; ?>">Edit</a>
			                                                                      </td>
             <td>
			 <a style="color:white" href="questions.php?delt_id=<?php echo $row_b["question_id"]; ?>">Delete</a>
			                                                                      </td>
  </tr>
	<?php
}
?>
            
</table>
                                             
<!---------------------------------------------------Section 3 End----------------------------------------------------------->




									 
									 