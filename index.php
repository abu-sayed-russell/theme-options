<?php/** * @package  getwebThemeOption *//*Plugin Name: Theme OptionsPlugin URI: https://getwebinc.comDescription: Awesome Theme Options Plugin.Add option field dynamically.Version: 1.0.0Author: R S RUSSELLAuthor URI: https://facebook.com/with.rain79License: GPLv2Text Domain: getweb*/if (!defined('ABSPATH'))	exit;define( 'GETWEB_OPTION_VERSION', '1.0' );define( 'BACKUPS','backups' );$theme_version = '';$theme_s = '';$theme_data = wp_get_theme();$theme_version = $theme_data['Version'];$theme_name = $theme_data['Name'];$theme_uri = $theme_data['ThemeURI'];$author_uri = $theme_data['AuthorURI'];// Require once the Composer Autoloadif ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {	require_once dirname( __FILE__ ) . '/vendor/autoload.php';}include('inc/Helper/helper.php');/** * The code that runs during plugin activation */function activate_option_plugin() {	Getweb\Common\ActivateThemeOptions::ActivateThemeOptionsFlash();}register_activation_hook( __FILE__, 'activate_option_plugin' );/** * The code that runs during plugin deactivation */function deactivate_option_plugin() {	Getweb\Common\DeactivateThemeOptions::DeactivateThemeOptionsFlash();}register_deactivation_hook( __FILE__, 'deactivate_option_plugin' );/** * The code that runs during plugin active to create table */function create_options_table() {	Getweb\Common\TableController::option_table();}register_activation_hook(__FILE__, 'create_options_table' );/** * Initialize all the core classes of the plugin */if ( class_exists( 'Getweb\\Getweb' ) ) {	Getweb\Getweb::registerServices();}function of_get_options($key = null, $data = null) {	global $smof_data;	do_action('of_get_options_before', array(		'key'=>$key, 'data'=>$data	));	if ($key != null) { // Get one specific value		$data = get_theme_mod($key, $data);	} else { // Get all values		$data = get_theme_mods();	}	$data = apply_filters('of_options_after_load', $data);	if ($key == null) {		$smof_data = $data;	} else {		$smof_data[$key] = $data;	}	do_action('of_option_setup_before', array(		'key'=>$key, 'data'=>$data	));	return $data;}function of_save_options($data, $key = null) {	global $smof_data;	if (empty($data))		return;	do_action('of_save_options_before', array(		'key'=>$key, 'data'=>$data	));	$data = apply_filters('of_options_before_save', $data);	if ($key != null) { // Update one specific value		if ($key == BACKUPS) {			unset($data['smof_init']); // Don't want to change this.		}		set_theme_mod($key, $data);	} else { // Update all values in $data		foreach ( $data as $k=>$v ) {			if (!isset($smof_data[$k]) || $smof_data[$k] != $v) { // Only write to the DB when we need to				set_theme_mod($k, $v);			} else if (is_array($v)) {				foreach ($v as $key=>$val) {					if ($key != $k && $v[$key] == $val) {						set_theme_mod($k, $v);						break;					}				}			}		}	}	do_action('of_save_options_after', array(		'key'=>$key, 'data'=>$data	));}add_action('wp_ajax_of_ajax_post_action', 'of_ajax_callback');function of_ajax_callback(){	global $options_machine;	$nonce=$_POST['security'];	if (! wp_verify_nonce($nonce, 'of_ajax_nonce') ) die('-1');	//get options array from db	$all = of_get_options();	$save_type = $_POST['type'];	//Uploads	if($save_type == 'upload')	{		$clickedID = $_POST['data']; // Acts as the name		$filename = $_FILES[$clickedID];		$filename['name'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', $filename['name']);		$override['test_form'] = false;		$override['action'] = 'wp_handle_upload';		$uploaded_file = wp_handle_upload($filename,$override);		$upload_tracking[] = $clickedID;		//update $options array w/ image URL		$upload_image = $all; //preserve current data		$upload_image[$clickedID] = $uploaded_file['url'];		of_save_options($upload_image);		if(!empty($uploaded_file['error'])) {echo 'Upload Error: ' . $uploaded_file['error']; }		else { echo $uploaded_file['url']; } // Is the Response	}	elseif($save_type == 'image_reset')	{		$id = $_POST['data']; // Acts as the name		$delete_image = $all; //preserve rest of data		$delete_image[$id] = ''; //update array key with empty value		of_save_options($delete_image ) ;	}	elseif($save_type == 'backup_options')	{		$backup = $all;		$backup['backup_log'] = date('r');		of_save_options($backup, BACKUPS) ;		die('1');	}	elseif($save_type == 'restore_options')	{		$smof_data = of_get_options(BACKUPS);		of_save_options($smof_data);		die('1');	}	elseif($save_type == 'import_options'){		$smof_data = json_decode( stripslashes_deep( $_POST['data'] ), true);		of_save_options($smof_data);		die('1');	}	elseif ($save_type == 'save')	{		wp_parse_str(stripslashes($_POST['data']), $smof_data);		unset($smof_data['security']);		unset($smof_data['of_save']);		of_save_options($smof_data);		die('1');	}	elseif ($save_type == 'reset')	{		of_save_options($options_machine->Defaults);		getweb_generate_options_css($options_machine->Defaults);		die('1'); //options reset	}	die();}/** * For use in themes * * @since forever */$data = of_get_options();if (!isset($smof_details))	$smof_details = array();if( ! function_exists( 'getweb_generate_options_css' ) ) {	function getweb_generate_options_css($newdata) {		$data = $newdata;		$GLOBALS["amz_option_data"] = $data;		$uploads = wp_upload_dir();		$css_dir = GETWEB_ADMIN . '/_css/';		WP_Filesystem();		global $wp_filesystem;		$my_theme = wp_get_theme();		$theme_name = strtolower( str_replace( array(' ','.'), array('-',''), $my_theme->get( 'Name' ) ) );		$pix_uploads_dir = $wp_filesystem->find_folder( $uploads['basedir'] );		$pix_uploads_dir .= $theme_name . '/' ;		/* directory didn't exist, so let's create it */		if( ! $wp_filesystem->is_dir( $pix_uploads_dir ) ) {			$wp_filesystem->mkdir( $pix_uploads_dir );		}		@chmod( $css_dir, 0755 );		@chmod( $css_dir . 'dynamic-css.php', 0664 );		/** Capture CSS output **/		ob_start();		require($css_dir . 'dynamic-css.php');		$css = str_replace(array("\r\n", "\r", "\n", "\t", "  "),'',trim(ob_get_clean()));		set_theme_mod( 'to_last_saved_time', time() );		if ( ! defined( 'FS_CHMOD_FILE' ) ) {			define( 'FS_CHMOD_FILE', ( 0644 & ~ umask() ) );		}		/** Write to options.css file **/		if ( ! $wp_filesystem->put_contents( $pix_uploads_dir . 'custom.css', $css, FS_CHMOD_FILE ) ) {			return true;		}	}}