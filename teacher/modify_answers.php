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
































<?php

// ------------------------------------------- Skip Option ------------------------------------------------------------

if(isset($_GET['skip']) && isset($_SESSION['mcq_ready']))
{
	$_SESSION['mcq_choices']=$_SESSION['mcq_choices']-1;
}
if(isset($_GET['add']) && isset($_SESSION['mcq_ready']))
{
	$_SESSION['mcq_choices']=$_SESSION['mcq_choices']+1;
}
if(isset($_GET['clear']))
{
	//$_SESSION['mcq_choices']=$_SESSION['mcq_choices']+1;
}
if(isset($_SESSION['mcq_ready']))
{
$total_choices=$_SESSION['mcq_choices'];
}

// ------------------------------------------- /Skip Option ------------------------------------------------------------


?>





































<?php
$obj_type=$_SESSION['type_name'];
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
	$_SESSION['done1']="All Data Inserted Successfully.";
	}
}

//------------------------------------------------/Button Conversion Of Mix Questions Paper Page---------------------------------------------------
?>

































<?php

$button="Insert";

?>










<?php
/*
//$_SESSION['check_rep']=1;
$check_rep=$_SESSION['check_rep'];
$counter=1;
if(isset($_POST['Insert']))
{
	if(!isset($_SESSION['recycle_bin']))
	{
	$_SESSION['recycle_bin'][$check_rep]=$_POST['question_id'];
	}
	else if(isset($_SESSION['recycle_bin']))
	{
		foreach($_SESSION['recycle_bin'] as $repeat )
		{
			if($repeat==$_POST['question_id'])
			{
				$error="You have already Inserted this Question.";
			}
			$able="yes";
		}
	}
	if(isset($able))
	{
		$_SESSION['recycle_bin'][$check_rep]=$_POST['question_id'];
	}
}

 */
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 //--------------------------------------No Repeatition Of Question-----------------------------------------------------
if(isset($_POST['Insert']))
{
	$question_id=$_POST['question_id'];
	if(isset($_SESSION['mcq_ready']))
	{
        $query_z="SELECT * FROM answers";
	} else if(isset($_SESSION['fb_ready']))
	{
		$query_z="SELECT * FROM fb_answers";
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
	
	 $option_name  =  $_POST['option_name'][$var++];
	 $correct_ans=0;
	 if($option_name==$correct)
	 {
		 $correct_ans=$correct;
	 }
	 $question_id  =  $_POST['question_id'];
	
	 $status       =  $_POST['status'];
	                                             //INSERT QUERY.....................
	   if(isset($_SESSION['mcq_ready']))
	 {
     $query_c="INSERT INTO  answers(option_name,ans,question_id,correct_ans,status)
                            VALUES('$option_name', '$ans', '$question_id', '$correct_ans', '$status')";
	 }
	 /*
	 else if(isset($_SESSION['tf_ready']))
	{
     $query_c="INSERT INTO  tf_answers(option_name,ans,question_id,correct_ans,status)
                            VALUES('$option_name', '$ans', '$question_id', '$correct_ans', '$status')";
	 }
	 */
	 else if(isset($_SESSION['fb_ready']))
	 {
     $query_c="INSERT INTO  fb_answers(option_name,ans,question_id,correct_ans,status)
                            VALUES('$option_name', '$ans', '$question_id', '$correct_ans', '$status')";
	 }
	 
	$result_c=mysqli_query($con,$query_c);
	  }
	}
	if(isset($result_c))
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
	$update_correct_ans=" ";
      if(isset($_POST['correct_ans']))
	  {
		  $update_correct_ans=$_POST['correct_ans'];
	  }		  
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




















<h1 align="center" style="color:navy;">Insert '<?php echo "<span style='color:red;'>".$obj_type."</span>"; ?>' Answers</h1>
<br><br>







<?php
if(isset($check))
{
echo "<h3 style='color:red;text-align:center;'>".$check."</h3>";
}
?>

<?php
if(isset($error))
{
echo "<h3 style='color:red;text-align:center;'>".$error."</h3>";
}
?>




























<?php // _____________________________________________USER INTERFACE_________________________________________5______________?>
<?php 
if(!isset($_SESSION['done']))
	{ ?>
<form method="POST">
  <table align="center" border="1">
  <tr>
   <td>Select Question :</td>
   <td><select style="width:900px;height:40px;" name="question_id" required >

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

 <td colspan="2">
 <?php
 if(isset($_SESSION['mcq_ready']))
  {
	  ?>
 <table>
 <?php
  //$_SESSION['mcq_choices']="4";
  
  $a="A";
  $inc=0;
  
 for($i=1;$i<=$total_choices;$i++) { ?>
  <tr>
  <td style="width:106px;text-align:right;background-color:maroon;"><input style="width:40px;height:40px;text-align:center;" readonly  type="text" name="option_name[]" value="<?php echo $a++; ?>" required /></td>
  <td><input style="width:900px;height:40px;" type="text" name="answer[]"
                value="<?php if(isset($_POST['answer'])) { echo $_POST['answer'][$inc++]; } ?>"  required  /></td>
  </tr>
  <?php
 }
 ?>
 
 </table>
 
 <?php
  }// END OF MCQ OPTIONS TABLE .......................
  ?>
  
  
  
  <?php
 if(isset($_SESSION['fb_ready']))
  {
	  unset($_SESSION['mcq_choices']);
	  ?>
 <table>
 <?php
  //$_SESSION['mcq_choices']="4";
  
  $a="A";
  $inc=0;
 for($i=1;$i<=1;$i++) { ?>
  <tr>
  <td style="width:106px;text-align:right;"><input style="width:40px;height:40px;text-align:center;" readonly  type="hidden" name="option_name[]" value="<?php echo $a++; ?>" required />Correct Answer</td>
  <td><input  style="width:900px;height:40px;" type="text" name="answer[]"
                value="<?php if(isset($_POST['answer'])) { echo $_POST['answer'][$inc++]; } ?>"  required  /></td>
  </tr>
  <?php
 }
 ?>
 
 </table>
 
 <?php
  }// END OF FILL IN BLANKS TABLE .......................
  ?>
 
  
  
  
  
  <?php /*
  <tr>
  <td style="width:106px;text-align:right;background-color:maroon;"><input  readonly style="width:40px;height:40px;text-align:center;" type="text" name="option_name[]" value="B" required /></td>
  <td><input style="width:900px;height:40px;" type="text" name="answer[]" required  /></td>
  </tr>
  <tr>
  <td style="width:106px;text-align:right;background-color:maroon;"><input readonly style="width:40px;height:40px;text-align:center;" type="text" name="option_name[]" value="C" required /></td>
  <td><input style="width:900px;height:40px;" type="text" name="answer[]" required  /></td>
  </tr>
  <tr>
  <td style="width:106px;text-align:right;background-color:maroon;"><input readonly style="width:40px;height:40px;text-align:center;" type="text" name="option_name[]" value="D" required /></td>
  <td><input style="width:900px;height:40px;" type="text" name="answer[]" required  /></td>
  </tr>
  <tr>
  <td style="width:106px;text-align:right;background-color:maroon;"><input readonly style="width:40px;height:40px;text-align:center;" type="text" name="option_name[]" value="E" required /></td>
  <td><input style="width:900px;height:40px;" type="text" name="answer[]" required  /></td>
  </tr>
  */ ?>
 
  

  <?php /* <td>
  <?php   if(isset($_SESSION['mcq_ready']))
  {
	  ?>
      <input type="checkbox" name="option_name" <?php if(isset($edit_option_name) && $edit_option_name=='A') { ?> checked <?php } ?> value="A"  >A</input>
      <input type="checkbox" name="option_name" <?php if(isset($edit_option_name) && $edit_option_name=='B') { ?> checked <?php } ?> value="B"  >B</input>
	  <input type="checkbox" name="option_name" <?php if(isset($edit_option_name) && $edit_option_name=='C') { ?> checked <?php } ?> value="C"  >C</input>
	  <input type="checkbox" name="option_name" <?php if(isset($edit_option_name) && $edit_option_name=='D') { ?> checked <?php } ?> value="D"  >D</input>
	  <input type="checkbox" name="option_name" <?php if(isset($edit_option_name) && $edit_option_name=='E') { ?> checked <?php } ?> value="E"  >E</input>
  <?php
  }
  
  ?>
  <? /*
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
     <?php /* <input type="checkbox" name="option_name" <?php if(isset($edit_option_name) && $edit_option_name=='A') { ?> selected <?php } ?> value="A" checked >A</input>  ?>
    
  }
  
  */ ?>
  
  </td>
</tr>
<?php if(isset($_SESSION['mcq_ready'])) { ?>
 <tr>
  <td>Correct Answer :</td>
    <?php
  /*
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
 <!--<td><input style="width:500px;height:30px;" placeholder="Enter Correct Option" type="text" name="correct_ans"  /></td>-->
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
}        //MCQS RADIO BUTTONS........



if(isset($_SESSION['fb_ready']))
{
	?>
	<input type="hidden" name="correct_ans" value="<?php if(isset($edit_correct_ans)) { echo $edit_correct_ans; } else echo "A"; ?>"
	<?php
}









	?>
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
  <td><select style="width:900px;height:40px;" name="status">
      <option value="Active" <?php if(isset($edit_status) && $edit_status=='Active') { ?> selected <?php } ?> >Active</option>
	  <option value="Block"  <?php if(isset($edit_status) && $edit_status=='Block') { ?> selected <?php } ?> >Block</option>
	  </select>
  </td>
  </tr>
 <tr>
   <td colspan="2" align="center">
   <input style="cursor:pointer;width:100px;height:50px;background-color:navy;color:white;" type="submit" name="<?php echo $button; ?>" value="<?php echo $button; ?>" />
   </form>
   <form method="get">
   <input style="float:right;cursor:pointer;width:100px;height:50px;background-color:navy;color:white;border-radius:4px;" type="submit" name="<?php echo $btn_name; ?>" value="<?php echo $btn_value; ?>" />
   <input style="float:left;cursor:pointer;width:100px;height:50px;background-color:navy;color:white;border-radius:4px;" type="submit" name="<?php echo "skip"; ?>" value="<?php echo "Skip Option"; ?>" />
   <input style="float:left;cursor:pointer;width:100px;height:50px;background-color:navy;color:white;border-radius:4px;" type="submit" name="<?php echo "add"; ?>" value="<?php echo "Add Option"; ?>" />
   <input style="float:left;cursor:pointer;width:100px;height:50px;background-color:navy;color:white;border-radius:4px;" type="submit" name="<?php echo "clear"; ?>" value="<?php echo "Clear"; ?>" />
   </form>
   </td>
 
 </tr>
 </table>

<?php } //END OF INPUT SESSION..... ?>
<?php // ___________________________________________/USER INERFACE___________________________________________________________?>

<?php
//$_SESSION['done']="a";






























//----------------------------------------------------Update Interface-------------------------------------------------->

 if(isset($_SESSION['done']) ) { ?>
<form method="POST">
  <table align="center" border="1">
  <tr>
   <td>Select Question :</td>
   <td><select style="width:900px;height:40px;" name="question_id" <?php if(!isset($edit_question_id)) { ?> disabled <?php } ?>  required >

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

 <td colspan="2">
 <table>
 <?php
  //$_SESSION['mcq_choices']="4";
  
 //for($i=1;$i<=$total_choices;$i++) { ?>
  <tr>
  <td style="width:106px;text-align:right;background-color:maroon;"><input style="width:40px;height:40px;text-align:center;" readonly  type="text" name="option_name" value="<?php if(isset($edit_option_name)) { echo $edit_option_name; } ?>" required /></td>
  <td><input style="width:900px;height:40px;" <?php if(!isset($edit_ans)) { ?> readonly <?php } ?> type="text" name="ans"
                value="<?php if(isset($edit_ans)) { echo $edit_ans; } ?>"  required  /></td>
  </tr>
  <?php
 //}
  ?>
  <?php /*
  <tr>
  <td style="width:106px;text-align:right;background-color:maroon;"><input  readonly style="width:40px;height:40px;text-align:center;" type="text" name="option_name[]" value="B" required /></td>
  <td><input style="width:900px;height:40px;" type="text" name="answer[]" required  /></td>
  </tr>
  <tr>
  <td style="width:106px;text-align:right;background-color:maroon;"><input readonly style="width:40px;height:40px;text-align:center;" type="text" name="option_name[]" value="C" required /></td>
  <td><input style="width:900px;height:40px;" type="text" name="answer[]" required  /></td>
  </tr>
  <tr>
  <td style="width:106px;text-align:right;background-color:maroon;"><input readonly style="width:40px;height:40px;text-align:center;" type="text" name="option_name[]" value="D" required /></td>
  <td><input style="width:900px;height:40px;" type="text" name="answer[]" required  /></td>
  </tr>
  <tr>
  <td style="width:106px;text-align:right;background-color:maroon;"><input readonly style="width:40px;height:40px;text-align:center;" type="text" name="option_name[]" value="E" required /></td>
  <td><input style="width:900px;height:40px;" type="text" name="answer[]" required  /></td>
  </tr>
  
  Null</td>
  
  */ ?>
  </table>
  </td>
</tr>
<input style="width:900px;height:40px;" type="hidden" value="<?php if(isset($edit_correct_ans)) echo $edit_correct_ans; ?>" name="correct_ans" readonly />
 <?php /* <tr>
  
  
  <td style="width:900px;height:40px;font-weight:bold;" >
 <?php
$alphabet = "A";
 if(isset($edit_correct_ans) && $edit_correct_ans==$alphabet)
 {
 for($i=1;$i<=$total_choices;$i++)
 {
	 ?>
	 <input style="width:70px;cursor:pointer;" type="radio" name="correct_ans" value="<?php echo $alphabet; ?>" 
<?php if(isset($edit_correct_ans) && $edit_correct_ans==$alphabet) { ?> checked <?php } ?>	 /><?php echo $alphabet++; ?>
	 <?php
 } ?>
 	 
 </td>
 </tr>
 */ ?>
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
   <input style="cursor:pointer;width:100px;height:50px;background-color:navy;color:white;" <?php if(!isset($edit_question_id)) { ?> disabled <?php } ?> type="submit" name="<?php echo "Update"; ?>" value="<?php echo "Update"; ?>" />
  
   <!--
   <form method="post">
   <input style="float:right;cursor:pointer;width:100px;height:50px;background-color:navy;color:white;border-radius:4px;" type="submit" name="<?php echo $btn_name; ?>" value="<?php echo $btn_value; ?>" />
   <input style="float:left;cursor:pointer;width:100px;height:50px;background-color:navy;color:white;border-radius:4px;" type="submit" name="<?php echo "skip"; ?>" value="<?php echo "Skip Option"; ?>" />
   <input style="float:left;cursor:pointer;width:100px;height:50px;background-color:navy;color:white;border-radius:4px;" type="submit" name="<?php echo "add"; ?>" value="<?php echo "Add Option"; ?>" />
   <input style="float:left;cursor:pointer;width:100px;height:50px;background-color:navy;color:white;border-radius:4px;" type="submit" name="<?php echo "clear"; ?>" value="<?php echo "Clear"; ?>" />
   </form>
   -->
   </td>
 
 </tr>
 </table>
 </form>
 
<?php
 //----------------------------------------------------/Update Interface-------------------------------------------------->
 } 
 ?>










<?php
	// _________________________________________ Button Setting _____________________________________________________

	/*
	?>

<?php
if(!isset($_SESSION['edit_answers']) && !isset($_SESSION['set_btn2']) && !isset($_SESSION['return_back']))
{
	?>
	
	
<form method="get">
<table>
<tr>
<td align="right" style="width:970px;">
	<input style="cursor:pointer;width:100px;height:50px;background-color:navy;color:white;border-radius:4px;" type="submit" name="<?php echo $btn_name; ?>" value="<?php echo $btn_value; ?>" />
</td>
</tr>
</table>
</form>	

<br>
<?php
     }
	// _________________________________________ /Button Setting _____________________________________________________
 */ ?>
















<br><br>


<?php // ________________________________DISPLAY OF ANSWER TABLE____________________________________________6______________?>
<?php
echo "<h1 align='center' style='color:navy;'>Answers ( ".$obj_type." ) </h1><br>";
?>
<?php

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
<form method="post" align="center">
<input style="cursor:pointer;width:100px;height:50px;background-color:navy;color:white;border-radius:4px;" type="submit" name="<?php echo "delete_all"; ?>" value="<?php echo "Delete All"; ?>" />
</form>  
<table border="1" align="center">
 <tr style="text-align:center;font-weight:bold;">
 <td>Question_ID</td>
  <td>Question</td>
  <?php if(isset($_SESSION['mcq_ready'])) { ?>
  <td>Option</td>
  <?php } ?>
  <?php if(isset($_SESSION['mcq_ready'])) { ?>
  <td>Possible_Answer</td>
  <?php }  ?>
  <?php if(isset($_SESSION['fb_ready'])) { ?>
  <td>Correct Answer</td>
  <?php } ?>
  <?php if(isset($_SESSION['mcq_ready'])) { ?>
  <td>Correct Answer</td>
  <?php } ?>
  <td>Status</td>
  <?php if(isset($_SESSION['done'])) { ?>
  <td colspan="2">Operations</td>
  <?php } ?>
</tr>

<?php
while($row_b=mysqli_fetch_array($result_b))

{
?>
 <tr style="text-align:center;">
 
  <td><?php echo $row_b['Q_ID']; ?></td>
  <td><?php echo $row_b['question']; ?></td>
  <?php if(isset($_SESSION['mcq_ready'])) { ?>
  <td><?php echo $row_b['option_name']; ?></td>
  <?php } ?>
  <td><?php echo $row_b['ans']; ?></td>
  <?php if(isset($_SESSION['mcq_ready'])) { ?>
  <td><?php echo $row_b['correct_ans']; ?></td>
  <?php } ?>
  <td><?php echo $row_b['status']; ?></td>
  <?php if(isset($_SESSION['done'])) { ?>
  <td><a href="modify_answers.php?edit_answer_id=<?php echo $row_b['ans_id']; ?>"> Edit</a></td>
  <td><a href="modify_answers.php?delete_answer_id=<?php echo $row_b['ans_id']; ?>"> Delete</a></td>
  <?php } ?>
</tr>
<?php	
}	
 ?>
 
</table>
<?php
}
//____________/_________________________________END________________________________________________________/_____-->
?>

</body>
</html>