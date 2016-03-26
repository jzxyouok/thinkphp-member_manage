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
			<li class="active"><a href="<?php echo U('Member/index');?>"><?php echo L('ADMIN_MEMBER_INDEX');?></a></li>
			<li><a href="<?php echo U('Member/add');?>"><?php echo L('ADMIN_MEMBER_ADD');?></a></li>
		</ul>
		<form class="well form-search" method="post" action="<?php echo U('Member/index');?>">
			<?php echo L('SEARCH_TYPE');?>
			<select name="search_type" id="search_type" style="width: 100px;">
				<!--<option value="member_id"><?php echo L('MEMBER_ID');?></option>-->
				<option value="member_name"><?php echo L('NAME');?></option>
				<option value="mobile"><?php echo L('MOBILE');?></option>
				<option value="pid"><?php echo L('RECOMMEND');?></option>
			</select>
			<?php echo L('KEYWORD');?>
			<input type="text" name="keywords" style="width: 200px;" value="" placeholder="请输入关键字...">
			<button class="btn btn-primary"><?php echo L('SEARCH');?></button>
		</form>
		<table class="table table-hover table-bordered">
			<thead>
			<tr>
				<th width="30">ID</th>
				<th width="100"><?php echo L('NAME');?></th>
				<th width="30"><?php echo L('SEX');?></th>
				<th width="30"><?php echo L('AGE');?></th>
				<th width="100"><?php echo L('MOBILE');?></th>
				<th width="50"><?php echo L('RANK');?></th>
				<th width="100"><?php echo L('RECOMMEND');?></th>
				<th width="100"><?php echo L('RECOMMEND_NAME');?></th>
				<th width="100"><?php echo L('ZJ_NUM');?></th>
				<th width="100"><?php echo L('JJ_NUM');?></th>
				<th align="left"><?php echo L('REMARK');?></th>
				<th width="60"><?php echo L('HANDLE_USER');?></th>
				<th width="130"><?php echo L('CREATE_TIME');?></th>
				<th width="100"><?php echo L('ACTIONS');?></th>
			</tr>
			</thead>
			<tbody>
			<?php if(is_array($members)): foreach($members as $key=>$vo): ?><tr>
					<td><?php echo ($vo["id"]); ?></td>
					<td><?php echo ($vo["member_name"]); ?></td>
					<td><?php if($vo['sex'] == 1): ?>男<?php else: ?>女<?php endif; ?></td>
					<td><?php echo ($vo["age"]); ?></td>
					<td><?php echo ($vo["mobile"]); ?></td>
					<td>
						<?php if($vo['rank'] == 1): ?>卖咖
							<?php elseif($vo['rank'] == 2): ?>资深卖咖
							<?php elseif($vo['rank'] == 3): ?>大咖
							<?php else: endif; ?>
					</td>
					<td><?php echo ($vo["pid"]); ?></td>
					<td><?php echo ($vo["p_member_name"]); ?></td>
					<td><?php echo ($vo["zj_num"]); ?></td>
					<td><?php echo ($vo["jj_num"]); ?></td>
					<td><?php echo ($vo["remark"]); ?></td>
					<td><?php echo ($vo["handle_user"]); ?></td>
					<td><?php echo date('Y-m-d h:i:s',$vo['create_time']); ?></td>
					<td>
						<a class="js-dialog" href="<?php echo U('Member/payment_record',array('id'=>$vo['id']));?>"><?php echo L('PAY');?></a> |
						<a href="<?php echo U('Member/info',array('id'=>$vo['id']));?>"><?php echo L('INFO');?></a> |
						<a href="<?php echo U('Member/edit',array('id'=>$vo['id']));?>"><?php echo L('EDIT');?></a>
					</td>
				</tr><?php endforeach; endif; ?>
			</tbody>
		</table>
		<div class="pagination"><?php echo ($page); ?></div>
	</div>
	<script src="/public/js/common.js"></script>
</body>
</html>