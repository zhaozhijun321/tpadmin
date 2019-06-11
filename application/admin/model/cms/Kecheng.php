<?php

namespace app\admin\model\cms;

use think\Model;

class Kecheng extends Model
{

    // 表名
    protected $name = 'cms_kecheng';
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    // 追加属性
    protected $append = [
        'status_text'
    ];

    public function getStatusList()
    {
        return ['normal' => __('Normal'), 'hidden' => __('Hidden')];
    }

    public function getStatusTextAttr($value, $data)
    {
        $value = $value ? $value : $data['status'];
        $list = $this->getStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }

     public function channel()
    {
        return $this->belongsTo('Channel', 'channel_id', '', [], 'LEFT')->setEagerlyType(0);
    }
     public function Chanpin()
    {
        return $this->belongsTo('Archives', 'chanpin_id', '', [], 'LEFT')->setEagerlyType(0);
    }
     public function Archives()
    {
        return $this->belongsToMany('Archives', '\app\admin\model\cms\ExpertsKecheng', 'experts_id','kecheng_id',[]);
    }

     public function setData($data)
    {
        if (is_object($data)) {
            $data = get_object_vars($data);
        }
        $this->data = array_merge($this->data, $data);
        return $this;
    }
}
