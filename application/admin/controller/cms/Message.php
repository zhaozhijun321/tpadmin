<?php

namespace app\admin\controller\cms;

use app\common\controller\Backend;

/**
 * 区块表
 *
 * @icon fa fa-circle-o
 */
class Message extends Backend
{

    /**
     * Block模型对象
     */
    protected $model = null;
    protected $noNeedRight = ['selectpage_type'];
    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\cms\Message;
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
            $sort = 'id';
            $total = $this->model
                ->where($where)
                ->order($sort, $order)
                ->count();
            
            $list = $this->model
                ->where($where)
                ->order($sort, $order)
                ->limit($offset, $limit)
                ->select();

            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }

        return parent::index();
    }


}
