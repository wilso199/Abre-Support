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
	require_once(dirname(__FILE__) . '/../../core/abre_verification.php');
	require_once(dirname(__FILE__) . '/../../core/abre_functions.php'); 
	require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
	
	//Send the feedback email
	$assetnumber=mysqli_real_escape_string($db, $_POST["assetnumber"]);
	$building=mysqli_real_escape_string($db, $_POST["building"]);
	$roomnumber=mysqli_real_escape_string($db, $_POST["roomnumber"]);
	$cartnumber=mysqli_real_escape_string($db, $_POST["cartnumber"]);
	$cartlocation=mysqli_real_escape_string($db, $_POST["cartlocation"]);
	$problem=mysqli_real_escape_string($db, $_POST["problem"]);
	$name=mysqli_real_escape_string($db, $_POST["name"]);
	$email=mysqli_real_escape_string($db, $_POST["email"]);
	$solution=mysqli_real_escape_string($db, $_POST["solution"]);
	$updateid=mysqli_real_escape_string($db, $_POST["updateid"]);
	$status=mysqli_real_escape_string($db, $_POST["status"]);
	$escalateticket=mysqli_real_escape_string($db, $_POST["escalateticket"]);
	if($assetnumber!="" && $building!="" && $roomnumber!="" && $roomnumber!="" && $cartlocation!="" && $problem!="" && $name!="" && $email!="" && $updateid=="")
	{
		mysqli_query($db, "INSERT INTO support (Name,Email,Asset_Number,Building,Room,Cart_Number,Cart_Location,Problem,Status) VALUES ('$name','$email','$assetnumber','$building','$roomnumber','$cartnumber','$cartlocation','$problem','Open');") or die (mysqli_error($db));
		echo "Your ticket has been submitted.";
	}
	else
	{
		if($escalateticket!="yes")
		{
			if($assetnumber!="" && $building!="" && $roomnumber!="" && $roomnumber!="" && $cartlocation!="" && $problem!="" && $name!="" && $email!="" && $updateid!="")
			{
				mysqli_query($db, "UPDATE support set solution='$solution', status='$status' where id='$updateid'") or die (mysqli_error($db));
				echo "The ticket has been updated.";
			}
			else
			{
				echo "Your ticket was not submitted. Please fill out the entire form.";
			}
		}
		else
		{
			mysqli_query($db, "UPDATE support set solution='$solution', status='Escalated' where id='$updateid'") or die (mysqli_error($db));
			
			//Email Escalation routine
			$to="jatkinson@vartek.com, wflodder@vartek.com";
			$subject = "1-1 Device Support for $building";
			$message = "Student Email: ".$name."\r\n\r\n"."Student Name: ".$email."\r\n\r\n"."Serial Number: ".$assetnumber."\r\n\r\n"."Building: ".$building."\r\n\r\n"."Room: ".$roomnumber."\r\n\r\n"."Cart Number: ".$cartnumber."\r\n\r\n"."Cart Location: ".$cartlocation."\r\n\r\n"."Issue: ".$problem."\r\n\r\n";
			$headers = "From: ". $email;
			mail($to,$subject,$message,$headers);
			
			//Notification
			echo "The ticket has been escalated.";
		}
	}

?>