<?php
/**
 * Settings page view template
 */

if (!defined('ABSPATH')) {
	exit;
}
?>

<div class="wrap lukstack-wrap">
	<h1>LukStack Uptime Monitor – Settings</h1>

	<?php if ($error_message): ?>
		<div class="notice notice-error is-dismissible">
			<p><strong>Error:</strong> <?php echo esc_html($error_message); ?></p>
		</div>
	<?php endif; ?>

	<?php if ($success_message): ?>
		<div class="notice notice-success is-dismissible">
			<p><?php echo esc_html($success_message); ?></p>
		</div>
	<?php endif; ?>

	<form method="post">
		<?php wp_nonce_field('lukstack_settings'); ?>
		<table class="form-table">
			<tr>
				<th><label for="webhook_url">Webhook URL</label></th>
				<td>
					<input type="url"
						   name="webhook_url"
						   id="webhook_url"
						   class="regular-text"
						   value="<?php echo esc_attr($webhook_url); ?>"
						   placeholder="https://hooks.slack.com/services/...">
					<p class="description">
						Optional: Send alerts to a webhook URL (Slack, Discord, Teams, etc.)<br>
						Leave empty to disable webhook notifications.
					</p>
				</td>
			</tr>
		</table>
		<button class="button button-primary" name="save_settings" type="submit">
			Save Settings
		</button>
	</form>

	<hr>

	<h2>Test Webhook</h2>
	<p>Send a test notification to verify your webhook is working correctly:</p>

	<?php if (empty($webhook_url)): ?>
		<p class="description" style="color: #dc3232;">
			<strong>No webhook URL configured.</strong> Please save a webhook URL above before testing.
		</p>
	<?php endif; ?>

	<button class="button"
			id="test-webhook"
			type="button"
		<?php echo empty($webhook_url) ? 'disabled' : ''; ?>>
		Send Test Notification
	</button>
	<div id="webhook-test-result" style="margin-top: 10px;"></div>
</div>