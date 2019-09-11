<?php if(!empty($_SESSION['flash'])) : ?>
<div class="alert <?=esc_attr($_SESSION['flash_class'])?>" role="alert"> 
	<?=esc($_SESSION['flash'])?> 
</div>
<?php unset($_SESSION['flash']); ?>
<?php endif; ?>