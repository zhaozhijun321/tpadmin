<?php

namespace addons\cms\controller;

use addons\cms\model\Archives;
use addons\cms\model\Channel as ChannelModel;
use addons\cms\model\Modelx;
use think\Config;
use addons\cms\model\Tags as TagsModel;
use addons\cms\model\Diyform as DiyformModel;
/**
 * 栏目控制器
 * Class Channel
 * @package addons\cms\controller
 */
class Channel extends Base
{

    public function index()
    {
        $diyname = $this->request->param('diyname');

        if ($diyname && !is_numeric($diyname)) {
            $channel = ChannelModel::getByDiyname($diyname);
        } else {
            $id = $diyname ? $diyname : $this->request->param('id', '');
            $channel = ChannelModel::get($id);
        }
        if (!$channel) {
            $this->error(__('No specified channel found'));
        }

        $filterlist = [];
        $orderlist = [];

        $filter = $this->request->get('filter/a', []);
        $orderby = $this->request->get('orderby', '');
        $orderway = $this->request->get('orderway', '', 'strtolower');
        $params = ['filter' => '', 'id' => $channel->id, 'diyname' => $channel->diyname];
        if ($filter)
            $params['filter'] = $filter;
        if ($orderby)
            $params['orderby'] = $orderby;
        if ($orderway)
            $params['orderway'] = $orderway;
        if ($channel['type'] === 'link') {
            $this->redirect($channel['outlink']);
        }

        $model = Modelx::get($channel['model_id']);
        if (!$model) {
            $this->error(__('No specified model found'));
        }
        $fields = [];
        foreach ($model->fields_list as $k => $v) {
            if (!$v['isfilter'] || !in_array($v['type'], ['select', 'selects', 'checkbox', 'radio', 'array']) || !$v['content_list'])
                continue;
            $fields[] = [
                'name' => $v['name'], 'title' => $v['title'], 'content' => $v['content_list']
            ];
        }
        $filter = array_intersect_key($filter, array_flip(array_column($fields, 'name')));
        foreach ($fields as $k => $v) {
            $content = [];
            $all = ['' => __('All')] + $v['content'];
            foreach ($all as $m => $n) {
                $active = ($m === '' && !isset($filter[$v['name']])) || (isset($filter[$v['name']]) && $filter[$v['name']] == $m) ? TRUE : FALSE;
                $prepare = $m === '' ? array_diff_key($filter, [$v['name'] => $m]) : array_merge($filter, [$v['name'] => $m]);
                $url = '?' . http_build_query(array_merge(['filter' => $prepare], array_diff_key($params, ['filter' => ''])));
                $content[] = ['value' => $m, 'title' => $n, 'active' => $active, 'url' => $url];
            }
            $filterlist[] = [
                'name'    => $v['name'],
                'title'   => $v['title'],
                'content' => $content,
            ];
        }

        $sortrank = [
            ['name' => 'default', 'field' => 'weigh', 'title' => __('Default')],
            ['name' => 'views', 'field' => 'views', 'title' => __('Views')],
            ['name' => 'id', 'field' => 'id', 'title' => __('Post date')],
        ];

        $orderby = $orderby && in_array($orderby, ['default', 'id', 'views']) ? $orderby : 'default';
        $orderway = $orderway ? $orderway : 'desc';
        foreach ($sortrank as $k => $v) {
            $url = '?' . http_build_query(array_merge($params, ['orderby' => $v['name'], 'orderway' => ($orderway == 'desc' ? 'asc' : 'desc')]));
            $v['active'] = $orderby == $v['name'] ? true : false;
            $v['orderby'] = $orderway;
            $v['url'] = $url;
            $orderlist[] = $v;
        }
        $orderby = $orderby == 'default' ? 'publishtime' : $orderby;
        $pagelist = Archives::alias('a')
            ->where('status', 'normal')
            ->where('deletetime', 'exp', \think\Db::raw('IS NULL'))
            ->where($filter)
            ->join($model['table'] . ' n', 'a.id=n.id', 'LEFT')
            ->field('a.*')
            ->field('id,content', true, config('database.prefix') . $model['table'], 'n')
            ->where('channel_id', $channel['id'])
            ->order($orderby, $orderway)
            ->paginate($channel['pagesize'], false, ['type' => '\\addons\\cms\\library\\Bootstrap']);
        $pagelist->appends($params);
        $this->view->assign("__FILTERLIST__", $filterlist);
        $this->view->assign("__ORDERLIST__", $orderlist);
        $this->view->assign("__PAGELIST__", $pagelist);
        // var_dump($channel);
        //输出内容实体转化
        $channel->description = htmlspecialchars_decode($channel->description);
        $this->view->assign("__CHANNEL__", $channel);
        Config::set('cms.title', $channel['name']);
        Config::set('cms.keywords', $channel['keywords']);
        Config::set('cms.description', $channel['description']);
        $template = preg_replace('/\.html$/', '', $channel["{$channel['type']}tpl"]);
        //获取表单自定义字段
        $fields = DiyformModel::getDiyformFields(1);
        $data = [
            'fields' => $fields
        ];
         $diyform['fieldslist'] = $this->fetch('common/formfield', $data);
        $this->assign('diyform', $diyform);
        return $this->view->fetch('/' . $template);
    }

    public function get_list(){
        $channelid = $this->request->post('channel_id');
        $page = $this->request->post('page');
        if(!$channelid){
            $this->error('参数丢失');
        }
        if(!$page){
            $this->error('参数丢失');
        }
       
        $channel = ChannelModel::find($channelid );
        $model = Modelx::get($channel['model_id']);
        if (!$model) {
            $this->error(__('No specified model found'));
        }
        $pagelist = Archives::alias('a')
            ->where('status', 'normal')
            ->where('deletetime', 'exp', \think\Db::raw('IS NULL'))
            ->join($model['table'] . ' n', 'a.id=n.id', 'LEFT')
            ->field('a.*')
            ->field('id,content', true, config('database.prefix') . $model['table'], 'n')
            ->where('channel_id', $channelid)
            ->order('publishtime','desc' )->limit($page*7,7)->select();
        return $pagelist;
    }
    //获取对应标签下的专家
    //
    public function get_experts(){
        $channelid = $this->request->post('channel_id');
        $tag = $this->request->post('tag');
        if(!$channelid){
            $this->error('channel_id参数丢失');
        }
        if(!$tag){
            $this->error('tag参数丢失');
        }
        if($tag!=='all'&&is_numeric(trim($tag))){
             $tags = TagsModel::find($tag);
            if (!$tags) {
                $this->error(__('No specified tags found'));
            }
            $tagwhere= explode(',', $tags['archives']);
        }elseif($tag=='all'){
            $tagwhere='';
        }else{
            $this->error('tag参数丢失');
        }

       
        $channel = ChannelModel::find($channelid );
        $model = Modelx::get($channel['model_id']);
        if (!$model) {
            $this->error(__('No specified model found'));
        }
        $pagelist = Archives::alias('a')
            ->where('status', 'normal')
            ->where('deletetime', 'exp', \think\Db::raw('IS NULL'))
            ->join($model['table'] . ' n', 'a.id=n.id', 'LEFT')
            ->field('a.*')
            ->field('id,content', true, config('database.prefix') . $model['table'], 'n')
            ->where('channel_id', $channelid)
            ->where(function($query)use($tagwhere){
                if($tagwhere){
                    return $query->where('a.id', 'in', $tagwhere);
                }
            })
            ->order('weigh,publishtime','asc' )->select();
            if(!empty($pagelist)){
                $biaoqian=[];
                foreach ($pagelist as $key => $value) {
                    # code...
                    $str.='<a href="'.$value->url.'"><li><div class="t-imgs"><img src="'.$value->image.'"/></div><div class="t-desc"><p class="name">'.$value->title.'</p>';
                             $biaoqian = explode("\r\n",$value->description);
                                            for($i=0;$i<count($biaoqian);$i++){
                                            
                                            $str.='<p class="desc">'.$biaoqian[$i].'</p>';
                            }

                                            $str.='</div></li></a>';
                }
            }
        return $str;
    }
    
}
