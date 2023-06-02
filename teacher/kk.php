while($row_a=mysqli_fetch_array($result_a))
{ 
	
	?>
	<?php 
	
	if($question!=$row_a['question'])                      // If question is same in next row then we will not display
	                                                       //  question and display only options
														   // if question not match then we display question and then options
	{
      if($counter!=1)		
	  {
	?>
		  <?php
		  if(!isset($_SESSION['no_option']))                 //if [no_option] session is not set this means objective_type
                                                             // is MCQs OR True False. So Code will be displayed.
                                                             //If [no_option] session is set this means objective_type
	    {                                                    //is Fill in Blanks. 															 
		?>
	
		          </tr>                                        <?php //end of new row ,-->row cancelling of new table for options ?>
		          </table>                                   <?php // end of new table ,-->Table cancelling which is made in td?>
		          </td>                                   <?php // end of second previous coloumn,-->This coloumn contains new table ?>
		          </tr>                                <?php // end of second previous row ,-->This row contains new table ?>
		<?php
		}
		?>
				  
		  <?php
	  }
    ?>
	
	
	
	
	
	
	
	
	
	<?php
//___________________Questions Fetching______________________--> ?>

	     <tr style="font-weight:normal;">                       <?php // first row will display question. ?>
	     <td style="width:30px;text-align:center;"><?php echo "<span style='font-weight:bold;'>(".$question_number++.")&nbsp;</span>"; ?></td>
		 <td style="font-size:25px;height:50px;"><?php echo $row_a['question']; ?></td>
	     </tr>
	   <?php
	   
//___________________/Questions Fetching_________________________--> 







		  if(!isset($_SESSION['no_option']))
		  {
		  ?>
	    <tr>		                                         <?php //second previous row will display new table of options ?>
		<td></td>                              
	    <td>
			

	    <table style="width:1000px;font-size:20px;height:40px;">        <?php //new table in second row of previous table ?>
	    <tr>
			   <?php
		  }
			   ?>
		
			   
	
	<?php
	$question=$row_a['question'];
	$counter=$counter+1;
	}
	?>
	<?php
	
	
	
	
	
	
	
//______________________Options Fetching______________________--> 

	if(isset($_SESSION['objective_type']) && $_SESSION['objective_type']!='Fill in Blanks')
	    {
		?>
	<td><?php echo "(".$row_a['option_name'].")"; ?></td>     <?php // question display from database.. ?>
	<td style="width:600px;"><?php echo $row_a['ans']; ?></td>   <?php // answers display from database.. ?>
	<?php
		}
		
//_______________________/Options Fetching_____________________--> 
		?>
		
		
		
		
		
	<?php
}
?>
<?php  
if(!isset($_SESSION['no_option']))                      // This code with in brackets is not for fill in blanks.
{                                                       // This code with in brackets is for MCQs or True False.
?>
            </tr>        
		    </table>
		    </td>
			   <?php
			   
    }
?>
		          </tr>      <?php // end of second ROW in previous table ?>
				  <tr>
<?php // Links to edit questions ?> <td border="5" colspan="2" align="right"><a href="obj_question_paper.php">Edit Questions</a>
				  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php // Links to edit answers ?>	<a href="obj_answer_sheet.php">Edit Answers</a>
										   </td>
				  </tr>
</table>	
</body>
</html>

<?php //__________________/Questions and Answers Fetching______________--> ?>





<?php //((((((((((((((((((((((((((((((((<---------------Display of Paper----------------->))))))))))))))))))))))))))) ?>

