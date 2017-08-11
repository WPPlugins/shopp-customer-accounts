<?php

require_once("Database.php");
require_once("Help.php");
require_once("IInitializable.php");
require_once("Roles.php");
require_once("ShoppWholesaleSettings.php");
require_once("Util.php");
require_once("admin/ShoppWholesaleAdmin.php");
require_once("shortcode/CustomerSignupShortcode.php");
require_once("exception/ShoppWholesaleException.php");

/**
 * Plugin main class.
 *
 * @author Tyson
 */
class ShoppWholesale implements IInitializable {

	const PLUGIN_VERSION								= '1.0';
	const SUBMIT_KEY 										= '_sws_submit';
	const BULK_SUBMIT_KEY								= '_sws_bulk_submit';
	const EMPTY_VID 										= 'NIL';
	const ACTIVATION_ERROR 							= '_sws_activation_error';
	const OPTION_GROUP 									= 'sws-options';
	const OPTION_NAME 									= 'settings';
	const CUSTOMER_QUEUE_TABLE					= 'customer_queue';
	const CUSTOMER_QUEUE_META_CONTEXT		= 'sws-cust-queue';
	const I18N 													= 'Shopp-Wholesale';
	const TABLE_PREFIX									= 'sws_';
	const HELP_DIR 											= 'help/';
	const HELP_QUICK_DIR 								= 'quick/';
	const HELP_MANUAL_DIR 							= 'manual/';
	const SHOPP_MENU_ROOT 							= 'shopp-orders';
	const WP_DEFAULT_ROLE								= 'wp_default';
	const WHOLESALE_ACCOUNT_ROLE 				= 'shopp-wholesale-account';
	const WHOLESALE_ACCOUNT_ROLE_LABEL 	= 'Wholesale Account';
	const WHOLESALE_ACCOUNT_CAPABILITY 	= 'shopp_wholesale';
	const WHOLESALE_SETTINGS_CAPABILITY = 'shopp_settings_wholesale';
	const SHOPP_WHOLESALE_CUSTOMER_TYPE = 'Wholesale';
	const DATETIME_FORMAT								= 'd M Y, h:i a';

	public $Admin;
	public $Settings;
	public $Roles;
	public $Help;
	public $Database;
	public $shortcodes = array();
	
	/**
	 * Init.
	 */
	public function init() {

		//make sure we are activated ok
		$this->checkActivationErrors();

		//create main objects
		$this->Settings = ShoppWholesaleSettings::getInstance();
		$this->Admin = new ShoppWholesaleAdmin();
		$this->Roles = new Roles();
		$this->Help = new Help();
		$this->Database = new Database();

		//call initializables
		$this->callInitializables();
		$this->initActions();
		$this->loadShortcodes($this->shortcodes);
_de($this->shortcodes);		

	}

	/**
	 * Check for activation error messages and exits if any are found.
	 */
	private function checkActivationErrors() {
		if ('error_scrape' == $_GET['action']) {
			$error = get_option(ShoppWholesale::ACTIVATION_ERROR);
			deactivate_plugins(plugin_basename(SWS_PLUGIN_FILE));
		  delete_option(ShoppWholesale::ACTIVATION_ERROR);
		  die("<div id='message' class='error'><p>$error</p></div>");
		}
	}

	/**
	 * Call late init on those objects that need it.
	 */
	private function callInitializables() {
		foreach (get_object_vars($this) as $Object) {
			if ($Object instanceof IInitializable) {
				$Object->init();
			}
		}
	}

	/**
	 * Find and init shortcodes.
	 */
	public function loadShortcodes(&$shortcode_list) {
		$sc = 'Shortcode.php';
		$a = "Abstract$sc";
		$dir = dirname(__FILE__) .'/shortcode';
		$handle = dir($dir);
		while (false !== ($d = $handle->read())) {
	  	if ($a != $d && $sc == substr($d, strlen($d) - strlen($sc))) {
				require_once("$dir/$d");
				$c = substr($d, 0, strlen($d) - strlen('.php'));;
				$o = new $c();
	  		$shortcode_list[$o->getTitle()] = $o;
	  	}
		}
	}

	/**
	 * Add action hooks.
	 */
	private function initActions() {
		register_activation_hook(SWS_PLUGIN_FILE, array($this, 'activatePlugin'));
	}

	/**
	 * Show admin notices.
	 */
	function adminNotices() {
		//not impl yet
	}

	/**
	 * Activation tasks.
	 */
	function activatePlugin() {

		try {

			//deactivate if Shopp not active
			if (!is_plugin_active("shopp/Shopp.php")) {
				throw new ShoppWholesaleException("This plugin requires the Shopp plugin to be installed and activated.");
			}

			//init database
			$this->Database->install();

			//setup roles
			$this->Roles->install();

			//write default options
			$this->Settings->install();

		} catch (Exception $e) {

			//add error message to admin header
			add_option(ShoppWholesale::ACTIVATION_ERROR, $e->getMessage());
			trigger_error('', E_USER_ERROR);
			wp_die();

		}

	}

	/**
	 * Get the path to this template file.
	 * 
	 * @param $file
	 */
	public function getTemplatePath($file) {
		//TODO: allow option to install template into theme
		return self::absPath('templates/'. $file);
	}
	
	/**
	 * Absolute path of this plugin.
	 *
	 * Appends the $file name if supplied.
	 */
	public static function absPath($file = false) {
		return dirname(SWS_PLUGIN_FILE).'/'.$file;
	}

	/**
	 * Translate function.
	 *
	 * @param $text
	 */
	public static function __($text) {
		return __($text, self::I18N);
	}

	/**
	 * Translate function.
	 *
	 * @param $text
	 */
	public static function _e($text) {
		return _e($text, self::I18N);
	}

}
