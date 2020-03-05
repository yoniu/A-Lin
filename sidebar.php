<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div class="a-right">

	
	<?php if (!empty($this->options->sidebarBlock) && in_array('ShowRecentPosts', $this->options->sidebarBlock)): ?>
	<div class="a-widget a-widget-tab">
		<div class="a-tab-list a-flex a-flex-j-s a-flex-a-c" <?php if (!empty($this->options->sidebarBlock) && in_array('ShowSidebarImg', $this->options->sidebarBlock)) echo 'style="background-image: url('.$this->options->themeUrl.'/img/gray-floral.png);"'; ?>>
			<a href="JavaScript:;" class="a-tab-hover" data-div="a-tab-hot">热门文章</a>
			<a href="JavaScript:;" data-div="a-tab-new">最新文章</a>
			<a href="JavaScript:;" data-div="a-tab-random">随机文章</a>
		</div>
		<div id="a-tab-hot" class="a-tab-div a-p-t-1 a-p-b-1" <?php if (!empty($this->options->sidebarBlock) && in_array('ShowSidebarImg', $this->options->sidebarBlock)) echo 'style="background-image: url('.$this->options->themeUrl.'/img/gray-floral.png);"'; ?>><?php _hot_posts(); ?></div>
		<div id="a-tab-new" class="a-tab-div a-p-t-1 a-p-b-1" <?php if (!empty($this->options->sidebarBlock) && in_array('ShowSidebarImg', $this->options->sidebarBlock)) echo 'style="background-image: url('.$this->options->themeUrl.'/img/gray-floral.png);"'; ?>>
<?php
$this->widget('Widget_Contents_Post_Recent','pageSize=5')->to($newcontents);
	while($newcontents->next()):?>
			<div class="a-div-list a-b-l a-m-t-1 a-m-l-2 a-m-r-2 a-p-b-1">
				<div class="a-div-title"><a href="<?php $newcontents->permalink() ?>" title="<?php $newcontents->title() ?>"> <?php $newcontents->title() ?> </a></div>
				<div class="a-flex a-flex-a-c">
					<div><?php echo date('Y-m-d', $newcontents->created); ?></div> 
					<div><?php get_post_view($newcontents); ?> Views</div> 
				</div>
			</div>
<?php endwhile; ?>
		</div>
		<div id="a-tab-random" class="a-tab-div a-p-t-1 a-p-b-1" <?php if (!empty($this->options->sidebarBlock) && in_array('ShowSidebarImg', $this->options->sidebarBlock)) echo 'style="background-image: url('.$this->options->themeUrl.'/img/gray-floral.png);"'; ?>><?php _random_posts(); ?></div>
	</div>
    <?php endif; ?>

    <?php if (!empty($this->options->sidebarBlock) && in_array('ShowRecentComments', $this->options->sidebarBlock)): ?>
    <div class="a-widget a-widget-comment a-m-t-3" <?php if (!empty($this->options->sidebarBlock) && in_array('ShowSidebarImg', $this->options->sidebarBlock)) echo 'style="background-image: url('.$this->options->themeUrl.'/img/stardust.png);"'; ?>>
		<div class="a-title"><?php _e('最近回复'); ?></div>
        <div class="a-widget-list">
        <?php $this->widget('Widget_Comments_Recent')->to($comments); ?>
        <?php while($comments->next()): ?>
            <div class="a-div-list a-flex a-b-l a-m-t-2 a-m-l-2 a-m-r-2 a-p-b-1">
				<div class="a-media-left">
					<?php $comments->gravatar(48); ?>
				</div>
				<div class="a-media-body">
					<div class="media-heading"><?php $comments->author(false); ?> ：</div>
					<a href="<?php $comments->permalink(); ?>"><?php $comments->excerpt(35, '...'); ?></a>
				</div>
			</div>
        <?php endwhile; ?>
        </div>
    </div>
    <?php endif; ?>

    <?php if (!empty($this->options->sidebarBlock) && in_array('ShowCategory', $this->options->sidebarBlock)): ?>
    <div class="a-widget a-widget-comment a-m-t-3" <?php if (!empty($this->options->sidebarBlock) && in_array('ShowSidebarImg', $this->options->sidebarBlock)) echo 'style="background-image: url('.$this->options->themeUrl.'/img/stardust.png);"'; ?>>
		<div class="a-title"><?php _e('分类'); ?></div>
        <div class="a-widget-list">
        <?php $this->widget('Widget_Metas_Category_List')->listCategories('wrapClass=widget-list'); ?>
        </div>
    </div>
    <?php endif; ?>

    <?php if (!empty($this->options->sidebarBlock) && in_array('ShowArchive', $this->options->sidebarBlock)): ?>
    <div class="a-widget a-widget-comment a-m-t-3" <?php if (!empty($this->options->sidebarBlock) && in_array('ShowSidebarImg', $this->options->sidebarBlock)) echo 'style="background-image: url('.$this->options->themeUrl.'/img/stardust.png);"'; ?>>
		<div class="a-title"><?php _e('归档'); ?></div>
        <div class="a-widget-list">
			<?php $this->widget('Widget_Contents_Post_Date', 'type=month&format=F Y')
			->parse('<li class="a-div-list a-m-t-1 a-m-l-2 a-p-b-1"><a href="{permalink}">{date}</a></li>'); ?>
        </div>
    </div>
    <?php endif; ?>

    <?php if (!empty($this->options->sidebarBlock) && in_array('ShowOther', $this->options->sidebarBlock)): ?>
    <div class="a-widget a-widget-comment a-m-t-3" <?php if (!empty($this->options->sidebarBlock) && in_array('ShowSidebarImg', $this->options->sidebarBlock)) echo 'style="background-image: url('.$this->options->themeUrl.'/img/stardust.png);"'; ?>>
		<div class="a-title"><?php _e('其他'); ?></div>
        <div class="a-widget-list">
            <?php if($this->user->hasLogin()): ?>
				<li class="a-div-list a-m-t-1 a-m-l-2 a-p-b-1">
					<a href="<?php $this->options->adminUrl(); ?>"><?php _e('进入后台'); ?> (<?php $this->user->screenName(); ?>)</a>
				</li>
				<li class="a-div-list a-m-t-1 a-m-l-2 a-p-b-1">
					<a href="<?php $this->options->logoutUrl(); ?>"><?php _e('退出'); ?></a>
				</li>
            <?php else: ?>
				<li class="a-div-list a-m-t-1 a-m-l-2 a-p-b-1">
					<a href="<?php $this->options->adminUrl('login.php'); ?>"><?php _e('登录'); ?></a>
				</li>
            <?php endif; ?>
				<li class="a-div-list a-m-t-1 a-m-l-2 a-p-b-1">
					<a href="<?php $this->options->feedUrl(); ?>"><?php _e('文章 RSS'); ?></a>
				</li>
				<li class="a-div-list a-m-t-1 a-m-l-2 a-p-b-1">
					<a href="<?php $this->options->commentsFeedUrl(); ?>"><?php _e('评论 RSS'); ?></a>
				</li>
				<li class="a-div-list a-m-t-1 a-m-l-2 a-p-b-1">
					<a href="http://www.typecho.org">Typecho</a>
				</li>
        </div>
    </div>
    <?php endif; ?>
	
    <?php if (!empty($this->options->SideBarHtml)): ?>
    <div class="a-widget a-widget-comment a-m-t-3" <?php if (!empty($this->options->sidebarBlock) && in_array('ShowSidebarImg', $this->options->sidebarBlock)) echo 'style="background-image: url('.$this->options->themeUrl.'/img/stardust.png);"'; ?>>
		<?php echo $this->options->SideBarHtml; ?>
    </div>
    <?php endif; ?>

</div><!-- end #sidebar -->
