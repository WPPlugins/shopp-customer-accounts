<?php	foreach ($Controller->getMessages('info') as $message): ?>
		<div id="message" class="updated fade"><p><?php echo $message; ?></p></div>
<?php endforeach; ?>

<?php	foreach ($Controller->getMessages('warn') as $message): ?>
		<div id="warning" class="error"><p>WARNING: <?php echo $message; ?></p></div>
<?php endforeach; ?>

<?php	foreach ($Controller->getMessages('error') as $message): ?>
		<div id="error" class="error"><p><?php echo $message; ?></p></div>
<?php endforeach; ?>