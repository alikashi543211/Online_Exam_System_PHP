










<?php
session_start();
include "connection.php";
unset($_SESSION['disp_ans']);
$q_paper_id=$_SESSION['q_paper_id'];
?>





















<?php
// --------------------------------------------------After Clicking On Button Display Edit / Update / Delete-----------------------------------------
unset($_SESSION['edit_update']);
if (isset($_REQUEST['edit_question_id']) )
{
	//if(isset($_SESSION['refresh']))
	{
	$_SESSION['edit_update']="a";
	}
	
}

?>
<?php

if(isset($_GET['refresh']))
{
	unset($_SESSION['refresh']);
}
// --------------------------------------------------/After Clicking On Button Edit / Update / Delete-----------------------------------------
?>


























































<?php
//$_SESSION['ready_edit_mode']="a";
/*
if(isset($_POST['next2']))
{
	//unset($_SESSION['save_paper']);
	 //$_SESSION['ready_edit_mode']="Paper is ready For Edit.";
}
*/















// __________________________________________ Save Paper Button  ________________________________________________
?>

































<!----------------------------------------------- Background-Color ------------------------------------------------------>
<body style="background-color:lightgrey;">
<?php  if(isset($_SESSION['refresh'])) { ?>

<?php
}
?>

</body>
<!----------------------------------------------- /Background-Color ------------------------------------------------------>




















<?php

/*
if(isset($_SESSION['save_paper']))
{
	
	?>
	<form align="center" method="post">
	<input style="cursor:pointer;width:250px;height:50px;color:black;border-radius:4px;" type="submit" name="save_paper" value="Save Paper" />
	</form>
	<?php
}
?>

<?php
if(isset($_POST['save_paper']))
{
	?>
	<form method="post">
	<table border="2" align="left">
	<tr>
	<td>Enter File Name :</td>
	<td><input type="text" name="file_name" placeholder="Enter name of paper" required /></td>
	</tr>
	<tr>
	<td align="right" ><input style="cursor:pointer;width:100px;height:30px;color:black;border-radius:4px;" type="submit" name="save_in_word" value="Save" /></td>
	<td align="right" ><input style="cursor:pointer;width:100px;height:30px;color:black;border-radius:4px;" type="submit" name="next2" value="Next" /></td>
	</tr>
	</table>
	</form>
	<?php
}
?>



<?php
// __________________________________________ /Save Paper Button ___________________________________________________ */




















if(isset($_SESSION['mix_paper']))
{
$mix=$_SESSION['mix_paper'];
}
//_______________________________________Single Objective Subjective Paper Display_______________________________________

/*if(isset($_POST['display_paper']))
{
	header ("Location:single_obj_sub_print.php");
}
*/
//_______________________________________/Single Objective Subjective Paper Display_______________________________________


?>








<?php
//_________________________________________  Edit Mode Buttons  _____________________________________________
//unset($_SESSION['answers_set']); // answers set set session off by default
//unset($_SESSION['obj_type']);





































if(isset($_POST['obj_type'])) // when we click on edit questions(objective Type)
{
	$_SESSION['obj_type']=$_SESSION['objective_type'];
}


























else if(isset($_POST['edit_ans'])) // When we click on edit answers
{
	unset($_SESSION['obj_type']);
	$_SESSION['disp_ans']="Display Set.";
	//$_SESSION['answers_set']="Answers Sheet Has Displayed."; // set answers limit the 
	//header ('Location:obj_answer_sheet.php');
	header ("Location:obj_answer_sheet.php");
	
}




















if(isset($_POST['set_ans']))
{
	//$_SESSION['ready_edit_mode']="Ready To Set Answers";
	$_SESSION['disp_ans']="a";
	//$_SESSION['answers_set']; // set answers limit the button
	//header ('Location:obj_answer_sheet.php');
	header ('Location:obj_answer_sheet.php');
}


//_________________________________________  /Edit Mode Buttons  _____________________________________________
?>












































<?php 

if(isset($_POST['delete_all']))
{
	if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='MCQs')
	{
	$query_k="DELETE FROM question";
	}
	else if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='Fill in Blanks')
	{
      $query_k="DELETE FROM fb_questions";
	}
	else if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='True False')
	{
	$query_k="DELETE FROM tf_questions";
	}
	
	$result_k=mysqli_query($con,$query_k);
	if($result_k)
	{
		$check_k="All Questions Deleted Successully.";
		unset($_SESSION['done']);
	}
}

?>


















<?php // _________________________________________*Insert Question*_______________________________________________--> ?>

<?php
if(isset($check_k))
{
      ?> <h1 style="color:red;text-align:center;"><?php echo $check_k; ?></h1> <?php
}
//------------------------------------------------On Setting Of Done Button----------------------------------------------->		
if(isset($_POST['done']))
	{
		 $q_paper_id=$_SESSION['q_paper_id'];
		 $status=$_POST['status'];
		 
	 
//______________________________________Multiple Choice Questions_____________________________________________________		
		 if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='MCQs')
		 {
		 foreach($_POST['question_discription'] as $question)
		{	
		$query_c="INSERT INTO question(question,q_paper_id,status)
		                        VALUES('$question','$q_paper_id','$status') ";
		$result_c=mysqli_query($con,$query_c);
		}

		 if(!isset($mix))
		 {
		$_SESSION['done']="done";
		   }
		else if(isset($mix))
		      {
		    $_SESSION['single_obj']="You have choiced one Objective Option.";
			header ("Location:obj_answer_sheet.php");
		             }						 
			
	    }
//______________________________________/Multiple Choice Questions_____________________________________________________		
		
		
		
		
		
		
		
		
//_____________________________________ True False________________________________________________		
		else if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='True False')
		 {
		 foreach($_POST['question_discription'] as $question)
		{	
		$query_c="INSERT INTO tf_questions(question,q_paper_id,status)
		                        VALUES('$question','$q_paper_id','$status') ";
		$result_c=mysqli_query($con,$query_c);
		}
		if(!isset($mix))
		 {
		$_SESSION['done']="done";
		   }
		else if(isset($mix))
		      {
		    $_SESSION['single_obj']="You have choiced one Objective Option.";
			header ("Location:obj_answer_sheet.php");
		             }
		 }
//_________________________________________/True False__________________________________________________








//______________________________________Fill in Blanks_____________________________________________________		
		else if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='Fill in Blanks')
		 {
		 foreach($_POST['question_discription'] as $question)
		{	
		$query_c="INSERT INTO fb_questions(question,q_paper_id,status)
		                        VALUES('$question','$q_paper_id','$status') ";
		$result_c=mysqli_query($con,$query_c);
		}
		
		 if(!isset($mix))
		 {
		$_SESSION['done']="Done";
		   }
		else if(isset($mix))
		      {
		    $_SESSION['single_obj']="You have choiced one Objective Option.";
			header ("Location:obj_answer_sheet.php");
		             }
	    }
//______________________________________/Fill in Blanks_____________________________________________________		
		
	} // End Of Done Post...
	?>

<?php // _________________________________________*/Insert Question*________________________________________________--> ?>























<?php
//_______________________________________________Edit Question___________________________________________________________-->
/*if(isset($_REQUEST['edit_question_id']) && !isset($_SESSION['edit_recycle_bin']) ||
   isset($_REQUEST['edit_question_id']) &&  $_REQUEST['edit_question_id']!=$_SESSION['edit_recycle_bin']) */
   if(isset($_REQUEST['edit_question_id']))
{
	$_SESSION['edit_question_id']=$_REQUEST['edit_question_id'];
	$edit_question_id=$_SESSION['edit_question_id'];
	if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='MCQs')
	{
	$query_f="SELECT * FROM question WHERE question_id='$edit_question_id' ";
	}
	else if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='Fill in Blanks')
	{
	$query_f="SELECT * FROM fb_questions WHERE question_id='$edit_question_id' ";
	}
	else if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='True False')
	{
	$query_f="SELECT * FROM tf_questions WHERE question_id='$edit_question_id' ";
	}
	
	$result_f=mysqli_query($con,$query_f);
	while($row_f=mysqli_fetch_array($result_f))
	{
		$edit_question=$row_f['question'];
		$edit_q_paper_id=$row_f['q_paper_id'];
		$edit_status=$row_f['status'];
	}
	$check="Values are ready for edit.";
	$_SESSION['edit_recycle_bin']=$_SESSION['edit_question_id'];

}

//_________________________________________________/Edit Question________________________________________________________-->
















//____________________________________________Update Question________________________________________________________-->
if(isset($_POST['Update']) )
{
	$_SESSION['refresh']="SET";
	  $update_id=$_SESSION['edit_question_id'];
	  $update_question=$_POST['update_question'];
	  $update_status=$_POST['update_status'];
	  if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='MCQs')
	  {
	  $query_e="UPDATE question SET question='$update_question', status='$update_status' WHERE question_id='$update_id' ";
	  }
	  else if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='Fill in Blanks')
	  {
	  $query_e="UPDATE fb_questions SET question='$update_question', status='$update_status' WHERE question_id='$update_id' "; 
	  }
	  else if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='True False')
	  {
	  $query_e="UPDATE tf_questions SET question='$update_question', status='$update_status' WHERE question_id='$update_id' ";   
	  }
	  $result_e=mysqli_query($con,$query_e);
	if($result_e)
	{
		 $check="Question Updated Successfully.";
	}
}
//_____________________________________________/Update Question________________________________________________________-->




















//_____________________________________________Delete Question________________________________________________________-->

if(isset($_REQUEST['delete_question_id']) && !isset($_SESSION['delete_recycle_bin']) ||
   isset($_REQUEST['delete_question_id']) && $_REQUEST['delete_question_id']!=$_SESSION['delete_recycle_bin'])
{
	 $_SESSION['delete_question_id']=$_REQUEST['delete_question_id'];
	 $delete_question_id=$_SESSION['delete_question_id'];
	 if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='MCQs')
	 {
	 $query_g="DELETE FROM question WHERE question_id='$delete_question_id' ";
	 }
	 else if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='Fill in Blanks')
	 {
	 $query_g="DELETE FROM fb_questions WHERE question_id='$delete_question_id' ";
	 } 
	  else if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='True False')
	 {
	 $query_g="DELETE FROM tf_questions WHERE question_id='$delete_question_id' ";
	 } 
	 
	 $result_g=mysqli_query($con,$query_g);
	 if($result_g)
	{
		 $check="Question Deleted Successfully.";
		 $_SESSION['quan_mcq']=$_SESSION['quan_mcq']-1;
		 $_SESSION['t_marks_mcq']=$_SESSION['t_marks_mcq']-$_SESSION['each_mcq'];
		 
		 $_SESSION['delete_recycle_bin']=$_SESSION['delete_question_id'];
	}
}	
//_____________________________________________/Delete Question________________________________________________________-->
?> 









<?php
// __________________MCQS FORMATE_______________________-->
if(isset($_SESSION['mcq_objective']))
{
	$_SESSION['objective_type']=$_SESSION['mcq_objective'];
	$obj_total_marks=$_SESSION['t_marks_mcq'];
	$_SESSION['obj_total_marks']=$obj_total_marks;
	$num_of_questions=$_SESSION['quan_mcq'];
	$_SESSION['num_of_questions']=$num_of_questions;
	$marks_of_each=$_SESSION['each_mcq'];
    $_SESSION['marks_of_each']=$marks_of_each;	
	$question_number=1;
	//**************************
	
	unset ($_SESSION['t_marks_fb']);
	unset ($_SESSION['t_marks_tf']);
	unset ($_SESSION['quan_fb']);
	unset ($_SESSION['quan_tf']);
	unset ($_SESSION['each_fb']);
	unset ($_SESSION['each_tf']);
	
	//*****************************
}
//   _____________________/MCQS FORMATE_______________________-->



// __________________TRUE FALSE FORMATE_______________________-->
else if(isset($_SESSION['tf_objective']))
{
	$_SESSION['objective_type']=$_SESSION['tf_objective'];
	$obj_total_marks=$_SESSION['t_marks_tf'];
	$_SESSION['obj_total_marks']=$obj_total_marks;
	$num_of_questions=$_SESSION['quan_tf'];
	$_SESSION['num_of_questions']=$num_of_questions;
	$marks_of_each=$_SESSION['each_tf'];
    $_SESSION['marks_of_each']=$marks_of_each;	
	$question_number=1;
	
		//**************************
	
	unset ($_SESSION['t_marks_mcq']);
	unset ($_SESSION['t_marks_fb']);
	unset ($_SESSION['quan_mcq']);
	unset ($_SESSION['quan_fb']);
	unset ($_SESSION['each_mcq']);
	unset ($_SESSION['each_fb']);
	
	//*****************************
	
}
// __________________/TRUE FALSE FORMATE_______________________-->



// __________________FILL IN BLANKS FORMATE_______________________-->
else if(isset($_SESSION['fb_objective']))
{
	$_SESSION['objective_type']=$_SESSION['fb_objective'];
	$obj_total_marks=$_SESSION['t_marks_fb'];
	$_SESSION['obj_total_marks']=$obj_total_marks;
	$num_of_questions=$_SESSION['quan_fb'];
	$_SESSION['num_of_questions']=$num_of_questions;
	$marks_of_each=$_SESSION['each_fb'];
    $_SESSION['marks_of_each']=$marks_of_each;	
	$question_number=1;
	
		//**************************
	
	unset ($_SESSION['t_marks_tf']);
	unset ($_SESSION['t_marks_mcq']);
	unset ($_SESSION['quan_tf']);
	unset ($_SESSION['quan_mcq']);
	unset ($_SESSION['each_tf']);
	unset ($_SESSION['each_mcq']);
	
	//*****************************
}
// __________________FILL IN BLANKS FORMATE_______________________-->


else
{
	unset($_SESSION['objective_type']);                //Unset Objective Type
}
?>


















<!--


<?php //________________________Header_________________________________________________-->  ?>

<h3 align="center" style="color:red;">Question Paper = <?php // echo $_SESSION['course_name']; ?></h3>
<h3 align="center" style="color:red;">Question Paper Type = <?php // echo $_SESSION['q_paper_type']; ?></h3>
<h3 align="center" style="color:red;">Total Marks = <?php // echo $obj_total_marks; ?></h3>
<h3 align="center" style="color:red;">Paper Formate = <?php // echo $_SESSION['paper_formate']; ?></h3>
<h3 align="center" style="color:red;">Objective Type = <?php // echo "<span style='font-size:40px;color:green;'>".$_SESSION['objective_type']."</span>"; ?></h3>
<h3 align="center" style="color:red;">Number Of Questions = <?php // echo $num_of_questions; ?></h3>

<?php 
      //_______________________Header___________________________________________________-->  ?>
	
-->




 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 









<html>
<head>
<title>
Objective Paper
</title>
</head>
<body style="background-color:white;">






<?php // ----------------------------------------- Sign Out Button ----------------------------------------------------- ?>
<form style="float:right;" action="../index.php" method="post">
<input style="height:50px;width:100px;background-color:navy;color:white;cursor:pointer;" type="submit" class="testbutton" name="sign_out" value="Sign Out" />
</form>
<?php // ----------------------------------------- /Sign Out Button ----------------------------------------------------- ?>






<?php // ----------------------------------------- Create New Paper ----------------------------------------------------- ?>
<form style="float:right;" action="courses.php" method="post">
<input style="height:50px;width:200px;background-color:navy;color:white;cursor:pointer;" type="submit" class="testbutton" name="sign_out" value="Create New Paper" />
</form>
<?php // ----------------------------------------- /Create New Paper ----------------------------------------------------- ?>
<br>











<h2 align="left" style="font-size:35px;color:purple;text-align:center">Objective Paper (<span style="font-size:25px;"> <?php echo $_SESSION['objective_type']; ?> </span>) </h2>

<br><br><br>






























<?php
/*
// ____________________________________________  Objective Type Name  ___________________________________________________
if(isset($_SESSION['t_marks_mcq']))
{
echo "<h1 style='color:purple;'>MCQs Paper</h1>";	
}
else if(isset($_SESSION['t_marks_tf']))
{
echo "<h1 style='color:purple;'>True False Paper</h1>";	
}
else if(isset($_SESSION['t_marks_fb']))
{
echo "<h1 style='color:purple;'>Fill in Blanks Paper</h1>";	
}

// ____________________________________________  /Objective Type Name  ___________________________________________________


 */ ?>











<?php // ___________________________________ Paper Creation Complete __________________________________________ ?>

<?php 

if(isset($_SESSION['ready_edit_mode']))
{
	?>
	<!--<h1 align="center" style="color:red;">Paper has been Created Successfully....</h1>-->
	<?php
}

?>
<?php // ___________________________________ /Paper Creation Complete __________________________________________ ?>

































<!--*******************************************INPUT*******************************************************************-->   
<?php
if(!isset($_SESSION['done']))
{
	
	if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='MCQs')
	{
	?>
	
<h1 style="color:green;" align="center">Enter '<span style="color:red;">MCQs</span>' Questions</h1>
<?php
	}
?>
<?php 
     if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='Fill in Blanks')
	 {
		 ?>
<h1 style="color:green;" align="center">Enter '<span style="color:red;">Fill in Blanks</span>' Questions</h1>
<?php
	     }
?>
<?php
if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='True False')
	 {
?>
<h1 style="color:green;" align="center">Enter '<span style="color:red;">True False</span>' Questions</h1>
<?php
	      }
?>

<!--___________________Questions_____________________-->
	<form method="POST" >
	<table align="center">
	<?php
	
	for($i=1;$i<=$num_of_questions;$i++)
	{
		
	?>
	
 <tr>
	<td>
	    <table border="1">
	             <tr>
	                <td><?php  echo "Question".$question_number++.":"; ?> &nbsp;&nbsp;&nbsp;&nbsp; </td> <?php // Question Numbering...?>
	                 <td><input style="padding:5px;border:none;height:30px;width:1050px;" type="text" name="question_discription[]" required /></td>     <?php //Question Discription... ?>
	                  <td>
					  <?php  echo "(".$marks_of_each.")"; ?>
					  </td>    <?php //Question Marks... ?>
					   <td><select name="status" >
						  <option value="Active" > Active </option>
						  <option value="Block" > Block  </option>
						 </select>
					    </td>
					  </tr>
	              </table>
	            </td>
            </tr>
 <?php
} 	
 ?>
<!--___________________/Questions_________________--> 



<!--___________________Button_____________________--> 
 <tr>
  <td align="center">
  <?php?>
	<br><br><br><input style="height:50px;width:200px;background-color:navy;color:white;cursor:pointer;" type="submit" name="done" value="Next" />
    </td>
   </tr>
<!--___________________/Button_____________________-->  
  </table>   <?php //End of table ?>
 </form>     <?php // End of form ?>
	<?php
 
       }
?>  
  <!--**************************************************/INPUT**********************************************************-->   

  

  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
<?php//_____________________________________________User Interface_____________________________________________________?>



































            <!-- _________________________________  Set Answers _________________________________-->
			
<?php if(isset($_SESSION['done']) && !isset($_SESSION['ready_edit_mode']) && !isset($_SESSION['save_paper'])) { ?>
<form align="center" method="post">
<input style="height:50px;width:200px;background-color:navy;color:white;cursor:pointer;" type="submit" name="set_ans" value="Set Answers" />
</form>

<?php
} // When Not Set Edit Set Mode
if(isset($_SESSION['ready_edit_mode']))
{
	$obj_type=$_SESSION['objective_type'];
}

// <!-- _________________________________  /Set Answers _________________________________-->
?>































<?php // _______________________________________ Print Paper _________________________________________________________________ ?>



<?php
//unset($_SESSION['save_as_word']);
/*if(isset($_POST['print_paper']) || isset($_POST['save_in_word']))
{
	
	/*header ("Content-type: application/vnd.ms-word");
	$file_name="True False Paper";
    header ("Content-Disposition: attachment; filename=".$file_name.".doc");
	
 	$_SESSION['save_as_word']="Paper is Ready To save as Word.";
	if(isset($_POST['file_name']))
	{
	$file_name=$_POST['file_name'];
	}
	$not_any_more="abc";
	$save_as_word="Paper is Ready For save.";
	include_once ("modify2.php");
}
*/
?>







<?php // _______________________________________ /Print Paper ___________________________________________________________________ ?>






































<?php // ____________________________________ Display Buttons After Set Answers ____________________________________________ ?>
<?php
//$_SESSION['refresh']="a";
if(isset($_SESSION['ready_edit_mode']) && !isset($_SESSION['refresh']))
{
	?>
	<form method="post" align="center">
	


	<span style="color:Navy;font-size:40px;text-align:center;"> Questions of Created Paper<br><br></span>
	
<input style="height:50px;width:200px;background-color:navy;color:white;cursor:pointer;"
<?php if (isset($_SESSION['edit_update'])) { ?> disabled <?php } ?>  type="submit" name="obj_type" value="Show <?php echo $obj_type; ?> ( Questions )" />
<?php
?>
<?php //if(!isset($_SESSION['answers_set']) || isset($_SESSION['edit_paper']))  ?>
<input style="height:50px;width:200px;background-color:navy;color:white;cursor:pointer;"
<?php if (isset($_SESSION['edit_update'])) { ?> disabled <?php } ?>  type="submit" name="edit_ans" value="Edit Answers" />
<?php  ?>
<?php //if(isset($_SESSION['answers_set']) || isset($_SESSION['edit_paper']))  ?>
<!--<input style="height:50px;width:200px;background-color:navy;color:white;cursor:pointer;" type="submit" name="ans_key" value="Answers Key <?php // echo "( ".$obj_type." )"; ?>" /> -->
<?php  ?>
<?php //if(isset($_SESSION['answers_set']) || isset($_SESSION['edit_paper']))  ?>
<input style="height:50px;width:200px;background-color:navy;color:white;cursor:pointer;"
<?php if (isset($_SESSION['edit_update'])) { ?> disabled <?php } ?>  type="submit" name="display_paper" value="Display Paper" />
<?php  ?>
<!--<input style="cursor:pointer;width:250px;height:50px;color:black;border-radius:4px;" type="submit" name="print_paper" value="Save as Paper" />-->

</form>
<?php
}
?>
<?php //  ___________________________________ /Display Buttons After Set Answers ________________________________________________ ?>

<!-- <a href="obj_question_paper.php" download="asif ali.php" >Download This Page</a> -->





























<?php
// -------------------------------------------------REFRESH-----------------------------------------------------------------
 if(isset($_SESSION['refresh'])) 
 {
	?>
	<form method="get" align="center">
<input style="height:50px;width:100px;background-color:navy;color:white;cursor:pointer;" type="submit" name="refresh" value="Refresh" />
</form>
	<?php
} 
// -------------------------------------------------REFRESH-----------------------------------------------------------------

?>













































































































<?php
// ____________________________________________ Display Of Paper ________________________________________________________________

//unset($_SESSION['save_paper']);
//$_SESSION['ready_edit_mode']="A";
if(isset($_POST['display_paper'])) // display paper work at display paper button.
{
    unset($_SESSION['obj_type']);          // obj_type session off at display of paper
	if(isset($_SESSION['set_btn1'])) /// when we come from single objective subjective paper....
	{
		header ('Location:single_obj_sub_print.php');
	}
	else
	{
	//header ('Location:print_objective_paper.php');
	unset($_SESSION['obj_type']);
	$_SESSION['answers_set']="set";
	$not_any_more="Not any more is required";
	//include_once "print_objective_paper.php";
	header ("Location:print_objective_paper.php");
	}	
}
// ____________________________________________ /Display Of Paper ________________________________________________________________

?>



























<?php
// ____________________________________________________ Display Answer Key  _______________________________________________________


if(isset($_POST['ans_key']))
{
	unset($_SESSION['obj_type']);
	unset($_SESSION['disp_ans']);
	$not_session="no set";
	include_once "ans_key.php";
}

// ____________________________________________________ /Display Answer Key  ________________________________________________________________
?>





















<?php
/*
// _______________________________________  Edit Of Questions (Database)  __________________________________________________________________

if(isset($_SESSION['obj_type']) && isset($_SESSION['done']))
{
?>




<?php
//____________________Button To Display Single Objective Subjective Question_Paper__________-->
/*
 if(isset($_SESSION['set_btn1']))
	{ 
	?>
	   <form method="post" align="center" >
	   <input style="width:150px;height:50px;background-color:lightgrey;color:black;"
   	   type="submit" name="display_paper" value="Display Paper"  />
	   </form>
	   <?php
	   }
    //__________________________________/Button To Display Single Objective Subjective Question_Paper__________-->
	
	  ?>
	  
<h1 align="center" style="color:green;"><br>Questions ( Add / Edit / Update / Delete )</h1>
<form method="POST" align="center" >
<table border="1" align="center">
<tr>
<td>Question_ID :</td>
<td><input readonly type="text" name="update_q_id"
           value="<?php if(isset($edit_question_id)) { echo $edit_question_id; } ?>"  /></td>
</tr>
<tr>
<td>Question :</td>
<td><input <?php if(isset($edit_question)) { ?>  <?php } else { ?> readonly <?php } ?> style="width:1100px;height:40px;"
           value="<?php if(isset($edit_question)) { echo $edit_question; } ?>"
		   type="text" name="update_question" required /></td>
</tr>
<tr>
<td>Question_Paper_ID :</td>
<td><input readonly type="question_paper" name="question_paper"
           value="<?php if(isset($edit_q_paper_id)) { echo $edit_q_paper_id." (".$_SESSION['course_name'].")"; } ?>"   required /></td>
</tr>
<tr>
<td>Status :</td>
<td><select name="update_status" 
    <?php if(!isset($edit_status)) { ?> disabled <?php } ?>   >
    <option value="Active" <?php if(isset($edit_status) && $edit_status=='Active') { ?> selected <?php } ?>  >Active</option>
	<option value="Block"  <?php if(isset($edit_status) && $edit_status=='Block') { ?> selected  <?php } ?>  >Block </option>
	</select>
	</td>
</tr>
<tr align="center">
<td colspan="2"><input style="cursor:pointer;width:80;height:50px;"
    <?php if(isset($edit_question_id)) { ?> <?php } else { ?> disabled <?php } ?>
     type="submit" name="Update" value="Update" /></td>
</tr>
</table>
</form>
<?php // Form To Set Answers  ?>
<?php
}

?>
<?php//_____________________________________________/User Interface_____________________________________________________?>
 */ ?>
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 <?php
//<!-----------------------------------Edit/Update/Delete------------------------------------->
   
?>

<?php if(isset($_SESSION['edit_update']) && !isset($_SESSION['refresh']))
{
	?>
 <h1 align="center" style="color:navy;">Questions (Add / Edit / Update / Delete)</h1>
 
 
 
    <form method="POST" >
                      <table border="1" align="center">
					  <?php if(!isset($_SESSION['edit_update'])) { ?>
                                   <!--<tr>
                                      <td>Question_ID :</td>
                                      <td>--><input style="padding:20px;border:none;width:900px;height:40px;" readonly type="hidden" name="update_q_id"
                                      value="<?php if(isset($edit_question_id)) { echo $edit_question_id; } ?>"  /><!--</td>
                                   </tr>-->
                                      <tr>
					  <?php } ?>
                                         <td>Question :</td>
                                         <td><input <?php if(isset($edit_question)) { ?>  <?php } else
                                             { ?> readonly <?php } ?> style="padding:20px;border:none;width:900px;height:40px;" value="<?php if(isset($edit_question)) { echo $edit_question; } ?>"type="text" name="update_question" required />
									     </td>
                                      </tr>
									  <!--
                             <tr>
                                <td>Question_Paper_ID :</td>
                                <td>--><input style="padding:20px;border:none;width:900px;height:40px;" readonly type="hidden" name="question_paper"
                                value="<?php if(isset($edit_q_paper_id)) { echo $edit_q_paper_id." (".$_SESSION['course_name'].")"; } ?>"   required /><!--</td>
                             </tr>-->
									  
                                       <tr>
                                           <td>Status :</td>
                                           <td><select style="border:none;width:900px;height:40px;" name="update_status" 
                                           <?php if(!isset($edit_status)) { ?> disabled <?php } ?>   >
                                           <option value="Active" <?php if(isset($edit_status) && $edit_status=='Active') 
	                                       { ?> selected <?php } ?>  >Active</option>
	                                       <option value="Block"  <?php if(isset($edit_status) && $edit_status=='Block')
				                           { ?> selected  <?php } ?>  >Block </option>
	                                           </select>
	                                       </td>
                                      </tr>
									  
 <tr align="center">
             <td colspan="2"><input style="height:50px;width:100px;background-color:navy;color:white;cursor:pointer;"
             <?php if(isset($edit_question_id)) { ?> <?php } else { ?> disabled <?php } ?>
              type="submit" name="Update" value="Update" /></td>
 </tr>
            </table>
                    </form>

<?php
}
//<!--------------------------------------*/*Edit/Update/Delete----------------------------------->
?>
 
























 
 
 
 
 
 
 
 
 
 
 
 
 
 

 
 
 
 
 
 
 
 
 
 
 
 
 
 
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
<!--*******_***********************************---------DISPLAY QUESTIONS ( Database )---------------********************************************************-->   

<?php
	if(isset($_SESSION['obj_type'])&& isset($_SESSION['done']) && !isset($_SESSION['edit_update']) && !isset($_SESSION['refresh']))
	{
	?>
<h1 align="center" style="color:navy;"><br><br>Questions ( <?php echo "<span style='color:red;'>".$_SESSION['obj_type']."</span>"; ?> )</h1>




	<form method="POST">
<!--_______________Questions______________-->	
	<table align="center" border="1">
	<?php
	
	if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='MCQs')
	{
	$query_d="SELECT question_id,question,q_paper_id, status FROM question WHERE q_paper_id = '$q_paper_id' ";
	}
	else if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='Fill in Blanks')
	{
	$query_d="SELECT question_id,question,q_paper_id, status FROM fb_questions WHERE q_paper_id = '$q_paper_id' ";	
	}
	else if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='True False')
	{
	$query_d="SELECT question_id,question,q_paper_id, status FROM tf_questions WHERE q_paper_id = '$q_paper_id' ";	
	}
    $result_d=mysqli_query($con,$query_d);	
	while($row_d=mysqli_fetch_array($result_d))
	{
		
	?>
	
 <tr>
	<td>
	    <table>
	                      <tr>
	                        <td><?php  echo "Question".$question_number++.":"; ?> &nbsp;&nbsp;&nbsp;&nbsp; </td> <?php // Question Numbering...?>
	                        <td><input style="padding:5px;border:none;height:30px;width:1050px;" type="text" 
		                       <?php if (isset($edit_id) && $row_d['question_id']==$edit_id) { ?>  <?php }else { ?> readonly <?php } ?> name="question_discription['<?php echo $row_d['question_id']; ?>']"
                             value="<?php { echo $row_d['question']; }  ?>"	required /></td>     <?php //Question Discription... ?>
							    <td><?php echo "(".$marks_of_each.")"; ?></td>   <?php //Question Marks... ?>
							    <td><?php echo $row_d['status'] ?></td>
								<td><a href="obj_question_paper.php?edit_question_id=<?php echo $row_d['question_id']; ?>">Edit</a></td>
								<td><a href="obj_question_paper.php?delete_question_id=<?php echo $row_d['question_id']; ?>">Delete</td>
								
							</td>
						 </tr>
	   </table>
	</td>
 </tr>
 <?php
     }
 ?>
 </form>

 


 <!--___________________Button_____________________-->
 <!--
   <form method="post" > 
	<tr>
	 <td align="center">
	   <input style="width:150px;height:50px;background-color:lightgrey;color:black;"
   	   type="submit" name="set_obj_answers" value=""  />&nbsp;&nbsp;&nbsp;</form>
	   
	  </td>
	</tr>
   </form>
   -->
<!--___________________/Button_____________________--> 

    
	
	
	</table>   <?php // End of Table.. ?>
	     <?php // End of Form.. ?>
	<?php
  }
?>  

<!--*******_***********************************---------DISPLAY QUESTIONS ( Database )---------------********************************************************-->   
</body>
</html>
