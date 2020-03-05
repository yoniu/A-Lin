<?php
	if (!defined('__TYPECHO_ROOT_DIR__')) exit;
	$this->need('header.php');
	$praise_cookie = @$_COOKIE['yoniu_praise_'.$this->cid];
?>
<div class="a-left a-single" id="main" role="main">
    <div class="a-post">
		<div class="a-post-info a-flex a-flex-a-c">
			<span style="display: none;"><?php get_post_view($this); ?> 次阅读</span>
			<span><?php $this->date('Y-m-d'); ?></span>
		</div>
        <div class="a-title a-m-t-2 a-m-b-2"><?php $this->title() ?></div>
		<div class="a-post-icon a-flex a-flex-a-c a-flex-j-s a-p-b-2 a-b-l">
			<div class="a-flex a-flex-a-c">
				<div class="a-m-r-2"><a id="a-post-text" href="JavaScript:;" title="加大文章字体"><i class="fa fa-font"></i></a></div>
				<div class="a-m-r-2"><a id="a-post-copy" href="JavaScript:;" title="复制文章地址"><i class="fa fa-link"></i></a></div>
				<div class="a-m-r-2"><a id="a-post-share" href="JavaScript:;" title="分享文章"><i class="fa fa-share-square-o"></i></a></div>
			</div>
			<div class="a-post-praise"><a id="a-post-praise" data-yoniu-praise="<?php echo $this->cid; ?>"<?php if($praise_cookie=="true") echo ' class="a-praise"'; ?> href="JavaScript:;"><i class="fa fa-heart"></i></a><span>（<?php get_post_praise($this); ?>）</span></div>
		</div>
        <div class="a-post-content a-m-t-3 a-m-b-3">
            <?php $this->content(); ?>
        </div>
        <div class="a-post-tags a-flex a-flex-wrap"><?php $this->tags('', true); ?></div>
		<div class="a-post-diy">
		    <?php 
				if (!empty($this->options->diy_html)){
					echo $this->options->diy_html;
				}else{?>
					本文为作者<a href="<?php $this->author->permalink(); ?>"><?php $this->author(); ?></a>发布，未经允许禁止转载！
<?php
				}
			?>
		</div>
    </div>
    <?php $this->need('comments.php'); ?>
</div><!-- end #main-->
<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>
