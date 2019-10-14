<?php/** * @package  getwebThemeOption */namespace Getweb\Common;class AjaxController {	public function register() {		add_action( 'wp_ajax_getweb_option_save_menu', array( &$this, 'getweb_option_menu_ajax_handler' ) );		add_action( 'wp_ajax_getweb_option_save_field', array( &$this, 'getweb_option_field_ajax_handler' ) );		add_action( 'wp_ajax_of_ajax_post_action', array( &$this, 'of_ajax_callback' ) );	}	function getweb_option_menu_ajax_handler() {		global $wpdb;		$getParam = isset( $_REQUEST['param'] ) ? $_REQUEST['param'] : '';		if ( ! empty( $getParam ) ) {			if ( $_REQUEST['param'] == "save_menu" ) {				$current_time = date( 'Y-m-d h:i:s a', time() );				$name         = isset( $_REQUEST['name'] ) ? $_REQUEST['name'] : "";				$status       = isset( $_REQUEST['status'] ) ? $_REQUEST['status'] : "";				$extra_class  = isset( $_REQUEST['extra_class'] ) ? $_REQUEST['extra_class'] : "";				$save_menu    = $wpdb->insert( getweb_menu_table(), array(					"name"        => $name,					"status"      => $status,					"extra_class" => $extra_class,					"created_at"  => $current_time,				) );				if ( $save_menu == 1 ) {					echo json_encode( array( "status" => 1, "msg" => "Your data has been successfully saved" ) );				} else {					echo json_encode( array( "status" => 2, "error" => "Something wrong, try again!" ) );				}			} elseif ( $_REQUEST['param'] == "edit_menu" ) {				$current_time = date( 'Y-m-d h:i:s a', time() );				$name         = isset( $_REQUEST['name'] ) ? $_REQUEST['name'] : "";				$status       = isset( $_REQUEST['status'] ) ? $_REQUEST['status'] : "";				$extra_class  = isset( $_REQUEST['extra_class'] ) ? $_REQUEST['extra_class'] : "";				$update_menu  = $wpdb->update( getweb_menu_table(), array(					"name"        => $name,					"status"      => $status,					"extra_class" => $extra_class,					"created_at"  => $current_time,				), array(					"id" => $_REQUEST['edit_menu'],				) );				if ( $update_menu == 1 ) {					echo json_encode( array( "status" => 1, "msg" => "Your data has been successfully updated" ) );				} else {					echo json_encode( array( "status" => 2, "error" => "Something wrong, try again!" ) );				}			} elseif ( $_REQUEST['param'] == "delete_menu" ) {				$delete = $wpdb->delete( getweb_menu_table(), array(					"id" => $_REQUEST['id'],				) );				if ( $delete ) {					$wpdb->delete( getweb_field_table(), array(						"menu_id" => $_REQUEST['id'],					) );				}				echo json_encode( array( "status" => 1, "msg" => "Your data has been successfully deleted" ) );			}		}		wp_die();	}	function getweb_option_field_ajax_handler() {		global $wpdb;		$getParam = isset( $_REQUEST['param'] ) ? $_REQUEST['param'] : '';		if ( ! empty( $getParam ) ) {			if ( $_REQUEST['param'] == "save_field" ) {				$title                = isset( $_REQUEST['title'] ) ? $_REQUEST['title'] : "";				$desc                 = isset( $_REQUEST['description'] ) ? $_REQUEST['description'] : "";				$get_id               = isset( $_REQUEST['get_id'] ) ? $_REQUEST['get_id'] : "";				$default_value        = isset( $_REQUEST['default_value'] ) ? $_REQUEST['default_value'] : "";				$custom_class         = isset( $_REQUEST['custom_class'] ) ? $_REQUEST['custom_class'] : "";				$field_type           = isset( $_REQUEST['field_type'] ) ? $_REQUEST['field_type'] : "";				$menu_id              = isset( $_REQUEST['menu_id'] ) ? $_REQUEST['menu_id'] : "";				$status               = isset( $_REQUEST['status'] ) ? $_REQUEST['status'] : "";				$custom_taxonomy_name = isset( $_REQUEST['custom_taxonomy_name'] ) ? $_REQUEST['custom_taxonomy_name'] : "";				$custom_information = isset( $_REQUEST['custom_information'] ) ? $_REQUEST['custom_information'] : "";				$current_time         = date( 'Y-m-d h:i:s a', time() );				foreach ( $_POST['option_title'] as $key => $value ) {					if (!empty($value)){						$option_value_data[ $key ]['select_title'] = $value;					}else{						$option_value_data = null;					}				}				foreach ( $_POST['option_value'] as $key => $value ) {					if (!empty($value)){						$option_value_data[ $key ]['select_value'] = $value;					}else{						$option_value_data = null;					}				}				$save_field = $wpdb->insert( getweb_field_table(), array(					"title"         => $title,					"description"   => $desc,					"get_id"        => $get_id,					"default_value" => $default_value,					"custom_class"  => $custom_class,					"type"          => $field_type,					"more_values"   => json_encode( $option_value_data ),					"other"         => $custom_taxonomy_name,					"info"         => $custom_information,					"menu_id"       => $menu_id,					"status"        => $status,					"created_at"    => $current_time,				) );				if ( $save_field == 1 ) {					echo json_encode( array( "status" => 1, "msg" => "Your data has been successfully saved" ) );				} else {					echo json_encode( array( "status" => 2, "error" => "Something wrong, try again!" ) );				}			} elseif ( $_REQUEST['param'] == "edit_field" ) {				$title                = isset( $_REQUEST['title'] ) ? $_REQUEST['title'] : "";				$desc                 = isset( $_REQUEST['description'] ) ? $_REQUEST['description'] : "";				$get_id               = isset( $_REQUEST['get_id'] ) ? $_REQUEST['get_id'] : "";				$default_value        = isset( $_REQUEST['default_value'] ) ? $_REQUEST['default_value'] : "";				$custom_class         = isset( $_REQUEST['custom_class'] ) ? $_REQUEST['custom_class'] : "";				$field_type           = isset( $_REQUEST['field_type'] ) ? $_REQUEST['field_type'] : "";				$menu_id              = isset( $_REQUEST['menu_id'] ) ? $_REQUEST['menu_id'] : "";				$status               = isset( $_REQUEST['status'] ) ? $_REQUEST['status'] : "";				$custom_taxonomy_name = isset( $_REQUEST['custom_taxonomy_name'] ) ? $_REQUEST['custom_taxonomy_name'] : "";				$custom_information = isset( $_REQUEST['custom_information'] ) ? $_REQUEST['custom_information'] : "";				$current_time         = date( 'Y-m-d h:i:s a', time() );				foreach ( $_POST['option_title'] as $key => $value ) {					if (!empty($value)){						$option_value_data[ $key ]['select_title'] = $value;					}else{						$option_value_data = null;					}				}				foreach ( $_POST['option_value'] as $key => $value ) {					if (!empty($value)){						$option_value_data[ $key ]['select_value'] = $value;					}else{						$option_value_data = null;					}				}				$update_menu = $wpdb->update( getweb_field_table(), array(					"title"         => $title,					"description"   => $desc,					"get_id"        => $get_id,					"default_value" => $default_value,					"custom_class"  => $custom_class,					"type"          => $field_type,					"more_values"   => json_encode( $option_value_data ),					"other"         => $custom_taxonomy_name,					"info"         => $custom_information,					"menu_id"       => $menu_id,					"status"        => $status,					"created_at"    => $current_time,				), array(					"id" => $_REQUEST['edit_field'],				) );				if ( $update_menu == 1 ) {					echo json_encode( array( "status" => 1, "msg" => "Your data has been successfully updated" ) );				} else {					echo json_encode( array( "status" => 2, "error" => "Something wrong, try again!" ) );				}			} elseif ( $_REQUEST['param'] == "delete_field" ) {				$wpdb->delete( getweb_field_table(), array(					"id" => $_REQUEST['id'],				) );				echo json_encode( array( "status" => 1, "msg" => "Your data has been successfully delete" ) );			}		}		wp_die();	}	function of_ajax_callback()	{		$nonce=$_POST['security'];		if (! wp_verify_nonce($nonce, 'of_ajax_nonce') ) die('-1');		$all = of_get_options();		$save_type = $_POST['type'];		//Uploads		if($save_type == 'upload')		{			$clickedID = $_POST['data']; // Acts as the name			$filename = $_FILES[$clickedID];			$filename['name'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', $filename['name']);			$override['test_form'] = false;			$override['action'] = 'wp_handle_upload';			$uploaded_file = wp_handle_upload($filename,$override);			$upload_tracking[] = $clickedID;			//update $options array w/ image URL			$upload_image = $all; //preserve current data			$upload_image[$clickedID] = $uploaded_file['url'];			of_save_options($upload_image);			if(!empty($uploaded_file['error'])) {echo 'Upload Error: ' . $uploaded_file['error']; }			else { echo $uploaded_file['url']; } // Is the Response		}		elseif($save_type == 'image_reset')		{			$id = $_POST['data']; // Acts as the name			$delete_image = $all; //preserve rest of data			$delete_image[$id] = ''; //update array key with empty value			of_save_options($delete_image ) ;		}		elseif($save_type == 'backup_options')		{			$backup = $all;			$backup['backup_log'] = date('r');			of_save_options($backup, BACKUPS) ;			die('1');		}		elseif($save_type == 'restore_options')		{			$smof_data = of_get_options(BACKUPS);			of_save_options($smof_data);			die('1');		}		elseif($save_type == 'import_options'){			$smof_data = json_decode( stripslashes_deep( $_POST['data'] ), true);			of_save_options($smof_data);			die('1');		}		elseif ($save_type == 'save')		{			wp_parse_str(stripslashes($_POST['data']), $smof_data);			unset($smof_data['security']);			unset($smof_data['of_save']);			of_save_options($smof_data);			die('1');		}		elseif ($save_type == 'reset')		{			$defaults = array();			$stylesheet = get_option('stylesheet');			$option_mode = 'theme_mods_'.$stylesheet;			$option_mode_value = get_option($option_mode);			foreach ($option_mode_value as $key=>$val){				$defaults[$key] = $val;				unset($defaults['backup_log']);			}			of_save_options($defaults);			die('1'); //options reset		}		die();	}}