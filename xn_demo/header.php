<!-- custom css start -->
<style>
.xnml-logo {background:#3B5888 url(http://planbus.com/app/demo/demo_logo.png) no-repeat scroll 20px center;border-bottom:2px solid #5872A1;height:50px;position:relative;}
.xnml-header {background:#F7F7F7 none repeat scroll 0 0;border-bottom:1px solid #CCCCCC;}
.xnml-intro {padding:10px 20px;}
.xnmls-tabs {bottom:0;position:absolute;right:10px;}
.xnmls-tabs li {float:left;margin-left:5px;}
.xnmls-tabs .current a {background:#5D74A2 none repeat scroll 0 0;}
.xnmls-tabs a {background:#486598 none repeat scroll 0 0;color:#FFFFFF;display:block;padding:4px 10px;text-decoration:none;}
.xnmls-tabs a:hover {background:#5D74A2 none repeat scroll 0 0;}
ul {list-style-image:none;list-style-position:outside;list-style-type:none;}
</style>
<!-- custom css end -->
<?php
// Navigation style define
$cur1 = $cur2 = $cur3 = $cur4 = $cur5 = $cur6 = $cur7 = '';
if(strpos($_SERVER['SCRIPT_NAME'],'index')){
	$cur1 = 'class = "current"';
}elseif(strpos($_SERVER['SCRIPT_NAME'],'callback')){
	$cur2 = 'class = "current"';
}elseif(strpos($_SERVER['SCRIPT_NAME'],'js')){
	$cur3 = 'class = "current"';
}elseif(strpos($_SERVER['SCRIPT_NAME'],'down')){
	$cur4 = 'class = "current"';
}elseif(strpos($_SERVER['SCRIPT_NAME'],'earn')){
	$cur6 = 'class = "current"';
}
?>
<!-- header start -->
<div class="xnml-header">
	<div class="xnml-logo">
		<div class="xnmls-tabs">
			<ul>
				<li <?=$cur1;?>><a title="开发应用相关知识" href="index.php">介绍</a></li>
				<li <?=$cur2;?>><a title="校内API方法调用测试" href="callback.php">REST API</a></li>
				<li <?=$cur3;?>><a title="XNJS:校内javascript环境" href="js.php">XNJS</a></li>
				<li <?=$cur4;?>><a title="源码下载" href="down.php">下载</a></li>
				<li <?=$cur5;?>><a title="权威APP统计数据" href="analytics.php">APP统计系统</a></li>
				<li <?=$cur6;?>><a title="www.becomedia.cn" href="earn.php">APP广告系统</a></li>
			</ul>
		</div>
	</div>
	<div class="xnml-intro">
		<p style="color:#808080;">这是一个诠释如何开发应用程序（App）的测试（Demo）应用。</p>
		<p style="color:#808080;">诠释了第三方如何开发App以及App运行时的效果。 附：Java、PHP、ASP、Python、RoR等源码下载。</p>
	</div>
</div>
<!-- header end -->
<?php
require_once('xiaonei.class.php');

$api_key	= '8b97b84e4c7c49c99656ca0040c7e56d'; // 你的 api_key
$secret		= 'ad66e147bf0a4fd380452f0041f3cec8'; // 你的 secret

// init
$xn = new XNapp($api_key, $secret);

// get logged in userid
//$loggedInUser = $xn->users('getLoggedInUser');
//$xiaonei_uid = $loggedInUser[0][0];
$xiaonei_uid = $_REQUEST['xn_sig_user']; // uid is posted, so reduce calling api, 2008.07.21

?>
