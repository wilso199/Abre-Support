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
	require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
	require_once(dirname(__FILE__) . '/../../core/abre_functions.php');	
	
	//Check for support table
	if(!$db->query("SELECT * FROM support"))
	{
		$sql = "CREATE TABLE `support` (`id` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
		$sql .= "ALTER TABLE `support` ADD PRIMARY KEY (`id`);";
		$sql .= "ALTER TABLE `support` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";	
		mysqli_multi_query($db, $sql);
	}
	
	if(!$db->query("SELECT Submission_Time FROM support"))
	{
		$sql = "ALTER TABLE `support` ADD `Submission_Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP;";
  		mysqli_multi_query($db, $sql);
	}
	
	
	
	//Check for support Submission_Time column
	/*
	if(!$db->query("SELECT Submission_Time FROM support"))
	{
		$sql = "ALTER TABLE `support` ADD `Submission_Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP;";
		$db->multi_query($sql);
	}
	*/
	
	//Check for support users table
	/*
	if(!$db->query("SELECT * FROM support_users"))
	{
		$sql = "CREATE TABLE `support_users` (`id` int(11) NOT NULL, `email` text NOT NULL, `building` text NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
		$sql .= "ALTER TABLE `support_users` ADD PRIMARY KEY (`id`);";
		$sql .= "ALTER TABLE `support_users` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
  		$db->multi_query($sql);
	}
	*/
	
	$pageview=1;
	$drawerhidden=0;
	$pageorder=999;
	$pagetitle="1-1 Device Support";
	$description="A student ticketing system for 1-1 devices.";
	$version="1.0.5";
	$repo="abreio/Abre-Support";
	$pageicon="laptop_chromebook";
	$pagepath="support";
	$pagerestrictions="staff, students";
	require_once('permissions.php');
	
?>