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
		
		
		//POST request for login authentication
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://vartek.sysaidit.com/api/v1/login");
		$data = array("user_name" => "dmolloy", "password" => "equinox05");
		$data_string = json_encode($data);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($data_string)));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		$result = curl_exec($ch);

		//Response Body and Headers
		$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
		$header = substr($result, 0, $header_size);
		$body = substr($result, $header_size);
		
		curl_close ($ch);
		
		//Get the Session
		function get_string_between($string, $start, $end)
		{
		    $string = ' ' . $string;
		    $ini = strpos($string, $start);
		    if ($ini == 0) return '';
		    $ini += strlen($start);
		    $len = strpos($string, $end, $ini) - $ini;
		    return substr($string, $ini, $len);
		}
		$session = get_string_between($header, 'Set-Cookie:', ';');
		
		//GET Request
		$ch = curl_init();
		$numberofreturns=10;
		curl_setopt($ch, CURLOPT_URL, "https://vartek.sysaidit.com/api/v1/sr/?limit=$numberofreturns&sort=insert_time&dir=desc&type=incident");                                                                
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Cookie: ' . $session));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close ($ch);
		
		//Display Response
		$json = json_decode($result,true);
		
		for ($x = 0; $x < $numberofreturns; $x++)
		{
			$submit_user = $json[$x]['info'][14]['valueCaption'];
			$priority = $json[$x]['info'][25]['valueCaption'];
			$problem_type = $json[$x]['info'][31]['valueCaption'];
			$problem_sub_type = $json[$x]['info'][34]['valueCaption'];
			$description = $json[$x]['info'][35]['valueCaption'];
			$description=nl2br($description);
			$insert_time = $json[$x]['info'][36]['valueCaption'];
			$title = $json[$x]['info'][38]['valueCaption'];
			$computer_id = $json[$x]['info'][57]['valueCaption'];
			$assigned_group = $json[$x]['info'][71]['valueCaption'];
			echo "<b>$title</b><br>$problem_type | $problem_sub_type<br>$submit_user<br>$insert_time<br>$priority<br>$description<br>$computer_id<br>$assigned_group<br><br>";
		}
		

		echo "<div class='page_container page_container_limit mdl-shadow--4dp'>";
		echo "<div class='page'>";
			
			echo "<form id='form-support' method='post' enctype='multipart/form-data' action='modules/".basename(__DIR__)."/submit_process.php'>";
				  echo "<div class='row'><div class='col l12'><h4>Report a 1-1 Device Problem</h4></div></div>";
				  
				  echo "<div class='row'>";
				    echo "<div class='input-field col l3 s12'>";
				      echo "<input placeholder='Enter the device serial number' id='assetnumber' name='assetnumber' required>";
				      echo "<label class='active' for='assetnumber'>Serial Number</label>";
				    echo "</div>";
				  echo "</div>";
				  
				  echo "<div class='row'>";
				    echo "<div class='input-field col l3 s12'>";
						echo "<select name='building' id='building'>";
							echo "<option value='' disabled selected>Choose a Building</option>";
							echo "<option value='Garfield'>Garfield</option>";
							echo "<option value='Wilson'>Wilson</option>";
							echo "<option value='Freshman'>Freshman</option>";
						echo "</select>";
						echo "<label>Building</label>";
				    echo "</div>";
				    echo "<div class='input-field col l3 s12'>";
				      echo "<input placeholder='Enter the room where the device is located' id='roomnumber' name='roomnumber' type='text' required>";
				      echo "<label class='active' for='roomnumber'>Room</label>";
				    echo "</div>";
				    echo "<div class='input-field col l3 s12'>";
				      echo "<input placeholder='Enter the cart number of the device' id='cartnumber' name='cartnumber' type='number' required>";
				      echo "<label class='active' for='cartnumber'>Cart Number</label>";
				    echo "</div>";
				    echo "<div class='input-field col l3 s12'>";
				      echo "<input placeholder='Enter the slot number of the device' id='cartlocation' name='cartlocation' type='number' required>";
				      echo "<label class='active' for='cartlocation'>Cart Slot Number</label>";
				    echo "</div>";
				  echo "</div>";
				  
				  echo "<div class='row'>";
				    echo "<div class='input-field col s12'>";
				    	echo "<p style='font-size:12px;'>What seems to be the problem?</p>";
						echo "<textarea placeholder='Briefly explain what is wrong with your device' id='problem' name='problem' class='materialize-textarea' maxlength='300' length='300' required></textarea>";
				    echo "</div>";
				  echo "</div>";
				  				  				
				  echo "<input type='hidden' name='name' value='".$_SESSION['displayName']."' id='name'>";
				  echo "<input type='hidden' name='email' value='".$_SESSION['useremail']."' id='email'>";
				  
				  echo "<div class='row'>";
				    echo "<div class='col s12'>";
				    	echo "<p style='font-size:12px;'>This ticket will be submitted from <b>".$_SESSION['displayName']."</b>. A representative will be in touch with you shortly.</p>";
				    	echo "<button type='submit' class='modal-action waves-effect btn-flat white-text' style='background-color:"; echo sitesettings("sitecolor"); echo "'>Submit</button>";
				    echo "</div>";
				  echo "</div>";
				  
				echo "</form>";

		
		echo "</div>";
		echo "</div>";

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
				window.location.href = "#support/history";
				var notification = document.querySelector('.mdl-js-snackbar');
				var data = { message: response };
				notification.MaterialSnackbar.showSnackbar(data);	
			})
			
		});
    	
    	
  	});
  	
	$(document).ready(function() {
		$('#problem').characterCounter();
	});
  
</script>