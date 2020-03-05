<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div class="a-left" id="main" role="main">
	<div class="a-list-top a-flex a-flex-a-c a-flex-j-s">
		<div class="a-list-title a-title">404</div>
		<?php if ($this->options->sortId): ?><div id="a-sort-btn" class="a-list-sort a-flex a-flex-a-c"><?php sort_lists($this->options->sortId); ?></div><?php endif; ?>
	</div>
	<div class="a-article-none a-m-3">
	<?php _e('没有找到内容'); ?>
	</div>
</div><!-- end #main-->
	<?php $this->need('sidebar.php'); ?>
	<?php $this->need('footer.php'); ?>
