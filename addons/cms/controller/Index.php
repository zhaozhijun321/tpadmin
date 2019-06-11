<?php

namespace addons\cms\controller;
use addons\cms\model\Diyform as DiyformModel;
use think\Hook;
use app\admin\model\cms\Kecheng as Kecheng;
use addons\cms\model\Channel;
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
        //获取产品栏目下得子栏目
        $chanpinCid = \addons\cms\model\Channel::where('parent_id','in',function($query){
        $query->table('fa_cms_channel')->where('diyname','chanpinyufuw')->field('id');
        })->column('id');
        $chanpin = \addons\cms\model\Archives::getArchivesList(['channel'=>$chanpinCid,'orderby'=>"weigh",'orderway'=>"asc",'limit'=>12,'cache'=>true]);
        $chanpin = $this->forArr($chanpin,4);
        //获取专家列表
        $zhuanjia = \addons\cms\model\Archives::getArchivesList(['channel'=>63,'orderby'=>"weigh",'orderway'=>"asc",'limit'=>12,'cache'=>true]);
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
         //获取子公司的分布地区
         $zifen = db('cms_addonchildren')->alias('a')->join('fa_location b','a.city_id=b.id')->field('b.shortName,b.id,a.province_id')->group('a.city_id')->join('fa_cms_archives c','a.id=c.id')->where('c.deletetime','NULL')->order('b.id asc')->cache(true)->select();
        //获取第一个城市的省名称
        $firstsheng = db('location')->where("level=1")->where('id',$zifen[0]['province_id'])->find();
      
        $datetoday = date('Y-m-d');
        //获取研讨会信息
        $yantaohui = Kecheng::with(['Archives'=>function($query){
             $query->field('title');
        },'Chanpin','Channel'=>function($query){
                 $query->where("diyname",'yantaohuixinxi');
                }])
                ->limit(8)
                ->order('begintime asc')
                ->whereTime('endtime', '>=',$datetoday)
                ->select();
            // echo "<pre>";   
            // print_r($yantaohui);
            // echo "<pre>";   
        $this->view->assign('firstsheng', $firstsheng);
        $this->view->assign('yantaohuis', $yantaohui);
        // $this->view->assign('experts', $experts);
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
