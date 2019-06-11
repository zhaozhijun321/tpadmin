<?php

namespace addons\cms\model;

use think\Cache;
use think\Db;
use think\Model;

/**
 * 文章模型
 */
class Archives Extends Model
{

    protected $name = "cms_archives";
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    // 追加属性
    protected $append = [
        'url',
        'fullurl',
        'likeratio',
        'tagslist',
        'create_date',
    ];
    protected static $config = [];

    public function __call($method, $args)
    {
        return parent::__call($method, $args);
    }

    /**
     * 批量设置数据
     * @param $data
     * @return $this
     */
    public function setData($data)
    {
        if (is_object($data)) {
            $data = get_object_vars($data);
        }
        $this->data = array_merge($this->data, $data);
        return $this;
    }

    protected static function init()
    {
        $config = get_addon_config('cms');
        self::$config = $config;
    }

    public function getCreateDateAttr($value, $data)
    {
        return human_date($data['createtime']);
    }

    public function getImageAttr($value, $data)
    {
        $value = $value ? $value : self::$config['default_archives_img'];
        return cdnurl($value, true);
    }

    public function getContentAttr($value, $data)
    {
        //如果内容中包含有付费标签
        $value = str_replace(['##paidbegin##', '##paidend##'], ['<paid>', '</paid>'], $value);
        $pattern = '/<paid>(.*?)<\/paid>/is';
        if (preg_match($pattern, $value) && !$this->getAttr('ispay')) {
            $payurl = addon_url('cms/order/submit', ['id' => $data['id']]);
            $value = preg_replace($pattern, "<div class='alert alert-warning alert-paid'><a href='{$payurl}' target='_blank'>内容已经隐藏，点击付费后查看</a></div>", $value);
        }
        return $value;
    }

    /**
     * 获取金额
     */
    public function getPriceAttr($value, &$data)
    {
        if (isset($data['price'])) {
            return $data['price'];
        }
        $price = 0;
        if (isset($data['model_id'])) {
            $model = Modelx::get($data['model_id']);
            if ($model && in_array('price', $model['fields'])) {
                $price = \think\Db::name($model['table'])->where('id', $data['id'])->value('price');
            }
        }
        $data['price'] = $price;
        return $price;
    }

    /**
     * 判断是否支付
     */
    public function getIspayAttr($value, &$data)
    {
        if (isset($data['ispay'])) {
            return $data['ispay'];
        }
        $data['ispay'] = Order::checkOrder($data['id']);
        return $data['ispay'];
    }

    public function getTagslistAttr($value, $data)
    {
        $list = [];
        foreach (array_filter(explode(",", $data['tags'])) as $k => $v) {
            $list[] = ['name' => $v, 'url' => addon_url('cms/tags/index', [':name' => $v])];
        }
        return $list;
    }

    public function getUrlAttr($value, $data)
    {
        $diyname = $data['diyname'] ? $data['diyname'] : $data['id'];
        return addon_url('cms/archives/index', [':id' => $data['id'], ':diyname' => $diyname, ':channel' => $data['channel_id']]);
    }

    public function getFullUrlAttr($value, $data)
    {
        $diyname = $data['diyname'] ? $data['diyname'] : $data['id'];
        return addon_url('cms/archives/index', [':id' => $data['id'], ':diyname' => $diyname, ':channel' => $data['channel_id']], true, true);
    }

    public function getLikeratioAttr($value, $data)
    {
        return ($data['dislikes'] > 0 ? min(1, $data['likes'] / ($data['dislikes'] + $data['likes'])) : ($data['likes'] ? 1 : 0.5)) * 100;
    }

    /**
     * 获取文档列表
     * @param $tag
     * @return array|false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function getArchivesList($tag)
    {
        $type = empty($tag['type']) ? '' : $tag['type'];
        $model = !isset($tag['model']) ? '' : $tag['model'];
        $channel = !isset($tag['channel']) ? '' : $tag['channel'];
        $tags = empty($tag['tags']) ? '' : $tag['tags'];
        $condition = empty($tag['condition']) ? '' : $tag['condition'];
        // var_dump($condition );
        // exit;
        $field = empty($params['field']) ? '*' : $params['field'];
        $flag = empty($tag['flag']) ? '' : $tag['flag'];
        $row = empty($tag['row']) ? 10 : (int)$tag['row'];
        $orderby = empty($tag['orderby']) ? 'createtime' : $tag['orderby'];
        $orderway = empty($tag['orderway']) ? 'desc' : strtolower($tag['orderway']);
        $limit = empty($tag['limit']) ? $row : $tag['limit'];
        $cache = !isset($tag['cache']) ? true : (int)$tag['cache'];
        $imgwidth = empty($tag['imgwidth']) ? '' : $tag['imgwidth'];
        $imgheight = empty($tag['imgheight']) ? '' : $tag['imgheight'];
        $addon = empty($tag['addon']) ? false : $tag['addon'];
        $orderway = in_array($orderway, ['asc', 'desc']) ? $orderway : 'desc';
        $where = ['status' => 'normal'];

        $where['deletetime'] = ['exp', Db::raw('IS NULL')]; //by erastudio
        if ($model !== '') {
            $where['model_id'] = ['in', $model];
        }
        if ($channel !== '') {
            $where['channel_id'] = ['in', $channel];
        }
        //如果有设置标志,则拆分标志信息并构造condition条件
        if ($flag !== '') {
            if (stripos($flag, '&') !== false) {
                $arr = [];
                foreach (explode('&', $flag) as $k => $v) {
                    $arr[] = "FIND_IN_SET('{$v}', flag)";
                }
                if ($arr)
                    $condition .= "(" . implode(' AND ', $arr) . ")";
            } else {
                $condition .= ($condition ? ' AND ' : '');
                $arr = [];
                foreach (array_merge(explode(',', $flag), explode('|', $flag)) as $k => $v) {
                    $arr[] = "FIND_IN_SET('{$v}', flag)";
                }
                if ($arr)
                    $condition .= "(" . implode(' OR ', $arr) . ")";
            }
        }
        $order = $orderby == 'rand' ? 'rand()' : (in_array($orderby, ['createtime', 'updatetime', 'views', 'weigh', 'id','publishtime']) ? "{$orderby} {$orderway}" : "createtime {$orderway}");

        $archivesModel = self::with('channel');
        // 如果有筛选标签,则采用子查询
        if ($tags) {
            $tagsList = Tags::where('name', 'in', explode(',', $tags))->cache($cache)->limit($limit)->select();
            $archives = [];
            foreach ($tagsList as $k => $v) {
                $archives = array_merge($archives, explode(',', $v['archives']));
            }
            if ($archives) {
                $archivesModel->where('id', 'in', $archives);
            }
        }
        $list = $archivesModel
            ->where($where)
            ->where($condition)
            ->field($field)
            ->cache($cache)
            ->order($order)
            ->limit($limit)
            ->select();
        //$list = collection($list)->toArray();
        //如果有设置附表和模型(或栏目)，则查询副表的数据
        if ($addon && (is_numeric($model) || $channel)) {
            if ($channel) {
                //如果channel设置了多个值则只取第一个作为判断
                $channelArr = explode(',', $channel);
                $channelinfo = Channel::get($channelArr[0], [], true);
                $model = $channelinfo ? $channelinfo['model_id'] : $model;
            }
            // 查询相关联的模型信息
            $modelInfo = Modelx::get($model, [], true);
            if ($modelInfo) {
                $query = Db::name($modelInfo['table']);
                if ($addon == 'true') {
                    $query->field('content', true);
                } else {
                    $query->field($addon);
                }
                $addonList = $query
                    ->where('id', 'in', array_map(function ($value) {
                        return $value['id'];
                    }, $list))
                    ->cache($cache)
                    ->select();
                $fieldsContentList = [];
                if ($modelInfo->fields) {
                    $fieldsContentList = $modelInfo->getFieldsContentList($modelInfo->id);
                }

                //循环主表
                foreach ($list as $index => &$item) {
                    //循环副表
                    foreach ($addonList as $subindex => $subitem) {
                        if ($subitem['id'] == $item['id']) {
                            array_walk($fieldsContentList, function ($content, $field) use (&$subitem) {
                                $subitem[$field . '_text'] = isset($content[$subitem[$field]]) ? $content[$subitem[$field]] : $subitem[$field];
                            });
                            //$item = array_merge($item, $subitem);
                            $item->setData($subitem);
                            unset($addonList[$subindex]);
                            continue 2;
                        }
                    }
                    //副表错误的数据将会被忽略
                    unset($list[$index]);
                }
                unset($item);
            }
        }

        self::render($list, $imgwidth, $imgheight);
        return $list;
    }

    /**
     * 渲染数据
     * @param array $list
     * @param int $imgwidth
     * @param int $imgheight
     * @return array
     */
    public static function render(&$list, $imgwidth, $imgheight)
    {
        $width = $imgwidth ? 'width="' . $imgwidth . '"' : '';
        $height = $imgheight ? 'height="' . $imgheight . '"' : '';
        foreach ($list as $k => &$v) {
            $v['hasimage'] = $v['image'] ? true : false;
            $v['textlink'] = '<a href="' . $v['url'] . '">' . $v['title'] . '</a>';
            $v['channellink'] = '<a href="' . $v['channel']['url'] . '">' . $v['channel']['name'] . '</a>';
            $v['imglink'] = '<a href="' . $v['url'] . '"><img src="' . $v['image'] . '" border="" ' . $width . ' ' . $height . ' /></a>';
            $v['img'] = '<img src="' . $v['image'] . '" border="" ' . $width . ' ' . $height . ' />';
        }
        return $list;
    }

    /**
     * 获取分页列表
     * @param array $list
     * @param array $tag
     * @return array
     */
    public static function getPageList($list, $tag)
    {
        $imgwidth = empty($tag['imgwidth']) ? '' : $tag['imgwidth'];
        $imgheight = empty($tag['imgheight']) ? '' : $tag['imgheight'];
        return self::render($list, $imgwidth, $imgheight);
    }

    /**
     * 获取分页信息
     * @param array $list
     * @param array $tag
     * @return string
     */
    public static function getPageInfo($list, $tag)
    {
        return '';
    }

    /**
     * 获取分页过滤
     * @param array $list
     * @param array $tag
     * @return array
     */
    public static function getPageFilter($list, $tag)
    {
        $exclude = empty($tag['exclude']) ? '' : $tag['exclude'];
        return $list;
    }

    /**
     * 获取分页排序
     * @param array $list
     * @param array $tag
     * @return array
     */
    public static function getPageOrder($list, $tag)
    {
        $exclude = empty($tag['exclude']) ? '' : $tag['exclude'];
        return $list;
    }

    /**
     * 获取上一页下一页
     * @param string $type
     * @param string $archives
     * @param string $channel
     * @return array
     */
    public static function getPrevNext($type, $archives, $channel)
    {
        $model = self::where('id', $type === 'prev' ? '<' : '>', $archives)->where('status', 'normal');
        if ($channel !== '') {
            $model->where('channel_id', 'in', $channel);
        }
        $model->order($type === 'prev' ? 'id desc' : 'id asc');
        $row = $model->find();
        return $row;
    }

    /**
     * 获取SQL查询结果
     */
    public static function getQueryList($tag)
    {
        $sql = isset($tag['sql']) ? $tag['sql'] : '';
        $bind = isset($tag['bind']) ? $tag['bind'] : [];
        $cache = !isset($tag['cache']) ? true : (int)$tag['cache'];
        $name = md5("sql-" . $tag['sql']);
        $list = Cache::get($name);
        if (!$list) {
            $list = \think\Db::query($sql, $bind);
            Cache::set($name, $list, $cache);
        }
        return $list;
    }

    /**
     * 关联栏目模型
     */
    public function channel()
    {
        return $this->belongsTo("Channel")->field('id,name,image,diyname,items')->setEagerlyType(1);
    }

     /**
     * 获取研讨会信息的排课列表
     */

     public static function getYantaoList($tag){
        $row = empty($tag['row']) ? 10 : (int)$tag['row'];
        $ispage = empty($tag['ispage']) ? false :$tag['ispage'];
        $page = empty($tag['page']) ? 0 : (int)$tag['page'];
        $datetoday = empty($tag['date']) ? date('Y-m-d') : $tag['date'];
        $orderby = empty($tag['orderby']) ? 'begintime' : $tag['orderby'];
        $orderway = empty($tag['orderway']) ? 'asc' : strtolower($tag['orderway']);
        $limit = empty($tag['limit']) ? $row : $tag['limit'];
        $count=0;
        $pagenum=0;
         //如果 开启分页
        if($ispage==true){
            $count = \app\admin\model\cms\Kecheng::with(['Archives'=>function($query){
             $query->field('title');
        },'Chanpin','Channel'=>function($query){
                 $query->where("diyname",'yantaohuixinxi');
                }])
                ->order($orderby,$orderway)
                ->whereTime('endtime', '>=',$datetoday)
                ->count();
            $allpagenum = ceil($count/$limit) ?0: $count; 
            $pagenum = $page;
            if($pagenum>$allpagenum-1){
                return false;
            }
        }
        $yantaohui = \app\admin\model\cms\Kecheng::with(['Archives'=>function($query){
             $query->field('title');
        },'Chanpin','Channel'=>function($query){
                 $query->where("diyname",'yantaohuixinxi');
                }])->where(function($query)use($ispage,$datetoday){
                    if($ispage==true){
                        $query->limit($pagenum*$limit,$limit)->whereTime('endtime', '>=',$datetoday);
                    }else{
                        $query->whereTime('endtime', '>=',$datetoday)->whereTime('begintime', '<=',date('Y-m-d',strtotime('+15day')));
                    }
                }) 
                ->order($orderby,$orderway)
                ->select();
         if($ispage==true){
             return ['item'=>$yantaohui,'total'=>$yantaohui->count()];

         }
         return $yantaohui;
     }

     //获取专家对应的课程

      public static function getzhujia($tag){
        $row = empty($tag['row']) ? 10 : (int)$tag['row'];
        $expertid = empty($tag['expert']) ? '0' : (int)$tag['expert'];
        $ispage = empty($tag['ispage']) ? false :$tag['ispage'];
        $page = empty($tag['page']) ? 0 : (int)$tag['page'];
        $datetoday = empty($tag['date']) ? date('Y-m-d') : $tag['date'];
        $orderby = empty($tag['orderby']) ? 'id' : $tag['orderby'];
        $orderway = empty($tag['orderway']) ? 'asc' : strtolower($tag['orderway']);
        $limit = empty($tag['limit']) ? $row : $tag['limit'];
       
        $yantaohui = \app\admin\model\cms\Kecheng::with('Chanpin')->where('kecheng.channel_id','=',function($query){
                            $query->name('cms_channel')->where("diyname",'chanpinyufuw')->field('id');
                })->where('kecheng.id','in',function($query)use($expertid){
                    $query->name('experts_kecheng')->where('experts_id',$expertid)->field('kecheng_id');
                })->order($orderby,$orderway)->group('chanpin.id')->column('chanpin.id');
        $data = \app\admin\model\cms\Archives::where(function($query)use($yantaohui){
                if(!empty(is_array($yantaohui))){
                   $query->where('id','in',$yantaohui);
                }else{
                    $query->where('id',0);
                }
            })->limit($limit)->select();
         return $data;
     }
}
// ->with(['chanpin','channel'=>function($query){

//                  $query->where("diyname",'chanpinyufuw');
//                 }])