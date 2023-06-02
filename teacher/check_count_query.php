<?php

//_________________________________________Count Number Of Questions__________________________________________
include "connection.php";
$count_question=0;
$i=1;

$query_z="SELECT short_q_marks,q_p_formate_id FROM short_q WHERE q_p_formate_id='$q_p_formate_id' GROUP BY short_q_marks";
result_z=mysqli_query($con,$query_z);
while($row_z=mysqli_fetch_array($result_z))
     {
	               $a=$row_z['short_q_marks'];
       
$query_y="SELECT short_q_detail, short_q_marks,q_p_formate_id FROM short_q WHERE q_p_formate_id='$q_p_formate_id' && short_q_marks='$a'";   
$result_y=mysqli_query($con,$query_y);
while($row_y=mysqli_fetch_array($result_y))
{
	$count_question=$count_question+1;
}
$_SESSION['counted'][$i]=$count_question;
$i=$i+1;
	 }

//_________________________________________Count Number Of Questions__________________________________________

print_r($_SESSION['counted']);

?>
