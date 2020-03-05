<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeConfig($form) {
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点 LOGO 地址'), _t('在这里填入一个图片 URL 地址, 在网站右上角显示，留空默认输出博主Gravatar头像'));
    $form->addInput($logoUrl);
    $bigImgUrl = new Typecho_Widget_Helper_Form_Element_Text('bigImgUrl', NULL, NULL, _t('首页顶部图片地址'), _t('在这里填入一个图片 URL 地址, 在首页显示，留空输出默认图片'));
    $form->addInput($bigImgUrl);
    $beian = new Typecho_Widget_Helper_Form_Element_Text('beian', NULL, NULL, _t('ICP备案号'));
    $form->addInput($beian);
    $twitterIcon = new Typecho_Widget_Helper_Form_Element_Text('twitterIcon', NULL, "fa-twitter", _t('微语图标'), _t('在这里填入微语显示的图标（fontAwesome），如：fa-twitter'));
    $form->addInput($twitterIcon);
    $sortId = new Typecho_Widget_Helper_Form_Element_Text('sortId', NULL, NULL, _t('首页列表顶部显示的分类'), _t('在这里填入欲显示的分类ID，使用半角逗号“,”填入多个分类，如：1,2'));
    $form->addInput($sortId);
    $friends = new Typecho_Widget_Helper_Form_Element_Textarea('friends', NULL, NULL, _t('友情链接'), _t('在这里填入友情链接代码，请以json格式填写，必须以"link"为变量，如：<br>{"link":[<br>&nbsp{"name":"油油","title":"A website for myself.","url":"http://www.yoniu.xyz"},<br>&nbsp{"name":"柠檬酸了","title":"油油的笔记","url":"http://www.nmsl.wang"}<br>]}'));
    $form->addInput($friends);
    $diy_html = new Typecho_Widget_Helper_Form_Element_Textarea('diy_html', NULL, NULL, _t('文章内页内容底部显示的内容'), _t('在这里填入欲显示在文章页面内容标签下的内容，可以是html'));
    $form->addInput($diy_html);
    $SideBarHtml = new Typecho_Widget_Helper_Form_Element_Textarea('SideBarHtml', NULL, NULL, _t('侧边栏底部自定义内容'), _t('在这里填入欲显示在侧边栏底部的内容，可以是html,留空不显示'));
    $form->addInput($SideBarHtml);
    $footer_html = new Typecho_Widget_Helper_Form_Element_Textarea('footer_html', NULL, NULL, _t('页面底部显示的内容'), _t('在这里填入欲显示在页面的内容，全站显示，可以是统计代码、可以是html'));
    $form->addInput($footer_html);
    
    $sidebarBlock = new Typecho_Widget_Helper_Form_Element_Checkbox('sidebarBlock', 
    array('ShowRecentPosts' => _t('显示文章TAB'),
    'ShowRecentComments' => _t('显示最近回复'),
    'ShowCategory' => _t('显示分类'),
    'ShowArchive' => _t('显示归档'),
    'ShowOther' => _t('显示其它杂项'),
    'ShowSidebarImg' => _t('显示侧边栏背景')),
    array('ShowRecentPosts', 'ShowRecentComments', 'ShowCategory', 'ShowArchive', 'ShowOther', 'ShowSidebarImg'), _t('侧边栏显示'));
	
    $themeOptions = new Typecho_Widget_Helper_Form_Element_Checkbox('themeOptions', 
    array('ShowFriends' => _t('显示友情链接')),
    array('ShowFriends'), _t('模板选项'));
    
    $form->addInput($sidebarBlock->multiMode());
    $form->addInput($themeOptions->multiMode());
}

//Yoniu：取Gravatar头像
function getGravatar($email, $s = 40, $d = 'mm', $g = 'g') {
	$hash = md5($email);
	$avatar = "http://www.gravatar.com/avatar/$hash?s=$s&d=$d&r=$g";
	return $avatar;
}

//yoniu：分类组
function sort_lists($sid){
	$sort_cache = Typecho_Widget::widget('Widget_Metas_Category_List');
	$sortid = explode(",",$sid);
	$arrlength = count($sortid);
	for( $x = 0 ; $x < $arrlength ; $x++ ) {
		$category = $sort_cache->getCategory($sortid[$x]);
		$title =  $category['name'];//分类标题
		$description =  $category['description'];//分类描述
		$permalink =  $category['permalink'];//分类地址
?>
		<a class="a-m-l-1" href="JavaScript:;" data-link="<?php echo $permalink; ?>" title="<?php echo $description; ?>"><?php echo $title; ?></a>
<?php	}
}
//Yoniu：取文章首图
function GetThumFromContent($content, $url){
	preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $content->content, $img);
	if($imgsrc = !empty($img[1])){
		 $imgsrc = $img[1][0];}else{ 
			preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $content->content ,$img);
			if($imgsrc = !empty($img[1])){ $imgsrc = $img[1][0];  }else{
				$imgsrc = $url . "/img/restaurant_icons.png";	
			}
	}
	return $imgsrc;
}

//Yoniu：取纯文本摘要
function _context_tool($data, $len) {
	$_is = strpos($data, '<!--more-->');
	if($_is == true){
		$datai = explode("<!--more-->",$data);
		return strip_tags($datai[0]);
	}else{
		$data = strip_tags(subString($data, 0, $len + 30));
		$search = array("/([\r\n])[\s]+/", // 去掉空白字符
			"/&(quot|#34);/i", // 替换 HTML 实体
			"/&(amp|#38);/i",
			"/&(lt|#60);/i",
			"/&(gt|#62);/i",
			"/&(nbsp|#160);/i",
			"/&(iexcl|#161);/i",
			"/&(cent|#162);/i",
			"/&(pound|#163);/i",
			"/&(copy|#169);/i",
			"/\"/i",
		);
		$replace = array(" ", "\"", "&", " ", " ", "", chr(161), chr(162), chr(163), chr(169), "");
		$data = trim(subString(preg_replace($search, $replace, $data), 0, $len));
		return $data;
	}
}
//截取编码为utf8的字符串
function subString($strings, $start, $length) {
	if (function_exists('mb_substr') && function_exists('mb_strlen')) {
		$sub_str = mb_substr($strings, $start, $length, 'utf8');
		return mb_strlen($sub_str, 'utf8') < mb_strlen($strings, 'utf8') ? $sub_str . '...' : $sub_str;
	}
	$str = substr($strings, $start, $length);
	$char = 0;
	for ($i = 0; $i < strlen($str); $i++) {
		if (ord($str[$i]) >= 128)
			$char++;
	}
	$str2 = substr($strings, $start, $length + 1);
	$str3 = substr($strings, $start, $length + 2);
	if ($char % 3 == 1) {
		if ($length <= strlen($strings)) {
			$str3 = $str3 .= '...';
		}
		return $str3;
	}
	if ($char % 3 == 2) {
		if ($length <= strlen($strings)) {
			$str2 = $str2 .= '...';
		}
		return $str2;
	}
	if ($char % 3 == 0) {
		if ($length <= strlen($strings)) {
			$str = $str .= '...';
		}
		return $str;
	}
}

/**
* 文章阅读次数
*
* @access public
* @param mixed
* @return
*/
function get_post_view($archive){
    $cid = $archive->cid;
    $db = Typecho_Db::get();
    $prefix = $db->getPrefix();
	if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
		$db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
		echo 0;
		return;
	}
	$row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
	if ($archive->is('single')) {
		$views = Typecho_Cookie::get('extend_contents_views');
		if(empty($views)){
			$views = array();
		}else{
			$views = explode(',', $views);
		}
		if(!in_array($cid,$views)){
			$db->query($db->update('table.contents')->rows(array('views' => (int) $row['views'] + 1))->where('cid = ?', $cid));
			array_push($views, $cid);
			$views = implode(',', $views);
			Typecho_Cookie::set('extend_contents_views', $views); //记录查看cookie
		}
    }
	echo $row['views'];
}

/**
* 文章点赞次数
*/
function get_post_praise($archive){
    $cid = $archive->cid;
    $db = Typecho_Db::get();
    $prefix = $db->getPrefix();
	if (!array_key_exists('praise', $db->fetchRow($db->select()->from('table.contents')))) {
		$db->query('ALTER TABLE `' . $prefix . 'contents` ADD `praise` INT(10) DEFAULT 0;');
		echo 0;
		return;
	}
	$row = $db->fetchRow($db->select('praise')->from('table.contents')->where('cid = ?', $cid));
	echo $row['praise'];
}
/**
* 文章点赞
*/
function _post_praise_init($cid){
	$praise_cookie = @$_COOKIE['yoniu_praise_'.$cid];
	if(empty($praise_cookie)){
		$db = Typecho_Db::get();
		$prefix = $db->getPrefix();
		$row = $db->fetchRow($db->select('praise')->from('table.contents')->where('cid = ?', $cid));
		$db->query($db->update('table.contents')->rows(array('praise' => (int) $row['praise'] + 1))->where('cid = ?', $cid));
		setcookie('yoniu_praise_'.$cid, 'true', time() + 31536000, '/');
		echo $row['praise'] + 1;
	}else{
		echo "false";
	}
}

/**
* 底部友情链接
*/
function _friends_init($JSON){
	$obj = json_decode($JSON);
	$ArrLength = count($obj->link); ?>
	<div class="a-footerLink a-flex a-flex-wrap">
		<span>友情链接：</span>
<?php
	for( $x = 0 ; $x < $ArrLength ; $x++ ) {?>
		<a href="<?php echo $obj->link[$x]->url; ?>" title="<?php echo $obj->link[$x]->title; ?>" target="_blank"><?php echo $obj->link[$x]->name; ?></a>
	<?php } ?>
	</div>
<?php
}
/**
* 显示上一篇
*
* @access public
* @return void
*/
function thePrev($widget){
	$db = Typecho_Db::get();
	$sql = $db->select()->from('table.contents')
			->where('table.contents.created > ?', $widget->created)
			->where('table.contents.status = ?', 'publish')
			->where('table.contents.type = ?', $widget->type)
			->where('table.contents.password IS NULL')
			->order('table.contents.created', Typecho_Db::SORT_ASC)
			->limit(1);
	$content = $db->fetchRow($sql);
	if ($content){
		$content = $widget->filter($content);
		$link = '<a href="' . $content['permalink'] . '" title="' . $content['title'] . '" data-toggle="tooltip"> 上一篇 </a>';
		echo $link;
	}else{
		$link = '';
		echo $link;
	}
}
 
/**
* 显示下一篇
*
* @access public
* @return void
*/
function theNext($widget){
	$db = Typecho_Db::get();
	$sql = $db->select()->from('table.contents')
			->where('table.contents.created < ?', $widget->created)
			->where('table.contents.status = ?', 'publish')
			->where('table.contents.type = ?', $widget->type)
			->where('table.contents.password IS NULL')
			->order('table.contents.created', Typecho_Db::SORT_DESC)
			->limit(1);
	$content = $db->fetchRow($sql);
	if ($content){
		$content = $widget->filter($content);
		$link = '<a href="' . $content['permalink'] . '" title="' . $content['title'] . '">下一篇</a>';
		echo $link;
	}else{
		$link = '';
		echo $link;
	}
}

/**
* 时间友好化
*
* @access public
* @param mixed
* @return
*/
function formatTime($time){
	$text = '';
	$time = intval($time);
	$ctime = time();
	$t = $ctime - $time; //时间差
	if ($t < 0) {
		return date('Y-m-d', $time);
	}
	$y = date('Y', $ctime) - date('Y', $time);//是否跨年
	switch ($t) {
		case $t == 0:
		$text = '刚刚';
		break;
	case $t < 60://一分钟内
		$text = $t . '秒前';
		break;
	case $t < 3600://一小时内
		$text = floor($t / 60) . '分钟前';
		break;
	case $t < 86400://一天内
		$text = floor($t / 3600) . '小时前'; // 一天内
		break;
	case $t < 2592000://30天内
		if($time > strtotime(date('Ymd',strtotime("-1 day")))) {
			$text = '昨天';
		} elseif($time > strtotime(date('Ymd',strtotime("-2 days")))) {
			$text = '前天';
		} else {
			$text = floor($t / 86400) . '天前';
		}
		break;
	case $t < 31536000 && $y == 0://一年内 不跨年
		$m = date('m', $ctime) - date('m', $time) -1;
		if($m == 0) {
			$text = floor($t / 86400) . '天前';
		} else {
			$text = $m . '个月前';
		}
		break;
	case $t < 31536000 && $y > 0://一年内 跨年
		$text = (11 - date('m', $time) + date('m', $ctime)) . '个月前';
		break;
	default:
		$text = (date('Y', $ctime) - date('Y', $time)) . '年前';
		break;
	}
	return $text;
}
//Yoniu：浏览最多的文章
function _hot_posts(){
	$days = 99999999999999;
	$time = time() - (24 * 60 * 60 * $days);
	$db = Typecho_Db::get();
	$sql = $db->select()->from('table.contents')
			->where('created >= ?', $time)
			->where('type = ?', 'post')
			->limit(5)
			->order('views',Typecho_Db::SORT_DESC);
	$result = $db->fetchAll($sql);
	foreach($result as $val){
		$val = Typecho_Widget::widget('Widget_Abstract_Contents')->filter($val);
		?>
		<div class="a-div-list a-b-l a-m-t-1 a-m-l-2 a-m-r-2 a-p-b-1">
			<div class="a-div-title"><a href="<?php echo $val['permalink']; ?>" title="<?php echo $val['title']; ?>"> <?php echo $val['title']; ?> </a></div>
			<div class="a-flex a-flex-a-c">
				<div><?php echo date('Y-m-d', $val['created']); ?></div> 
				<div><?php echo $val['views']; ?> Views</div> 
			</div>
		</div>
<?php	}
}
//Yoniu：随机文章
function _random_posts(){
	$db = Typecho_Db::get();
	$result = $db->fetchAll($db->select()->from('table.contents')
			->where('status = ?','publish')
			->where('type = ?', 'post')
			->where('created <= unix_timestamp(now())', 'post')
			->limit(5)
			->order('RAND()')
	);
	if($result){
		$i=1;
		foreach($result as $val){
			if($i<=3){
				$var = ' class="red"';
			}else{
				$var = '';
			}
			$val = Typecho_Widget::widget('Widget_Abstract_Contents')->push($val);?>
		<div class="a-div-list a-b-l a-m-t-1 a-m-l-2 a-m-r-2 a-p-b-1">
			<div class="a-div-title"><a href="<?php echo $val['permalink']; ?>" title="<?php echo $val['title']; ?>"> <?php echo $val['title']; ?> </a></div>
			<div class="a-flex a-flex-a-c">
				<div><?php echo date('Y-m-d', $val['created']); ?></div> 
				<div><?php echo $val['views']; ?> Views</div> 
			</div>
		</div>
<?php
			$i++;
		}
	}
}
/*
function themeFields($layout) {
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点LOGO地址'), _t('在这里填入一个图片URL地址, 以在网站标题前加上一个LOGO'));
    $layout->addItem($logoUrl);
}
*/

