<?php
session_start();
include "connection.php";
unset($_SESSION['mcq_choices']);




$btn_name="back";
//$btn_value="";

if(isset($_SESSION['fb_ready']))
{
$total_questions=$_SESSION['quan_fb'];
$obj_type="Fill in Blanks";
$btn_value="Next";

}
else if(isset($_SESSION['tf_ready']))
{
$total_questions=$_SESSION['quan_tf'];
$obj_type="True False";
$btn_value="Next";	
}
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














































<?php
if(isset($_SESSION['mix_paper']))
{
	$mix="Mix paper Has set.";

if(isset($_SESSION['short_questions']) && isset($_SESSION['fb_ready']))
{
	$btn_name="goto";
	$btn_value="Next";
}
else if(isset($_SESSION['long_questions']) && isset($_SESSION['fb_ready']))
 {
	 $btn_name="goto";
     $btn_value="Next";	
    }
}
?>
<?php // ---------------------------------------Edit Answers---------------------------------------------------------------- ?>





















































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




<h2 align="left" style="font-size:35px;color:purple;text-align:center">Objective Paper(<span style="font-size:25px;"> True False & Fill in Blanks </span>) </h2>

<br><br><br>

</body>
<!-- ------------------------------------------------- /First Header ---------------------------------------------- -->































<?php
// _________________________________________ Button Setting _____________________________________________________
if(isset($_POST['back']) || isset($_GET['questions']))
{
	$finish_check=$_SESSION['finish_check'];
	if($finish_check==$total_questions)
	{
	header ("Location:combination_3.php");
	}
	else
		$error2="Error:- Please insert All Questions.";
	
}
// ------------------------------------------ Go To Next Subjective ----------------------------------------------
    if(isset($_POST['goto']))
{
	
	$finish_check=$_SESSION['finish_check'];
	    if(isset($_SESSION['short_questions']))
	{
		if($total_questions==$finish_check)
		{
	 header ("Location:short_q_paper.php");
		}
		else
			$error2="Error:- Please insert All Questions.";
	}
	  else if(isset($_SESSION['long_questions']))
	{
		if($total_questions==$finish_check)
		{
	 header ("Location:long_q_paper.php");
		}
		$error2="Error:- Please insert All Questions.";
	}
}
// ------------------------------------------ / Go To Next Subjective ---------------------------------------------


?>


<?php
/*
if(!isset($_SESSION['edit_answers']) && !isset($_SESSION['set_btn2']))
{
	?>
<form method="get" align="center">

	<input style="width:150px;height:50px;background-color:lightgrey;color:black;" type="submit" name="<?php echo $btn_name; ?>" value="<?php echo $btn_value; ?>" />

</form>	
<br>
<?php
     }
	 
	// _________________________________________ /Button Setting _____________________________________________________

*/	?>


























<?php

// ----------------------------------------------- Go To Subjective -------------------------------------------------------

if(isset($_GET['go_to']))
{
	if(isset($_SESSION['222_one']))
	{
	header ("Location:short_q_paper.php");
	}
	if(isset($_SESSION['two_sss']) || isset($_SESSION['double_3']))
	{
	header ("Location:long_q_paper.php");
	}
}

// ----------------------------------------------- /Go To Subjective -------------------------------------------------------

?>






















<?php


# ------------------------------------------------------- Display Paper --------------------------------------------------

if(isset($_GET['disp_paper']))
{
unset($_SESSION['mcq_ready']);
unset($_SESSION['tf_ready']);
unset($_SESSION['fb_ready']);
if(isset($_SESSION['set_btn2']) || isset($_SESSION['222_one']) || isset($_SESSION['two_sss']) || isset($_SESSION['double_3']))
{
	header ('Location:comb_obj_sub_print.php');
}
 else
      header ("Location:comb_3_obj_print_paper.php");
}
 if(isset($_GET['mcq_ans']))
{
    $_SESSION['mcq_ready']="You Are Ready To Edit Answers Of MCQs.";
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
   $_SESSION['fb_ready']="You Are Ready To Edit Answers Of Fill In Blanks.";
	unset($_SESSION['tf_ready']);
	unset($_SESSION['mcq_ready']);
}
# ------------------------------------------------------- /Display Paper --------------------------------------------------

?>











<?php
if(isset($_SESSION['edit_answers']) || isset($_SESSION['set_btn2']) || isset($_SESSION['return_back']) && isset($_SESSION['done']))
{
?>
<center><span align="center" style="color:Navy;font-size:40px;">Answers Of Created Questions<br><br></span></center>
<?php
}
?>





<?php
// -------------------------------------------- Buttons Edit Mode -----------------------------------------------------------

if((isset($_SESSION['edit_answers']) || isset($_SESSION['set_btn2']) || isset($_SESSION['return_back']))
	&& !isset($_SESSION['refresh']) && isset($_SESSION['done'])  && !isset($_SESSION['edit_update'] ))
{
	//$_SESSION['mcq_ready']="Ready";
	?>
	<center>
	<form method="get">
	<table>
	<tr>
	<td colspan="4" style="color:Navy;font-size:40px;text-align:center;"></td>
	</tr>
	<?php if(!isset($_SESSION['refresh'])) { ?>
	<tr>
	<td><input style="border:none;border-radius:4px;cursor:pointer;width:200px;height:50px;background-color:navy;color:white;"
<?php if (isset($_SESSION['edit_update'])) { ?> disabled <?php } ?>	type="submit" name="tf_ans" value="Show True False (Answers)" /></td>
	<td><input style="border:none;border-radius:4px;cursor:pointer;width:200px;height:50px;background-color:navy;color:white;"
<?php if (isset($_SESSION['edit_update'])) { ?> disabled <?php } ?>	type="submit" name="fb_ans" value="Show Fill in Blanks (Answers)" /></td>
	<td><input style="border:none;border-radius:4px;cursor:pointer;width:200px;height:50px;background-color:navy;color:white;"
<?php if (isset($_SESSION['edit_update'])) { ?> disabled <?php } ?>	type="submit" name="questions" value="Edit Questions" /></td>
	<?php if(isset($_SESSION['222_one']) || isset($_SESSION['two_sss']) || isset($_SESSION['double_3'])) { ?>
	<td><input style="border:none;border-radius:4px;cursor:pointer;width:200px;height:50px;background-color:navy;color:white;"
<?php if (isset($_SESSION['edit_update'])) { ?> disabled <?php } ?>	type="submit" name="go_to" value="Go To Subjective" /></td>
	<?php } ?>
	<td><input style="border:none;border-radius:4px;cursor:pointer;width:200px;height:50px;background-color:navy;color:white;"
<?php if (isset($_SESSION['edit_update'])) { ?> disabled <?php } ?>	type="submit" name="disp_paper" value="Display Paper" /></td>
	<!--<td><input style="cursor:pointer;width:200px;height:50px;background-color:lightgrey;color:black;" type="submit" name="save_paper" value="Save Paper" /></td>-->
	</tr>
	<?php } ?>
	</table>
</form>	
</center>
<?php if(isset($_SESSION['refresh'])) {
	?>
	<!--<center><form method="get">
<input style="border-radius:4px;border:none;height:50px;width:100px;background-color:navy;color:white;cursor:pointer;" type="submit" name="refresh" value="Refresh" />
</form></center>-->
	<?php
} ?>
<br><br>

	<?php
}
// -------------------------------------------- /Buttons Edit Mode -----------------------------------------------------------

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
//unset($_SESSION['tf_ready']);
//$_SESSION['fb_ready']="abc";
//------------------------------------------------Button Conversion Of Mix Questions Paper Page---------------------------------------------------
 if(isset($_SESSION['tf_ready']))
{
	$_SESSION['tf_ready']="True False Ready";
	$_SESSION['button_name']="next2";
	$_SESSION['button_value']="Next";
}
else if(isset($_SESSION['fb_ready']))
{
      $_SESSION['fb_ready']="Fill in Blanks Ready";
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
 
 
 //--------------------------------------No Repeatition Of Question-----------------------------------------------------
if(isset($_POST['Insert']))
{
	$question_id=$_POST['question_id'];
	if(isset($_SESSION['tf_ready']))
	{
        $query_z="SELECT * FROM tf_answers";
	} else if(isset($_SESSION['fb_ready']))
	{
		$query_z="SELECT * FROM fb_answers";
	}
$run_z=mysqli_query($con,$query_z);
while($row_z=mysqli_fetch_array($run_z))
 {
	if($row_z['question_id']==$question_id)
	{
	  $error="Failed ! You have already Inserted this Question.";	
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
	   if(isset($_SESSION['tf_ready']))
	 {
     $query_c="INSERT INTO  tf_answers(option_name,ans,question_id,correct_ans,status)
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
		$_SESSION['finish_check']=$_SESSION['finish_check']+1;
		$check="Successfully inserted into database.";
	}
	else
	{
		//$check="Failed.";
	}
} 
//_____________________________________________/Insertion  Of Answer________________________________________________________-->
?>










<?php
//_____________________________________________Edit Question______________________________________2_________________-->
/*if(isset($_REQUEST['edit_answer_id']) && !isset($_SESSION['edit_recycle_bin2']) ||
   isset($_REQUEST['edit_answer_id']) &&  $_REQUEST['edit_answer_id']!=$_SESSION['edit_recycle_bin2'])*/
   if(isset($_REQUEST['edit_answer_id']) && !isset($_POST['Update']))
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
	$update_ans = str_replace("'","\'",$update_ans);
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
<body style="background-color:white;">










































 <?php
 //unset($_SESSION['done']);
// --------------------------------------------- Insert Objective Answers Message ---------------------------------------------
 if(!isset($_SESSION['done']))
	{ 
 
//$_SESSION['insert_num']=1;
?>

<?php if(isset($_SESSION['fb_ready'])) { ?>
<h1 align="center" style="color:navy;">Insert '<?php echo "<span style='color:red;'>Fill in Blanks</span>"; ?>' Answers</h1>
<?php } else if(isset($_SESSION['tf_ready'])) { 
?>
<h1 align="center" style="color:navy;">Insert '<?php echo "<span style='color:red;'>True False</span>"; ?>' Answers</h1>
<?php
 } ?>
<?php
 //} // AFTER COMPLETION OF QUESTIONS ALERT............................
 
 }// WHEN NOT SET DONE...............
// --------------------------------------------- /Insert Objective Answers Message ---------------------------------------------
?>
































<?php
// --------------------------------------- Insertion Message Or Failed Message -----------------------------------------

if(isset($check))
{
echo "<h3 style='color:green;text-align:center;'>".$check."</h3>";
}
?>

<?php
if(isset($error))
{
echo "<h3 style='color:red;text-align:center;'>".$error."</h3>";
  } 
  if(isset($error2))
{
echo "<h3 style='color:red;text-align:center;'>".$error2."</h3>";
  }
 // END
// --------------------------------------- /Insertion Message Or Failed Message ----------------------------------------- 
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

<!----------------------------------------------------- QUESTIONS DISPLAY --------------------------------------------> 









































































<!-----------------------------------------------------FILL IN BLANKS DISPLAY------------------------------------------------>

<?php
 if(isset($_SESSION['fb_ready']))
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
 <!-----------------------------------------------------/FILL IN BLANKS DISPLAY------------------------------------------------>
 
  
 
 
 
 
 
 
 
 
 <?PHP

//$query_v="DELETE FROM answers";
//$run=mysqli_query($con,$query_v);

?>
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 


 
	 



















 
<!--------------------------------------------- TRUE FALSE CORRECT ANSWER DISPLAY ----------------------------------------> 
 
<?php

if(isset($_SESSION['tf_ready']))
{
	
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
<!------------------------------------------------ /TRUE FALSE CORRECT ANSWER DISPLAY --------------------------------> 
 






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
   <input style="border-radius:4px;border:none;cursor:pointer;width:100px;height:50px;background-color:navy;color:white;" type="submit" name="<?php echo $button; ?>" value="<?php echo $button; ?>" />
   
   <form method="get" style="float:left;">
   <?php  if(isset($_SESSION['mcq_ready'])) { ?>
   <input style="border-radius:4px;cursor:pointer;width:100px;height:50px;background-color:navy;color:white;border-radius:4px;" type="submit" name="<?php echo "skip"; ?>" value="<?php echo "Skip Option"; ?>" />
   <input style="border-radius:4px;cursor:pointer;width:100px;height:50px;background-color:navy;color:white;border-radius:4px;" type="submit" name="<?php echo "add"; ?>" value="<?php echo "Add Option"; ?>" />
   <?php } ?>  
  <input style="border-radius:4px;float:left;border:none;cursor:pointer;width:100px;height:50px;background-color:navy;color:white;border-radius:4px;" type="submit" name="<?php echo "clear"; ?>" value="<?php echo "Clear"; ?>" />
   </form>
   </td>
 
 </tr>
 </table>

 
 
 <form method="post" >
 <br><table style="width:1180px;" >
   <tr> 
   <td align="right" ><input style="border:none;cursor:pointer;width:100px;height:50px;background-color:navy;color:white;border-radius:4px;" type="submit" name="<?php echo $btn_name; ?>" value="<?php echo $btn_value; ?>" />   
  </td></tr>
  </table>
 
 
 
 
<?php
 }
	
 //END OF INPUT SESSION..... ?>
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
  <td><input style="padding:20px;width:900px;height:40px;" <?php if(!isset($edit_ans)) { ?> readonly <?php } ?> type="text" name="ans"
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
 
 
 
 
 
 
 
 
 
 
 
 
 
 







































<?php // ________________________________DISPLAY OF ANSWER TABLE____________________________________________6______________?>

<?php
if(!isset($_SESSION['refresh']) && !isset($_SESSION['edit_update']))
{
 if(isset($_SESSION['tf_ready'])) { 
echo "<h1 align='center' style='color:navy;'><br><br>Answers ( <span style='color:red;'>True False</span> ) </h1>";
 } else  if(isset($_SESSION['fb_ready'])) { 
 echo "<h1 align='center' style='color:navy;'><br><br>Answers ( <span style='color:red;'>Fill in Blanks</span> ) </h1>";
 }
?>



<?php
//echo "<h1 align='center'>Display of Answer Table.</h1>";
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
  <?php if(!isset($_SESSION['tf_ready'])) { ?>
  <td colspan="2">Operations</td>
  <?php  
  }
  ?>
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
  <?php if(!isset($_SESSION['tf_ready'])) { ?>
  <td><a href="combination_3_answer_sheet.php?edit_answer_id=<?php echo $row_b['ans_id']; ?>"> Edit</a></td>
  <td><a href="combination_3_answer_sheet.php?delete_answer_id=<?php echo $row_b['ans_id']; ?>"> Delete</a></td>
  <?php
  }
  ?>
  </tr>
<?php	
}	
 ?>
 
</table>
<?php
}
} // WHEN NOT SET REFRESH AND UPDATE
//____________/_________________________________END________________________________________________________/_____-->
?>

