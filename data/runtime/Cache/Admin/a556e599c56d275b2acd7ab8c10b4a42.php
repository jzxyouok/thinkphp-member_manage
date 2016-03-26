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
        <li class="active"><a href=""><?php echo L('ADMIN_MEMBER_EDIT');?></a></li>
    </ul>
    <form class="form-horizontal js-ajax-form" action="<?php echo U('Member/edit_post');?>" method="post">
        <fieldset>
            <div class="control-group">
                <label class="control-label"><?php echo L('NAME');?></label>
                <div class="controls">
                    <input type="text" name="member_name" value="<?php echo ($data["member_name"]); ?>" id="member_name"/>
                    <span class="form-required">*</span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label"><?php echo L('SEX');?></label>
                <div class="controls">
                    <label class="radio inline" for="male"><input type="radio" name="sex" value="1" <?php if($data['sex']==1) echo 'checked'; ?> id="male" />男</label>
                    <label class="radio inline" for="female"><input type="radio" name="sex" value="2" <?php if($data['sex']==2) echo 'checked'; ?> id="female">女</label>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label"><?php echo L('AGE');?></label>
                <div class="controls">
                    <input type="text" name="age" value="<?php echo ($data["age"]); ?>" id="age"/>
                    <span class="form-required"></span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label"><?php echo L('MOBILE');?></label>
                <div class="controls">
                    <input type="text" name="mobile" value="<?php echo ($data["mobile"]); ?>" id="mobile"/>
                    <span class="form-required">*</span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label"><?php echo L('OCCUPATION');?></label>
                <div class="controls">
                    <input type="text" name="occupation" value="<?php echo ($data["occupation"]); ?>" id="occupation"/>
                    <span class="form-required"></span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label"><?php echo L('AREA');?></label>
                <div class="controls">
                    <select onchange="" id="province" name="province" class="select_t"></select>
                    <select class="select_t" id="city" name="city"></select>
                    <select class="select_t" id="area" name="area"></select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label"><?php echo L('WEIXIN');?></label>
                <div class="controls">
                    <input type="text" name="weixin" value="<?php echo ($data["weixin"]); ?>" id="weixin"/>
                    <span class="form-required"></span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label"><?php echo L('QQ');?></label>
                <div class="controls">
                    <input type="text" name="qq" value="<?php echo ($data["qq"]); ?>" id="qq"/>
                    <span class="form-required"></span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label"><?php echo L('EMAIL');?></label>
                <div class="controls">
                    <input type="text" name="email" value="<?php echo ($data["email"]); ?>" id="email"/>
                    <span class="form-required"></span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label"><?php echo L('RANK');?></label>
                <div class="controls">
                    <span>
                        <?php if($data["rank"] == 1): ?>卖咖
                            <?php elseif($data["rank"] == 2): ?>资深卖咖
                            <?php else: ?> 大咖<?php endif; ?>
                    </span>
                    <!--<span class="form-required">*</span>-->
                </div>
            </div>
            <div class="control-group">
                <label class="control-label"><?php echo L('RECOMMEND');?></label>
                <div class="controls">
                    <input type="hidden" name="old_pid" value="<?php echo ($data["pid"]); ?>">
                    <input type="text" name="pid" value="<?php echo ($data["pid"]); ?>" id="pid"/>
                    <div id="msg"></div>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label"><?php echo L('REMARK');?></label>
                <div class="controls">
                    <textarea name="remark" rows="2" cols="20" id="remark" class="inputtext" style="height: 100px; width: 500px;"><?php echo ($data["remark"]); ?></textarea>
                </div>
            </div>
        </fieldset>
        <div class="form-actions">
            <input type="hidden" name="id" value="<?php echo ($data["id"]); ?>" />
            <button type="submit" class="btn btn-primary js-ajax-submit"><?php echo L('UPDATE');?></button>
            <a class="btn" href="<?php echo U('Member/index');?>"><?php echo L('BACK');?></a>
        </div>
    </form>
</div>
<script src="/public/js/common.js"></script>
<script src="/public/js/pcasunzip.js"></script>
<script>
    // 地区三级联动
    $(document).ready(function() {
        new PCAS("province","city","area", "<?php echo ($data["province"]); ?>", "<?php echo ($data["city"]); ?>", "<?php echo ($data["area"]); ?>");
    });

    $("#pid").blur(function(){
        var $this = $(this);
        var id = $this.val();
        if(id != ''){
            $.ajax({
                type: "GET",
                url: "<?php echo U('Member/getAjaxMember');?>",
                data: {"id": id},
                dataType: "json",
                success: function(data){
                    if(data == 2){
                        $("#msg").html('<span style="color: red;">该推荐人不存在，请确认推荐人ID是否填写错误！</span>');
                    }else{
                        $("#msg").html('<span style="color: green;">推荐人ID：'+data.member_id+'，推荐人姓名：'+data.member_name+'，推荐人手机：'+data.member_mobile+'</span>');
                    }
                }
            });
        }else{
            $("#msg").html('');
        }
    });
</script>
</body>
</html>