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
			
		//Search
		echo "<div class='page_container'>";
			echo "<form id='form-search' method='post' action='#'>";
				echo "<div class='row'>";
					echo "<div class='input-field col s12'>";
						echo "<input placeholder='Search' id='searchquery' name='searchquery' type='text'>";
					echo "</div>";
				echo "</div>";  
			echo "</form>";
		echo "</div>";
		
		echo "<div class='page_container' id='topicLoader'><div class='mdl-progress mdl-js-progress mdl-progress__indeterminate' style='width:100%'></div></div>";
		echo "<div id='results'></div>";
				

	}
	
?>

<script>
	
	$("#results").load('modules/<?php echo basename(__DIR__); ?>/results.php', function(){	$("#topicLoader").hide();	});
	
	//Press the search data
	$("#topicLoader").show();
	var form = $('#form-search');
	$(form).submit(function(event)
	{
		event.preventDefault();
		var search = $("#searchquery").val();
		$("#results").load('modules/<?php echo basename(__DIR__); ?>/results.php?searchquery='+search, function(){	
			$("#topicLoader").hide();	
			var notification = document.querySelector('.mdl-js-snackbar');
			var data = { message: 'Searching...', timeout: 1000 };
			notification.MaterialSnackbar.showSnackbar(data);	
		});
		
	});
					
</script>