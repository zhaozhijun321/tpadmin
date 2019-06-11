<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:82:"/www/wwwroot/default/tpadmin/public/../application/admin/view/cms/kecheng/add.html";i:1550536156;s:71:"/www/wwwroot/default/tpadmin/application/admin/view/layout/default.html";i:1541071580;s:68:"/www/wwwroot/default/tpadmin/application/admin/view/common/meta.html";i:1541071580;s:70:"/www/wwwroot/default/tpadmin/application/admin/view/common/script.html";i:1541071580;}*/ ?>
<!DOCTYPE html>
<html lang="<?php echo $config['language']; ?>">
    <head>
        <meta charset="utf-8">
<title><?php echo (isset($title) && ($title !== '')?$title:''); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">

<link rel="shortcut icon" href="/assets/img/favicon.ico" />
<!-- Loading Bootstrap -->
<link href="/assets/css/backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
  <script src="/assets/js/html5shiv.js"></script>
  <script src="/assets/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
    var require = {
        config:  <?php echo json_encode($config); ?>
    };
</script>
    </head>

    <body class="inside-header inside-aside <?php echo defined('IS_DIALOG') && IS_DIALOG ? 'is-dialog' : ''; ?>">
        <div id="main" role="main">
            <div class="tab-content tab-addtabs">
                <div id="content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section class="content-header hide">
                                <h1>
                                    <?php echo __('Dashboard'); ?>
                                    <small><?php echo __('Control panel'); ?></small>
                                </h1>
                            </section>
                            <?php if(!IS_DIALOG && !$config['fastadmin']['multiplenav']): ?>
                            <!-- RIBBON -->
                            <div id="ribbon">
                                <ol class="breadcrumb pull-left">
                                    <li><a href="dashboard" class="addtabsit"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
                                </ol>
                                <ol class="breadcrumb pull-right">
                                    <?php foreach($breadcrumb as $vo): ?>
                                    <li><a href="javascript:;" data-url="<?php echo $vo['url']; ?>"><?php echo $vo['title']; ?></a></li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                            <!-- END RIBBON -->
                            <?php endif; ?>
                            <div class="content">
                                <form id="add-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">

    <div class="form-group">
        <div class="control-label col-xs-12 col-sm-2">选择发布栏目</div>
        <div class="col-xs-12 col-sm-8">
            <select name="row[channel_id]" class="form-control selectpicker" data-rule="true" data-tip="<?php echo $item['tip']; ?>" <?php echo $item['extend']; ?> <?php echo $item['type']=='selects'?'multiple':''; ?>  id="channel_id" >
            <?php if(is_array($channel_list) || $channel_list instanceof \think\Collection || $channel_list instanceof \think\Paginator): if( count($channel_list)==0 ) : echo "" ;else: foreach($channel_list as $key=>$vo): ?>
              <option value="<?php echo $vo['id']; ?>" <?php if(in_array(($vo['id']), is_array($item['value'])?$item['value']:explode(',',$item['value']))): ?>selected<?php endif; ?>><?php echo $vo['name']; ?></option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>  
        </div>
    </div>
    <div id="extend"></div>
    <div class="form-group">
        <label for="c-flag" class="control-label col-xs-12 col-sm-2"><?php echo __('选择专家'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
        <?php echo build_select('expertsid[]', $groupdata, $groupids, ['class'=>'form-control selectpicker', 'multiple'=>'', 'data-rule'=>'required']); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="control-label col-xs-12 col-sm-2">附件</div>
        <div class="col-xs-12 col-sm-8">
            <div class="input-group">
            <input id="c-qitafile" class="form-control" name="row[qitafile]" type="text" value="<?php echo $item['value']; ?>" data-rule="<?php echo $item['rule']; ?>" data-tip="<?php echo $item['tip']; ?>">
            <div class="input-group-addon no-border no-padding">
                <span><button type="button" id="plupload-qitafile" class="btn btn-danger plupload" data-input-id="c-qitafile" data-multiple="false" <?php if($item['maximum']): ?>data-maxcount="<?php echo $item['maximum']; ?>"<?php endif; ?>><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>
                <span><button type="button" id="fachoose-qitafile" class="btn btn-primary fachoose" data-input-id="c-<?php echo $item['name']; ?>" data-multiple="false" <?php if($item['maximum']): ?> data-maxcount="<?php echo $item['maximum']; ?>"<?php endif; ?>><i class="fa fa-list"></i> <?php echo __('Choose'); ?></button></span>
            </div>
            <span class="msg-box n-right" for="c-<?php echo $item['name']; ?>"></span>
            </div>
        </div>
    </div>
     <div class="form-group">
        <div class="control-label col-xs-12 col-sm-2">开始时间</div>
        <div class="col-xs-12 col-sm-8">
             <input type="text" name="row[begintime]" id="c-begintime" value="<?php echo $item['value']; ?>" class="form-control datetimepicker" data-date-format="YYYY-MM-DD" data-tip="<?php echo $item['tip']; ?>" data-rule="<?php echo $item['rule']; ?>" <?php echo $item['extend']; ?> />
        </div>
    </div>
     <div class="form-group">
        <div class="control-label col-xs-12 col-sm-2">结束时间</div>
        <div class="col-xs-12 col-sm-8">
            <input type="text" name="row[endtime]" id="c-endtime" value="<?php echo $item['value']; ?>" class="form-control datetimepicker" data-date-format="YYYY-MM-DD" data-tip="<?php echo $item['tip']; ?>" data-rule="<?php echo $item['rule']; ?>" <?php echo $item['extend']; ?> />
        </div>
    </div>
     <div class="form-group">
        <div class="control-label col-xs-12 col-sm-2">地点</div>
        <div class="col-xs-12 col-sm-8">
            <textarea name="row[area]" id="c-didian" class="form-control editor" data-rule="<?php echo $item['rule']; ?>" rows="5" data-tip="<?php echo $item['tip']; ?>" <?php echo $item['extend']; ?>><?php echo $item['value']; ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Status'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <select  id="c-status" class="form-control selectpicker" name="row[status]">
                <?php if(is_array($statusList) || $statusList instanceof \think\Collection || $statusList instanceof \think\Paginator): if( count($statusList)==0 ) : echo "" ;else: foreach($statusList as $key=>$vo): ?>
                <option value="<?php echo $key; ?>" <?php if(in_array(($key), explode(',',""))): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
    </div>
    <div class="form-group layer-footer">
        <label class="control-label col-xs-12 col-sm-2"></label>
        <div class="col-xs-12 col-sm-8">
            <button type="submit" class="btn btn-success btn-embossed disabled"><?php echo __('OK'); ?></button>
            <button type="reset" class="btn btn-default btn-embossed"><?php echo __('Reset'); ?></button>
        </div>
    </div>
</form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo $site['version']; ?>"></script>
    </body>
</html>