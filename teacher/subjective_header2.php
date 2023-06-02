<?php
include_once "connection.php";
//session_start();

$q_p_formate_id=$_SESSION['q_p_formate_id'];
$total_marks=$_SESSION['total_marks'];
$q=$_SESSION['quan_sq'];
include_once ("header.php");



if(isset($_SESSION['mix_paper.php']))
{
	$mix="Set";
}



?>
<html>
<head>
<body>





















	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
<?php //_____________________________________Header_______________>   ?>
<table>

     <tr style="text-align:center;font-weight:bold;">	 
        <td style="width:1000px;font-size:30px;">
    <?php
	if(!isset($mix))
	{
	?>
          Section-I
     <?php
	}
	else if(isset($mix))
	{
		?>
		Section-II
		<?php
	}
	 ?>
      </td>
	  </tr>
	  <tr>
	  <td align="right" style='font-weight:bold;'><?php  echo "Subjective Marks (".$_SESSION['t_marks_sq']."+".$_SESSION['t_marks_lq']."=".$_SESSION['total_marks'].")" ?></td>
    </tr>
	</table>	
<?php //_____________________________________/Header_______________>   ?>	
