<?php
/*
Plugin Name: Shopp Customer Accounts
Description: Customer Sign-Up System for Shopp.
Author: Tyson LT
Version: 0.9.2
*/

//NOTE: this was split from a wholesale plugin, so please excuse the weird class names.

define('SWS_DEBUG', true);

/**
 * Full path to plugin file.
 * @var string
 */
define('SWS_PLUGIN_FILE', __FILE__);

/**
 * Full path to plugin directory.
 * @var string
 */
define('SWS_ABSPATH',	dirname(__FILE__).'/');

/**
 * The main plugin object.
 *
 * @var ShoppWholesale
 */
global $ShoppWholesale;

/**
 * Instantiate main class.
 */
require_once("classes/ShoppWholesale.php");
$ShoppWholesale = new ShoppWholesale();
$ShoppWholesale->init();

/*
TODO: email validation using activation token (use password change code in Customer.php?)
TODO: allow user to choose a username instead of email address
*/