<?php
include_once('header.php');
$array = $xn->friends('getFriends');

$html = $heml2 = '';
for($i = 0; $i < count($array['friend']); $i++){ //count($array['friend'])
    $html .= '
	<li id="bm_selector_u_'.$array['friend'][$i]['id'].'" class="bm_selector_friends">
		<a onclick="bm_selector_toggleCSS(\''.$array['friend'][$i]['id'].'\');bm_selector_check(\''.$array['friend'][$i]['id'].'\');return false;" href="#">
			<span class="bm_selector_square" style="background-image: url('.$array['friend'][$i]['headurl'].');">
				<span></span>
			</span>
			<span style="line-height:24px;">'.$array['friend'][$i]['name'].'</span>
		</a>
	</li>    
    ';
}
for($i = 0; $i < count($array['friend']); $i++){ //count($array['friend'])
    $html2 .= '
	<li id="bm_selector_u2_'.$array['friend'][$i]['id'].'" class="bm_selector_friends selected" style="display:none;">
		<a onclick="this.getParentNode().setStyle(\'display\',\'none\');bm_selector_uncheck(\''.$array['friend'][$i]['id'].'\');return false;" href="#">
			<span class="bm_selector_square" style="background-image: url('.$array['friend'][$i]['headurl'].');">
				<span></span>
			</span>
			<span style="line-height:24px;">'.$array['friend'][$i]['name'].'</span>
		</a>
	</li>    
    ';
}

?>

<!-- part 1: css -->
<style>
ul {list-style-image:none;list-style-position:outside;list-style-type:none;}
.bm_selector_tabs {height:22px;position:relative;left:10px;}
.bm_selector_tabs li {float:left;margin-left:5px;}
.bm_selector_tabs .bm_selector_current a {background:#5D74A2 none repeat scroll 0 0;color:#ffffff;}
.bm_selector_tabs a {color:#486598;display:block;padding:4px 20px;text-decoration:none;}
.bm_selector_tabs a:hover {background:#5D74A2 none repeat scroll 0 0;color:#ffffff;}
.bm_selector_pannel{border-color:-moz-use-text-color #C1C1C1 #C1C1C1;border-style:none solid solid;border-width:medium 1px 1px;height:300px;list-style-type:none;margin:0;overflow:auto;padding:0;z-index:1;}
.bm_selector_pannel li{float:left;height:64px;margin:3px;overflow:hidden;width:134px;}
.bm_selector_pannel li.selected{background:transparent url(http://www.planbus.com/app/demo/images/multi_friend_selector_bg.gif) no-repeat scroll left top;}
.bm_selector_friends a{height:56px;padding:4px;display:block;}
.bm_selector_friends a:hover{color:#3B5888;text-decoration:none;background:transparent url(http://www.planbus.com/app/demo/images/multi_friend_selector_hover_bg.gif) no-repeat scroll left top;}
.bm_selector_selected{text-decoration:none;background:transparent url(http://www.planbus.com/app/demo/images/multi_friend_selector_bg.gif) no-repeat scroll left top}
.bm_selector_square{background-color:#FFFFFF;background-position:2px 2px;background-repeat:no-repeat;border:1px solid #E0E0E0;display:block;float:left;height:50px;margin-right:5px;padding:2px;position:static;width:50px;z-index:1;}
.bm_selector_square span{background-position:left bottom;background-repeat:no-repeat;display:block;height:50px;left:2px;position:static;top:2px;width:50px;}
#bm_multi_selector li.selected .bm_selector_square span{background-image:url(http://www.planbus.com/app/demo/images/multi_friend_selector_pic_selected_check_mark.gif);}
#bm_multi_selector strong{color:#222222;font-size:11px;font-weight:normal;margin-top:2px;width:65px;}
#bm_multi_selector a:hover .bm_selector_square {border-color:#205C98;}
.bm_selector_wightcolor a{color:#ffffff;}
.input-button, .input-submit {background-color:#3B5888;border-color:#D8DFEA #0E1F5B #0E1F5B #D8DFEA;border-style:solid;border-width:1px;color:#FFFFFF;cursor:pointer;font-size:12px;margin-right:5px;padding:3px 15px;text-align:center;}
</style>

<!-- part 2: xnjs -->
<xn:js-string var="uids_input">
  <input type="hidden" id="bm_form_uids_none" value="" name="bm_form_ids[]" />
</xn:js-string>

<script type="text/javascript">
	var action = 'http://apps.xiaonei.com/appdemo/get.php';
	var max = 5;
	var form = document.getElementById('bm_selector_form');
	form.setAction(action);
	submitbtn = document.getElementById('bm_form_submit_btn');
	submitbtn.setDisabled(true);
	var i = 0; //counter
	
	function updateCounter(method){
		switch(method){
			case 'plus':
				i = i + 1;
				break;
			case 'minus':
				i = i - 1;
				break;
		}
		if(i<1){
			//document.getElementById("bm_form_submit_btn").setDisabled(true);
			submitbtn = document.getElementById('bm_form_submit_btn');
			submitbtn.setDisabled(true);
		}else{
			submitbtn = document.getElementById('bm_form_submit_btn');
			submitbtn.setDisabled(false);
		}
	}
	
	function bm_selector_switch(id){
		//reset pannels
		document.getElementById('bm_selector_all').setStyle('display', 'none');
		document.getElementById('bm_selector_selected').setStyle('display', 'none');
		//reset tabs
		document.getElementById('bm_selector_tab1').removeClassName('bm_selector_current');
		document.getElementById('bm_selector_tab2').removeClassName('bm_selector_current');

		switch(id){
			case 1:
				document.getElementById('bm_selector_all').setStyle('display', 'block');
				document.getElementById('bm_selector_tab1').addClassName('bm_selector_current');
				break;
			case 2:
				document.getElementById('bm_selector_selected').setStyle('display', 'block');
				document.getElementById('bm_selector_tab2').addClassName('bm_selector_current');
				break;
		}
	}

	function bm_selector_toggleCSS(id){
		var ele = document.getElementById('bm_selector_u_'+id);
		ele.toggleClassName('selected');
		ele.toggleClassName('bm_selector_wightcolor');
	}

	function bm_selector_check(id){
		//step 1: add hidden <input> field
		var checked = document.getElementById("bm_selector_form_span"+id);
		if(checked == null){
			var span = document.createElement("span").setId("bm_selector_form_span"+id);
			document.getElementById("bm_selector_form").appendChild(span);
			document.getElementById("bm_selector_form_span"+id).setInnerXNML(uids_input);
			document.getElementById("bm_form_uids_none").setId("bm_form_uids"+id);
			document.getElementById("bm_form_uids"+id).setValue(id);
		}else{
			var span = document.getElementById("bm_selector_form_span"+id);
			document.getElementById("bm_selector_form").removeChild(span);			
		}
		//step 2: add to 'bm_selector_selected'
		var ele = document.getElementById('bm_selector_u2_'+id);
  		var of_style = ele.getStyle('display');
  		if(of_style == 'block'){
  			document.getElementById('bm_selector_u2_'+id).setStyle('display', 'none');
  			updateCounter('minus');
  		}
  		if(of_style == 'none'){
  			document.getElementById('bm_selector_u2_'+id).setStyle('display', 'block');
  			updateCounter('plus');
  		}
		
		//step 3: update counter
		document.getElementById("bm_selector_count").setTextValue(i);
	}
	
	function bm_selector_uncheck(id){
		//step 1: remove hidden <input> field
		var span = document.getElementById("bm_selector_form_span"+id);
		document.getElementById("bm_selector_form").removeChild(span);
		//set style
		document.getElementById('bm_selector_u_'+id).toggleClassName('selected');
		document.getElementById('bm_selector_u_'+id).toggleClassName('bm_selector_wightcolor');
		
		//update counter
		updateCounter('minus');
		document.getElementById("bm_selector_count").setTextValue(i);
	}
	
</script>
<!-- part 3: html -->
<div>
	<div class="bm_selector_tabs">
		<ul>
			<li id="bm_selector_tab1" class="bm_selector_current"><a onclick="bm_selector_switch(1);" title="全部好友" href="#nogo">全部好友</a></li>
			<li id="bm_selector_tab2"><a onclick="bm_selector_switch(2);" title="已选好友" href="#nogo">已选(<span id="bm_selector_count">0</span>)</a></li>
		</ul>
	</div>
	
	<div id="bm_multi_selector" style="border:1px solid #cccccc;width:600px;height:350px;background:#ffffff;">

		<ul id="bm_selector_all" class="bm_selector_pannel" style="display:block;height:350px;width:600px;border:0px;"><?=$html;?></ul>
		
		<ul id="bm_selector_selected" class="bm_selector_pannel" style="display:none;height:350px;width:600px;border:0px;"><?=$html2;?></ul>
		
	</div>
	
	<form id="bm_selector_form" action="" method="post"><input class="input-button" type="submit" name="bm_form_submit" id="bm_form_submit_btn" value="确认提交" /></form>
</div>

<?php
include_once('footer.php');
?>

