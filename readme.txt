=== Shopp Customer Accounts ===
Contributors: tysonlt
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=BJQ6ZNN4JVAZL
Tags: shopp,account,customer,signup
Requires at least: 3.0.0
Tested up to: 3.0.5
Stable tag: 0.9.2

Allows customers to request an account without making an initial purchase.

== Description ==

This plugin allows customers to request a customer account. It integrates closely with the 
standard Shopp workflow and interface, so customers will have a smooth experience.

All requests are held in a queue pending approval from an administrator. Alternatively, you
can set an option to immediately approve all new requests.

Customers will be notified by email when their accounts are approved or rejected. The email messages
can be modified from within the admin area.

NOTE: this is an initial release. Please review known issues in the FAQ section.

== Installation ==

1. Upload the contents of this zip file to your `/wp-content/plugins/' folder, or use the built-in Plugin upload tool.
1. Activate the plugin through the 'Plugins' menu in WordPress.

== Frequently Asked Questions ==

= How do I display the customer registration form? =

Using the shortcode. Please view the Help section in the Account Requests menu, location in the Shopp admin area.

= How can I change the layout of the form? =

Use the Wordpress plugin editor to edit the customer-signup.php file in the plugin's 'templates' directory.

= Where is the request queue and admin interface? =

Right in the Shopp menu. Look for 'Account Requests'.

= Do I have to approve all requests? Can't I just give them an account? =

Sure. Just turn on this option in the settings section.

= What are the known issues? =

This plugin is currently not compatible with the Shopp USPS shipping module.  

== Changelog ==

= 0.9.2 =
* Minor changes to signup template.
* Documentation updates.

= 0.9.1 =
* Uninstallation option

= 0.9 =
* Documentation update

= 0.8 =
* Initial release