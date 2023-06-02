










<?php if(!isset($mix_paper)) { ?>
<!---------------------------------------------- JAVA SCRIPT ----------------------------------------------------------->
<head>

<script src="javascript.js"></script>
<script>
$(document).ready(function(){
    $(".print_btn").click(function(){
       $(".print_btn").hide();
	   $(".print_btn2").hide();
	   window.print();
	   
    });
});
//function myFunction() {
    
//}

</script>
</head>
<!---------------------------------------------- /JAVA SCRIPT ----------------------------------------------------------->
<?php
 }  // WHEN MIX PAPER IS NOT SET THEN THIS CODE WOULD BE RUN...
?>











<?php

if(!isset($_SESSION['mix_paper']))
{
session_start();
}
if(isset($_POST['preview']))
{
	$refresh="Preview Has Set";
}

// ______________________________________ Save As Word ___________________________________________________
?>



















<?php
    // _________________________  Create New Paper And Print Paper ____________________________________________ ?>
	
<?php
/*
 if(isset($_REQUEST['printer']) && !isset($mix))
	
{
	$print="Print Mode Has Been Set.";
	$_SESSION['save_as_word']="set";
}
?>

<?php
?>
*/
?>
<?php
/*
if(!isset($print) && !isset($mix) && !isset($not_any_more))
{ 
?>

<a href="courses.php">Create New Paper</a> ||
<a href="print_objective_paper.php?printer=set">Print Paper</a>
<?php
}
*/
// _________________________  /Create New Paper And Print Paper ____________________________________________












?>




























































<?php
/*
if(isset($_SESSION['save_as_word']))
{
	header ("Content-type: application/vnd.pdf");
	$file_name="True False Paper";
    header ("Content-Disposition: attachment; filename=".$file_name.".pdf");
*/	

unset($_SESSION['save_as_word']);

// ______________________________________ /Save As Word ___________________________________________________
//echo "<h1 style='color:red;'>Kashif ali</h1>";





include "connection.php";
$q_paper_id=$_SESSION['q_paper_id'];
$q_p_formate_id=$_SESSION['q_p_formate_id'];
if (isset($_SESSION['mix_paper']))
{
	$mix=$_SESSION['mix_paper'];
}
?>
























<?php // ___________________________________ Edit Questions And Answers __________________________________________ ?>

<?php
if(!isset($not_any_more)) {
unset($_SESSION['answers_set']);
unset($_SESSION['edit_paper']);
if(isset($_REQUEST['edit1']))
{
	$_SESSION['edit_paper']="Questions Are Ready For Edit.";
	header ("Location:obj_question_paper.php");
}
else if(isset($_REQUEST['edit2']))
{
	$_SESSION['edit_paper']="Answers Are Ready For Edit.";
	header ("Location:obj_answer_sheet.php");
}
?>

<?php } // ________________________________________ /Edit Questions And Answer  _________________________________________ ?>






















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

<body>
<?php if(!isset($mix_paper)) { ?>
<span class="print_btn2">
<?php // ----------------------------------------- Sign Out Button ----------------------------------------------------- ?>
<form style="float:right;" action="../index.php" method="post">
<input style="height:50px;width:100px;background-color:navy;color:white;cursor:pointer;" type="submit" class="testbutton" name="sign_out" value="Sign Out" />
</form>&nbsp;&nbsp;&nbsp;
<?php // ----------------------------------------- /Sign Out Button ----------------------------------------------------- ?>





<?php // ----------------------------------------- Create New Paper Button ----------------------------------------------------- ?>
<form style="float:right;" action="courses.php" method="post">
<input style="height:50px;width:200px;background-color:navy;color:white;cursor:pointer;" type="submit" class="testbutton" name="sign_out" value="Create New Paper" />
</form>
<?php // ----------------------------------------- /Create New Paper Button ----------------------------------------------------- ?>

</span>
</body>













<!----------------------------------------------------- Print Button ------------------------------------------------------>
<span class="print_btn">
<form style="float:left;" method="post"  >
<!--<input style="cursor:pointer;width:100px;height:50px;color:black;border-radius:4px;" type = "submit" name="preview" value="Save As Pdf" />-->
<input onclick="myFunction()" style="height:50px;width:100px;background-color:navy;color:white;cursor:pointer;" type = "submit" name="print" value="Print Paper" /> 
</form>

<?php//  if(!isset($refresh)) { ?>

</span>
<?php
 //}
?>
<!----------------------------------------------------- /Print Button ------------------------------------------------------>

<?php } // WHEN MIX PAPER NOT SET....... ?>





















<?php  
//(((((((((((((((((((((((((((((((((((((((((((---------------Header-----------------)))))))))))))))))))))))))))))))))))))))

include_once "header.php";

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
	  <td align="right" style='font-weight:bold;'><?php  echo "Objective Marks  (".$_SESSION['quan_mcq']."*".$_SESSION['each_mcq']."=".$_SESSION['t_marks_mcq'].")" ?></td>
	  <?php
	  }
	  ?>
	  <?php
	  if(isset($_SESSION['t_marks_fb']))
	  { 
	  ?>
	  <td align="right" style='font-weight:bold;'><?php  echo "Objective Marks  (".$_SESSION['quan_fb']."*".$_SESSION['each_fb']."=".$_SESSION['t_marks_fb'].")" ?></td>
	  <?php
	  }
	  ?>
	  <?php
	  if(isset($_SESSION['t_marks_tf']))
	  { 
	  ?>
	  <td align="right" style='font-weight:bold;'><?php  echo "Objective Marks  (".$_SESSION['quan_tf']."*".$_SESSION['each_tf']."=".$_SESSION['t_marks_tf'].")" ?></td>
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
	     <td style="font-size:18px;height:30px;width:10px;"><?php echo "<span style='font-weight:bold;'>(".$question_number++.")&nbsp;</span>"; ?></td>
		 <?php if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='Fill in Blanks') { ?>
		 <td style="font-size:18px;height:30px;"><?php echo $row_a['question']; ?></td>
		 <?php
		 }
		 else{
			 ?>
			 <td style="font-size:18px;height:30px;font-weight:bold;"><?php echo $row_a['question']; ?></td>
			 <?php
		 }
		 ?>
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
				  <?php if(!isset($print) && !isset($mix)){ ?>
				  <tr>
<?php if (!isset($mix) && !isset($not_any_more)) { // Links to edit questions ?> <td border="5" colspan="2" align="right" class="print_btn2"><a href="print_objective_paper.php?edit1=ques">Edit Questions</a>
				  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php // Links to edit answers ?>	<a href="print_objective_paper.php?edit2=ans">Edit Answers</a>
                                    <!--<a href="courses.php">Create New Paper</a>-->
										   </td> 
										   <?php
                        }//When Set For Print This Code Would Not Work 
}
										   ?>
				  </tr>
</table>	
</body>
</html>

<?php //__________________/Questions and Answers Fetching______________--> ?>





<?php //((((((((((((((((((((((((((((((((<---------------Display of Paper----------------->))))))))))))))))))))))))))) ?>










