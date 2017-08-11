<?php

/**
 * Settings and constants.
 *
 * @author Tyson
 */
class ShoppWholesaleSettings {

	private static $instance;

	private $defaults = array(
		'require-approval' => 'on',
		'prevent-duplicate-customers' => 'on',
		'default-account-request-role' => ShoppWholesale::WHOLESALE_ACCOUNT_ROLE,
		'default-account-request-customer-type' => ShoppWholesale::SHOPP_WHOLESALE_CUSTOMER_TYPE,
		'approval-subject' => 'Customer account application successful',
		'rejection-subject' => 'Customer account application not successful',
		'approval-email' => 'Dear {firstname},

Your account request has been approved. You may now log in to {site} using {email} as your username.

Regards,
{site}',
		'rejection-email' => 'Dear {firstname},

We regret to inform you that your account request has not been approved. If you wish to discuss this further, please contact us.

Regards,
{site}'
	);

	/**
	 * Get an option value
	 * @param $name
	 */
	public function get($name) {
		$options = get_option(ShoppWholesale::OPTION_NAME);
		if (!isset($options[$name])) {
			$options[$name] = $this->defaults[$name];
		}
		return $options[$name];
	}

	/**
	 * Write default options to the database.
	 */
	public function install() {
		add_option(ShoppWholesale::OPTION_NAME, $this->defaults);
	}

	/**
	 * Validate callback for option forms.
   *
	 * @param array $input
	 */
	public function validate(array $input) {
		return $input;
	}

	/**
	 * Prevent cloning.
	 */
	public function __clone() {}

		/**
	 * Singleton factory method.
	 */
	public static function getInstance() {
		if (!isset(self::$instance)) {
    	$c = __CLASS__;
      self::$instance = new $c;
    }
    return self::$instance;
	}

}

?>