<?php session_start(); // Start the session
if (!$_SESSION['user_name']) {
header("Location:../index.php");
exit();
}
else
{ 
include_once 'connection.php';
}

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
unset($_SESSION['mcq_recycle_bin']);    //insertion of MCQs Of MCQs Session should be unset at this stage
unset($_SESSION['tf_recycle_bin']);     
unset($_SESSION['fb_recycle_bin']);
unset($_SESSION['mcq_on']);                //When Mcqs Display Session should be unset at this stage
unset($_SESSION['tf_on']);        //When True False Display Session should be unset at this stage
unset($_SESSION['fb_on']);        //When True False Session should be unset at this stage
unset($_SESSION['done']);


?>
<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css" />
<link rel="stylesheet" href="stylesheet.css" type="text/css" />
<link rel="shortcut icon" href="d.jpg" />
</head>

</html>
<title>
Teacher
</title>
<html>
<body style="background-color:lightgrey;">
<form action="../index.php" method="post">
<table id="table1" style="background-color:maroon;">
<tr>
<td style="height:100px;width:1100px;">
<?php echo "<h1 style='color:white'>Welcome ".($_SESSION['user_name']."</h1>"); ?>
</td>
<td style="height:70px; width:250px;text-align:center;"><button style="cursor:pointer;width:100px;height:50px;background-color:navy;color:white;" name="sign_out" />Sign Out </button>
</td>
</tr>
<tr>
<td colspan="2">
<div id="stylefour">
	<ul>
	<li><a href="courses.php" title=""><span>Create Paper</span></a></li>
	</ul>
	</div>
</td>
</tr>
</table>
</form>

	<br>
</body>
</html>