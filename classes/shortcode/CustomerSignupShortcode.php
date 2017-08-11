<?php

require_once("AbstractShortcode.php");

/**
 * Customer sign-up.
 *
 * @author Tyson
 */
class CustomerSignupShortcode extends AbstractShortcode {

	private $Controller;

	/**
	 * Constructor.
	 */
	public function __construct() {
		parent::__construct();
		global $ShoppWholesale;
		$this->Controller = $ShoppWholesale->Admin->getController('accounts');
		$this->initActions();
	}
	
	/**
	 * Add actions.
	 */
	private function initActions() {
		add_action('wp', array($this, 'frontEndScripts'));
	}

	/**
	 * Print scripts required for the form.
	 */
	function frontEndScripts() {
		shopp_enqueue_script('checkout');
	}

	/**
	 * The actual shortcode string.
	 *
	 * Can return an array of shortcodes, they will all be mapped.
	 */
	protected function getShortcode() {
		return array('shopp-customer-registration-form', 'reg-form');
	}

	/**
	 * The default attributes.
	 */
	protected function getDefaultAttributes() {
		global $ShoppWholesale;
		return array(
			'type' => $ShoppWholesale->Settings->get('default-account-request-customer-type'),	
			'role' => $ShoppWholesale->Settings->get('default-account-request-role'),
		);
	}

	/**
	 * Return help for each attribute.
	 */
	public function getAttributeDescriptions() {
		return array(
			'type'=>'The Shopp customer type to assign to the new customer.',
			'role'=>'If using wordpress-integrated accounts, set the role of the new account.'
		);
	}
	
	/**
	 * Handle the shortcode call.
	 *
	 * @param array $input The shortcode attributes, with defaults added.
	 */
	protected function handle(array $input) {

		//look for submit
		if (isset($_REQUEST[ShoppWholesale::SUBMIT_KEY])) {

			$request = array_merge($input, $_REQUEST);
			
			//process data
			if (false === $this->Controller->createAccountRequest($request)) {
				return $this->displayForm($request);
			}

		} else {

			//show form
			return $this->displayForm($input);

		}

	}

	/**
	 * Display the order form.
	 *
	 * @param $blank_variation
	 */
	protected function displayForm($args) {
		
		global $Shopp;
		global $ShoppWholesale;
		
		echo '<div id="shopp">';
		add_storefrontjs("var d_pm = ''; var pm_cards = {}, paycards = {};", true);
		if ($Shopp->Errors->exist(SHOPP_COMM_ERR)) include(SHOPP_TEMPLATES."/errors.php");
		require_once($ShoppWholesale->getTemplatePath("customer-signup.php"));
		echo '</div>';
		
	}

}

?>