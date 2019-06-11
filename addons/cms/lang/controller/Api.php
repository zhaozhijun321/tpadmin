<?php

namespace addons\cms\controller;

use addons\cms\model\Modelx;
use think\Config;
use think\Db;
use think\Exception;
use think\exception\PDOException;

/**
 * Api接口控制器
 * Class Api
 * @package addons\cms\controller
 */
class Api extends Base
{

    public function index()
    {
        Config::set('default_return_type', 'json');

        $apikey = $this->request->request('apikey');
        $config = get_addon_config('cms');
        var_dump($config);
        exit;
        if (!$config['apikey']) {
            $this->error('请先在后台配置API密钥');
        }
        if ($config['apikey'] != $apikey) {
            $this->error('密钥不正确');
        }
        $channel_id = $this->request->request('channel_id');
        $data = $this->request->request();
        $channel = \addons\cms\model\Channel::get($channel_id);
        if (!$channel) {
            $this->error('栏目未找到');
        }
        $model = Modelx::get($channel['model_id']);
        if (!$model) {
            $this->error('模型未找到');
        }
        $data['model_id'] = $model['id'];
        $data['content'] = !isset($data['content']) ? '' : $data['content'];
        Db::startTrans();
        try {
            (new \app\admin\model\cms\Archives)->allowField(true)->save($data);
            Db::commit();
        } catch (PDOException $e) {
            Db::rollback();
            $this->error($e->getMessage());
        } catch (Exception $e) {
            Db::rollback();
            $this->error($e->getMessage());
        }
        $this->success('新增成功');
        return;
    }
    //颁发密钥
    public function getkey(){
        $config =get_addon_config('cms');
       if ($config['apikey']) {
         return $config['apikey'];
        }else{
           return $this->error('请联系管理员');

        }
    }
    //今日长才日历排期接口
    public function laydate(){
        $apikey = $this->request->request('apikey');
        $date = $this->request->request('date');
        $vst = $this->request->request('vst');
        if(empty($date)){
           return  $this->error('参数丢失');
        }
        //当前时间戳
        $nowdate =strtotime($date);
        
        // $channel_id=$this->request->request('channel_id');
        $config =get_addon_config('cms');
        if ($config['apikey'] != $apikey) {
           return  $this->error('密钥不正确');
        }
        //如果是么有课程的日期
        if((int)$vst>=0){
             $list =  db('cms_addonkecheng')->alias('a')->join('fa_cms_archives w','a.id = w.id')->whereTime('a.begintime', '<=', $nowdate)->whereTime('a.endtime','>=',$nowdate)->field('w.*,a.content')->select();
              if(count($list)>1){
                $class="hide";
              }else{
                $class="";
              }
            $str='<div class="neirong">';
             foreach ($list as $key => $value) {
                if($key<=0){
                    $str.=' <div class=" actives"><h2>'.$value['title'].'</h2>';
                                    }else{
                    $str.=' <div class="'.$class.' actives"><h2>'.$value['title'].'</h2>';
                }

                   
                    $str.= '<div class="k-heng"></div>
                        <p class="cont">'.$value['content'].'</p>
                        <p class="time"><span>'.$value['begintime'].'-'.$value['endtime'].'</span> | <span>北京</span> </p>
                        <div class="day-bot">
                            <a href="'.$value['url'].'">了解更多</a>
                            <img src="../src/image/icon-pdf.png" alt="">
                        </div>
                        </div>';
                
             }
             if(count($list)>1){
                  $str.= '</div><div class="lf-lr">
                            <img id="prevri"onclick="prev()"src="/assets/addons/cms/src/image/l-btn.png" alt="">
                            <img id="nextri" src="/assets/addons/cms/src/image/r-btn2.png" alt="">
                        </div>';
             }
         

        }else{
            //最近一个月的课程排期
            //当天的日期时间戳
            $today = strtotime(date('Y-m-d'));
            $monthtime = strtotime(date('Y-m-d'))+30*24*3600;
            $list = db('cms_addonkecheng')->alias('a')->join('fa_cms_archives w','a.id = w.id')->where('a.begintime','between time',[$today,$monthtime])->whereOr('a.endtime','between time',[$today,$monthtime])->field('w.*,a.content')->select();
            $str=' <div class="title">课程</div><ul>';
            foreach ($list as $key => $value) {
            # code...
            $str.='<li class="item">
                    <span class="ke-name">'.$value['title'].'</span>
                    <span class="time">'.$value['begintime'].'</span>
                    <span class="place">北京</span>
                    <img src="/assets/addons/cms/src/image/icon-pdf.png" alt="">
                </li>';
            }
                
            $str.='</ul>';
        }
        return $str;

    }

    //页面加载获取从今天开始的课程安排
    public function beginToday(){
        //今天时间戳
        // $todaytime = strtotime(date('d'));
        $datetoday = date('Y-m-d');

         //点击请求有课的数据
        $size  = db('cms_addonkecheng')->whereTime('endtime', '>=',$datetoday)->select();
        if(!empty($size)){
            foreach ($size as $key => $value) {
                
                $size[$key]['riqi']=$this->getDatesBetweenTwoDays($value['begintime'],$value['endtime']);
            }
            $newsize=[];
            //循环取出时间段
            foreach ($size as $key => $value) {
                # code...
                array_push($newsize,$value['riqi']);
            }

            foreach ($newsize as $key => $value) {
                foreach ($value as $ke => $va) {
                    $newsizes[]=$va;
                }
            }
            unset($newsize);
            unset($size);
            $fastnew = array_unique($newsizes);
            unset($newsizes);
            $lastarr = array_flip($fastnew);
           foreach ($lastarr as $key => $value) {
               $lastarr[$key]='';
           }
            unset($newsizes);
        }
        // var_dump($fastnew);
        return $this->laydatejs($lastarr) ;
    }
     public function getDatesBetweenTwoDays($startDate,$endDate){
        $dates = [];
        //此条件判断开始时间是否小于等于当前日期 如果是默认就是今天的日期
                if(strtotime($startDate)<=strtotime(date('Y-m-d'))){
                    $startDate =date('Y-m-d');
                }
        if(strtotime($startDate)>strtotime($endDate)){
            //如果开始日期大于结束日期，直接return 防止下面的循环出现死循环
            return $dates;
        }elseif($startDate == $endDate){
            //开始日期与结束日期是同一天时
            array_push($dates,$startDate);
            return $dates;
        }else{
            array_push($dates,$startDate);
            $currentDate = $startDate;
            do{
                $nextDate = date('Y-m-d', strtotime($currentDate.' +1 days'));
                array_push($dates,$nextDate);
                $currentDate = $nextDate;
            }while($endDate != $currentDate);
            return $dates;
        }
    }

    public function laydatejs($mark){
        $markname=[];
        if(is_array($mark)){
            foreach ($mark as $key => $value) {
                $markname[]=$key;
            }
        }
       return  $str=" laydate.render({
        elem: '#cc_date',
        position: 'static',
        mark:".json_encode($mark).",
        btns: ['now'],//底部显示的按钮
        // theme: '#D21F20',
        change: function(value, date){ //监听日期被切换
            // 点击日历进行ajax请求，请求课程
            // $.post('/addons/cms/api/laydate',{apikey,date:value},function(data){

            // })
            // 模拟数据
            const defaultValue = ".json_encode($markname).";
            var vst = defaultValue.indexOf(value);

            // 如果当天没有课程显示最近一个月的课程
            console.log(value);
            console.log(defaultValue.indexOf(value));
            if(defaultValue.indexOf(value) == -1 ) {
                $('.month-ke').show();
                $('.day-ke').hide();
            } else {
                $('.month-ke').hide();
                $('.day-ke').show();
            }
            // 待完善
            $.post('/addons/cms/api/laydate',{apikey,date:value,vst:vst},function(data){
                if(data){
                    if(vst==-1){
                        $('.month-ke').html(data)
                    }else{
                        $('.day-ke').html(data);

                    }
                }
            })
        },
    });";
    }
}
