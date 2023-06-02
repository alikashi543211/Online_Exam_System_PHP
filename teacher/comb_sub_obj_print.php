
<a href="courses.php" >Create New Paper</a>
<?php
session_start();
if(isset($_SESSION['mix_paper']))
{
	$mix="Mix Paper Has Set.";
}



































//_____________________________________Header To Targeted Page For Editing_____________________________________________

unset($_SESSION['set_btn1']);
if(isset($_REQUEST['edit_obj_ans']))
{
	$_SESSION['set_btn1']="Button Has Set In Objective Mix Paper";
	header ("Location:obj_answer_sheet.php");
}
else if(isset($_REQUEST['edit_sq']))
{
$_SESSION['set_btn1']="Button Has Set In Objective Mix Paper";
	header ("Location:short_q_paper.php");	
}
else if(isset($_REQUEST['edit_lq']))
{
$_SESSION['set_btn1']="Button Has Set In Objective Mix Paper";
	header ("Location:long_q_paper.php");	
}
else if(isset($_REQUEST['edit_obj_q']))
{
$_SESSION['set_btn1']="Button Has Set In Objective Mix Paper";
	header ("Location:obj_question_paper.php");	
}

//_____________________________________/Header To Targeted Page For Editing_____________________________________________






















// __________________________Objective Paper Display Code______________________________________________>

include_once "print_objective_paper.php";

// __________________________/Objective Paper Display Code______________________________________________>











































// __________________________Subjective Paper Display Code______________________________________________>
include_once "subjective_header.php";
$_SESSION['done']="Successfully Created.";
if(isset($_SESSION['short_questions']))
{
    include_once "display_short_only.php";
}
 if(isset($_SESSION['long_questions']))
{
	include_once "display_long_only.php";
}
// __________________________ /Subjective Paper Display Code______________________________________________>
?>















<?php // __________________________Editing Code______________________________________________>  ?>

<table border="5" align="center">
<tr>
<td><a href="comb_sub_obj_print.php?edit_obj_q=edit">Edit Objective Questions</a></td>
<td><a href="comb_sub_obj_print.php?edit_sq=edit">Edit Short Questions</a></td>
<td><a href="comb_sub_obj_print.php?edit_lq=edit">Edit Long Questions</a></td>
<td><a href="comb_sub_obj_print.php?edit_obj_ans=edit">Edit Objective Answers</a></td>
</tr>
</table>

<?php // __________________________/Editing Code______________________________________________>  ?>
