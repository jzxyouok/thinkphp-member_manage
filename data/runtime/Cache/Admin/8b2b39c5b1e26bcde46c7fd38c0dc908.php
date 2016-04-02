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
    会员信息：
    <table class="table table-hover table-bordered">
        <tr>
            <td width="100" style="text-align: right;font-weight: bold;">ID：</td>
            <td width="150"><?php echo ($data["id"]); ?></td>
            <td width="100" style="text-align: right;font-weight: bold;"><?php echo L('RECOMMEND');?>：</td>
            <td><?php echo ($data["pid"]); ?></td>
        </tr>
        <tr>
            <td width="100" style="text-align: right;font-weight: bold;"><?php echo L('NAME');?>：</td>
            <td><?php echo ($data["member_name"]); ?></td>
            <td width="100" style="text-align: right;font-weight: bold;"><?php echo L('RECOMMEND_NAME');?>：</td>
            <td><?php echo ($data["p_member_name"]); ?></td>
        </tr>
        <tr>
            <td width="100" style="text-align: right;font-weight: bold;"><?php echo L('SEX');?>：</td>
            <td><?php if($data['sex'] == 1): ?>男<?php else: ?>女<?php endif; ?></td>
            <td width="100" style="text-align: right;font-weight: bold;"><?php echo L('QQ');?>：</td>
            <td><?php echo ($data["qq"]); ?></td>
        </tr>
        <tr>
            <td width="100" style="text-align: right;font-weight: bold;"><?php echo L('AGE');?>：</td>
            <td><?php echo ($data["age"]); ?></td>
            <td width="100" style="text-align: right;font-weight: bold;"><?php echo L('WEIXIN');?>：</td>
            <td><?php echo ($data["weixin"]); ?></td>
        </tr>
        <tr>
            <td width="100" style="text-align: right;font-weight: bold;"><?php echo L('MOBILE');?>：</td>
            <td><?php echo ($data["mobile"]); ?></td>
            <td width="100" style="text-align: right;font-weight: bold;"><?php echo L('EMAIL');?>：</td>
            <td><?php echo ($data["email"]); ?></td>
        </tr>
        <tr>
            <td width="100" style="text-align: right;font-weight: bold;"><?php echo L('RANK');?>：</td>
            <td>
                <?php if($data['rank'] == 1): ?>卖咖
                    <?php elseif($data['rank'] == 2): ?>资深卖咖
                    <?php elseif($data['rank'] == 3): ?>大咖
                    <?php else: endif; ?>
            </td>
            <td width="100" style="text-align: right;font-weight: bold;"><?php echo L('ZJ_NUM');?>：</td>
            <td><?php echo ($data["zj_num"]); ?></td>
        </tr>
        <tr>
            <td width="100" style="text-align: right;font-weight: bold;"><?php echo L('OCCUPATION');?>：</td>
            <td><?php echo ($data["occupation"]); ?></td>
            <td width="100" style="text-align: right;font-weight: bold;"><?php echo L('JJ_NUM');?>：</td>
            <td><?php echo ($data["jj_num"]); ?></td>
        </tr>
        <tr>
            <td width="100" style="text-align: right;font-weight: bold;"><?php echo L('PAY_INFO');?>：</td>
            <td>
                <?php if($data['pay_type'] == 1): ?>599
                    <?php elseif($data['pay_type'] == 2): ?>
                    1599
                    <?php else: endif; ?>
            </td>
            <td width="100" style="text-align: right;font-weight: bold;"><?php echo L('REMARK');?>：</td>
            <td><?php echo ($data["remark"]); ?></td>
        </tr>
        <tr>
            <td style="text-align: right;font-weight: bold;"><?php echo L('AREA');?>：</td>
            <td><?php echo ($data["province"]); ?></td>
            <td><?php echo ($data["city"]); ?></td>
            <td><?php echo ($data["area"]); ?></td>
        </tr>
        <tr>
            <td width="100" style="text-align: right;font-weight: bold;"><?php echo L('HANDLE_USER');?>：</td>
            <td><?php echo ($data["handle_user"]); ?></td>
            <td width="100" style="text-align: right;font-weight: bold;"><?php echo L('CREATE_TIME');?>：</td>
            <td><?php echo date('Y-m-d H:i:s', $data['create_time']); ?></td>
        </tr>
    </table>

    会员下线：
    <table class="table table-hover table-bordered relation-ships">
        <?php if(!empty($tree)){ ?>
            <?php if(is_array($tree)): $i = 0; $__LIST__ = $tree;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td style="text-indent:<?php echo ($vo['count']*20); ?>px;"><?php if(($vo["count"]) != "1"): ?>| --<?php endif; echo ($vo["member_name"]); ?></td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        <?php }else{ ?>
            <tr>
                <td>暂无下线会员</td>
            </tr>
        <?php } ?>
    </table>
    </div>
    <a class="btn" href="<?php echo U('Member/index');?>"><?php echo L('BACK');?></a>

</div>
<script src="/public/js/common.js"></script>
</body>
</html>