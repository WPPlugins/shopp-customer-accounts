<?php

require_once("IAdminSettingsPrinter.php");

class AdminSettingsRegister {

	private $SettingsPrinter;

	/**
	 * Constructor.
	 */
	public function __construct(IAdminSettingsPrinter $SettingsPrinter = null) {
		if (null == $SettingsPrinter) {
			$Help = new Help();
			$SettingsPrinter = new DefaultAdminSettingsPrinter($Help);
		}
		$this->SettingsPrinter = $SettingsPrinter;
		$this->initActions();
	}

	/**
	 * Get default settings.
	 */
	public function getDefaults() {
		return $this->defaults;
	}

	/**
	 * Initialise wp actions.
	 */
	private function initActions() {
		add_action('admin_init', array($this, 'registerSettings'));
	}

	/**
	 * Register settings.
	 */
	function registerSettings() {

		global $wp_roles;
		global $ShoppWholesale;

		//main option
		register_setting(ShoppWholesale::OPTION_GROUP, ShoppWholesale::OPTION_NAME, array($this, 'validate'));

		///ACCOUNTS
		$lookup = Lookup::customer_types();
		$customer_types = array_combine($lookup, $lookup); //use text value for key and value
		$role_options = array_merge(array(ShoppWholesale::WP_DEFAULT_ROLE=>'(Wordpress Default Role)'), $wp_roles->get_names());
		
		$section = 'shopp-wholesale-account-settings';
		
		$this->addSettingsSection($section, 'Account Request Settings');
		$this->addSelectField($section, 'default-account-request-role', 'Default Role', $role_options);
		$this->addSelectField($section, 'default-account-request-customer-type', 'Default Customer Type', $customer_types);
		$this->addCheckboxField($section, 'prevent-duplicate-customers', 'Duplicate Customers', 'Do not allow duplicate customer accounts (based on email)');
		$this->addCheckboxField($section, 'require-approval', 'Moderate Requests', 'All account requests must be approved by an administrator.');

		$this->addTextField($section, 'approval-subject', 'Approval Subject', array('style'=>'width:365px'));
		$this->addTextAreaField($section, 'approval-email', 'Approval Message', array('rows'=>7, 'cols'=>60));
		$this->addTextField($section, 'rejection-subject', 'Rejection Subject', array('style'=>'width:365px'));
		$this->addTextAreaField($section, 'rejection-email', 'Rejection Message', array('rows'=>7, 'cols'=>60));

		$section = 'shopp-wholesale-account-shortcode-help';
		$this->addSettingsSection($section, 'Shortcode Reference');
		$shortcodes = array();
		$ShoppWholesale->loadShortcodes($shortcodes);
		foreach ($shortcodes as $name => $shortcode) {
			$this->addHtml($section, $name, $shortcode->getHelp());
		}
		
	}

	/**
	 * Validate settings.
	 *
	 * @param $data
	 */
	function validate($data) {
		return $data;
	}

	/**
	 * Add a settings section.
	 *
	 * @param $section_name
	 * @param $section_title
	 */
	function addSettingsSection($section_name, $section_title) {
		add_settings_section($section_name, $section_title, array($this->SettingsPrinter, 'printSection'), $section_name);
	}

	/**
	 * Convenience method for checkbox fields.
	 *
	 * @param $section_name
	 * @param $setting_name
	 * @param $setting_title
	 */
	function addCheckboxField($section_name, $setting_name, $setting_title, $checkbox_text) {
		$this->addSettingsField($section_name, $setting_name, $setting_title, array($this->SettingsPrinter, 'printCheckboxField'), array('checkbox_text'=>$checkbox_text));
	}


	/**
	 * Convenience method for text fields.
	 *
	 * @param $section_name
	 * @param $setting_name
	 * @param $setting_title
	 */
	function addTextField($section_name, $setting_name, $setting_title, $args = array()) {
		$this->addSettingsField($section_name, $setting_name, $setting_title, array($this->SettingsPrinter, 'printTextField'), $args);
	}

	/**
	 * Add plain HTML.
	 * 
	 * @param $section_name
	 * @param $html
	 */
	function addHtml($section_name, $title, $html) {
		$this->addSettingsField($section_name, null, $title, array($this->SettingsPrinter, 'printHtml'), array('html'=>$html));
	}
	
	/**
	 * Convenience method for textarea fields.
	 *
	 * @param $section_name
	 * @param $setting_name
	 * @param $setting_title
	 */
	function addTextAreaField($section_name, $setting_name, $setting_title, $args = array()) {
		$this->addSettingsField($section_name, $setting_name, $setting_title, array($this->SettingsPrinter, 'printTextAreaField'), $args);
	}
	
	
	/**
	 * Convenience method for select fields.
	 *
	 * @param $section_name
	 * @param $setting_name
	 * @param $setting_title
	 */
	function addSelectField($section_name, $setting_name, $setting_title, $choices) {
		$this->addSettingsField($section_name, $setting_name, $setting_title, array($this->SettingsPrinter, 'printSelectField'), $choices);
	}

	/**
	 * Add a settings field.
	 *
	 * @param $section_name
	 * @param $setting_name
	 * @param $setting_title
	 * @param $callback
	 * @param $args
	 */
	function addSettingsField($section_name, $setting_name, $setting_title, $callback, $args = array()) {
		if (!is_array($args)) $args = array();
		$args['name'] = $setting_name;
		add_settings_field($setting_name, $setting_title, $callback, $section_name, $section_name, $args);
	}

}

?>