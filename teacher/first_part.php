<form action="../index.php" method="post">
<table id="table1" bordercolor="white" style="background-color:maroon;">
<tr>
<td style="height:100px;width:1100px;">
<?php

$course_id=$_SESSION['course_id'];

$query_b="SELECT course_id, course_name FROM course WHERE course_id='$course_id' ";
$result_b=mysqli_query($con,$query_b);
while($row_b=mysqli_fetch_array($result_b))
{
	$_SESSION['course_name']=$row_b['course_name'];
}

$q_paper_type_id=$_SESSION['q_paper_type_id'];

$query_c="SELECT q_paper_type_id,ques_type FROM q_paper_type WHERE q_paper_type_id='$q_paper_type_id' ";
$result_c=mysqli_query($con,$query_c);
while($row_c=mysqli_fetch_array($result_c))
{
	$_SESSION['q_paper_type']=$row_c['ques_type'];
}
?>
<?php echo "<h1 style='text-align:left;'>Paper format of ".($_SESSION['course_name']." Of ".$_SESSION['q_paper_type']."</h1>"); ?>
</td>
<td style="height:70px; width:250px;text-align:center;"><button style="width:120px;cursor:pointer;" class="testbutton" name="sign_out" />Sign Out </button>
</td>
</tr>
<tr>
</tr>
</table>
</form>
