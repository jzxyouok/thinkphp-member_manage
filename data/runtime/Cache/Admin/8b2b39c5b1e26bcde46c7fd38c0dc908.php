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
        <thead>
        <tr>
            <th width="30">ID</th>
            <!--<th width="80"><?php echo L('MEMBER_ID');?></th>-->
            <th width="100"><?php echo L('NAME');?></th>
            <th width="30"><?php echo L('SEX');?></th>
            <th width="30"><?php echo L('AGE');?></th>
            <th width="100"><?php echo L('MOBILE');?></th>
            <th width="100"><?php echo L('OCCUPATION');?></th>
            <th align="left"><?php echo L('AREA');?></th>
            <th width="100"><?php echo L('WEIXIN');?></th>
            <th width="100"><?php echo L('QQ');?></th>
            <th align="left"><?php echo L('EMAIL');?></th>
            <th width="50"><?php echo L('RANK');?></th>
            <th width="100"><?php echo L('RECOMMEND');?></th>
            <th width="60"><?php echo L('PAY_INFO');?></th>
            <th align="left"><?php echo L('REMARK');?></th>
            <th width="60"><?php echo L('HANDLE_USER');?></th>
            <th width="130"><?php echo L('CREATE_TIME');?></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?php echo ($data["id"]); ?></td>
            <!--<td><?php echo ($vo["member_id"]); ?></td>-->
            <td><?php echo ($data["member_name"]); ?></td>
            <td><?php if($data['sex'] == 1): ?>男<?php else: ?>女<?php endif; ?></td>
            <td><?php echo ($data["age"]); ?></td>
            <td><?php echo ($data["mobile"]); ?></td>
            <td><?php echo ($data["occupation"]); ?></td>
            <td><?php echo ($data["area"]); ?></td>
            <td><?php echo ($data["weixin"]); ?></td>
            <td><?php echo ($data["qq"]); ?></td>
            <td><?php echo ($data["email"]); ?></td>
            <td>
                <?php if($data['rank'] == 1): ?>卖咖
                    <?php elseif($data['rank'] == 2): ?>资深卖咖
                    <?php elseif($data['rank'] == 3): ?>大咖
                    <?php else: endif; ?>
            </td>
            <td><?php echo ($data["pid"]); ?></td>
            <td>
                <?php if($data['pay_type'] == 1): ?>599
                    <?php elseif($data['pay_type'] == 2): ?>
                    1599
                    <?php else: endif; ?>
            </td>
            <td><?php echo ($data["remark"]); ?></td>
            <td><?php echo ($data["handle_user"]); ?></td>
            <td><?php echo date('Y-m-d h:i:s',$data['create_time']); ?></td>
        </tr>
        </tbody>
    </table>

    会员下线：
    <style>
        .relation-ships tr td {text-align: center;}
        .relation-ships tr td div {display: inline-block;min-width: 150px;}
        .relation-ships tr td span {display: inline-block;border: 1px solid #fff;color: #fff;min-width: 80px;
                                    height: 30px;line-height: 30px;padding-left: 5px;padding-right: 5px;}
        .bg-1 {background-color: #e00000;}
        .bg-2 {background-color: #df5f18;}
        .bg-3 {background-color: #ffb900;}
        .bg-4 {background-color: #89c261;}
        .bg-5 {background-color: #62c2c1;}
        .border-1 {border: 2px solid #e00000;}
        .border-2 {border: 2px solid #df5f18;}
        .border-3 {border: 2px solid #ffb900;}
        .border-4 {border: 2px solid #89c261;}
        .border-5 {border: 2px solid #62c2c1;}
    </style>
    <table class="table table-hover table-bordered relation-ships">
        <!-- 一层 -->
        <?php if(!empty($floor_2)){ ?>
        <tr class="floor-1">
            <td nowrap="nowrap">
                <span class="bg-1"><?php echo ($data["member_name"]); ?></span>
            </td>
        </tr>
        <?php }else{ ?>
        <tr class="floor-1">
            <td nowrap="nowrap">
                暂无下线会员
            </td>
        </tr>
        <?php } ?>

        <!-- 二层 -->
        <?php if(!empty($floor_2)){ ?>
        <tr class="floor-2">
            <td nowrap="nowrap">
                <?php if(is_array($floor_2)): foreach($floor_2 as $key=>$item_2): ?><span class="bg-2"><?php echo ($item_2["member_name"]); ?></span><?php endforeach; endif; ?>
            </td>
        </tr>
        <?php } ?>

        <!-- 三层 -->
        <?php if(!empty($floor_3)){ ?>
        <tr class="floor-3">
            <td nowrap="nowrap">
                <?php if(is_array($floor_3)): foreach($floor_3 as $k=>$item_3): if($floor_3[k]['pid'] == $floor_2[k]['id']): ?><div class="border-2">
                            <span class="bg-2"><?php echo $floor_2[$k]['member_name']; ?>：</span>
                            <?php if(is_array($floor_3)): foreach($floor_3 as $key=>$item_3): ?><span class="bg-3"><?php echo ($item_3["member_name"]); ?></span><?php endforeach; endif; ?>
                        </div>
                    <?php else: ?>
                        <?php if(is_array($floor_3)): foreach($floor_3 as $key=>$item_3): ?><span class="bg-3"><?php echo ($item_3["member_name"]); ?></span><?php endforeach; endif; endif; endforeach; endif; ?>
            </td>
        </tr>
        <?php } ?>

        <!-- 四层 -->
        <?php if(!empty($floor_4)){ ?>
        <tr class="floor-4">
            <td nowrap="nowrap">
                <?php if(is_array($floor_4)): foreach($floor_4 as $k=>$item_4): if($floor_4[k]['pid'] == $floor_3[k]['id']): ?><div class="border-3">
                            <span class="bg-3"><?php echo $floor_3[$k]['member_name']; ?></span>
                            <?php if(is_array($floor_4)): foreach($floor_4 as $key=>$item_4): ?><span class="bg-4"><?php echo ($item_4["member_name"]); ?></span><?php endforeach; endif; ?>
                        </div>
                    <?php else: ?>
                        <?php if(is_array($floor_4)): foreach($floor_4 as $key=>$item_4): ?><span class="bg-4"><?php echo ($item_4["member_name"]); ?></span><?php endforeach; endif; endif; endforeach; endif; ?>
            </td>
        </tr>
        <?php } ?>

        <!-- 五层 -->
        <?php if(!empty($floor_5)){ ?>
        <tr class="floor-5">
            <td nowrap="nowrap">
                <!--<div class="border-4">-->
                <!-- -->
                <!--</div>-->
                <?php if(is_array($floor_5)): foreach($floor_5 as $k=>$item_5): if($floor_5[k]['pid'] == $floor_4[k]['id']): ?><div class="border-4">
                            <span class="bg-4"><?php echo $floor_3[$k]['member_name']; ?></span>
                            <?php if(is_array($floor_5)): foreach($floor_5 as $key=>$item_5): ?><span class="bg-5"><?php echo ($item_4["member_name"]); ?></span><?php endforeach; endif; ?>
                        </div>
                    <?php else: ?>
                        <?php if(is_array($floor_5)): foreach($floor_5 as $key=>$item_5): ?><span class="bg-5"><?php echo ($item_5["member_name"]); ?></span><?php endforeach; endif; endif; endforeach; endif; ?>
            </td>
        </tr>
        <?php } ?>

    </table>
    </div>
    <a class="btn" href="<?php echo U('Member/index');?>"><?php echo L('BACK');?></a>

</div>
<script src="/public/js/common.js"></script>
</body>
</html>