<?php
/*
	XIAONEI app class model.
	by Become Media Inc.
	http://www.becomedia.cn
*/
class XNapp {
	  public $secret;
	  public $session_key;
	  public $api_key;
	  public $v;
	  public $server_addr;
	  public $method;

	public function __construct($api_key,$secret,$v='1.0') 
	{	
		$this->secret       = $secret;
		$this->api_key  = $api_key;
		$this->v=$v;
		//$this->session_key=$_POST['xn_sig_session_key']; // iframe形式的APP不能使用POST，要urlencode后的GET
		$this->session_key=$_REQUEST['xn_sig_session_key'];
		//echo $this->session_key;
		$this->server_addr='http://api.xiaonei.com/restserver.do?';

	}
	/*
	public function createToken(){
		return $this->post_request('xiaonei.auth.createToken','');
	}
	*/
	public function auth($method)
	{
		$params=array();
		switch($method){
			case 'createToken':
				break;
			
			case 'getSession':
				$authTokenArray=self::auth('createToken');
				//print_r($authTokenArray);
				if($authTokenArray[0]&&$authTokenArray[0][0])
				{
						$authToken=$authTokenArray[0][0];
						$params['authToken']=$authToken;
				}else{
					return false;
				}
				break;
		}
		

		$method='xiaonei.auth.'.$method;

		return $this->post_request($method,$params);
	}
	


	public function users($method,$array=array(),$format='XML')
	{
		$params=array();
		switch($method){
			case 'getInfo':
				if($array['uids'])
				$params['uids']=$array['uids'];
				else $params['uids']=$_POST['xn_sig_user'];
				if($array['fields'])
				$params['fields']=$array['fields'];

				break;
			
			case 'getLoggedInUser':
				break;

			case 'isAppAdded':
				if($array['uid'])
				$params['uid']=$array['uid'];
				break;
		}
		

		$method='xiaonei.users.'.$method;
		$params['format']=$format;

		return $this->post_request($method,$params);
	}
	

	public function profile($method,$array=array(),$format='XML')
	{
		$params=array();
		switch($method){
			case 'getXNML':
				if($array['uid'])
				$params['uid']=$array['uid'];
				else $params['uid']=$_POST['xn_sig_user'];break;
			
			case 'setXNML':
				if($array['uid'])
				$params['uid']=$array['uid'];
				if($array['profile'])
				$params['profile']=$array['profile'];
				if($array['profile_action'])
				$params['profile_action']=$array['profile_action'];
				break;

		}
		

		$method='xiaonei.profile.'.$method;
		$params['format']=$format;

		return $this->post_request($method,$params);
	}
	

	public function friends($method,$array=array(),$format='XML')
	{
		$params=array();
		switch($method){
			case 'getFriends':
				if($array['page'])
				$params['page']=$array['page'];
				if($array['count'])
				$params['count']=$array['count'];break;
			
			case 'areFriends':
				if($array['uids1'])
				$params['uids1']=$array['uids1'];
				if($array['uids2'])
				$params['uids2']=$array['uids2'];
				
				break;

			case 'getAppUsers':
				
				break;

		}
		

		$method='xiaonei.friends.'.$method;
		$params['format']=$format;

		return $this->post_request($method,$params);
	}

	
	// feed
	public function feed($method,$array=array(),$format='XML'){
		$params=array();
		switch($method){
			case 'publishTemplatizedAction':
				if($array['template_id']) //current user's friends' uids
				$params['template_id']=$array['template_id'];
				if($array['title_data'])
				$params['title_data']=$array['title_data'];
				if($array['body_data'])
				$params['body_data']=$array['body_data'];
				if($array['resource_id'])
				$params['resource_id']=$array['resource_id'];
			break;
		}

		$method='xiaonei.feed.'.$method;
		$params['format']=$format;

		return $this->post_request($method,$params);
	}
	
	// function requests expires in 2008.07.08
	public function requests($method,$array=array(),$format='XML')
	{
		$params=array();
		switch($method){
			case 'sendRequest':
				if($array['uids']) //current user's friends' uids
				$params['uids']=$array['uids'];
			break;
			case 'getOutsiteInvite':
				if($array['session_key'])
				$params['session_key']=$array['session_key'];
				if($array['uids'])
				$params['uids']=$array['uids'];
				if($array['format'])
				$params['format']=$array['format'];
			break;
		}

		$method='xiaonei.requests.'.$method;
		$params['format']=$format;

		return $this->post_request($method,$params);
	}
	//function outsiteinvitation 
	public function invitations($method,$array=array(),$format='XML')
	{
		$params=array();
		switch($method){
			case 'getOsInfo':
				if($array['invite_ids']) //current user's friends' uids
				$params['invite_ids']=$array['invite_ids'];
			break;
			case 'getUserOsInviteCnt':
				if($array['uids']) //需要查询的用户的id，请注意每次请不要超过100个用户
				$params['uids']=$array['uids'];
			break;				
		}
		
		$method='xiaonei.invitations.'.$method;
		$params['format']=$format;

		return $this->post_request($method,$params);
	}
	
	// function notifications
	public function notifications($method,$array=array(),$format='XML')
	{
		$params=array();
		switch($method){
			case 'send':
				if($array['to_ids']) //current user's friends' uids
				$params['to_ids']=$array['to_ids'];
				if($array['notification'])
				$params['notification']=$array['notification'];
			break;
		}

		$method='xiaonei.notifications.'.$method;
		$params['format']=$format;

		return $this->post_request($method,$params);
	}
	
	// function Pay.regOrder
	public function makeOrder($method,$array=array(),$format='XML')
	{
		$params=array();
		switch($method){
			case 'regOrder':
				if($array['order_id']) //订单号
				$params['order_id']=$array['order_id'];
				if($array['amount']) //金额
				$params['amount']=$array['amount'];
			break;
		}

		$method='xiaonei.pay.'.$method;
		$params['format']=$format;

		return $this->post_request($method,$params);
	}
	
	// function Pay.isCompleted
	public function checkOrder($method,$array=array(),$format='XML')
	{
		$params=array();
		switch($method){
			case 'isCompleted':
				if($array['order_id']) //订单号
				$params['order_id']=$array['order_id'];
			break;
		}

		$method='xiaonei.pay.'.$method;
		$params['format']=$format;

		return $this->post_request($method,$params);
	}
	
	// function admin
	public function admin($method,$array=array(),$format='XML')
	{
		$params=array();
		
		$method='xiaonei.admin.'.$method;
		$params['format']=$format;

		return $this->post_request($method,$params);
	}
			
	public function photos($method,$array=array(),$format='XML')
	{
		$params=array();
		switch($method){
			case 'getAlbums':
				if($array['uid'])
				$params['uid']=$array['uid'];
				else $params['uid']=$_POST['xn_sig_user'];
				break;
			
			case 'get':
				break;

		}
		

		$method='xiaonei.photos.'.$method;
		$params['format']=$format;

		return $this->post_request($method,$params);
	}
	

	public function messages($method,$array=array(),$format='XML')
	{
		$params=array();
		switch($method){
			case 'gets':
				if($array['isInbox'])
				$params['isInbox']=$array['isInbox'];
				else $params['isInbox']=true;
				break;
			
			case 'get':
				break;

		}
		

		$method='xiaonei.message.'.$method;
		$params['format']=$format;

		return $this->post_request($method,$params);
	}
	

//=================================================================================================
	 public static function generate_sig($params_array, $secret) {
			$str = '';

			ksort($params_array);
			// Note: make sure that the signature parameter is not already included in
			//       $params_array.
			foreach ($params_array as $k=>$v) {
			  $str .= "$k=$v";
			}
			$str .= $secret;

			return md5($str);
		  }


	 private function create_post_string($method, $params) {
			$params['method'] = $method;
			$params['session_key'] = $this->session_key;
			$params['api_key'] = $this->api_key;
			$params['call_id'] = microtime(true);
			if ($params['call_id'] <= $this->last_call_id) {
			  $params['call_id'] = $this->last_call_id + 0.001;
			}
			$this->last_call_id = $params['call_id'];
			if (!isset($params['v'])) {
			  $params['v'] = '1.0';
			}
			$post_params = array();
			foreach ($params as $key => &$val) {
			  if (is_array($val)) $val = implode(',', $val);
			  $post_params[] = $key.'='.urlencode($val);
			}
			$secret = $this->secret;
			$post_params[] = 'sig='.$this->generate_sig($params, $secret);
			return implode('&', $post_params);
		  }


	 public function post_request($method, $params) {
			
			$post_string = $this->create_post_string($method, $params);
			//echo $post_string.'<br /><br />';
			//echo $this->server_addr.$post_string;
			if (function_exists('curl_init')) {
			  // Use CURL if installed...
			  $ch = curl_init();
			  curl_setopt($ch, CURLOPT_URL, $this->server_addr);
			  curl_setopt($ch, CURLOPT_POST, 1);
			  curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
			  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			  //curl_setopt($ch, CURLOPT_USERAGENT, 'Facebook API PHP5 Client 1.1 (curl) ' . phpversion());
			  $result = curl_exec($ch);
			  curl_close($ch);
			} else {
			  // Non-CURL based version...
			  $context =
				array('http' =>
					  array('method' => 'POST',
							'header' => 'Content-type: application/x-www-form-urlencoded'."\r\n".
										'User-Agent: Facebook API PHP5 Client 1.1 '."\r\n".
										'Content-length: ' . strlen($post_string),
							'content' => $post_string));
			  $contextid=stream_context_create($context);
			  $sock=fopen($this->server_addr, 'r', false, $contextid);
			  if ($sock) {
				$result='';
				while (!feof($sock))
				  $result.=fgets($sock, 4096);

				fclose($sock);
			  }
			}
			//echo $result;
		    $result = $this->xml_to_array($result);
			$this->checkreturn($result);
			return $result;
	 }

		private function xml_to_array($xml)
			{
			  $array = (array)(simplexml_load_string($xml,'SimpleXMLElement', LIBXML_NOCDATA));
			  foreach ($array as $key=>$item){
				$array[$key]  = $this->struct_to_array((array)$item);
			  }
			  return $array;
			}

		private	function struct_to_array($item) {
			  if(!is_string($item)) {
				$item = (array)$item;
				foreach ($item as $key=>$val){
				  $item[$key]  =  self::struct_to_array($val);
				}
			  }
			  return $item;
			}

		private function checkreturn($result)
		{	
			$msg='';
			if($result['error_code'])
			{
				$msg.='<br>访问出错!<br>';
				if($result['error_code'][0])
				{
					$msg.='错误编号:'.$result['error_code'][0].'<br>';
				}
				if($result['error_msg'][0])
				{
					$msg.='错误信息:'.$result['error_msg'][0].'<br>';
				}

			}
			
			if($msg!='' && $result['error_code'][0]!='10702' && $result['error_code'][0]!='10600' ){echo $msg;exit;}


		}
}
?>