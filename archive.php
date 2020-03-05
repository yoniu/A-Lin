<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>


<div class="a-left" id="main" role="main">
	<div class="a-list-top a-flex a-flex-a-c a-flex-j-s">
		<div class="a-list-title a-title"><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s'),
            'search'    =>  _t('关键字 %s'),
            'tag'       =>  _t('标签 %s'),
            'author'    =>  _t('%s 的文章')
        ), '', ''); ?></div>
		<?php if ($this->options->sortId): ?><div id="a-sort-btn" class="a-list-sort a-flex a-flex-a-c"><?php sort_lists($this->options->sortId); ?></div><?php endif; ?>
	</div>
	<?php $this->need('echo_list.php'); ?>
</div><!-- end #main-->

	<?php $this->need('sidebar.php'); ?>
	<?php $this->need('footer.php'); ?>
