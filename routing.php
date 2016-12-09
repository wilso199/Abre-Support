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
    
		echo "	
			'support': function() {
			    $( '#navigation_top' ).hide();
			    $( '#content_holder' ).hide();
			    $('.tooltipped').tooltip('remove');
			    $( '#loader' ).show();
			    $( '#titletext' ).text('Support');
			    document.title = 'Support';
				$( '#content_holder' ).load( 'modules/support/submit.php', function() { init_page(); });
				
				$( '#navigation_top' ).show();
				$( '#navigation_top' ).load( 'modules/support/menu.php', function() {	
					$( '#navigation_top' ).show();
					$('.tab_1').addClass('tabmenuover');
				});	
		    },
		    'support/history': function() {
			    $( '#navigation_top' ).hide();
			    $( '#content_holder' ).hide();
			    $('.tooltipped').tooltip('remove');
			    $( '#loader' ).show();
			    $( '#titletext' ).text('Support');
			    document.title = 'Support';
				$( '#content_holder' ).load( 'modules/support/history.php', function() { init_page(); });
				
				$( '#navigation_top' ).show();
				$( '#navigation_top' ).load( 'modules/support/menu.php', function() {	
					$( '#navigation_top' ).show();
					$('.tab_2').addClass('tabmenuover');
				});	
		    },
			'support/queue': function(name) {
			    $( '#navigation_top' ).hide();
			    $( '#content_holder' ).hide();
			    $('.tooltipped').tooltip('remove');
			    $( '#loader' ).show();
			    $( '#titletext' ).text('Support');
			    document.title = 'Support';
				$( '#content_holder' ).load( 'modules/support/queue.php', function() { init_page(); });
				
				$( '#navigation_top' ).show();
				$( '#navigation_top' ).load( 'modules/support/menu.php', function() {	
					$( '#navigation_top' ).show();
					$('.tab_3').addClass('tabmenuover');
				});	
		    },
			'support/?:name': function(name) {
			    $( '#navigation_top' ).hide();
			    $( '#content_holder' ).hide();
			    $('.tooltipped').tooltip('remove');
			    $( '#loader' ).show();
			    $( '#titletext' ).text('Support');
			    document.title = 'Support';
				$( '#content_holder' ).load( 'modules/support/view.php?id='+name, function() { init_page(); });
				
				$( '#navigation_top' ).show();
				$( '#navigation_top' ).load( 'modules/support/menu.php', function() {	
					$( '#navigation_top' ).show();
				});	
		    },";	    
?>