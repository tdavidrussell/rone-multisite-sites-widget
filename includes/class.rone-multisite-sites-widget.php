<?php
/**
 * Widgets
 *
 * @package     Raging One
 * @subpackage  Widgets
 * @copyright   Copyright (c) 2015, Tim Russell
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       20141028.1
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Raging One MultiSite Links Widget Class
 */
class rone_multisite_list_widget extends WP_Widget {

	// Setup Widget
	function rone_multisite_list_widget() {

		// Widget settings.
		$widget_ops = array( 'classname' => 'rone-multisite-list-widget', 'description' => __( 'MultiSite List Widget, displays site active in MultiSite.', 'rone-multisite-list-widget' ) );

		//
		$widget_settings = $this->wsettings();
		//
		//$this->WP_Widget( 'rone-multisite-widget', __( 'Raging One Multi Site List Widget', 'rone-multisite-list-widget' ), $widget_ops, $widget_settings );
		parent::__construct( 'rone-multisite-widget', __( 'Raging One Multi Site List Widget', 'rone-multisite-list-widget' ), $widget_ops, $widget_settings );

	}

	// Default Settings
	function wsettings() {
		//
		$widget_settings = array(
			'title'      => "Raging One MultiSite List Widget",
			'id'         => 0,
			'open-blank' => 0,
		);

		// Return
		return $widget_settings;

	}

	/**
	 * Display the user side widget
	 *
	 * @param mixed $args
	 * @param mixed $instance
	 */
	function widget( $args, $instance ) {
		extract( $args );

		$title      = apply_filters( 'widget_title', $instance['title'] );
		$open_blank = $instance['open-window'];

		global $wpdb;
		$x_sl = array();

		$blogs = $wpdb->get_results( $wpdb->prepare( "SELECT blog_id, domain, path FROM $wpdb->blogs WHERE site_id = %d AND public = '1' AND archived = '0' AND mature = '0' AND spam = '0' AND deleted = '0' ORDER BY registered DESC", $wpdb->siteid ), ARRAY_A );

		if ( count( $blogs ) ) {
			foreach ( $blogs as $sa => $info ) {
				$x_blog_id = $info['blog_id'];
				$x_domain  = $info['domain'];
				$x_path    = $info['path'];
				$x_name    = get_blog_option( $x_blog_id, "blogname" );
				$x_desc    = get_blog_option( $x_blog_id, "blogdescription" );
				$x_desc    = get_blog_option( $x_blog_id, "blogdescription" );
				if ( "on" == $open_blank ) {
					$target = " target='_blank' ";
				} else {
					$target = "";
				}

				$x_link          = "<li><a href=\"http://$x_domain$x_path\" id=\"siteid-$x_blog_id\" title=\"$x_desc\" $target >$x_name</a></li>";
				$x_sl[ $x_link ] = $x_name;

			}
			// sort by value,
			natcasesort( $x_sl );
		}
		?>
		<?php echo $before_widget; ?>
		<?php echo $before_title . $title . $after_title; ?>
		<ul>
			<?php

			foreach ( $x_sl as $x_url => $sname ) {
				echo $x_url;
			}

			?>
		</ul>

		<?php echo $after_widget; ?>

		<?php
	}

	/**
	 * Update the Widget, form the admin side
	 *
	 * @param mixed $new_instance
	 * @param mixed $old_instance
	 *
	 * @return string
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//
		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title']       = strip_tags( $new_instance['title'] );
		$instance['open-window'] = strip_tags( $new_instance['open-window'] );
		/*
				//No need to strip tags
				$instance['link_catid'] = $new_instance['link_catid'];
		*/

		//
		return $instance;
	}

	/**
	 * Admin side widget form
	 *
	 * @param array $instance
	 *
	 * @return string|void
	 */
	function form( $instance ) {
		$default_settings = $this->wsettings();

		$instance = wp_parse_args( (array) $instance, $default_settings );
		// Clean the Title var....
		$title       = esc_attr( $instance['title'] );
		$open_window = esc_attr( $instance['open-window'] );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?>
				<input class="widefat" id="title" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $instance['title']; ?>"/>
			</label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['open-window'], 'on' ); ?> id="<?php echo $this->get_field_id( 'open-window' ); ?>" name="<?php echo $this->get_field_name( 'open-window' ); ?>"/>
			<label for="<?php echo $this->get_field_id( 'open-window' ); ?>">Open Site in New Window</label>
		</p>

		<?php

	}
}// End of Class