



<?php
session_start();
include "connection.php";
unset ($_SESSION['show_q']);
unset($_SESSION['obj_type']);
//unset($_SESSION['disp_ans']);
unset($_SESSION['answers_set']);
$btn_name="back";
$btn_value="Next";


unset($_SESSION['done1']);









































//--------------------------------------------------------------- Check Completion of Questions ----------------------------------------------------------

if(isset($_SESSION['quan_mcq']))
{
	$total_questions=$_SESSION['quan_mcq'];
}
else if(isset($_SESSION['quan_tf']))
{
	$total_questions=$_SESSION['quan_tf'];
}
else if(isset($_SESSION['quan_fb']))
{
	$total_questions=$_SESSION['quan_fb'];
}

//------------------------------------------------------------------------------------------------------------------------------------------------------























// ----------------------------------------------- Next Short Questions -----------------------------------------

if(isset($_POST['next_short']))
{
	$finish_check=$_SESSION['finish_check'];
	if($finish_check==$total_questions)
	{
		header ("Location:short_q_paper.php");
	}
	else
		$error2="Error:- Please insert All Questions.";
}

// ----------------------------------------------- / Next Short Questions ---------------------------------------





















// ----------------------------------------------- Next Long Questions -----------------------------------------

if(isset($_POST['next_long']))
{
	$finish_check=$_SESSION['finish_check'];
	if($finish_check==$total_questions)
	{
		header ("Location:long_q_paper.php");
	}
	else
		$error2="Error:- Please insert All Questions.";
}


// ----------------------------------------------- / Next Long Questions ---------------------------------------




























if(isset($_POST['back']))
{
	$finish_check=$_SESSION['finish_check'];
	if($finish_check==$total_questions) 
	{
	$_SESSION['ready_edit_mode']="a";
	$_SESSION['done']="Successfully Inserted Questions And Answers.";
	header ("Location:obj_question_paper.php");
	}
	else
		$error2="Error:- Please insert All Questions.";
	
}
?>
















<?php
// --------------------------------------------- Go To Subjective ------------------------------------------------------------
if(isset($_POST['go_to']))
{
	if(isset($_SESSION['paper1']) || isset($_SESSION['one_1']))
	{
	header ("Location:long_q_paper.php");
	}
	else if(isset($_SESSION['one_one']))
	{
	header ("Location:short_q_paper.php");
	}
// --------------------------------------------- /Go To Subjective ------------------------------------------------------------	
}
























/*
if(isset($_SESSION['mcq_ready']))
{
$obj_type="MCQs";
$btn_value="Next";

}
else if(isset($_SESSION['fb_ready']))
{
$obj_type="Fill in Blanks";
$btn_value="Next";	
}
*/
?>















<?php

// --------------------------------------------------After Clicking On Button Display Edit / Update / Delete-----------------------------------------
if(isset($_POST['Update']))
{
	$_SESSION['refresh']="Set";
}

unset($_SESSION['edit_update']);
if (isset($_REQUEST['edit_answer_id']) )
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
// ------------------------------------ DELETE ALL INSERTED ANSWERS ----------------------------------------------------
if(isset($_POST['delete_all']))
{
	if(isset($_SESSION['mcq_ready']))
	{
$query="DELETE FROM answers";
	} else if(isset($_SESSION['fb_ready']))
	{
	$query="DELETE FROM fb_answers";	
	}
$run=mysqli_query($con,$query);
$check="All data has been deleted Successfully.";
}
// ------------------------------------ /DELETE ALL INSERTED ANSWERS ----------------------------------------------------

?>

























<!-- ------------------------------------------------- First Header ---------------------------------------------- -->
<body style="background-color:lightgrey;">

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



</body>
<!-- ------------------------------------------------- /First Header ---------------------------------------------- -->














































<?php
if(isset($_SESSION['mix_paper']))
{
	 $mix=$_SESSION['mix_paper'];
}









// ______________________________________  Display Paper Button  _____________________________________________
unset($_SESSION['edit_ans']);
unset ($_SESSION['edit_answer']);
unset($_SESSION['disp_ans']);
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
	//$_SESSION['disp_ans']="Answers Table And Database Are Ready For Display.";
	$_SESSION['edit_answer']="Edit Answers Set.";
}

if(isset($_POST['edit_ques']))
{
	
	$_SESSION['obj_type']=$_SESSION['objective_type'];
	//header ('Location:obj_question_paper.php');
	header ("Location:obj_question_paper.php");
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
//echo $go_short="Go To Short Questions.";
	
?>









<?php
if(isset($mix) && isset($_SESSION['short_questions']) && isset($_SESSION['comb_s']) && !isset($_SESSION['set_btn1']))
{ 
 $go_short="Go To Short Questions.";

	?>
	
	<!--<form method="post" align="center" action="short_q_paper.php"   >
	<input style="height:50px;width:200px;background-color:navy;color:white;cursor:pointer;" type="submit" name="submit" value="Go to Short Questions" />
	</form>-->
	<?php
}
else if(isset($mix) && isset($_SESSION['short_questions']) && !isset($_SESSION['set_btn1']))
{ 
    $go_short="Go To Short Questions.";
	?>
	<!--<form method="post" align="center" action="short_q_paper.php"   >
	<input style="height:50px;width:200px;background-color:navy;color:white;cursor:pointer;" type="submit" name="submit" value="Go to Short Questions" />
	</form>-->
	<?php
}

else if(isset($mix) && isset($_SESSION['long_questions']) && !isset($_SESSION['set_btn1']))
{
	$go_long="Go To Short Questions.";
	?>
	<!--<form method="post" align="center" action="long_q_paper.php"   >
	<input style="height:50px;width:100px;background-color:navy;color:white;cursor:pointer;" type="submit" name="submit" value="Go to Long Questions" />
	</form>-->
	<?php
}
?>




















<?php
 
 
 //--------------------------------------No Repeatition Of Question-----------------------------------------------------
if(isset($_POST['Insert']))
{
	$question_id=$_POST['question_id'];
	if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=="MCQs")
	{
        $query_z="SELECT * FROM answers";
	} else if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=="Fill in Blanks")
	{
		$query_z="SELECT * FROM fb_answers";
	}
	else if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=="True False")
	{
		$query_z="SELECT * FROM tf_answers";
	}
$run_z=mysqli_query($con,$query_z);
while($row_z=mysqli_fetch_array($run_z))
 {
	if($row_z['question_id']==$question_id)
	{
	  $error="You have already Inserted this Question.";	
	}
  }
  
}
//--------------------------------------/No Repeatition Of Question-----------------------------------------------------
 ?>
























<?php
//_____________________________________________Insertion  Of Answer______________________1_________________________________-->
if(isset($_POST['Insert']))
{
	
	
	if(!isset($error))
	{
	$var=0;
	$correct  =  $_POST['correct_ans'];
	foreach ($_POST['answer'] as $ans)
	{
	$ans = str_replace("'","\'",$ans);
	 $option_name  =  $_POST['option_name'][$var++];
	 $correct_ans=0;
	 if($option_name==$correct)
	 {
		 $correct_ans=$correct;
	 }
	 $question_id  =  $_POST['question_id'];
	
	 $status       =  $_POST['status'];
	                                             //INSERT QUERY.....................
	   if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=="MCQs")
	 {
     $query_c="INSERT INTO  answers(option_name,ans,question_id,correct_ans,status)
                            VALUES('$option_name', '$ans', '$question_id', '$correct_ans', '$status')";
	 }
	 
	 else if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=="True False")
	{
     $query_c="INSERT INTO  tf_answers(option_name,ans,question_id,correct_ans,status)
                            VALUES('$option_name', '$ans', '$question_id', '$correct_ans', '$status')";
	 }
	 
	 if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=="Fill in Blanks")
	 {
     $query_c="INSERT INTO  fb_answers(option_name,ans,question_id,correct_ans,status)
                            VALUES('$option_name', '$ans', '$question_id', '$correct_ans', '$status')";
	 }
	 
	$result_c=mysqli_query($con,$query_c);
	  }
	}
	if(isset($result_c))
	{
		$_SESSION['finish_check']=$_SESSION['finish_check']+1;
		$check="Successfully inserted into database.";
	}
	else
	{
		$error="Failed ! You Have Already inserted this Question.";
	}
} 
//_____________________________________________/Insertion  Of Answer________________________________________________________-->
?>








<?php
   if(isset($_REQUEST['edit_answer_id']))
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
	$update_ans = str_replace("'","\'",$update_ans);
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

// ------------------------------------------- Skip Option ------------------------------------------------------------

if(isset($_POST['skip']) && isset($_SESSION['objective_type']) && $_SESSION['objective_type']="MCQs")
{
	$_SESSION['mcq_choices']=$_SESSION['mcq_choices']-1;
}
if(isset($_POST['add']) && isset($_SESSION['objective_type']) && $_SESSION['objective_type']="MCQs")
{
	$_SESSION['mcq_choices']=$_SESSION['mcq_choices']+1;
}
if(isset($_POST['clear']))
{
	//$_SESSION['mcq_choices']=$_SESSION['mcq_choices']+1;
}


// ------------------------------------------- /Skip Option ------------------------------------------------------------


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





























































<html>
 <head>
  <title>
Answers Page
  </title>
 </head>
<body>


















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




















<?php // _______________________________________ Print Paper _______________________________________________ ?>



<?php
/*
unset($_SESSION['save_as_word']);
if(isset($_POST['save_paper']))
{
	
	/*header ("Content-type: application/vnd.ms-word");
	$file_name="True False Paper";
    header ("Content-Disposition: attachment; filename=".$file_name.".doc");
	
 	$_SESSION['save_as_word']="Paper is Ready To save as Word.";
	$not_any_more="abc";
	$save_as_word="Paper is Ready For save.";
	include_once ("print_objective_paper.php");
}
*/
?>







<?php // _______________________________________ /Print Paper _______________________________________________ ?>


















<?php
 if(isset($_SESSION['done'])) { ?>

<center><span align="center" style="color:Navy;font-size:40px;"><br>Answers Of Created Questions<br><br></span></center>
<?php } ?>

<?php if((isset($_SESSION['ready_edit_mode'])|| isset($_SESSION['edit_paper'])) && !isset($_SESSION['refresh'])  && !isset($_SESSION['edit_update'])) { ?>
<center><form  align="center" method="post">
<input style="border:none;cursor:pointer;width:200px;height:50px;background-color:navy;color:white;border-radius:4px;"
<?php if (isset($_SESSION['edit_update'])) { ?> disabled <?php } ?> type="submit" name="edit_ans" value="<?php echo $obj_type; ?> ( Answers )" />
<input style="border:none;cursor:pointer;width:200px;height:50px;background-color:navy;color:white;border-radius:4px;"
<?php if (isset($_SESSION['edit_update'])) { ?> disabled <?php } ?> type="submit" name="edit_ques" value="Edit Questions" />
<!--<input style="cursor:pointer;width:200px;height:50px;background-color:navy;color:white;border-radius:4px;" type="submit" name="ans_key" value="Answers Key <?php// echo "( ".$obj_type." )"; ?>" /> -->

<?php if(isset($_SESSION['section_back2']) || isset($_SESSION['paper1']) || isset($_SESSION['one_one']) || isset($_SESSION['one_1']))
	{ ?>
	
	<input style="border:none;height:50px;width:200px;background-color:navy;color:white;cursor:pointer;" type="submit" name="go_to" value="Go To Subjective" />
		
	<?php
	}
	?>

<input style="border:none;cursor:pointer;width:200px;height:50px;background-color:navy;color:white;border-radius:4px;"

<?php if (isset($_SESSION['edit_update'])) { ?> disabled <?php } ?> type="submit" name="disp_paper" value="Display Paper" />
<!--<input style="cursor:pointer;width:250px;height:50px;color:black;border-radius:4px;" type="submit" name="save_paper" value="Save as Paper" />-->
</form>
</center>
<?php
}
?>


































































<?php // __________________________________  When We Click On Submit Options ______________________________________ ?>
<?php
unset($_SESSION['save_paper']);
if (isset($_POST['submit2']))
{
	
	//$_SESSION['save_paper']="Save your paper.";
	$_SESSION['ready_edit_mode']="Edit Mode Has Been Set.";
    header ('Location:obj_question_paper.php');
	//header ('Location:modify.php');
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
	else if(isset($_SESSION['paper1']) || isset($_SESSION['one_one']) || isset($_SESSION['one_1']))
	{
		header ('Location:single_obj_sub_print.php');
	}
	else
	{
	//header ('Location:print_objective_paper.php');
	unset($_SESSION['obj_type']);
	$_SESSION['answers_set']="set";
	$not_any_more="Not any more is required";
	header ("Location:print_objective_paper.php");
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
	//include_once "ans_key.php";
}
// _________________________________ /Display Answer Key _______________________________________
?>









































<?php

if(!isset($_SESSION['done']))
{

?>

<?php// if(!isset($_SESSION['ready_edit_mode']) && !isset($_SESSION['done']))
	
	  
	// ------------------------------------------NOT SET READY EDIT MODE--------------------------------------------------- 

?>
<?php if(isset($_SESSION['objective_type'])) { ?>
<br><br>
<h1 align="center" style="color:navy;">Insert '<?php echo "<span style='color:red;'>".$_SESSION['objective_type']."</span>"; ?>' Answers</h1>
<?php
}
?>
<?php

// ------------------------------------------ /NOT SET READY EDIT MODE--------------------------------------------------- 

  
}
  ?>
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  <?php
// --------------------------------------- Insertion Message Or Failed Message -----------------------------------------

if(isset($check) && !isset($error))
{
echo "<h3 style='color:green;text-align:center;'>".$check."</h3>";
}
?>

<?php
if(isset($error))
{
echo "<h3 style='color:red;text-align:center;'>".$error."</h3>";
  }
  ?>
  <?php
if(isset($error2))
{
echo "<h3 style='color:red;text-align:center;'>".$error2."</h3>";
  }
 // END
// --------------------------------------- /Insertion Message Or Failed Message ----------------------------------------- 
?>

  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
 












  
  
  
  
  
  
  
  
  
  
  
  
  
  
  <?php
if(isset($_SESSION['ready_edit_mode']))
{
?>
<!--<h1 align="center" style="color:green;">Answers ( Add \ Edit \ Update \ Delete )</h1>-->
<?php	
}
?>
















































<?php // _____________________________________________USER INTERFACE_________________________________________5______________?>
<?php 

if(!isset($_SESSION['done']))
	{ 

?>
<form method="POST">
  <table align="center" border="1">
  <!----------------------------------------------------- QUESTIONS DISPLAY --------------------------------------------> 

  <tr>
   <td>Select Question :</td>
   <td><select style="width:900px;height:40px;" name="question_id" required >

<?php

   if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=="MCQs")
{
$query_a="SELECT question_id,question,q_paper_id FROM question WHERE q_paper_id='$q_paper_id' ";
}
else if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=="True False")
{
$query_a="SELECT question_id,question,q_paper_id FROM tf_questions WHERE q_paper_id='$q_paper_id' ";
}
else if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=="Fill in Blanks")
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

<!----------------------------------------------------- QUESTIONS DISPLAY --------------------------------------------> 


























<!-----------------------------------------------------MCQS INPUT BOX DISPLAY------------------------------------------------>

<?php
if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=="MCQs")

  {
	  ?>
<tr>

 <td colspan="2">
 
 <table>
 <?php
  $total_choices=$_SESSION['mcq_choices'];
  $a="A";
  $inc=0;
  
 for($i=1;$i<=$total_choices;$i++) { ?>
  <tr>
  <td style="width:106px;text-align:right;background-color:maroon;"><input style="width:40px;height:40px;text-align:center;" readonly  type="text" name="option_name[]" value="<?php echo $a++; ?>" required /></td>
  <td><input style="padding:5px;width:900px;height:40px;" type="text" name="answer[]"
                value="<?php if(isset($error)) { echo $_POST['answer'][$inc++]; } ?>"  required  /></td>
  </tr>
  <?php
 }
 ?>
 
 </table>
 </td>
</tr>
 <tr>
  <td>Correct Answer :</td>
  <td style="width:900px;height:40px;font-weight:bold;" >
 <?php
$alphabet = "A";
 for($i=1;$i<=$total_choices;$i++)
 {
	 ?>
	 <input style="width:70px;cursor:pointer;" type="radio" name="correct_ans" value="<?php echo $alphabet; ?>" required /><?php echo $alphabet++; ?>
	 <?php
 }
	 ?>
 </td>
 </tr>
 <?php
  } // END OF MCQ OPTIONS TABLE .......................
  ?>
 <!-----------------------------------------------------/MCQS INPUT BOX DISPLAY------------------------------------------------>
 
  
 
 
 
 
 
 
 
 
 <?PHP

//$query_v="DELETE FROM answers";
//$run=mysqli_query($con,$query_v);

?>
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 


 
	 

















	<!-----------------------------------------------------FILL IN BLANKS INPUT BOX DISPLAY------------------------------------------------>

<?php
 if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=="Fill in Blanks")
  {
	  
	  //unset($_SESSION['mcq_choices']);
	  ?>
 <?php
  //$_SESSION['mcq_choices']="4";
  ?>
  <input type="hidden" name="correct_ans" value="A" />
  <?php
  $a="A";
  $inc=0;
 for($i=1;$i<=1;$i++) { ?>
  <tr>
  <td style="width:106px;text-align:left;"><input style="width:40px;height:40px;text-align:center;" readonly  type="hidden" name="option_name[]" value="<?php echo $a++; ?>" required />Correct Answer</td>
  <td><input  style="padding:10px;width:900px;height:40px;" type="text" name="answer[]"
                value="<?php if(isset($error)) { echo $_POST['answer'][$inc++]; } ?>"  required  /></td>
  </tr>
  <?php
 }
 ?>
 
 <?php
  }// END OF FILL IN BLANKS TABLE .......................
  ?>
 <!-----------------------------------------------------/FILL IN BLANKS INPUT BOX DISPLAY------------------------------------------------>
 
   
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 


 
<!--------------------------------------------- TRUE FALSE INPUT BOX DISPLAY ----------------------------------------> 
 
<?php

if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=="True False")

{
	unset($_SESSION['mcq_choices']);
	?>
	<tr>
  <td>Correct Answer :</td>
	<input type="hidden" name="option_name[0]" value="A" />
	<input type="hidden" name="option_name[1]" value="B" />
	<input type="hidden" name="answer[0]" value="True" />
	<input type="hidden" name="answer[1]" value="False" />
	<td style="width:900px;height:40px;font-weight:bold;" >
	<?php
	$alphabet="A";
 for($i=1;$i<=2;$i++)
 {
	 ?>
	 <input style="width:70px;cursor:pointer;" type="radio" name="correct_ans" value="<?php echo $alphabet; ?>" required />
	 <?php 
	  $alphabet++; 
	  if($i==1)
	  {
	  echo "True";
	  } else if($i==2)
	  {
	  echo "False";
	  }
	 ?>
	 <?php
 }
	 ?>
	 </td>
	 </tr>
	
	<?php
} 
?>
<!------------------------------------------------ /TRUE FALSE INPUT BOX DISPLAY --------------------------------> 
 






  <tr>
  <td>Status :</td>
  <td><select style="width:900px;height:40px;" name="status">
      <option value="Active" <?php if(isset($edit_status) && $edit_status=='Active') { ?> selected <?php } ?> >Active</option>
	  <option value="Block"  <?php if(isset($edit_status) && $edit_status=='Block') { ?> selected <?php } ?> >Block</option>
	  </select>
  </td>
  </tr>
 <tr>
   <td colspan="2" align="center">
   <input style="border:none;border-radius:4px;cursor:pointer;width:100px;height:50px;background-color:navy;color:white;" type="submit" name="<?php echo $button; ?>" value="<?php echo $button; ?>" />
   </form>
   <form method="post" style="float:left;">
   <?php  if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=="MCQs")
 { 
?>
   <input style="border:none;cursor:pointer;width:100px;height:50px;background-color:navy;color:white;border-radius:4px;" type="submit" name="<?php echo "skip"; ?>" value="<?php echo "Skip Option"; ?>" />
   <input style="border:none;cursor:pointer;width:100px;height:50px;background-color:navy;color:white;border-radius:4px;" type="submit" name="<?php echo "add"; ?>" value="<?php echo "Add Option"; ?>" />
   <?php } ?>  
  <input style="border:none;cursor:pointer;width:100px;height:50px;background-color:navy;color:white;border-radius:4px;" type="submit" name="<?php echo "clear"; ?>" value="<?php echo "Clear"; ?>" />
   </form>
   </td>
 
 </tr>
 </table>

<?php 
	
}
	
 //END OF INPUT SESSION..... ?>
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 <?php
// ----------------------------------------------------- Go To Next Objective ---------------------------------------------
 if(!isset($go_short) && !isset($_SESSION['done']) && !isset($go_long)) { ?>
 <br><table style="width:1180px;">
 <tr>
 <td>
 <form style="float:right;" method="POST" >
   <input style="border:none;border-radius:4px;float:right;cursor:pointer;width:100px;height:50px;background-color:navy;color:white;border-radius:4px;" type="submit" name="<?php echo $btn_name; ?>" value="<?php echo $btn_value; ?>" />
      </form>
  </td>
  </tr>
 </table>
 <?php
 // ----------------------------------------------------- /Go To Next Objective ---------------------------------------------

 }
 ?>
 
 
 
 
 
 
 
 
 
 <?php // ------------------------------------------------ Go To Short Questions ---------------------------------- ?>

 <?php 
 //echo $_SESSION['section_back2']."<br>".$_SESSION['section_back'];
 if(isset($go_short) && !isset($_SESSION['section_back2']) && !isset($_SESSION['one_one']))  { ?>
    <br><table style="width:1180px;">
	<tr>
	<td align="right" ><form method="post">
	<input style="border:none;border-radius:4px;height:50px;width:100px;background-color:navy;color:white;cursor:pointer;" type="submit" name="next_short" value="Next" />
	</form></td>
	</tr>
	</table>
<?php } ?>
<?php // ------------------------------------------------ /Go To Short Questions ---------------------------------- ?>





















<?php // ------------------------------------------------ Go To Short Questions ---------------------------------- ?>

 <?php 
 //echo $_SESSION['section_back2']."<br>".$_SESSION['section_back'];
 if(isset($go_long) && !isset($_SESSION['one_1']))  { ?>
    <br><table style="width:1180px;">
	<tr>
	<td align="right"><form method="post">
	<input style="border-radius:4px;border:none;height:50px;width:100px;background-color:navy;color:white;cursor:pointer;" type="submit" name="next_long" value="Next" />
	</form></td>
	</tr>
	</table>
<?php } ?>
<?php // ------------------------------------------------ /Go To Short Questions ---------------------------------- ?>





























<?php
//--------------------------------------- On Refreshing -------------------------------------------------------------->
 if(isset($_SESSION['refresh']))
	 {
	?>
	<center><form method="get">
<input style="border-radius:4px;border:none;height:50px;width:100px;background-color:navy;color:white;cursor:pointer;" type="submit" name="refresh" value="Refresh" />
</form></center>
	<?php
} 
//--------------------------------------- /On Refreshing -------------------------------------------------------------->
?>
























 
 
<?php // ___________________________________________/USER INERFACE___________________________________________________________?>

























<?php

//----------------------------------------------------Update Interface-------------------------------------------------->

 if(isset($_SESSION['edit_update']) && !isset($_SESSION['refresh'])) { ?>
<form method="POST">
  <table align="center" border="1">
  <tr>
   <td>Select Question :</td>
   <td><select type="hidden" style="width:900px;height:40px;" name="question_id" 
   <?php if(!isset($edit_question_id)) { ?> disabled <?php } ?>  required >

<?php

   if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=="MCQs")
{
$query_a="SELECT question_id,question,q_paper_id FROM question WHERE q_paper_id='$q_paper_id' ";
}
else if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=="True False")
{
$query_a="SELECT question_id,question,q_paper_id FROM tf_questions WHERE q_paper_id='$q_paper_id' ";
}
else if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=="Fill in Blanks")
{
$query_a="SELECT question_id,question,q_paper_id FROM fb_questions WHERE q_paper_id='$q_paper_id' ";
}
$result_a=mysqli_query($con,$query_a);
  while($row_a=mysqli_fetch_array($result_a))
 {
?>

  <option value="<?php echo $row_a['question_id']; ?>" 
  <?php if(isset($question_id) && $question_id==$row_a['question_id'] || 
  isset($edit_question_id) && $edit_question_id==$row_a['question_id']) { ?> selected <?php } ?> >
  <?php echo $row_a['question']; ?></option>
  
 <?php
       }
?>
  </td>
</tr>
<tr>

 <td colspan="2">
 <table>
  <tr>
  <td style="width:106px;text-align:left;background-color:lightgrey;"><input style="width:40px;height:40px;text-align:center;" readonly  type="hidden" name="option_name" value="<?php if(isset($edit_option_name)) { echo $edit_option_name; } ?>" required />Correct Answer</td>
  <td><input style="padding:5px;width:900px;height:40px;" <?php if(!isset($edit_ans)) { ?> readonly <?php } ?> type="text" name="ans"
                value="<?php if(isset($edit_ans)) { echo $edit_ans; } ?>"  required  /></td>
  </tr>
  <?php
 //}
  ?>
  </table>
  </td>
</tr>
<input style="width:900px;height:40px;" type="hidden" value="<?php if(isset($edit_correct_ans)) echo $edit_correct_ans; ?>" name="correct_ans" readonly />
 
  <tr>
  <td>Status :</td>
 <td><select style="width:900px;height:40px;" name="status" <?php if(!isset($edit_status)) { ?> disabled <?php } ?> >
      <option value="Active" <?php if(isset($edit_status) && $edit_status=='Active') { ?> selected <?php } ?> >Active</option>
	  <option value="Block"  <?php if(isset($edit_status) && $edit_status=='Block') { ?> selected <?php } ?> >Block</option>
	  </select>
  </td>
  </tr>
 <tr>
   <td colspan="2" align="center" style="text-align:top;">
   <input style="border-radius:4px;border:none;cursor:pointer;width:100px;height:50px;background-color:navy;color:white;"
   <?php if(!isset($edit_question_id)) { ?> disabled <?php } ?>
   type="submit" name="<?php echo "Update"; ?>" value="<?php echo "Update"; ?>" />
   </td>
 
 </tr>
 </table>
 </form>
 
<?php
 //----------------------------------------------------/Update Interface-------------------------------------------------->
 } 
 ?>

































<?php // ________________________________DISPLAY OF ANSWER TABLE___________________________________________________________?>



<?php

if((!isset($_SESSION['refresh']) && isset($_SESSION['edit_answer'])) || !isset($_SESSION['done']))
{
   
echo "<h1 align='center' style='color:navy;'><br><br>Answers ( <span style='color:red;'>".$_SESSION['objective_type']."</span> ) </h1>";
  
?>
<?php
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
 
 //DISPLAY OF THIS ANSWER TABLE AND DATABASE ON CONDITION......
 ?>
 <!--
 <tr>
 <td align="right" colspan="5"  ><a href="obj_question_paper.php">Back</a></td>
  <td align="right" colspan="3" ><a href="print_objective_paper.php">Done</a></td>
 </tr>
 -->
</table>
<?php
}  // WHEN REFRESH NOT SET,,,,
?>