<?php

//_________________________________________Count Number Of Questions__________________________________________

$count_question=0;
$i=1;

$query_z="SELECT long_q_marks,q_p_formate_id FROM long_q WHERE q_p_formate_id='$q_p_formate_id' GROUP BY long_q_marks";
$result_z=mysqli_query($con,$query_z);
while($row_z=mysqli_fetch_array($result_z))
     {
	               $each_q_marks=$row_z['long_q_marks'];
       
$query_y="SELECT long_q_detail, long_q_marks,q_p_formate_id, status FROM long_q WHERE q_p_formate_id='$q_p_formate_id' && long_q_marks='$each_q_marks' && status='Active' ";   
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






































<?php //_____________________________________Display Questions__________________--->   ?>

<table style="width:1000px;height:100px;font-size:20px;" >
<tr>
<td><h3 style="text-align:left;color:purple;">Long Questions</h3></td>
</tr>
<?php
$question_no=1;
//foreach($_SESSION['counted'] as $no_of_questions)

						   //{
							   $i=1;
$query_a="SELECT long_q_marks,q_p_formate_id FROM long_q WHERE q_p_formate_id='$q_p_formate_id' GROUP BY long_q_marks";
						  $result_a=mysqli_query($con,$query_a);
						  $q_no=1;
						  while($row_a=mysqli_fetch_array($result_a))
						  {
	                       
        					
	                       $each_q_marks=$row_a['long_q_marks'];
						   
						   $no_of_questions=$_SESSION['counted'][$i++];
						   $total_q_marks=$each_q_marks*$no_of_questions;
				?>
				<table>
	          <tr style="font-weight:bold;">
	  <td style="width:1000px;font-size:20px;">Q.No.<?php echo $q_no++; ?>: Attempt <?php echo $no_of_questions; ?> of following Questions.</td>
      <td style="text-align:right;font-weight:bold;"><?php echo "(".$no_of_questions."*".$each_q_marks."=".$total_q_marks.")"; ?></td>

    </tr>
	</table>
	<table style="width:980px;">
				<?php
$query_b="SELECT long_q_detail, long_q_marks,q_p_formate_id FROM long_q WHERE q_p_formate_id='$q_p_formate_id' && long_q_marks='$each_q_marks'";
$result_b=mysqli_query($con,$query_b);
$abc="a";
while($row_b=mysqli_fetch_array($result_b))
{
	
    ?>
    <tr>
	<td style="width:30px;text-align:center;"><?php echo "<span style='font-weight:bold;'>(".$abc++.")&nbsp;</span>"; ?></td>
	<td colspan="2" style="font-size:18px;height:30px;"><?php echo $row_b['long_q_detail']; ?></td>
	<td align="right"><?php //echo "<span style='font-weight:bold;'>(".$a.")&nbsp;</span>"; ?></td>
	</tr>
	<?php
  } // End Of Second While Loop
?>

</table>			
	

	<?php
  }    //End Of First While Loop
						  // }                      // End Of Foreach Loop
?>
<?php

if(!isset($_SESSION['mix_paper']))
{

?>
<!--<table align="right">
<tr>
<td align="right"><a style="font-size:20px;" href="lq_in_mix_paper.php">Edit Question</a></td>
</tr>
</table>
-->					 
<?php  } //_____________________________________/Display Questions__________________--->   ?>
