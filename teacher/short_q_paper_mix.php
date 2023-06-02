<?php
session_start();
include "connection.php";
$q_paper_id=$_SESSION['q_paper_id'];
$q_p_formate_id=$_SESSION['q_p_formate_id'];
$total_marks=$_SESSION['total_marks'];
if(isset($_GET['disp_paper']))
{
	header ('Location:short_q_print_paper.php');
}
?>






























<?php

if(isset($_POST['sq']))
{
	header ("Location:short_q_paper_mix.php");
}
else if(isset($_POST['lq']))
{
	header ("Location:long_q_paper_mix.php");
}

?>




















<?php
if(isset($_SESSION['short_questions']) && isset($_SESSION['long_questions']))
{
?>

<form align="center" method="post">
<h2 style="color:red;">Input Mode( Subjective Paper including Short And Long Questions. )</h2>
<input style="width:180px;height:50px;background-color:lightgrey;color:black;"
 type="submit" name="sq" value="Short Questions" />
 
 <input style="width:180px;height:50px;background-color:lightgrey;color:black;"
 type="submit" name="lq" value="Long Questions" />
</form>

<?php
}
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
		unset($_SESSION['done1']);
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


if(isset($_POST['done']))
 {
	$calculate_total=0;
foreach($_POST['marks'] as $marks)
 {
	if(isset($calculate_total))
	{
	$calculate_total=$calculate_total+$marks;
	}
       }
}




//---------------On Setting Of Next Or Done Button------------------------->		
if(isset($_POST['done']) && $calculate_total==$total_marks)
	{
		 
		 $status=$_POST['status'];
		 $q_p_formate_id=$_SESSION['q_p_formate_id'];
		 //$_SESSION['start_question_no']=$_SESSION['start_question_no']+1;
		 $var=0;
		 
		 foreach($_POST['question_discription'] as $question)
		{	
		 $marks=$_POST['marks'][$var++];
		 
		$query_c="INSERT INTO short_q(short_q_detail,short_q_marks,q_p_formate_id,status)
		                        VALUES('$question','$marks','$q_p_formate_id','$status') ";
		$result_c=mysqli_query($con,$query_c);
		}
		 	$_SESSION['done1']="Successfully Inserted Into Database.";
		 
	 }
	 else if(isset($_POST['done']) && $calculate_total!=$total_marks)
	 {
		 echo "<h1>Your Marks Division Is Wrong.</h1>";
	 }
// -----------/On Setting Of Next Or Done Button------------------------->
?>

<?php // _________________________________________*/Insert Question*________________________________________________--> ?>




















<?php
//_______________________________________________Edit Question___________________________________________________________-->
if(isset($_REQUEST['edit_question_id']) && !isset($_SESSION['edit_recycle_bin']) ||
   isset($_REQUEST['edit_question_id']) &&  $_REQUEST['edit_question_id']!=$_SESSION['edit_recycle_bin'])
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
	   $update_id=$_SESSION['edit_question_id'];
	   $short_q_detail=$_POST['short_q_detail'];
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
	$question_number=1;
}
//   _____________________/MCQS FORMATE_______________________-->

?>





















<?php //________________________Header_________________________________________________-->  ?>

<h3 align="center" style="color:red;">Question Paper = <?php echo $_SESSION['course_name']; ?></h3>
<h3 align="center" style="color:red;">Question Paper Type = <?php echo $_SESSION['q_paper_type']; ?></h3>
<h3 align="center" style="color:red;">Total Marks = <?php echo $sub_total_marks; ?></h3>
<h3 align="center" style="color:red;">Paper Formate = <?php echo $_SESSION['paper_formate']; ?></h3>
<h3 align="center" style="color:red;">Number Of Questions = <?php echo $num_of_questions; ?></h3>

<?php 
      //_______________________Header___________________________________________________-->  ?>
	
















<html>
<head>
<title>
Objective Paper
</title>
</head>
<body style="background-color:white;">




<?php // ----------------------------------------- Sign Out Button ----------------------------------------------------- ?>
<form align="right" action="../index.php" method="post">
<input style="height:50px;width:100px;background-color:navy;color:white;cursor:pointer;" type="submit" class="testbutton" name="sign_out" value="Sign Out" />
</form>
<?php // ----------------------------------------- /Sign Out Button ----------------------------------------------------- ?>








<!--*******************************************INPUT*******************************************************************-->   
<?php
if(!isset($_SESSION['done1']) )
{
	?>
	
<h1 align="center">Input Questions.</h1>


<!--___________________Questions_____________________-->
	<form method="POST" >
	<table border="5">
	<?php
	
	for($i=1;$i<=$num_of_questions;$i++)
	{
		
	?>
	
 <tr>
	<td>
	    <table border="5">
	             <tr>
	                <td><?php  echo "Question".$question_number++.":"; ?> &nbsp;&nbsp;&nbsp;&nbsp; </td> <?php // Question Numbering...?>
	                 <td><input style="height:30px;width:1050px;" type="text" name="question_discription[]" required /></td>     <?php //Question Discription... ?>
	                  <td>
					  <input style="width:50px;height:20px;" type="text" name="marks[]" placeholder="Marks" required />
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
	<input style="width:150px;height:50px;background-color:lightgrey;color:black;" type="submit" name="done" value="Done" />
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
if(isset($_SESSION['done1']))
{
?>
<?php
if(isset($_SESSION['short_questions']) && isset($_SESSION['long_questions']))
{
	
}
else
{
?>
<form align="center" method="get">
<input style="width:150px;height:50px;background-color:lightgrey;color:black;" type="submit" name="disp_paper" value="Display Paper" />
</form>
<?php	
}
?>
<h1 align="center">Questions Edit/Update/Delete.</h1>
<form method="POST" >
<table border="5">
<tr>
<td>Question_ID :</td>
<td><input readonly type="text" name="short_q_id"
           value="<?php if(isset($edit_question_id)) { echo $edit_question_id; } ?>"  /></td>
</tr>
<tr>
<td>Question :</td>
<td><input <?php if(isset($edit_short_q_detail)) { ?>  <?php } else { ?> readonly <?php } ?> style="width:1100px;height:40px;"
           value="<?php if(isset($edit_short_q_detail)) { echo $edit_short_q_detail; } ?>"
		   type="text" name="short_q_detail" required /></td>
</tr>
<tr>
<td>Short_Question Marks :</td>
<td><input readonly type="question_paper" name="short_q_marks"
           value="<?php if(isset($edit_short_q_marks)) { echo $edit_short_q_marks; } ?>"   required /></td>
</tr>
<tr>
<td>Question Paper Formate ID :</td>
<td><input readonly type="text" name="q_p_formate_id"
           value="<?php if(isset($edit_q_p_formate_id)) { echo $edit_q_p_formate_id; } ?>"   required /></td>
</tr>
<tr>
<td>Status :</td>
<td><select name="status" 
    <?php if(!isset($edit_status)) { ?> disabled <?php } ?>   >
    <option value="Active" <?php if(isset($edit_status) && $edit_status=='Active') { ?> selected <?php } ?>  >Active</option>
	<option value="Block"  <?php if(isset($edit_status) && $edit_status=='Block') { ?> selected  <?php } ?>  >Block </option>
	</select>
	</td>
</tr>
<tr align="center">
<td colspan="2"><input style="width:80;height:50px;"
    <?php if(isset($edit_question_id)) { ?> <?php } else { ?> disabled <?php } ?>
     type="submit" name="Update" value="Update" /></td>
</tr>
</table>
</form>
<?php
}
?>
<?php//_____________________________________________/User Interface_____________________________________________________?>

  
  
  
  
  
  
  
  
  
  
  
<!--******************************************************DISPLAY********************************************************-->   

<?php
	if(isset($_SESSION['done1']))
	{
	?>
<h1 align="center">Display Questions From Database.</h1>

<?php if(isset($check)) { echo "<h3 style='color:red;' >".$check."</h1>"; } ?>


	<form method="POST">
<!--_______________Questions______________-->	
	<table border="5">
	<?php
	
	$query_d="SELECT short_q_id, short_q_detail,short_q_marks,q_p_formate_id,status 
	FROM short_q WHERE q_p_formate_id='$q_p_formate_id' ";
    $result_d=mysqli_query($con,$query_d);	
	while($row_d=mysqli_fetch_array($result_d))
	{
		
	?>
	
 <tr>
	<td>
	    <table border="5">
	                      <tr>
	                        <td><?php  echo "Question".$question_number++.":"; ?> &nbsp;&nbsp;&nbsp;&nbsp; </td> <?php // Question Numbering...?>
	                        <td><input style="height:30px;width:1050px;" type="text" 
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
   <form method="post" > 
	<tr>
	 <td align="center">
	   <input style="width:150px;height:50px;background-color:lightgrey;color:black;"
   	   type="submit" name="set_obj_answers" value="Set Answers"  />&nbsp;&nbsp;&nbsp;
	   <input style="width:150px;height:50px;background-color:lightgrey;color:black;"
   	   type="submit" name="delete_all" value="Delete All"  />
	  </td>
	</tr>
   </form>
<!--___________________/Button_____________________--> 

    
	
	
	</table>   <?php // End of Table.. ?>
	     <?php // End of Form.. ?>
	<?php
  }
?>  

<!--**********************************************/DISPLAY***************************************************************-->   
</body>
</html>
