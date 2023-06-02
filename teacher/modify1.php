<a href="courses.php">Create New Paper</a>



<?php
session_start();
include "connection.php";
unset($_SESSION['obj_type']);
//unset($_SESSION['disp_ans']);
unset($_SESSION['answers_set']);

if(isset($_SESSION['mix_paper']))
{
	$mix=$_SESSION['mix_paper'];
}









// ______________________________________  Display Paper Button  _____________________________________________
unset($_SESSION['edit_ans']);

/*if(isset($_POST['disp_paper']))
{
	if(isset($_SESSION['set_btn1']))
	{
		header ("Location:single_obj_sub_print.php");
	}
else
	header ("Location:print_objective_paper.php");
}*/
if(isset($_POST['edit_ans']))
{
	$_SESSION['disp_ans']="Answers Table And Database Are Ready For Display.";
}

if(isset($_POST['edit_ques']))
{
	$_SESSION['obj_type']="Objective Questions Are Set To Display.";
	//header ('Location:obj_question_paper.php');
	header ("Location:modify.php");
}















// _____________________________________  /Display Paper Button  _______________________________________________




















//----------------------------------------------------------------------
$q_paper_id=$_SESSION['q_paper_id'];
//----------------------------------------------------------------------
?>












<?php 
//____________________________________New Button Set To Display Single Obj Sub Paper______________________________________
/*
if(isset($_POST['display_paper']))
{
	header ("Location:single_obj_sub_print.php");
}


if(isset($_SESSION['set_btn1']))
{
	?>
	<form method="post" align="center" >
	   <input style="width:150px;height:50px;background-color:lightgrey;color:black;"
   	   type="submit" name="display_paper" value="Display Paper"  />
	   </form>
	<?php
}
*/
//____________________________________/New Button Set To Display Single Obj Sub Paper______________________________________
?>


























<?php

$button="Insert";

?>









<?php
if(isset($mix) && isset($_SESSION['short_questions']) && isset($_SESSION['comb_s']) && !isset($_SESSION['set_btn1']))
{
	?>
	<form method="post" align="center" action="short_q_paper.php"   >
	<input type="submit" name="submit" value="Go to Short Questions" />
	</form>
	<?php
}
else if(isset($mix) && isset($_SESSION['short_questions']) && !isset($_SESSION['set_btn1']))
{
	?>
	<form method="post" align="center" action="short_q_paper.php"   >
	<input type="submit" name="submit" value="Go to Short Questions" />
	</form>
	<?php
}

else if(isset($mix) && isset($_SESSION['long_questions']) && !isset($_SESSION['set_btn1']))
{
	?>
	<form method="post" align="center" action="long_q_paper.php"   >
	<input type="submit" name="submit" value="Go to Long Questions" />
	</form>
	<?php
}
?>















<?php

if(isset($_POST['Insert']))
{
	
	 $option_name  =  $_POST['option_name'];
	 $ans          =  $_POST['ans'];
	 $question_id  =  $_POST['question_id'];
	 $correct_ans  =  $_POST['correct_ans'];
	 $status       =  $_POST['status'];
	                                             //INSERT QUERY.....................
	 if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='MCQs')
	 {
     $query_c="INSERT INTO  answers(option_name,ans,question_id,correct_ans,status)
                            VALUES('$option_name', '$ans', '$question_id', '$correct_ans', '$status')";
	 }
	 else if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='True False')
	{
     $query_c="INSERT INTO  tf_answers(option_name,ans,question_id,correct_ans,status)
                            VALUES('$option_name', '$ans', '$question_id', '$correct_ans', '$status')";
	 }
	 else if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='Fill in Blanks')
	 {
     $query_c="INSERT INTO  fb_answers(option_name,ans,question_id,correct_ans,status)
                            VALUES('$option_name', '$ans', '$question_id', '$correct_ans', '$status')";
	 }
	$result_c=mysqli_query($con,$query_c);
	if($result_c)
	{
		$check="Successfully inserted into Database.";
	}
	else
	{
		$check="Failed.";
	}
} 

?>








<?php
if(isset($_REQUEST['edit_answer_id']) && !isset($_SESSION['edit_recycle_bin']) ||
   isset($_REQUEST['edit_answer_id']) &&  $_REQUEST['edit_answer_id']!=$_SESSION['edit_recycle_bin'])
{
	$button="Update";
	$_SESSION['edit_answer_id']=$_REQUEST['edit_answer_id'];
	$edit_answer_id=$_SESSION['edit_answer_id'];
	if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='MCQs')
	{
	$query_d="SELECT * FROM answers WHERE ans_id='$edit_answer_id' ";
	}
	if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='True False')
	{
	$query_d="SELECT * FROM tf_answers WHERE ans_id='$edit_answer_id' ";
	}
	if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='Fill in Blanks')
	{
	$query_d="SELECT * FROM fb_answers WHERE ans_id='$edit_answer_id' ";
	}
	$result_d=mysqli_query($con,$query_d);
	while($row_d=mysqli_fetch_array($result_d))
	{
		
		$edit_option_name=$row_d['option_name'];
		 $edit_ans=$row_d['ans'];
		$edit_question_id=$row_d['question_id'];
		$edit_correct_ans=$row_d['correct_ans'];
		$edit_status=$row_d['status'];
		
		$_SESSION['edit_recycle_bin']=$_SESSION['edit_answer_id'];
		
		
	}
	$check="Ready to edit values.";
}
?>







<?php

if(isset($_POST['Update']))
{

	$update_id=$_SESSION['edit_answer_id'];
	$update_option_name=$_POST['option_name'];
	$update_ans=$_POST['ans'];
	$update_question_id=$_POST['question_id'];
	$update_correct_ans=$_POST['correct_ans'];
	$update_status=$_POST['status'];
	if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='MCQs')
	{
	$query_e="UPDATE answers SET option_name='$update_option_name',ans='$update_ans',
	question_id='$update_question_id',correct_ans='$update_correct_ans',
	status='$update_status' WHERE ans_id='$update_id'";
	}
	else if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='True False')
	{
	$query_e="UPDATE tf_answers SET option_name='$update_option_name',ans='$update_ans',
	question_id='$update_question_id',correct_ans='$update_correct_ans',
	status='$update_status' WHERE ans_id='$update_id'";
	}
	else if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='Fill in Blanks')
	{
	$query_e="UPDATE fb_answers SET option_name='$update_option_name',ans='$update_ans',
	question_id='$update_question_id',correct_ans='$update_correct_ans',
	status='$update_status' WHERE ans_id='$update_id'";
	}
	$result_e=mysqli_query($con,$query_e);
	if($result_e)
	{
		$check="Answer Updated Successfully.";
		unset($_SESSION['edit_answer_id']);
	}
}

?>






<?php
//_____________________________________________Delete Question________________________________________________________-->

if(isset($_REQUEST['delete_answer_id']) && !isset($_SESSION['delete_recycle_bin']) || 
   isset($_REQUEST['delete_answer_id']) && $_REQUEST['delete_answer_id']!=$_SESSION['delete_recycle_bin'])
{
	 $_SESSION['delete_answer_id']=$_REQUEST['delete_answer_id'];
	 $delete_answer_id=$_SESSION['delete_answer_id'];
	 if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='MCQs')
	 {
	 $query_g="DELETE FROM answers WHERE ans_id='$delete_answer_id' ";
	 }
	 else if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='Fill in Blanks')
	 {
	 $query_g="DELETE FROM fb_answers WHERE ans_id='$delete_answer_id' ";
	 }
	 else if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='True False')
	 {
	 $query_g="DELETE FROM tf_answers WHERE ans_id='$delete_answer_id' ";
	 }
	 $result_g=mysqli_query($con,$query_g);
	 if($result_g)
	{
		 $check="Answer Deleted Successfully.";
		 $_SESSION['delete_recycle_bin']=$_SESSION['delete_answer_id'];
	}
}	
//_____________________________________________/Delete Question________________________________________________________-->
?>















<?php
// _____________________________________________ Save Name Of Objective Type  ____________________________________________ 
if(isset($_SESSION['objective_type']))
{
	$obj_type=$_SESSION['objective_type'];
}
// _____________________________________________ /Save Name Of Objective Type  ____________________________________________ 
?>




















<?php // ___________________________________ What is Objective Type __________________________________________ ?>

<?php
if(isset($_SESSION['t_marks_mcq']))
{
echo "<h1 style='color:purple;'>MCQs</h1>";	
}
else if(isset($_SESSION['t_marks_tf']))
{
echo "<h1 style='color:purple;'>True False</h1>";	
}
else if(isset($_SESSION['t_marks_fb']))
{
echo "<h1 style='color:purple;'>Fill in Blanks</h1>";	
}
 ?>


<?php // ___________________________________ What is Objective Type __________________________________________ ?>














<?php // ___________________________________ Paper Creation Complete __________________________________________ ?>

<?php 

if(isset($_SESSION['ready_edit_mode']))
{
	?>
	<h1 align="center" style="color:red;">Paper has been Created Successfully....</h1>
	<?php
}

?>
<?php // ___________________________________ /Paper Creation Complete __________________________________________ ?>





























<html>
 <head>
  <title>
Answers Page
  </title>
 </head>
<body style="background-color:white;">















<?php // _______________________________________ Print Paper _______________________________________________ ?>



<?php
unset($_SESSION['save_as_word']);
if(isset($_POST['save_paper']))
{
	
	/*header ("Content-type: application/vnd.ms-word");
	$file_name="True False Paper";
    header ("Content-Disposition: attachment; filename=".$file_name.".doc");
	*/
 	$_SESSION['save_as_word']="Paper is Ready To save as Word.";
	$not_any_more="abc";
	$save_as_word="Paper is Ready For save.";
	include_once ("modify2.php");
}

?>







<?php // _______________________________________ /Print Paper _______________________________________________ ?>





















<?php if(isset($_SESSION['ready_edit_mode'])|| isset($_SESSION['edit_paper'])) { ?>
<form  align="center" method="post">
<input style="cursor:pointer;width:250px;height:50px;color:black;border-radius:4px;" type="submit" name="edit_ques" value="Edit Questions <?php echo " ( ".$obj_type." )"; ?>" />
<input style="cursor:pointer;width:250px;height:50px;color:black;border-radius:4px;" type="submit" name="edit_ans" value="Edit Answers <?php echo " ( ".$obj_type." )"; ?>" />
<input style="cursor:pointer;width:250px;height:50px;color:black;border-radius:4px;" type="submit" name="ans_key" value="Answers Key <?php echo "( ".$obj_type." )"; ?>" />
<input style="cursor:pointer;width:250px;height:50px;color:black;border-radius:4px;" type="submit" name="disp_paper" value="Display Paper <?php echo " ( ".$obj_type." )"; ?>" />
<input style="cursor:pointer;width:250px;height:50px;color:black;border-radius:4px;" type="submit" name="save_paper" value="Save as Paper" />
</form>
<?php
}
?>






<?php // __________________________________  When We Click On Submit Options ______________________________________ ?>
<?php
unset($_SESSION['save_paper']);
if (isset($_POST['submit2']))
{
	
	$_SESSION['save_paper']="Save your paper.";
	$_SESSION['ready_edit_mode']="Edit Mode Has Been Set.";
	//header ('Location:obj_question_paper.php');
	header ('Location:modify.php');
}
?>
<?php // __________________________________  /When We Click On Submit Options ______________________________________ ?>














<?php
// ______________________________ Display Of Paper ______________________________________

if(isset($_POST['disp_paper'])) // display paper work at display paper button.
{
    unset($_SESSION['obj_type']);          // obj_type session off at display of paper
	unset($_SESSION['disp_ans']);
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
	include_once "print_objective_paper.php";
	}	
}
// ______________________________ /Display Of Paper ______________________________________

?>



















<?php
// _________________________________ Display Answer Key _______________________________________
if(isset($_POST['ans_key']))
{
	$not_session="no set";
	unset($_SESSION['disp_ans']);
	unset($_SESSION['obj_type']);
	include_once "ans_key.php";
}
// _________________________________ /Display Answer Key _______________________________________
?>









































<?php

if(isset($_SESSION['disp_ans']))
{

?>
<br><br>
<?php if(!isset($_SESSION['ready_edit_mode'])) { ?>
<h1 align="center" style="color:green;">Set Answers and Click on 'Next'</h1>
<?php
}
if(isset($_SESSION['ready_edit_mode']))
{
?>
<h1 align="center" style="color:green;">Answers ( Add \ Edit \ Update \ Delete )</h1>
<?php	
}
?>
























<?php // _____________________________________________USER INTERFACE________________________________________________________?>
<form method="POST">
  <table border="1" align="center">
  <tr>
   <td>Select Question :</td>
   <td><select name="question_id" required >

<?php

 if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='MCQs')
{
$query_a="SELECT question_id,question,q_paper_id FROM question WHERE q_paper_id='$q_paper_id' ";
}
else if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='True False')
{
$query_a="SELECT question_id,question,q_paper_id FROM tf_questions WHERE q_paper_id='$q_paper_id' ";
}
else if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='Fill in Blanks')
{
$query_a="SELECT question_id,question,q_paper_id FROM fb_questions WHERE q_paper_id='$q_paper_id' ";
}
$result_a=mysqli_query($con,$query_a);
  while($row_a=mysqli_fetch_array($result_a))
 {
?>

  <option value="<?php echo $row_a['question_id']; ?>" 
  <?php if(isset($question_id) && $question_id==$row_a['question_id'] || isset($edit_question_id) && $edit_question_id==$row_a['question_id']) { ?> selected <?php } ?> >
  <?php echo $row_a['question']; ?></option>
  
 <?php
       }
?>
  </td>
</tr>
<tr>
 <td>Option_Name :</td>
  <td>
  <?php  if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='MCQs')
  {
	  ?>
      <input style="cursor:pointer;" type="checkbox" name="option_name" <?php if(isset($edit_option_name) && $edit_option_name=='A') { ?> checked <?php } ?> value="A"  >A</input>
      <input style="cursor:pointer;" type="checkbox" name="option_name" <?php if(isset($edit_option_name) && $edit_option_name=='B') { ?> checked <?php } ?> value="B"  >B</input>
	  <input style="cursor:pointer;" type="checkbox" name="option_name" <?php if(isset($edit_option_name) && $edit_option_name=='C') { ?> checked <?php } ?> value="C"  >C</input>
	  <input style="cursor:pointer;" type="checkbox" name="option_name" <?php if(isset($edit_option_name) && $edit_option_name=='D') { ?> checked <?php } ?> value="D"  >D</input>
	  <input style="cursor:pointer;" type="checkbox" name="option_name" <?php if(isset($edit_option_name) && $edit_option_name=='E') { ?> checked <?php } ?> value="E"  >E</input>
  <?php
  }
  
  ?>
  
  <?php  if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='True False')
  {
	  ?>
      <input style="cursor:pointer;" type="checkbox" name="option_name"
	  <?php if(isset($edit_option_name) && $edit_option_name=='A') { ?> checked <?php }  ?>   value="A">A</input>
      <input style="cursor:pointer;" type="checkbox" name="option_name" <?php if(isset($edit_option_name) && $edit_option_name=='B') {  ?> checked <?php } ?>   value="B">B</input>
  <?php
  }
  
  ?>
  
  
  <?php  if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='Fill in Blanks')
  {
	  ?>
      <input style="cursor:pointer;" type="checkbox" name="option_name" <?php if(isset($edit_option_name) && $edit_option_name=='A') { ?> selected <?php } ?> value="A" checked >A</input>
    <?php
  }
  ?>
  
  </td>
</tr>

 <tr>
  <td>Possible Answer :</td>
  <td>
  <?php
  if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']!='True False')
  {
	  ?>
  <input type="text" name="ans" value="<?php if(isset($edit_ans)) { echo $edit_ans; } ?>" required > </input>
  <?php
  }
  else
  {
	  ?>
	  <input style="cursor:pointer;" type="checkbox" name="ans" value="True" <?php if(isset($edit_ans) && $edit_ans=='True') {  ?> checked <?php } ?>  >True</input>
	  <input style="cursor:pointer;" type="checkbox" name="ans" value="False"  <?php if(isset($edit_ans) && $edit_ans=='False') { ?>   checked <?php } ?>  >False</input>
	  <?php
  }
  ?>
  </td>
 </tr>
  <tr>
    <td>Correct Answer :</td>
	<td>
	<?php
	if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='Fill in Blanks')
	{
	?>
	    <input style="cursor:pointer;" type="checkbox" name="correct_ans"  checked value="Yes">Yes</input>
	<?php
	}
	else
	{
?>	
        <input style="cursor:pointer;" type="checkbox" name="correct_ans" <?php if(isset($edit_correct_ans) && $edit_correct_ans=='Yes') { ?> checked <?php } else { } ?> 
       		value="Yes">Correct</input>
		<input style="cursor:pointer;" type="checkbox" name="correct_ans" <?php if(isset($edit_correct_ans) && $edit_correct_ans=='No') { ?> checked <?php } ?>
           		value="No">In-Correct</input>
	
	<?php
	}
	?>
	</td>
  </tr>
  <tr>
  <td>Status :</td>
  <td><select name="status">
      <option value="Active" <?php if(isset($edit_status) && $edit_status=='Active') { ?> selected <?php } ?> >Active</option>
	  <option value="Block"  <?php if(isset($edit_status) && $edit_status=='Block') { ?> selected <?php } ?> >Block</option>
	  </select>
  </td>
  </tr>
 <tr>
   <td colspan="2" align="right"><input style="cursor:pointer;width:100px;height:50px;" type="submit" name="<?php echo $button; ?>" value="<?php echo $button; ?>" />
   </td>
 </tr>
 </table>
</form>

</body>
</html>
<?php // ___________________________________________/USER INERFACE___________________________________________________________?>


<table style="width:1100px;" >
<tr>
<td align="right;">
<?php if(!isset($_SESSION['ready_edit_mode']) && !isset($_SESSION['edit_paper'])) { ?>
<form align="right" method="post">
<input style="cursor:pointer;width:150px;height:50px;color:black;border-radius:4px;" type="submit" name="submit2" value="Submit" />
  </td>
  </tr>
  </table>

</form>
<?php } ?>




<br><br>


<?php // ________________________________DISPLAY OF ANSWER TABLE___________________________________________________________?>

<?php
if(isset($check))
{
echo "<h3 style='color:red;'>".$check."</h3>";
}
?>

<?php
echo "<h1 align='center' style='color:green;'>Answers ( Database ) </h1>";
if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='MCQs')
{
$query_b="SELECT q.question_id, q.q_paper_id, q.question, a.question_id, a.ans_id, a.option_name,a.ans,
 a.correct_ans, a.status FROM question q, answers a WHERE q.question_id=a.question_id && q.q_paper_id='$q_paper_id' ";
}
else if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='True False')
{
$query_b="SELECT q.question_id, q.q_paper_id, q.question, a.question_id, a.ans_id, a.option_name,a.ans,
 a.correct_ans, a.status FROM tf_questions q, tf_answers a WHERE q.question_id=a.question_id && q.q_paper_id='$q_paper_id' ";
}
else if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='Fill in Blanks')
{
$query_b="SELECT q.question_id, q.q_paper_id, q.question, a.question_id, a.ans_id, a.option_name,a.ans,
 a.correct_ans, a.status FROM fb_questions q, fb_answers a WHERE q.question_id=a.question_id && q.q_paper_id='$q_paper_id' ";
}
 
$result_b=mysqli_query($con,$query_b);
?>

<table align="center" border="1">
 <tr style="text-align:center;font-weight:bold;">
  <td>Question</td>
  <td>Option</td>
  <td>Possible_Answer</td>
  <td>Correct Answer</td>
  <td>Status</td>
  <td colspan="2">Operations</td>
</tr>

<?php
while($row_b=mysqli_fetch_array($result_b))

{
?>
 <tr style="text-align:center;">
  <td><?php echo $row_b['question']; ?></td>
  <td><?php echo $row_b['option_name']; ?></td>
  <td><?php echo $row_b['ans']; ?></td>
  <td><?php echo $row_b['correct_ans']; ?></td>
  <td><?php echo $row_b['status']; ?></td>
  
  <td><a href="obj_answer_sheet.php?edit_answer_id=<?php echo $row_b['ans_id']; ?>"> Edit</a></td>
  <td><a href="obj_answer_sheet.php?delete_answer_id=<?php echo $row_b['ans_id']; ?>"> Delete</a></td>
</tr>
<?php	
}	
 ?>
 
 
 <?php
 
} //DISPLAY OF THIS ANSWER TABLE AND DATABASE ON CONDITION......
 ?>
 <!--
 <tr>
 <td align="right" colspan="5"  ><a href="obj_question_paper.php">Back</a></td>
  <td align="right" colspan="3" ><a href="print_objective_paper.php">Done</a></td>
 </tr>
 -->
</table>