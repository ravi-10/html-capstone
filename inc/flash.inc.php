<?php if(!empty($_SESSION['flash'])) : ?>
	<p><?=$_SESSION['flash']?></p>
	<?php unset($_SESSION['flash']); ?>
<?php endif; ?>