<?php
include_once('header.php');
?>

<style type="text/css">
.script_area {padding:10px;margin-top:4px;border: 1px solid #FFCC00; padding: 10px; background-color: #FFFFCC; color: #333333; margin-bottom: 10px; line-height: 22px;}
.htmlcode {padding:10px;margin-top:4px;border:1px solid #88DD00;background-color:#DDFFBB; color: #333333; margin-bottom: 10px; line-height: 22px;}
</style>

<script type="text/javascript">
<!--
function switchText(id){
	document.getElementById(id).setStyle('display', 'block');
}
function alert_callback(){
	Animation(document.getElementById('short_intro_js')).to('color', '#ffffff').to('background', '#CC3300').duration(3000).ondone(popUpNote).go();
}
function popUpNote(){
	document.getElementById('short_intro_js').setStyle('color', '#000000').setStyle('background', '#ffffff');
	document.getElementById('popUpNoteDiv').setStyle('color', '#CC3300');
}
var alert_dialog = new Dialog(Dialog.DIALOG_ALERT,
	{
	    callBack: alert_callback,
	    message: '在这里将展示给你通过使用校内提供的xnjs所实现的包括对话框、css动态样式、ajax远程请求、按钮效果以及其他等等丰富的代码例子。',
	    title: 'XNJS演示示例'
	}
);
//-->
</script>

<div style="margin:20px;">
	<div class="box">
	<h3><a href="#nogo">什么是XNJS？</a><span style="position: absolute; right: 0px;"><a href="#nogo" onclick="switchText('example_1');">查看所使用代码</a></span></h3>
	</div>
	<div id="short_intro_js">XNJS，或称校内Javascript环境语言，其实就是对普通的javascript进行了约束和限制，部分方法出于安全考虑被禁用了，而部分方法则被封装了起来并且提供了更为简单的表达方法。</div>
	<div style="padding-top:4px;color:#808080;"><span id="popUpNoteDiv" style="padding-top:4px;color:#808080;">感谢您阅读上面的说明。</span>使用如下所有的代码均不需加载任何额外文件，直接复制粘贴即看到效果。更多请参考官方 <a href="http://dev.xiaonei.com/wiki/XNJS">Wiki</a> 和 <a href="http://apps.xiaonei.com/xnmlshell/demo/xnjs_demo_list.jsp" target="_blank">Demo</a> 。</div>
	<div id="example_1" style="display:none;">
		<div style="border-bottom:1px solid #ccc;margin-top:20px;padding-bottom:5px;">所使用XNJS代码：<span style="position:absolute;right:20px;"><a href="#nogo" onclick="document.getElementById('example_1').setStyle('display', 'none');">[关闭代码]</a></span></div>
		<div class="script_area">
			<code>
			function alert_callback(){<br />
			&nbsp;&nbsp;&nbsp;&nbsp;Animation(document.getElementById('short_intro_js')).to('color', '#ffffff').to('background', '#CC3300').duration(3000).ondone(popUpNote).go();<br />
			}<br />
			function popUpNote(){<br />
			&nbsp;&nbsp;&nbsp;&nbsp;document.getElementById('short_intro_js').setStyle('color', '#000000').setStyle('background', '#ffffff');<br />
			&nbsp;&nbsp;&nbsp;&nbsp;document.getElementById('popUpNoteDiv').setStyle('color', '#CC3300');<br />
			}<br />
			var alert_dialog = new Dialog(Dialog.DIALOG_ALERT,<br />
			&nbsp;&nbsp;&nbsp;&nbsp;{<br />
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;callBack: alert_callback,<br />
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;message: '在这里将展示给你通过使用校内提供的xnjs所实现的包括对话框、css动态样式、ajax远程请求、按钮效果以及其他等等丰富的代码例子。',<br />
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;title: 'XNJS演示示例'<br />
			&nbsp;&nbsp;&nbsp;&nbsp;}<br />
			);
			</code>
		</div>
		<div style="border-bottom:1px solid #ccc;margin-top:20px;padding-bottom:5px;">所使用HTML代码：<span style="position:absolute;right:20px;"><a href="#nogo" onclick="document.getElementById('example_1').setStyle('display', 'none');">[关闭代码]</a></span></div>
		<div class="htmlcode">
			<?php
			$example_1 = '<div id="short_intro_js">XNJS，或称校内Javascript环境语言，其实就是对普通的javascript进行了约束和限制，部分方法出于安全考虑被禁用了，而部分方法则被封装了起来并且提供了更为简单的表达方法。</div><div style="padding-top:4px;color:#808080;"><span id="popUpNoteDiv" style="padding-top:4px;color:#808080;">感谢您阅读上面的说明。</span>使用如下所有的代码均不需加载任何额外文件，直接复制粘贴即看到效果。更多请参考官方 <a href="http://dev.xiaonei.com/wiki/XNJS">Wiki</a> 和 <a href="http://apps.xiaonei.com/xnmlshell/demo/xnjs_demo_list.jsp" target="_blank">Demo</a> 。</div>';
			$example_1_coded = htmlspecialchars($example_1);
			echo $example_1_coded;
			?>
		</div>
	</div>
</div>

<div style="margin:20px;">
	<div class="box">
	<h3><a href="#nogo">对话框 Dialog</a><span style="position: absolute; right: 0px;"><a href="#nogo" onclick="switchText('example_2');">查看所使用代码</a></span></h3>
	</div>
	<div>
	<table width="100%">
	<tr>
	<td><a href="#" onclick="new Dialog(Dialog.DIALOG_ALERT, '窗口内容', '窗口标题'); return false;">一般标准窗口</a></td>
	<td><a href="#" onclick="new Dialog(Dialog.DIALOG_ALERT, {message: '2秒钟后自动关闭', button: '自定义按钮', autoHide: 2}); return false;">自动关闭窗口</a></td>
	<td><a href="#" onclick="new Dialog(Dialog.DIALOG_ALERT, {message: '出错啦！', title: '错误风格的窗口', type: 'error'}); return false;">警告提示窗口</a></td>
	</tr>
	</table>
	</div>
	<div id="example_2" style="display:none;">
		<div style="border-bottom:1px solid #ccc;margin-top:20px;padding-bottom:5px;">所使用XNJS代码：<span style="position:absolute;right:20px;"><a href="#nogo" onclick="document.getElementById('example_2').setStyle('display', 'none');">[关闭代码]</a></span></div>
		<div class="script_area">
			<code>
				&nbsp;&nbsp;&nbsp;&nbsp;new Dialog(Dialog.DIALOG_ALERT, '窗口内容', '窗口标题'); return false;<br />
				&nbsp;&nbsp;&nbsp;&nbsp;new Dialog(Dialog.DIALOG_ALERT, {message: '2秒钟后自动关闭', button: '自定义按钮', autoHide: 2}); return false;<br />
				&nbsp;&nbsp;&nbsp;&nbsp;new Dialog(Dialog.DIALOG_ALERT, {message: '出错啦！', title: '错误风格的窗口', type: 'error'}); return false;
			</code>
		</div>
		<div style="border-bottom:1px solid #ccc;margin-top:20px;padding-bottom:5px;">所使用HTML代码：<span style="position:absolute;right:20px;"><a href="#nogo" onclick="document.getElementById('example_2').setStyle('display', 'none');">[关闭代码]</a></span></div>
		<div class="htmlcode">
			<?php
			$example_2_1 = '<a href="#" onclick="new Dialog(Dialog.DIALOG_ALERT, \'窗口内容\', \'窗口标题\'); return false;">一般标准窗口</a>';
			$example_2_2 = '<a href="#" onclick="new Dialog(Dialog.DIALOG_ALERT, {message: \'2秒钟后自动关闭\', button: \'自定义按钮\', autoHide: 2}); return false;">自动关闭窗口</a>';
			$example_2_3 = '<a href="#" onclick="new Dialog(Dialog.DIALOG_ALERT, {message: \'出错啦！\', title: \'错误风格的窗口\', type: \'error\'}); return false;">警告提示窗口</a>';
			echo htmlspecialchars($example_2_1).'<br />';
			echo htmlspecialchars($example_2_2).'<br />';
			echo htmlspecialchars($example_2_3);
			?>
		</div>
	</div>
</div>

<div style="margin:20px;">
	<div class="box">
	<h3><a href="#nogo">Ajax</a><span style="position: absolute; right: 0px;"><a href="#nogo" onclick="switchText('example_3');">查看所使用代码</a></span></h3>
	</div>

<script type="text/javascript">
<!--
  function app_ajax(type) {
	 var ajax = new Ajax(type);
  	ajax.ondone = function(data) {
      document.getElementById('ajax_result').setTextValue(data);
    }

    ajax.onerror = function(errobj) {
      document.getElementById('ajax_result').setTextValue('Ajax出错啦。');
    }

    var params = {
      user_id: Session.getUser(), //返回当前登陆用户的ID
      name: 'Wayland', //随便给参数
      handsome: 'Absolutly!' //随便给参数
    };
    ajax.post('http://planbus.com/app/demo/ajax.php', params); //此网址必须是你app属性里设置的域名，注意www.。
  }
//-->
</script>

<p>
<a href="#" onclick="app_ajax(Ajax.RAW); return false;">启动一个ajax后台请求</a>
</p>

<br />
<div id="ajax_result"></div>
	
	<div id="example_3" style="display:none;">
		<div style="border-bottom:1px solid #ccc;margin-top:20px;padding-bottom:5px;">所使用XNJS代码：<span style="position:absolute;right:20px;"><a href="#nogo" onclick="document.getElementById('example_3').setStyle('display', 'none');">[关闭代码]</a></span></div>
		<div class="script_area">
			<code>
			function app_ajax(type) {<br />
			&nbsp;&nbsp;&nbsp;&nbsp;var ajax = new Ajax(type);<br />
			&nbsp;&nbsp;&nbsp;&nbsp;ajax.ondone = function(data) {<br />
			&nbsp;&nbsp;&nbsp;&nbsp;document.getElementById('ajax_result').setTextValue(data);<br />
			}<br />
			<br />
			ajax.onerror = function(errobj) {<br />
			&nbsp;&nbsp;&nbsp;&nbsp;document.getElementById('ajax_result').setTextValue('Ajax出错啦。');<br />
			}<br />
			<br />
			var params = {<br />
			&nbsp;&nbsp;&nbsp;&nbsp;user_id: Session.getUser(), //返回当前登陆用户的ID<br />
			&nbsp;&nbsp;&nbsp;&nbsp;name: 'Wayland', //随便给参数<br />
			&nbsp;&nbsp;&nbsp;&nbsp;handsome: 'Absolutly!' //随便给参数<br />
			};<br /><br />
			ajax.post('http://planbus.com/app/demo/ajax.php', params); //此网址必须是你app属性里设置的域名，注意www.。<a href="down.php">下载ajax.php源码</a><br />
			}<br />
			</code>
		</div>
		<div style="border-bottom:1px solid #ccc;margin-top:20px;padding-bottom:5px;">所使用HTML代码：<span style="position:absolute;right:20px;"><a href="#nogo" onclick="document.getElementById('example_3').setStyle('display', 'none');">[关闭代码]</a></span></div>
		<div class="htmlcode">
			<?php
			$example_3_1 = '<a href="#" onclick="app_ajax(Ajax.RAW); return false;">启动一个ajax后台请求</a>';
			$example_3_2 = '<div id="ajax_result"></div>';
			echo htmlspecialchars($example_3_1).'<br />';
			echo htmlspecialchars($example_3_2);
			?>
		</div>
	</div>
</div>

<div style="margin:20px;">
	<div class="box">
	<h3><a href="#nogo">Animation</a><span style="position: absolute; right: 0px;"><a href="#nogo" onclick="switchText('example_4');">查看所使用代码</a></span></h3>
	</div>
	<div style="color:#808080;padding:4px;margin-bottom:8px;">
	Animation函数无敌的封装了javascript中所能实现的多种动态效果。通过使用Animation()函数可以在你的APP里实现丰富生动的网页效果。注：不要同一页面反复循环调用过多这个函数，因为animation的原理是对所查找的DOM节点相应CSS属性做出变更，而当今流行浏览器IE7经常在加载过重JS和CSS动态效果后崩溃。
	</div>
	<div>
	<table width="100%">
	<tr>
	<td><a href="#" onclick="Animation(this).to('background', '#88DD00').go(); return false;">改变背景颜色</a></td>
	<td><a href="#" onclick="Animation(this).to('background', '#88DD00').to('color', '#ffffff').go(); return false;">改变背景和文字颜色</a></td>
	<td><a href="#" onclick="Animation(this).to('background', '#ffffff').from('#88DD00').go(); return false;">高亮渐变过程</a></td>
	<td><a href="#" onclick="Animation(this).to('background', '#88DD00').from('#88DD00').to('color', '#ffffff').from('#000').duration(3000).go(); return false;">自定义时间的渐变</a></td>
	</tr>
	</table>
	<br />
	<table width="100%">
	<tr>
	<td>
	<div style="overflow: hidden;height:0px;" id="show_img">
	<img title="淡出图片" src="http://www.becomedia.cn/images/bottom_logo.gif" />	
	</div>
	<a href="#" onclick="Animation(document.getElementById('show_img')).to('height', '26px').to('opacity', 100).show().go();Animation(this).to('height', '0px').to('opacity', 0).hide().go(); return false;">
	<img title="淡出图片" src="http://www.becomedia.cn/images/bottom_logo.gif" />
	</a>
	</td>
	<td>
	<div style="overflow: hidden;" id="hide_img">
		<a href="#" onclick="Animation(document.getElementById('hide_img')).to('height', '0px').to('opacity', 0).hide().go(); return false;"><img title="点击图片自动隐藏" src="http://www.becomedia.cn/images/bottom_logo.gif" /></a>
	</div>
	</td>
	</tr>
	</table>
	</div>
	<div id="example_4" style="display:none;">
		<div style="border-bottom:1px solid #ccc;margin-top:20px;padding-bottom:5px;">所使用XNJS代码：<span style="position:absolute;right:20px;"><a href="#nogo" onclick="document.getElementById('example_4').setStyle('display', 'none');">[关闭代码]</a></span></div>
		<div class="script_area">
			<code>
			直接复制下面HTML代码即可
			</code>
		</div>
		<div style="border-bottom:1px solid #ccc;margin-top:20px;padding-bottom:5px;">所使用HTML代码：<span style="position:absolute;right:20px;"><a href="#nogo" onclick="document.getElementById('example_4').setStyle('display', 'none');">[关闭代码]</a></span></div>
		<div class="htmlcode">
			<?php
			$example_4_1 = '<a href="#" onclick="Animation(this).to(\'background\', \'#88DD00\').go(); return false;">改变背景颜色</a>';
			$example_4_2 = '<a href="#" onclick="Animation(this).to(\'background\', \'#88DD00\').to(\'color\', \'#ffffff\').go(); return false;">改变背景和文字颜色</a>';
			$example_4_3 = '<a href="#" onclick="Animation(this).to(\'background\', \'#ffffff\').from(\'#88DD00\').go(); return false;">高亮渐变过程</a>';
			$example_4_4 = '<a href="#" onclick="Animation(this).to(\'background\', \'#88DD00\').from(\'#88DD00\').to(\'color\', \'#ffffff\').from(\'#000\').duration(3000).go(); return false;">自定义时间的渐变</a>';
			$example_4_5 = '<div style="overflow: hidden;height:0px;" id="show_img"><img title="淡出图片" src="http://www.becomedia.cn/images/bottom_logo.gif" />	</div><a href="#" onclick="Animation(document.getElementById(\'show_img\')).to(\'height\', \'26px\').to(\'opacity\', 100).show().go();Animation(this).to(\'height\', \'0px\').to(\'opacity\', 0).hide().go(); return false;"><img title="淡出图片" src="http://www.becomedia.cn/images/bottom_logo.gif" /></a>';
			$example_4_6 = '<div style="overflow: hidden;" id="hide_img"><a href="#" onclick="Animation(document.getElementById(\'hide_img\')).to(\'height\', \'0px\').to(\'opacity\', 0).hide().go(); return false;"><img title="点击图片自动隐藏" src="http://www.becomedia.cn/images/bottom_logo.gif" /></a></div>';
			echo htmlspecialchars($example_4_1).'<br /><br />';
			echo htmlspecialchars($example_4_2).'<br /><br />';
			echo htmlspecialchars($example_4_3).'<br /><br />';
			echo htmlspecialchars($example_4_4).'<br /><br />';
			echo htmlspecialchars($example_4_5).'<br /><br />';
			echo htmlspecialchars($example_4_6).'<br />';
			?>
		</div>
	</div>	
</div>

<div style="margin:20px;">
	<div class="box">
	<h3><a href="#nogo">DOM</a><span style="position: absolute; right: 0px;"><a href="http://dev.xiaonei.com/wiki/XNJS#XNJS_DOM_--_.E6.A0.A1.E5.86.85.E6.96.87.E6.A1.A3.E5.AF.B9.E8.B1.A1.E6.A8.A1.E5.9E.8B" target="_blank">官方wiki文档</a></span></h3>
	</div>
	<div style="color:#808080;padding:4px;">
	对于javascript初学者来说，对DOM的操作方法稍显复杂。官方wiki提供了各种各样对DOM节点操作的方法，比如在元素周围动态新增一对儿br标签、动态更改链接href属性等。其实，初学者只要掌握好setStyle()函数和Animation()函数就可以实现各种各样你想要的动态效果了。
	</div>
</div>


<div style="margin:20px;">
	<div class="box">
	<h3><a href="#nogo">Samples</a><span style="position: absolute; right: 0px;"><a href="#" target="_blank">下载</a></span></h3>
	</div>
	<div style="color:#808080;padding:4px;">
	<a href="js-friend-selector.php">多好友选择器</a>
	<br />
	</div>
</div>


<?php
include_once('footer.php');
?>

