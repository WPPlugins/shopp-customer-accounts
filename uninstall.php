<?php
	
	if(!defined('WP_UNINSTALL_PLUGIN')) {
		wp_die("Do not access this file directly.");
	}
	
	//drop tables
	global $wpdb;
	require_once('classes/ShoppWholesale.php');
	$table = $wpdb->prefix . ShoppWholesale::TABLE_PREFIX . ShoppWholesale::CUSTOMER_QUEUE_TABLE;
	$wpdb->query("drop table {$table}" );
	
	//delete options
	delete_option('sws-settings');
	delete_option('sws_plugin_version');
	 
?>