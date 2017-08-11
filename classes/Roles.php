<?php

/**
 * Handles roles and permissions.
 *
 * @author Tyson
 */
class Roles {

	/**
	 * Install wholesale-related roles.
	 */
	public function install() {

		global $wp_roles;

		if(!$wp_roles) {
			$wp_roles = new WP_Roles();
		}

		//add wholesale edit role to admin
		$wp_roles->add_cap('administrator', ShoppWholesale::WHOLESALE_SETTINGS_CAPABILITY);

		//add wholesale edit role to every role that currently has 'shopp_settings' cap
		foreach($wp_roles->get_names() as $role_name) {
			$role = &$wp_roles->get_role($role_name);
			if (null != $role && $role->has_cap('shopp_settings')) {
				$role->add_cap(ShoppWholesale::WHOLESALE_SETTINGS_CAPABILITY);
			}
		}

	}

}

/**
 * Convenience function.
 */
function shopp_user_is_wholesale() {
	return Roles::isUserWholesale();
}

?>