<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>ThinkCMF安装</title>
<link rel="stylesheet" href="/public/simpleboot/themes/flat/theme.min.css" />
<link rel="stylesheet" href="/public/install/css/install.css" />
<link rel="stylesheet" href="/public/simpleboot/font-awesome/4.4.0/css/font-awesome.min.css" />

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
					<li class="current"><em>1</em>检测环境</li>
					<li><em>2</em>创建数据</li>
					<li><em>3</em>完成安装</li>
				</ul>
			</div>
			<div class="server">
				<table width="100%">
					<tr>
						<td class="td1">环境检测</td>
						<td class="td1" width="25%">推荐配置</td>
						<td class="td1" width="25%">当前状态</td>
						<td class="td1" width="25%">最低要求</td>
					</tr>
					<tr>
						<td>操作系统</td>
						<td>类UNIX</td>
						<td><i class="fa fa-check correct"></i> <?php echo ($os); ?></td>
						<td>不限制</td>
					</tr>
					<tr>
						<td>PHP版本</td>
						<td>>5.3.x</td>
						<td><i class="fa fa-check correct"></i> <?php echo ($phpversion); ?></td>
						<td>5.3.0</td>
					</tr>
					<tr>
						<td>
							PDO 
							<a href="https://www.baidu.com/s?wd=开启PDO,PDO_MYSQL扩展" target="_blank">
								<i class="fa fa-question-circle question"></i>
							</a>
						</td>
						<td>开启</td>
						<td>
							<?php echo ($pdo); ?>
						</td>
						<td>开启</td>
					</tr>
					<tr>
						<td>
							PDO_MySQL
							<a href="https://www.baidu.com/s?wd=开启PDO,PDO_MYSQL扩展" target="_blank">
								<i class="fa fa-question-circle question"></i>
							</a>
						</td>
						<td>开启</td>
						<td>
							<?php echo ($pdo_mysql); ?>
						</td>
						<td>开启</td>
					</tr>
					<tr>
						<td>附件上传</td>
						<td>>2M</td>
						<td>
							<?php echo ($upload_size); ?>
						</td>
						<td>不限制</td>
					</tr>
					<tr>
						<td>session</td>
						<td>开启</td>
						<td>
							<?php echo ($session); ?>
						</td>
						<td>开启</td>
					</tr>
				</table>
				<table width="100%">
					<tr>
						<td class="td1">目录、文件权限检查</td>
						<td class="td1" width="25%">写入</td>
						<td class="td1" width="25%">读取</td>
					</tr>
					<?php if(is_array($folders)): foreach($folders as $dir=>$vo): ?><tr>
							<td>
								./<?php echo ($dir); ?>
							</td>
							<td>
								<?php if($vo['w']): ?><i class="fa fa-check correct"></i> 可写 
								<?php else: ?>
									<i class="fa fa-remove error"></i> 不可写<?php endif; ?>
							</td>
							<td>
								<?php if($vo['r']): ?><i class="fa fa-check correct"></i> 可读
								<?php else: ?>
									<i class="fa fa-remove error"></i> 不可读<?php endif; ?>
							</td>
						</tr><?php endforeach; endif; ?>
				</table>
			</div>
			<div class="bottom text-center">
				<a href="/index.php?g=install&a=step2" class="btn btn-primary">重新检测</a>
				<a href="/index.php?g=install&a=step3" class="btn btn-primary">下一步</a>
			</div>
		</section>
	</div>
	<div class="footer">
	&copy; 2013-<?php echo date('Y');?> <a href="http://www.thinkcmf.com" target="_blank">ThinkCMF</a>简约风网络科技出品
</div>
</body>
</html>