<?php 
/**
 * @package  getwebThemeOption
 */
namespace Getweb\Api\Callbacks;

use Getweb\Common\BaseController;

class OptionCallbacks extends BaseController
{
	public function adminDashboard()
	{
		return require_once( "$this->plugin_path/views/theme_options.php" );
	}
	public function menu_view()
	{
		return require_once( "$this->plugin_path/views/menu_view.php" );
	}
	public function menu_new()
	{
		return require_once( "$this->plugin_path/views/menu_new.php" );
	}
	public function menu_edit()
	{
		return require_once( "$this->plugin_path/views/menu_edit_view.php" );
	}

	public function field_view()
	{
		return require_once( "$this->plugin_path/views/field_view.php" );
	}
	public function field_new()
	{
		return require_once( "$this->plugin_path/views/field_new.php" );
	}
	public function field_edit()
	{
		return require_once( "$this->plugin_path/views/field_edit_view.php" );
	}

}