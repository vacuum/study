<?php
if(isset($_REQUEST['user_id']) && isset($_REQUEST['name'])){
	echo '【返回结果】用户ID：'.$_REQUEST['user_id'].'，推举人：'.$_REQUEST['name'].'，帅吗：'.$_REQUEST['handsome'];
}else{
	echo 'no paramaters found';
}
?>