<?php
session_start();
if (!$_SESSION['user_name']) {
header("Location:../index.php");
exit();
}
else
{ 
include_once 'connection.php';
}

unset($_SESSION['quan_sq1']);
unset($_SESSION['quan_sq']);
unset($_SESSION['quan_sq2']);
unset($_SESSION['quan_lq']);
unset($_SESSION['quan_lq1']);
unset($_SESSION['quan_lq2']);
unset($_SESSION['mix_11']);
unset($_SESSION['mix_1']);
unset($_SESSION['finish_check']);
unset($_SESSION['set_btn1']);
unset($_SESSION['set_btn2']);
unset($_SESSION['obj_type']);
unset($_SESSION['show_q']);
unset($_SESSION['double_1']);
unset($_SESSION['double_2']);
unset($_SESSION['double_3']);
unset($_SESSION['two_s']);
unset($_SESSION['two_ss']);
unset($_SESSION['two_sss']);
unset($_SESSION['2_one']);
unset($_SESSION['22_one']);
unset($_SESSION['222_one']);
unset($_SESSION['two_1']);
unset($_SESSION['two_one']);
unset($_SESSION['one_1']);
unset($_SESSION['one_one']);
unset($_SESSION['section_back2']);
unset($_SESSION['set_btn1']);
unset($_SESSION['paper1']);
unset($_SESSION['update']);
unset($_SESSION['section_back']);
unset($_SESSION['done1']);
unset($_SESSION['mcq_choices']); 
unset($_SESSION['edit_paper']);
unset($_SESSION['obj_type']);
unset($_SESSION['done']);
unset($_SESSION['ready_edit_mode']);
unset($_SESSION['comb3']);
unset($_SESSION['comb2']);
unset($_SESSION['comb1']);
unset($_SESSION['mix_paper']);
unset($_SESSION['t_marks_mcq']);
unset($_SESSION['t_marks_fb']);
unset($_SESSION['t_marks_tf']);
unset($_SESSION['quan_mcq']);
unset($_SESSION['quan_fb']);
unset($_SESSION['quan_tf']);
unset($_SESSION['quan_mcq']);
unset($_SESSION['each_mcq']);
unset($_SESSION['each_tf']);
unset($_SESSION['each_fb']);
unset($_SESSION['total_marks']);
unset($_SESSION['q_paper_id']);
unset($_SESSION['q_p_formate_id']);
unset($_SESSION['paper_formate']);
unset($_SESSION['objective_mcq']);
unset($_SESSION['objective_tf']);
unset($_SESSION['objective_fb']);
unset($_SESSION['course_id']);
unset($_SESSION['long_questions']);
unset($_SESSION['short_questions']);




?>






<link rel="stylesheet" href="style.css" type="text/css" />
<link rel="stylesheet" href="stylesheet.css" type="text/css" />
<link rel="shortcut icon" href="d.jpg" />
<html>
<head>
<title>
Teacher/Courses
</title>
</head>
<body style="background-color:lightgrey;">

<?php
//-----------------------------------------------------------------------------------
unset($_SESSION['update']);
unset($_SESSION['done1']);
unset($_SESSION['mcq_choices']); 
unset($_SESSION['mcq_recycle_bin']);    //insertion of MCQs Of MCQs Session should be unset at this stage
unset($_SESSION['tf_recycle_bin']);     
unset($_SESSION['fb_recycle_bin']);
unset($_SESSION['mcq_on']);                //When Mcqs Display Session should be unset at this stage
unset($_SESSION['tf_on']);        //When True False Display Session should be unset at this stage
unset($_SESSION['fb_on']);        //When True False Session should be unset at this stage
unset($_SESSION['done']);
unset($_SESSION['mcq_ready']);
unset($_SESSION['tf_ready']);
unset($_SESSION['fb_ready']);
unset($_SESSION['button_name']);
unset($_SESSION['button_value']);
//------------------------------------------------------------------------------------

?>

<!-------------------------------------------------------SELECT PAPER FORMAT START---------------------------------------------------------->
<?php
if(isset($_POST['format']))
{
	    $user_id=$_SESSION['user_id'];
	    $status="Active";
	    $_SESSION['course_id']=$_POST['course_id'];
		$_SESSION['q_paper_type_id']=$_POST['q_paper_type_id'];
		
		$course_id=$_SESSION['course_id'];
		$q_paper_type_id=$_SESSION['q_paper_type_id'];
		
		$query_y="INSERT INTO q_paper(q_paper_type_id,course_id,user_id,status)
		                       VALUES('$q_paper_type_id','$course_id','$user_id','$status') ";
		$result_y=mysqli_query($con,$query_y);
		
		header("Location:select_paper_format.php");
		//header ("Location:practise2.php");

}

?>
<!------------------------------------------------------PAPER FORMAT END------------------------------------------------>




<!---------------------------------------------------------------------------------------------------------------------->
<!--                                         Main Maniue                                      -->
<!----------------------------------------------------------------------------------------------------------------------->
<form action="../index.php" method="post">
<table id="table1" style="background-color:maroon;">
<tr>
<td style="height:100px;width:1100px;">
<?php echo "<h1 style='color:white;'>Welcome ".($_SESSION['user_name']."</h1>"); ?>
</td>
<td style="height:70px; width:250px;text-align:center;"><button style="border-radius:4px;border:none;cursor:pointer;width:100px;height:50px;background-color:navy;color:white;"  name="sign_out" />Sign Out </button>
</td>
</tr>
<tr>
<td colspan="2">
<div id="stylefour">
	<ul>
	<li><a href="Courses.php" title=""><span>Create Paper</span></a></li>
	</ul>
	</div>
</td>
</tr>
</table>
</form>

<!----------------------------------------------CHECK COURSE ERROR------------------------------------------------------------------------>
<?php

if(isset($course_error))
{
	echo "<h1 style='color:white;text-align:center;'>".$course_error."</h1>";
}

?>
<!-------------------------------------------------END CHECK--------------------------------------------------------------------->
<h1 align="center" style="color:purple;" >Create Questions Paper</h1><br><br>
<form method="post">
<table align="center" bordercolor="white" style="width:900px;height:900px;background-color:maroon;color:white;">
<?php /* 
$query_z="SELECT q_paper_type_id,ques_type FROM q_paper_type";
$result_z=mysqli_query($con,$query_z);
?>
<tr style="background-color:darkgreen;"> 
   <td style="font-size:20px;font-weight:bold;">Select Paper Type :</td>
   <td><!--<select name="q_paper_type_id">-->
   <?php
   while($row_z=mysqli_fetch_array($result_z))
   {
	   ?>
       <input style="cursor:pointer;" name="q_paper_type_id" type="radio" value="<?php echo $row_z['q_paper_type_id']; ?>"><?php echo $row_z['ques_type']; ?></input>   <?php
   }
	   ?>
   </td>
</tr> */ ?>
<tr>
<td colspan="2" align="center" style="font-size:30px;">Choose Subject</td>
</tr>
<?php
$user_id=$_SESSION['user_id'];
$query_a="SELECT a.user_id,a.course_id,u.user_id,c.course_id,c.course_name FROM teach_course_alloc a , user u , course c
                WHERE (a.user_id='$user_id' && u.user_id='$user_id' && a.course_id=c.course_id)";
$result_a=mysqli_query($con,$query_a);

while($row_a=mysqli_fetch_array($result_a))
{
?>
<tr>
<td align="right" ><input style="cursor:pointer;" type="radio" name="course_id" value="<?php echo $row_a['course_id']; ?>" required ></input></td>
<td><?php  echo $row_a['course_name'] ?></td>
</tr>

<?php
}
?>

<tr>
<td colspan="2" align="center" style="font-size:30px;">Choose Paper Type</td>
</tr>

<?php 
$query_z="SELECT q_paper_type_id,ques_type FROM q_paper_type";
$result_z=mysqli_query($con,$query_z);
?>
  <!--<select name="q_paper_type_id">-->
   <?php
   while($row_z=mysqli_fetch_array($result_z))
   {
	   ?>
	      <tr> 
	   <td align="right">
       <input style="cursor:pointer;" name="q_paper_type_id" type="radio" value="<?php echo $row_z['q_paper_type_id']; ?>"></td><td><?php echo $row_z['ques_type']; ?></input>   
	    </td>
	       </tr>
	   <?php
   }
	   ?>
	   <!-- id          =   "td4"-->
<tr>
<td           align     =   "center"  
                                                                   
           colspan    =   "2"			>
	<br><button style="border-radius:10px;cursor:pointer;width:100px;height:50px;background-color:navy;color:white;"
	        name        =   "format">
			Submit
    </button>
			                                                    </td>
</tr>
</table>
</form>
</body>
</html>