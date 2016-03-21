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
     <li class="active"><a href="<?php echo U('Admin/backup/index');?>"><?php echo L('ADMIN_BACKUP_INDEX');?></a></li>
  </ul>
  <div class="common-form">
        <form action="<?php echo U('Admin/backup/index_post');?>" method="post">
	        <div class="table_list">
	        <table width="100%" cellspacing="0" class="table_form">
	            <tr>
	        	    <td width="150" align="right"><?php echo L('VOLUME_SIZE');?></td>
	        	    <td>
	                    <input type="text" name="sizelimit" value="<?php echo ($sizelimit); ?>" size="10"> K
	                    &nbsp;&nbsp;(<?php echo L('VOLUME_SIZE_HELP_TEXT');?>)
	                </td>
	          	</tr>
	            <tr>
	        	    <td align="right"><?php echo L('NAME');?></td>
	        	    <td><input type="text" name="backup_name" value="<?php echo ($backup_name); ?>"></td>
	          	</tr>
	            <tr>
	        	    <td align="right"><?php echo L('BACKUP_TYPE');?></td>
	        	    <td>
	                	<label><input type="radio" checked="checked" value="full" name="backup_type" onclick="javascript:$('#js-showtables').hide();"> <?php echo L('BACKUP_ALL');?> &nbsp;&nbsp;</label>
	                    <label><input type="radio" value="custom" name="backup_type" onclick="javascript:$('#js-showtables').show();"> <?php echo L('CUSTOM_BACKUP');?></label>
	                </td>
	          	</tr>
	            <tr id="js-showtables">
	                <td align="right">
	                    <label><input name="selectall" type="checkbox" checked="checked" value="" onclick="javascript:$('.js-checkitem').attr('checked', this.checked);" /> <?php echo L('SELECT_ALL');?></label>
	                </td>
	                <td colspan="2">
	                    <?php if(is_array($tables)): $i = 0; $__LIST__ = $tables;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><label class="checkbox inline" style="width:200px;"><input name="backup_tables[<?php echo ($val); ?>]" type="checkbox" value="-1" checked="checked" class="js-checkitem" />&nbsp;&nbsp;<?php echo ($val); ?></label><?php endforeach; endif; else: echo "" ;endif; ?>
	                </td>
	            </tr>
	          	<tr>
	        	    <td></td>
	        	    <td><input type="submit" name="dosubmit" value="<?php echo L('START_BACKUP');?>" class="btn btn-primary" style="margin-top: 10px;"></td>
	          	</tr>
	        </table>
	        </div>
        </form>
    </div>
</div>
<style type="text/css">
#js-showtables{display:none;}
.checkbox.inline{
	margin-left: 10px;
}
</style>
<script src="/public/js/common.js"></script>
</body>
</html>