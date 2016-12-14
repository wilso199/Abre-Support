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
	
	//Check for installation
	if(superadmin()){ require('installer.php'); }
	
	$pageview=1;
	$drawerhidden=0;
	$pageorder=999;
	$pagetitle="1-1 Device Support";
	$description="A student ticketing system for 1-1 devices.";
	$version="1.0.7";
	$repo="abreio/Abre-Support";
	$pageicon="laptop_chromebook";
	$pagepath="support";
	$pagerestrictions="staff, students";
	require_once('permissions.php');
	
?>