<?php
/**
 * Plugin Update Checker for Shaqi ACF Repeater
 *
 * Requires: https://github.com/YahnisElsts/plugin-update-checker
 */

if (!defined('ABSPATH')) exit;

// Include Plugin Update Checker library
if (!class_exists('YahnisElsts\PluginUpdateChecker\v5\PucFactory')) {
    require __DIR__ . '/plugin-update-checker/plugin-update-checker.php';
}

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

// Absolute path to main plugin file
$main_plugin_file = plugin_dir_path(__DIR__) . 'shaqi-acf-repeater.php';

// GitHub repo URL and branch
$repo_url = 'https://github.com/rajaishtiaq6/shaqi-acf-repeater';
$branch = 'main';

// Initialize update checker
$update_checker = PucFactory::buildUpdateChecker(
    $repo_url,        // GitHub repository URL
    $main_plugin_file, // Path to main plugin file
    'shaqi-acf-repeater' // Plugin slug
);

// Set the branch to watch for updates
$update_checker->setBranch($branch);

// Optional: Force SSL verify to true (recommended)
// $update_checker->getVcsApi()->setAuthenticationToken(null); // If private repo, add GitHub token
