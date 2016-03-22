<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<!-- Set render engine for 360 browser -->
	<meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->

	<link href="/public/simpleboot/themes/<?php echo C('SP_ADMIN_STYLE');?>/theme.min.css" rel="stylesheet">
    <link href="/public/simpleboot/css/simplebootadmin.css" rel="stylesheet">
    <link href="/public/js/artDialog/skins/default.css" rel="stylesheet" />
    <link href="/public/simpleboot/font-awesome/4.4.0/css/font-awesome.min.css"  rel="stylesheet" type="text/css">
    <style>
		.length_3{width: 180px;}
		form .input-order{margin-bottom: 0px;padding:3px;width:40px;}
		.table-actions{margin-top: 5px; margin-bottom: 5px;padding:0px;}
		.table-list{margin-bottom: 0px;}
	</style>
	<!--[if IE 7]>
	<link rel="stylesheet" href="/public/simpleboot/font-awesome/4.4.0/css/font-awesome-ie7.min.css">
	<![endif]-->
<script type="text/javascript">
//全局变量
var GV = {
    DIMAUB: "/",
    JS_ROOT: "public/js/",
    TOKEN: ""
};
</script>
<!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/public/js/jquery.js"></script>
    <script src="/public/js/wind.js"></script>
    <script src="/public/simpleboot/bootstrap/js/bootstrap.min.js"></script>
<?php if(APP_DEBUG): ?><style>
		#think_page_trace_open{
			z-index:9999;
		}
	</style><?php endif; ?>
</head>
<body>
	<div class="wrap">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#" data-toggle="tab"><?php echo L('ADMIN_MAILER_INDEX');?></a></li>
		</ul>
		<form method="post" class="form-horizontal js-ajax-form" action="<?php echo U('Admin/mailer/index_post');?>">
			<fieldset>
				<div class="control-group">
					<label class="control-label"><?php echo L('SENDER_NAME');?></label>
					<div class="controls">
						<input type="text" name="sender" value="<?php echo (C("SP_MAIL_SENDER")); ?>" />
						<span class="form-required">*</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?php echo L('SENDER_EMAIL_ADDRESS');?></label>
					<div class="controls">
						<input type="text" name="address" value="<?php echo (C("SP_MAIL_ADDRESS")); ?>" />
						<span class="form-required">*</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?php echo L('SENDER_SMTP_SERVER');?></label>
					<div class="controls">
						<input type="text" name="smtp" value="<?php echo (C("SP_MAIL_SMTP")); ?>" />
						<span class="form-required">*</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">SMTP服务器端口</label>
					<div class="controls">
						<input type="text" name="smtp_port" value="<?php echo (C("SP_MAIL_SMTP_PORT")); ?>" placeholder="默认为25"/>
						<span class="form-required">*</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?php echo L('SMTP_MAIL_ADDRESS');?></label>
					<div class="controls">
						<input type="text" name="loginname" value="<?php echo (C("SP_MAIL_LOGINNAME")); ?>" />
						<span class="form-required">*</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?php echo L('SMTP_MAIL_PASSWORD');?></label>
					<div class="controls">
						<input type="password" name="password" value="<?php echo (C("SP_MAIL_PASSWORD")); ?>" />
						<span class="form-required">*</span>
					</div>
				</div>
				<div class="form-actions">
					<button type="submit" class="btn btn-primary js-ajax-submit"><?php echo L('SAVE');?></button>
				</div>
			</fieldset>
		</form>
	</div>
	<script src="/public/js/common.js"></script>
</body>
</html>