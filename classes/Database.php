<?php

/**
 * Handles database functions.
 *
 * @author Tyson
 */
class Database {

	/**
	 * Install SWS database fields.
	 */
	public function install() {

		require_once(ABSPATH . "wp-admin/includes/upgrade.php");

		global $wpdb;

		$user_queue_table = $this->tablename(ShoppWholesale::CUSTOMER_QUEUE_TABLE);
		$replace = array("{prefix}" => $wpdb->prefix);
		$sql_dir = SWS_ABSPATH . "sql";

		//customer request queue
		if (!maybe_create_table($user_queue_table, $this->loadSqlTemplate("$sql_dir/create-customer-queue.sql", $replace))) {
			$this->fail();
		}

		//clear shopp schema cache
		$wpdb->update($wpdb->prefix ."shopp_setting", array("value"=>""), array("name"=>"data_model"));

		//add our plugin version
		add_option("sws_plugin_version", ShoppWholesale::PLUGIN_VERSION);

	}

	/**
	 * Build full SWS tablename.
	 * @param $table
	 */
	public function tablename($table) {
		global $wpdb;
		return $wpdb->prefix . ShoppWholesale::TABLE_PREFIX . $table;
	}

	/**
	 * Load a file and replace tokens.
	 *
	 * @param $filename
	 * @param $replace
	 */
	private function loadSqlTemplate($filename, array $replace = array(), $throw = false) {

		if (!file_exists($filename)) {
			if ($throw) {
				throw new Exception("File does not exist: $filename", null);
			} else {
				return false;
			}
		}

		$contents = file_get_contents($filename);
		if ('' == trim($contents)) {
			if ($throw) {
				throw new Exception("File is empty: $filename", null);
			} else {
				return false;
			}
		}

		return str_ireplace(array_keys($replace), array_values($replace), $contents);

	}

	/**
	 * Fail.
	 *
	 * @throws ShoppWholesaleException
	 */
	private function fail() {
		throw new ShoppWholesaleException('There was a problem creating the required database tables. Plugin can not be activated.');
	}

}