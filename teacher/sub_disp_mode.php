<?php
include "connection.php";
session_start();
//unset($_SESSION['mix_paper']);
//$_SESSION['mix_paper']="a";
if(isset($_SESSION['mix_paper']))
{
	$mix="Set";
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
unset($_SESSION['section_back']);
if(isset($_POST['go']))
{
	unset($_SESSION['section2']);
	$_SESSION['section_back']="Set";
	header ("Location:mix_obj_questions_paper.php");
}
 if(isset($_POST['sq']))
{
    if(isset($mix))
	{		
	$_SESSION['section_back']="Set";
	}
	header ("Location:sq_in_mix_paper.php");
}
 if(isset($_POST['lq']))
{
	if(isset($mix))
	{		
	$_SESSION['section_back']="Set";
	}
	header ("Location:lq_in_mix_paper.php");
}
 if(isset($_POST['disp_paper']) && !isset($mix))
{
	header ("Location:mix_sub_paper_print.php");
}
 if(isset($_POST['disp_paper']) && isset($mix))
{
	header ("Location:complete_mix_paper.php");
}
// ---------------------------------- /Go To Objective and Subjective and Print Form ------------------------------------------


?>
















<body style="background-color:lightgrey;">




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











<h2 align="left" style="font-size:35px;color:purple;text-align:center">Subjective Paper (<span style="font-size:25px;"> <?php echo "Short & Long Questions"; ?> </span>) </h2>

<br><br><br>






































<center>
<form method="post">

<center><span style="color:Navy;font-size:40px;text-align:center;"> Questions of Created Paper<br><br></span></center>


<input style="border-radius:4px;border:none;height:50px;width:200px;background-color:navy;color:white;cursor:pointer;"
 type="submit" name="sq" value="Show Questions ( Short )" />
 
 <input style="border-radius:4px;border:none;height:50px;width:200px;background-color:navy;color:white;cursor:pointer;"
 type="submit" name="lq" value="Show Questions ( Long )" />
 
 <?php if(isset($mix)) { ?>
 <input style="border-radius:4px;border:none;height:50px;width:200px;background-color:navy;color:white;cursor:pointer;"
 type="submit" name="go" value="Go To Objective" />
 <?php } ?>
 
 <input style="border-radius:4px;border:none;height:50px;width:200px;background-color:navy;color:white;cursor:pointer;"
 type="submit" name="disp_paper" value="Display Paper" />
 
</form>
</center>








