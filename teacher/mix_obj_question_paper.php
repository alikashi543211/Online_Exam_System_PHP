<?php
session_start();
include "connection.php";
$q_paper_id=$_SESSION['q_paper_id'];
$btn_name="next1";
$btn_value="Next";
?>





<?php

//_____________________________________________Delete Question________________________________________________________-->

if(isset($_REQUEST['delete_question_id']) && !isset($_SESSION['delete_recycle_bin']) ||
   isset($_REQUEST['delete_question_id']) && $_REQUEST['delete_question_id']!=$_SESSION['delete_recycle_bin'])
{
	 $_SESSION['delete_question_id']=$_REQUEST['delete_question_id'];
	 $delete_question_id=$_SESSION['delete_question_id'];
	  if(isset($_SESSION['mcq_on']))
	 {
	 $query_g="DELETE FROM question WHERE question_id='$delete_question_id' ";
	 }
	 else if(isset($_SESSION['fb_on']))
	 {
	 $query_g="DELETE FROM fb_questions WHERE question_id='$delete_question_id' ";
	 } 
	  else if(isset($_SESSION['tf_on']))
	 {
	 $query_g="DELETE FROM tf_questions WHERE question_id='$delete_question_id' ";
	 } 
	 
	 $result_g=mysqli_query($con,$query_g);
	 if($result_g)
	{
		 $check="Question Deleted Successfully.";
		  if(isset($_SESSION['mcq_on']))
		 {
		 $_SESSION['quan_mcq']=$_SESSION['quan_mcq']-1;
		 $_SESSION['t_marks_mcq']=$_SESSION['t_marks_mcq']-$_SESSION['each_mcq'];
		 }
		 else if(isset($_SESSION['fb_on']))
		 {
			$_SESSION['quan_fb']=$_SESSION['quan_fb']-1;
		    $_SESSION['t_marks_fb']=$_SESSION['t_marks_fb']-$_SESSION['each_fb']; 
		 }
		 else if(isset($_SESSION['tf_on']))
		 {
		 $_SESSION['quan_tf']=$_SESSION['quan_tf']-1;
		 $_SESSION['t_marks_tf']=$_SESSION['t_marks_tf']-$_SESSION['each_tf'];
		 }
		 $_SESSION['delete_recycle_bin']=$_SESSION['delete_question_id'];
	}
$_SESSION['total_marks']=$_SESSION['t_marks_mcq']+$_SESSION['t_marks_fb']+$_SESSION['t_marks_tf'];
}	


//_____________________________________________/Delete Question________________________________________________________-->
?> 


























<?php 
//_____________________________________________/Delete All Questions________________________________________________________-->
if(isset($_POST['delete_all']))
{
	 if(isset($_SESSION['mcq_on']))
	{
	$query_k="DELETE FROM question";
	}
	else if(isset($_SESSION['fb_on']))
	{
      $query_k="DELETE FROM fb_questions";
	}
	else if(isset($_SESSION['tf_on']))
	{
	$query_k="DELETE FROM tf_questions";
	}
	
	$result_k=mysqli_query($con,$query_k);
	if($result_k)
	{
		$check="All Questions Deleted Successully.";
		//unset($_SESSION['done']);                                     //Problem occur
		 if(isset($_SESSION['mcq_on']))
		{
			$_SESSION['t_marks_mcq']=0;
			$_SESSION['quan_mcq']=0;
			$_SESSION['each_mcq']=0;
		}
		else if(isset($_SESSION['fb_on']))
		{
			$_SESSION['t_marks_fb']=0;
			$_SESSION['quan_mcq']=0;
			$_SESSION['quan_fb']=0;
		}
		else if(isset($_SESSION['tf_on']))
		{
			$_SESSION['t_marks_tf']=0;
			$_SESSION['quan_tf']=0;
			$_SESSION['each_tf']=0;
		}	
	}
	$_SESSION['total_marks']=$_SESSION['t_marks_mcq']+$_SESSION['t_marks_fb']+$_SESSION['t_marks_tf'];
}
//_____________________________________________/Delete All Questions________________________________________________________-->
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
//______________________________________Multiple Choice Questions_____________________________________________________		

if(isset($_POST['next1']))
	{
		 $q_paper_id=$_SESSION['q_paper_id'];
		 $status=$_POST['status'];		 
		 foreach($_POST['question_discription'] as $question)
		{	
		$query_c="INSERT INTO question(question,q_paper_id,status)
		                        VALUES('$question','$q_paper_id','$status') ";
		$result_c=mysqli_query($con,$query_c);
		}
		
		 $btn_name="next2";
		 $btn_value="Next";
		 $_SESSION['mcq_recycle_bin']="Inserted into Database Successfully.";
	}	
	    
//______________________________________/Multiple Choice Questions_____________________________________________________		
		
		
		
		
		
		
		
		
//_____________________________________ True False________________________________________________		
		 
		 if(isset($_POST['next2']))
		 {
	     $q_paper_id=$_SESSION['q_paper_id'];
		 $status=$_POST['status'];
		 
		 foreach($_POST['question_discription'] as $question)
		{	
		$query_c="INSERT INTO tf_questions(question,q_paper_id,status)
		                        VALUES('$question','$q_paper_id','$status') ";
		$result_c=mysqli_query($con,$query_c);
		}
		 $btn_name="done";
		 $btn_value="Done";
		 $_SESSION['tf_recycle_bin']="Insertd into Database Successfully.";
			
	    }
//_________________________________________/True False__________________________________________________








//______________________________________Fill in Blanks_____________________________________________________		
		 if(isset($_POST['done']))
		 {
			 $q_paper_id=$_SESSION['q_paper_id'];
		     $status=$_POST['status'];
		 
		 foreach($_POST['question_discription'] as $question)
		{	
		$query_c="INSERT INTO fb_questions(question,q_paper_id,status)
		                        VALUES('$question','$q_paper_id','$status') ";
		$result_c=mysqli_query($con,$query_c);
		}
		 $btn_name="done";
		 $btn_value="Done";
		 $_SESSION['fb_recycle_bin']="Insertd into Database Successfully.";
		 $_SESSION['done']="All Data is Inserted Successfully.";
			
	    }
//______________________________________/Fill in Blanks_____________________________________________________		
		
	?>

<?php // _________________________________________*/Insert Question*________________________________________________--> ?>























<?php
//_______________________________________________Edit Question___________________________________________________________-->
if(isset($_REQUEST['edit_question_id']) && !isset($_SESSION['edit_recycle_bin']) ||
   isset($_REQUEST['edit_question_id']) &&  $_REQUEST['edit_question_id']!=$_SESSION['edit_recycle_bin'])
{
	
	$_SESSION['edit_question_id']=$_REQUEST['edit_question_id'];
	$edit_question_id=$_SESSION['edit_question_id'];
	if(isset($_SESSION['mcq_on']))
	{
	$query_f="SELECT * FROM question WHERE question_id='$edit_question_id' ";
	}
	else if(isset($_SESSION['fb_on']))
	{
	$query_f="SELECT * FROM fb_questions WHERE question_id='$edit_question_id' ";
	}
	else if(isset($_SESSION['tf_on']))
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
	  $update_id=$_SESSION['edit_question_id'];
	  $update_question=$_POST['update_question'];
	  $update_question = str_replace("'","\'",$update__question);
	  $update_status=$_POST['update_status'];
       if(isset($_SESSION['mcq_on']))
	  {
	  $query_e="UPDATE question SET question='$update_question', status='$update_status' WHERE question_id='$update_id' ";
	  }
	  else if(isset($_SESSION['fb_on']))
	  {
	  $query_e="UPDATE fb_questions SET question='$update_question', status='$update_status' WHERE question_id='$update_id' "; 
	  }
	  else if(isset($_SESSION['tf_on']))
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


















?>




<?php



// __________________MCQS FORMATE_______________________-->
if(isset($_SESSION['mcq_objective']) && !isset($_SESSION['mcq_recycle_bin']) && !isset($_SESSION['done']))
{
	$input_name="MCQs";
	$_SESSION['objective_type']=$_SESSION['mcq_objective'];
	$obj_total_marks=$_SESSION['t_marks_mcq'];
	$_SESSION['obj_total_marks']=$obj_total_marks;
	$num_of_questions=$_SESSION['quan_mcq'];
	$_SESSION['num_of_questions']=$num_of_questions;
	$marks_of_each=$_SESSION['each_mcq'];
    $_SESSION['marks_of_each']=$marks_of_each;	
	$question_number=1;
}
//   _____________________/MCQS FORMATE_______________________-->



// __________________TRUE FALSE FORMATE_______________________-->
else if(isset($_SESSION['tf_objective']) && !isset($_SESSION['tf_recycle_bin']) && !isset($_SESSION['done']))
{
	$input_name="True False";
	$_SESSION['objective_type']=$_SESSION['tf_objective'];
	$obj_total_marks=$_SESSION['t_marks_tf'];
	$_SESSION['obj_total_marks']=$obj_total_marks;
	$num_of_questions=$_SESSION['quan_tf'];
	$_SESSION['num_of_questions']=$num_of_questions;
	$marks_of_each=$_SESSION['each_tf'];
    $_SESSION['marks_of_each']=$marks_of_each;	
	$question_number=1;
}
// __________________/TRUE FALSE FORMATE_______________________-->



// __________________FILL IN BLANKS FORMATE_______________________-->
else if(isset($_SESSION['fb_objective'])  && !isset($_SESSION['fb_recycle_bin']) && !isset($_SESSION['done']))
{
	$input_name="Fill in Blanks";
	$_SESSION['objective_type']=$_SESSION['fb_objective'];
	$obj_total_marks=$_SESSION['t_marks_fb'];
	$_SESSION['obj_total_marks']=$obj_total_marks;
	$num_of_questions=$_SESSION['quan_fb'];
	$_SESSION['num_of_questions']=$num_of_questions;
	$marks_of_each=$_SESSION['each_fb'];
    $_SESSION['marks_of_each']=$marks_of_each;	
	$question_number=1;
}
// __________________FILL IN BLANKS FORMATE_______________________-->



?>





















<?php //________________________Header_________________________________________________-->  ?>

<h3 align="center" style="color:red;">Question Paper = <?php echo $_SESSION['course_name']; ?></h3>
<h3 align="center" style="color:red;">Question Paper Type = <?php echo $_SESSION['q_paper_type']; ?></h3>
<h3 align="center" style="color:red;">Total Marks = <?php echo $_SESSION['total_marks']; ?></h3>
<h3 align="center" style="color:red;">Paper Formate = <?php echo $_SESSION['paper_formate']; ?></h3>
<h3 align="center" style="color:red;">Objective Type = <?php echo "<span style='color:green;'>".$_SESSION['objective_type']."</span>"; ?></h3>
<!--
<h3 align="center" style="color:red;">Number Of Questions = <?php //echo $num_of_questions; ?></h3>
-->

<?php  //_______________________Header___________________________________________________-->  ?>
	
















<html>
<head>
<title>
Objective Paper
</title>
</head>
<body style="background-color:white;">












<!--*******************************************INPUT*******************************************************************-->   
<?php
if(!isset($_SESSION['done']) )
{
	?>
	
<h2 align="center" style="color:navy;">Input Questions Of <?php echo $input_name; ?></h2>
<h3 align="center" style="color:navy;">Marks = <?php  echo "(".$num_of_questions."*".$marks_of_each.")"; ?></h3>

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
  <?php 
  if(isset($_SESSION['paper_formate'])!='Mix')
  {
  ?>
	<input style="width:150px;height:50px;background-color:lightgrey;color:black;" type="submit" name="done" value="Done" />
	<?php
  }
  else
  {
  ?>
	<input style="width:150px;height:50px;background-color:lightgrey;color:black;" type="submit"
	name="<?php echo $btn_name; ?>" value="<?php echo $btn_value; ?>" />
	<?php
  }
  
	?>
    </td>
   </tr>
<!--___________________/Button_____________________-->  
  </table>   <?php //End of table ?>
 </form>     <?php // End of form ?>
	<?php
 
       }
?>  
  <!--**************************************************/INPUT**********************************************************-->   

  

  
  
  
<?php//____________________________________User Interface Display Mode___________________________________________________ ?>
<?php



?>
<?php
if(isset($_SESSION['done']))
{
?>






<?php
//<!-----------------------------------Edit/Update/Delete------------------------------------->
   
?>
 <h1 align="center" style="color:navy;">Questions Edit/Update/Delete.</h1>
 <?php

 if(isset($check)) 
 { 
       echo "<h3 style='color:red;' >".$check."</h1>";
       
 } 
 ?>
    <form method="POST" >
                      <table border="5">
                                   <tr>
                                      <td>Question_ID :</td>
                                      <td><input readonly type="text" name="update_q_id"
                                      value="<?php if(isset($edit_question_id)) { echo $edit_question_id; } ?>"  /></td>
                                   </tr>
                                      <tr>
                                         <td>Question :</td>
                                         <td><input <?php if(isset($edit_question)) { ?>  <?php } else
                                             { ?> readonly <?php } ?> style="width:1100px;height:40px;" value="<?php if(isset($edit_question)) { echo $edit_question; } ?>"type="text" name="update_question" required />
									     </td>
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
                                           <option value="Active" <?php if(isset($edit_status) && $edit_status=='Active') 
	                                       { ?> selected <?php } ?>  >Active</option>
	                                       <option value="Block"  <?php if(isset($edit_status) && $edit_status=='Block')
				                           { ?> selected  <?php } ?>  >Block </option>
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
//<!--------------------------------------*/*Edit/Update/Delete----------------------------------->
?>


<form method="post">
	<table align="center">
	<tr>
	<td colspan="4" style="color:Navy;font-size:40px;text-align:center;">Display Mode</td>
	</tr>
	<tr>
	<td><input style="width:150px;height:50px;background-color:lightgrey;color:black;" type="submit" name="disp_mcq" value="MCQs" /></td>
	<td><input style="width:150px;height:50px;background-color:lightgrey;color:black;" type="submit" name="disp_fb" value="Fill in Blanks" /></td>
	<td><input style="width:150px;height:50px;background-color:lightgrey;color:black;" type="submit" name="disp_tf" value="True False" /></td>
	</tr>
	</table>
	



	
<?php //______________________________________/User Interface Display Mode_________________________________________________--> ?>
   
  
  
<?php

if(isset($_POST['disp_mcq']))
{
	echo $_SESSION['mcq_on']="MCQs";
	unset($_SESSION['fb_on']);
	unset($_SESSION['tf_on']);
}
	
if(isset($_POST['disp_fb']))
	{
	echo $_SESSION['fb_on']="Fill in Blanks";
    unset($_SESSION['tf_on']);
	unset($_SESSION['mcq_on']);	
	}
if(isset($_POST['disp_tf']))
	{
	echo $_SESSION['tf_on']="True False";
    unset($_SESSION['fb_on']);
	unset($_SESSION['mcq_on']);	
	}

?>
  
  



  
  
<!--******************************************************DISPLAY********************************************************-->   


<?php
//________________________MCQs Questions Display_________________________________________________-->  

if(isset($_SESSION['mcq_on']))
{
	
?>
<h3 align="center" style="color:red">Objective Type = <?php echo "<span style='color:orange;'>".$_SESSION['mcq_objective']."</span>"; ?> </h3>
<h3 align="center" style="color:red;">Total Marks = <?php echo $_SESSION['t_marks_mcq']; ?></h3>
<h3 align="center" style="color:red;">Number Of Questions = <?php echo $_SESSION['quan_mcq']; ?></h3>
<h3 align="center" style="color:red;">Marks Of Each Question = <?php echo $_SESSION['each_mcq']; ?></h3>

<br><br><br>
                                 



	<form method="POST">
<!--_______________Questions______________-->	
	                   <table border="5">
	<?php
	$question_numbera=1;
	$query_d="SELECT question_id,question,q_paper_id, status FROM question WHERE q_paper_id = '$q_paper_id' ";
	
	//$query_d="SELECT question_id,question,q_paper_id, status FROM fb_questions WHERE q_paper_id = '$q_paper_id' ";	
	
	//$query_d="SELECT question_id,question,q_paper_id, status FROM tf_questions WHERE q_paper_id = '$q_paper_id' ";	
	
	                                                 
    $result_d=mysqli_query($con,$query_d);	
	while($row_d=mysqli_fetch_array($result_d))
	{
		
	?>
	
 <tr>
	<td>
	    <table border="5">
	                      <tr>
	                        <td><?php  echo "Question".$question_numbera++.":"; ?> &nbsp;&nbsp;&nbsp;&nbsp; </td> <?php // Question Numbering...?>
	                        <td><input style="height:30px;width:1050px;" type="text" 
		                       <?php if (isset($edit_id) && $row_d['question_id']==$edit_id) { ?>  <?php }else { ?> readonly <?php } ?> name=""
                                    value="<?php { echo $row_d['question']; }  ?>"	required /></td>     <?php //Question Discription... ?>
							    <td>
								<?php 
									echo "(".$_SESSION['each_mcq'].")";
										
								   ?>
								</td>   <?php //Question Marks... ?>
							    <td><?php echo $row_d['status'] ?></td>
								<td><a href="modify.php?edit_question_id=<?php echo $row_d['question_id']; ?>">Edit</a></td>
								<td><a href="modify.php?delete_question_id=<?php echo $row_d['question_id']; ?>">Delete</td>
								
							</td>
						 </tr>
	   </table>
	</td>
 </tr>
 </form>
 <?php
     }
 ?>
 
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
  
	//check session display only one
}
?>  
<br><br><br>
<?php
//_______________________/MCQs Questions Display___________________________________________________-->


?>
















<?php
	
//________________________True False Questions Display_________________________________________________-->  

if(isset($_SESSION['tf_on']))
{
     	
?>
<h3 align="center" style="color:red;">Objective Type = <?php echo "<span style='color:purple;'>".$_SESSION['tf_objective']."</span>"; ?></h3>
<h3 align="center" style="color:red;">Total Marks = <?php echo $_SESSION['t_marks_tf']; ?></h3>
<h3 align="center" style="color:red;">Number Of Questions = <?php echo $_SESSION['quan_tf']; ?></h3>
<h3 align="center" style="color:red;">Marks Of Each Question = <?php echo $_SESSION['each_tf']; ?></h3>

<br><br><br>



	<form method="POST">
<!--_______________Questions______________-->	
	<table border="5">
	<?php
	
	

	//$query_d="SELECT question_id,question,q_paper_id, status FROM question WHERE q_paper_id = '$q_paper_id' ";
	
	//$query_d="SELECT question_id,question,q_paper_id, status FROM fb_questions WHERE q_paper_id = '$q_paper_id' ";	
	$question_numberb=1;
	$query_d="SELECT question_id,question,q_paper_id, status FROM tf_questions WHERE q_paper_id = '$q_paper_id' ";	
	
	                                                 
    $result_d=mysqli_query($con,$query_d);	
	while($row_d=mysqli_fetch_array($result_d))
	{
		
	?>
	
 <tr>
	<td>
	    <table border="5">
	                      <tr>
	                        <td><?php  echo "Question".$question_numberb++.":"; ?> &nbsp;&nbsp;&nbsp;&nbsp; </td> <?php // Question Numbering...?>
	                        <td><input style="height:30px;width:1050px;" type="text" 
		                       <?php if (isset($edit_id) && $row_d['question_id']==$edit_id) { ?>  <?php }else { ?> readonly <?php } ?> name=""
                                    value="<?php { echo $row_d['question']; }  ?>"	required /></td>     <?php //Question Discription... ?>
							    <td>
								<?php 
								echo "(".$_SESSION['each_tf'].")";
										
								   ?>
								</td>   <?php //Question Marks... ?>
							    <td><?php echo $row_d['status'] ?></td>
								<td><a href="modify.php?edit_question_id=<?php echo $row_d['question_id']; ?>">Edit</a></td>
								<td><a href="modify.php?delete_question_id=<?php echo $row_d['question_id']; ?>">Delete</td>
								
							</td>
						 </tr>
	   </table>
	</td>
 </tr>
 </form>
 <?php
     }
 ?>
 
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
	//check session display only one

?>  
<br><br><br>
<?php

//_______________________/True False Questions Display___________________________________________________-->
?>












<?php
//________________________Fill in Blanks Questions Display_________________________________________________-->  

if(isset($_SESSION['fb_on']))
{
?>
<h3 align="center" style="color:red;">Objective Type = <?php echo "<span style='color:maroon;'>".$_SESSION['fb_objective']."</span>"; ?></h3>
<h3 align="center" style="color:red;">Total Marks = <?php echo $_SESSION['t_marks_fb']; ?></h3>
<h3 align="center" style="color:red;">Number Of Questions = <?php echo $_SESSION['quan_fb']; ?></h3>
<h3 align="center" style="color:red;">Marks Of Each Question = <?php echo $_SESSION['each_fb']; ?></h3>

<br><br><br>



	<form method="POST">
<!--_______________Questions______________-->	
	<table border="5">
	<?php
	
	

	//$query_d="SELECT question_id,question,q_paper_id, status FROM question WHERE q_paper_id = '$q_paper_id' ";
	$question_numberc=1;
	$query_d="SELECT question_id,question,q_paper_id, status FROM fb_questions WHERE q_paper_id = '$q_paper_id' ";	
	
	//$query_d="SELECT question_id,question,q_paper_id, status FROM tf_questions WHERE q_paper_id = '$q_paper_id' ";	
	
	                                                 
    $result_d=mysqli_query($con,$query_d);	
	while($row_d=mysqli_fetch_array($result_d))
	{
		
	?>
	
 <tr>
	<td>
	    <table border="5">
	                      <tr>
	                        <td><?php  echo "Question".$question_numberc++.":"; ?> &nbsp;&nbsp;&nbsp;&nbsp; </td> <?php // Question Numbering...?>
	                        <td><input style="height:30px;width:1050px;" type="text" 
		                       <?php if (isset($edit_id) && $row_d['question_id']==$edit_id) { ?>  <?php }else { ?> readonly <?php } ?> name=""
                                    value="<?php { echo $row_d['question']; }  ?>"	required /></td>     <?php //Question Discription... ?>
							    <td>
								<?php 
									echo "(".$_SESSION['each_fb'].")";
										
								   ?>
								</td>   <?php //Question Marks... ?>
							    <td><?php echo $row_d['status'] ?></td>
								<td><a href="modify.php?edit_question_id=<?php echo $row_d['question_id']; ?>">Edit</a></td>
								<td><a href="modify.php?delete_question_id=<?php echo $row_d['question_id']; ?>">Delete</td>
								
							</td>
						 </tr>
	   </table>
	</td>
 </tr>
 </form>
 <?php
     }
 ?>
 
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
	//check session display only one

?>  




<br><br><br>





<?php

//_______________________/Fill in Blanks Questions Display___________________________________________________-->
?>









<!--**********************************************/DISPLAY***************************************************************-->   
</body>
</html>
