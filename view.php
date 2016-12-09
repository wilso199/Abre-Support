<?php
	
	/*
	* Copyright 2015 Hamilton City School District	
	* 		
	* This program is free software: you can redistribute it and/or modify
    * it under the terms of the GNU General Public License as published by
    * the Free Software Foundation, either version 3 of the License, or
    * (at your option) any later version.
	* 
    * This program is distributed in the hope that it will be useful,
    * but WITHOUT ANY WARRANTY; without even the implied warranty of
    * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    * GNU General Public License for more details.
	* 
    * You should have received a copy of the GNU General Public License
    * along with this program.  If not, see <http://www.gnu.org/licenses/>.
    */
	
	//Required configuration files
	require(dirname(__FILE__) . '/../../configuration.php');
	require_once(dirname(__FILE__) . '/../../core/abre_verification.php');
	require_once('permissions.php');
	require_once(dirname(__FILE__) . '/../../core/abre_functions.php'); 
	
	//Display User Profile Information
	if($pageaccess==1)
	{
		$id=htmlspecialchars($_GET["id"], ENT_QUOTES);
		include "../../core/abre_dbconnect.php";
		if($supportbuilding==1)
		{
			$sql = "SELECT * FROM support where id='$id'";
		}
		else
		{
			$sql = "SELECT * FROM support where Building='$supportbuilding' and id='$id'";
		}
		$result = $db->query($sql);
		while($row = $result->fetch_assoc())
		{
			
			$Submission_Time=htmlspecialchars($row["Submission_Time"], ENT_QUOTES);
			$Submission_Time=date('F j, Y \a\t g:i a',strtotime($Submission_Time));
			$Name=htmlspecialchars($row["Name"], ENT_QUOTES);
			$Email=htmlspecialchars($row["Email"], ENT_QUOTES);
			$Asset_Number=htmlspecialchars($row["Asset_Number"], ENT_QUOTES);
			$Building=htmlspecialchars($row["Building"], ENT_QUOTES);
			$Room=htmlspecialchars($row["Room"], ENT_QUOTES);
			$Cart_Number=htmlspecialchars($row["Cart_Number"], ENT_QUOTES);
			$Cart_Location=htmlspecialchars($row["Cart_Location"], ENT_QUOTES);
			$Problem=htmlspecialchars($row["Problem"], ENT_QUOTES);
			$Status=htmlspecialchars($row["Status"], ENT_QUOTES);
			$Solution=htmlspecialchars($row["Solution"], ENT_QUOTES);
			$id=htmlspecialchars($row["id"], ENT_QUOTES);

			echo "<div class='page_container page_container_limit mdl-shadow--4dp'>";
			echo "<div class='page'>";
				
				echo "<form id='form-support' method='post' enctype='multipart/form-data' action='modules/support/submit_process.php'>";
					  echo "<div class='row'><div class='col l12'><h4>1-1 Support Ticket Details</h4></div></div>";
					  
					  echo "<div class='row'>";
					    echo "<div class='col l4 s12'>";
					    	echo "<h6>Ticket Name</h6>";
							echo "<p>$Name</p>";
					    echo "</div>";
					    echo "<div class='col l4 s12'>";
					    	echo "<h6>Ticket Email</h6>";
							echo "<p>$Email</p>";
					    echo "</div>";
					    echo "<div class='col l4 s12'>";
					    	echo "<h6>Serial Number</h6>";
							echo "<p>$Asset_Number</p>";
					    echo "</div>";
					  echo "</div>";
					  
					  echo "<div class='row'>";
					    echo "<div class='col l4 s12'>";
					    	echo "<h6>Building</h6>";
					    	echo "<p>$Building</p>";
					    echo "</div>";
					    echo "<div class='col l4 s12'>";
					    	echo "<h6>Room</h6>";
					    	echo "<p>$Room</p>";
					    echo "</div>";
					    echo "<div class='col l4 s12'>";
					    	echo "<h6>Cart Number / Slot</h6>";
					    	echo "<p>$Cart_Number / $Cart_Location</p>";
					    echo "</div>";
					  echo "</div>";
					  
					  echo "<div class='row'>";
					    echo "<div class='col s12'>";
					    	echo "<h6>Issue</h6>";
					    	echo "<p>$Problem</p>";
					    echo "</div>";
					  echo "</div>";
					  
					  echo "<div class='row'>";
					    echo "<div class='col s12'>";
					    	echo "<h6>Status</h6>";
								if($Status=="Escalated")
								{
									echo "<select disabled name='status' id='status'>";
								}
								else
								{
									echo "<select name='status' id='status'>"; 
								}
								echo "<option value='$Status' selected>$Status</option>";
								if($Status=="Open")
								{ 
									echo "<option value='Closed'>Closed</option>"; 
								}
								if($Status=="Closed")
								{
									echo "<option value='Open'>Open</option>"; 
								}
								if($Status=="Escalated")
								{
									echo "<option disabled value='Escalated'>Escalated</option>"; 
								}
								if($Status=="")
								{
									echo "<option value='Open'>Open</option>"; 
									echo "<option value='Closed'>Closed</option>";
								}
							echo "</select>";
					    echo "</div>";
					  echo "</div>";
					  
					  echo "<div class='row'>";
					    echo "<div class='col s12'>";
					    	echo "<h6>Solution</h6>";
					    	if($Status=="Escalated")
							{
								echo "<textarea disabled placeholder='Enter notes/solution for this ticket' id='solution' name='solution' class='materialize-textarea' required>$Solution</textarea>";
							}
							else
							{
								echo "<textarea placeholder='Enter notes/solution for this ticket' id='solution' name='solution' class='materialize-textarea' required>$Solution</textarea>";
							}
					    echo "</div>";
					  echo "</div>";

						echo "<input type='hidden' name='assetnumber' value='$Asset_Number' id='assetnumber'>";
						echo "<input type='hidden' name='building' value='$Building' id='building'>";
						echo "<input type='hidden' name='roomnumber' value='$Room' id='roomnumber'>";
						echo "<input type='hidden' name='cartlocation' value='$Cart_Location' id='cartlocation'>";
						echo "<input type='hidden' name='problem' value='$Problem' id='problem'>";
						echo "<input type='hidden' name='name' value='$Name' id='name'>";
						echo "<input type='hidden' name='email' value='$Email' id='email'>";	  				
						echo "<input type='hidden' name='updateid' value='$id' id='updateid'>";
					  
					  echo "<div class='row'>";
					    echo "<div class='col s12'>";
					   	 	if($Status=="Escalated")
							{
					    		echo "<b>This ticket has been escalated.</b>";
							}
							else
							{
								echo "<button type='submit' class='modal-action waves-effect btn-flat white-text' style='background-color:"; echo sitesettings("sitecolor"); echo "'>Save</button> ";
								echo "<button type='submit' class='modal-action waves-effect btn-flat white-text escalateticket' style='background-color:"; echo sitesettings("sitecolor"); echo "'>Escalate Ticket</button>";
							}
					    echo "</div>";
					  echo "</div>";
					  
					echo "</form>";
	
			
			echo "</div>";
			echo "</div>";
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
				window.location.href = "#support/queue";
				var notification = document.querySelector('.mdl-js-snackbar');
				var data = { message: response };
				notification.MaterialSnackbar.showSnackbar(data);	
			})
			
		});
    	
    	
  	});
  	
	$(document).ready(function(){
    	
		//Save Form Data
		var form = $('#form-support');
		var formMessages = $('#form-messages');
		
		$( ".escalateticket" ).click(function() {
		    event.preventDefault();
			var formData = $(form).serialize();
			$.ajax({
			    type: 'POST',
			    url: $(form).attr('action'),
			    data: formData + "&escalateticket=yes"
			})
			
			//Show the notification
			.done(function(response) {
				$('#form-support').trigger("reset");
				window.location.href = "#support/queue";
				var notification = document.querySelector('.mdl-js-snackbar');
				var data = { message: response };
				notification.MaterialSnackbar.showSnackbar(data);	
			})
			
		});
    	
    	
  	});
  
</script>