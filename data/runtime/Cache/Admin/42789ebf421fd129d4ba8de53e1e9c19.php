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
    <form class="form-horizontal js-ajax-form" action="<?php echo U('Member/payment_record_post');?>" method="post">
        <div class="control-group">
            <?php echo L('NAME');?>：<span><?php echo ($data["member_name"]); ?></span>
        </div>
        <div>
            <label><?php echo L('PAY_INFO');?></label>
            <div>
                <select name="pay_type" id="pay_type">
                    <option value="1" selected>599</option>
                    <option value="2">1599</option>
                </select>
            </div>
        </div>
        <div class="control-group">
            <label><?php echo L('REMARK');?></label>
            <textarea name="remark" rows="2" cols="20" id="remark" class="inputtext" style="height: 50px; width: 205px;"><?php echo ($data["remark"]); ?></textarea>
        </div>
        <div style="margin-top: 20px;text-align: center;">
            <input type="hidden" name="id" value="<?php echo ($data["id"]); ?>" />
            <input type="hidden" name="member_name" value="<?php echo ($data["member_name"]); ?>">
            <input type="hidden" name="mobile" value="<?php echo ($data["mobile"]); ?>">
            <input type="hidden" name="pid" value="<?php echo ($data["pid"]); ?>">
            <button type="submit" class="btn btn-primary js-ajax-submit"><?php echo L('SUBMIT');?></button>
        </div>
    </form>
</div>
<script src="/public/js/common.js"></script>
</body>
</html>