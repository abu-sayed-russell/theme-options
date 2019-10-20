<?php
/**
 * @package  getwebPlugin
 */

namespace Getweb\Common;

use Getweb\Common\BaseController;

class ThemeOptionEnqueue extends BaseController {
	public function register() {
		add_action( 'admin_enqueue_scripts', array( $this, 'theme_enqueue' ) );
	}

	function theme_enqueue() {
		$slug          = "";
		$page_includes = array( "getweb_option_menus", "getweb_new_menu", "getweb_edit_menu", "getweb_new_field", "getweb_option_fileds", "getweb_edit_field" );
		$option_page   = array( "getweb_theme_options" );
		$menu_page     = array( "getweb_option_menus", "getweb_new_menu", "getweb_edit_menu" );
		$field_page    = array( "getweb_new_field", "getweb_option_fileds", "getweb_edit_field" );
		$currentPage   = $_GET['page'];

		if ( in_array( $currentPage, $page_includes ) ) {
			//Style
			wp_enqueue_style( "getweb-options-style", $this->plugin_url . 'assets/css/option-style.css', '', GETWEB_OPTION_VERSION );
			wp_enqueue_style( "getweb-options-bootstrap-css", $this->plugin_url . 'assets/css/bootstrap.min.css', '', GETWEB_OPTION_VERSION );
			wp_enqueue_style( "getweb-options-datatables-css", $this->plugin_url . 'assets/css/datatables.min.css', '', GETWEB_OPTION_VERSION );
			//Jquery
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( "getweb-options-js", $this->plugin_url . 'assets/js/jquery.min.js', '', GETWEB_OPTION_VERSION, true );
			wp_enqueue_script( "getweb-options-bootstrap-js", $this->plugin_url . 'assets/js/bootstrap.min.js', '', GETWEB_OPTION_VERSION, true );
			wp_enqueue_script( "getweb-options-datatables", $this->plugin_url . 'assets/js/datatables.min.js', '', GETWEB_OPTION_VERSION, true );
			wp_enqueue_script( "getweb-options-main-js", $this->plugin_url . 'assets/js/main.js', '', GETWEB_OPTION_VERSION, true );
			wp_enqueue_media();
		}
		if ( in_array( $currentPage, $menu_page ) ) {
			wp_enqueue_style( "getweb-options-icon", $this->plugin_url . 'assets/css/icon.css', '', GETWEB_OPTION_VERSION );
			wp_enqueue_style( "getweb-options-fonts", $this->plugin_url . 'assets/css/font-awesome.min.css', '', GETWEB_OPTION_VERSION );
			wp_enqueue_script( "menu-ajax", $this->plugin_url . 'assets/js/menu-ajax.js', '', GETWEB_OPTION_VERSION, true );
		}
		if ( in_array( $currentPage, $field_page ) ) {
			wp_enqueue_script( "field-ajax", $this->plugin_url . 'assets/js/field-ajax.js', '', GETWEB_OPTION_VERSION, true );
		}
		if ( in_array( $currentPage, $option_page ) ) {
			wp_enqueue_script( 'jquery' );
			wp_register_style( 'getweb-options-fonts', $this->plugin_url . 'assets/css/font-awesome.min.css', array(), '1.0', 'all' );
			wp_enqueue_style( 'getweb-options-fonts' );
			wp_enqueue_style( 'admin-style', $this->plugin_url . 'assets/options/css/admin-style.css' );
			wp_enqueue_style( 'jquery-ui-custom-admin', $this->plugin_url . 'assets/options/css/jquery-ui-custom.css' );
			if ( ! wp_style_is( 'wp-color-picker', 'registered' ) ) {
				wp_register_style( 'wp-color-picker', $this->plugin_url . 'assets/options/css/color-picker.min.css' );
			}
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_style( 'jquery-alpha-color-picker', $this->plugin_url . 'assets/options/css/alpha-color-picker.css', array( 'wp-color-picker' ) );
			// enqueue all our scripts
			wp_enqueue_script( 'media-upload' );
			wp_enqueue_media();
			if ( function_exists( 'wp_enqueue_media' ) ) {
				wp_enqueue_media();
			}
			wp_enqueue_script( 'jquery-ui-core' );
			wp_enqueue_script( 'jquery-ui-sortable' );
			wp_enqueue_script( 'jquery-ui-slider' );
			wp_enqueue_script( 'jquery-input-mask', $this->plugin_url . 'assets/options/js/jquery.maskedinput-1.2.2.js', array( 'jquery' ) );
			wp_enqueue_script( 'tipsy', $this->plugin_url . 'assets/options/js/jquery.tipsy.js', array( 'jquery' ) );
			wp_enqueue_script( 'cookie', $this->plugin_url . 'assets/options/js/cookie.js', 'jquery' );
			wp_enqueue_script( 'getweb', $this->plugin_url . 'assets/options/js/getweb.js', array( 'jquery' ) );
			wp_enqueue_script( 'options-ajax', $this->plugin_url . 'assets/options/js/options-ajax.js', array( 'jquery' ) );


			// Enqueue colorpicker scripts for versions below 3.5 for compatibility
			if ( ! wp_script_is( 'wp-color-picker', 'registered' ) ) {
				wp_register_script( 'iris', $this->plugin_url . 'assets/options/js/iris.min.js', array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ), false, 1 );
				wp_register_script( 'wp-color-picker', $this->plugin_url . 'assets/options/js/color-picker.min.js', array( 'jquery', 'iris' ) );
			}

			wp_enqueue_script( 'media-upload' );
			wp_enqueue_script( 'wp-color-picker' );

			wp_enqueue_script(
				'alpha-color-picker',
				$this->plugin_url . 'assets/options/js/alpha-color-picker.js',
				array( 'jquery', 'wp-color-picker' ),
				null,
				true
			);
		}
	}
}