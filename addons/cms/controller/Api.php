<?php

namespace addons\cms\controller;

use addons\cms\model\Modelx as Modelx;
use think\Config;
use think\Db;
use think\Exception;
use think\exception\PDOException;
use addons\cms\model\Diyform as DiyformModel;
use addons\cms\model\Archives as ArchivesModel;
use app\admin\model\cms\Kecheng as Kecheng;
use addons\qiniu\library\Auth;

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
        // $apikey = $this->request->post('apikey');
        $date = $this->request->request('date');
        $vst = $this->request->post('vst');
        if(!$date){
           return  $this->error('参数丢失');
        }

        $str = $this->showRightHtml($date,$vst);
        return $str;

    }

    //页面加载获取从今天开始的课程安排
    public function beginToday(){
        //今天时间戳
        // $todaytime = strtotime(date('d'));
        $datetoday = date('Y-m-d');
        // $nexttime = date('Y-m-d',strtotime('+2 month'));
         //点击请求有课的数据
        //
        $size = Kecheng::with(['Channel'=>function($query){
            $query->where("diyname",'chanpinyufuw');
        },'Archives'])
                ->whereTime('endtime', '>=',$datetoday)
                ->cache(true)
                ->select();
        if(!empty($size)){
            foreach ($size as $key=>$riqi) {
                
                $oldsize[$key]['riqi']=$this->getDatesBetweenTwoDays($riqi->begintime,$riqi->endtime);
            }
            $newsize=[];
            //循环取出时间段
            foreach ($oldsize as $key => $value) {
                # code...
                array_push($newsize,$value['riqi']);
            }

            foreach ($newsize as $key => $value) {
                foreach ($value as $ke => $va) {
                    $newsizes[]=$va;
                }
            }
            unset($newsize);
            // unset($size);
            $fastnew = array_unique($newsizes);
            unset($newsizes);
            $lastarr = array_flip($fastnew);
           foreach ($lastarr as $key => $value) {
               $lastarr[$key]='';
           }
           // $datetodayarr[]=$datetoday;
           // var_dump($datetodayarr);
           // var_dump($fastnew);
            // unset($newsizes);
            //判断当天日否有课程
            if(in_array($datetoday,$fastnew)){
                $vst =1;
            }else{
                $vst =-1;

            }
        }
        // var_dump($fastnew);
        return ['jsonhtml'=>$this->laydatejs($lastarr),'html'=>$this->showRightHtml($datetoday,$vst)] ;
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
    //返回日期js
    public function laydatejs($mark){
        //
        $markname=[];
        if(is_array($mark)){
            foreach ($mark as $key => $value) {
                $markname[]=$key;
            }
        }
        //获取当前日期
        $str=" laydate.render({
        elem: '#cc_date',
        position: 'static',
        mark:".json_encode($mark).",
        btns: ['now'],//底部显示的按钮
        // theme: '#D21F20',
        change: function(value, date){ //监听日期被切换
            // 点击日历进行ajax请求，请求课程
            // $.post('/addons/cms/api/laydate',{date:value},function(data){

            // })
            // 模拟数据
            var defaultValue = ".json_encode($markname).";
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
            $.post('/addons/cms/api/laydate',{date:value,vst:vst},function(data){
                if(data){
                    
                        $('.date-cont').html(data)
                         var mySwiperRili = new Swiper ('.swiper-container-rili', {
            loop: true, // 循环模式选项
            autoplay:{
                disableOnInteraction : false,
                delay:5000
            }, // 自动播放
            
            navigation: {
                nextEl: '.ri-right',
                prevEl: '.ri-left',
            },
        })
                  
                }
            })
        },
    });";
    return $str;
    }
    //该方法返回视图html；
    public function showRightHtml($date,$vst){
         //当前时间戳
        $nowdate =strtotime($date);

         // var_dump($vst);
        if((int)$vst>=0){
             $list = Kecheng::with(['Channel'=>function($query){
                 $query->where("diyname",'chanpinyufuw');
                },'Chanpin'])
                ->whereTime('begintime', '<=', $nowdate)
                ->whereTime('endtime','>=',$nowdate)
                ->select();
                 
                //查询相关联的模型信息
                 // 查询相关联的模型信息
              if(count($list)>1){
                $class="hide";
              }else{
                $class="";
              }
                 $str= '<div class="month-ke">
                       
                    </div> <div class="day-ke">
                        <div class="swiper-container swiper-container-rili"><div class="swiper-wrapper">';
                            foreach ($list  as $key => $value) {
                            $str.='
                                <div class="swiper-slide">
                                    <h2>'.$value->chanpin->title.'</h2>
                                    <div class="k-heng"></div>
                                    <p class="cont">'. strip_tags($value->chanpin->description).'</p>
                                    <p class="time"><span>'.date('Y.m.d',strtotime($value->begintime)).'-'.date('m.d',strtotime($value->endtime)).'</span> | <span>'.$value->area.'</span> </p>
                                    <div class="day-bot">
                                        <a href="'.$value->chanpin->url.'">了解更多</a>';
                                        if(!empty($value->qitafile)){
                                        	$str.='<img src="/assets/addons/cms/src/image/icon-pdf.png" alt="" class="download" data-id='.$value->id.'>';
                                        }
                                        
                                    $str.='</div>
                                </div>';
                            }
                        $str.='</div>';
                         if(count($list)>1){
                           $str.=' <div class="lf-lr">
                                <img src="/assets/addons/cms/src/image/l-btn.png" alt="" class="ri-left">
                                <img src="/assets/addons/cms/src/image/r-btn2.png" alt="" class="ri-right">
                            </div>';
                      
                }
                $str.= '</div></div>';

        }else{
            //最近一个月的课程排期
            //当天的日期时间戳
            $today = date('Y-m-d');
            $monthtime = date('Y-m-d',strtotime('+2 month'));
            $list = Kecheng::with(['Channel'=>function($query){
                    $query->where("diyname",'chanpinyufuw');
                },'Chanpin'])
                ->whereTime('begintime','>=',$today)
                ->whereTime('endtime','<=',$monthtime)
                ->order('begintime asc')
                ->select();
                // echo "<pre>";
                // print_r($list);
                // echo "<pre>";
            $str=' <div class="day-ke hide">
                       
                    </div><div class="month-ke"> <div class="title">课程</div><ul>';
            foreach ($list as $value) {
            # code...
            $str.='<li class="item">
                    <span class="ke-name">'.$value->chanpin->title.'</span>
                    <span class="time">'.date('Y.m.d',strtotime($value->begintime)).'</span>
                    <span class="gang">-</span>
                    <span class="place">'.date('m.d',strtotime($value->endtime)).'</span>';
                    if(!empty($value->qitafile)){
                    	 $str.='<img src="/assets/addons/cms/src/image/icon-pdf.png" alt="" class="download" data-id='.$value->id.'>';
                    }
                   
                $str.='</li>';
            }
                
            $str.='</ul></div></div>';
        }
        return $str;
    }
    //分公司地图散点功能
    public function getLocation($location='',$main){
        $a =  new \think\Collection();
        $a->zifen = db('cms_addonchildren')->alias('a')->join('location b','a.city_id=b.id','left')->join('fa_cms_archives c','a.id=c.id')->where('c.deletetime','NULL')->group('city_id')->order('b.id asc')->field(['b.*,a.city_id'])->cache(true)->select();
//          var_dump($zifen);
        //查询分部市区的子公司名称
        $a->dizhi  = db('cms_addonchildren')->alias('a')->join('fa_cms_archives b','a.id=b.id')->where('b.deletetime','NULL')->field(['b.*,a.*'])->cache(true)->select();
        if($a->isEmpty()==true){
            foreach ($a->zifen as $key=>&$item) {
                foreach ($a->dizhi as $ke=> $va){
                    if($item['city_id']==$va['city_id']&&$item['city_id']){
                        $item['zi'].=$va['title'].',';
                        $item['zid'].=$va['id'].',';
                        if($location){
                           if($item['id']==$location){
                               $item['value']=200;
                           }else{
                               $item['value']=60;
                           }
                        }else{
                            if($key==0){
                                $item['value']=200;
                            }else{
                                $item['value']=60;
                            }
                        }
                    }
                }
            }
        }
        //百度eachart传输数据
        $eachartData=[];
        if(!empty($a->zifen)){
            foreach ($a->zifen as$key=> $value) {
            $eachartData[$key]['name']=$value['shortName'];
            $eachartData[$key]['value']=$value['value'];
            $eachartData[$key]['zi']=rtrim($value['zi'], ",") ;
            }
        }
       $data['location']= $a->zifen;
        return $data;
//        return $this->getEachart($a);
    }
    //点击城市请求当前城市下的分公司数据
    public function getMoresclice(){
        $this->request->filter('trim,strip_tags,htmlspecialchars');
        if ($this->request->isAjax()) {
            $id = $this->request->request('dataid');
            $sheng = $this->request->request('prvice');
            //过滤参数
            $id = (int)$id;
            if(!$id && !$sheng){
               return  $this->error('参数丢失');
            }
            if(!$id && $sheng){
                // 获取省份的id
                $shengidd = db('location')->where("level=1")->where("shortName",'like','%'.trim($sheng).'%')->find();
                if(!$shengidd){
                    return '';
                }
                //获取当前省份的随即一个下属市
                $city = db('location')->where("level=2")->where('pid',$shengidd['id'])->find();
                if(empty($city)){
                    return $this->error('数据丢失1！');
                }
                $res = db('cms_addonchildren')->alias('a')->join('fa_cms_archives b','a.id=b.id')->field(['b.*,a.*'])->where("a.city_id={$city['id']}")->where('b.deletetime','NULL')->select();
                foreach ($res as $key => &$value) {
                    $value['image'] =cdnurl($value['image']);
                    $value['url'] = addon_url('cms/archives/index', [':id' => $value['id'], ':diyname' => $value['id'], ':channel' => $value['channel_id']]);
                }
                $city =$city['id'];
            }elseif($id && !$sheng){
                $res = db('cms_addonchildren')->alias('a')->join('fa_cms_archives b','a.id=b.id')->field(['b.*,a.*'])->where("a.city_id={$id}")->where('b.deletetime','NULL')->select();
                foreach ($res as $key => &$value) {
                    $value['image'] =cdnurl($value['image']);
                    $value['url'] = addon_url('cms/archives/index', [':id' => $value['id'], ':diyname' => $value['id'], ':channel' => $value['channel_id']]);
                }
                //查出相应城市的省份
                $shengidd = db('location')->where("level=1")->where('id',$res[0]['province_id'])->find();

                if(!$shengidd){
                    return $this->error('数据丢失2！');
                }
                $city=$id;
            }else{
               return  $this->error('非法错误');
            }
           
            return json(['item'=>$res,'sheng'=>$shengidd['shortName'],'shi'=>$city]);
        }
    }
    //ajax请求下载附件
    public function ajaxDownload(){
        $id = $this->request->request('dataid');
        if(!$id){
           return  $this->error('参数丢失');
        }

        $res = db('cms_kecheng')->where('id',$id)->find();
        // var_dump($res);
        // exit;
        if(!$res){
            return $this->error('数据丢失！');
        }
        if(!$res['qitafile']){
            return $this->error('文件删除或丢失！');

        }
        // echo cdnurl($res['qitafile']);
        // exit;
      $downurl =  $this->downloadFile(cdnurl($res['qitafile']));
      header('location:'.$downurl);
    }
    //文件下载方法
    //下载文件

    public function downloadFile($baseUrl){
        $config = get_addon_config('qiniu');
        $auth = new Auth($config['app_key'], $config['secret_key']);
        return  $auth->privateDownloadUrl($baseUrl);
    }


    //附件下载
   public function download($file_url,$new_name=''){ 
       // $qingniu->downloadFile();
        if(!isset($file_url)||trim($file_url)==''){ 
          echo '500'; 
        } 
        if(!file_exists($file_url)){ //检查文件是否存在 
          echo '404'; 
        } 
        $file_name=basename($file_url); 
        $file_type=explode('.',$file_url); 
        $file_type=$file_type[count($file_type)-1]; 
        $file_name=trim($new_name=='')?$file_name:urlencode($new_name); 
        $file_type=fopen($file_url,'r'); //打开文件 
        //输入文件标签 
        header("Content-type: application/octet-stream"); 
        header("Accept-Ranges: bytes"); 
        header("Accept-Length: ".filesize($file_url)); 
        header("Content-Disposition: attachment; filename=".$file_name); 
        //输出文件内容 
        echo fread($file_type,filesize($file_url)); 
        fclose($file_type);
    }
        //分享接口
    public function share(){

        $id = $this->request->request('dataid');
        if(!$id){
           return  $this->error('参数丢失');
        }   
        //获取文章的相关信息
        $res = ArchivesModel::where('id',$id)->find();
        return $res;

    }

    //获取研讨会列表

    public function getYantao(){
        $page = $this->request->request('page');
        if(!(int)$page){
            return $this->error('参数丢失！');
        }
        return  ArchivesModel::getYantaoList();
    }
   
}
