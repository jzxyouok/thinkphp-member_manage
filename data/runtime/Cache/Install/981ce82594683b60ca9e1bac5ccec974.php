<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>ThinkCMF安装</title>
<link rel="stylesheet" href="/public/simpleboot/themes/flat/theme.min.css" />
<link rel="stylesheet" href="/public/install/css/install.css" />
<link rel="stylesheet" href="/public/simpleboot/font-awesome/4.4.0/css/font-awesome.min.css" />

<script src="/public/js/jquery.js"></script>
</head>
<body>
	<div class="wrap">
		<div class="header">
	<h1 class="logo">ThinkCMF 安装向导</h1>
	<div class="version"><?php echo (SIMPLEWIND_CMF_VERSION); ?></div>
</div>
		<section class="section">
			<div class="step">
				<ul class="unstyled">
					<li class="on"><em>1</em>检测环境</li>
					<li class="on"><em>2</em>创建数据</li>
					<li class="current"><em>3</em>完成安装</li>
				</ul>
			</div>
			<div class="install" id="log">
				<ul id="loginner" class="unstyled"></ul>
			</div>
			<div class="bottom text-center">
				<a href="javascript:;"><i class="fa fa-refresh fa-spin"></i>&nbsp;正在安装...</a>
			</div>
		</section>
		<script type="text/javascript">
			function showmsg(content,status){
				var icon='<i class="fa fa-check correct"></i> ';
				if(status=="error"){
					icon ='<i class="fa fa-remove error"></i> ';
				}
				$('#loginner').append("<li>"+icon+content+"</li>");
				$("#log").scrollTop(1000000000);
			}
		</script>
	</div>
	<div class="footer">
	&copy; 2013-<?php echo date('Y');?> <a href="http://www.thinkcmf.com" target="_blank">ThinkCMF</a>简约风网络科技出品
</div>
</body>
</html>