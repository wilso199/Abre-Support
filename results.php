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
	if($pageaccess==1 && $supportbuilding!=NULL)
	{	
			
		$searchquery=$_GET["searchquery"];
		
		include "../../core/abre_dbconnect.php";
		if($supportbuilding==1)
		{
			$sql = "SELECT * FROM support where Status='Open'";
			if($searchquery!=NULL){ $sql = "SELECT * FROM support where Status LIKE '%$searchquery%' or Name LIKE '%$searchquery%' or Email LIKE '%$searchquery%' or Asset_Number LIKE '%$searchquery%' or Building LIKE '%$searchquery%' or Room LIKE '%$searchquery%' or Cart_Number LIKE '%$searchquery%' or Cart_Location LIKE '%$searchquery%' order by ID DESC"; }
		}
		else
		{
			$sql = "SELECT * FROM support where Building='$supportbuilding' and Status='Open'";
			if($searchquery!=NULL){ $sql = "SELECT * FROM support where Status LIKE '%$searchquery%' or Name LIKE '%$searchquery%' or Email LIKE '%$searchquery%' or Asset_Number LIKE '%$searchquery%' or Building LIKE '%$searchquery%' or Room LIKE '%$searchquery%' or Cart_Number LIKE '%$searchquery%' or Cart_Location LIKE '%$searchquery%' and Building='$supportbuilding' order by ID DESC"; }
		}
		
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
		 						echo "<th class='hide-on-med-and-down'>Building</th>";
		 						echo "<th class='hide-on-med-and-down'>Room</th>";
		 						echo "<th class='hide-on-med-and-down'>Cart Number / Slot</th>";
		 						echo "<th>Issue</th>";
		 						echo "<th>Status</th>";
		 						echo "<th style='width:30px'></th>";
		 						echo "<th style='width:30px'></th>";
							echo "</tr>";
						echo "</thead>";
						echo "<tbody>";
							include "../../core/abre_dbconnect.php";
							if($supportbuilding==1)
							{
								$sql = "SELECT * FROM support where Status='Open' order by ID DESC";
								if($searchquery!=NULL){ $sql = "SELECT * FROM support where Status LIKE '%$searchquery%' or Name LIKE '%$searchquery%' or Email LIKE '%$searchquery%' or Asset_Number LIKE '%$searchquery%' or Building LIKE '%$searchquery%' or Room LIKE '%$searchquery%' or Cart_Number LIKE '%$searchquery%' or Cart_Location LIKE '%$searchquery%' order by ID DESC"; }
							}
							else
							{
								$sql = "SELECT * FROM support where Building='$supportbuilding' and Status='Open' order by ID DESC";
								if($searchquery!=NULL){ $sql = "SELECT * FROM support where Status LIKE '%$searchquery%' or Name LIKE '%$searchquery%' or Email LIKE '%$searchquery%' or Asset_Number LIKE '%$searchquery%' or Building LIKE '%$searchquery%' or Room LIKE '%$searchquery%' or Cart_Number LIKE '%$searchquery%' or Cart_Location LIKE '%$searchquery%' and Building='$supportbuilding' order by ID DESC"; }
							}
							
							$result = $db->query($sql);
							while($row = $result->fetch_assoc())
							{
								$resultcount=1;
								$Submission_Time=htmlspecialchars($row["Submission_Time"], ENT_QUOTES);
								$Submission_Time=date('F j, Y \a\t g:i a',strtotime($Submission_Time));
								$Asset_Number=htmlspecialchars($row["Asset_Number"], ENT_QUOTES);
								$Building=htmlspecialchars($row["Building"], ENT_QUOTES);
								$Room=htmlspecialchars($row["Room"], ENT_QUOTES);
								$Cart_Number=htmlspecialchars($row["Cart_Number"], ENT_QUOTES);
								$Cart_Location=htmlspecialchars($row["Cart_Location"], ENT_QUOTES);
								$Problem=htmlspecialchars($row["Problem"], ENT_QUOTES);
								$Status=htmlspecialchars($row["Status"], ENT_QUOTES);
								$id=htmlspecialchars($row["id"], ENT_QUOTES);
								
								echo "<tr>";
									echo "<td class='hide-on-small-only'>$Submission_Time</td>";
									echo "<td class='hide-on-small-only'>$Asset_Number</td>";
									echo "<td class='hide-on-med-and-down'>$Building</td>";
									echo "<td class='hide-on-med-and-down'>$Room</td>";
									echo "<td class='hide-on-med-and-down'>$Cart_Number / $Cart_Location</td>";
									echo "<td>$Problem</td>";
									echo "<td>$Status</td>";
									echo "<td width=30px><a class='mdl-button mdl-js-button mdl-button--icon mdl-color-text--grey-600' href='#support/$id'><i class='material-icons'>edit</i></a></td>";	
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
			echo "<div class='row center-align'><div class='col s12'><h6>Whoops</h6></div><div class='col s12'>No tickets found!</div></div>";
		}

	}
	
?>

<script>
	
	$(document).ready(function(){
    	$('select').material_select();
  	});
  	
	$(document).ready(function(){
    	
		//Save Form Data
		var form = $('#form-support');
		var formMessages = $('#form-messages');
		
		$(form).submit(function(event)
		{
			
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
		
		$("#myTable").tablesorter({ });
		
	});
  
</script>