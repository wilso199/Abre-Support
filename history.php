<?php
	
	/*
	* Copyright (C) 2016-2017 Abre.io LLC
	*
	* This program is free software: you can redistribute it and/or modify
    * it under the terms of the Affero General Public License version 3
    * as published by the Free Software Foundation.
	*
    * This program is distributed in the hope that it will be useful,
    * but WITHOUT ANY WARRANTY; without even the implied warranty of
    * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    * GNU Affero General Public License for more details.
	*
    * You should have received a copy of the Affero General Public License
    * version 3 along with this program.  If not, see https://www.gnu.org/licenses/agpl-3.0.en.html.
    */
	
	//Required configuration files
	require(dirname(__FILE__) . '/../../configuration.php');
	require_once(dirname(__FILE__) . '/../../core/abre_verification.php');
	require_once('permissions.php');
	require_once(dirname(__FILE__) . '/../../core/abre_functions.php'); 
	
	//Display User Profile Information
	if($pageaccess==1)
	{	
						
		include "../../core/abre_dbconnect.php";
		$sql = "SELECT *  FROM support where email='".$_SESSION['useremail']."' order by ID DESC";
		$result=mysqli_query($db,$sql);
		$rowcount=mysqli_num_rows($result);
		if($rowcount!=0)
		{
			
			//Display Recent Searches	
			echo "<div class='page_container mdl-shadow--4dp'>";
			echo "<div class='page'>";	
			echo "<div class='row'><div class='col s12'>";
							
					echo "<table id='myTable' class='tablesorter'>";
						echo "<thead>";
							echo "<tr class='pointer'>";
								echo "<th class='hide-on-small-only'>Submission Time</th>";
								echo "<th class='hide-on-small-only'>Serial Number</th>";
		 						echo "<th>Issue</th>";
		 						echo "<th>Status</th>";
							echo "</tr>";
						echo "</thead>";
						echo "<tbody>";
							include "../../core/abre_dbconnect.php";
							$sql = "SELECT * FROM support where Email='".$_SESSION['useremail']."' order by ID DESC LIMIT 30";
							$result = $db->query($sql);
							while($row = $result->fetch_assoc())
							{
								$resultcount=1;
								$Submission_Time=htmlspecialchars($row["Submission_Time"], ENT_QUOTES);
								$Submission_Time=date('F j, Y \a\t g:i a',strtotime($Submission_Time));
								$Asset_Number=htmlspecialchars($row["Asset_Number"], ENT_QUOTES);
								$Building=htmlspecialchars($row["Building"], ENT_QUOTES);
								$Room=htmlspecialchars($row["Room"], ENT_QUOTES);
								$Cart_Location=htmlspecialchars($row["Cart_Location"], ENT_QUOTES);
								$Problem=htmlspecialchars($row["Problem"], ENT_QUOTES);
								$Solution=htmlspecialchars($row["Solution"], ENT_QUOTES);
								$Status=htmlspecialchars($row["Status"], ENT_QUOTES);
								$id=htmlspecialchars($row["id"], ENT_QUOTES);
								
								echo "<tr>";
									echo "<td class='hide-on-small-only'>$Submission_Time</td>";
									echo "<td class='hide-on-small-only'>$Asset_Number</td>";
									echo "<td>$Problem</td>";
									if($Status!="Closed")
									{
										echo "<td>$Status</td>";
									}
									else	
									{
										echo "<td>Closed - $Solution</td>";
									}
								echo "</tr>";
												
							}
					
						echo "</tbody>";
					echo "</table>";
					
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
		}
		else
		{
			echo "<div class='row center-align'><div class='col s12'><h6>No Submitted Tickets</h6></div><div class='col s12'>Click 'New Ticket' above to create a support ticket.</div></div>";
		}

	}
	else
	{
		echo "<p>Only 1-1 students are eligible for device support.</p>";
	}
	
?>

<script>
	
	$(document).ready(function() {
    	$('select').material_select();
  	});
  	
	$(document).ready(function(){
    	
		//Save Form Data
		var form = $('#form-support');
		var formMessages = $('#form-messages');
		
		$(form).submit(function(event) {
		    event.preventDefault();
			var formData = $(form).serialize();
			$.ajax({
			    type: 'POST',
			    url: $(form).attr('action'),
			    data: formData
			})
			
			//Show the notification
			.done(function(response) {
				$('#form-support').trigger("reset");
				var notification = document.querySelector('.mdl-js-snackbar');
				var data = { message: response };
				notification.MaterialSnackbar.showSnackbar(data);	
			})
			
		});
    	
  	});
  	
	$(document).ready(function(){  
		$("#myTable").tablesorter({ 
    	});
		
	});
  
</script>