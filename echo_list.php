<?php

// A-Lin by yoniu.xyz

?>
	<div id="a-context">
	<?php if ($this->have()): ?>
		<?php 
		while($this->next()):
		?>
			<?php if($this->fields->show_theme): ?>
				<?php if($this->fields->top_img){ $top_img=$this->fields->top_img; }else{ $top_img = GetThumFromContent($this, $this->options->themeUrl); } ?>
				<?php if($this->fields->show_theme == "1"): // 大图展示 ?>
					<div class="a-article a-article-bigImg a-m-t-3">
						<a href="<?php $this->permalink() ?>">
							<div style="background-image: url(<?php echo $top_img; ?>)" class="a-article-bigImg-img"></div>
						</a>
						<div class="a-flex-1 a-flex-j-e a-article-bigImg-info a-p-2">
							<a class="a-title a-article-list-title a-article-bigImg-title a-p-b-1 a-b-q" href="<?php $this->permalink() ?>"><?php $this->title() ?></a>
							<span class="a-m-t-1"><?php echo _context_tool($this->content, 80); ?></span>
							<div class="a-article-bigImg-icon a-flex a-flex-j-s">
								<div class="a-icon-left a-flex a-flex-a-c">
									<?php $this->category(""); ?>
									<span><?php get_post_view($this); ?> 次阅读</span>
								</div>
								<div class="a-icon-right">
									<span><?php echo formatTime($this->created); ?></span>
								</div>
							</div>
						</div>
					</div>
				<?php elseif($this->fields->show_theme == "3"): // 文字展示 ?>
					<?php $fa_tw = $this->options->twitterIcon ? $this->options->twitterIcon : 'fa-twitter'; ?>
					<div class="a-article a-article-T a-m-t-3 a-p-t-2 a-p-b-2">
						<div class="a-article-T-icon a-flex a-flex-j-s">
							<div class="a-icon-left">
								<?php $this->category(""); ?>
								<span><?php echo formatTime($this->created); ?></span>
							</div>
						</div>
						<div class="a-m-2"><a href="<?php $this->permalink() ?>"><?php echo _context_tool($this->content, 80); ?></a></div>
						<div class="a-article-T-fa"><i class="fa <?php echo $fa_tw; ?>"></i></div>
					</div>
				<?php else: // 侧边图if($this->fields->show_theme == "2") ?>
					<div class="a-article a-article-rightImg a-flex a-m-t-3">
						<div style="background-image: url(<?php echo $top_img; ?>)" class="a-article-rightImg-Img"></div>
						<div class="a-article-rightImg-left a-flex-1 a-flex-full a-flex-j-s a-m-l-2">
							<div>
								<a class="a-article-rightImg-title" href="<?php $this->permalink() ?>"><?php $this->title() ?></a>
								<div class="a-article-rightImg-des"><?php echo _context_tool($this->content, 80); ?></div>
							</div>
							<div class="a-article-rightImg-icon a-flex a-flex-j-s">
								<div class="a-icon-left a-flex a-flex-a-c">
									<?php $this->category(""); ?>
									<span><?php get_post_view($this); ?> 次阅读</span>
								</div>
								<div class="a-icon-right">
									<span><?php $this->date('Y-m-d'); ?></span>
								</div>
							</div>
						</div>
					</div>
				<?php endif ?>
			<?php else: // 大图展示 ?>
				<?php if($this->fields->top_img){ $top_img=$this->fields->top_img; }else{ $top_img = GetThumFromContent($this, $this->options->themeUrl); } ?>
				<div class="a-article a-article-bigImg a-m-t-3">
					<a href="<?php $this->permalink() ?>">
						<div style="background-image: url(<?php echo $top_img; ?>)" class="a-article-bigImg-img"></div>
					</a>
					<div class="a-flex-1 a-flex-j-e a-article-bigImg-info a-p-2">
						<a class="a-title a-article-list-title a-article-bigImg-title a-p-b-1 a-b-q" href="<?php $this->permalink() ?>"><?php $this->title() ?></a>
						<span class="a-m-t-1"><?php echo _context_tool($this->content, 80); ?></span>
						<div class="a-article-bigImg-icon a-flex a-flex-j-s">
							<div class="a-icon-left a-flex a-flex-a-c">
								<?php $this->category(""); ?>
								<span><?php get_post_view($this); ?> 次阅读</span>
							</div>
							<div class="a-icon-right">
								<span><?php echo formatTime($this->created); ?></span>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>
		<?php endwhile; ?>
	<?php else: ?>
			<div class="a-article-none a-m-3">
				<?php _e('没有找到内容'); ?>
			</div>
	<?php endif; ?>
	</div><!-- end #context-->
	<div class="a-pageLink a-m-t-3"><?php $this->pageLink('加载更多','next'); ?></div>
