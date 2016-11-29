<?php
/**
 * Created by PhpStorm.
 * User: wanglehui
 * Date: 2016/9/22
 * Time: 11:05
 */

//session_start();
header("Content-type:text/html;Charset=utf-8");
error_reporting(0);
$username = NULL;
if(isset($_COOKIE['username'])){
    $username = $_COOKIE['username'];
}else{
    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no" />
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>Login</title>
    <link rel="stylesheet" href="/style/css/login.css">
</head>
<body>
    <div id="login">
        <h1>Login</h1>
        <form action="/Login/submit" method="post" onsubmit="return submitTest()">
	        <div class="award"><?php echo urldecode($message); ?></div>
	        <input type="text"  placeholder="用户名" class="username" name="username">
	        <input type="password" placeholder="密码" class="password" name="password">
	        <button class="but" type="submit" value="login">登录</button>
        </form>
    </div>
</body>
<script src="/style/res/jquery-1.11.3.min.js"></script>
<script type="text/javascript">
	function submitTest(){		
		if ($(".username").val()=="") {
			$(".award").text("温馨提示：用户名不能为空");
			return false;
		}else if($(".password").val()=="") {
			$(".award").text("温馨提示：密码不能为空");
			return false;
		}else{
			return true;			
		}
	}
</script>
</html>
