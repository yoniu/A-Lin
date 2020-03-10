<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>

    <link rel="stylesheet" href="<?php $this->options->themeUrl('style.css?20200305'); ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />
	<link rel='stylesheet' href='<?php $this->options->themeUrl('css/nprogress.css?20200305'); ?>'/>
    <script src="<?php $this->options->themeUrl('js/jquery-1.9.1.min.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('js/jquery-migrate.min.js'); ?>"></script>
	<script src='<?php $this->options->themeUrl('js/nprogress.js'); ?>'></script>
	<script src='<?php $this->options->themeUrl('js/blazy.min.js?20200305'); ?>'></script>
	<script src='<?php $this->options->themeUrl('js/html2canvas.js?20200305'); ?>'></script>
	
	<?php if($this->is('single')): ?>
	<link rel="stylesheet" href="<?php $this->options->themeUrl('css/baguetteBox.min.css?20200305'); ?>">
	<?php endif; ?>
	
    <!-- 通过自有函数输出HTML头部信息 -->
    <?php $this->header(); ?>
</head>
<body<?php if(@$_COOKIE["yoniu_moonlight"]=="on") echo ' class="a-moonlight"'; ?>>
<div class="a-container">
	<div id="header">
		<div class="a-flex a-flex-a-c a-flex-j-s a-p-b-1 a-b-l">
			<div class="a-flex a-flex-a-c a-flex-m-1">
				<div class="a-title a-p-r-2"><a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title() ?></a></div>
				<div class="a-description"><?php $this->options->description() ?></div>
			</div>
			<?php $logoUrl = $this->options->logoUrl ? $this->options->logoUrl : getGravatar(strtolower($this->author->mail),64);?>
			<div class="a-header-img" style="background-image:url(<?php echo $logoUrl; ?>)"></div>
		</div>
		<div class="a-nav a-flex a-flex-a-b a-p-b-1 a-p-t-1<?php if($this->is('single') && $this->fields->show_theme != "1") echo " a-b-l"; ?>">
			<div class="a-flex-full">
				<a class="<?php if($this->is('index')): ?>current <?php endif; ?>a-m-r-2" href="<?php $this->options->siteUrl(); ?>"><?php _e('首页'); ?></a>
				<?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
				<?php while($pages->next()): ?>
				<a class="<?php if($this->is('page', $pages->slug)): ?>current <?php endif; ?>a-m-r-2" href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a>
				<?php endwhile; ?>
			</div>
			<a id="a-light-btn" class="a-m-l-2" href="JavaScript:;" title="开关灯"><i class="fa fa-lightbulb-o"></i></a>
			<a id="a-search-btn" class="a-m-l-2" href="JavaScript:;" title="搜索"><i class="fa fa-search"></i></a>
			<div class="a-search a-p-3<?php if($this->is('index')): ?> a-search-index<?php elseif($this->is('single') && $this->fields->show_theme == "1"): ?> a-search-index<?php endif; ?>">
                <form id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
                    <input type="text" id="s" name="s" class="a-text" placeholder="<?php _e('输入关键字搜索'); ?>" />
                </form>
			</div>
		</div>
		<?php $bigImgUrl = $this->options->bigImgUrl ? $this->options->bigImgUrl : $this->options->themeUrl.'/img/070.jpg';?>
		<?php if($this->is('index')): ?><div class="a-top-img a-m-t-1" style="background-image: url(<?php echo $bigImgUrl; ?>)"></div><?php endif; ?>
		<?php if($this->is('single') && $this->fields->show_theme == "1"): ?>
			<?php if($this->fields->top_img){ $top_img=$this->fields->top_img; }else{ $top_img = GetThumFromContent($this, $this->options->themeUrl); } ?>
			<div class="a-top-img a-m-t-1" style="background-image: url(<?php echo $top_img; ?>)"></div>
		<?php endif; ?>
	</div><!-- end #header -->
	<div id="body" class="a-m-t-3">
		<div class="container">
			<div class="a-flex a-flex-wrap">
