<?php
include_once('header.php');

// check app adding status
if($_REQUEST['action'] == 'isAppAdded'){
	$params = array (
	    "uid"	=> array($_REQUEST['uid']) // current user
	);
	$result_array = $xn->users('isAppAdded', $params); //$isAppAdded[0][0] = '1' means added, $isAppAdded[0][0] = '0' means haven't added
}

// get user infos
if($_REQUEST['action'] == 'getInfo'){
	$params = array (
	    "uids"	=> array($_REQUEST['uids']),
	    "fields"=> array('name','sex','star','birthday','tinyurl','headurl','mainurl','university_history','work_history','hs_history','hometown_location')
	);
	$result_array = $xn->users('getInfo',$params);
}

// get getLoggedInUser's uid
if($_REQUEST['action'] == 'getLoggedInUser'){
	$result_array = $xn->users('getInfo');
}
// get current user's friends
if($_REQUEST['action'] == 'getFriends'){
	$params = array (
	    "page"  => $_REQUEST['page'],
	    "count" => $_REQUEST['count']
	);
	$result_array = $xn->friends('getFriends',$params);
}

// tell if specific uids are friends
if($_REQUEST['action'] == 'areFriends'){
	$uids1 = $_REQUEST['uids1'];
	$uids2 = $_REQUEST['uids2'];
	$params = array (
	    "uids1"  => $uids1,
	    "uids2" => $uids2
	);
	$result_array = $xn->friends('areFriends',$params);
}

// get profile XNML box
if($_REQUEST['action'] == 'getXNML'){
	$result_array = $xn->profile('getXNML');
}

// set profile XNML box
if($_REQUEST['action'] == 'setXNML'){
	$params = array (
		"uid"				=> $_REQUEST['uid'],
	    "profile"  			=> $_REQUEST['profile'],
	    "profile_action" 	=> $_REQUEST['profile_action']
	);
	$result_array = $xn->profile('setXNML',$params);
}

// get num of users who installed your app
if($_REQUEST['action'] == 'getAppUsers'){
	$result_array = $xn->friends('getAppUsers',$params);	
}

// this method expires in 2008.07.08
if($_REQUEST['action'] == 'sendRequest'){
	$params = array (
		"uids"				=> $_REQUEST['uids']
	);
	$result_array = $xn->requests('sendRequest',$params);	
}

/**
 * 在调用feed这个方法之前，需要到你的应用程序配置里注册一个新的Feed模板，然后把模板号记下来。这里默认模板号是1。
 * 我的模板设置是：feed标题：{actor}		feed内容：{name}今年有{age}岁了
 * 据官方wiki称目前的feed的发布还是beta版，每日有发布次数上的限制，所有有时候没有效果并不是方法不能用。
 */
if($_REQUEST['action'] == 'publishTemplatizedAction'){
	
	$title = array('actor'=>'Wayland'); //对应feed标题
	$body = array('name'=>'Wayland','age'=>'35'); //对应feed内容
	
	$params = array (
		"template_id"		=> 1,
		"title_data"		=> json_encode($title), //这个参数的传入必须是json格式
		"body_data"			=> json_encode($body) //这个参数的传入必须是json格式
	);
	try {
	    $result_array = $xn->feed('publishTemplatizedAction',$params);
	} catch (Exception $e) {
	    print $e->getMessage();
	}
	
}

// friends.get, 07/16
if($_REQUEST['action'] == 'friendsGet'){
	$result_array = $xn->friends('get',$params);
}

// send notifications, 07/16
if($_REQUEST['action'] == 'sendNotifications'){
	$to_ids = array($xiaonei_uid);
	$content = '来自 <xn:name uid="221912115" linked="true"/> : Test App Demo';
	
	$params = array (
		"to_ids"		=> $to_ids,
		"notification"		=> $content //截止07月16号只支持<xn:name/>和<a/>标签形式的string字符串
	);
	
	$result_array = $xn->notifications('send',$params);
}



// send notifications spammy, 08/18
if($_REQUEST['action'] == 'sendNotificationsSpam'){
	$friend_uids = $xn->friends('get');
	$friend_uids = array_reverse($friend_uids);
	$gen_20_uids = '0'; //max 20 uids each call
	for($i = 0; $i < count($friend_uids['uid']); $i++){
		$each_uid = $friend_uids['uid'][$i];
		if($i<20) {$gen_20_uids .= ','.$each_uid;}
	}
	$notification_content_spam = '你的好友 <xn:name uid="'.$xiaonei_uid.'" linked="true" /> 刚刚挑战了一下校内APP平台稳定性。你收到了本通知就表示平台工作正常。';
	$params_n_spam = array (
		"to_ids"		=> $gen_20_uids,
		"notification"		=> $notification_content_spam
	);
	
	$result_array = $xn->notifications('send',$params_n_spam);
}


// this method is in beta as of 07/21
// update: 07/29, this method no longer available!
if($_REQUEST['action'] == 'getOutsiteInvite'){
	$params = array (
		"session_key"		=> '',
		"uids"				=> $xiaonei_uid,
		"format"			=> 'JSON'
	);
	$result_array = $xn->requests('getOutsiteInvite',$params);	
}

// 邀请站外用户
if($_REQUEST['action'] == 'getOsInfo'){
	echo $_REQUEST['text'].'<br />';
	$params = array (
		"invite_ids"		=> 'df7s3d89876dsa9d87fd', //string, 站外邀请id，可以是一个或多个邀请id，多个邀请id之间用逗号分隔, http://dev.xiaonei.com/wiki/Invitations.getOsInfo
		"format"			=> 'JSON'
	);
	$result_array = $xn->invitations('getOsInfo',$params);	
}

// 获取站外用户邀请相关信息
if($_REQUEST['action'] == 'getUserOsInviteCnt'){
	$params = array (
		"uids"		=> '221912115,66271', //string, 需要查询的用户的id，以逗号（例如：66271，66272）分割。请注意每次请不要超过100个用户。
		"format"			=> 'JSON'
	);
	$result_array = $xn->invitations('getUserOsInviteCnt',$params);	
}

// 获取一个应用当天可以发送的通知的配额
if($_REQUEST['action'] == 'getAllocation'){
	$params = array (
		"format"			=> 'JSON'
	);
	$result_array = $xn->admin('getAllocation',$params);	
}

// 校内豆支付接口
$order_id = $xiaonei_uid.time();
setcookie('xn_demo_orderid',$order_id,3000);
if($_REQUEST['action'] == 'makeOrder'){
	$params = array (
		"format"			=> 'JSON',
		"order_id"			=> $order_id, //每次唯一的order id
		"amount"			=> '2' // 2个校内豆
	);
	$result_array = $xn->makeOrder('regOrder',$params);	
}

// 校内豆：查询某个用户在一个应用中一次消费是否完成。
if($_REQUEST['action'] == 'checkOrder'){
	$params = array (
		"format"			=> 'JSON',
		"order_id"			=> $_COOKIE['xn_demo_orderid'] //需要查询的订单号
	);
	$result_array = $xn->checkOrder('isCompleted',$params);	
}

?>

<div style="margin:20px;">

	<div class="box">
	<h3>本页面展示目前所有API调用的具体方法，以及实现后返回效果</h3>
	</div>

<div style="border-bottom:1px solid #ccc;margin-top:20px;padding-bottom:5px;">用户</div>
<a href="callback.php?action=getInfo&uids=<?=$xiaonei_uid;?>">xiaonei.users.getInfo</a>
<br />
<a href="callback.php?action=isAppAdded&uid=241647221">xiaonei.users.isAppAdded</a>
<br />
<a href="callback.php?action=getLoggedInUser">xiaonei.users.getLoggedInUser</a>
<br />
<div style="border-bottom:1px solid #ccc;margin-top:20px;padding-bottom:5px;">好友</div>
<a href="callback.php?action=getFriends&page=1&count=2">xiaonei.friends.getFriends</a>
<br />
<a href="callback.php?action=getAppUsers">xiaonei.friends.getAppUsers</a>
<br />
<a href="callback.php?action=areFriends&uids1=221912115&uids2=140137911">xiaonei.friends.areFriends</a>
<br />
<a href="callback.php?action=friendsGet">xiaonei.friends.get</a>
<br />
<div style="border-bottom:1px solid #ccc;margin-top:20px;padding-bottom:5px;">个人页面</div>
<a href="callback.php?action=getXNML&uid=<?=$xiaonei_uid;?>">xiaonei.profile.getXNML</a>
<br />
<a href="callback.php?action=setXNML&uid=<?=$xiaonei_uid;?>&profile=hello!&profile_action=http://www.go.com">xiaonei.profile.setXNML</a>
<br />
<div style="border-bottom:1px solid #ccc;margin-top:20px;padding-bottom:5px;">Feed新鲜事</div>
<a href="callback.php?action=publishTemplatizedAction">xiaonei.feed.publishTemplatizedAction</a> 点击后去你的个人主页看效果
<br />
<div style="border-bottom:1px solid #ccc;margin-top:20px;padding-bottom:5px;">通知</div>
<a href="callback.php?action=sendNotifications">xiaonei.notifications.send</a> 点击后去你的首页看效果
<br/>
<a href="callback.php?action=sendNotificationsSpam">xiaonei.notifications.send</a> 测试批量给当前用户好友发通知，一次最多20个好友。
<br />
<div style="border-bottom:1px solid #ccc;margin-top:20px;padding-bottom:5px;">管理、工具</div>
<br />
<a href="callback.php?action=getAllocation">xiaonei.Admin.getAllocation</a>
<br />
<a href="callback.php?action=getOsInfo&text=中文测试">xiaonei.Invitations.getOsInfo</a>
<br />
<a href="callback.php?action=getUserOsInviteCnt">xiaonei.Invitations.getUserOsInviteCnt</a>
<br />
<div style="border-bottom:1px solid #ccc;margin-top:20px;padding-bottom:5px;">校内豆</div>
<br />
<a href="callback.php?action=makeOrder">xiaonei.pay.regOrder</a> <span style="color:red">(New)</span> 
<br />
<a href="callback.php?action=checkOrder">xiaonei.pay.isCompleted</a> <span style="color:red">(New)</span> 
<br />
<br /><br />
<div style="border:2px dotted #799ae1;padding:20px;margin:40px;">
调用方法返回的Array： 
<?php
echo '<pre>';
print_r($result_array);
echo '</pre>';
?>
</div>

<div style="color:#808080;pading:20px;"><a href="down.php">下载源码</a></div> 
</div>

<?php
include_once('footer.php');
?>