<?php
session_start();
include "connection.php";












if(isset($_SESSION['mix_paper']))
{
	$mix=$_SESSION['mix_paper'];
	
	// ______________________________Check Combination In Mix( Obj,Sub ) Paper _______________________________//
if(isset($_SESSION['comb1']))
{
//echo $_SESSION['comb1'];
}
else if(isset($_SESSION['comb2']))
{
//echo $_SESSION['comb2'];
}
else if(isset($_SESSION['comb3']))
{
//echo $_SESSION['comb3'];
}
   }
// ______________________________*/Check Combination In Mix( Obj,Sub ) Paper/* _______________________________//


	
	
	
	
	
	
	
	
	
// ___________________________________________Go To Single Obj Sub Paper After Editing _____________________________________//
/*
if(isset($_GET['mix_1']))
{
 header ("Location:mix_obj_questions_paper.php");
}
*/
// ___________________________________________/Go To Single Obj Sub Paper After Editing_____________________________________//
	
	

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

$q_paper_id=$_SESSION['q_paper_id'];
$q_p_formate_id=$_SESSION['q_p_formate_id'];

if(!isset($mix))
{
$total_marks=$_SESSION['total_marks'];
}
else if(isset($mix))
 {
        $total_marks=$_SESSION['t_marks_sq'];
   }
   // ----------------------------------------------- Display Paper --------------------------------------------------------

   if(isset($_GET['disp_paper']))
 {
	 if(isset($_SESSION['set_btn2']) || isset($_SESSION['double_1']) || isset($_SESSION['double_2']) || isset($_SESSION['double_3']))
	 {
		 header ('Location:comb_obj_sub_print.php');
	   }
	 else 
		 if(isset($_SESSION['set_btn1']))
		 {
			 header ('Location:single_obj_sub_print.php');
		   }
		 else  
			 if(isset($_SESSION['paper1']) || isset($_SESSION['one_one']))
			 {
				 header ('Location:single_obj_sub_print.php');
			 } 
			 else  if(isset($_SESSION['2_one']) || isset($_SESSION['22_one'])  || isset($_SESSION['222_one']))
		 {
	          header ("Location:comb_obj_sub_print.php");   
		    }
			else  if(isset($_SESSION['mix_1']))
		 {
	          header ("Location:complete_mix_paper.php");   
		    }
			else 
			{
				header ('Location:short_q_print_paper.php');
			}
   }
   if(!isset($_SESSION['paper1']) && !isset($_SESSION['double_1']) && !isset($_SESSION['double_2']) && !isset($_SESSION['double_3'])) 
   {
   unset($_SESSION['show_q']);
   }
   if(isset($_GET['disp_ques']))
   {
	   $_SESSION['show_q']="Set";
   }
   
// ----------------------------------------------- /Display Paper --------------------------------------------------------
   
?>















<?php


?>




<?php
// ------------------------------------------------ Go To Objective -----------------------------------------------------
if(isset($_GET['go_to']))
{
	if(!isset($_SESSION['one_one']))
	{
	$_SESSION['section_back2']="Set";
	}
	
	if(isset($_SESSION['double_1']) || isset($_SESSION['double_2']) || isset($_SESSION['double_3']))
	{
		unset($_SESSION['show_q']);
	}
    if(isset($_SESSION['2_one']) || isset($_SESSION['double_1']))
	{
		
		header ("Location:combination_1.php");
	}
	else if(isset($_SESSION['22_one']) || isset($_SESSION['double_2']))
	{
		header ("Location:combination_2.php");
	}
	else if(isset($_SESSION['222_one']) || isset($_SESSION['double_3']))
	{
		header ("Location:combination_3.php");
		
	}
	else  if(isset($_SESSION['mix_1']))
	{
		header ("Location:mix_obj_questions_paper.php");
		
	}
	else
	{
		$_SESSION['ready_edit_mode']="Set";
	    header ("Location:obj_question_paper.php");
	}
}
if(isset($_GET['long_q']))
{
	$_SESSION['show_q']="Set";
	header ("Location:long_q_paper.php");
}
// ------------------------------------------------ /Go To Objective -----------------------------------------------------
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
	//$_SESSION['show_q']="Set";
}
// --------------------------------------------------/After Clicking On Button Edit / Update / Delete-----------------------------------------
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






<?php
if(isset($_POST['set_obj_answers']))
{
	header("Location:obj_answer_sheet.php");
}
?>












<?php // _________________________________________*Insert Question*_______________________________________________--> ?>

<?php
if(isset($check_k))
{
      ?> <h1 style="color:red;text-align:center;"><?php echo $check_k; ?></h1> <?php
}

$s=0;
if(isset($_POST['done']))
 {
	$calculate_total=0;
foreach($_POST['marks'] as $marks)
 {
	 $tester=$_POST['status'][$s++];
	if(isset($calculate_total) && $tester=='Active')
	{
	$calculate_total=$calculate_total+$marks;
	}
       }
}




//---------------On Setting Of Next Or Done Button------------------------->		
if(isset($_POST['done']) && $calculate_total==$total_marks)
	{
		 
		 $q_p_formate_id=$_SESSION['q_p_formate_id'];
		 //$_SESSION['start_question_no']=$_SESSION['start_question_no']+1;
		 $var=0;
		 $var2=0;
		 
		 foreach($_POST['question_discription'] as $question)
		{	
		 $question = str_replace("'","\'",$question);
		 $marks=$_POST['marks'][$var++];
		 $status=$_POST['status'][$var2++];
		 
		$query_c="INSERT INTO short_q(short_q_detail,short_q_marks,q_p_formate_id,status)
		                        VALUES('$question','$marks','$q_p_formate_id','$status') ";
		$result_c=mysqli_query($con,$query_c);
		}
		if(!isset($mix))
		{
		$_SESSION['done']="Paper is created Successfully.";
		}
		
		if(isset($mix) && isset($_SESSION['one_sub']) && (isset($_SESSION['comb1']) || isset($_SESSION['comb2']) || isset($_SESSION['comb3'])))
		{
			if($_SESSION['comb1'])
			{
			$_SESSION['2_one']="Set";
			} else
				if($_SESSION['comb2'])
			{
			$_SESSION['22_one']="Set";
			} 
			else if($_SESSION['comb3'])
			{
			$_SESSION['222_one']="Set";
			} 
				
			$_SESSION['done']="Paper is created Successfully.";
			header ("Location:short_q_paper.php");
			//header ("Location:comb_obj_sub_print.php");
		}
		else if(isset($mix) && isset($_SESSION['comb_s']) && (isset($_SESSION['comb1']) || isset($_SESSION['comb2']) || isset($_SESSION['comb3'])))
		{
			header ("Location:long_q_paper.php");
		}
		else if(isset($mix) && isset($_SESSION['one_obj']) && isset($_SESSION['comb_s']))
		{
			header ("Location:long_q_paper.php");
		}
		else if(isset($mix) && isset($_SESSION['one_obj']) && isset($_SESSION['one_sub']) && !isset($_SESSION['section2']))		
		{
			$_SESSION['one_one']="Set";
			$_SESSION['done']="Set";
			header ("Location:short_q_paper.php");
		}
		else if(isset($mix) && isset($_SESSION['section2']) && isset($_SESSION['one_sub']))		
		{
			$_SESSION['mix_1']="Set";
			$_SESSION['done']="Set";
			header ("Location:short_q_paper.php");
		}
	 }
	 else if(isset($_POST['done']) && $calculate_total!=$total_marks)
	 {
		 $error="Failed ! Marks Division Is Wrong.";
	 }
// -----------/On Setting Of Next Or Done Button------------------------->
?>

<?php // _________________________________________*/Insert Question*________________________________________________--> ?>




















<?php
//echo $_SESSION['mix_1'];
//_______________________________________________Edit Question___________________________________________________________-->

   if(isset($_REQUEST['edit_question_id']) && !isset($_POST['Update']))
{
	$_SESSION['edit_question_id']=$_REQUEST['edit_question_id'];
	$edit_question_id=$_SESSION['edit_question_id'];
	
	$query_f="SELECT * FROM short_q WHERE short_q_id='$edit_question_id' ";
	
	$result_f=mysqli_query($con,$query_f);
	while($row_f=mysqli_fetch_array($result_f))
	{
		$edit_short_q_detail=$row_f['short_q_detail'];
		$edit_short_q_marks=$row_f['short_q_marks'];
		$edit_q_p_formate_id=$row_f['q_p_formate_id'];
		$edit_status=$row_f['status'];
		
	}
	$check="Values are ready for edit.";
	$_SESSION['edit_recycle_bin']=$_SESSION['edit_question_id'];

}

//_________________________________________________/Edit Question________________________________________________________-->















//____________________________________________Update Question________________________________________________________-->
if(isset($_POST['Update']) )
{
	$_SESSION['refresh']="Refresh";
	   $update_id=$_SESSION['edit_question_id'];
	   $short_q_detail=$_POST['short_q_detail'];
	   $short_q_detail = str_replace("'","\'",$short_q_detail);
	   $short_q_marks=$_POST['short_q_marks'];
	   $status=$_POST['status'];
	  
	  $query_e="UPDATE short_q SET short_q_detail='$short_q_detail',
	  short_q_marks='$short_q_marks', q_p_formate_id='$q_p_formate_id', status='$status'
	  WHERE short_q_id='$update_id' ";   
	  
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
	 $query_g="DELETE FROM short_q WHERE short_q_id='$delete_question_id' "; 
	 
	 $result_g=mysqli_query($con,$query_g);
	 if($result_g)
	{
		 $check="Question Deleted Successfully.";
		 $_SESSION['delete_recycle_bin']=$_SESSION['delete_question_id'];
	}
}	
//_____________________________________________/Delete Question________________________________________________________-->
?> 









<?php
// __________________MCQS FORMATE_______________________-->
if(isset($_SESSION['short_questions']))
{
	$sub_total_marks=$_SESSION['t_marks_sq'];
	$_SESSION['sub_total_marks']=$sub_total_marks;
	$num_of_questions=$_SESSION['quan_sq'];	
	$attempt=$_SESSION['quan_sq1'];	
	$phase_change=$attempt+1;
	$question_number=1;
}
//   _____________________/MCQS FORMATE_______________________-->

?>

































	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	




<html>
<head>
<title>
Objective Paper
</title>
</head>
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








<?php if(!isset($_SESSION['paper1']) && !isset($_SESSION['double_1'])  && !isset($_SESSION['double_2'])  && !isset($_SESSION['double_3']) && !isset($_SESSION['comb_s'])) { ?>


<h2 align="left" style="font-size:35px;color:purple;text-align:center">Subjective Paper (<span style="font-size:25px;"> <?php echo "Short Questions"; ?> </span>) </h2>


<?php 
      } else {
 ?>
 <h2 align="left" style="font-size:35px;color:purple;text-align:center">Subjective Paper (<span style="font-size:25px;"> <?php echo "Short & Long Questions"; ?> </span>) </h2>
	  <?php } ?>
<br><br><br>








<!--*******************************************INPUT*******************************************************************-->   
<?php
if(!isset($_SESSION['done']) )
{
	?>

<h1 style="color:green;" align="center">Enter '<span style="color:red;">Short</span>' Questions (Attempt)</h1>
<h3 style="color:green;" align="center">Total '<span style="color:red;"><?php echo $_SESSION['t_marks_sq']; ?></span>' Marks</h3>
<?php
       
 if(isset($error)) 
 { 
       echo "<h3 style='color:red;text-align:left;' >".$error."</h1>";
       
 } 
 ?>

<!--___________________Questions_____________________-->
	<form method="POST" >
	<table align="center">
	<?php
	$q=0;
	$m=0;
	for($i=1;$i<=$num_of_questions;$i++)
	{
		if($i==$phase_change)
		{
			$question_number=1;
			?>
			<tr>
			<td><h1 style="color:green;" align="center">Enter '<span style="color:red;">Short</span>' Questions (Extra)</h1></td>
			</tr>
			<?php
			//echo "KASHIF ALI";
		}
		
	?>
	
 <tr>
	<td>
	    <table border="1">
	             <tr>
	                <td><?php  echo "Question".$question_number++.":"; ?> &nbsp;&nbsp;&nbsp;&nbsp; </td> <?php // Question Numbering...?>
	                 <td><input style="padding:5px;border:none;height:30px;width:1050px;" type="text" name="question_discription[]"
<?php if(isset($_POST['question_discription'])) { ?> value="<?php echo $_POST['question_discription'][$q++]; ?>" <?php } ?>					 required /></td>     <?php //Question Discription... ?>
	                  <td>
					  <input style="padding:5px;width:50px;height:30px;border:none;" type="text" name="marks[]"
					<?php if(isset($_POST['marks'])) { ?> value="<?php echo $_POST['marks'][$m++]; ?>" <?php } ?>	
					<?php if(!isset($_POST['marks'])) { ?>placeholder="Marks" <?php } ?> required /> 
					  </td>    <?php //Question Marks... ?>
					   <td><select name="status[]" style="height:30px;border:none;">
	<?php if($i<=$attempt){ ?>
						  <option value="Active" > Attempt </option>
	<?php } else { ?>
						  <option value="Block" > Extra  </option>
	<?php } ?>
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
	<br><br><br><input style="border-radius:4px;border:none;height:50px;width:100px;background-color:navy;color:white;cursor:pointer;" type="submit" name="done" value="Next" />
    </td>
   </tr>
<!--___________________/Button_____________________-->  
  </table>   <?php //End of table ?>
 </form>     <?php // End of form ?>
	<?php
 
       }
?>  
  <!--**************************************************/INPUT**********************************************************-->   

  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  <?php
if(isset($_SESSION['done']))
{
	?>
	<center><span style="color:Navy;font-size:40px;text-align:center;"> Questions of Created Paper<br><br></span></center>
<?php	
}
?>

  
  
  
  
  
  
  
  
  
  
  
  
  

 <?php
   // ------------------------------------------- Check Display ----------------------------------------------------    
 if(isset($check)) 
 { 
       echo "<h3 style='color:green;text-align:center;' >".$check."</h1>";
       
 } 
 
  // ------------------------------------------- /Check Display ----------------------------------------------------    
 ?>
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
<?php 
if(isset($_GET['mix_1']))
{
	unset($_SESSION['section2']);
 header ("Location:mix_obj_questions_paper.php");
}
?>  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
<?php //_____________________________________________User Interface_____________________________________________________ ?>
<?php
if(isset($_SESSION['done']))
	
{
	//_____________________________________Not Display Button When We Come For Edit From Single Obj Sub Display Paper_____
	
	if(!isset($_SESSION['edit_update']) && !isset($_SESSION['refresh']))
	{
?>
<center>
<form align="center" method="get">
<?php if(isset($_SESSION['paper1']) || isset($_SESSION['double_1'])  || isset($_SESSION['double_2'])  || isset($_SESSION['double_3'])) { ?>
<input style="border-radius:4px;border:none;height:50px;width:200px;background-color:navy;color:white;cursor:pointer;" type="submit" name="long_q" value="Show Questions ( Long )" />
<?php } ?>
<input style="border-radius:4px;border:none;height:50px;width:200px;background-color:navy;color:white;cursor:pointer;" type="submit" name="disp_ques" value="Show Questions ( Short )" /> 
<?php if(isset($_SESSION['paper1']) || isset($_SESSION['double_1'])  || isset($_SESSION['double_2'])  || isset($_SESSION['double_3'])) {?>
<input style="border-radius:4px;border:none;height:50px;width:200px;background-color:navy;color:white;cursor:pointer;" type="submit" name="go_to" value="Go To Objective" />
<?php } ?>
<?php if(isset($_SESSION['one_one'])) { ?>
<input style="border-radius:4px;border:none;height:50px;width:200px;background-color:navy;color:white;cursor:pointer;" type="submit" name="go_to" value="Go To Objective" />
<?php } ?>
<?php if(isset($_SESSION['2_one']) || isset($_SESSION['222_one']) || isset($_SESSION['22_one'])) { ?>
<input style="border-radius:4px;border:none;height:50px;width:200px;background-color:navy;color:white;cursor:pointer;" type="submit" name="go_to" value="Go To Objective" />
<?php } ?>
<?php if(isset($_SESSION['mix_1'])) { ?>
<input style="border-radius:4px;border:none;height:50px;width:200px;background-color:navy;color:white;cursor:pointer;" type="submit" name="mix_1" value="Go To Objective" />
<?php } ?>
<input style="border-radius:4px;border:none;height:50px;width:200px;background-color:navy;color:white;cursor:pointer;" type="submit" name="disp_paper" value="Display Paper" />


</form>
</center>
<?php
	}
	//unset($_SESSION['refresh']);
	//_____________________________________/Not Display Button When We Come For Edit From Single Obj Sub Display Paper_____
?>	
	

	

	
	
<?php if(isset($_SESSION['edit_update']) && !isset($_SESSION['refresh'])) { ?>	
	
<h1 align="center"><!--Questions Edit/Update/Delete.--></h1>
<form method="POST" >
<table border="1" align="center">
<!--<tr>
<td>Question_ID :</td>
<td>--> <input style="padding:10px;border:none;width:900px;height:40px;" readonly type="hidden" name="short_q_id"
           value="<?php if(isset($edit_question_id)) { echo $edit_question_id; } ?>"  /><!--</td>
</tr>-->
<tr>
<td>Question :</td>
<td><input style="padding:5px;border:none;width:900px;height:40px;" <?php if(isset($edit_short_q_detail)) { ?>  <?php } else { ?> readonly <?php } ?> style="width:1100px;height:40px;"
           value="<?php if(isset($edit_short_q_detail)) { echo $edit_short_q_detail; } ?>"
		   type="text" name="short_q_detail" required /></td>
</tr>
<!--<tr>
<td>Short_Question Marks :</td>
 <td>--><input style="padding:5px;border:none;width:900px;height:40px;" readonly type="hidden" name="short_q_marks"
           value="<?php if(isset($edit_short_q_marks)) { echo $edit_short_q_marks; } ?>"   required /><!--</td>
</tr>-->
<!--<tr>
<td>Question Paper Formate ID :</td>
<td>--> <input style="padding:5px;border:none;width:900px;height:40px;" readonly type="hidden" name="q_p_formate_id"
           value="<?php if(isset($edit_q_p_formate_id)) { echo $edit_q_p_formate_id; } ?>"   required /><!--</td>
</tr>-->
<tr>
<td>Status :</td>
<td><select name="status" style="border:none;width:900px;height:40px;" 
    <?php if(!isset($edit_status)) { ?> disabled <?php } ?>   >
    <option value="Active" <?php if(isset($edit_status) && $edit_status=='Active') { ?> selected <?php } ?>  >Active</option>
	<option value="Block"  <?php if(isset($edit_status) && $edit_status=='Block') { ?> selected  <?php } ?>  >Block </option>
	</select>
	</td>
</tr>
<tr align="center">
<td colspan="2"><input style="border-radius:4px;border:none;height:50px;width:100px;background-color:navy;color:white;cursor:pointer;"
    <?php if(isset($edit_question_id)) { ?> <?php } else { ?> disabled <?php } ?>
     type="submit" name="Update" value="Update" /></td>
</tr>
</table>
</form>
<?php
} // AT THE STAGE OF UPDATE
}
?>
<?php//_____________________________________________/User Interface_____________________________________________________?>

  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  <?php
// -------------------------------------------------REFRESH-----------------------------------------------------------------
 if(isset($_SESSION['refresh'])) 
 {
	?>
	<center><form method="get">
<input style="border-radius:4px;border:none;height:50px;width:100px;background-color:navy;color:white;cursor:pointer;" type="submit" name="refresh" value="Refresh" />
</form></center>
	<?php
} 
// -------------------------------------------------REFRESH-----------------------------------------------------------------

?>

  
  
  
  
  
  
  
  
  
  
  
  
  
  
<!--******************************************************DISPLAY********************************************************-->   

<?php
	if(isset($_SESSION['done']) && isset($_SESSION['show_q']) && !isset($_SESSION['edit_update']) && !isset($_SESSION['refresh']))
	{
	?>
<h1 align="center" style="color:navy;"><br><?php echo "'<span style='color:red;'>Short'</span> Questions"; ?> </h1>

<?php // if(isset($check)) { echo "<h3 style='color:red;' >".$check."</h1>"; } ?>


	<form method="POST">
<!--_______________Questions______________-->	
	<table align="center">
	<?php
	
	$query_d="SELECT short_q_id, short_q_detail,short_q_marks,q_p_formate_id,status 
	FROM short_q WHERE q_p_formate_id='$q_p_formate_id' ";
    $result_d=mysqli_query($con,$query_d);	
	while($row_d=mysqli_fetch_array($result_d))
	{
		
	?>
	
 <tr>
	<td>
	    <table border="1">
	                      <tr>
	                        <td><?php  echo "Question".$question_number++.":"; ?> &nbsp;&nbsp;&nbsp;&nbsp; </td> <?php // Question Numbering...?>
	                        <td><input style="padding:5px;border:none;height:30px;width:1050px;" type="text" 
		                       <?php if (isset($edit_id) && $row_d['short_q_id']==$edit_id) { ?>  <?php }else { ?> readonly <?php } ?> name="question_discription['<?php echo $row_d['question_id']; ?>']"
                             value="<?php { echo $row_d['short_q_detail']; }  ?>"	required /></td>     <?php //Question Discription... ?>
							    <td><?php echo "(".$row_d['short_q_marks'].")"; ?></td>   <?php //Question Marks... ?>
							    <td><?php echo $row_d['status'] ?></td>
								<td><a href="short_q_paper.php?edit_question_id=<?php echo $row_d['short_q_id']; ?>">Edit</a></td>
								<td><a href="short_q_paper.php?delete_question_id=<?php echo $row_d['short_q_id']; ?>">Delete</td>
								
							</td>
						 </tr>
	   </table>
	</td>
 </tr>
 <?php
     }
 ?>
 </form>
 <!--___________________/Questions________________-->	

 


 <!--___________________Button_____________________-->
   <!--<form method="post" > 
	<tr>
	 <td align="center">
	   <input style="width:150px;height:50px;background-color:lightgrey;color:black;"
   	   type="submit" name="set_obj_answers" value="Set Answers"  />&nbsp;&nbsp;&nbsp;
	  </td>
	</tr>
   </form>-->
<!--___________________/Button_____________________--> 

    
	
	
	</table>   <?php // End of Table.. ?>
	     <?php // End of Form.. ?>
	<?php
  }
?>  

<!--**********************************************/DISPLAY***************************************************************-->   
</body>
</html>
