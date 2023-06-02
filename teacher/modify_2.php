


<?php
session_start();
include "connection.php";
$btn_name="back";
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




<h2 align="left" style="font-size:35px;color:purple;text-align:center">Objective Paper(<span style="font-size:25px;"> MCQs & Fill in Blanks </span>) </h2>

<br><br><br>

</body>
<!-- ------------------------------------------------- /First Header ---------------------------------------------- -->



































<!--h1 align="left" style="font-size:40px;color:green;">MCQs , <span style="color:green;">Fill In Blanks</span></h1>-->
<?php
if(isset($_SESSION['mix_paper']))
{
	$mix="Mix paper Has set.";

if(isset($_SESSION['short_questions']) && isset($_SESSION['fb_ready']))
{
	$btn_name="goto";
	$btn_value="Go To Short Questions";
}
else if(isset($_SESSION['long_questions']) && isset($_SESSION['fb_ready']))
 {
	 $btn_name="goto";
 $btn_value="Go To Long Questions";	
    }
}
?>
<?php // ---------------------------------------Edit Answers---------------------------------------------------------------- ?>









<?php
// _________________________________________ Button Setting _____________________________________________________
if(isset($_GET['back']))
{
	header ("Location:combination_1.php");
}

    if(isset($_GET['goto']))
{
	    if(isset($_SESSION['short_questions']))
	{
	 header ("Location:short_q_paper.php");
	}
	  else if(isset($_SESSION['long_questions']))
	{
		header ("Location:long_q_paper.php");
	}
}

?>













<?php




if(isset($_GET['disp_paper']))
{
unset($_SESSION['mcq_ready']);
unset($_SESSION['tf_ready']);
unset($_SESSION['fb_ready']);
if(isset($_SESSION['set_btn2']))
{
	header ("Location:comb_obj_sub_print.php");
}
else
header ("Location:comb_1_obj_print_paper.php");
}
 if(isset($_GET['mcq_ans']))
{


    $_SESSION['mcq_ready']="MCQs.";
	unset($_SESSION['tf_ready']);
	unset($_SESSION['fb_ready']);

}
if(isset($_GET['tf_ans']))
{
	$_SESSION['tf_ready']="You Are Ready To Edit Answers Of True False.";
	unset($_SESSION['fb_ready']);
	unset($_SESSION['mcq_ready']);
}
 if(isset($_GET['fb_ans']))
{
   $_SESSION['fb_ready']="Fill In Blanks.";
	unset($_SESSION['tf_ready']);
	unset($_SESSION['mcq_ready']);
}
if (isset($_GET['questions']))
{
	header ('Location:combination_1.php');
}

?>





<?php
// _____________________________________________________ Save Paper _________________________________________________________________
if(isset($_GET['save_paper']))
{
	header ("Content-type: application/vnd.ms-word");
	$file_name="Objective Paper";
    header ("Content-Disposition: attachment; filename=".$file_name.".doc");
	$print="Ready For Save";
	$save_paper="kashif ali";
	include_once "comb_1_obj_print_paper.php";
}

// _____________________________________________________ /Save Paper ________________________________________________________________
?>












<?php

if(isset($_SESSION['edit_answers']) || isset($_SESSION['set_btn2']) || isset($_SESSION['return_back']))
{
	//$_SESSION['mcq_ready']="Ready";
	?>
	<form method="get">
	<table align="center">
	<tr>
	<td colspan="4" style="color:Navy;font-size:40px;text-align:center;">Answers Of Created Questions<br><br></td>
	</tr>
	<tr>
	<td><input style="cursor:pointer;width:200px;height:50px;background-color:navy;color:white;" type="submit" name="mcq_ans" value="Show MCQs (Answers)" /></td>
	<td><input style="cursor:pointer;width:200px;height:50px;background-color:navy;color:white;" type="submit" name="fb_ans" value="Show Fill in Blanks (Answers)" /></td>
	<td><input style="cursor:pointer;width:200px;height:50px;background-color:navy;color:white;" type="submit" name="questions" value="Edit Questions" /></td>
	<td><input style="cursor:pointer;width:200px;height:50px;background-color:navy;color:white;" type="submit" name="disp_paper" value="Display Paper" /></td>
	<!--<td><input style="cursor:pointer;width:200px;height:50px;background-color:lightgrey;color:black;" type="submit" name="save_paper" value="Save Paper" /></td>-->
	</tr>
	</table>
</form>	

	<?php
}

?>














<?php // ---------------------------------------Edit Answers---------------------------------------------------------------- ?>




<?php

//----------------------------------------------------------------------
$q_paper_id=$_SESSION['q_paper_id'];
//----------------------------------------------------------------------
?>



<?php

if(isset($_SESSION['mcq_ready']) || isset($_SESSION['tf_ready']) || isset($_SESSION['fb_ready']))
{
?>







<?php
//------------------------------------------------Button Conversion Of Mix Questions Paper Page---------------------------------------------------
 if(isset($_SESSION['mcq_ready']))
{
	//$mcq_ready=$_SESSION['mcq_ready'];
	$_SESSION['button_name']="next2";
	$_SESSION['button_value']="Next";
}
else if(isset($_SESSION['fb_ready']))
{
	//echo "<h1 style='color:navy;'>".$_SESSION['fb_ready']."</h1>";
	unset($_SESSION['button_name']);
	unset($_SESSION['button_value']);
	if(!isset($mix))
	{
	$_SESSION['done']="All Data Inserted Successfully.";
	}
}

//------------------------------------------------/Button Conversion Of Mix Questions Paper Page---------------------------------------------------
?>

































<?php

$button="Insert";

?>


<?php
//_____________________________________________Insertion  Of Answer______________________1_________________________________-->
if(isset($_POST['Insert']))
{
	
	 $option_name  =  $_POST['option_name'];
	 $ans          =  $_POST['ans'];
	 $question_id  =  $_POST['question_id'];
	 $correct_ans  =  $_POST['correct_ans'];
	 $status       =  $_POST['status'];
	                                             //INSERT QUERY.....................
	   if(isset($_SESSION['mcq_ready']))
	 {
     $query_c="INSERT INTO  answers(option_name,ans,question_id,correct_ans,status)
                            VALUES('$option_name', '$ans', '$question_id', '$correct_ans', '$status')";
	 }
	 else if(isset($_SESSION['tf_ready']))
	{
     $query_c="INSERT INTO  tf_answers(option_name,ans,question_id,correct_ans,status)
                            VALUES('$option_name', '$ans', '$question_id', '$correct_ans', '$status')";
	 }
	 else if(isset($_SESSION['fb_ready']))
	 {
     $query_c="INSERT INTO  fb_answers(option_name,ans,question_id,correct_ans,status)
                            VALUES('$option_name', '$ans', '$question_id', '$correct_ans', '$status')";
	 }
	$result_c=mysqli_query($con,$query_c);
	if($result_c)
	{
		$check="Successfully inserted into database.";
	}
	else
	{
		$check="Failed.";
	}
} 
//_____________________________________________/Insertion  Of Answer________________________________________________________-->
?>








<?php
//_____________________________________________Edit Question______________________________________2_________________-->
if(isset($_REQUEST['edit_answer_id']) && !isset($_SESSION['edit_recycle_bin2']) ||
   isset($_REQUEST['edit_answer_id']) &&  $_REQUEST['edit_answer_id']!=$_SESSION['edit_recycle_bin2'])
{
	$button="Update";
	$_SESSION['edit_answer_id']=$_REQUEST['edit_answer_id'];
	$edit_answer_id=$_SESSION['edit_answer_id'];
	 if(isset($_SESSION['mcq_ready']))
	{
	$query_d="SELECT * FROM answers WHERE ans_id='$edit_answer_id' ";
	}
	else if(isset($_SESSION['tf_ready']))
	{
	$query_d="SELECT * FROM tf_answers WHERE ans_id='$edit_answer_id' ";
	}
	else if(isset($_SESSION['fb_ready']))
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
		
		$_SESSION['edit_recycle_bin2']=$_SESSION['edit_answer_id'];
		
		
	}
	$check="Ready to edit values.";
}
//_____________________________________________/Edit Question________________________________________________________-->
?>
































<?php
//_____________________________________________Update Question______________________________________3_________________-->
if(isset($_POST['Update']))
{
	$update_id=$_SESSION['edit_answer_id'];
	$update_option_name=$_POST['option_name'];
	$update_ans=$_POST['ans'];
	$update_question_id=$_POST['question_id'];
	$update_correct_ans=$_POST['correct_ans'];
	$update_status=$_POST['status'];
	 if(isset($_SESSION['mcq_ready']))
	{
	$query_e="UPDATE answers SET option_name='$update_option_name',ans='$update_ans',
	question_id='$update_question_id',correct_ans='$update_correct_ans',
	status='$update_status' WHERE ans_id='$update_id'";
	}
	else if(isset($_SESSION['tf_ready']))
	{
	$query_e="UPDATE tf_answers SET option_name='$update_option_name',ans='$update_ans',
	question_id='$update_question_id',correct_ans='$update_correct_ans',
	status='$update_status' WHERE ans_id='$update_id'";
	}
	else if(isset($_SESSION['fb_ready']))
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
//_____________________________________________/Update Question________________________________________________________-->
?>




































<?php
//_____________________________________________Delete Question________________________________________4_______________-->

if(isset($_REQUEST['delete_answer_id']) && !isset($_SESSION['delete_recycle_bin2']) || 
   isset($_REQUEST['delete_answer_id']) && $_REQUEST['delete_answer_id']!=$_SESSION['delete_recycle_bin2'])
{
	 $_SESSION['delete_answer_id']=$_REQUEST['delete_answer_id'];
	 $delete_answer_id=$_SESSION['delete_answer_id'];
	   if(isset($_SESSION['mcq_ready']))
	 {
	 $query_g="DELETE FROM answers WHERE ans_id='$delete_answer_id' ";
	 }
	 else if(isset($_SESSION['fb_ready']))
	 {
	 $query_g="DELETE FROM fb_answers WHERE ans_id='$delete_answer_id' ";
	 }
	 else if(isset($_SESSION['tf_ready']))
	 {
	 $query_g="DELETE FROM tf_answers WHERE ans_id='$delete_answer_id' ";
	 }
	 $result_g=mysqli_query($con,$query_g);
	 if($result_g)
	{
		 $check="Answer Deleted Successfully.";
		 $_SESSION['delete_recycle_bin2']=$_SESSION['delete_answer_id'];
	}
}	
//_____________________________________________/Delete Question________________________________________________________-->
?>















<html>
 <head>
  <title>
Answers Page
  </title>
 </head>
<body>













<?php
$obj_type=$_SESSION['objective_type'];
?>







<h1 align="center" style="color:green;">Insert Answers of '<?php echo " <span style='color:red;'>".$obj_type."</span>"; ?>'</h1>


<?php // _____________________________________________USER INTERFACE_________________________________________5______________?>
<form method="POST">
  <table align="center" border="1">
  <tr>
   <td>Select Question :</td>
   <td><select style="width:500px;height:30px;" name="question_id" required >

<?php

   if(isset($_SESSION['mcq_ready']))
{
$query_a="SELECT question_id,question,q_paper_id FROM question WHERE q_paper_id='$q_paper_id' ";
}
else if(isset($_SESSION['tf_ready']))
{
$query_a="SELECT question_id,question,q_paper_id FROM tf_questions WHERE q_paper_id='$q_paper_id' ";
}
else if(isset($_SESSION['fb_ready']))
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
<?PHP //unset($_SESSION['fb_ready']); 
//$_SESSION['mcq_ready']="A";
 ?>
  <td colspan="2">
  <?php   if(isset($_SESSION['mcq_ready']))
  {
	  
	  ?>
	  <?php /*
	  <!--
      <input type="checkbox" name="option_name" <?php if(isset($edit_option_name) && $edit_option_name=='A') { ?> checked <?php } ?> value="A"  >A</input>
      <input type="checkbox" name="option_name" <?php if(isset($edit_option_name) && $edit_option_name=='B') { ?> checked <?php } ?> value="B"  >B</input>
	  <input type="checkbox" name="option_name" <?php if(isset($edit_option_name) && $edit_option_name=='C') { ?> checked <?php } ?> value="C"  >C</input>
	  <input type="checkbox" name="option_name" <?php if(isset($edit_option_name) && $edit_option_name=='D') { ?> checked <?php } ?> value="D"  >D</input>
	  <input type="checkbox" name="option_name" <?php if(isset($edit_option_name) && $edit_option_name=='E') { ?> checked <?php } ?> value="E"  >E</input>
  -->
  */ ?>
  
  <table>
  <tr>
  <td style="width:106px;text-align:right;background-color:maroon;"><input style="width:40px;height:30px;text-align:center;" readonly  type="text" name="option_name[]" value="A" /></td>
  <td><input style="width:500px;height:30px;" type="text" name="answer[]"  /></td>
  </tr>
  <tr>
  <td style="width:106px;text-align:right;background-color:maroon;"><input  readonly style="width:40px;height:30px;text-align:center;" type="text" name="option_name[]" value="B" /></td>
  <td><input style="width:500px;height:30px;" type="text" name="answer[]"  /></td>
  </tr>
  <tr>
  <td style="width:106px;text-align:right;background-color:maroon;"><input readonly style="width:40px;height:30px;text-align:center;" type="text" name="option_name[]" value="C" /></td>
  <td><input style="width:500px;height:30px;" type="text" name="answer[]"  /></td>
  </tr>
  <tr>
  <td style="width:106px;text-align:right;background-color:maroon;"><input readonly style="width:40px;height:30px;text-align:center;" type="text" name="option_name[]" value="D" /></td>
  <td><input style="width:500px;height:30px;" type="text" name="answer[]"  /></td>
  </tr>
  <tr>
  <td style="width:106px;text-align:right;background-color:maroon;"><input readonly style="width:40px;height:30px;text-align:center;" type="text" name="option_name[]" value="E" /></td>
  <td><input style="width:500px;height:30px;" type="text" name="answer[]"  /></td>
  </tr>
  </table>
  
  <?php
  }
  
  ?>
  
  <?php   if(isset($_SESSION['tf_ready']))
  {
	  ?>
      <input type="checkbox" name="option_name"
	  <?php if(isset($edit_option_name) && $edit_option_name=='A') { ?> checked <?php }  ?>   value="A">A</input>
      <input type="checkbox" name="option_name" <?php if(isset($edit_option_name) && $edit_option_name=='B') {  ?> checked <?php } ?>   value="B">B</input>
  <?php
  }
  
  ?>
  
  
  <?php   if(isset($_SESSION['fb_ready']))
  {
	  ?>
      <input type="checkbox" name="option_name" <?php if(isset($edit_option_name) && $edit_option_name=='A') { ?> selected <?php } ?> value="A" checked >A</input>
    <?php
  }
  ?>
  
  </td>
</tr>

 <tr>
  <!--<td>Possible Answer :</td>-->
  <td>Correct Answer</td>
  <?php /* ?><td>
  <?php
   if(!isset($_SESSION['tf_ready']))
  {
	  ?>
  <input type="text" name="ans" value="<?php if(isset($edit_ans)) { echo $edit_ans; } ?>" required > </input>
  <?php
  }
  else
  {
	  ?>
	  <input type="checkbox" name="ans" value="True" <?php if(isset($edit_ans) && $edit_ans=='True') {  ?> checked <?php } ?>  >True</input>
	  <input type="checkbox" name="ans" value="False"  <?php if(isset($edit_ans) && $edit_ans=='False') { ?>   checked <?php } ?>  >False</input>
	  <?php
  }
  ?>
  </td>
  */ ?>
  <td><input style="width:500px;height:30px;" placeholder="Enter Correct Option" type="text" name="answer[]"  />
  <!--<select style="width:500px;height:30px;" name="correct_ans" placeholder="Select correct answer">
  <option value="Null">Enter Correct Option</option>
  <option value="A">A</option>
  <option value="B">B</option>
  <option value="C">C</option>
  <option value="D">D</option>
  <option value="E">E</option>
  </select>
  -->
  </td>
 </tr>
 <?php /* 
  <tr>
    <td>Correct Answer :</td>
	<td>
	<?php
	if(isset($_SESSION['fb_ready']))
	{
	?>
	    <input type="checkbox" name="correct_ans"  checked value="Yes">Correct</input>
	<?php
	}
	else
	{
?>	
        <input type="checkbox" name="correct_ans" <?php if(isset($edit_correct_ans) && $edit_correct_ans=='Yes') { ?> checked <?php } else { } ?> 
       		value="Yes">Correct</input>
		<input type="checkbox" name="correct_ans"  <?php if(isset($edit_correct_ans) && $edit_correct_ans=='No') { ?> checked <?php } ?>
           		value="No">In-Correct</input>
	
	<?php
	}
	?>
	</td>
  </tr>
  */ ?>
  <tr>
  <td>Status :</td>
  <td><select style="width:500px;height:30px;" name="status">
      <option value="Active" <?php if(isset($edit_status) && $edit_status=='Active') { ?> selected <?php } ?> >Active</option>
	  <option value="Block"  <?php if(isset($edit_status) && $edit_status=='Block') { ?> selected <?php } ?> >Block</option>
	  </select>
  </td>
  </tr>
 <tr>
   <td colspan="2" align="center"><input style="cursor:pointer;width:100px;height:50px;background-color:navy;color:white;cursor:pointer;" type="submit" name="<?php echo $button; ?>" value="<?php echo $button; ?>" /></td>
 </tr>
 </table>
</form>

</body>
</html>
<?php // ___________________________________________/USER INERFACE___________________________________________________________?>














<?php
	// _________________________________________ Button Setting _____________________________________________________
?>

<?php
if(!isset($_SESSION['edit_answers']) && !isset($_SESSION['set_btn2']) && !isset($_SESSION['return_back']))
{
	?>
	<br><br><br>
<form align="center" method="get">

	<input style="cursor:pointer;width:100px;height:50px;background-color:navy;color:white;cursor:pointer;border-radius:4px;" type="submit" name="<?php echo $btn_name; ?>" value="<?php echo $btn_value; ?>" />

</form>	
<br>
<?php
     }
	// _________________________________________ /Button Setting _____________________________________________________
?>








<?php
if(isset($check))
{
echo "<h3 style='color:red;align:center'>".$check."</h3>";
}
?>








<br><br>


<?php // ________________________________DISPLAY OF ANSWER TABLE____________________________________________6______________?>
<?php
echo "<h1 align='center' style='color:green;'>Answers ( Database ) </h1>";
 if(isset($_SESSION['mcq_ready']))
{
$query_b="SELECT q.question_id Q_ID, q.q_paper_id, q.question, a.question_id AQ_ID, a.ans_id, a.option_name,a.ans,
 a.correct_ans, a.status FROM question q, answers a WHERE q.question_id=a.question_id && q.q_paper_id='$q_paper_id' ";
}
else if(isset($_SESSION['tf_ready']))
{
$query_b="SELECT q.question_id Q_ID, q.q_paper_id, q.question, a.question_id AQ_ID, a.ans_id, a.option_name,a.ans,
 a.correct_ans, a.status FROM tf_questions q, tf_answers a WHERE q.question_id=a.question_id && q.q_paper_id='$q_paper_id' ";
}
else if(isset($_SESSION['fb_ready']))
{
$query_b="SELECT q.question_id Q_ID, q.q_paper_id, q.question, a.question_id AQ_ID, a.ans_id, a.option_name,a.ans,
 a.correct_ans, a.status FROM fb_questions q, fb_answers a WHERE q.question_id=a.question_id && q.q_paper_id='$q_paper_id' ";
}
 
$result_b=mysqli_query($con,$query_b);
?>

<table border="1" align="center">
 <tr style="text-align:center;font-weight:bold;">
 <td>Question_ID</td>
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
 
  <td><?php echo $row_b['Q_ID']; ?></td>
  <td><?php echo $row_b['question']; ?></td>
  <td><?php echo $row_b['option_name']; ?></td>
  <td><?php echo $row_b['ans']; ?></td>
  <td><?php echo $row_b['correct_ans']; ?></td>
  <td><?php echo $row_b['status']; ?></td>
  <td><a href="two_choices_answer_sheet.php?edit_answer_id=<?php echo $row_b['ans_id']; ?>"> Edit</a></td>
  <td><a href="two_choices_answer_sheet.php?delete_answer_id=<?php echo $row_b['ans_id']; ?>"> Delete</a></td>
</tr>
<?php	
}	
 ?>
 
</table>
<?php
}
//____________/_________________________________END________________________________________________________/_____-->
?>

