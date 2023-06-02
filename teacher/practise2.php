<?php 
session_start(); // Start the session
if (!isset($_SESSION['q_paper_type_id']) && !isset($_SESSION['course_id'])) 
{
header ("Location:courses.php");
exit();
}
else
{ 
include_once 'connection.php';
}
//-----------------------------------------------------------------------------------
unset($_SESSION['mcq_recycle_bin']);    //insertion of MCQs Of MCQs Session should be unset at this stage
unset($_SESSION['tf_recycle_bin']);     
unset($_SESSION['fb_recycle_bin']);
unset($_SESSION['total_questions']);
unset($_SESSION['comb_s']);
unset($_SESSION['one_choice']);
unset($_SESSION['one_sub']);
//-----------------------------------------------------------------------------------------------------------
unset($_SESSION['mcq_ready']);                //When Mcqs Display Session should be unset at this stage
unset($_SESSION['tf_ready']);        //When True False Display Session should be unset at this stage
unset($_SESSION['fb_ready']);        //When True False Session should be unset at this stage
unset($_SESSION['done']);
unset($_SESSION['section2']);
unset($_SESSION['comb1']);



 $b_name1="submission";
 $b_value1="Submit";
//---------------------------------------------------------------------------------------------------







//---------------------------------------------------------------------------------------------------
unset($_SESSION['selected_mcq']);                //When Mcqs Display Session should be unset at this stage
unset($_SESSION['selected_tf']);        //When True False Display Session should be unset at this stage
unset($_SESSION['selected_fb']);        //When True False Session should be unset at this stage
//unset($_SESSION['quantity_sq']);
//unset($_SESSION['quantity_lq']);
//------------------------------------------------------------------------------------------------------------












//--------------------------------------------------------------------------------------------------------
unset($_SESSION['mcq_on']);               //When Mcqs Display Session should be unset at this stage
unset($_SESSION['tf_on']);               //When True False Display Session should be unset at this stage
unset($_SESSION['fb_on']);              //When True False Session should be unset at this stage
unset($_SESSION['done']);
$_SESSION['calculate_total']=0;
//------------------------------------------------------------------------------------
?>

<?php

$q_paper_type_id=$_SESSION['q_paper_type_id'];
$course_id=$_SESSION['course_id'];

$query_x="SELECT * FROM q_paper WHERE (q_paper_type_id='$q_paper_type_id' && course_id='$course_id')";
$result_x=mysqli_query($con,$query_x);
while($row_x=mysqli_fetch_array($result_x))
{
	$_SESSION['q_paper_id']=$row_x['q_paper_id'];
}


?>




<?php
// __________________________________________Mix Paper Formate Insertion________________________________________________

if(isset($_POST['mix_create_paper']))
{
	$_SESSION['mix_paper']="Mix Paper in Session";
	$formate=$_SESSION['paper_formate'];
	$total_marks=$_SESSION['total_marks'];
	$q_paper_id=$_SESSION['q_paper_id'];
	
	$query_f="INSERT INTO q_p_formate(formate,total_marks,q_paper_id,status)
	                               VALUES('$formate','$total_marks','$q_paper_id','Active')";
	$run_f=mysqli_query($con,$query_f);
	
	
	$query_j="SELECT q_p_formate_id,q_paper_id FROM q_p_formate WHERE q_paper_id='$q_paper_id'";
	$run_j=mysqli_query($con,$query_j);
    while($row_j=mysqli_fetch_array($run_j))
	{
		$_SESSION['q_p_formate_id']=$row_j['q_p_formate_id'];
	}
	
     $q_p_formate_id=$_SESSION['q_p_formate_id'];
	
}

// __________________________________________/Mix Paper Formate Insertion________________________________________________

?>















<?php
if(isset($_POST['create_paper1']) || isset($_POST['mix_create_paper']))
{
	
// if paper is mix paper then query will execute one time only	
   if(!isset($_POST['mix_create_paper']))
   {
    $formate=$_SESSION['paper_formate'];
	$total_marks=$_SESSION['total_marks'];
	$q_paper_id=$_SESSION['q_paper_id'];
	
	$query_f="INSERT INTO q_p_formate(formate,total_marks,q_paper_id,status)
	                               VALUES('$formate','$total_marks','$q_paper_id','Active')";
	$run_f=mysqli_query($con,$query_f);
	
	
	$query_j="SELECT q_p_formate_id,q_paper_id FROM q_p_formate WHERE q_paper_id='$q_paper_id'";
	$run_j=mysqli_query($con,$query_j);
    while($row_j=mysqli_fetch_array($run_j))
	{
		$_SESSION['q_p_formate_id']=$row_j['q_p_formate_id'];
	}
	
     $q_p_formate_id=$_SESSION['q_p_formate_id'];
	 
   }
   
   
   
   //_______________________________________Subjective Formate Insertion__________________________________________
   
	if(isset($_SESSION['short_questions']) && isset($_SESSION['long_questions']))
	{
		//_______Short Questions.
		$_SESSION['comb_s']="Subjective Combination Has Set.";
		$t_marks_sq=$_SESSION['t_marks_sq'];
		$quan_sq=$_SESSION['quan_sq'];
		$status="Active";
		$query_e="INSERT INTO sq (t_marks_Sq,quan_sq,status)
		                         VALUES('$t_marks_sq','$quan_sq','$status')";
		$run_e=mysqli_query($con,$query_e);
		
		
		//_______Long Questions.
		$t_marks_lq=$_SESSION['t_marks_lq'];
		$quan_lq=$_SESSION['quan_lq'];
		$status="Active";
		$query_p="INSERT INTO lq (t_marks_lq, quan_lq, status)
		                         VALUES('$t_marks_lq','$quan_lq','$status')";
		$run_p=mysqli_query($con,$query_p);
		
		header ("Location:sq_in_mix_paper.php");
		
	}
	else if(isset($_SESSION['short_questions']))
	{
		$t_marks_sq=$_SESSION['t_marks_sq'];
		$quan_sq=$_SESSION['quan_sq'];
		$status="Active";
		$query_e="INSERT INTO sq (t_marks_Sq,quan_sq,status)
		                         VALUES('$t_marks_sq','$quan_sq','$status')";
		$run_e=mysqli_query($con,$query_e);
		header ("Location:short_q_paper.php");
	}
	else if(isset($_SESSION['long_questions']))
	{
		$_SESSION['one_sub']="Single Subjective Has Set.";
		$t_marks_lq=$_SESSION['t_marks_lq'];
		$quan_lq=$_SESSION['quan_lq'];
		$status="Active";
		$query_p="INSERT INTO lq (t_marks_lq, quan_lq, status)
		                         VALUES('$t_marks_lq','$quan_lq','$status')";
		$run_p=mysqli_query($con,$query_p);
		header ("Location:long_q_paper.php");
	}
//__________________________________________/Subjective Formate Insertion_________________________________________________
}
?>


<?php

//----------------------------------- Objective Question Paper Insertion----------------------
if(isset($_POST['create_paper']) || isset($_POST['mix_create_paper']))
{
	if(!isset($_POST['mix_create_paper']))
	{
	
	$formate=$_SESSION['paper_formate'];
	$total_marks=$_SESSION['total_marks'];
	$q_paper_id=$_SESSION['q_paper_id'];
	$query_f="INSERT INTO q_p_formate(formate,total_marks,q_paper_id,status)
	                               VALUES('$formate','$total_marks','$q_paper_id','Active')";
	$run_f=mysqli_query($con,$query_f);
	if($query_f)
	{
		echo "<h1>Yes</h1>";
	}
	else{ echo "<h1>No</h1>"; 
	}
					
    $query_j="SELECT q_p_formate_id,q_paper_id FROM q_p_formate WHERE q_paper_id='$q_paper_id'";
	$run_j=mysqli_query($con,$query_j);
    while($row_j=mysqli_fetch_array($run_j))
	{
		$_SESSION['q_p_formate_id']=$row_j['q_p_formate_id'];
	}
	
     $q_p_formate_id=$_SESSION['q_p_formate_id'];
	}
	if(isset($_SESSION['mcq_objective']))
	{
		
		$t_marks_mcq=$_SESSION['t_marks_mcq'];
		$quan_mcq=$_SESSION['quan_mcq'];
		$each_mcq=$_SESSION['each_mcq'];
		$query_g="INSERT INTO mcq(t_marks_mcq,quan_mcq,each_mcq,q_p_formate_id)
		                   VALUES('$t_marks_mcq','$quan_mcq','$each_mcq','$q_p_formate_id')";
						   $run_g=mysqli_query($con,$query_g);
	}
if(isset($_SESSION['tf_objective']))
	{
		$t_marks_tf=$_SESSION['t_marks_tf'];
		$quan_tf=$_SESSION['quan_tf'];
		$each_tf=$_SESSION['each_tf'];
		$query_h="INSERT INTO tf(t_marks_tf,quan_tf,each_tf,q_p_formate_id)
		                   VALUES('$t_marks_tf','$quan_tf','$each_tf','$q_p_formate_id')";
						   $run_h=mysqli_query($con,$query_h);
	}		
	if(isset($_SESSION['fb_objective']))
	{
		$t_marks_fb=$_SESSION['t_marks_fb'];
		$quan_fb=$_SESSION['quan_fb'];
		$each_fb=$_SESSION['each_fb'];
		$query_i="INSERT INTO fb(t_marks_fb,quan_fb,each_fb,q_p_formate_id)
		                   VALUES('$t_marks_fb','$quan_fb','$each_fb','$q_p_formate_id')";
						   $run_i=mysqli_query($con,$query_i);
	}		
		
								   
								   
	if(isset($_SESSION['mcq_objective']) && isset($_SESSION['fb_objective']) && isset($_SESSION['tf_objective']) )
	{
	                              //header ("Location:obj_question_paper.php");
      header ("Location:mix_obj_questions_paper.php");     	 
	}
	else
		if(isset($_SESSION['mcq_objective']) && isset($_SESSION['fb_objective']))
		{
			unset($_SESSION['comb1']);
			unset($_SESSION['comb2']);
			unset($_SESSION['comb3']);
			$_SESSION['comb1']="Combination 1 Has Set.";
			
			header ("Location:combination_1.php");
		}
	else
		if(isset($_SESSION['mcq_objective']) && isset($_SESSION['tf_objective']))
		{
			unset($_SESSION['comb1']);
			unset($_SESSION['comb2']);
			unset($_SESSION['comb3']);
			$_SESSION['comb2']="Combination 2 Has Set.";
			header ("Location:combination_2.php");
		}
		else
		if(isset($_SESSION['tf_objective']) && isset($_SESSION['fb_objective']))
		{
			unset($_SESSION['comb1']);
			unset($_SESSION['comb2']);
			unset($_SESSION['comb3']);
			$_SESSION['comb3']="Combination 3 Has Set.";
			header ("Location:combination_3.php");
		}
	else if(isset($_SESSION['mcq_objective']) || isset($_SESSION['fb_objective']) || isset($_SESSION['tf_objective']))
	{
		$_SESSION['one_obj']="One choice Of Objective Selected.";
	  header ("Location:obj_question_paper.php"); 	
	}
}

//---------------------------------------------------/Go Objective Question Paper----------------------------------------
?>


















<!----------------------------------------------------Start Section-------------------------------------------------------->

<?php //  This is user page which provide user add data , display data , edit data , update data
//                                  and delete data from database                    ?>
<?php            // start of session
   //connection file 
   
   
?>
<html>
   <head>
   
       <link rel="shortcut icon" href="d.jpg" />                        <?php // short cut icon ?>
	   <link rel="stylesheet" href="style.css" type="text/css" />
       <link rel="stylesheet" href="stylesheet.css" type="text/css" />  <?php // stylesheet linked ?>
    <title>
Teacher/Paper Format
    </title>
	<style>
	h1{color:white;text-align:center;}
	</style>
  </head>
<?php
$btn="Add";
?>
<!---------------------------------------------------Start Section End-------------------------------------------------------->











                                       
<!------------------------------------------------Section 1------------------------------------------------------------------->									   
                                             <?php// USER INTERFACE  ?>
											 
<body style="background-color:maroon;">
<form action="../index.php" method="post">
<table id="table1" bordercolor="white" style="background-color:maroon;">
<tr>
<td style="height:100px;width:1100px;">
<?php

$course_id=$_SESSION['course_id'];

$query_b="SELECT course_id, course_name FROM course WHERE course_id='$course_id' ";
$result_b=mysqli_query($con,$query_b);
while($row_b=mysqli_fetch_array($result_b))
{
	$_SESSION['course_name']=$row_b['course_name'];
}

$q_paper_type_id=$_SESSION['q_paper_type_id'];

$query_c="SELECT q_paper_type_id,ques_type FROM q_paper_type WHERE q_paper_type_id='$q_paper_type_id' ";
$result_c=mysqli_query($con,$query_c);
while($row_c=mysqli_fetch_array($result_c))
{
	$_SESSION['q_paper_type']=$row_c['ques_type'];
}
?>
<?php echo "<h1 style='text-align:left;'>Paper format of ".($_SESSION['course_name']." Of ".$_SESSION['q_paper_type']."</h1>"); ?>
</td>
<td style="height:70px; width:250px;text-align:center;"><button style="width:120px;cursor:pointer;" class="testbutton" name="sign_out" />Sign Out </button>
</td>
</tr>
<tr>
</tr>
</table>
</form>

                                             <!--Result Of Edit Check-->
<?php
if(isset($check_edit))
{
echo "<h1 align='center'>".$check_edit."</h1>";
} 
// end of edit check
?>
<!-------------------------------------------------------------------------------------------------------------------------->
<form method="post">
<table align="center" style="text-align:center;color:white;">
<tr>
<td><input type="submit" name="objective" value="Objective" /></td>
<td><input type="submit" name="subjective" value="Subjective" /></td>
<td><input type="submit" name="mix" value="Mix" /></td>
</tr>
</table>
</form>





<?php

if(isset($_POST['change_formate2']))
{
    unset($_SESSION['t_marks_sq']);
	unset($_SESSION['quan_sq']);
	unset($_SESSION['t_marks_lq']);
	unset($_SESSION['quan_lq']);
	unset($_SESSION['long_questions']);
	unset($_SESSION['short_questions']);	
}

?>




































<?php //________________________MIX SEND FORMATE ?>
<?php
if(isset($_POST['mix_send_formate']))
{
	$obj_total_marks=$_POST['total_marks1'];
	$sub_total_marks=$_POST['total_marks2'];
	$calculate=$obj_total_marks+$sub_total_marks;
	$total_marks=$_POST['total_marks'];
	if($calculate==$total_marks)
	{
		$check_total="Yes.";
		$_SESSION['total_marks']=$_POST['total_marks'];
		$_SESSION['total_marks1']=$_POST['total_marks1'];
		$_SESSION['total_marks2']=$_POST['total_marks2'];
	}
	else
	{
		$error_total="No.";
		unset ($_SESSION['total_marks']);
		unset ($_SESSION['total_marks1']);
		unset ($_SESSION['total_marks2']);
	}
	print_r($_POST);
}
?>





















<?php
//-----------------------------------------Save Paper Formate into Session--------------------------------------->


if(isset($_POST['objective']))
{
	$_SESSION['paper_formate']="Objective";
	unset($_SESSION['mix']);
}
else if(isset($_POST['subjective']))
{
	$_SESSION['paper_formate']="Subjective";
	unset($_SESSION['mix']);
	unset($_SESSION['t_marks_sq']);
	unset($_SESSION['quan_sq']);
	unset($_SESSION['t_marks_lq']);
	unset($_SESSION['quan_lq']);
	unset($_SESSION['long_questions']);
	unset($_SESSION['short_questions']);
}
else if(isset($_POST['mix']))
{
	$_SESSION['paper_formate']="Mix";
	$_SESSION['mix']="You are ready to create Mix Paper.";
}
else
{
	
}






if(isset($_POST['mix_change_formate']))
{
	unset($_SESSION['mix']);
}













//----------------------------------------/Save Objective Type into Session------------------------------------------->
?>













<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~MIX SECTION~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


<!--------------------------------------------------Mix Main Interface-------------------------------------------->                                         
<?php
    if(isset($_POST['mix']) || isset($_POST['submission']) || isset($_POST['mix_send_formate'])) 	
{                                                                
 ?>
	<form method="post">
    <table align="center" style="color:white;">
	<tr>
	<td>Total Marks :</td>
	<?php if(isset($_POST['total_marks']))
	{
		$total_marks=$_POST['total_marks'];
	}		
	?>
	<td><input type="text" placeholder="Enter Marks" value="<?php if(isset($total_marks)) { echo $total_marks; } ?>" name="total_marks" /></td>
	</tr>
	<tr>                                  <!--EXTRA ROW TO DISPLAY MESSAGE "Yes" Or "No"-->
	<td colspan="2" align="right" >
	              
				 <?php 
				                    //check total marks and display check after send
									
				 if (isset($check_total))         { echo "<span style='color:white;'>".$check_total."</span>"; }
           else  if (isset($error_total))         { echo "<span style='color:white;'>".$error_total."</span>"; } 
                  
				 ?>
		</td>
				 </tr>
    </table>
    	
<!--------------------------------------------------Mix Main Interface-------End------------------------------------>
<?php	  
}	
?>									 
<!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~MIX SECTION~~~~~~~~~~~~~~~~~~~~End~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->














<?php                     // variables as buttons

   // FOR OBJECTIVE SECTION
   
 $btn1_value="Submit Formate";
 $btn1_name="submit_formate1";
 $btn2_value="Submit Formate";
 $btn2_name="submit_formate2";
 
  
 
 ?>

 
 
 
 
<!--------------------------------------------Save Objective Formate------------Start---------------------------------------->
<?php
	if(isset($_POST['send_formate1']) || isset($_POST['mix_send_formate']))                                // If we click on send button Then values are saved.
	{
	
	$btn1_value="Send Formate";
	$btn1_name="send_formate1";
//==================================TOTAL MCQS MARKS CHECK========================================>


	if(isset($_POST['choice1']) || isset($_POST['m1_choice1']))                      // If total marks of of mcqs are set then all format would be saved.
	{
                                                 
	$t_marks_mcq  =  $_POST['t_marks_mcq'];
	$quan_mcq     =  $_POST['quan_mcq'];
	//$num_choices  =  $_POST['num_choices'];
    $each_mcq     =  $_POST['each_mcq'];
	                                           
											   
	$calculate1=$quan_mcq*$each_mcq;
	if($calculate1==$t_marks_mcq)
	{
		$check1="Yes.";
		$_SESSION['mcq_objective']="MCQs";
	}
	
	else
		
	{
		$error1="No.";
	}
	
	}
	else                                           //If Teacher Does not want to include MCQS in objective
	{
	
	
    $t_marks_mcq  =  0;
	$quan_mcq     =  0;
    $each_mcq     =  0;
	$check1="Yes.";
	unset($_SESSION['mcq_objective']);

	
	
	}
	
	
	
	
	
//============================TOTAL MCQS MARKS VERIFICATION=======END============================================================>	
	
	
	
	
	
	
	
	
//==================================TOTAL FILL IN BLANK MARKS VERIFICATION========================================>


if(isset($_POST['choice2']) || isset($_POST['m1_choice2']))                      // If total marks of of mcqs are set then all format would be saved.
	{
	                                                     


	
                                                     
	                                                 
	$t_marks_fb  =  $_POST['t_marks_fb'];
	$quan_fb     =  $_POST['quan_fb'];
    $each_fb     =  $_POST['each_fb'];
	                                           
	                                          
	$calculate2=$quan_fb*$each_fb;
	if($calculate2==$t_marks_fb)
	{
		$check2="Yes.";
		$_SESSION['fb_objective']="Fill in Blanks";
	}
	else
	{
		$error2="No.";
	}
	
	}
	else                                           //If Teacher Does not want to include FILL IN BLANKS in objective
	{
	  
    $t_marks_fb  =      0;
	$quan_fb     =      0;
    $each_fb     =      0;
	$check2="Yes.";
	unset($_SESSION['fb_objective']);
	}
	
	
	
//============================TOTAL FILL IN BLANK MARKS VERIFICATION=======End===================================>	
	
	
	
	
	
	
	
//==================================TOTAL TRUE FALSE MARKS VERIFICATION===START==================================>


	if(isset($_POST['choice3']) || isset($_POST['m1_choice3']))                      // If total marks of of mcqs are set then all format would be saved.
	{
	                                                    


	
                                                                                                   
	$t_marks_tf  =  $_POST['t_marks_tf'];
	$quan_tf     =  $_POST['quan_tf'];
    $each_tf     =  $_POST['each_tf'];
	                                           
	                                         
	$calculate3  = ($quan_tf*$each_tf);
	
	if($calculate3==$t_marks_tf)
	{
		$check3="Yes.";
		$_SESSION['tf_objective']="True False";
	}
	else
	{
		$error3="No.";
	}
	
	}
	else                                           //If Teacher Does not want to include TRUE FALSE in objective
	{
	  
    $t_marks_tf  =  0;
	$quan_tf     =  0;
    $each_tf     =  0;
	$check3      =  "Yes.";
	unset($_SESSION['tf_objective']);
	
	}
	
	
	
	                                                
//============================TOTAL TRUE FALSE MARKS VERIFICATION END=======END================================>	






	
//==========================TOTAL MARKS VERIFICATION=======START===============================================>



if(!isset($_POST['mix_send_formate']))
{
$total_marks      =  $_POST['total_marks'];
$calculate_total  =  ($t_marks_mcq+$t_marks_fb+$t_marks_tf);

if($calculate_total==$total_marks)
{
	$check4 = "Yes.";
	$_SESSION['total']=1;
}
else
{
	$error4 = "No.";
	$_SESSION['total']="";
}

}
else if(isset($_POST['mix_send_formate']))
{
    $total_marks1      =  $_POST['total_marks1'];
    $calculate_total  =  ($t_marks_mcq+$t_marks_fb+$t_marks_tf);

if($calculate_total==$total_marks1)
{
	$check4 = "Yes.";
	$_SESSION['total']=1;
}
else
{
	$error4 = "No.";
	$_SESSION['total']="";
}
	
}



//==========================TOTAL MARKS VERIFICATION=======END===============================================>







//==========================SAVE FORMATE IN SESSIONS AFTER VERIFICATION=======START==========================>	



if(isset($check1) && isset($check2) && isset($check3) && isset($check4))

{
	


$_SESSION['total_marks'] =  $total_marks;
//$_SESSION['num_choices'] =  $num_choices;
$_SESSION['t_marks_mcq'] =  $t_marks_mcq;
$_SESSION['quan_mcq']    =  $quan_mcq;
$_SESSION['each_mcq']    =  $each_mcq;
$_SESSION['t_marks_fb']  =  $t_marks_fb;
$_SESSION['quan_fb']     =  $quan_fb;
$_SESSION['each_fb']     =  $each_fb;
$_SESSION['t_marks_tf']  =  $t_marks_tf;
$_SESSION['quan_tf']     =  $quan_tf;
$_SESSION['each_tf']     =  $each_tf;
if(!isset($_POST['mix_send_formate']))
{
$btn1_value="Create Paper";
$btn1_name="create_paper";
}
else if(isset($_POST['mix_send_formate']))
{
	$obj_yes="Objective Section Is Ready To Make Paper.";
}

}
	



//==========================SAVE FORMATE IN SESSIONS AFTER VERIFICATION=======END=========================>	
} //END OF OBJECTIVE FORMATE	
	
?>
<!--------------------------------------------------/SAVE OBJECTIVE FORMATE-------------------------------------------------->	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
		
	
	
	
<!--------------------SUBJECTIVE----------------------FORMATE SAVED------------------------------------End--------------->



<?php //____________________Short Questions ?>
<?php
	if(isset($_POST['quan_sq']) && isset($_POST['t_marks_sq'])) 
		{ 
	    $_SESSION['quan_sq']=$_POST['quan_sq'];
		$_SESSION['t_marks_sq']=$_POST['t_marks_sq'];
        $quan_sq=$_SESSION['quan_sq'];
		$t_marks_sq=$_SESSION['t_marks_sq'];
		
		$_SESSION['short_questions']="Short Questions Formate Has Set.";
		
		}
		else
	{
        unset($_SESSION['short_questions']);
	}
	?>
	
	
	
	
	
	
	
	
	<?php //____________________Long Questions ?>
	
<?php
	if(isset($_POST['quan_lq']) && isset($_POST['t_marks_lq'])) 
		{ 
	    $_SESSION['quan_lq']=$_POST['quan_lq'];
		$_SESSION['t_marks_lq']=$_POST['t_marks_lq'];
        $quan_lq=$_SESSION['quan_lq'];
		$t_marks_lq=$_SESSION['t_marks_lq'];
		$_SESSION['long_questions']="Long Questions Formate Has Set.";
		}
		else
	{            
        unset($_SESSION['long_questions']);
	}
	?>




<?php
if(isset($_POST['send_formate2']) || isset($_POST['mix_send_formate']))
{
if(isset($_SESSION['short_questions']) && isset($_SESSION['long_questions']))
		{
			if(!isset($_POST['mix_send_formate']))
			{
			$total=$_SESSION['t_marks_sq']+$_SESSION['t_marks_lq'];
		    if($total==$_SESSION['total_marks'])
			{
				$check="Yes.";
			}
            else 
			{
				$error="No.";
			}	
			}
else if(isset($_POST['mix_send_formate']))
{
	$total2=$_SESSION['t_marks_sq']+$_SESSION['t_marks_lq'];
		    if($total2==$_POST['total_marks2'])
			{
				$check="Yes.";
			}
            else 
			{
				$error="No.";
			}
}	
		}
		
		
		
		
		else if(isset($_SESSION['short_questions']))
		{
			if(!isset($_POST['mix_send_formate']))
			{
			$total=$_SESSION['t_marks_sq']+0;
			if($total==$_SESSION['total_marks'])
			{
				$check="Yes.";
			}
			else 
			{
				$error="No.";
			}
		}
		else if(isset($_POST['mix_send_formate']))
		{
		$total2=$_SESSION['t_marks_sq']+0;
			if($total2==$_POST['total_marks2'])
			{
				$check="Yes.";
			}
			else 
			{
				$error="No.";
			}	
		}
	}
		
		else if(isset($_SESSION['long_questions']))
		{
			if(!isset($_POST['mix_send_formate']))
			 {
			$total=$_SESSION['t_marks_lq']+0;
			if($total==$_SESSION['total_marks'])
			{
				$check="Yes.";
			}
			else 
			{
				$error="No.";
			}
		 }
		 else  if(isset($_POST['mix_send_formate']))
		 {
			 
			$total2=$_SESSION['t_marks_lq']+0;
			if($total2==$_POST['total_marks2'])
			{
				$check="Yes.";
			}
			else 
			{
				$error="No.";
			} 
			 
		 }
		 
		}
}
	?>	

<?php
 if(!isset($_POST['mix_send_formate']))
 {
       if(isset($check))
	   {
		   $btn2_name="create_paper1";
		   $btn2_value="Create Paper";
	   }
	   else if(isset($error))
	   {
		    $btn2_value="Send Formate";
			$btn2_name="send_formate2";
	   }
 }
 else if(isset($_POST['mix_send_formate']))
 {
	if(isset($check))
	{
		$sub_yes="Subjective Section Is Ready For Create Paper.";
	}
 }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
if(isset($_POST['mix_send_formate']))
{
	
if(isset($sub_yes) && isset($obj_yes) && isset($check_total))
 {
	 
	$b_name1="mix_create_paper";
	$b_value1="Create Paper";
   }
else
 {
     $b_name1="mix_send_formate";
     $b_value1="Send Formate";
   }	

}
?>










<!--------------------SUBJECTIVE----------------------FORMATE SAVED------------------------------------End--------------->



	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	






<!------------------------OBJECTIVE-------------------PAPER FORMATE INTERFACE------------START------------------------------->
                                          
<?php
    if(isset($_POST['objective']) || isset($_POST['mix']) || isset($_POST['submit_formate1']) || isset($_POST['mix_send_formate'])
		|| isset($_POST['change_formate1']) || isset($_POST['send_formate1']) || (isset($_POST['submission'])) ) 	
{ 
  ?>
    <?php
	if(!isset($_POST['mix']) && !isset($_POST['submission']) && !isset($_POST['mix_send_formate']))
	{
	?>
	<form method="post">
	<?php
	}
	?>
    <table  align="center" style="color:white;">
	
	<tr>
	<td colspan="2" align="center"><h1>Objective</h1></td>
	</tr>
	
	
<!------------------------------------------------------TOTAL MARKS INTERFACE------------------------------------------------>
	<tr>
	<td>Total Marks :</td>
	<td>
	
	
	<?php
	                  if(isset($_POST['total_marks1']))
					  {
						  $total_marks1=$_POST['total_marks1'];
					  }
                      else if(isset($_POST['total_marks']))
	                {
	                   $total_marks=$_POST['total_marks'];	
	                }
	?>
	
	
	<input type="text" placeholder="Enter Marks" <?php if(!isset($_POST['mix']) && !isset($_POST['submission']) && !isset($_POST['mix_send_formate']))  { ?> name="total_marks" <?php } else { ?>
	name="total_marks1" <?php } ?>
	value="<?php if(isset($total_marks1)) { echo $total_marks1;  } else if(isset($total_marks)) { echo $total_marks;  } ?>" required />
	
	</td>
	       </tr>
			 
	<tr>                                  <!--EXTRA ROW TO DISPLAY MESSAGE "Yes" Or "No"-->
	<td colspan="2" align="right" >
	              
				 <?php 
				                    //check total marks and display check after send
									
				 if (isset($check4))         { echo "<span style='color:white;'>".$check4."</span>"; }
           else  if (isset($error4))         { echo "<span style='color:white;'>".$error4."</span>"; } 
                  
				 ?>
		</td>
				 </tr>
				 
    
				 
	
<!-------------------------------------------------/TOTAL MARKS INTERFACE---------------------------------------------------->
				 
				  
<!--------------------------------------------------MCQS INTERFACE----------------------------------------------------------->
				  
	<tr> 
	     <td colspan="2">
	                        <input type="checkbox" <?php if(!isset($_POST['mix']) && !isset($_POST['submission']) && !isset($_POST['mix_send_formate']))  { ?> name="choice1" <?php } else { ?>
	name="m1_choice1" <?php } ?> value="MCQS" 
	                        <?php if(isset($_POST['choice1']) || isset($_POST['m1_choice1']))
	                        { ?>  checked   <?php } ?> />
	                                 Multiple Choice Questions
		</td>
	</tr>  
<!----------------------------------------------------/MCQS INTERFACE------------------------------------------------------->


<!------------------------------------------------MCQS FORMATE INTERFACE---------------------------------------------------->											 
<?php  
	if(isset($_POST['choice1'])  || isset($_POST['m1_choice1']))
	{
	?>
	<tr>
	<td colspan="2">
	                                                        <!--Formate Of MCQS Interface-->
	
	                      <table style="color:white;">                   
	             <tr>
				 <td>Allocate Marks :</td>
				 <td><input type="text" name="t_marks_mcq" placeholder="Total Marks"
                      value="<?php if(isset($t_marks_mcq)) { echo $t_marks_mcq; } ?>"	 /></td>
	             </tr>
				 <tr>
				 <td>Quantity :</td>
				 <td><input type="text" name="quan_mcq" placeholder="Quantity"
                      value="<?php if(isset($quan_mcq)) { echo $quan_mcq; } ?>"			 /></td>
	             </tr>
				 <tr>
				 <td>Marks Of Each :</td>
				 <td><input type="text" name="each_mcq" placeholder="Marks Of Each" 
				      value="<?php if(isset($each_mcq)) { echo $each_mcq; } ?>"           /></td>
	             </tr>
				 <tr>
				 
				               <td colspan="2" align="right" >
							   
							   <?php // check1 check mcqs total marks and display after send formate "Yes" OR "No" ?>
							   
				 <?php if (isset($check1))   { echo "<span style='color:white;'>".$check1."</span>"; }
                else   if (isset($error1))   { echo "<span style='color:white;'>".$error1."</span>"; }   ?>
				                 </td>
				 </tr>
	       </table>
	
	</td>
	</tr>
	<?php
	}
	?>
<!-------------------------------------------------------/MCQS FORMATE INTERFACE--------------------------------------------->




<!------------------------------------------------FILL IN BLANKS INTERFACE--------------------------------------------------->
	<tr>
	<td colspan="2">
	                   <input type="checkbox" <?php if(!isset($_POST['mix']) && !isset($_POST['submission']) && !isset($_POST['mix_send_formate']))  { ?> name="choice2" <?php } else { ?>
	name="m1_choice2" <?php } ?> value="Fill In Blanks" 
	                   <?php if(isset($_POST['choice2']) || isset($_POST['m1_choice2'])) 
	                     { ?>  checked   <?php  } ?>  />Fill In Blanks
	   </td>
	       </tr>
<!-----------------------------------------------/FILL IN BLANKS INTERFACE--------------------------------------------------->
	
	
<!------------------------------------------/FILL_IN_BLANKS FORMATE INTERFACE------------------------------------------------>	
	<?php  
 if(isset($_POST['choice2'])  || isset($_POST['m1_choice2']))

	{
	
	?>
	<tr>
	<td colspan="2">                                        <!--Formate Of Fill_In_Blanks Interface-->
	
	          
	        <table style="color:white;">
	             <tr>
				 <td>Allocate Marks :</td>
				 <td><input type="text" name="t_marks_fb" placeholder="Total Marks"
                      value="<?php if(isset($t_marks_fb)) { echo $t_marks_fb; } ?>"	 /></td>
	             </tr>
				 <tr>
				 <td>Quantity :</td>
				 <td><input type="text" name="quan_fb" placeholder="Quantity"
                      value="<?php if(isset($quan_fb)) { echo $quan_fb; } ?>"   /></td>
	             </tr>
				 <tr>
				 <td>Marks Of Each :</td>
				 <td><input type="text" name="each_fb" placeholder="Marks Of Each"
                      value="<?php if(isset($each_fb)) { echo $each_fb; } ?>" /></td>
	            <tr>
				               <td colspan="2" align="right" >
							   
							    <?php // check2 check mcqs total marks and display after send formate "Yes" OR "No" ?>
							
				 <?php if (isset($check2))   { echo "<span style='color:white;'>".$check2."</span>"; }
                 else  if (isset($error2))   { echo "<span style='color:white;'>".$error2."</span>"; }   ?>
				                 </td>
				 </tr>
	       </table>
		   
	</td>
	</tr>
	<?php
	}
	?>
<!---------------------------------------------/FILL_IN_BLANKS FORMATE INTERFACE--------------------------------------------->




<!--------------------------------------------------TRUE_FALSE INTERFACE----------------------------------------------------->
	<tr>
	<td colspan="2">
	                 <input type="checkbox" <?php if(!isset($_POST['mix']) && !isset($_POST['submission']) && !isset($_POST['mix_send_formate']))  { ?> name="choice3" <?php } else { ?>
	name="m1_choice3" <?php } ?> value="True False Statements" 
                  <?php if(isset($_POST['choice3'])  || isset($_POST['m1_choice3']))
					  { ?>  checked   <?php } ?>   	/>True False Statements
	  </td>
	      </tr>
	<?php  
	if(isset($_POST['choice3'])  || isset($_POST['m1_choice3']))
	{
	?>
	<tr>
	<td colspan="2">
	                  
<!--------------------------------------------------/TRUE_FALSE INTERFACE---------------------------------------------------->					  
													   
													   
<!--------------------------------------------------TRUE_FALSE FORMATE INTERFACE--------------------------------------------->													   
						  <table style="color:white;">                   
	             <tr>
				 <td>Allocate Marks :</td>
				 <td><input type="text" name="t_marks_tf" placeholder="Total Marks"
                      value="<?php if(isset($t_marks_tf)) { echo $t_marks_tf; } ?>"		 /></td>
	             </tr>
				 <tr>
				 <td>Quantity :</td>
				 <td><input type="text" name="quan_tf" placeholder="Quantity"
                       value="<?php if(isset($quan_tf)) { echo $quan_tf; } ?>"	  	    /></td>
	             </tr>
				 <tr>
				 <td>Marks Of Each :</td>
				 <td><input type="text" name="each_tf" placeholder="Marks Of Each"
                     value="<?php if(isset($each_tf)) { echo $each_tf; } ?>"		    /></td>
	             </tr>
				 <tr>
				               <td colspan="2" align="right" >
							   
							   <?php // check3 check mcqs total marks and display after send formate "Yes" OR "No" ?>
							   
				 <?php if (isset($check3))   { echo "<span style='color:white;'>".$check3."</span>"; }
                 else  if (isset($error3))   { echo "<span style='color:white;'>".$error3."</span>"; }   ?>
				               </td>
				 </tr>
				      </table>
<!--------------------------------------------------/TRUE_FALSE FORMATE INTERFACE--------------------------------------------->			 



	       
	</td>
	</tr>
	<?php
	}
	?>
								
		 
<!--------------------------------------------------BUTTON CONVERSION INTERFACE--------------------------------------->
		<?php //this button will remain untill any choice is set. and submit or send formate is set ?>
		<?php
		if (isset($_POST['submit_formate1']))
		{
						       
			$btn1_value="Send Formate";
			$btn1_name="send_formate1";
		}
?>
<!----------------------------------------------------/BUTTON CONVERSION INTERFACE------------------------------------------->


<!-------------------------------------------------------BUTTON INTERFACE---------------------------------------------------->
<?php if(!isset($_POST['mix']) && !isset($_POST['submission']) && !isset($_POST['mix_send_formate']))           //when mix set then submit button not displayed
	{	                                      // this below code of submit button and end of table and end of form  
	?>  

                              	<!--Submit button will be displayed on selecting objective only-->
			
	<tr>
	     <td colspan="2" align="right">
		 
		                        <input type="submit" name="<?php echo $btn1_name;   ?>"    
	                                  value="<?php echo $btn1_value;  ?>"                       <!--Button 1 -->
									                   
								  </td>
								  </tr>
					</form>                                         <!--END OF FORM MCQS-->
					
			<form method="post">		
				<tr>
	     <td colspan="2" align="left">
		                  
		                        <input type="submit" name="change_formate1"    
	                                  value="Change Formate"     />                  <!--Button 2 -->
									                   
						</td>
				</tr>
	     
<!-------------------------------------------------------/BUTTON INTERFACE--------------------------------------------------->
			   
	
	</form>     <?php // END OF FORM ?>
	<?php
	}                                            
	?>
	</table>    <?php // END OF TABLE ?>    
	
	
	<?php
}
	?>
<!--------------------OBJECTIVE----------------------FORMATE INTERFACE------------------------------------End--------------->
































<!-----------------------SUBJECTIVE-------------------PAPER FORMATE INTERFACE------------START------------------------------->
                                          
<?php
    if(isset($_POST['subjective']) || isset($_POST['mix_send_formate']) ||
	isset($_POST['mix']) || isset($_POST['submit_formate2']) ||
	isset($_POST['change_formate2']) || isset($_POST['send_formate2']) || isset($_POST['submit_formate3']) ||
	isset($_POST['submission']) ) 	
{ 
  ?>
<?php
	 if(!isset($_POST['mix']) && !isset($_POST['submission']) && !isset($_POST['mix_send_formate'])) 
	{
	?>
	<form method="post" align="center">
	<?php
	}
	?>
    <table align="center" style="color:white;">
	<tr>
	<td colspan="2" align="center"><h1>Subjective</h1></td>
	</tr>
	
	
<!------------------------------------------------------TOTAL MARKS INTERFACE------------------------------------------------>
	<tr>
	<td>Total Marks :</td>
	<td>
	
	
	<?php
	if(isset($_POST['total_marks2']))
	{
		$total_marks2=$_POST['total_marks2'];
	}
                     else 
						 if(isset($_POST['total_marks']))
	                {
	                   $total_marks=$_POST['total_marks'];
                       $_SESSION['total_marks']=$total_marks;					   
	                }
	?>
	
	
	<input type="text" placeholder="Enter Marks" <?php if(!isset($_POST['mix']) && !isset($_POST['submission']) && !isset($_POST['mix_send_formate']))  { ?> name="total_marks" <?php } else { ?>
	name="total_marks2" <?php } ?> 
	value="<?php if(isset($total_marks2)) { echo $total_marks2;  } else if(isset($total_marks)) { echo $total_marks;  } ?>" required />
	
	</td>
	
	       </tr>
			 
	<tr>                                  <!--EXTRA ROW TO DISPLAY MESSAGE "Yes" Or "No"-->
	<td colspan="2" align="right" >
	              
				 <?php 
				                    //check total marks and display check after send
									
				  if (isset($check))         { echo "<span style='color:white;'>".$check."</span>"; }
           else   if (isset($error))         { echo "<span style='color:white;'>".$error."</span>"; } 
                 
				 ?>
		</td>
				 </tr>
				 
    
				 
	
<!-------------------------------------------------/TOTAL MARKS INTERFACE---------------------------------------------------->
















				 
				  
<!----------------------------------------------SHORT QUESTIONS INTERFACE---------------------------------------------------->
				  
	<tr> 
	     <td colspan="2">
	                        <input type="checkbox" <?php if(!isset($_POST['mix']) && !isset($_POST['submission']) && !isset($_POST['mix_send_formate']))  { ?> name="choice1" <?php } else { ?>
	name="m2_choice1" <?php } ?> value="Short Questions" 
	                        <?php if(isset($_POST['choice1']) || isset($_POST['m2_choice1']))
	                        { ?>  checked   <?php } ?> />
	                                 Short Questions
		</td>
	</tr>  
	
<!------------------------------------------------/SHORT QUESTIONS INTERFACE------------------------------------------------>




















<!---------------------------------------------SHORT QUESTIONS FORMATE INTERFACE-------------------------------------------->											 
<?php  
	if(isset($_POST['choice1']) || isset($_POST['m2_choice1']))
	{
	?>
	

	
	<tr>
	<td>Total Marks:</td>
	<td colspan="2"><input type="text" name="t_marks_sq" placeholder="Total Marks"
    value="<?php if(isset($t_marks_sq)) { echo $t_marks_sq; } ?>"	/></td>
	</tr>
	
	
	<tr>
	<td>Quantity:</td>	
	<td colspan="2"><input type="text" name="quan_sq" placeholder="Quantity"
    value="<?php if(isset($quan_sq)) { echo $quan_sq; } ?>"	/></td>
	
	</tr>
	<tr>                                  <!--EXTRA ROW TO DISPLAY MESSAGE "Yes" Or "No"-->
	<td colspan="2" align="right" >
	              
				 <?php 
				                    //check total marks and display check after send
									
				  if (isset($check))         { echo "<span style='color:white;'>".$check."</span>"; }
           else  if (isset($error))         { echo "<span style='color:white;'>".$error."</span>"; } 
                 
				 ?>
		</td>
				 </tr>
	
	<?php
	}
	?>
	
	
	
<!----------------------------------------------/SHORT QUESTIONS FORMATE INTERFACE------------------------------------------>
























<!------------------------------------------------LONG QUESTIONS INTERFACE--------------------------------------------------->
	<tr>
	<td colspan="2">
	                   <input type="checkbox" <?php if(!isset($_POST['mix']) && !isset($_POST['submission']) && !isset($_POST['mix_send_formate']))  { ?> name="choice2" <?php } else { ?>
	name="m2_choice2" <?php } ?> value="Long Questions" 
	                   <?php if(isset($_POST['choice2']) || isset($_POST['m2_choice2'])) 
	                     { ?>  checked   <?php  } ?>  />Long Questions
	   </td>
	       </tr>
<!-----------------------------------------------/LONG QUESTIONS INTERFACE--------------------------------------------------->
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
<!-------------------------------------------LONG QUESTIONS FORMATE INTERFACE------------------------------------------------>	
	<?php  
 if(isset($_POST['choice2']) || isset($_POST['m2_choice2']))

	{	
	?>
	<tr>
	<td>Total Marks:</td>
	
	<td><input type="text" name="t_marks_lq" placeholder="Total Marks"
    value="<?php if(isset($t_marks_lq)) { echo $t_marks_lq; } ?>"	/></td>
	
	</tr>
	<tr>
	<td>Quantity:</td>
	<td><input type="text" name="quan_lq" placeholder="Quantity"
    value="<?php if(isset($quan_lq)) { echo $quan_lq; } ?>"	/></td>
	
	</tr>
	<tr>                                  <!--EXTRA ROW TO DISPLAY MESSAGE "Yes" Or "No"-->
	<td colspan="2" align="right" >
	              
				 <?php 
				                    //check total marks and display check after send
									
				  if (isset($check))         { echo "<span style='color:white;'>".$check."</span>"; }
           else  if (isset($error))         { echo "<span style='color:white;'>".$error."</span>"; } 
                 
				 ?>
		</td>
				 </tr>
	
	<?php
	}
	?>
	
	
<!---------------------------------------------/LONG QUESTIONS FORMATE INTERFACE-------------------------------------------->




	
                              	<!--Submit button will be displayed on selecting objective only-->
								
		 
<!--------------------------------------------------BUTTON CONVERSION INTERFACE--------------------------------------->
		<?php //this button will remain untill any choice is set. and submit or send formate is set ?>
		<?php
		
		

		if (isset($_POST['submit_formate2']))
		{
						       
			$btn2_value="Send Formate";
			$btn2_name="send_formate2";
		}
?>
<!----------------------------------------------------/BUTTON CONVERSION INTERFACE------------------------------------------->


<!-------------------------------------------------------BUTTON INTERFACE---------------------------------------------------->		
	
	<?php if(!isset($_POST['mix']) && !isset($_POST['submission'])&& !isset($_POST['mix_send_formate']))            //when mix set then submit button not displayed
	{	                                      // this below code of submit button and end of table and end of form  
	?>  

	
	<tr>
	     <td colspan="2" align="right">
		                        <input type="submit" name="<?php echo $btn2_name;   ?>"    
	                                  value="<?php echo $btn2_value;  ?>"                       <!--Button 1 -->
									                   
								  </td>
								  </tr>
					</form>                                         <!--END OF FORM MCQS-->
					
			<form method="post">		
				<tr>
	     <td colspan="2" align="left">
		                  
		                        <input type="submit" name="change_formate2"    
	                                  value="Change Formate"     />                  <!--Button 2 -->
									                   
						</td>
				</tr>
	     
<!-------------------------------------------------------/BUTTON INTERFACE--------------------------------------------------->
			   
	</table>    <?php // END OF TABLE ?>
	</form>     <?php // END OF FORM ?>
	<?php
	}                                            
	?>
	</table>
	
	
	<?php
}
	?>
<?php
   
if (isset($_POST['submission']))
		{
						       
			$b_value1="Send Formate";
			$b_name1="mix_send_formate";
			
		}


if(isset($_POST['mix']) || isset($_POST['submission']) || isset($_POST['mix_send_formate']))
{
	
	?>
	<table align="center" border="2">
	<tr>
	     <td colspan="2" align="right">
		                        <input type="submit" name="<?php echo $b_name1; ?>"    
	                                  value="<?php echo  $b_value1;  ?>"                       <!--Button 1 -->
									                   
								  </td>
								 
					</form>                                         <!--END OF FORM MCQS-->
					
			<form method="post">		
			
	     <td colspan="2" align="left">
		                  
		                        <br><input type="submit" name="mix_change_formate"    
	                                  value="Change Formate"     />                  <!--Button 2 -->
									                   
						</td>
				</tr>
	 </table>
	 </form>
	                     
	<?php
	
}
if(isset($_POST['submission']))
{
	
	print_r($_POST);
}

?>
<!--------------------OBJECTIVE----------------------FORMATE INTERFACE------------------------------------End--------------->




<?php
	
	//<!-----------------------------------------------------Formate of Subjective------------------------------------------->
	if(isset($_POST['sub_submit']))
	{
		
		
		
//<!------------------------------1------------------------------>
	if(isset($_POST['choose1']) && !isset($_POST['choose2']))
	{
		echo "<h1>".$_POST['choose1']."</h1>";
	} 
//<!----------------------1 END------------------------------------>	
	
	
	
//<!---------------------------2--------------------------------->
	else if(isset($_POST['choose2']) && !isset($_POST['choose1']))
	{
		echo "<h1>".$_POST['choose2']."</h1>";
	}
//<!--------------------2 END-------------------------------------->



//<!------------------------1,2------------------------------------->
	else if(isset($_POST['choose1']) && isset($_POST['choose2']))
	{
		echo "<h1>".$_POST['choose1']."</h1><br>";
		echo "<h1>".$_POST['choose2']."</h1><br>";
	}
//<!----------------------1,2 END------------------------------------>




//<!---------------------NO SELECTION---------------------------------->
	else if(!isset($_POST['choose1']) && !isset($_POST['choose2']))
	{
		echo "<h1>ERROR ! You Have Not Selected Any Option.</h1>";
	}
//<!--------------------NO SELECTION END-------------------------------->
}



//<!-----------------------------------------Formate of Subjective End-------------------------------------------------------->
?>



















<!-------------------------------------------------------------------------------------------------------------------------->
                           				 <!--Result Of insertion Check-->
<?php
if(isset($check_insert))
{
echo "<h1>".$check_insert."</h1>";
}
?>    
                                           <!--Result Of updation Check-->
<?php
if(isset($check_update))
{
echo "<h1>".$check_update."</h1>";
}
?>   
                                             <!--Result Of Deletion Check-->
<?php
if(isset($check_delete))
{
echo "<h1>".$check_delete."</h1>";
}
?>
<!--------------------------------------------------------------------------------------------------------------------------->













<!---------------------------------------------------Section 3--------------------------------------------------------------->
                                           
										   <!--Display Of 'User' Table Of Database-->                                   

	                                            
<!---------------------------------------------------Section 3 End----------------------------------------------------------->




									 
									 