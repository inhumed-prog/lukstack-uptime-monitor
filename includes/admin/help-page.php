<?php
/**
 * Help & Info page controller
 */

if (!defined('ABSPATH')) {
	exit;
}

/**
 * Render help page
 */
function lukstack_help_page() {
	// Security check
	lukstack_verify_admin_access();

	// Simply include the view
	include LUKSTACK_PLUGIN_DIR . 'includes/admin/views/help-page-view.php';
}