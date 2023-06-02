

<?php
/*
if(isset($_REQUEST['printer']))
{
	$print="Ready For Print";
	//header ("Location:onlyprint.php");
}
if(!isset($print))
{
?>
<a href="courses.php" >Create New Paper</a>
<a href="single_obj_sub_print.php?printer=set">Print Paper</a>
<?php
}
*/
session_start();
if(isset($_SESSION['mix_paper']))
{
	$mix="Mix Paper Has Set.";
	$mix_paper="Set";
}
?>




















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
//_____________________________________Header To Targeted Page For Editing_____________________________________________

//unset($_SESSION['set_btn1']);
//unset($_SESSION['ready_edit_mode']);
//unset($_SESSION['section_back2']);
if(isset($_REQUEST['edit_obj_ans']))
{
	$_SESSION['ready_edit_mode']="Set";
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
//$_SESSION['set_btn1']="Button Has Set In Objective Mix Paper";
$_SESSION['ready_edit_mode']="Set";
$_SESSION['section_back2']="Set";
	header ("Location:obj_question_paper.php");	
}
//_____________________________________/Header To Targeted Page For Editing_____________________________________________
?>





















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





























<?php
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

<span class="print_btn2">
<br><br>
<table border="2" align="center" style="font-size:20px;">
<tr>
<td><a href="single_obj_sub_print.php?edit_obj_q=edit">Edit Objective Questions</a></td>
<td><a href="single_obj_sub_print.php?edit_obj_ans=edit">Edit Objective Answers</a></td>
<?php if(isset($_SESSION['short_questions'])) { ?>
<td><a href="single_obj_sub_print.php?edit_sq=edit">Edit Short Questions</a></td>
<?php } ?>
<?php if(isset($_SESSION['long_questions'])) { ?>
<td><a href="single_obj_sub_print.php?edit_lq=edit">Edit Long Questions</a></td>
<?php } ?>
</tr>
</table>
</span>

<?php //  } // __________________________/Editing Code______________________________________________>  ?>
