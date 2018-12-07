<?php
/**
 * Widgets
 * @category    WordPress_Plugin
 * @package     RO_Multisite_Site_List_Widget
 * @subpackage  Shortcode
 * @copyright   Copyright (c) 2017, Tim Russell
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       20171005.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Displays a HTML table of site active on multisite.
 *
 */
function rone_mss_display_table() {

	$max_per_row = 5;
	$item_count  = 0;

	echo "<table>";
	echo "<tr>";
	foreach ( $images as $image ) {
		if ( $item_count == $max_per_row ) {
			echo "</tr><tr>";
			$item_count = 0;
		}
		echo "<td><img src='" . $image . "' /></td>";
		$item_count ++;
	}
	echo "</tr>";
	echo "</table>";
}


?>