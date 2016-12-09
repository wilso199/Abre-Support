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
	require(dirname(__FILE__) . '/../../core/abre_dbconnect.php'); 
	
	//Check for Admin Authentication
	$sql = "SELECT * FROM users where email='".$_SESSION['useremail']."' and (superadmin='1' or superadmin='2')";
	$result = $db->query($sql);
	while($row = $result->fetch_assoc())
	{
		$pageaccess=1;
		$supportbuilding=1;
		$pagerestrictions="";
	}
	
	if($_SESSION['usertype']=="student")
	{
		if ((strpos($_SESSION['useremail'], '20') !== false) or (strpos($_SESSION['useremail'], '21') !== false) or (strpos($_SESSION['useremail'], '22') !== false)) 
		{
			$pageaccess=1;
			$pagerestrictions="";
		}
	}
	
	$sql = "SELECT * FROM support_users where email='".$_SESSION['useremail']."'";
	$result = $db->query($sql);
	while($row = $result->fetch_assoc())
	{
		$building=htmlspecialchars($row["building"], ENT_QUOTES);
		if($building!="")
		{
			$supportbuilding=$building;
		}
		else
		{
			$supportbuilding=1;
		}
		$pageaccess=1;
		$pagerestrictions="";
	}

?>