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
			<li><a href="<?php echo U('nav/index');?>"><?php echo L('ADMIN_NAV_INDEX');?></a></li>
			<li class="active"><a href="<?php echo U('nav/add');?>"><?php echo L('ADMIN_NAV_ADD');?></a></li>
		</ul>
		<form method="post" class="form-horizontal js-ajax-form" action="<?php echo U('nav/add_post');?>">
			<fieldset>
				<div class="control-group">
					<label class="control-label"><?php echo L('NAVIGATION_CATEGORY');?></label>
					<div class="controls">
						<select name="cid" id="navcid_select">
						<?php if(is_array($navcats)): foreach($navcats as $key=>$vo): $navcid_selected=$navcid==$vo['navcid']?"selected":""; ?>
							<option value="<?php echo ($vo["navcid"]); ?>" <?php echo ($navcid_selected); ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
						</select>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?php echo L('PARENT');?></label>
					<div class="controls">
						<select name="parentid">
							<option value="0">/</option>
							<?php echo ($nav_trees); ?>
						</select>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?php echo L('LABEL');?></label>
					<div class="controls">
						<input type="text" name="label" value=""><span class="form-required">*</span>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?php echo L('HREF');?></label>
					<div class="controls">
						<input type="radio" name="nav" id="outlink">
						<input type="text" name="href" id="outlink_input" value="http://">
						<input type="radio" name="nav" id="selecturl">
						<select name="href" id="selecthref">
							<option value="home"><?php echo L('HOME');?></option>
							<?php if(is_array($navs)): foreach($navs as $key=>$vo): ?><option disabled><?php echo ($vo["name"]); ?></option>
							<?php if(is_array($vo['items'])): foreach($vo['items'] as $key=>$voo): ?><option value='<?php echo ($voo["rule"]); ?>'><?php echo ($voo["label"]); ?></option><?php endforeach; endif; endforeach; endif; ?>
						</select>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?php echo L('TARGET');?></label>
					<div class="controls">
						<select name="target">
							<option value=""><?php echo L('TARGET_DEFAULT');?></option>
							<option value="_blank"><?php echo L('TARGET_BLANK');?></option>
						</select>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?php echo L('ICON');?></label>
					<div class="controls">
						<input type="text" name="icon" value="">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?php echo L('STATUS');?></label>
					<div class="controls">
						<select name="status">
							<option value="1"><?php echo L('DISPLAY');?></option>
							<option value="0"><?php echo L('HIDDEN');?></option>
						</select>
					</div>
				</div>
			</fieldset>
			<div class="form-actions">
				<button type="submit" class="btn btn-primary js-ajax-submit"><?php echo L('ADD');?></button>
				<a class="btn" href="<?php echo U('nav/index');?>"><?php echo L('BACK');?></a>
			</div>
		</form>
	</div>
	<script src="/public/js/common.js"></script>
	<script>
		$(function() {
			$("#navcid_select").change(function() {
				if(location.search.indexOf("?")>=0){
					location.href = location.href + "&cid=" + $(this).val();
				}else{
					location.href = location.href + "?cid=" + $(this).val();
				}
			});

			$("#selecthref").click(function() {
				$('#outlink_input').removeAttr('name');
				$('#selecturl').attr({
					'checked' : 'checked',
					'name' : 'href'
				});
			});
			$("input[name='href']").click(function() {
				$('#selecthref').removeAttr('name');
				$('#outlink').attr({
					'checked' : 'checked',
					'name' : 'href'
				});
			});
			/*
			Wind.use('ajaxForm','artDialog','iframeTools', function () {
			 	$("#href_input").click(function(){
			 		art.dialog.open("<?php echo U('nav/select');?>", {
			            title: "选择链接地址",
			            close: function () {
			    			var checked_v = art.dialog.data('checked_v');
			    			if (checked_v !== undefined) $('#href_input').val(checked_v);
			    			var checked_u = art.dialog.data('checked_u');
			    			if (checked_u !== undefined) $('#u_input').val(checked_u);
			    		}
			        },false);
				});
			});
			 */
		});
	</script>

</body>
</html>