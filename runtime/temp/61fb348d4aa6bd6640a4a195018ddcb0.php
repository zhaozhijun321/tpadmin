<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:83:"/www/wwwroot/default/tpadmin/public/../application/admin/view/cms/kecheng/list.html";i:1550525536;}*/ ?>
 <div class="form-group">
        <div class="control-label col-xs-12 col-sm-2">选择产品</div>
        <div class="col-xs-12 col-sm-8">
            <select name="row[chanpin_id]" class="form-control selectpicker" data-rule="true" data-tip="<?php echo $item['tip']; ?>" <?php echo $item['extend']; ?> <?php echo $item['type']=='selects'?'multiple':''; ?>  id="chanpinid" data-live-search="true">
            <?php if(is_array($chanpin_list) || $chanpin_list instanceof \think\Collection || $chanpin_list instanceof \think\Paginator): if( count($chanpin_list)==0 ) : echo "" ;else: foreach($chanpin_list as $key=>$vo): ?>
              <option value="<?php echo $vo['id']; ?>" <?php if(in_array(($vo['id']), is_array($list['chanpin_id'])?$list['chanpin_id']:explode(',',$list['chanpin_id']))): ?>selected<?php endif; ?>><?php echo $vo['title']; ?></option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>  
        </div>
    </div>