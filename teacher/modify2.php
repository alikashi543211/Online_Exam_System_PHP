<?php

if(!isset($_SESSION['mix_paper']) && !isset($not_any_more))
{
session_start();
}

//unset($_SESSION['save_paper'])
// ______________________________________ Save As Word ___________________________________________________
?>




















<?php
    // _________________________  Create New Paper And Print Paper ____________________________________________ ?>
	

<?php
?>

<?php
if(!isset($print) && !isset($mix) || !isset($not_any_more))
{
?>

<a href="courses.php">Create New Paper</a> ||
<a href="modify2.php?printer=set">Print Paper</a>
<?php
}

// _________________________  /Create New Paper And Print Paper ____________________________________________












?>


























































<?php
// ______________________________________  Save As Word ___________________________________________________ ?>
<?php

if(isset($_SESSION['save_as_word']))
{ /*
	include_once "../teacher/pdf/fpdf";
	header ("Content-type: application/adobe-pdf.adobe-pdf");
    header ("Content-Disposition: attachment; filename=kashif.pdf");
	//echo "<h1>Paper is saved successfully...</h1>";
	*/
}
unset($_SESSION['save_as_word']);

// ______________________________________ /Save As Word ___________________________________________________























//echo "<h1 style='color:red;'>Kashif ali</h1>";





include "connection.php";
$q_paper_id=$_SESSION['q_paper_id'];
$q_p_formate_id=$_SESSION['q_p_formate_id'];
if (isset($_SESSION['mix_paper']))
{
	$mix=$_SESSION['mix_paper'];
}
?>
























<?php // ___________________________________ Edit Questions And Answers __________________________________________ ?>

<?php
if(!isset($not_any_more)) {
unset($_SESSION['answers_set']);
unset($_SESSION['edit_paper']);
if(isset($_REQUEST['edit1']))
{
	$_SESSION['edit_paper']="Questions Are Ready For Edit.";
	header ("Location:obj_question_paper.php");
}
else if(isset($_REQUEST['edit2']))
{
	$_SESSION['edit_paper']="Answers Are Ready For Edit.";
	header ("Location:obj_answer_sheet.php");
}
?>

<?php } // ________________________________________ /Edit Questions And Answer  _________________________________________ ?>





















<!-- ___________________________Print Webpage Code ___________________________ -->
<?php

if(isset($_POST['submit']))
{
	
}

?>

<!-- ___________________________Print Webpage Code ___________________________ -->
<html>
<head>
<style>
a {
	text-decoration:none;
	}
</style>
<title>
Question Paper
</title>
</head>




<?php  
//(((((((((((((((((((((((((((((((((((((((((((---------------Header-----------------)))))))))))))))))))))))))))))))))))))))
if(!isset($not_any_more) || isset($save_as_word)) { 
include "header.php";
}
?>





















<?php //(((((((((((((((((((((((((((((((((((((((((-------------/Header---------------))))))))))))))))))))))))))))))))))))) ?>

<?php

function fetch_header2()
{
	$header2 = '';
  $header2 .= '<table>

     <tr style="text-align:center;font-weight:bold;">	 
        <td style="width:1000px;font-size:30px;">
    
          Section-I

      </td>
	  </tr>
	  <tr>
	 
	  ';
	  //return $fa;
//}


//function f2_header_b()
//{
	//$header = '';
	  if(isset($_SESSION['t_marks_mcq']))
	  { 
	  
	   $header2 .= '<td align="right" style="font-weight:bold;"> Objective Marks = ('.$_SESSION["quan_mcq"].'*'.$_SESSION["each_mcq"].'='.$_SESSION["t_marks_mcq"].')</td>';
	  
	  }
	  
	  if(isset($_SESSION['t_marks_fb']))
	  { 
	 
	   $header2 .= '<td align="right" style="font-weight:bold;"> Objective Marks = ('.$_SESSION["quan_fb"].'*'.$_SESSION["each_fb"].'='.$_SESSION["t_marks_fb"].')</td>';
	
	  }
	  
	  if(isset($_SESSION['t_marks_tf']))
	  { 
	  
	   $header2 .= '<td align="right" style="font-weight:bold;"> Objective Marks = ('.$_SESSION["quan_tf"].'*'.$_SESSION["each_tf"].'='.$_SESSION["t_marks_tf"].')</td>';
	 }
	 //return $fb;
//}

	//function f3_header_c()
	
		//$fc = '';
	$header2 .= '</tr>
	       </table>';
		   return $header2;
    }
	/*
	function check_two()
	{
		$a = '';
		$a .= '<h1>KASHIF ALI</h1>';
		$a .=' <h1>SHAHID HUSSAIN</h1>';
		return $a;
		
	}
	*/
echo fetch_header1();
echo fetch_header2();
//echo f2_header_b();
//echo f3_header_c();
//echo "<br>";
//echo check_two();
?>	
<?php //(((((((((((((((((((((((((((((((((((((((((-------------/Header---------------))))))))))))))))))))))))))))))))))))) ?>















<?php //((((((((((((((((((((((((((((((((<---------------Display of Paper----------------->))))))))))))))))))))))))))) 

function  fetch_paper()
{
	include "connection.php";
	$q_paper_id=$_SESSION['q_paper_id'];
    $obj_paper = '';
    $obj_paper .= '<table style="width:1000px;height:100px;font-size:20px;" ><tr>';
	
//______________________Header Question_____________________________-->

if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='Fill in Blanks')          //in case of fill in blanks
{
	                                                                           //display header
 $obj_paper .= '<td colspan="2"><h3 style="text-align:left;color:purple;">Fill in Blanks</h3></td>';   

}

if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='True False')              //in case of true false
{
                                                                                //display header 	
 $obj_paper .= '<td colspan="2"><h3 style="text-align:left;color:purple;">True False</h3></td>';  

}



if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='MCQs')                     // in case of MCQs 
{
	
 $obj_paper .= '<td colspan="2"><h3 style="text-align:left;color:purple;">MCQs</h3></td>';     //display header

}

//_______________________/Header Question___________________________-->

?>

</tr>
























<?php
//-------------------------------Query For Display Of Paper-------------------------------->


//_________________MCQs______________________-->
if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='MCQs')
{
	
$query_a="SELECT q.q_paper_id, q.question_id, q.question, a.question_id,a.ans_id, a.option_name,a.ans,
 a.correct_ans, a.status FROM question q, answers a WHERE q.question_id=a.question_id && q.q_paper_id='$q_paper_id' ";
 unset($_SESSION['no_option']);
}
//________________/MCQs_________________________-->





//________________________Fill in Blanks______________________-->
else if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='Fill in Blanks')
{
$query_a="SELECT q.q_paper_id, q.question_id, q.question, a.question_id,a.ans_id, a.option_name,a.ans,
 a.correct_ans, a.status FROM fb_questions q, fb_answers a WHERE q.question_id=a.question_id && q.q_paper_id='$q_paper_id' ";
 $_SESSION['no_option']="no";
}
//_____________________/Fill in Blanks_________________________-->





//________________________True False_______________________-->
else if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='True False')
{
$query_a="SELECT q.q_paper_id, q.question_id, q.question, a.question_id,a.ans_id, a.option_name,a.ans,
 a.correct_ans, a.status FROM tf_questions q, tf_answers a WHERE q.question_id=a.question_id && q.q_paper_id='$q_paper_id' ";
 unset($_SESSION['no_option']);
}
//_________________________/True False_______________________-->


$result_a=mysqli_query($con,$query_a);

$question_number=1;



//-------------------------------/Query For Display Paper---------------------------------------->























?>
<?php
$question="a";                          //Default value store...
$counter=1;                             //Counter Variable......







//___________/Questions and Answers Fetching______________-->

while($row_a=mysqli_fetch_array($result_a))
{ 
	

	 
	 
	 if($question!=$row_a['question'])  
	 {
	                                                       //  question and display only options
														   // if question not match then we display question and then options
	
      if($counter!=1)		
	  {
	
		  
		  if(!isset($_SESSION['no_option']))                 //if [no_option] session is not set this means objective_type
                                                             // is MCQs OR True False. So Code will be displayed.
                                                             //If [no_option] session is set this means objective_type
	    {                                                    //is Fill in Blanks. 															 
		
	
		          $obj_paper .= '</tr></table></td></tr>';                                        //end of new row ,-->row cancelling of new table for options
		                                                  // end of new table ,-->Table cancelling which is made in td
		                                                  // end of second previous coloumn,-->This coloumn contains new table 
		                                                  // end of second previous row ,-->This row contains new table 
		
		}
	  }   
	
	
	
	
	
	
	
	
	
//___________________Questions Fetching______________________--> 

                                                          // first row will display question.
	      $obj_paper .= '<tr style="font-weight:normal;">                       
	     <td style="font-size:18px;height:30px;"><span style="font-weight:bold;">('.$question_number++.')&nbsp;</span></td>';
		 
		  if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']=='Fill in Blanks') { 
		 
		  $obj_paper .= '<td style="font-size:18px;height:30px;">'.$row_a['question'].'</td>';
		 }
		 else{
			 
			 $obj_paper .= '<td style="font-size:18px;height:30px;font-weight:bold;">'.$row_a['question'].'</td>';
			 
			 
		 }
	
	     $obj_paper .= '</tr>';
	   
	   
//___________________/Questions Fetching_________________________--> 







		  if(!isset($_SESSION['no_option']))
		  {
		                                                        // 1_second previous row will display new table of options
																// 2_new table in second row of previous table
	   $obj_paper .=   '<tr>		                                          
		<td></td>                              
	    <td>
			
	    <table style="width:1000px;font-size:20px;height:40px;">         
	    <tr>';	   
		  }
			  
		
			 
			 
			 
	$question=$row_a['question'];
	$counter=$counter+1;
	 }
	
	
	
	
	
	
	
//______________________Options Fetching______________________--> 

	if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']!='Fill in Blanks')
	    {
		
         $obj_paper .= '<td>('.$row_a["option_name"].')</td>';      // question display from database..
         $obj_paper .= '<td style="width:600px;font-size:18px;height:30px;">'.$row_a["ans"].'</td>';    // answers display from database.. 
	
		}
		
//_______________________/Options Fetching_____________________--> 
		
		
		
		
		
		
	
}  //WHILE LOOP Ending...........
 
if(!isset($_SESSION['no_option']))                      // This code with in brackets is not for fill in blanks.
{                                                       // This code with in brackets is for MCQs or True False.

            $obj_paper .= '</tr>        
		           </table>
		             </td>';
			    
 }
                                             // end of second ROW in previous table
		          $obj_paper .= '</tr> ';     
				   if(!isset($print)) {
					   
				  
 if (!isset($mix) && !isset($not_any_more))
                    $obj_paper .= '<tr>';
	{
		                                    // Links to edit questions 
	     $obj_paper .= '<td border="5" colspan="2" align="right"><a href="print_objective_paper.php?edit1=ques">Edit Questions</a>
				  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                                                                      // Links to edit answers 
	 $obj_paper .= '<a href="print_objective_paper.php?edit2=ans">Edit Answers</a>
										   </td>';
										   
                        }//When Set For Print This Code Would Not Work 
}
										   
				   $obj_paper .= '</tr>
				  
				  

				  
				  
</table>';
return $obj_paper;
}



?>	

<?php  // if(!isset($print) && isset($not_any_more)) 
/*
	if(isset($_POST['generate_pdf']))
	{
	include_once "printer.php";
	}
*/










if(isset($_POST["generate_pdf"]))  
 {  
      require_once('tcpdf/tcpdf.php');  
	  $cleannotes = strip_tags($row['notes']);
      $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("Generate HTML Table Data To PDF From MySQL Database Using TCPDF In PHP");  
      $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
      $obj_pdf->SetDefaultMonospacedFont('helvetica');  
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
      $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
      $obj_pdf->setPrintHeader(false);  
      $obj_pdf->setPrintFooter(false);  
      $obj_pdf->SetAutoPageBreak(TRUE, 10);  
      $obj_pdf->SetFont('helvetica', '', 11);  
      $obj_pdf->AddPage();  
      $content = '';  
      /*$content .= '  
      <h4 align="center">Generate HTML Table Data To PDF From MySQL Database Using TCPDF In PHP</h4><br /> 
      <table border="1" cellspacing="0" cellpadding="3">  
           <tr>  
                <th width="5%">Id</th>  
                <th width="30%">Name</th>  
                <th width="15%">Age</th>  
                <th width="50%">Email</th>  
           </tr>  
      ';
*/	  
      $content .=fetch_header1();
	  $content .=fetch_header2();
      $content .= fetch_paper();  
      //$content .= '</table>';  
      $obj_pdf->writeHTML($content);
     $file_name=$_SESSION['course_name'].' of '.$_SESSION['q_paper_type'];	
ob_end_clean();	 
      $obj_pdf->Output($file_name, 'I');  
 }  
 
















	?>
<form method="post" >
<table style="width:1200px;" >
<tr>
<td style="text-align:right;">
<input style="cursor:pointer;width:100px;height:50px;color:black;border-radius:4px;" type = "submit" name="print_paper" value="Print Preview" />
<input style="cursor:pointer;width:100px;height:50px;color:black;border-radius:4px;" type = "submit" name="generate_pdf" value="Print Paper" />
</td>
</tr>
</table>
</form>
<?php
//}
echo fetch_header1();
echo fetch_header2();
echo fetch_paper();

?>
</body>
</html>

<?php //__________________/Questions and Answers Fetching______________--> ?>





<?php //((((((((((((((((((((((((((((((((<---------------Display of Paper----------------->))))))))))))))))))))))))))) ?>










