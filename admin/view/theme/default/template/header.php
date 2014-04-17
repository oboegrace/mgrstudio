<div id="header">
	<div class="contentArea">
		<a href="admin/index/"><img src="<?=$this->imgFolder?>logo.gif"/></a>
		<div id="websiteBtn"><a href="index"><i class="fa fa-chevron-circle-right"></i>&nbsp;&nbsp;回網站</a></div>
	</div>
	<div id="menu">
		<div class="contentArea">
			<ul>
				<li><a href="admin/website/" class="<?php if($pageName == 'website') echo 'current';?>">網站內容</a></li>
				<li><a href="admin/news/" class="<?php if($pageName == 'news') echo 'current';?>">最新消息</a></li>
				<li><a href="admin/works/" class="<?php if($pageName == 'works') echo 'current';?>">作品管理</a></li>
				<li><a href="admin/settings/" class="<?php if($pageName == 'settings') echo 'current';?>">其他設定</a></li>
				<li><a onclick="logout()" style="cursor: pointer;"><i class="fa fa-sign-out"></i>&nbsp;&nbsp;登出</a></li>
			</ul>
		</div>
	</div>
</div>
<script type="text/javascript">
	function logout(){
		var form = document.createElement('form');
		form.action = '';
		form.method = 'post';

		// create input action
		// <input type="hidden" name="action" value="logout">
		var input_action = document.createElement('input');
		input_action.type = 'hidden';
		input_action.name = 'action';
		input_action.value = 'logout';

		// append form to body
		form.appendChild(input_action);
		document.body.appendChild(form);

		// submit 
		form.submit();
	}
// logout 的做法是在onclick="logout()" 
// javascript function logout 做一個form有action logout送出
// 到controller function action_logout()會呼叫$this->model->logout();
// 到model的function logout()會include loginModel 
// $loginMag = new loginModel();
// $loginMag->logout(); 回到loginModel.php的logout()function 改_session = null
</script>
