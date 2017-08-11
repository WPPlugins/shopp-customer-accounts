<?php
	global $ShoppWholesale;
	$Controller = $ShoppWholesale->Admin->Controller;

	$_page_title = $Controller->getAdminPageTitle();
	$_icon_src = $Controller->getAdminPageIcon();
?>

<div class="wrap shopp">

	<!-- wordpress update message -->
	<?php if (isset($_REQUEST['updated'])): ?><div id="message" class="updated fade"><p>Shopp Wholesale settings saved.</p></div><?php endif; ?>

	<!-- specific controller message -->
	<?php require_once('messages.php'); ?>

	<div style="background: url('<?php echo $_icon_src; ?>')"></div>
	<h2><img src="<?php echo $_icon_src; ?>" /> <?php ShoppWholesale::_e($_page_title); ?> </h2>

		<?php
			$Controller->printNavigationLinks();
			$Controller->printFormTag();
		?>
