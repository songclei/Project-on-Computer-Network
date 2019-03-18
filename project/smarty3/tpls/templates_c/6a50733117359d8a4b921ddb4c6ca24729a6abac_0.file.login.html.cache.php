<?php
/* Smarty version 3.1.33, created on 2019-03-18 11:18:59
  from '/Users/songchenlei/Desktop/Project-on-Computer-Network/project/web/html/login.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c8f7ea3662bb3_93745516',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6a50733117359d8a4b921ddb4c6ca24729a6abac' => 
    array (
      0 => '/Users/songchenlei/Desktop/Project-on-Computer-Network/project/web/html/login.html',
      1 => 1552907935,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c8f7ea3662bb3_93745516 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '16829373255c8f7ea363aaa8_80855324';
?>
<html>
<head>
    <title>用户登录界面</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <?php echo '<script'; ?>
 type="text/javascript">
	    //窗体改变大小时触发事件
		window.onresize = setViewSize;
		var marginLeft=0;
		var marginTop=0;
		//设置画布大小，登录页面显示在屏幕最中间
		function setViewSize() {
			//计算屏幕大小
			var w=window.innerWidth
			|| document.documentElement.clientWidth
			|| document.body.clientWidth;
			var h=window.innerHeight
			|| document.documentElement.clientHeight
			|| document.body.clientHeight;
			//设置登陆div的位置
			marginLeft = (w-468)/2;
			marginTop = (h-262)/2;
			document.getElementById("loginFormMain").style.marginLeft=marginLeft;
			document.getElementById("loginFormMain").style.marginTop=marginTop;
		}
		
		//默认聚焦在用户名输入框上
		function focusOnUsername() {
			//调整画布大小和登陆框位置
		    setViewSize();
			//默认聚焦在输入框上
			if (document.loginForm) {
				var usernameInput = document.loginForm.username;
				if (usernameInput) {
					usernameInput.focus();
				}
			}
			return;
		}
    
    	//检查用户输入
		function checkLogin(){
			if(checkUsername() && checkPassword()){
				 return true;
			 }		  
			return false;
		}
		//检查登录用户名
		function checkUsername(){
			var username = document.loginForm.username;
			if(username.value.length!=0){
				return true;
			}else{
				alert("请输入用户名");
				return false;
			}
		}
		//检查登录密码
		function checkPassword(){
			var password = document.loginForm.password;
			if(password.value.length!=0){
				return true;
			}else{
				alert("请输入密码");
				return false;
			}
		}
	<?php echo '</script'; ?>
>
</head>
 
<body onload="javascript:focusOnUsername();" >
    <form  action="./loginAuth.php" name="loginForm" >
    <div  id="loginFormMain">
		<table  style="width:468px;height:262px;background-color: rgba(70, 170, 209, 0.815);text-align: center;">
			<tr>
			  	<th colspan="2" align="center" >用户登录</th>
            </tr>
            <tr>
                <td>用户名&nbsp;<input type="text" style="width: 200px;height: 30px;"  name="username"></td>
            </tr>
            <tr>
                <td name="username_alart" class="alart"></td>
            </tr>
            <tr>
                <td>密  码&nbsp;<input type="password"  style="width: 200px;height: 30px;"  name="password"></td>
            </tr>
            <tr>
                <td name="password_alart" class="alart"></td>
            </tr>
            <tr>
                <td align="center" >
                    <input formmethod="post" type="submit" style="cursor: pointer;font-style: inherit;" name="submit"  onclick="return checkLogin();" value="登录" > 
                    <input type="reset"  style="cursor: pointer;" name=reset  value="重置">
                </td>
            </tr>
		</table>
    </div>
	</form>
</body>
</html><?php }
}
