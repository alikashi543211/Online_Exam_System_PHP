<?php

if(!isset($_SESSION['mix_paper']))
{
session_start();
}

?>



<?php if(!isset($constant)) { ?>
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
<?php } ?>









<?php /*
// ______________________________________ Save As  ___________________________________________________
if(isset($_POST['preview']) || isset($_POST['print']))
{
	$refresh="Preview Has Set";
}
// ______________________________________ /Save As  ___________________________________________________
*/ ?>




















<?php
/*
if(isset($_REQUEST['printer']))
{
	$print="Your Paper Is Set For Print.";
}
*/
?>


<?php
/*
if(isset($_POST['print_paper']))
{
	header ("Content-type: application/vnd.ms-word");
	$file_name="Objective Paper";
    header ("Content-Disposition: attachment; filename=".$file_name.".doc");
	include_once "comb_1_obj_print_paper.php";
}
*/
?>

<?php

?>


<?php  /* if(!isset($print)) { ?>
<a href="courses.php">Create_new_paper</a> || 
<a href="comb_1_obj_print_paper.php?printer=set">Print Paper</a>
<?php } */ ?>















<?php
include "connection.php";
if(isset($_SESSION['mix_paper']))
{
$mix2=$_SESSION['mix_paper'];
}
$q_paper_id=$_SESSION['q_paper_id'];

unset($_SESSION['mcq_ready']);
unset($_SESSION['tf_ready']);
unset($_SESSION['fb_ready']);


unset($_SESSION['edit_answers']);




$a=1;


if(isset($_REQUEST['edit_ans']))
{
      $_SESSION['edit_answers']="You Are Ready To Edit Answers";
	  header ("Location:combination_1_answer_sheet.php");
	
}






?>
<html>
<head>
<style>
a 
   {
	text-decoration:none;
	}
</style>
<title>
Question Paper
</title>
</head>



















<body>
<?php if(!isset($constant)) { ?>
<span class="print_btn2">
<?php// if(!isset($refresh)) { ?>
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

<?php// } ?>
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
 }
?>
<!----------------------------------------------------- /Print Button ------------------------------------------------------>


















<?php  
//(((((((((((((((((((((((((((((((((((((((((((---------------Header-----------------)))))))))))))))))))))))))))))))))))))))
include "header.php";
?>
<body style="background-color:white;">
<br>
<?php
for($mix=1;$mix<=2;$mix++)
    {     //START OF LOOP  1 FOR MCQS AND 2 FOR FOR FILL IN BLANKS.
?>

<?php
    if($mix==1)
    {
	    ?>
		<table>

     <tr style="text-align:center;font-weight:bold;">	 
        <td style="width:1000px;font-size:30px;">
  
          Section-I
     
      </td>
	  </tr>
	  <?php if(isset($mix2)) { ?>
	  <tr>
	  <td align="right" style='font-weight:bold;'><?php  echo "Objective Marks (".$_SESSION['t_marks_mcq']."+".$_SESSION['t_marks_fb']."=".$_SESSION['total_marks1'].")" ?></td>
    </tr>
	  <?php } else { ?>
	  <tr>
	  <td align="right" style='font-weight:bold;'><?php  echo "Objective Marks (".$_SESSION['t_marks_mcq']."+".$_SESSION['t_marks_fb']."=".$_SESSION['total_marks'].")" ?></td>
    </tr>
	  <?php } ?>
	</table>
	<?php
	}
?>
	<table>
	<tr style="font-weight:bold;">


<?php
//______________________Header Question_____________________________-->
?>

<?php
if($mix==1)                     // in case of MCQs 
{
	?>
<td style="width:1000px;font-size:20px;"><h3 style="text-align:left;color:purple;">MCQs</h3></td>    <?php //display header ?>
<td style="text-align:right;font-weight:bold;"><?php echo "(".$_SESSION['quan_mcq']."*".$_SESSION['each_mcq']."=".$_SESSION['t_marks_mcq'].")"; ?></td>
<?php
}
?>

<?php
if($mix==2)          //in case of fill in blanks
{
	?>
<td style="width:1000px;font-size:20px;"><h3 style="text-align:left;color:purple;">Fill in Blanks</h3></td>        <?php //display header ?>
<td style="text-align:right;font-weight:bold;"><?php echo "(".$_SESSION['quan_fb']."*".$_SESSION['each_fb']."=".$_SESSION['t_marks_fb'].")"; ?></td>

       
<?php
}
?>



<?php
//_______________________/Header Question___________________________-->

?>

</tr>

</table>

<?php //(((((((((((((((((((((((((((((((((((((((((-------------/Header---------------))))))))))))))))))))))))))))))))))))) ?>















<?php //((((((((((((((((((((((((((((((((<---------------Display of Paper----------------->))))))))))))))))))))))))))) ?>



<?php
//-------------------------------Query For Display Of Paper-------------------------------->


//_________________MCQs______________________-->
if($mix==1)
{
$query_a="SELECT q.q_paper_id, q.question_id, q.question, a.question_id,a.ans_id, a.option_name,a.ans,
 a.correct_ans, a.status FROM question q, answers a WHERE q.question_id=a.question_id && q.q_paper_id='$q_paper_id' ";
 unset($_SESSION['no_option']);
}
//________________/MCQs_________________________-->





//________________________Fill in Blanks______________________-->
else if($mix==2)
{
$query_a="SELECT q.q_paper_id, q.question_id, q.question, a.question_id,a.ans_id, a.option_name,a.ans,
 a.correct_ans, a.status FROM fb_questions q, fb_answers a WHERE q.question_id=a.question_id && q.q_paper_id='$q_paper_id' ";
 $_SESSION['no_option']="no";
}
//_____________________/Fill in Blanks_________________________-->








$result_a=mysqli_query($con,$query_a);

$question_number=1;



//-------------------------------/Query For Display Paper---------------------------------------->























?>
<?php
$question="a";                          //Default value store...
$counter=1;                             //Counter Variable......






?>
<table style="width:1100px;height:100px;font-size:20px;" >
<?php
//___________/Questions and Answers Fetching______________-->

while($row_a=mysqli_fetch_array($result_a))
{ 
	?>
	
	<?php 
	
	if($question!=$row_a['question'])                      // If question is same in next row then we will not display
	                                                       //  question and display only options
														   // if question not match then we display question and then options
	{
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

	     <tr>                       <?php // first row will display question. ?>
	     <td style="width:30px;text-align:center;"><?php echo "<span style='font-weight:bold;'>(".$question_number++.")&nbsp;</span>"; ?></td>
		 <?php if(isset($mix) && $mix==1) { ?>
		 <td colspan="2" style="font-size:18px;height:50px;font-weight:bold;"><?php echo $row_a['question']; ?></td>
	     <?php } else { ?>
		 <td colspan="2" style="font-size:18px;height:50px;"><?php echo $row_a['question']; ?></td>
		 <?php } ?>
		 </tr>
	   <?php
	   
//___________________/Questions Fetching_________________________--> 







		  if(!isset($_SESSION['no_option']))
		  {
		  ?>
	    <tr>		                                         <?php //second previous row will display new table of options ?>
		<td></td>                              
	    <td>
			

	    <table style="width:1000px;font-size:18px;height:40px;">        <?php //new table in second row of previous table ?>
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

	if($mix!=2)
	    {
		?>
	<td><?php echo "(".$row_a['option_name'].")"; ?></td>     <?php // question display from database.. ?>
	<td style="width:600px;"><?php echo $row_a['ans']; ?></td>   <?php // answers display from database.. ?>
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
			  
   
    

		          </tr>      <?php // end of second ROW in previous table ?>
<?php
}
?>			  
				  </table>
				  <?php
				  if($mix==2)
				  {
				  ?>
				  <table style="width:1100px;height:100px;font-size:20px;" >
				  <?php if(!isset($print)  && !isset($mix2)){ ?>
				  <tr>
                                   <td border="5" colspan="2" align="right" class="print_btn2">
		                                          <a href="combination_1.php">Edit Questions</a>
				  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	                                               <a href="comb_1_obj_print_paper.php?edit_ans=<?php echo $a; ?>">Edit Answers</a>
								     </td> 
                   </tr>
				  <?php } ?>
           </table>	
<?php
				  }

				  ?>
				  <?php
	} //END OF MIX PAPER LOOP
	?>
				  
				















				
				  <?php /* if(!isset($refresh)) { ?>
<form align="center" method="post" >



<input style="cursor:pointer;width:100px;height:50px;color:black;border-radius:4px;" type = "submit" name="preview" value="Print Preview" />
 <input style="cursor:pointer;width:100px;height:50px;color:black;border-radius:4px;" type = "submit" name="print" value="Print Paper" />



</form>
<?php
 }
*/ ?>
				  
	  
</body>
</html>

<?php //__________________/Questions and Answers Fetching______________--> ?>





<?php //((((((((((((((((((((((((((((((((<---------------/Display of Paper----------------->))))))))))))))))))))))))))) ?>










