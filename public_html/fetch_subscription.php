<?php
header('Access-Control-Allow-Origin: *');
include 'connection.php';
$uid=mysql_real_escape_string($_GET["uid"]);
?>

                            <div class="form-group bg-success"> 		
                           <?php
                           $q="select * from tbl_usersubscriptions where UserId='$uid' and subs_status='activated'";
						 // echo $q;
                           $result=mysql_query($q) or die(mysql_error());
									if(mysql_affected_rows())
									{
                           ?>
                            
                             <h3>Select Subscription </h3> 
                               		<select name="subtype" required class="styledselect_form_1 form-control" style="padding:5px;">
                               		<?php
                               		
										while($row=mysql_fetch_array($result))
										{
											$subs_id=$row["subs_id"];
											
											
											$result1=mysql_query("select * from tbl_subscriptions where subs_id='$subs_id'");
											$row1=mysql_fetch_array($result1);
											
												$subs_text=$row1["subs_name"];
											
												?>
											<option value="<?php echo $row["srno"]; ?>" style="padding:10px"><?php echo $subs_text;?> </option>
											<?php
											
											
										}
								
                               		?>
                               		
                               		</select>
               					<input type="hidden" name="hiddenotype" value="subscription">
                           <?php
                           	}
									
									else {
									
							?>
							<input type="hidden" name="hiddenotype" value="laundry">
							<?php
									} 
					        ?>
                            </div>
                        