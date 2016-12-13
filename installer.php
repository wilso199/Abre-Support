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
	
	if(superadmin() && !file_exists("modules/Abre-Support/setup.txt"))
	{
		//Check for support table
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT * FROM support"))
		{
			$sql = "CREATE TABLE `support` (`id` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
			$sql .= "ALTER TABLE `support` ADD PRIMARY KEY (`id`);";
			$sql .= "ALTER TABLE `support` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for submission field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Submission_Time FROM support"))
		{
			$sql = "ALTER TABLE `support` ADD `Submission_Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Name field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Name FROM support"))
		{
			$sql = "ALTER TABLE `support` ADD `Name` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Email field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Email FROM support"))
		{
			$sql = "ALTER TABLE `support` ADD `Email` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Asset Number field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Asset_Number FROM support"))
		{
			$sql = "ALTER TABLE `support` ADD `Asset_Number` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Building field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Building FROM support"))
		{
			$sql = "ALTER TABLE `support` ADD `Building` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Room field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Room FROM support"))
		{
			$sql = "ALTER TABLE `support` ADD `Room` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Cart_Number field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Cart_Number FROM support"))
		{
			$sql = "ALTER TABLE `support` ADD `Cart_Number` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Cart_Location field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Cart_Location FROM support"))
		{
			$sql = "ALTER TABLE `support` ADD `Cart_Location` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Problem field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Problem FROM support"))
		{
			$sql = "ALTER TABLE `support` ADD `Problem` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Solution field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Solution FROM support"))
		{
			$sql = "ALTER TABLE `support` ADD `Solution` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for Status field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT Status FROM support"))
		{
			$sql = "ALTER TABLE `support` ADD `Status` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for support users table
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT * FROM support_users"))
		{
			$sql = "CREATE TABLE `support_users` (`id` int(11) NOT NULL, `email` text NOT NULL, `building` text NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
			$sql .= "ALTER TABLE `support_users` ADD PRIMARY KEY (`id`);";
			$sql .= "ALTER TABLE `support_users` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
	  		$db->multi_query($sql);
		}
		$db->close();
		
		//Check for email field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT email FROM support"))
		{
			$sql = "ALTER TABLE `support` ADD `email` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Check for building field
		require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');	
		if(!$db->query("SELECT building FROM support"))
		{
			$sql = "ALTER TABLE `support` ADD `building` text NOT NULL;";	
			$db->multi_query($sql);
		}
		$db->close();
		
		//Write the Setup File
		$myfile = fopen("modules/Abre-Support/setup.txt", "w");
		fwrite($myfile, '');
		fclose($myfile);
	}
	
?>