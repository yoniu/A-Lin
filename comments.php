<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
function threadedComments($comments, $options) {
?>
	<div class="a-m-t-2 a-comment comment <?php if ($comments->levels > 0) {echo 'comment-children';$comments->levelsAlt(' comment-level-odd', ' comment-level-even');} else {echo 'comment-body';}?>" id="li-<?php $comments->theId(); ?>">
		<div id="<?php $comments->theId(); ?>" class="a-b-l">
			<div class="author a-flex a-flex-a-c a-l-h-1">
				<div class="a-avatar"><?php $comments->gravatar('43', ''); ?></div>
				<div class="a-flex-full a-m-l-2">
					<div class="a-flex a-flex-a-c">
						<?php $comments->author(); ?>
						<div class="comment-reply a-m-l-1"><?php $comments->reply(); ?></div>
					</div>
					<div class="a-comment-time" datetime="<?php $comments->date(); ?>"><?php echo formatTime($comments->created); ?></div>
				</div>
			</div>
			<div class="comment-info">
				<div class="comment-content"><?php echo $comments->content; ?></div>
			</div>
			<?php if ($comments->children) { ?>
				<?php $comments->threadedComments($options); ?>
			<?php } ?>
		</div>
	</div>
<?php
}
?>
<div id="a-comments" class="a-m-t-3">
    <?php $this->comments()->to($comments); ?>
	<div><i class="fa fa-commenting-o a-m-r-1"></i>评论</div>
	
    <?php if ($comments->have()): ?>
	
	<div class="a-comment-list"><?php $comments->listComments(); ?></div>
    <div class="a-comment-page a-m-t-2 a-flex a-flex-j-c"><?php $comments->pageNav('&laquo;', '&raquo;'); ?></div>
	<?php else: ?>
		<div class="a-flex a-flex-j-c a-flex-a-c a-m-t-2 a-m-b-2 a-sm-title"><?php if($this->allow('comment')): ?> 暂无评论 &gt;_&lt; <?php else: ?> 评论已关闭 &gt;_&lt; <?php endif; ?></div>
    <?php endif; ?>

    <?php if($this->allow('comment')): ?>
    <div id="<?php $this->respondId(); ?>" class="respond a-m-t-2 a-m-b-2">
    
		<div id="response"><i class="fa fa-envelope-open-o a-m-r-1"></i>加入评论</div>
    	<form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
            <?php if($this->user->hasLogin()): ?>
    		<div class="a-m-t-2"><?php _e('登录身份: '); ?><a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>. <a href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;</a></div>
            <?php else: ?>
    		<div class="a-m-t-2">
    			<input type="text" name="author" id="author" class="a-input-text text" placeholder="<?php _e('称呼'); ?>" value="<?php $this->remember('author'); ?>" required />
    		</div>
    		<div class="a-m-t-1">
    			<input type="email" name="mail" id="mail" class="a-input-text text" placeholder="<?php _e('邮箱'); ?>" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
    		</div>
    		<div class="a-m-t-1">
    			<input type="url" name="url" id="url" class="a-input-text text" placeholder="<?php _e('http://'); ?>" value="<?php $this->remember('url'); ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> />
    		</div>
            <?php endif; ?>
    		<div class="a-m-t-2">
                <textarea rows="8" cols="50" name="text" id="textarea" class="a-textarea textarea" required ><?php $this->remember('text'); ?></textarea>
            </div>
    		<div class="a-m-t-2 a-flex">
                <button type="submit" class="a-submit submit a-m-r-1"><?php _e('提交评论'); ?></button>
				<?php $comments->cancelReply(); ?>
            </div>
    	</form>
    </div>
    <?php else: ?>
    <h3><?php _e('评论已关闭'); ?></h3>
    <?php endif; ?>
</div>
