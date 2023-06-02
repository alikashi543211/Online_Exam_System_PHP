<!--
<script>
var doc = new jsPDF()
doc.text ('Hello world!', 10, 10)
doc.save('a4.pdf')
</script>
<script src="javascript.js"></script>
<a href="JavaScript:window.print();">Print this page</a>
-->
<?php
//echo "<h1>This is the page of answer key.</h1>";
 
if(!isset($not_session))
{
session_start();
}
include "connection.php";

?>


















<br><br>
<h1 style="color:green;" align="center">Answers Key ( <?php echo $_SESSION['objective_type']; ?> )</h1> 



























<?php //_____________________________________ Query Setting ___________________________________________________ ?>
<?php
if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='MCQs')
{
$q="question";
$a="answers";
}else
if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='True False')
{
$q="tf_questions";
$a="tf_answers";
}	
else
if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='Fill in Blanks')
{
$q="fb_questions";
$a="fb_answers";
}
?>	
<?php //_____________________________________ /Query Setting ___________________________________________________ ?>






























<?php // _____________________ Display Answer Key Of Related Objective Paper _______________________________ ?>
<?php
$q_paper_id=$_SESSION['q_paper_id'];

$query_a="SELECT q.question,q.q_paper_id,q.question_id,a.option_name,a.question_id,a.ans,a.correct_ans FROM $q q, $a a
 WHERE q.q_paper_id='$q_paper_id' && q.question_id=a.question_id && a.correct_ans='Yes'";
 $result_a=mysqli_query($con,$query_a);
 ?>
 <table border="1" align="center">
 <?php
 $question_no=0;
 while($row_a=mysqli_fetch_array($result_a))
 {
	 $question_no=$question_no+1;
	 ?>
	 <tr>
	 <td><?php echo $question_no; ?></td><td><?php echo $row_a['question']; ?></td>
	 <td><?php echo $row_a['ans']; ?></td><td><?php echo $row_a['correct_ans']; ?></td>
	 <td><?php echo $row_a['option_name']; ?></td>
	 </tr>
	 <?php
 }
?>
</table>

<form method="post" align="">
<table  style="width:900px;">
<tr>
<td align="right">
<br><input style="cursor:pointer;width:150px;height:50px;color:black;border-radius:4px;" type = "submit" name="print_paper" value="Print Answer key" />
</td>
</tr>
</table>
</form>
<?php // _____________________ /Display Answer Key Of Related Objective Paper _______________________________ ?>