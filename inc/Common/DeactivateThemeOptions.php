<?php
/**
 * @package  getwebThemeOption
 */
namespace Getweb\Common;

class DeactivateThemeOptions
{
	public static function DeactivateThemeOptionsFlash() {
		flush_rewrite_rules();
	}
}