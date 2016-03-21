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
<div class="wrap js-check-wrap">
    <ul class="nav nav-tabs">
        <li><a href="<?php echo U('Member/index');?>"><?php echo L('ADMIN_MEMBER_INDEX');?></a></li>
        <li class="active"><a href=""><?php echo L('INFO');?></a></li>
    </ul>
    <fieldset>
        <div class="control-group">
            <?php echo L('NAME');?>：<?php echo ($data["member_name"]); ?>
        </div>
        <div class="control-group">
            <?php echo L('SEX');?>：<?php echo ($data["sex"]); ?>
        </div>
        <div class="control-group">
            <?php echo L('AGE');?>：<?php echo ($data["age"]); ?>
        </div>
        <div class="control-group">
            <?php echo L('MOBILE');?>：<?php echo ($data["mobile"]); ?>
        </div>
        <div class="control-group">
            <?php echo L('OCCUPATION');?>：<?php echo ($data["occupation"]); ?>
        </div>
        <div class="control-group">
            <?php echo L('AREA');?>：<?php echo ($data["area"]); ?>
        </div>
        <div class="control-group">
            <?php echo L('WEIXIN');?>：<?php echo ($data["weixin"]); ?>
        </div>
        <div class="control-group">
            <?php echo L('QQ');?>：<?php echo ($data["qq"]); ?>
        </div>
        <div class="control-group">
            <?php echo L('EMAIL');?>：<?php echo ($data["email"]); ?>
        </div>
        <div class="control-group">
            <?php echo L('RANK');?>：
            <?php if($data["rank"] == 1): ?>卖咖
                <?php elseif($data["rank"] == 2): ?>资深卖咖
                <?php elseif($data["rank"] == 3): ?> 大咖
                <?php else: endif; ?>
        </div>
        <div class="control-group">
            <?php echo L('RECOMMEND');?>：<?php echo ($data["pid"]); ?>
        </div>
        <div class="control-group">
            <?php echo L('REMARK');?>：
            <p style="width: 400px;word-wrap:break-word;"><?php echo ($data["remark"]); ?></p>
        </div>
    </fieldset>
    <a class="btn" href="<?php echo U('Member/index');?>"><?php echo L('BACK');?></a>
</div>
<script src="/public/js/common.js"></script>
</body>
</html>