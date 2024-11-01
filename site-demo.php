<?php

/**
 * Plugin Name:       Site Demo Creator
 * Description:       Demo your website in a browser or mobile mockup and capture screencasts and screenshots for explainer videos and walk-throughs.
 * Version:           0.0.1
 * Contributors:      gelform
 * Author:            gelform
 * Author URI:        https://gelform.com
 * Tags:              walk-through, dmeo, screencast, screenshot, presentation
 * Requires at least: 5.1
 * Tested up to:      5.8
 * Requires PHP:      7.2
 * Stable tag:        0.0.1
 * License:           GPLv2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.html
 */

class Sitedemo {

	private static $instance;

	public $plugin_dir_url;
	public $plugin_dir_path;
	public $plugin_data;

	const TEMPLATES = [
		'browser',
		'mobile'
	];

	private function __construct() {
	}

	private function setup() {
		$this->plugin_dir_url  = plugin_dir_url( __FILE__ );
		$this->plugin_dir_path = plugin_dir_path( __FILE__ );

		add_action( 'template_include', [ $this, 'apply_template' ], 10, 1 );
		add_action('admin_bar_menu', [$this, 'add_toolbar_items'], 100);
		add_action('admin_menu', [$this, 'add_tool_link_to_demo']);
	}

	public function add_tool_link_to_demo () {
		global $submenu;
		global $wp;

		$permalink = add_query_arg([
			'sitedemo'=>'browser'
		], home_url( $wp->request ));
		$submenu['tools.php'][] = array( 'Site Demo', 'manage_options', $permalink );
	}

	public function add_toolbar_items($admin_bar){
		global $wp;

		$admin_bar->add_menu( array(
			'id'    => 'website-demo',
			'title' => 'Site Demo',
			'href'  => '#',
			'meta'  => array(
				'title' => __('Site Demo'),
			),
		));
		$admin_bar->add_menu( array(
			'id'    => 'template-browser',
			'parent' => 'website-demo',
			'title' => 'Browser mockup',
			'href'  => add_query_arg([
				'sitedemo'=>'browser'
			], home_url( $wp->request )),
		));
		$admin_bar->add_menu( array(
			'id'    => 'template-mobile',
			'parent' => 'website-demo',
			'title' => 'Mobile mockup',
			'href'  => add_query_arg([
				'sitedemo'=>'mobile'
			], home_url( $wp->request )),
		));
	}

	public function apply_template( $template ) {
		global $wp;

		if ( is_admin() ) {
			return $template;
		}

		if ( empty( $_GET['sitedemo'] ) ) {
			return $template;
		}

		$template_to_use = in_array( $_GET['sitedemo'], self::TEMPLATES ) ? $_GET['sitedemo'] : self::TEMPLATES[0];

		set_query_var( 'sitedemo_url', home_url( $wp->request ) );

		$template_path = sprintf( '%s/templates/%s.php',
			$this->plugin_dir_path,
			$template_to_use
		);

		return $template_path;
	}

	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
			self::$instance->setup();
		}

		return self::$instance;
	}

	public function plugin_data() {
		if ( empty( $this->plugin_data ) ) {
			if ( ! function_exists( 'get_plugin_data' ) ) {
				require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			}

			$this->plugin_data = get_plugin_data( __FILE__ );
		}

		return $this->plugin_data;
	}

}

function Sitedemo() {
	return Sitedemo::instance();
}

Sitedemo();
