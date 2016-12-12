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
	
	//Setup tables if new module
	if(!$resultbooks = $db->query("SELECT * FROM support"))
	{
		$sql = "CREATE TABLE `support` (
  `id` int(11) NOT NULL,
  `Submission_Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Name` text NOT NULL,
  `Email` text NOT NULL,
  `Asset_Number` text NOT NULL,
  `Building` text NOT NULL,
  `Room` text NOT NULL,
  `Cart_Number` text NOT NULL,
  `Cart_Location` text NOT NULL,
  `Problem` text NOT NULL,
  `Solution` text NOT NULL,
  `Status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
		$sql .= "ALTER TABLE `support`
  ADD PRIMARY KEY (`id`);";
		$sql .= "ALTER TABLE `support`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
  		if ($db->multi_query($sql) === TRUE) { }
	}
	
	//Setup tables if new module
	if(!$resultbooks = $db->query("SELECT * FROM support_users"))
	{
		$sql = "CREATE TABLE `support_users` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `building` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
		$sql .= "ALTER TABLE `support_users`
  ADD PRIMARY KEY (`id`);";
		$sql .= "ALTER TABLE `support_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
  		if ($db->multi_query($sql) === TRUE) { }
	}
	
	$pageview=1;
	$drawerhidden=0;
	$pageorder=999;
	$pagetitle="1-1 Device Support";
	$description="A student ticketing system for 1-1 devices.";
	$version="1.0.4";
	$repo="abreio/Abre-Support";
	$pageicon="laptop_chromebook";
	$pagepath="support";
	$pagerestrictions="staff, students";
	require_once('permissions.php');
	
?>