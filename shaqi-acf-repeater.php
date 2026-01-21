<?php
/*
Plugin Name: ACF Repeater Field
Plugin Slug: shaqi-acf-repeater
Plugin URI: https://github.com/rajaishtiaq6/shaqi-acf-repeater
Description: This Add-on adds a repeater field type for the Advanced Custom Fields plugin
Version: 1.0.2
Author: Ishtiaq Ahmed
Author URI: https://github.com/rajaishtiaq6
Requires at least: 6.0
Tested up to: 6.9
Requires PHP: 7.4
Requires Plugins: advanced-custom-fields
Text Domain: shaqi-acf-repeater
License: GPLv2
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly


require plugin_dir_path(__FILE__) . 'plugin-update-checker/plugin-update-checker.php';

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

if (!class_exists('acf_plugin_repeater')) :

class acf_plugin_repeater
{
	// vars
	var $settings;
	// vars
	var $version;

	function __construct()
	{
		// vars - Don't use __() in constructor to avoid early translation loading
		$this->settings = array(
			// basic
			'name'				=> 'Advanced Custom Fields: Repeater Field',
			'version'			=> '1.0.0',
			// urls
			'slug'				=> dirname(plugin_basename(__FILE__)),
			'basename'			=> plugin_basename(__FILE__),
			'path'				=> plugin_dir_path(__FILE__),
			'dir'				=> plugin_dir_url(__FILE__),

		);

		// include v5 field
		add_action('acf/include_field_types', array($this, 'include_field_types'));
		// include v4 field
		add_action('acf/register_fields', array($this, 'include_field_types'));

		add_action('admin_enqueue_scripts', array($this, 'acf_repeater_input_admin_enqueue_scripts'));
		add_action( 'acf/field_group/admin_enqueue_scripts', array($this, 'acf_repeater_localize') );
	}



	function acf_repeater_localize() {
		acf_localize_data(
			array(
				'PROFieldTypes' => []
			)
		);
	}


	function include_file($file = '')
	{
		$file = dirname(__FILE__) . '/' . $file;
		if (file_exists($file)) include_once($file);
	}


	function include_field_types()
	{

		if (defined('ACF_VERSION')) {
			if (version_compare(ACF_VERSION, '6.7', '>=')) {
				$this->version = '6-7';
			} elseif (version_compare(ACF_VERSION, '6.2', '>=')) {
				$this->version = '6-2';
			} elseif (version_compare(ACF_VERSION, '5.7.0', '>=')) {
				$this->version = '5-7';
			} else {
				$this->version = '5-0';
			}
		} else {
			$this->version = '5-0';
		}
		$this->include_file("includes/$this->version/acf-repeater-field.php");

		if ($this->version == '6-2' || $this->version == '6-7') {
			$this->include_file("includes/$this->version/class-acf-repeater-table.php");
		}
	}

	function acf_repeater_input_admin_enqueue_scripts()
	{
		// register acf scripts - with version and footer parameter
		wp_register_script('acf-input-repeater-js', $this->settings['dir'] . 'includes/' . $this->version . '/input.js', array('acf-input'), $this->settings['version'], true);
		wp_register_style('acf-input-repeater-css', $this->settings['dir'] . 'includes/' . $this->version . '/input.css', array('acf-input'), $this->settings['version']);

		// scripts
		wp_enqueue_script(array(
			'acf-input-repeater-js',
		));

		// styles
		wp_enqueue_style(array(
			'acf-input-repeater-css',
		));
	}
}



$myUpdateChecker = PucFactory::buildUpdateChecker(
	'https://github.com/rajaishtiaq6/shaqi-acf-repeater',
	__FILE__,
	'shaqi-acf-repeater'
);

//Set the branch that contains the stable release.
$myUpdateChecker->setBranch('main');

//Optional: If you're using a private repository, specify the access token like this:
// $myUpdateChecker->setAuthentication('your-token-here');



// globals
global $acf_plugin_repeater;

// instantiate
$acf_plugin_repeater = new acf_plugin_repeater();

// end class
endif;
