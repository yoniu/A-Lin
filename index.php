<?php
/**
 * 简约清新的个人博客主题
 * 
 * @package A-Lin
 * @author 小智
 * @version 1.0
 * @link http://www.yoniu.xyz
 */
 

// 日夜效果
if (@$_POST['yoniu_moonlight']=="on"){
	header("Access-Control-Allow-Origin: *");
	setcookie('yoniu_moonlight', 'on', time() + 31536000, '/');
	die;
}elseif (@$_POST['yoniu_moonlight']=="off"){
	header("Access-Control-Allow-Origin: *");
	setcookie('yoniu_moonlight', 'off', time() + 31536000, '/');
	die;
}

// 文章点赞
if (@$_POST['action'] == 'praise' && isset($_POST['id'])){
	header("Access-Control-Allow-Origin: *");
	_post_praise_init($_POST['id']);
	die;
}

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
 ?>

<div class="a-left" id="main" role="main">
	<div class="a-list-top a-flex a-flex-a-c a-flex-j-s">
		<div class="a-list-title a-title">最新文章</div>
		<?php if ($this->options->sortId): ?><div id="a-sort-btn" class="a-list-sort a-flex a-flex-a-c"><?php sort_lists($this->options->sortId); ?></div><?php endif; ?>
	</div>
	<?php $this->need('echo_list.php'); ?>
</div><!-- end #main-->

<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>
