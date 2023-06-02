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
unset($_SESSION['session_back']);
unset($_SESSION['session_back2']);
unset($_SESSION['save_paper']);
unset($_SESSION['edit_paper']);
unset($_SESSION['obj_type']);
unset($_SESSION['ready_edit_mode']);    // Unset Edit Mode Of Objective Questions Paper
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
<body id="bgcolor">

<?php
//-----------------------------------------------------------------------------------
unset($_SESSION['mcq_recycle_bin']);    //insertion of MCQs Of MCQs Session should be unset at this stage
unset($_SESSION['tf_recycle_bin']);     
unset($_SESSION['fb_recycle_bin']);
unset($_SESSION['mcq_on']);                //When Mcqs Display Session should be unset at this stage
unset($_SESSION['tf_on']);        //When True False Display Session should be unset at this stage
unset($_SESSION['fb_on']);        //When True False Session should be unset at this stage
unset($_SESSION['done']);
//------------------------------------------------------------------------------------

?>

<!---------------------------------------------- SELECT PAPER FORMAT START -------------------------------------------------->
<!-------------------------------------------------------SELECT PAPER FORMAT START---------------------------------------------------------->
<?php
if(isset($_POST['format']))
{
	
	    $_SESSION['course_id']=$_POST['course_id'];
		$course_id=$_SESSION['course_id'];
		
		
		$qry_a="SELECT * FROM course WHERE course_id='$course_id'";
		$reslt_a=mysqli_query($qry_a);
		while($ro_a=mysqli_fetch_array($con,$reslt_a))
		{
			echo $_SESSION['user_name']=$ro_a['course_name'];
		}
		$status="Active";
		$_SESSION['q_paper_type_id']=$_POST['q_paper_type_id'];
		
		$course_id=$_SESSION['course_id'];
		$q_paper_type_id=$_SESSION['q_paper_type_id'];
		
		$query_y="INSERT INTO q_paper(q_paper_type_id,course_id,status)
		                       VALUES('$q_paper_type_id','$course_id','$status') ";
		$result_y=mysqli_query($con,$query_y);
		
		//header("Location:select_paper_format.php");
		//header ("Location:practise2.php");

}

?>
<!------------------------------------------------------PAPER FORMAT END------------------------------------------------>




<!---------------------------------------------------------------------------------------------------------------------->
<!--                                         Main Maniue                                      -->
<!----------------------------------------------------------------------------------------------------------------------->
<form action="../index.php" method="post">
<table id="table1" style="background-color:lightgrey;">
<tr>
<td style="height:100px;width:1100px;">
<?php echo "<h1 style='color:maroon'>Welcome ".($_SESSION['user_name']."</h1>"); ?>
</td>
<td style="height:70px; width:250px;text-align:center;"><button style="width:120px;cursor:pointer;" class="testbutton" name="sign_out" />Sign Out </button>
</td>
</tr>
<tr>
<td colspan="2">
<div id="stylefour">
	<ul>
	<li><a href="Courses.php" title=""><span>See Courses</span></a></li>
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
<h1 align="left" style="color:white;" > Your Courses</h1>
<form method="post">
<table bordercolor="white" style="background-color:darkgreen;color:white;">
<?php 
$query_z="SELECT q_paper_type_id,ques_type FROM q_paper_type";
$result_z=mysqli_query($con,$query_z);
?>
<tr> 
   <td>Select Paper Type :</td>
   <td><select name="q_paper_type_id">
   <?php
   while($row_z=mysqli_fetch_array($result_z))
   {
	   ?>
       <option value="<?php echo $row_z['q_paper_type_id']; ?>"><?php echo $row_z['ques_type']; ?></option>
	   <?php
   }
	   ?>
   </td>
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
<td colspan="2"><input type="radio" name="course_id" value="<?php echo $row_a['course_id']; ?>" required >
<?php  echo $row_a['course_name'] ?></td>
</tr>

<?php
}
?>
<tr>
<td           align     =   "right"  
            id          =   "td4" >
	<button style       =   "cursor:pointer;"
	        class       =   "testbutton"
	        name        =   "format">
			Select Paper Format
    </button>
			                                                    </td>
</tr>
</table>
</form>
</body>
</html>