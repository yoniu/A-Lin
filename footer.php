<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
        </div><!-- end .row -->
    </div>
</div><!-- end #body -->
<div id="footer" class="a-p-t-3 a-p-b-3">
    <span>&copy; <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a></span>
    <span><?php _e('Design by <a href="http://www.yoniu.xyz" target="_blank" rel="nofollow">Yoniu</a>'); ?></span>
	<?php if($this->options->beian) echo '<span><a href="http://www.beian.miit.gov.cn/" target="_blank">'.$this->options->beian.'</a></span>'; ?>
	<?php if($this->options->footer_html) echo $this->options->footer_html; ?>
	<br>
	<?php if($this->options->friends && !empty($this->options->themeOptions) && in_array('ShowFriends', $this->options->themeOptions))_friends_init($this->options->friends); ?>
</div><!-- end #footer -->
</div><!-- end .a-container -->
<p id="back-to-top"><a href="javascript:;"><span class="fa fa-arrow-circle-up"></span></a></p>
<?php $this->footer(); ?>
	<?php if($this->is('single')): ?>
	<?php $top_img = isset($this->fields->top_img) ? $this->fields->top_img : GetThumFromContent($this, $this->options->themeUrl); ?>
	<div class="a-single-poster a-flex-1 a-flex-j-c">
		<div class="a-poster-container">
			<div class="a-poster-content a-flex-1">
				<div class="a-poster-img a-flex-1 a-flex-j-s" style="background-image: url(<?php echo $top_img; ?>)">
					<div class="a-poster-title">
						<?php if ($this->is('page')): ?><div class="a-flex"><?php $this->category(""); ?></div><?php endif; ?>
						<div><?php $this->title() ?></div>
					</div>
					<div class="a-poster-des">
						<?php echo _context_tool($this->content,30); ?>
					</div>
				</div>
				<div class="a-poster-blog a-m-t-2 a-flex a-flex-j-s a-flex-a-c">
					<div class="a-postInfo-liketop">
						<div class="a-postInfo-title"><?php $this->options->title() ?></div>
						<div class="a-postInfo-description"><?php $this->options->description() ?></div>
					</div>
					<div class="a-postImg-liketop">
						<div id="a-qrcode"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="a-poster-control a-flex a-flex-a-c">
			<a id="a-poster-download"><i class="fa fa-cloud-download"></i></a>
			<a id="a-poster-close"><i class="fa fa-close"></i></a>
		</div>
	</div>
	<script type="text/javascript">
		poster_img = '<?php echo $top_img; ?>';
		$(document).ready(function (){
			_load_baguetteBox();
			var qrcode = new QRCode(document.getElementById("a-qrcode"), {
				text: "<?php $this->permalink() ?>",
				width: 60,
				height: 60,
			});
		});
	</script>
	<?php endif; ?>
	<script>themeurl = "<?php $this->options->siteUrl(); ?>";</script>
    <script src="<?php $this->options->themeUrl('js/yoniu.js?20200305'); ?>"></script>
</body>
</html>
