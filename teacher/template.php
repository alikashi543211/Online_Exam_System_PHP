<form method="POST" >
                      <table border="1" align="center">
					  <?php if(!isset($_SESSION['edit_update'])) { ?>
                                   <!--<tr>
                                      <td>Question_ID :</td>
                                      <td>--><input style="padding:10px;border:none;width:900px;height:40px;" readonly type="hidden" name="update_q_id"
                                      value="<?php if(isset($edit_question_id)) { echo $edit_question_id; } ?>"  /><!--</td>
                                   </tr>-->
                                      <tr>
					  <?php } ?>
                                         <td>Question :</td>
                                         <td><input <?php if(isset($edit_question)) { ?>  <?php } else
                                             { ?> readonly <?php } ?> style="padding:5px;border:none;width:900px;height:40px;" value="<?php if(isset($edit_question)) { echo $edit_question; } ?>"type="text" name="update_question" required />
									     </td>
                                      </tr>
									  <!--
                             <tr>
                                <td>Question_Paper_ID :</td>
                                <td>--><input style="padding:20px;border:none;width:900px;height:40px;" readonly type="hidden" name="question_paper"
                                value="<?php if(isset($edit_q_paper_id)) { echo $edit_q_paper_id." (".$_SESSION['course_name'].")"; } ?>"   required /><!--</td>
                             </tr>-->
									  
                                       <tr>
                                           <td>Status :</td>
                                           <td><select style="border:none;width:900px;height:40px;" name="update_status" 
                                           <?php if(!isset($edit_status)) { ?> disabled <?php } ?>   >
                                           <option value="Active" <?php if(isset($edit_status) && $edit_status=='Active') 
	                                       { ?> selected <?php } ?>  >Active</option>
	                                       <option value="Block"  <?php if(isset($edit_status) && $edit_status=='Block')
				                           { ?> selected  <?php } ?>  >Block </option>
	                                           </select>
	                                       </td>
                                      </tr>
									  
 <tr align="center">
             <td colspan="2"><input style="height:50px;width:100px;background-color:navy;color:white;cursor:pointer;"
             <?php if(isset($edit_question_id)) { ?> <?php } else { ?> disabled <?php } ?>
              type="submit" name="Update" value="Update" /></td>
 </tr>
            </table>
                    </form>
