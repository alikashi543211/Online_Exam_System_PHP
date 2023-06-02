<?php

session_start();
include "connection.php";
$q_paper_id=$_SESSION['q_paper_id'];
$q_p_formate_id=$_SESSION['q_p_formate_id'];
$total_marks=$_SESSION['total_marks'];
$t_marks_lq=$_SESSION['t_marks_lq'];
if(isset($_SESSION['mix_paper']))
{
	$mix="Set";
}
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
//______________________________________For Print Paper_________________________________________________
if(isset($_GET['disp_paper']) && !isset($mix))
{
	header ('Location:long_q_print_paper.php');
}
else if(isset($mix) && isset($_GET['disp_paper']))
{
	header ('Location:complete_mix_paper.php');
}
//_________________________________________/For Print Paper_______________________________________________
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
$s=0;
if(isset($check_k))
{
      ?> <h1 style="color:red;text-align:center;"><?php echo $check_k; ?></h1> <?php
}


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
if(isset($_POST['done']) && $calculate_total==$t_marks_lq)
	{
		 
		 
		 $q_p_formate_id=$_SESSION['q_p_formate_id'];
		 $var=0;
		 $var2=0;
		 
		 foreach($_POST['question_discription'] as $question)
		{	
		 $question = str_replace("'","\'",$question);
		 $marks=$_POST['marks'][$var++];
		 $status=$_POST['status'][$var2++];
		 
		$query_c="INSERT INTO long_q(long_q_detail,long_q_marks,q_p_formate_id,status)
		                        VALUES('$question','$marks','$q_p_formate_id','$status') ";
		$result_c=mysqli_query($con,$query_c);
		}
		if(isset($_SESSION['short_questions']) && isset($_SESSION['long_questions']))
		{
			unset($_SESSION['done']);
			$_SESSION['done2']="Success.";
			header ("Location:sub_disp_mode.php");
		}
		else
		{
		 	$_SESSION['done']="Successfully Inserted Into Database.";
		}
		 
	 }
	 else if(isset($_POST['done']) && $calculate_total!=$total_marks)
	 {
		 //echo "<h1>Your Marks Division Is Wrong.</h1>";
		  $error="Failed ! Your Marks Division Is Wrong.";
	 }
// -----------/On Setting Of Next Or Done Button------------------------->
?>











<?php // _________________________________________*/Insert Question*________________________________________________--> ?>




















<?php
// /_______________________________________________Edit Question___________________________________________________________-->
   if(isset($_REQUEST['edit_question_id']) && !isset($_POST['Update']))
{
	$_SESSION['edit_question_id']=$_REQUEST['edit_question_id'];
	$edit_question_id=$_SESSION['edit_question_id'];
	
	$query_f="SELECT * FROM long_q WHERE long_q_id='$edit_question_id' ";
	
	$result_f=mysqli_query($con,$query_f);
	while($row_f=mysqli_fetch_array($result_f))
	{
		 $edit_long_q_detail=$row_f['long_q_detail'];
		 $edit_long_q_marks=$row_f['long_q_marks'];
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
	   $long_q_detail=$_POST['long_q_detail'];
	   $long_q_detail = str_replace("'","\'",$long_q_detail);
	   $long_q_marks=$_POST['long_q_marks'];
	   $status=$_POST['status'];
	  
	  $query_e="UPDATE long_q SET long_q_detail='$long_q_detail',
	  long_q_marks='$long_q_marks', q_p_formate_id='$q_p_formate_id', status='$status'
	  WHERE long_q_id='$update_id' ";   
	  
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
	 $query_g="DELETE FROM long_q WHERE long_q_id='$delete_question_id' "; 
	 
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

// __________________LONG QUESTIONS FORMATE_______________________-->
if(isset($_SESSION['long_questions']))
{
	$sub_total_marks=$_SESSION['t_marks_lq'];
	$_SESSION['sub_total_marks']=$sub_total_marks;
	$num_of_questions=$_SESSION['quan_lq'];	
	$attempt=$_SESSION['quan_lq1'];
    $phase_change=$attempt+1;	
	$extra=$_SESSION['quan_lq2'];	
	$question_number=1;
}
//   _____________________/LONG QUESTIONS FORMATE_______________________-->

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











<h2 align="left" style="font-size:35px;color:purple;text-align:center">Subjective Paper (<span style="font-size:25px;"> <?php echo "Short & Long Questions"; ?> </span>) </h2>

<br><br><br>

















<!--*******************************************INPUT*******************************************************************-->   
<?php
if(!isset($_SESSION['done']) )
{
	?>
	
	
<h1 style="color:green;" align="center">Enter '<span style="color:red;">Long</span>' Questions (Attempt)</h1>
<h3 style="color:green;" align="center">Total '<span style="color:red;"><?php echo $_SESSION['t_marks_lq']; ?></span>' Marks</h3>
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
			<td><h1 style="color:green;" align="center">Enter '<span style="color:red;">Long</span>' Questions (Extra)</h1></td>
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
					<?php if(!isset($_POST['marks'])) { ?> placeholder="Marks" <?php } ?> required />
					  </td>    <?php //Question Marks... ?>
					   <td><select style="height:30px;border:none;" name="status[]" >
					   <?php if($i<=$attempt) { ?>
						  <option value="Active" > Attempt </option>
					   <?php } ?>
					   <?php if($i>$attempt) { ?>
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

  

  
  
  
<?php //_____________________________________________User Interface_____________________________________________________ ?>
<?php

?>

<?php
if(isset($_SESSION['done']))
{
	include_once "mix_sub_disp.php";
	?>
	<?php
   // ------------------------------------------- Check Display ----------------------------------------------------    
 if(isset($check)) 
 { 
       echo "<h3 style='color:green;text-align:center;' >".$check."</h1>";
       
 } 
 
  // ------------------------------------------- /Check Display ----------------------------------------------------    
 ?>
  
  
<?php if(isset($_SESSION['edit_update']) && !isset($_SESSION['refresh'])) { ?>	
	
<h1 align="center"><!--Questions Edit/Update/Delete.--></h1>
<form method="POST" >
<table border="1" align="center">
<!--<tr>
<td>Question_ID :</td>
<td>--> <input style="padding:10px;border:none;width:900px;height:40px;" readonly type="hidden" name="long_q_id"
           value="<?php if(isset($edit_question_id)) { echo $edit_question_id; } ?>"  /><!--</td>
</tr>-->
<tr>
<td>Question :</td>
<td><input style="padding:5px;border:none;width:900px;height:40px;" <?php if(isset($edit_long_q_detail)) { ?>  <?php } else { ?> readonly <?php } ?> style="width:1100px;height:40px;"
           value="<?php if(isset($edit_long_q_detail)) { echo $edit_long_q_detail; } ?>"
		   type="text" name="long_q_detail" required /></td>
</tr>
<!--<tr>
<td>Short_Question Marks :</td>
 <td>--><input style="padding:5px;border:none;width:900px;height:40px;" readonly type="hidden" name="long_q_marks"
           value="<?php if(isset($edit_long_q_marks)) { echo $edit_long_q_marks; } ?>"   required /><!--</td>
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
	if(isset($_SESSION['done']) && !isset($_SESSION['edit_update']) && !isset($_SESSION['refresh']))
	{
	?>
<h1 align="center" style="color:navy;"><br><?php echo "<span style='color:red;'>'Long'</span> Questions"; ?> </h1>
<?php if(isset($check)) { echo "<h3 style='color:red;' >".$check."</h1>"; } ?>


	<form method="POST">
<!--_______________Questions______________-->	
	<table align="center">
	<?php
	
	$query_d="SELECT long_q_id, long_q_detail,long_q_marks,q_p_formate_id,status 
	FROM long_q WHERE q_p_formate_id='$q_p_formate_id' ";
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
		                       <?php if (isset($edit_id) && $row_d['long_q_id']==$edit_id) { ?>  <?php }else { ?> readonly <?php } ?> name="question_discription['<?php echo $row_d['question_id']; ?>']"
                             value="<?php { echo $row_d['long_q_detail']; }  ?>"	required /></td>     <?php //Question Discription... ?>
							    <td><?php echo "(".$row_d['long_q_marks'].")"; ?></td>   <?php //Question Marks... ?>
							    <td><?php echo $row_d['status'] ?></td>
								<td><a href="lq_in_mix_paper.php?edit_question_id=<?php echo $row_d['long_q_id']; ?>">Edit</a></td>
								<td><a href="lq_in_mix_paper.php?delete_question_id=<?php echo $row_d['long_q_id']; ?>">Delete</td>
								
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
	   <input style="width:150px;height:50px;background-color:lightgrey;color:black;"
   	   type="submit" name="delete_all" value="Delete All"  />
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
