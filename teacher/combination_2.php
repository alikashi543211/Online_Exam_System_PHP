<?php
session_start();
include "connection.php";
if(isset($_SESSION['done1']))
{
	unset($_SESSION['done1']);
	$_SESSION['done']="Success";
}

?>


























<?php
// -------------------------------------------------------------------------------------------------------------
$_SESSION['finish_check']=0;
// -------------------------------------------------------------------------------------------------------------
?>






















<?php 

// ------------------------------------------------------ Go To Subjective Part -------------------------------------------



if(isset($_POST['go_to']))
{
	if(isset($_SESSION['22_one']))
	{
		header ("Location:short_q_paper.php");
	}
	if(isset($_SESSION['two_ss']) || isset($_SESSION['double_2']))
	{
		header ("Location:long_q_paper.php");
	}
}

// ------------------------------------------------------ /Go To Subjective Part -------------------------------------------


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














<body style="background-color:lightgrey;">


</body>





























<?php
$q_paper_id=$_SESSION['q_paper_id'];
$btn_name="next1";
$btn_value="Next";
unset($_SESSION['return_back']);
unset($_SESSION['edit_recycle_bin2']);
unset($_SESSION['delete_recycle_bin2']);
unset($_SESSION['edit_answers']);
unset($_SESSION['mcq_ready']);
		 unset($_SESSION['fb_ready']);
		 unset($_SESSION['tf_ready']);



//unset($_SESSION['button_name'],$_SESSION['button_value']);

         // $butn_name="next1";                      //By default button name
         // $butn_value="Next";                      //By default button value

		 if(isset($_SESSION['button_name']) && isset($_SESSION['button_value']))
		 {
			 $butn_name  = $_SESSION['button_name'];
			 $butn_value = $_SESSION['button_value'];
			 unset($_SESSION['button_name'],$_SESSION['button_value']);
		 }
		 else
		 {
			 $butn_name="next1";
			 $butn_value="Next";
		 }




unset($_SESSION['mcq_ready']);
unset($_SESSION['tf_ready']);

?>








<?php

// ----------------------------------------------- Display Paper -------------------------------------------------------

if(isset($_POST['disp_paper']))
{
	unset($_SESSION['mcq_on']);
	unset($_SESSION['tf_on']);
	if(isset($_SESSION['set_btn2']) || isset($_SESSION['22_one']) || isset($_SESSION['two_ss']) || isset($_SESSION['double_2']))
	{
		header ('Location:comb_obj_sub_print.php');
	}
	else
	{
	header ("Location:comb_2_obj_print_paper.php");
	}
}
else if(isset($_POST['show_ans']))
{
	unset($_SESSION['mcq_on']);
	unset($_SESSION['tf_on']);
	$_SESSION['return_back']="Return Back To Questions.";
	header ('Location:combination_2_answer_sheet.php');
}

// ----------------------------------------------- /Display Paper -------------------------------------------------------

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
		 else if(isset($_SESSION['tf_on']))
		 {
		 $_SESSION['quan_tf']=$_SESSION['quan_tf']-1;
		 $_SESSION['t_marks_tf']=$_SESSION['t_marks_tf']-$_SESSION['each_tf'];
		 }
		 $_SESSION['delete_recycle_bin']=$_SESSION['delete_question_id'];
	}
$_SESSION['total_marks']=$_SESSION['t_marks_mcq']+$_SESSION['t_marks_tf'];
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
		else if(isset($_SESSION['tf_on']))
		{
			$_SESSION['t_marks_tf']=0;
			$_SESSION['quan_tf']=0;
			$_SESSION['each_tf']=0;
		}	
	}
	$_SESSION['total_marks']=$_SESSION['t_marks_mcq']+$_SESSION['t_marks_tf'];
}
//_____________________________________________/Delete All Questions________________________________________________________-->
?>



















<?php // _________________________________________*Insert Question*_______________________________________________--> ?>

<?php
unset($_SESSION['type_name']);
if(isset($check_k))
{
      ?> <h1 style="color:red;text-align:center;"><?php echo $check_k; ?></h1> <?php
}
//______________________________________Multiple Choice Questions_____________________________________________________		

if(isset($_POST['next1']))
	{
		
		//$_SESSION['next1_set']="Stage Of Insertion Of Multiple Choice Questions And Answers";
		
		 $q_paper_id=$_SESSION['q_paper_id'];
		 $status=$_POST['status'];		 
		 foreach($_POST['question_discription'] as $question)
		{	
		$question = str_replace("'","\'",$question);
		$query_c="INSERT INTO question(question,q_paper_id,status)
		                        VALUES('$question','$q_paper_id','$status') ";
		$result_c=mysqli_query($con,$query_c);
		}
		
		 $_SESSION['btn_name']="next2";
		 $_SESSION['btn_value']="Next";
		 $_SESSION['mcq_recycle_bin']="Inserted into Database Successfully.";
		 unset($_SESSION['mcq_ready']);
		 unset($_SESSION['tf_ready']);
		 $_SESSION['mcq_ready']="Add MCQs (Options)";
		 header ("Location:combination_2_answer_sheet.php");
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
		 
		 $_SESSION['tf_recycle_bin']="Insertd into Database Successfully.";
		 
		 unset($_SESSION['mcq_ready']);
		 unset($_SESSION['tf_ready']);
		 $_SESSION['tf_ready']="Add True False (Options)";
		 header ("Location:combination_2_answer_sheet.php");
			
	    }
//_________________________________________/True False__________________________________________________



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
	if(isset($_SESSION['mcq_on']))
	{
	$query_f="SELECT * FROM question WHERE question_id='$edit_question_id' ";
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
if(isset($_POST['Update']))
{
	  $_SESSION['refresh']="refresh";
	  $update_id=$_SESSION['edit_question_id'];
	  $update_question=$_POST['update_question'];
	  $update_question = str_replace("'","\'",$update_question);
	  $update_status=$_POST['update_status'];
       if(isset($_SESSION['mcq_on']))
	  {
	  $query_e="UPDATE question SET question='$update_question', status='$update_status' WHERE question_id='$update_id' ";
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


?>


















<?php /* ?>
<?php //________________________Header_________________________________________________-->  ?>

<h3 align="center" style="color:red;">Question Paper = <?php echo $_SESSION['course_name']; ?></h3>
<h3 align="center" style="color:red;">Question Paper Type = <?php echo $_SESSION['q_paper_type']; ?></h3>
<h3 align="center" style="color:red;">Total Marks = <?php echo $_SESSION['total_marks']; ?></h3>
<h3 align="center" style="color:red;">Paper Formate = <?php echo $_SESSION['paper_formate']; ?></h3>
<!--
<h3 align="center" style="color:red;">Number Of Questions = <?php //echo $num_of_questions; ?></h3>
-->

<?php  //_______________________Header___________________________________________________-->  ?>
 */ ?>	





	
	
	
	
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




<h2 align="left" style="font-size:35px;color:purple;text-align:center">Objective Paper(<span style="font-size:25px;"> MCQs & True False </span>) </h2>

<br><br><br>


	
	
	
	
	
	
	
	
	
	
	
	
	
	


	
	
	<?php if(isset($_SESSION['done'])) { ?>

<center><span align="center" style="color:Navy;font-size:40px;">Questions Of Created Paper<br><br></span></center>
<?php } ?>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<?php 
//unset($_SESSION['refresh']);
?> 
	
<?php

if(isset($_SESSION['done']) && !isset($_SESSION['refresh'])  && !isset($_SESSION['edit_update']))
{
	// __________________________________ Edit Mode (Questions Sheet) ______________________________________
?>
<center>
<form method="post">
	<table>
	<tr>
	<td colspan="4" style="color:Navy;font-size:40px;text-align:center;"></td>
	</tr>
	<tr>
	<td><input style="border-radius:4px;border:none;cursor:pointer;width:200px;height:50px;background-color:navy;color:white;"
<?php if (isset($_SESSION['edit_update'])) { ?> disabled <?php } ?>	type="submit" name="disp_mcq" value="Show MCQs (Questions)" /></td>
	<td><input style="border-radius:4px;border:none;cursor:pointer;width:200px;height:50px;background-color:navy;color:white;"
<?php if (isset($_SESSION['edit_update'])) { ?> disabled <?php } ?>	type="submit" name="disp_tf"
<?php if (isset($_SESSION['edit_update'])) { ?> disabled <?php } ?> value="Show True False (Questions)" /></td>
	<td><input style="border-radius:4px;border:none;cursor:pointer;width:200px;height:50px;background-color:navy;color:white;"
<?php if (isset($_SESSION['edit_update'])) { ?> disabled <?php } ?>	type="submit" name="show_ans" value="Edit Answers" /></td>
<?php if(isset($_SESSION['22_one']) || isset($_SESSION['two_ss']) || isset($_SESSION['double_2'])) { ?>
	<td><input style="border-radius:4px;border:none;cursor:pointer;width:200px;height:50px;background-color:navy;color:white;"
<?php if (isset($_SESSION['edit_update'])) { ?> disabled <?php } ?>	type="submit" name="go_to" value="Go To Subjective" /></td>
<?php }  ?>
	<td><input style="border-radius:4px;border:none;cursor:pointer;width:200px;height:50px;background-color:navy;color:white;"
<?php if (isset($_SESSION['edit_update'])) { ?> disabled <?php } ?>	type="submit" name="disp_paper" value="Display Paper" /></td>
	
	</tr>
	</table>
</form>	

</center>











<!-------------------------------------------------------------------------------------------------------------------------->












<!-------------------------------------------------------------------------------------------------------------------------->














<?php
   /*    
 if(isset($check)) 
 { 
       echo "<h3 style='color:red;' >".$check."</h1>";
       
 } 
 */
 ?>



<?php


if(isset($_POST['disp_mcq']))
{
	 $_SESSION['mcq_on']="MCQs (Questions)";
	unset($_SESSION['tf_on']);
}
	
if(isset($_POST['disp_tf']))
	{
	$_SESSION['tf_on']="True False  (Questions)";
	unset($_SESSION['mcq_on']);	
	}

}
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
 // END
// --------------------------------------- /Insertion Message Or Failed Message ----------------------------------------- 
?>

 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 <?php
	//------------------------------------------ Refresh Button ---------------------------------------------------------------
	if(isset($_SESSION['refresh']))
		{
	?>
	<center><form method="get">
<input style="border-radius:4px;border:none;height:50px;width:100px;background-color:navy;color:white;cursor:pointer;" type="submit" name="refresh" value="Refresh" />
</form></center>
	<?php
} 
//------------------------------------------ /Refresh Button ---------------------------------------------------------------
?>
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
<?php

if(isset($_SESSION['mcq_on']))
{
	 $_SESSION['mcq_on']="On";
} else if(isset($_SESSION['tf_on']))
{
	$_SESSION['tf_on']="On";
}
else {
}



// __________________________________ /Edit Mode (Questions Sheet) ______________________________________
?>
	
	











<html>
<head>
<title>
Objective Paper
</title>
</head>
<body style="background-color:white;">


<?php
 
 /*
<?php // ----------------------------------------- Sign Out Button ----------------------------------------------------- ?>
<form align="right" action="../index.php" method="post">
<input style="height:50px;width:100px;background-color:navy;color:white;cursor:pointer;" type="submit" class="testbutton" name="sign_out" value="Sign Out" />
</form>
<?php // ----------------------------------------- /Sign Out Button ----------------------------------------------------- ?>
*/ 

?>








<!--*******************************************INPUT*******************************************************************-->   
<?php
if(!isset($_SESSION['done']))
{
	if(isset($input_name)) { ?>
	
<h2 align="center" style="color:green;font-size:30px;">Enter <?php echo "'<span style='color:red;'>".$input_name."</span>'"; ?> Questions</h2>
	<?php } ?>
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
	                 <td><input style="border:none;height:30px;width:1050px;" type="text" name="question_discription[]" required /></td>     <?php //Question Discription... ?>
	                  <td>
					  <?php  echo "(".$marks_of_each.")"; ?>
					  </td>    <?php //Question Marks... ?>
					   <td><select name="status" style="height:30px;border:none;" >
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
	<br><br><br><br><input style="border-radius:4px;border:none;cursor:pointer;width:100px;height:50px;background-color:navy;color:white;" type="submit"
	name="<?php echo $butn_name; ?>" value="<?php echo $butn_value; ?>" />
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
if(isset($_SESSION['tf_on']) || isset($_SESSION['mcq_on']))
{
	     unset($_SESSION['mcq_ready']);
		 unset($_SESSION['tf_ready']);
?>





















<?php
//echo $_SESSION['edit_update'];
?>






<?php if(isset($_SESSION['edit_update']) && !isset($_SESSION['refresh']))
{
	?>
	<br>
 <!--<h1 align="center" style="color:Navy;font-size:40px;text-align:center;font-weight:normal;">Questions (Edit / Update / Delete)</h1>-->
    <form method="POST" >
                      <table border="1" align="center">
					  <?php if(!isset($_SESSION['edit_update'])) { ?>
                                   <!--<tr>
                                      <td>Question_ID :</td>
                                      <td>--> <input style="padding:20px;border:none;width:900px;height:40px;" readonly type="hidden" name="update_q_id"
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
             <td colspan="2"><input style="border-radius:4px;border:none;height:50px;width:100px;background-color:navy;color:white;cursor:pointer;"
             <?php if(isset($edit_question_id)) { ?> <?php } else { ?> disabled <?php } ?>
              type="submit" name="Update" value="Update" /></td>
 </tr>
            </table>
                    </form>

<?php
}
//<!--------------------------------------*/*Edit/Update/Delete----------------------------------->
?>






















<?php

}
?>
	
<?php //______________________________________/User Interface Display Mode_________________________________________________--> ?>
   
  
  
<?php
/*
if(isset($_POST['disp_mcq']))
{
	echo $_SESSION['mcq_on']="MCQs";
	unset($_SESSION['tf_on']);
}
	
if(isset($_POST['disp_tf']))
	{
	echo $_SESSION['tf_on']="True False";
	unset($_SESSION['mcq_on']);	
	}
*/
?>
  
  



  
  
<!--******************************************************DISPLAY********************************************************-->   


<?php
//________________________MCQs Questions Display_________________________________________________-->  

if(isset($_SESSION['mcq_on']) && !isset($_SESSION['refresh']) && !isset($_SESSION['edit_update']))
{
	echo "<h1 style='color:navy;' align='center'><br><br>Questions ( <span style='color:red;'>MCQs</span> )</h1>";

?>
<?php /*
<h3 align="center" style="color:red">Objective Type = <?php echo "<span style='color:orange;'>".$_SESSION['mcq_objective']."</span>"; ?> </h3>
<h3 align="center" style="color:red;">Total Marks = <?php echo $_SESSION['t_marks_mcq']; ?></h3>
<h3 align="center" style="color:red;">Number Of Questions = <?php echo $_SESSION['quan_mcq']; ?></h3>
<h3 align="center" style="color:red;">Marks Of Each Question = <?php echo $_SESSION['each_mcq']; ?></h3>

<br><br><br>
  */ ?>                               



	<form method="POST">
<!--_______________Questions______________-->	
	                   <table border="1" align="center">
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
	    <table>
	                      <tr>
	                        <td><?php  echo "Question".$question_numbera++.":"; ?> &nbsp;&nbsp;&nbsp;&nbsp; </td> <?php // Question Numbering...?>
	                        <td><input style="padding:18px;border:none;height:30px;width:1050px;" type="text" 
		                       <?php if (isset($edit_id) && $row_d['question_id']==$edit_id) { ?>  <?php }else { ?> readonly <?php } ?> name=""
                                    value="<?php { echo $row_d['question']; }  ?>"	required /></td>     <?php //Question Discription... ?>
							    <td>
								<?php 
									echo "(".$_SESSION['each_mcq'].")";
										
								   ?>
								</td>   <?php //Question Marks... ?>
							    <td><?php echo $row_d['status'] ?></td>
								<td><a href="combination_2.php?edit_question_id=<?php echo $row_d['question_id']; ?>">Edit</a></td>
								<td><a href="combination_2.php?delete_question_id=<?php echo $row_d['question_id']; ?>">Delete</td>
								
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
  
	//check session display only one
}
?>  
<?php
//_______________________/MCQs Questions Display___________________________________________________-->


?>
















<?php
	
//________________________True False Questions Display_________________________________________________-->  

if(isset($_SESSION['tf_on']) && !isset($_SESSION['refresh']) && !isset($_SESSION['edit_update']))
{
   echo "<h1 style='color:navy;' align='center'><br><br>Questions ( <span style='color:red;'>True False</span> )</h1>";
  	
?>
<?php /*
<h3 align="center" style="color:red;">Objective Type = <?php echo "<span style='color:purple;'>".$_SESSION['tf_objective']."</span>"; ?></h3>
<h3 align="center" style="color:red;">Total Marks = <?php echo $_SESSION['t_marks_tf']; ?></h3>
<h3 align="center" style="color:red;">Number Of Questions = <?php echo $_SESSION['quan_tf']; ?></h3>
<h3 align="center" style="color:red;">Marks Of Each Question = <?php echo $_SESSION['each_tf']; ?></h3>

<br><br><br>

*/ ?>

	<form method="POST">
<!--_______________Questions______________-->	
	<table align="center" border="1">
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
	    <table>
	                      <tr>
	                        <td><?php  echo "Question".$question_numberb++.":"; ?> &nbsp;&nbsp;&nbsp;&nbsp; </td> <?php // Question Numbering...?>
	                        <td><input style="padding:18px;border:none;height:30px;width:1050px;" type="text" 
		                       <?php if (isset($edit_id) && $row_d['question_id']==$edit_id) { ?>  <?php }else { ?> readonly <?php } ?> name=""
                                    value="<?php { echo $row_d['question']; }  ?>"	required /></td>     <?php //Question Discription... ?>
							    <td>
								<?php 
								echo "(".$_SESSION['each_tf'].")";
										
								   ?>
								</td>   <?php //Question Marks... ?>
							    <td><?php echo $row_d['status'] ?></td>
								
								<td><a href="combination_2.php?edit_question_id=<?php echo $row_d['question_id']; ?>">Edit</a></td>
								<td><a href="combination_2.php?delete_question_id=<?php echo $row_d['question_id']; ?>">Delete</td>
								
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
 <!--
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
   -->
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







<!--**********************************************/DISPLAY***************************************************************-->   
</body>
</html>
