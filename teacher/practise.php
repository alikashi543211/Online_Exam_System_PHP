<?php


session_start();
include "connection.php";
$q_paper_id=$_SESSION['q_paper_id'];










?>
<!-- ___________________________Print Webpage Code ___________________________ -->
<?php

if(isset($_POST['submit']))
{
	
}

?>

<!-- ___________________________Print Webpage Code ___________________________ -->
<html>
<head>
<style>
a {
	text-decoration:none;
	}
</style>
<title>
Question Paper
</title>
</head>




<?php  
//(((((((((((((((((((((((((((((((((((((((((((---------------Header-----------------)))))))))))))))))))))))))))))))))))))))
include "header.php";
?>
<?php //_____________________________________Header_______________>   ?>
<table>

     <tr style="text-align:center;font-weight:bold;">	 
        <td style="width:1000px;font-size:30px;">
    
          Section-I

      </td>
	  </tr>
	  <tr>
	  <?php
	  if(isset($_SESSION['t_marks_mcq']))
	  { 
	  ?>
	  <td align="right" style='font-weight:bold;'><?php  echo "Objective Marks = (".$_SESSION['quan_mcq']."*".$_SESSION['each_mcq']."=".$_SESSION['t_marks_mcq'].")" ?></td>
	  <?php
	  }
	  ?>
	  <?php
	  if(isset($_SESSION['t_marks_fb']))
	  { 
	  ?>
	  <td align="right" style='font-weight:bold;'><?php  echo "Objective Marks = (".$_SESSION['quan_fb']."*".$_SESSION['each_fb']."=".$_SESSION['t_marks_fb'].")" ?></td>
	  <?php
	  }
	  ?>
	  <?php
	  if(isset($_SESSION['t_marks_tf']))
	  { 
	  ?>
	  <td align="right" style='font-weight:bold;'><?php  echo "Objective Marks = (".$_SESSION['quan_tf']."*".$_SESSION['each_tf']."=".$_SESSION['t_marks_tf'].")" ?></td>
	  <?php
	  }
	  ?>
	</tr>
	</table>	
<?php //(((((((((((((((((((((((((((((((((((((((((-------------/Header---------------))))))))))))))))))))))))))))))))))))) ?>















<?php //((((((((((((((((((((((((((((((((<---------------Display of Paper----------------->))))))))))))))))))))))))))) ?>

<table style="width:1000px;height:100px;font-size:20px;" >
<tr>


<?php
//______________________Header Question_____________________________-->

if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='Fill in Blanks')          //in case of fill in blanks
{
	?>
<td colspan="2"><h3 style="text-align:left;color:purple;">Fill in Blanks</h3></td>   <?php //display header ?>
<?php
}
?>
<?php
if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='True False')              //in case of true false
{
	?>
<td colspan="2"><h3 style="text-align:left;color:purple;">True False</h3></td>  <?php //display header ?>
<?php
}
?>

<?php
if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='MCQs')                     // in case of MCQs 
{
	?>
<td colspan="2"><h3 style="text-align:left;color:purple;">MCQs</h3></td>    <?php //display header ?>
<?php
}

//_______________________/Header Question___________________________-->

?>

</tr>
























<?php
//-------------------------------Query For Display Of Paper-------------------------------->


//_________________MCQs______________________-->
if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='MCQs')
{
$query_a="SELECT q.q_paper_id, q.question_id, q.question, a.question_id,a.ans_id, a.option_name,a.ans,
 a.correct_ans, a.status FROM question q, answers a WHERE q.question_id=a.question_id && q.q_paper_id='$q_paper_id' ";
 unset($_SESSION['no_option']);
}
//________________/MCQs_________________________-->





//________________________Fill in Blanks______________________-->
else if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='Fill in Blanks')
{
$query_a="SELECT q.q_paper_id, q.question_id, q.question, a.question_id,a.ans_id, a.option_name,a.ans,
 a.correct_ans, a.status FROM fb_questions q, fb_answers a WHERE q.question_id=a.question_id && q.q_paper_id='$q_paper_id' ";
 $_SESSION['no_option']="no";
}
//_____________________/Fill in Blanks_________________________-->





//________________________True False_______________________-->
else if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='True False')
{
$query_a="SELECT q.q_paper_id, q.question_id, q.question, a.question_id,a.ans_id, a.option_name,a.ans,
 a.correct_ans, a.status FROM tf_questions q, tf_answers a WHERE q.question_id=a.question_id && q.q_paper_id='$q_paper_id' ";
 unset($_SESSION['no_option']);
}
//_________________________/True False_______________________-->


$result_a=mysqli_query($con,$query_a);

$question_number=1;



//-------------------------------/Query For Display Paper---------------------------------------->























?>
<?php
$question="a";                          //Default value store...
$counter=1;                             //Counter Variable......







//___________/Questions and Answers Fetching______________-->

while($row_a=mysqli_fetch_array($result_a))
{ 
	
	?>
	<?php 
	 
	 if($question!=$row_a['question'])  
	 {
	                                                       //  question and display only options
														   // if question not match then we display question and then options
	
      if($counter!=1)		
	  {
	?>
		  <?php
		  if(!isset($_SESSION['no_option']))                 //if [no_option] session is not set this means objective_type
                                                             // is MCQs OR True False. So Code will be displayed.
                                                             //If [no_option] session is set this means objective_type
	    {                                                    //is Fill in Blanks. 															 
		?>
	
		          </tr>                                        <?php //end of new row ,-->row cancelling of new table for options ?>
		          </table>                                   <?php // end of new table ,-->Table cancelling which is made in td?>
		          </td>                                   <?php // end of second previous coloumn,-->This coloumn contains new table ?>
		          </tr>                                <?php // end of second previous row ,-->This row contains new table ?>
		<?php
		}
		?>
				  
		  <?php
	  }
    ?>
	
	
	
	
	
	
	
	
	
	<?php
//___________________Questions Fetching______________________--> ?>

	     <tr style="font-weight:normal;">                       <?php // first row will display question. ?>
	     <td style="font-size:18px;height:30px;"><?php echo "<span style='font-weight:bold;'>(".$question_number++.")&nbsp;</span>"; ?></td>
		 <td style="font-size:18px;height:30px;font-weight:bold;"><?php echo $row_a['question']; ?></td>
	     </tr>
	   <?php
	   
//___________________/Questions Fetching_________________________--> 







		  if(!isset($_SESSION['no_option']))
		  {
		  ?>
	    <tr>		                                         <?php //second previous row will display new table of options ?>
		<td></td>                              
	    <td>
			

	    <table style="width:1000px;font-size:20px;height:40px;">        <?php //new table in second row of previous table ?>
	    <tr>
			   <?php
		  }
			   ?>
		
			   
	
	<?php
	$question=$row_a['question'];
	$counter=$counter+1;
	 }
	?>
	<?php
	
	
	
	
	
	
	
//______________________Options Fetching______________________--> 

	if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']!='Fill in Blanks')
	    {
		?>
	<td><?php echo "(".$row_a['option_name'].")"; ?></td>     <?php // question display from database.. ?>
	<td style="width:600px;font-size:18px;height:30px;"><?php echo $row_a['ans']; ?></td>   <?php // answers display from database.. ?>
	<?php
		}
		
//_______________________/Options Fetching_____________________--> 
		?>
		
		
		
		
		
	<?php
}
?>

<?php  
if(!isset($_SESSION['no_option']))                      // This code with in brackets is not for fill in blanks.
{                                                       // This code with in brackets is for MCQs or True False.
?>
            </tr>        
		    </table>
		    </td>
			   <?php
			   
    }
?>
		          </tr>      <?php // end of second ROW in previous table ?>
				  <tr>
<?php // Links to edit questions ?> <td border="5" colspan="2" align="right"><a href="obj_question_paper.php">Edit Questions</a>
				  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php // Links to edit answers ?>	<a href="obj_answer_sheet.php">Edit Answers</a>
										   </td>
				  </tr>
</table>	
<form method="post" align="center">
<input type = "submit" name="submit" value="Print Webpage" />
</form>
</body>
</html>

<?php //__________________/Questions and Answers Fetching______________--> ?>





<?php //((((((((((((((((((((((((((((((((<---------------Display of Paper----------------->))))))))))))))))))))))))))) ?>










