













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




























<body>
<span class="print_btn2">
<?php // ----------------------------------------- Sign Out Button ----------------------------------------------------- ?>
<form style="float:right;" action="../index.php" method="post">
<input style="height:50px;width:100px;background-color:navy;color:white;cursor:pointer;" type="submit" name="sign_out" value="Sign Out" />
</form>&nbsp;&nbsp;&nbsp;
<?php // ----------------------------------------- /Sign Out Button ----------------------------------------------------- ?>





<?php // ----------------------------------------- Create New Paper Button ----------------------------------------------------- ?>
<form style="float:right;" action="courses.php" method="post">
<input style="height:50px;width:200px;background-color:navy;color:white;cursor:pointer;" type="submit"  name="sign_out" value="Create New Paper" />
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












<?php } ?>



























<?php

include_once ("subjective_header.php");

include_once ("display_short_only.php");

include_once ("display_long_only.php");
?>















<?php if(!isset($mix)) { ?>
<table class="print_btn2">
<tr>
<td align="right" width="1100px"><a style="font-size:30px;" href="sub_disp_mode.php">Edit Question</a></td>
</tr>
</table>					 
<?php  } ?>












































<!----------------------------------------------------- Save Paper ------------------------------------------------------>

<?php /* if(isset($refresh)) {
	?>
<form align="center" method="post" id="print_btn">	
<input onclick="myFunction()" style="cursor:pointer;width:100px;height:50px;color:black;border-radius:4px;" type = "submit" name="" value="Print" /> 
</form>
<?php
}
 */ ?>	  
<!----------------------------------------------------- /Save Paper ------------------------------------------------------>
	
	















