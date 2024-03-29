<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"/www/wwwroot/default/tpadmin/addons/cms/view/default/common/formfield.html";i:1549411004;}*/ ?>

<?php foreach($fields as $item): ?>

<div class="input-group">
    <div class="labels"><?php echo $item['title']; ?></div>
        <?php switch($item['type']): case "string": if(in_array($item['name'],['area','city'])): ?>
        <div style="position:relative;">
         <input type="text" name="row[<?php echo $item['name']; ?>]" id="c-<?php echo $item['name']; ?>" value="<?php echo $item['value']; ?>" class="form-control" data-rule="<?php echo $item['rule']; ?>" data-tip="<?php echo $item['tip']; ?>" data-responsive="true" <?php echo $item['extend']; ?>/>
     	</div>
        <?php else: ?>
 		<input type="text" name="row[<?php echo $item['name']; ?>]" id="c-<?php echo $item['name']; ?>" value="<?php echo $item['value']; ?>" class="form-control" data-rule="<?php echo $item['rule']; ?>" data-tip="<?php echo $item['tip']; ?>" <?php echo $item['extend']; ?>/>
        <?php endif; break; case "text": case "editor": ?>
        <textarea name="row[<?php echo $item['name']; ?>]" id="c-<?php echo $item['name']; ?>" class="form-control <?php if($item['type'] == 'editor'): ?>editor<?php endif; ?>" data-rule="<?php echo $item['rule']; ?>" rows="5" data-tip="<?php echo $item['tip']; ?>" <?php echo $item['extend']; ?>><?php echo $item['value']; ?></textarea>
        <?php break; case "array": $arrList=isset($values[$item['name']])?(array)json_decode($item['value'],true):$item['content_list']; ?>
        <dl class="fieldlist" rel="<?php echo count($arrList); ?>" data-name="row[<?php echo $item['name']; ?>]">
            <dd>
                <ins><?php echo __('Array key'); ?></ins>
                <ins><?php echo __('Array value'); ?></ins>
            </dd>

            <?php foreach($arrList as $key => $vo): ?>
            <dd class="form-inline">
                <input type="text" name="row[<?php echo $item['name']; ?>][field][<?php echo $key; ?>]" class="form-control" value="<?php echo $key; ?>" size="10"/>
                <input type="text" name="row[<?php echo $item['name']; ?>][value][<?php echo $key; ?>]" class="form-control" value="<?php echo $vo; ?>" size="40"/>
                <span class="btn btn-sm btn-danger btn-remove"><i class="fa fa-times"></i></span>
                <span class="btn btn-sm btn-primary btn-dragsort"><i class="fa fa-arrows"></i></span>
            </dd>
            <?php endforeach; ?>
            <dd><a href="javascript:;" class="append btn btn-sm btn-success"><i class="fa fa-plus"></i> <?php echo __('Append'); ?></a></dd>
        </dl>
        <?php break; case "date": ?>
        <input type="text" name="row[<?php echo $item['name']; ?>]" id="c-<?php echo $item['name']; ?>" value="<?php echo $item['value']; ?>" class="form-control datetimepicker" data-date-format="YYYY-MM-DD" data-tip="<?php echo $item['tip']; ?>" data-rule="<?php echo $item['rule']; ?>" <?php echo $item['extend']; ?>/>
        <?php break; case "time": ?>
        <input type="text" name="row[<?php echo $item['name']; ?>]" id="c-<?php echo $item['name']; ?>" value="<?php echo $item['value']; ?>" class="form-control datetimepicker" data-date-format="HH:mm:ss" data-tip="<?php echo $item['tip']; ?>" data-rule="<?php echo $item['rule']; ?>" <?php echo $item['extend']; ?>/>
        <?php break; case "datetime": ?>
        <input type="text" name="row[<?php echo $item['name']; ?>]" id="c-<?php echo $item['name']; ?>" value="<?php echo $item['value']; ?>" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-tip="<?php echo $item['tip']; ?>" data-rule="<?php echo $item['rule']; ?>" <?php echo $item['extend']; ?>/>
        <?php break; case "number": ?>
        <input type="number" name="row[<?php echo $item['name']; ?>]" id="c-<?php echo $item['name']; ?>" value="<?php echo $item['value']; ?>" class="form-control" data-tip="<?php echo $item['tip']; ?>" data-rule="<?php echo $item['rule']; ?>" <?php echo $item['extend']; ?>/>
        <?php break; case "checkbox": if(is_array($item['content_list']) || $item['content_list'] instanceof \think\Collection || $item['content_list'] instanceof \think\Paginator): if( count($item['content_list'])==0 ) : echo "" ;else: foreach($item['content_list'] as $key=>$vo): ?>
        <label for="row[<?php echo $item['name']; ?>][]-<?php echo $key; ?>"><input id="row[<?php echo $item['name']; ?>][]-<?php echo $key; ?>" name="row[<?php echo $item['name']; ?>][]" type="checkbox" value="<?php echo $key; ?>" data-rule="<?php echo $item['rule']; ?>" data-tip="<?php echo $item['tip']; ?>" <?php if(in_array(($key), is_array($item['value'])?$item['value']:explode(',',$item['value']))): ?>checked<?php endif; ?> /> <?php echo $vo; ?></label>
        <?php endforeach; endif; else: echo "" ;endif; break; case "radio": if(is_array($item['content_list']) || $item['content_list'] instanceof \think\Collection || $item['content_list'] instanceof \think\Paginator): if( count($item['content_list'])==0 ) : echo "" ;else: foreach($item['content_list'] as $key=>$vo): ?>
        <label for="row[<?php echo $item['name']; ?>]-<?php echo $key; ?>"><input id="row[<?php echo $item['name']; ?>]-<?php echo $key; ?>" name="row[<?php echo $item['name']; ?>]" type="radio" value="<?php echo $key; ?>" data-rule="<?php echo $item['rule']; ?>" data-tip="<?php echo $item['tip']; ?>" <?php if(in_array(($key), is_array($item['value'])?$item['value']:explode(',',$item['value']))): ?>checked<?php endif; ?> /> <?php echo $vo; ?></label>
        <?php endforeach; endif; else: echo "" ;endif; break; case "select": case "selects": ?>
        <select name="row[<?php echo $item['name']; ?>]<?php echo $item['type']=='selects'?'[]':''; ?>" class="form-control" data-rule="<?php echo $item['rule']; ?>" data-tip="<?php echo $item['tip']; ?>" <?php echo $item['extend']; ?> <?php echo $item['type']=='selects'?'multiple':''; ?>>
            <?php if(is_array($item['content_list']) || $item['content_list'] instanceof \think\Collection || $item['content_list'] instanceof \think\Paginator): if( count($item['content_list'])==0 ) : echo "" ;else: foreach($item['content_list'] as $key=>$vo): ?>
            <option value="<?php echo $key; ?>" <?php if(in_array(($key), is_array($item['value'])?$item['value']:explode(',',$item['value']))): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
        <?php break; case "image": case "images": ?>
        <div class="input-group">
            <input id="c-<?php echo $item['name']; ?>" class="form-control" name="row[<?php echo $item['name']; ?>]" type="text" value="<?php echo $item['value']; ?>" data-rule="<?php echo $item['rule']; ?>" data-tip="<?php echo $item['tip']; ?>">
            <div class="input-group-addon no-border no-padding">
                <span><button type="button" id="plupload-<?php echo $item['name']; ?>" class="btn btn-danger plupload" data-input-id="c-<?php echo $item['name']; ?>" data-preview-id="p-<?php echo $item['name']; ?>" data-mimetype="image/gif,image/jpeg,image/png,image/jpg,image/bmp" data-multiple="<?php echo $item['type']=='file'?'false':'true'; ?>" <?php if($item['maximum']): ?>data-maxcount="<?php echo $item['maximum']; ?>" <?php endif; ?>><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>
                <span class="msg-box n-right" for="c-<?php echo $item['name']; ?>"></span>
            </div>
        </div>
        <ul class="row list-inline plupload-preview" id="p-<?php echo $item['name']; ?>"></ul>
        <?php break; case "file": case "files": ?>
        <div class="input-group">
            <input id="c-<?php echo $item['name']; ?>" class="form-control" name="row[<?php echo $item['name']; ?>]" type="text" value="<?php echo $item['value']; ?>" data-rule="<?php echo $item['rule']; ?>" data-tip="<?php echo $item['tip']; ?>">
            <div class="input-group-addon no-border no-padding">
                <span><button type="button" id="plupload-<?php echo $item['name']; ?>" class="btn btn-danger plupload" data-input-id="c-<?php echo $item['name']; ?>" data-multiple="<?php echo $item['type']=='file'?'false':'true'; ?>" <?php if($item['maximum']): ?>data-maxcount="<?php echo $item['maximum']; ?>" <?php endif; ?>><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>
                <span class="msg-box n-right" for="c-<?php echo $item['name']; ?>"></span>
            </div>
        </div>
        <?php break; case "switch": ?>
        <input id="c-<?php echo $item['name']; ?>" name="row[<?php echo $item['name']; ?>]" type="hidden" value="<?php echo $item['value']?1:0; ?>">
        <a href="javascript:;" data-toggle="switcher" class="btn-switcher" data-input-id="c-<?php echo $item['name']; ?>" data-yes="1" data-no="0">
            <i class="fa fa-toggle-on text-success <?php if(!$item['value']): ?>fa-flip-horizontal text-gray<?php endif; ?> fa-2x"></i>
        </a>
        <?php break; case "bool": ?>
        <label for="row[<?php echo $item['name']; ?>]-yes"><input id="row[<?php echo $item['name']; ?>]-yes" name="row[<?php echo $item['name']; ?>]" type="radio" value="1" <?php echo !empty($item['value'])?'checked':''; ?> data-tip="<?php echo $item['tip']; ?>" /> <?php echo __('Yes'); ?></label>
        <label for="row[<?php echo $item['name']; ?>]-no"><input id="row[<?php echo $item['name']; ?>]-no" name="row[<?php echo $item['name']; ?>]" type="radio" value="0" <?php echo !empty($item['value'])?'':'checked'; ?> data-tip="<?php echo $item['tip']; ?>" /> <?php echo __('No'); ?></label>
        <?php break; case "custom": ?>
        <?php echo $item['content']; break; endswitch; ?>
</div>
<?php endforeach; ?>