<?php

namespace addons\cms\controller;
use addons\cms\model\Diyform as DiyformModel;
use think\Hook;

use think\Config;

/**
 * CMS首页控制器
 * Class Index
 * @package addons\cms\controller
 */
class Index extends Base
{

    public function index()
    {
        Config::set('cms.title', Config::get('cms.title') ? Config::get('cms.title') : __('Home'));


        //获取产品与服务
        $chanpin = \addons\cms\model\Archives::getArchivesList(['channel'=>62,'orderby'=>"weigh",'orderway'=>"asc",'limit'=>12]);
        $chanpin = $this->forArr($chanpin,4);

        // echo count($chanpin);
        // exit;
        //获取专家列表
        $zhuanjia = \addons\cms\model\Archives::getArchivesList(['channel'=>63,'orderby'=>"weigh",'orderway'=>"asc",'limit'=>12]);
        // var_dump($zhuanjia);
        // exit;
        $zhuanjia = $this->forArr($zhuanjia,4);
       	//获取今日长财数据
       	//获取表单自定义字段
       	$fields = DiyformModel::getDiyformFields(1);
        $data = [
            'fields' => $fields
        ];
       	 $diyform['fieldslist'] = $this->fetch('common/formfield', $data);
       	//  // var_dump($diyform);
       	//  $site = Config::get("site");
       	//   // 配置信息
        // $config = [
        //     'site'           => array_intersect_key($site, array_flip(['name', 'cdnurl', 'version', 'timezone', 'languages'])),
        //     'upload'         => $upload,
        //     'modulename'     => 'addons',
        //     'controllername' => 'index',
        //     'actionname'     => 'index',
        //     'jsname'         => 'index/index',
        //     'moduleurl'      => rtrim(url("/index", '', false), '/'),
        //     'language'       => $lang
        // ];
        // $config = array_merge($config, Config::get("view_replace_str"));
        //  // 配置信息后
        // Hook::listen("config_init", $config);
         //获取子公司的分布地区
         $zifen = db('cms_addonchildren')->alias('a')->join('fa_location b','a.city_id=b.id')->field('b.shortName,b.id')->group('a.city_id')->order('b.id asc')->cache(true)->select();
         // var_dump($zifen);
        $this->view->assign('zifen', $zifen);
        $this->view->assign('jsconfig', $config);
        $this->assign('diyform', $diyform);
        $this->assign('chanpin',$chanpin);
        $this->assign('zhuanjia',$zhuanjia);
        return $this->view->fetch('/index');
    }

    function forArr($arr,$count){
    	$i =0;
    	foreach($arr as $key=>$newarr){
    		if($key%$count==0){
    			
    			$i++;

    		}
    		$new[$i][]=$newarr;
    	}
    	return $new;
    	
    }

    function gettoday(){
    	
    }



}
