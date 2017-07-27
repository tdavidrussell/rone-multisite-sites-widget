<?php
/*
 * @category            WordPress_Plugin
 * @package             RO_Multisite_Site_List_Widget
 * @author              Tim Russell <githubber@timrussell.com>
 * @copyright           Copyright (c) 2016-2017.
 * @license             GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name:         RO Multisite Sites List Widget
 * Plugin URI:          https://www.timrussell.com/wordpress
 * Description:         This plugin adds a widget to list MultiSite Sites Link(s).
 * Version:             20170425.1
 * Author:              Tim Russell
 * Author URI:          https://timrussell.com/
 * License:             GPL-2.0+
 * License URI:         http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:         rone-multisite-sites-widget
 * Domain Path:         /languages
 *
 *
 * GitHub Plugin URI:   https://github.com/tdavidrussell/rone-multisite-sites-widget
 * GitHub Branch:       master
 *
 * Requires WP:         4.6
 * Requires PHP:        5.3
 *
 * Support URI:         http://timrussell.com/wordpress/
 * Documentation URI:   http://timrussell.com/wordpress/
 *
 * Tags: widget, multisite
 *
*
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * **********************************************************************
*/


if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/** initial constants ROMSSW_  Raging One Multisite Sites Widget **/
define( 'ROMSSW_PLUGIN_VERSION', '20160110.1' );
define( 'ROMSSW_PLUGIN_DEBUG', false );
//
define( 'ROMSSW_PLUGIN_URI', plugin_dir_url( __FILE__ ) ); //Does contain trailing slash
define( 'ROMSSW_PLUGIN_PATH', plugin_dir_path( __FILE__ ) ); //Does contain trailing slash
//
define( 'ROMSSW_THEME_DIR', get_stylesheet_directory() );    //Does NOT contain a trailing slash
define( 'ROMSSW_THEME_URI', get_stylesheet_directory_uri() ); //Does not contain a trailing slash

/**
 * Include widget class.
 */
include( ROMSSW_PLUGIN_PATH . 'includes/class.rone-multisite-sites-widget.php' );

/**
 * Register our widget.
 *
 * @since 20141028.1
 */
function rone_load_multisite_list_widget() {
	register_widget( 'rone_multisite_list_widget' );
}

/**
 * Add function (hook action) to widgets_init that'll load  widget.
 * @since 20141028.1
 */
add_action( 'widgets_init', 'rone_load_multisite_list_widget' );
