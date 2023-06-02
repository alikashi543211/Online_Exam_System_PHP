<?php
if(!isset($mix_paper))
{
session_start();
}
include "connection.php";
$q_p_formate_id=$_SESSION['q_p_formate_id'];
$total_marks=$_SESSION['total_marks'];
$q=$_SESSION['quan_sq'];
?>
















<!---------------------------------------------- JAVA SCRIPT ----------------------------------------------------------->
<?php if(!isset($mix_paper)) { ?>
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
<?php } ?>
<!---------------------------------------------- /JAVA SCRIPT ----------------------------------------------------------->



































<body>
<?php if(!isset($mix_paper)) { ?>
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
 //}
?>
<!----------------------------------------------------- /Print Button ------------------------------------------------------>
<?php } ?>




































<?php
// ----------------------------------------- Header Of Paper ----------------------------------------------------
include_once ("header.php");
// ----------------------------------------- /Header Of Paper ---------------------------------------------------
?>






















<?php

//_________________________________________Count Number Of Questions__________________________________________

$count_question=0;
$i=1;

$query_z="SELECT short_q_marks,q_p_formate_id FROM short_q WHERE q_p_formate_id='$q_p_formate_id' GROUP BY short_q_marks";
$result_z=mysqli_query($con,$query_z);
while($row_z=mysqli_fetch_array($result_z))
     {
	               $each_q_marks=$row_z['short_q_marks'];
       
$query_y="SELECT short_q_detail, short_q_marks,q_p_formate_id FROM short_q WHERE q_p_formate_id='$q_p_formate_id' && short_q_marks='$each_q_marks' && status='Active' ";   
$result_y=mysqli_query($con,$query_y);
while($row_y=mysqli_fetch_array($result_y))
{
	$count_question=$count_question+1;
}
$_SESSION['counted'][$i]=$count_question;
$count_question=0;
$i=$i+1;
	 }

//_________________________________________Count Number Of Questions__________________________________________

//print_r($_SESSION['counted']);

?>





















<html>


<body>
























































	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
<?php /*_____________________________________Header_______________>   ?>	
<table>

     <tr style="text-align:center;font-weight:bold;">	 
        <td colspan="2" style="width:850px;font-size:30px;">
  
          Section-I
     
      </td>
	  <td align="left" style='font-weight:bold;'><?php  echo "Total Marks=".$_SESSION['total_marks']; ?></td>
	  </tr>
</table>
*/ ?>

<table>

     <tr style="text-align:center;font-weight:bold;">	 
        <td style="width:1000px;font-size:30px;">
  
          Section-I
     
      </td>
	  </tr>
	  <tr>
	  <?php if(isset($mix_paper)) { ?>
	  <td align="right" style='font-weight:bold;'><?php  echo "Subjective Marks ( ".$_SESSION['total_marks2']." )"; ?></td>
	  <?php } else { ?>
	   <td align="right" style='font-weight:bold;'><?php  echo "Subjective Marks ( ".$_SESSION['total_marks']." )"; ?></td>
	  <?php } ?>
	  <?php /*<td align="right" style='font-weight:bold;'><?php  echo "Objective Marks (".$_SESSION['t_marks_mcq']."+".$_SESSION['t_marks_tf']."+".$_SESSION['t_marks_fb']."=".$_SESSION['total_marks'].")" ?></td>
    */ ?>
	</tr>
	</table>
	
	
<?php //_____________________________________/Header_______________>   ?>	































































<?php //_____________________________________Display Questions__________________--->   ?>
<table style="width:1000px;height:100px;font-size:20px;" >
<tr>
<td><h3 style="text-align:left;color:purple;">Short Questions</h3></td>
</tr>
<?php
$question_no=1;
$i=1;
//$query_a="SELECT short_q_detail, short_q_marks,q_p_formate_id FROM short_q WHERE q_p_formate_id='$q_p_formate_id' GROUP BY short_q_marks";
$query_a="SELECT short_q_marks,q_p_formate_id, status FROM short_q WHERE q_p_formate_id='$q_p_formate_id' GROUP BY short_q_marks";
						  $result_a=mysqli_query($con,$query_a);
						  //$values=mysqli_fetch_assoc($result_a);
						  //$num_rows=$values['total'];
						  $q_no=1;
						  while($row_a=mysqli_fetch_array($result_a))
						  {
	                       $each_q_marks=$row_a['short_q_marks'];
						   
						   $no_of_questions=$_SESSION['counted'][$i++];
						   $total_q_marks=$each_q_marks*$no_of_questions;
						   
				?>
				<table>
	          <tr style="font-weight:bold;">
	  <td style="width:1000px;font-size:20px;">Q.No.<?php echo $q_no++; ?>: Attempt <?php echo $no_of_questions; ?> of following Questions. </td>
      <td style="text-align:right;font-weight:bold;"><?php echo "(".$no_of_questions."*".$each_q_marks."=".$total_q_marks.")"; ?></td>

    </tr>
	</table>
	<table style="width:980px;">
				<?php
$query_b="SELECT short_q_detail, short_q_marks,q_p_formate_id FROM short_q WHERE q_p_formate_id='$q_p_formate_id' && short_q_marks='$each_q_marks'";
$result_b=mysqli_query($con,$query_b);
$abc="a";
//$count_question=0;
//$kashif=0;
while($row_b=mysqli_fetch_array($result_b))
{
	 
    ?>
    <tr>
	<td style="width:30px;text-align:center;"><?php echo "<span style='font-weight:bold;'>(".$abc++.")&nbsp;</span>"; ?></td>
	<td colspan="2" style="font-size:18px;height:30px;"><?php echo $row_b['short_q_detail']; ?></td>
	<td align="right"><?php //echo "<span style='font-weight:bold;'>(".$a.")&nbsp;</span>"; ?></td>
	</tr>
	<?php
  }
?>

</table>			
	

	<?php
  }
?>







<?php if(!isset($mix_paper)) { ?>
<table>
<tr>
<td align="right" width="1100px" class="print_btn2"><a style="font-size:20px;" href="short_q_paper.php">Edit Question</a></td>
</tr>
</table>					 
<?php  } ?>
































































</body>
</head>
</html>
