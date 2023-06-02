<?php
if(isset($_SESSION['done1']) && isset($_SESSION['done2']))
{
include "connection.php";
session_start();
}

?>











<?php

if(isset($_SESSION['done1']) && isset($_SESSION['done2']))
{
	unset($_SESSION['done1']);
	unset($_SESSION['done2']);
	$_SESSION['done']="Successfully Inserted.";
}

?>

























<?php
// ---------------------------------- Go To Objective and Subjective and Print Form ------------------------------------------
unset($_SESSION['show_sq']);
unset($_SESSION['show_lq']);
//unset($_SESSION['section_back']);
if(isset($_POST['go']))
{
	unset($_SESSION['section2']);
	//$_SESSION['section_back']="Set";
	header ("Location:mix_obj_questions_paper.php");
}
 if(isset($_POST['sq']))
{
	//$_SESSION['section_back']="Set";
	header ("Location:sq_in_mix_paper.php");
}
 if(isset($_POST['lq']))
{
	 //$_SESSION['show_sq']="Set";
	header ("Location:lq_in_mix_paper.php");
}
if(isset($_POST['disp_paper']) && isset($_SESSION['section_back']))
{
	$_SESSION['section_back']="Set";
	header ("Location:complete_mix_paper.php");
}
else if(isset($_POST['disp_paper']) && !isset($_SESSION['section_back']))
{
	
	header ("Location:mix_sub_paper_print.php");
}
// ---------------------------------- /Go To Objective and Subjective and Print Form ------------------------------------------

?>












































<center><span style="color:Navy;font-size:40px;text-align:center;"> Questions of Created Paper<br><br></span></center>
<?php
if(!isset($_SESSION['edit_update']) && !isset($_SESSION['refresh']))
{
	?>
<center><form align="center" method="post">



<input style="border-radius:4px;border:none;height:50px;width:200px;background-color:navy;color:white;cursor:pointer;"
 type="submit" name="sq" value="Show Questions ( Short )" />
 
 <input style="border-radius:4px;border:none;height:50px;width:200px;background-color:navy;color:white;cursor:pointer;"
 type="submit" name="lq" value="Show Questions ( Long )" />
 
 <?php if(isset($_SESSION['section_back'])) { ?>
 <input style="border-radius:4px;border:none;height:50px;width:200px;background-color:navy;color:white;cursor:pointer;"
 type="submit" name="go" value="Go To Objective" />
 <?php } ?>
 
 <input style="border-radius:4px;border:none;height:50px;width:200px;background-color:navy;color:white;cursor:pointer;"
 type="submit" name="disp_paper" value="Display Paper" />
 
</form>
</center>
<?php
}
?>







