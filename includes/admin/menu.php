<?php
/**
 * Admin menu registration with proper localization
 */

if (!defined('ABSPATH')) {
	exit;
}

/**
 * Register admin menu
 */
add_action('admin_menu', 'lukstack_register_menu');

function lukstack_register_menu() {
	// Main menu
	$main_page = add_menu_page(
		__('LukStack Uptime Monitor', 'lukstack-uptime-monitor'),
		__('LukStack', 'lukstack-uptime-monitor'),
		'manage_options',
		'lukstack-uptime-monitor',
		'lukstack_main_page',
		'dashicons-visibility',
		26
	);

	// Settings submenu
	$settings_page = add_submenu_page(
		'lukstack-uptime-monitor',
		__('Settings', 'lukstack-uptime-monitor'),
		__('Settings', 'lukstack-uptime-monitor'),
		'manage_options',
		'lukstack-settings',
		'lukstack_settings_page'
	);

	// Help submenu
	$help_page = add_submenu_page(
		'lukstack-uptime-monitor',
		__('Help & Info', 'lukstack-uptime-monitor'),
		__('Help & Info', 'lukstack-uptime-monitor'),
		'manage_options',
		'lukstack-help',
		'lukstack_help_page'
	);

	// Load assets only on our pages
	add_action('load-' . $main_page, 'lukstack_load_admin_assets');
	add_action('load-' . $settings_page, 'lukstack_load_admin_assets');
	add_action('load-' . $help_page, 'lukstack_load_admin_assets');

	// Load settings script only on settings page
	add_action('load-' . $settings_page, 'lukstack_load_settings_assets');
}

/**
 * Load admin assets (called on page load)
 */
function lukstack_load_admin_assets() {
	add_action('admin_enqueue_scripts', 'lukstack_enqueue_admin_assets');
}

/**
 * Load settings assets (called on settings page load)
 */
function lukstack_load_settings_assets() {
	add_action('admin_enqueue_scripts', 'lukstack_enqueue_settings_assets');
}

/**
 * Enqueue settings page assets
 */
function lukstack_enqueue_settings_assets() {
	wp_enqueue_script(
		'lukstack-settings',
		LUKSTACK_PLUGIN_URL . 'assets/js/settings.js',
		array('jquery', 'lukstack-admin'),
		LUKSTACK_VERSION,
		true
	);
}

/**
 * Enqueue admin assets
 */
function lukstack_enqueue_admin_assets() {
	// CSS
	wp_enqueue_style(
		'lukstack-admin',
		LUKSTACK_PLUGIN_URL . 'assets/css/admin.css',
		array(),
		LUKSTACK_VERSION
	);

	// JavaScript
	wp_enqueue_script(
		'lukstack-admin',
		LUKSTACK_PLUGIN_URL . 'assets/js/admin.js',
		array('jquery'),
		LUKSTACK_VERSION,
		true
	);

	// Localize script with translations and settings
	wp_localize_script('lukstack-admin', 'LukStack', array(
		'ajax_url' => admin_url('admin-ajax.php'),
		'nonce' => wp_create_nonce('lukstack_nonce'),
		'debug' => defined('WP_DEBUG') && WP_DEBUG,
		'i18n' => array(
			'checking' => __('Checking...', 'lukstack-uptime-monitor'),
			'checkNow' => __('Check now', 'lukstack-uptime-monitor'),
			'checked' => __('Checked', 'lukstack-uptime-monitor'),
			'deleting' => __('Deleting...', 'lukstack-uptime-monitor'),
			'deleteBtn' => __('Delete', 'lukstack-uptime-monitor'),
			'confirmDelete' => __('Are you sure you want to delete this website from monitoring?\n\nThis action cannot be undone.', 'lukstack-uptime-monitor'),
			'networkError' => __('Network error - please try again', 'lukstack-uptime-monitor'),
			'timeout' => __('Request timeout - website may be slow or down', 'lukstack-uptime-monitor'),
			'noSites' => __('No websites added yet. Add your first website above!', 'lukstack-uptime-monitor'),
			'success' => __('Success!', 'lukstack-uptime-monitor'),
			'error' => __('Error', 'lukstack-uptime-monitor')
		)
	));
}

/**
 * Add custom admin header
 */
add_action('in_admin_header', 'lukstack_admin_header');

function lukstack_admin_header() {
	$screen = get_current_screen();

	if (!$screen || strpos($screen->id, 'lukstack-uptime-monitor') === false) {
		return;
	}

	// Don't show duplicate header
	remove_all_actions('in_admin_header');
}

/**
 * Register admin AJAX actions
 */
add_action('admin_init', 'lukstack_register_ajax_actions');

function lukstack_register_ajax_actions() {
	// These are registered in ajax-handlers.php
	// This function exists for potential future use
}

/**
 * Add contextual help
 */
add_action('load-toplevel_page_lukstack-uptime-monitor', 'lukstack_add_contextual_help');

function lukstack_add_contextual_help() {
	$screen = get_current_screen();

	if (!$screen) {
		return;
	}

	// Overview tab
	$screen->add_help_tab(array(
		'id' => 'lukstack_overview',
		'title' => __('Overview', 'lukstack-uptime-monitor'),
		'content' => sprintf(
			'<p>%s</p><p>%s</p>',
			__('LukStack Uptime Monitor helps you track the uptime and performance of multiple websites from one dashboard.', 'lukstack-uptime-monitor'),
			sprintf(
				__('For more detailed information, visit the %s page.', 'lukstack-uptime-monitor'),
				'<a href="' . esc_url(admin_url('admin.php?page=lukstack-help')) . '">' . __('Help & Info', 'lukstack-uptime-monitor') . '</a>'
			)
		)
	));

	// Quick start tab
	$screen->add_help_tab(array(
		'id' => 'lukstack_quickstart',
		'title' => __('Quick Start', 'lukstack-uptime-monitor'),
		'content' => sprintf(
			'<ol><li>%s</li><li>%s</li><li>%s</li></ol>',
			__('Enter a website URL (must start with http:// or https://)', 'lukstack-uptime-monitor'),
			__('Optionally add an email address for notifications', 'lukstack-uptime-monitor'),
			__('Click "Add Website" to start monitoring', 'lukstack-uptime-monitor')
		)
	));

	// Sidebar
	$screen->set_help_sidebar(
		'<p><strong>' . __('For More Information:', 'lukstack-uptime-monitor') . '</strong></p>' .
		'<p><a href="' . esc_url(admin_url('admin.php?page=lukstack-help')) . '">' . __('Documentation', 'lukstack-uptime-monitor') . '</a></p>' .
		'<p><a href="https://wordpress.org/support/plugin/lukstack-uptime-monitor/" target="_blank">' . __('Support', 'lukstack-uptime-monitor') . '</a></p>'
	);
}