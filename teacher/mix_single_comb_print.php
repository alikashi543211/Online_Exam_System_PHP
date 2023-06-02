<?php
//echo "<h1 style='color:red;text-align:center;'>Kashif Ali</h1>";
?>

<?php /* // ----------------------------------------- Sign Out Button ----------------------------------------------------- ?>
<form align="right" action="../index.php" method="post">
<input style="height:50px;width:100px;background-color:navy;color:white;cursor:pointer;" type="submit" class="testbutton" name="sign_out" value="Sign Out" />
</form>
<?php // ----------------------------------------- /Sign Out Button ----------------------------------------------------- */?>



























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





















<?php// if(!isset($refresh)) { ?>
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
<?php// } ?>
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

session_start();
$mix_paper="Set";

?>


<?php 
//unset($_SESSION['show_q']);
if(isset($_REQUEST['id1']))
{
	$_SESSION['section_back']="Set";
	header ("Location:mix_obj_questions_paper.php");
 	//echo $_SESSION['mix_paper'];
}

?>





<?php

include_once "header.php";
include_once "mix_obj_paper_print.php";
if(isset($_SESSION['short_questions']))
{
include_once "short_q_print_paper.php";
}
if(isset($_SESSION['long_questions']))
{
include_once "long_q_print_paper.php";
}

?>
















<?php

// ------------------------------------------- To Restrict Unset Variables ----------------------------------------------
$_SESSION['section_back']="SALAM YA HUSSAIN ( A.S )";
$_SESSION['edit_answers']="Set";
$_SESSION['ready_edit_mode']="Set";
// ------------------------------------------- To Restrict Unset Variables ----------------------------------------------

?>























<span class="print_btn2">
<br><br>
<table style="width:1200px;font-size:20px;">
<tr>
<td border="5" colspan="2" align="right" class="print_btn2"><a href="complete_mix_paper.php?id1=obj">Edit Objective</a>
				  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				  <?php if(isset($_SESSION['short_questions']) && isset($_SESSION['long_questions'])) { ?>
<?php // Links to edit answers ?>	<a href="sub_disp_mode.php">Edit Subjective</a>
				  <?php } ?>
				  <?php if(isset($_SESSION['short_questions'])) { ?>
<?php // Links to edit answers ?>	<a href="short_q_paper.php">Edit Subjective</a>
				  <?php } ?>
				  <?php if(isset($_SESSION['long_questions'])) { ?>
<?php // Links to edit answers ?>	<a href="long_q_paper.php">Edit Subjective</a>
				  <?php } ?>
                                    <!--<a href="courses.php">Create New Paper</a>-->
										   </td> 
										   <?php
                        //When Set For Print This Code Would Not Work 

										   ?>
				  </tr>
</table>
<br><br><br>
</span>