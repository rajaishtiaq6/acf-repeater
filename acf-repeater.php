<?php
/*
Plugin Name: ACF Repeater Field
Plugin Slug: acf-repeater
Plugin URI: https://github.com/rajaishtiaq6/acf-repeater
Description: This Add-on adds a repeater field type for the Advanced Custom Fields plugin
Version: 2.1.1
Author: Ishtiaq Ahmed
Author URI: https://github.com/rajaishtiaq6
License: GPL
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

if (!class_exists('acf_plugin_repeater')) :

class acf_plugin_repeater
{
	// vars
	var $settings;
	// vars
	var $version;

	function __construct()
	{
		// vars
		$this->settings = array(
			// basic
			'name'				=> __('Advanced Custom Fields: Repeater Field', 'acf'),
			'version'			=> '2.1.1',
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
			$this->version = '4-0';
		}
		$this->include_file("includes/$this->version/acf-repeater-field.php");

		if ($this->version == '6-2' || $this->version == '6-7') {
			$this->include_file("includes/$this->version/class-acf-repeater-table.php");
		}
	}

	function acf_repeater_input_admin_enqueue_scripts()
	{
		// register acf scripts
		wp_register_script('acf-input-repeater-js', $this->settings['dir'] . 'includes/' . $this->version . '/input.js', array('acf-input'), $this->settings['version']);
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


// globals
global $acf_plugin_repeater;

// instantiate
$acf_plugin_repeater = new acf_plugin_repeater();

// end class
endif;
