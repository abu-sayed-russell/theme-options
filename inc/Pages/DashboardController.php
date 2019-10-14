<?php 
/**
 * @package  getwebThemeOption
 */
namespace Getweb\Pages;

use Getweb\Api\SettingsApi;
use Getweb\Common\BaseController;
use Getweb\Api\Callbacks\OptionCallbacks;

class DashboardController extends BaseController
{
	public $settings;

	public $callbacks;

	public $pages = array();

	public function register()
	{
		$this->settings = new SettingsApi();

		$this->callbacks = new OptionCallbacks();

		$this->setPages();

		$this->settings->addPages( $this->pages )->withSubPage( 'Theme Options' )->register();
	}

	public function setPages() 
	{
		$this->pages = array(
			array(
				'page_title' => 'Theme Option',
				'menu_title' => 'Theme Option',
				'capability' => 'manage_options', 
				'menu_slug' => 'getweb_theme_options',
				'callback' => array( $this->callbacks, 'adminDashboard' ), 
				'icon_url' => 'dashicons-tickets', 
				'position' => 110
			)
		);
	}
}