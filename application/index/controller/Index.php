<?php

namespace app\index\controller;

use app\common\controller\Frontend;
use app\common\library\Token;

class Index extends Frontend
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $layout = '';

    public function _initialize()
    {
        parent::_initialize();
    }

    public function index()
    {
        
       // $this-> request_by_fsockopen($url,$data);

        return $this->view->fetch();
    }

    public function news()
    {
        $newslist = [];
        return jsonp(['newslist' => $newslist, 'new' => count($newslist), 'url' => 'https://www.fastadmin.net?ref=news']);
    }

   

    public function aaa(){
        sleep(1);
            $name = isset($_POST['name'])?$_POST['name']:'';
    $pwd = isset($_POST['pwd'])?$_POST['pwd']:'';
    echo $name.$pwd;
    file_put_contents('a.txt', $name.$pwd);
    echo 'success ok';
    die;
    }
}
