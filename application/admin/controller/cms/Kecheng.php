<?php

namespace app\admin\controller\cms;

use app\common\controller\Backend;
use think\Db;
use think\db\Query;
/**
 * 单页表
 *
 * @icon fa fa-circle-o
 */
class Kecheng extends Backend
{

    /**
     * Page模型对象
     */
    protected $model = null;
    protected $noNeedRight = ['selectpage_type'];
    public $channel_id=[98,96];

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\cms\Kecheng;
        $this->channel = new \app\admin\model\cms\Channel;
        $this->chanpin = new \app\admin\model\cms\Archives;
        $this->ExpertsKecheng  = new \app\admin\model\cms\ExpertsKecheng;
        // $this->view->assign("flagList", $this->model->getFlagList());
          //获取栏目类型
        if($this->channel_id){
           $channel_list =  $this->channel->where('id','in',$this->channel_id)->select();
        }
        // //获取产品列表
        //  $chanpinlist =  $this->chanpin->where('channel_id','62')->field('id,title')->select();
         //获取专家列表
         $zhuanjialist =  $this->chanpin->where('channel_id','63')->field('id,title')->select();
           $groupdata = [];
        if(!empty($zhuanjialist)){
              foreach ($zhuanjialist as $v)
            {
                $groupdata[$v->id] = $v->title;
            }
        }
        // var_dump($chanpinlist);
        $this->view->assign('channel_list', $channel_list);
        $this->view->assign('groupdata', $groupdata);

        $this->view->assign("statusList", $this->model->getStatusList());
    }

    public function index()
    {
        if ($this->request->isAjax()) {
            $this->relationSearch = TRUE;
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            // var_dump($this->buildparams());
            // exit;
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            
            $total = $this->model
                ->with(['Channel','Chanpin'])
                ->where($where)
                ->order($sort, $order)
                ->count();
            
            $list = $this->model
                ->with(['Channel','Chanpin'])
                ->where($where)
                ->order($sort, $order)
                ->limit($offset, $limit)
                ->select();
            // var_dump($list);
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }

        return parent::index();
    }
    //添加课程

   public function add()
    {

        if ($this->request->isPost())
        {
           
            $params = $this->request->post("row/a");
            // var_dump($params);
            // var_dump($params);
            if ($params)
            {
                $result = $this->model->allowField(true)->save($params);
                if ($result === false)
                {
                    $this->error($this->model->getError());
                }
                $group = $this->request->post("expertsid/a");

                //过滤不允许的组别,避免越权

                $dataset = [];
                foreach ($group as $value)
                {
                    $dataset[] = ['kecheng_id' => $this->model->id, 'experts_id' => $value];
                }
                // $this->ExpertsKecheng->saveAll($dataset);
                db('experts_kecheng')->insertAll($dataset);
                $this->success();
            }
            $this->error();
        }
        return $this->view->fetch();
    }

    /**
     * 编辑
     */
    public function edit($ids = NULL)
    {
        $row = $this->model->get(['id' => $ids]);
        if (!$row)
            $this->error(__('No Results were found'));
        if ($this->request->isPost())
        {
            $params = $this->request->post("row/a");
            if ($params)
            {
                $result = $row->allowField(true)->save($params);
                if ($result === false)
                {
                    $this->error($row->getError());
                }

                // 先移除所有权限
                $this->ExpertsKecheng->where('kecheng_id', $row->id)->delete();

                $group = $this->request->post("expertsid/a");

                // 过滤不允许的组别,避免越权

                $dataset = [];
                foreach ($group as $value)
                {
                    $dataset[] = ['kecheng_id' => $row->id, 'experts_id' => $value];
                }
                db('experts_kecheng')->insertAll($dataset);
                $this->success();
            }
            $this->error();
        }
        $grouplist = $this->model->get($row['id'])->archives;
        $groupids = [];

        foreach ($grouplist as $k => $v)
        {
            $groupids[] = $v->id;
        }
        $this->view->assign("row", $row);
        $this->view->assign("groupids", $groupids);
        return $this->view->fetch();
    }

    /**
     * 删除
     */
    public function del($ids = "")
    {
        if ($ids)
        {
            // 避免越权删除管理员
            //查询中间表有么有数据
            $res = db('experts_kecheng')->where('kecheng_id',$ids)->find();

            Db::startTrans();
            try{
                if($res){
                 db('experts_kecheng')->where('kecheng_id',$ids)->delete();

                }
                db("cms_kecheng")->delete($ids);
                // 提交事务
                Db::commit(); 
            } catch (\Exception $e) {
                // 回滚事务
                Db::rollback();

            }
            $this->success();
        }
        $this->error();
    }

    //获取对应栏目下得产品

    public function getlist(){
        $this->view->engine->layout(false);
        $channel_id = $this->request->post('channel_id');
        $id = $this->request->post('id');
            if ($id) {
                $list = db('cms_kecheng')->where('id', $id)->find();
               $this->view->assign('list', $list);

            }
        //查看栏目是否为顶级栏目
        if($channel_id){
            $parent =  $this->channel->where('parent_id',$channel_id)->find()->parent_id;
            $list = $this->chanpin->with(['channel'=>function($query)use($channel_id,$parent){
                if($parent){
                    $query->where("parent_id",$channel_id);

                }else{
                    $query->where("id",$channel_id);
                }
            }])->select();
            
            $this->view->assign('chanpin_list', $list);

            $this->success('', null, ['html' => $this->view->fetch('list')]);
        }else{
             $this->error(__('Please select channel'));
        }
        $this->error(__('Parameter %s can not be empty', 'ids'));
    }
}
