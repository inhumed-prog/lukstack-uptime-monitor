=== LukStack Uptime Monitor ===
Contributors: lukmeyer
Donate link: https://paypal.me/LukMeyer030
Tags: monitoring, uptime, ssl, alerts, webhook
Requires at least: 5.8
Tested up to: 6.9
Requires PHP: 7.4
Stable tag: 2.0.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Monitor multiple websites for uptime, performance, and SSL certificate expiration. Get instant alerts via email, Slack, or Discord when issues occur.

== Description ==

LukStack Uptime Monitor is a lightweight yet powerful website monitoring solution built for agencies, freelancers, and web professionals who manage multiple websites.

Track uptime, response times, and SSL certificate expiration for all your client sites from a single WordPress dashboard. When something goes wrong, you will know immediately through email notifications or webhook integrations with Slack, Discord, and other services.

= Key Features =

* **Uptime Monitoring** - Automatic checks every 5 minutes to detect downtime
* **Response Time Tracking** - Monitor server performance with millisecond precision
* **SSL Certificate Monitoring** - Get warned before certificates expire
* **Email Alerts** - Receive notifications when a site goes down or recovers
* **Webhook Support** - Native integration with Slack, Discord, Microsoft Teams, and generic webhooks
* **Per-Site Notifications** - Set different alert recipients for each website
* **Manual Checks** - Test any site instantly with one click
* **Uptime Statistics** - Track reliability over time with uptime percentages
* **Dashboard Widget** - Quick status overview right on your WordPress dashboard
* **Clean Dashboard** - See the status of all your sites at a glance

= Who Is This For? =

* **Web Agencies** managing client websites
* **Freelancers** maintaining multiple projects
* **Site Owners** who want peace of mind
* **DevOps Teams** needing a simple monitoring solution

= How It Works =

1. Add a website URL to monitor
2. LukStack Uptime Monitor checks the site every 5 minutes
3. If the site goes down or returns an error, you get notified
4. When the site recovers, you get a recovery notification

= Webhook Integrations =

LukStack Uptime Monitor automatically formats notifications for popular services:

* **Slack** - Rich message attachments with color-coded severity
* **Discord** - Embedded messages with status information
* **Microsoft Teams** - Via generic webhook connector
* **Zapier / Make** - JSON payload for custom automations

= Privacy =

LukStack Uptime Monitor only stores the URLs you choose to monitor and their status data. No personal information is collected or transmitted to external servers except for the webhook notifications you configure.

== External services ==

This plugin connects to external services as part of its core monitoring functionality. Below is a description of each service, what data is sent, and when.

= Monitored Websites =

LukStack Uptime Monitor sends HTTP requests to the website URLs you add for monitoring. This is the core functionality of the plugin and is required to check uptime and response times. An SSL connection on port 443 is also made to check the SSL certificate expiration date for HTTPS sites. These requests are sent automatically every 5 minutes (via WordPress Cron) and when you manually click "Check now". The data sent is a standard HTTP GET request with a custom user agent header. No personal data is transmitted.

= Slack (optional) =

If you configure a Slack webhook URL in the plugin settings, LukStack Uptime Monitor sends POST requests to the Slack Incoming Webhooks API when a monitored site changes status (goes down, recovers, or has SSL issues). The data sent includes the website URL, its status, response time, and a timestamp. No personal data is transmitted.

This service is provided by Slack Technologies, LLC / Salesforce, Inc.
Terms of Service: https://slack.com/terms-of-service
Privacy Policy: https://slack.com/privacy-policy

= Discord (optional) =

If you configure a Discord webhook URL in the plugin settings, LukStack Uptime Monitor sends POST requests to the Discord Webhooks API when a monitored site changes status. The data sent includes the website URL, its status, response time, and a timestamp. No personal data is transmitted.

This service is provided by Discord, Inc.
Terms of Service: https://discord.com/terms
Privacy Policy: https://discord.com/privacy

= Generic Webhooks (optional) =

You may configure any third-party webhook URL (e.g. Microsoft Teams, Zapier, Make, or a custom endpoint). When a monitored site changes status, a POST request with a JSON payload is sent to that URL. The data sent includes the website URL, its status, response time, and a timestamp. No personal data is transmitted. Please refer to the terms of service and privacy policy of the respective service you configure.

== Installation ==

= Automatic Installation =

1. Go to Plugins > Add New in your WordPress admin
2. Search for "LukStack Uptime Monitor"
3. Click "Install Now" and then "Activate"

= Manual Installation =

1. Download the plugin ZIP file
2. Go to Plugins > Add New > Upload Plugin
3. Select the ZIP file and click "Install Now"
4. Activate the plugin

= After Activation =

1. Go to LukStack Uptime Monitor in the admin menu
2. Add your first website URL
3. (Optional) Configure webhook notifications in Settings
4. Click "Check now" to verify monitoring is working

== Frequently Asked Questions ==

= How often are websites checked? =

By default, all websites are checked every 5 minutes using WordPress Cron.

= Can I change the check interval? =

The current version uses a fixed 5-minute interval. Custom intervals will be available in a future update.

= Why does my site show as DOWN when it is actually online? =

This can happen if:

* Your site blocks automated requests or specific user agents
* A firewall or security plugin is blocking the monitoring server
* The site requires authentication
* There are geographic restrictions

Try adding your monitoring server IP to any whitelist or firewall rules.

= Will this slow down my WordPress site? =

No. The monitoring checks run in the background via WordPress Cron and do not affect your site frontend performance.

= Can I monitor non-WordPress sites? =

Yes. LukStack Uptime Monitor can monitor any publicly accessible website, regardless of the platform.

= How do I set up Slack notifications? =

1. Create an Incoming Webhook in your Slack workspace
2. Copy the webhook URL
3. Paste it into LukStack Uptime Monitor > Settings > Webhook URL
4. Click "Send Test Notification" to verify

= How do I set up Discord notifications? =

1. Go to your Discord server settings
2. Navigate to Integrations > Webhooks
3. Create a new webhook and copy the URL
4. Paste it into LukStack Uptime Monitor > Settings > Webhook URL

= What does the SSL monitoring do? =

LukStack Uptime Monitor checks the SSL certificate of HTTPS sites and tracks the expiration date. You will receive warnings when a certificate is within 30 days of expiring, with critical alerts at 7 days.

= Why are automatic checks not running? =

WordPress Cron only runs when someone visits your site. If your site has low traffic, checks may be delayed. For reliable monitoring, set up a real server cron job. See the Help page in the plugin for instructions.

= Can I monitor localhost or internal sites? =

No. For security reasons, localhost (127.0.0.1) and private IP ranges are blocked from monitoring.

= Is there a limit to how many sites I can monitor? =

There is no hard limit. However, monitoring many sites from a shared hosting environment may cause performance issues. For large-scale monitoring, consider using a VPS or dedicated server.

= Does this plugin send any data externally? =

The plugin only makes outbound requests to:

* The websites you choose to monitor (to check their status)
* Your configured webhook URL (to send notifications)

No data is sent to the plugin developer or any third parties.

== Screenshots ==

1. Main dashboard showing all monitored websites with status, response time, SSL info, and uptime
2. Adding a new website to monitor
3. Settings page with webhook configuration
4. Dashboard widget with quick status overview
5. Discord notification example
6. Slack notification example
7. Help and documentation page

== Changelog ==

= 2.0.2 =
* Fixed critical timezone mismatch causing monitoring checks to run every ~70 minutes instead of every 5 minutes
* Fixed XSS vulnerability in webhook test response handling
* Improved SSRF protection with DNS rebinding prevention
* Fixed database format string mismatch in status update function
* Improved SQL security with prepared statements and esc_like() for all queries
* Removed redundant nonce/capability checks in AJAX helper function
* Consolidated statistics queries from 5 separate queries into 1 for better performance

= 2.0.1 =
* Added Dashboard Widget for quick website status overview
* Improved responsive design with 3 breakpoints (1024px, 782px, 600px)
* Improved mobile card-style table layout
* Improved cron locking with atomic database-based approach
* Improved code quality (variable naming, CSS organization)

= 2.0.0 =
* Initial public release
* Uptime monitoring with 5-minute intervals
* Response time tracking
* SSL certificate expiration monitoring
* Email notifications for status changes
* Webhook support for Slack, Discord, and generic endpoints
* Per-site notification email configuration
* Manual check functionality
* Bulk check all sites
* Uptime percentage tracking
* Comprehensive help documentation
* Full internationalization support

== Upgrade Notice ==

= 2.0.2 =
Critical fix: monitoring checks now run at the correct 5-minute interval. Security improvements including XSS and SSRF fixes. Recommended update for all users.

= 2.0.1 =
New Dashboard Widget, improved responsive design, and better cron reliability with atomic locking.

= 2.0.0 =
Initial release of LukStack Uptime Monitor. Start monitoring your websites today.

== Additional Information ==

= Requirements =

* WordPress 5.8 or higher
* PHP 7.4 or higher
* PHP extensions: curl, openssl, json

= Support =

For support questions, please use the WordPress.org support forum for this plugin.

= Credits =

Developed by Luk Meyer.
