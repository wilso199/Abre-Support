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
	require(dirname(__FILE__) . '/../../core/abre_dbconnect.php'); 
	
	//Check for Admin Authentication
	if($_SESSION['usertype']=="staff")
	{
		$sql = "SELECT * FROM users where email='".$_SESSION['useremail']."' and (superadmin='1' or superadmin='2')";
		$result = $db->query($sql);
		while($row = $result->fetch_assoc())
		{
			$pageaccess=1;
			$supportbuilding=1;
			$pagerestrictions="";
		}
	}
	
	if($_SESSION['usertype']=="student")
	{
		if ((strpos($_SESSION['useremail'], '21') !== false) or (strpos($_SESSION['useremail'], '22') !== false) or (strpos($_SESSION['useremail'], '23') !== false)) 
		{
			$pageaccess=1;
			$pagerestrictions="";
		}
	}
	
	//Check for Staff/Student Admins
	$sql = "SELECT * FROM support_users where email='".$_SESSION['useremail']."'";
	$result = $db->query($sql);
	while($row = $result->fetch_assoc())
	{
		$building=htmlspecialchars($row["building"], ENT_QUOTES);
		if($building!="")
		{
			$supportbuilding=$building;
			$pageaccess=1;
			$supportbuilding=1;
			$pagerestrictions="";
		}
	}

?>