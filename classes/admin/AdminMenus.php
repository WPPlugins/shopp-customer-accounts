<?php

/**
 * Sets up the admin menus.
 *
 * @author Tyson
 */
class AdminMenus {

	/**
	 * Registered menus.
	 * 
	 * @var array
	 */
	public $menus = array();
	
	private $Controller;
	
	/**
	 * Constructor.
	 */
	public function __construct() {
		global $ShoppWholesale;
		$this->Controller = $ShoppWholesale->Admin;
		$this->initActions();
	}

	/**
	 * Initialise wp actions.
	 */
	private function initActions() {
		add_action('admin_menu', array($this, 'initAdminMenu'), 100); //init after shopp menus
	}

	/**
	 * Install our admin menu.
	 */
	function initAdminMenu() {

		$accounts_hook = $this->addMenu('accounts', ShoppWholesale::SHOPP_MENU_ROOT);
		$this->addMenu('account-review', $accounts_hook);
		$this->addMenu('account-settings', $accounts_hook);
		$this->addMenu('account-shortcode-help', $accounts_hook);

		//reorder menus
		$this->sendToBottom('Settings');

	}

	/**
	 * Add a menu.
	 *
	 * @param $name
	 * @param $parent_hook
	 * @return The new hook.
	 */
	function addMenu($name, $parent_hook = ShoppWholesale::SHOPP_MENU_ROOT, $title='Customer Account Requests', $menu='Account Requests') {

		//add menu
		$hook = add_submenu_page(
			$parent_hook,
			$title,
			$menu,
			apply_filters('sws-admin-capability', 'shopp_settings_wholesale', $name),
			'shopp-wholesale-'.$name,
			array($this->Controller, 'displayAdminPage')
		);

		$this->menus[$name] = $title;

		//get help
		if (null != $this->Help) {
			$help = $this->Help->getAdminScreenContextualHelp($hook);
			if (false !== $help) {
				add_contextual_help($hook, $help);
			}
		}

		return $hook;

	}

	/**
	 * Put our submenu where we want it.
	 */
	function sendToBottom($title) {

		global $submenu;

		//do some sneaky re-ordering
		$shopp_menu = &$submenu['shopp-orders'];
		foreach ($shopp_menu as $index => $menu) {
			if ($title == $menu[0]) {
				break;
			}
		}

		$item = $shopp_menu[$index];
		unset($shopp_menu[$index]);
		array_push($shopp_menu, $item);

	}

}

?>