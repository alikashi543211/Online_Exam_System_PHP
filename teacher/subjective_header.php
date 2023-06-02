<?php
include "connection.php";

if(!isset($_SESSION['mix_paper']))
{
	//echo "KASHIF ALI";
session_start();
}

//$_SESSION['total_marks2']=70;
$q_p_formate_id=$_SESSION['q_p_formate_id'];
$total_marks=$_SESSION['total_marks'];
if(isset($_SESSION['quan_sq']))
{
$q=$_SESSION['quan_sq'];
}
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
	  <td align="right" style='font-weight:bold;'>
	  <?php
	  if(!isset($mix) && isset($_SESSION['long_questions']) && isset($_SESSION['short_questions']))
	  {
		 echo "Subjective Marks (".$_SESSION['t_marks_sq']."+".$_SESSION['t_marks_lq']."=".$_SESSION['total_marks'].")"; 
	  }
	  
	  else if(!isset($mix) && isset($_SESSION['long_questions']))
	  {
		    echo "Subjective Marks (".$_SESSION['t_marks_sq'].")";
	  }
	  else if(!isset($mix) && isset($_SESSION['short_questions']))
	  {
	  ?>
	  <?php  echo "Subjective Marks (".$_SESSION['t_marks_sq'].")";  
	  }
	  ?>
	  
	  <?php
	  if(isset($mix) && isset($_SESSION['long_questions']) && isset($_SESSION['short_questions']))
	  {
		 echo "Subjective Marks (".$_SESSION['t_marks_sq']."+".$_SESSION['t_marks_lq']."=".$_SESSION['total_marks2'].")" ;
	  }
	   
	  else if(isset($mix) && isset($_SESSION['long_questions']))
	  {
		    echo "Subjective Marks ( ".$_SESSION['t_marks_lq']." )";
	  }
	  else if(isset($mix) && isset($_SESSION['short_questions']))
	  {
	  ?>
	  <?php  echo "Subjective Marks ( ".$_SESSION['t_marks_sq']." )";  
	  }
	  ?>
	  
	  </td>
    <?php
	  //}else {
		  
	  //}
	  ?>
	</tr>
	</table>	
<?php //_____________________________________/Header_______________>   ?>	
