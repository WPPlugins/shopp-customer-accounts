<form action="<?php shopp("customer", "registration-form"); ?>" method="post" class="shopp validate" id="customer">

<ul>
	<li>
		<p><label for="firstname"><?php _e('Contact Information','Shopp'); ?></label></p>
		<span><?php shopp('customer','firstname','required=true&minlength=2&size=8&title='.__('First Name','Shopp')); ?><label for="firstname"><?php _e('First','Shopp'); ?></label></span>
		<span><?php shopp('customer','lastname','required=true&minlength=3&size=14&title='.__('Last Name','Shopp')); ?><label for="lastname"><?php _e('Last','Shopp'); ?></label></span>
		<span><?php shopp('customer','company','size=22&title='.__('Company/Organization','Shopp')); ?><label for="company"><?php _e('Company/Organization','Shopp'); ?></label></span>
	</li>
	<li>
	</li>
	<li>
		<span><?php shopp('customer','phone','format=phone&size=15&title='.__('Phone','Shopp')); ?><label for="phone"><?php _e('Phone','Shopp'); ?></label></span>
		<span><?php shopp('customer','email','required=true&format=email&size=30&title='.__('Email','Shopp')); ?>
		<label for="email"><?php _e('Email','Shopp'); ?></label></span>
	</li>
	<li>
		<span><?php shopp('customer','password','required=true&format=passwords&size=16&title='.__('Password','Shopp')); ?>
		<label for="password"><?php _e('Password','Shopp'); ?></label></span>
		<span><?php shopp('customer','confirm-password','required=true&format=passwords&size=16&title='.__('Password Confirmation','Shopp')); ?>
		<label for="confirm-password"><?php _e('Confirm Password','Shopp'); ?></label></span>
	</li>
	<li></li>
		<li class="half" id="billing-address-fields">
		<p><label for="billing-address"><?php _e('Billing Address','Shopp'); ?></label></p>
		<div>
			<?php shopp('customer','billing-address','required=true&title='.__('Billing street address','Shopp')); ?>
			<label for="billing-address"><?php _e('Street Address','Shopp'); ?></label>
		</div>
		<div>
			<?php shopp('customer','billing-xaddress','title='.__('Billing address line 2','Shopp')); ?>
			<label for="billing-xaddress"><?php _e('Address Line 2','Shopp'); ?></label>
		</div>
		<div class="left">
			<?php shopp('customer','billing-city','required=true&title='.__('City billing address','Shopp')); ?>
			<label for="billing-city"><?php _e('City','Shopp'); ?></label>
		</div>
		<div class="right">
			<?php shopp('checkout','billing-state','required=true&title='.__('State/Provice/Region billing address','Shopp')); ?>
			<label for="billing-state"><?php _e('State / Province','Shopp'); ?></label>
		</div>
		<div class="left">
			<?php shopp('customer','billing-postcode','required=true&title='.__('Postal/Zip Code billing address','Shopp')); ?>
			<label for="billing-postcode"><?php _e('Postal / Zip Code','Shopp'); ?></label>
		</div>
		<div class="right">
			<?php shopp('customer','billing-country','required=true&title='.__('Country billing address','Shopp')); ?>
			<label for="billing-country"><?php _e('Country','Shopp'); ?></label>
		</div>
		<div class="inline"><?php shopp('customer','same-shipping-address'); ?></div>
		</li>
		<li class="half right" id="shipping-address-fields">
			<p><label for="shipping-address"><?php _e('Shipping Address','Shopp'); ?></label></p>
			<div>
				<?php shopp('customer','shipping-address','required=true&title='.__('Shipping street address','Shopp')); ?>
				<label for="shipping-address"><?php _e('Street Address','Shopp'); ?></label>
			</div>
			<div>
				<?php shopp('customer','shipping-xaddress','title='.__('Shipping address line 2','Shopp')); ?>
				<label for="shipping-xaddress"><?php _e('Address Line 2','Shopp'); ?></label>
			</div>
			<div class="left">
				<?php shopp('customer','shipping-city','required=true&title='.__('City shipping address','Shopp')); ?>
				<label for="shipping-city"><?php _e('City','Shopp'); ?></label>
			</div>
			<div class="right">
				<?php shopp('checkout','shipping-state','required=true&title='.__('State/Provice/Region shipping address','Shopp')); ?>
				<label for="shipping-state"><?php _e('State / Province','Shopp'); ?></label>
			</div>
			<div class="left">
				<?php shopp('customer','shipping-postcode','required=true&title='.__('Postal/Zip Code shipping address','Shopp')); ?>
				<label for="shipping-postcode"><?php _e('Postal / Zip Code','Shopp'); ?></label>
			</div>
			<div class="right">
				<?php shopp('customer','shipping-country','required=true&title='.__('Country shipping address','Shopp')); ?>
				<label for="shipping-country"><?php _e('Country','Shopp'); ?></label>
			</div>
		</li>
	<li></li>
	<li></li>
	<li>
	<div class="inline"><label for="marketing"><?php shopp('customer','marketing','title='.__('','Shopp')); ?> <?php _e('Yes, I would like to receive e-mail updates and special offers!','Shopp'); ?></label></div>
	</li>
</ul>
<p class="submit"><input type="submit" name="<?php echo ShoppWholesale::SUBMIT_KEY; ?>" value="Submit Application"></p>

</form>