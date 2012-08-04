<?php
/*
Plugin Name: Modify autosave interval
Plugin URI: http://ninnypants.com
Description: Change the autosave interval to whatever you want without having to modify wp-config.php
Version: 1.0
Author: ninnypants
Author URI: http://ninnypants.com
License: GPL2

Copyright 2012  Tyrel Kelsey  (email : tyrel@ninnypants.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

add_action('admin_init', 'mas_register_settings');
function mas_register_settings(){
	add_settings_section('mas-autosave', 'Autosave Settings', 'mas_output_fields', 'writing');

	add_settings_field('mas-autosave', 'Autosave Interval', 'mas_autosave_field', 'writing', 'mas-autosave');
	register_setting('writing', 'mas_autosave_interval');
}

function mas_output_fields(){}

function mas_autosave_field(){
	echo '<input type="text" name="mas_autosave_interval" id="mas_autosave_interval" value="'.mas_filter_autosave_interval(AUTOSAVE_INTERVAL).'">';
}

add_filter('autosave_interval', 'mas_filter_autosave_interval');
function mas_filter_autosave_interval($interval = 0){
	$new_interval = get_option('mas_autosave_interval');
	if(!empty($new_interval)){
		$interval = $new_interval;
	}
	return $interval;
}