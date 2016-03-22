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
			<li class="active"><a href="#" data-toggle="tab"><?php echo L('ADMIN_MAILER_ACTIVE');?></a></li>
		</ul>
		<div class="common-form">
			<form method="post" class="form-horizontal js-ajax-form" action="<?php echo U('Admin/mailer/active_post');?>">
				<table cellpadding="2" cellspacing="2" width="100%">
					<tbody>
						<tr>
							<td width="100"><?php echo L('EMAIL_ACTIVATION');?></td>
							<td>
								<?php $radio1=''; $radio2=' checked'; if(C('SP_MEMBER_EMAIL_ACTIVE')==1){ $radio1=' checked'; $radio2=''; } ?>
								<label class="radio inline" for="lightup_true"> <input type="radio" <?php echo ($radio1); ?> id="lightup_true" class="radio" name="lightup" value="1" /><?php echo L('OPEN');?></label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<label class="radio inline" for="lightup_false"> <input type="radio" <?php echo ($radio2); ?> id="lightup_false" class="radio" name="lightup" value="0" /><?php echo L('CLOSE');?></label>
							</td>
						</tr>
						<tr>
							<td><?php echo L('EMAIL_SUBJECT');?></td>
							<td><input type="text" name="options[title]" value="<?php echo ($options["title"]); ?>"/></td>
						</tr>
						<tr>
							<td><?php echo L('EMAIL_TEMPLATE');?></td>
							<td>
								<script type="text/plain" id="content" name="options[template]"><?php echo ($options["template"]); ?></script>
								<span style="color: #ffb752;"><?php echo L('EMAIL_TEMPLATE_HELP_TEXT',array('link'=>'http://#link#','username'=>'#username#'));?></span>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="form-actions">
					<button type="submit" class="btn btn-primary  js-ajax-submit"><?php echo L('SAVE');?></button>
				</div>
			</form>
		</div>
	</div>
	<script src="/public/js/common.js"></script>
	<script type="text/javascript">
		//编辑器路径定义
		var editorURL = GV.DIMAUB;
	</script>
	<script type="text/javascript" src="/public/js/ueditor/ueditor.config.js"></script>
	<script type="text/javascript" src="/public/js/ueditor/ueditor.all.min.js"></script>
	<script type="text/javascript">
		var editorcontent = new baidu.editor.ui.Editor();
		editorcontent.render('content');
	</script>
</body>
</html>