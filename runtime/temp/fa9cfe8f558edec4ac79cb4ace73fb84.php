<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:74:"/www/wwwroot/default/tpadmin/addons/cms/view/default/common/formfield.html";i:1549411004;s:75:"/www/wwwroot/default/tpadmin/addons/cms/view/default/channel_fengongsi.html";i:1555940877;s:71:"/www/wwwroot/default/tpadmin/addons/cms/view/default/common/layout.html";i:1555567574;s:76:"/www/wwwroot/default/tpadmin/addons/cms/view/default/common/guanyu_list.html";i:1550912890;}*/ ?>
<!-- 长财咨询官网首页页面代码 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1100">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes" /> -->
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo \think\Config::get("cms.title"); ?> - <?php echo \think\Config::get("cms.sitename"); ?></title>
    <!-- <link rel="shortcut icon" href="/assets/img/favicon.ico" /> -->
    <meta name="keywords" content="<?php echo \think\Config::get("cms.keywords"); ?>" />
    <meta name="description" content="<?php echo \think\Config::get("cms.description"); ?>" />
    <link rel="stylesheet" href=" /assets/addons/cms/src/dist/css/swiper.min.css?v=<?php echo \think\Config::get("site.version"); ?>">
   <!--   <link rel="stylesheet" href=" /assets/addons/cms/css/new-detail.css?v=<?php echo \think\Config::get("site.version"); ?>"> -->
    <link rel="stylesheet" href=" /assets/addons/cms/css/common.css?v=<?php echo \think\Config::get("site.version"); ?>">
    <link rel="stylesheet" href=" /assets/addons/cms/css/index.css?v=<?php echo \think\Config::get("site.version"); ?>">
    <!-- <link rel="stylesheet" href="/assets/addons/summernote/css/summernote.css?v=<?php echo \think\Config::get("site.version"); ?>"> -->
    <script type="text/javascript" src="/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src=" /assets/addons/cms/src/dist/js/swiper.min.js"></script>
    <script src=" /assets/addons/cms/src/laydate/laydate.js?v=<?php echo \think\Config::get("site.version"); ?>"></script>
    <script src="/assets/libs/fastadmin-citypicker/src/city-picker.data.js?v=<?php echo \think\Config::get("site.version"); ?>"></script>
    <script src="/assets/libs/fastadmin-citypicker/src/city-picker.js?v=<?php echo \think\Config::get("site.version"); ?>"></script>
    
</head>
<style>
/* 日历组件 */
    .date-box {
        width: 100%;
        background: #F5F5F5;
        padding-top: 100px;
    }
    .date-com {
        width: 1100px;
        margin: 0 auto;
        display: flex;
        padding-top: 50px;
    }
    .date-com .cc_date {
        /* flex:1; */
        width:  50%;
    }
    .date-com .date-cont {
        /* flex:1; */
        width: 50%;
        background: #fff;
        border-left: 1px solid #DADADA;
        box-shadow: 0 2px 4px rgba(0,0,0,.12);
    }
    .layui-laydate, .layui-laydate-hint {
        width: 100%;
        height: 522px;
        border: 0;
    }
    .layui-laydate-main {
        width: 100%;
    }
    .layui-laydate-content td, .layui-laydate-content th{
        width: 75px;
        height: 58px;
    }
    .layui-laydate .layui-this {
        background-color: #D21F20!important;
        color: #fff!important;
    }
    .layui-laydate-list>li {
        height: 76px;
        line-height: 76px;
    }
    .laydate-day-mark {
        font-size: 16px;
        line-height: 58px;
    }
    .laydate-day-mark::after {
        background: #D21F20;
        right: 35px;
        top: 46px;
        /* margin-right: -2.5px;
        margin-top: 16px; */
        width: 6px;
        height: 6px;
    }
    .laydate-set-ym {
        font-size: 20px;
    }
/* 日历组件样式结束 */
     
</style>
<body>

    <div class="container">
        <div class="com-top">
            <!-- 顶部分享收藏 -->
            <!-- 顶部页面导航 -->
            <div class="t-navs">
                <!-- 页面logo -->
                <a href="/"  >
                    <img src=" /assets/addons/cms/src/image/logo.png" alt="">
                </a>
                <!-- 导航详情 unders类名控制是否显示下划线-->
                <ul class="navs-con">
                    <li class="nav <?php if(request()->controller() == 'index'): ?>unders<?php endif; ?>">
                        <a href="/"  >首页</a>
                    </li>
                     <?php $__ZYbEXl0LnA__ = \addons\cms\model\Channel::getChannelList(["id"=>"nav","typeid"=>"98,72,63","orderby"=>"weigh","orderway"=>"desc"]); if(is_array($__ZYbEXl0LnA__) || $__ZYbEXl0LnA__ instanceof \think\Collection || $__ZYbEXl0LnA__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__ZYbEXl0LnA__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?>
                    <li class="nav   <?php if($__CHANNEL__['id'] == $nav['id'] or $__CHANNEL__['parent_id'] == $nav['id']): ?>unders<?php endif; ?>">
                        <a href="<?php echo $nav['url']; ?>"  ><?php echo $nav['name']; ?></a>
                    </li>

                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    <li class="nav <?php if(request()->param('diyname') == 'lianxi'): ?>unders<?php endif; ?>">
                        <a href="/cms/p/lianxi">联系我们</a>
                    </li>
                    <div class="phones" onclick="window.location.href='tel:<?php echo $config['phone']; ?>'">
                        <img src=" /assets/addons/cms/src/image/phone.png" alt="">
                        <?php echo $config['phone']; ?> 
                    </div>
                </ul>
            </div>
        </div>
        <?php if(request()->controller() != 'index' && request()->controller() != 'page'): if(request()->controller() != 'archives'): if(in_array($__CHANNEL__['id'],[72,98,63]) or in_array($__CHANNEL__['parent_id'],[72,98,63])): else: ?>
            <div class="crumbs">
                当前位置：
                <?php $__qvWhoc06re__ = \addons\cms\model\Channel::getBreadcrumb(isset($__CHANNEL__)?$__CHANNEL__:[], isset($__ARCHIVES__)?$__ARCHIVES__:[], isset($__TAGS__)?$__TAGS__:[], isset($__PAGE__)?$__PAGE__:[]); if(is_array($__qvWhoc06re__) || $__qvWhoc06re__ instanceof \think\Collection || $__qvWhoc06re__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__qvWhoc06re__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;if($key==0): ?>
                <span onclick="local('<?php echo $item['url']; ?>')"><?php echo $item['name']; ?></span>
                <?php else: ?>
                 -<span onclick="local('<?php echo $item['url']; ?>')"><?php echo $item['name']; ?></span>
                <?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <?php endif; else: ?>
         <div class="crumbs">
                当前位置：
                <?php $__wlTI0fAVhs__ = \addons\cms\model\Channel::getBreadcrumb(isset($__CHANNEL__)?$__CHANNEL__:[], isset($__ARCHIVES__)?$__ARCHIVES__:[], isset($__TAGS__)?$__TAGS__:[], isset($__PAGE__)?$__PAGE__:[]); if(is_array($__wlTI0fAVhs__) || $__wlTI0fAVhs__ instanceof \think\Collection || $__wlTI0fAVhs__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__wlTI0fAVhs__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;if($key==0): ?>
                <span onclick="local('<?php echo $item['url']; ?>')"><?php echo $item['name']; ?></span>
                <?php else: ?>
                 -<span onclick="local('<?php echo $item['url']; ?>')"><?php echo $item['name']; ?></span>
                <?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </div>
        <?php endif; endif; ?>
            
    <link rel="stylesheet" href=" /assets/addons/cms/css/about.css?v=<?php echo \think\Config::get("site.version"); ?>">
       <div class="g-navs">
	<ul>
	   <?php $__arqbxfK1EC__ = \addons\cms\model\Channel::getChannelList(["id"=>"channel","typeid"=>$__CHANNEL__['id'],"condition"=>"77<>id","type"=>"brother","orderway"=>"asc","ordery"=>"weigh"]); if(is_array($__arqbxfK1EC__) || $__arqbxfK1EC__ instanceof \think\Collection || $__arqbxfK1EC__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__arqbxfK1EC__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$channel): $mod = ($i % 2 );++$i;?>

	    <li class="g-nav "><a class="<?php if($__CHANNEL__['id'] == $channel['id']): ?>c-red<?php endif; ?>"href="<?php echo $channel['url']; ?>"><?php echo $channel['name']; ?></a></li>
	    <?php endforeach; endif; else: echo "" ;endif; ?>
	</ul>
</div>
        <!-- 分子公司 -->
        <div class="guanyu comps  nav-item">
            <!-- 分子公司城市分类 -->
            <div class="cates citys">
                <ul class="cate-group ">
                   <?php  $zifen = db('cms_addonchildren')->alias('a')->join('fa_location b','a.city_id=b.id')->join('fa_cms_archives c','c.id=a.id')->field('b.shortName,b.id,a.province_id,c.deletetime')->group('a.city_id')->order('b.id asc')->where("c.deletetime",'null')->cache(true)->select();  //获取第一个城市的省名称
        $firstsheng = db('location')->where("level=1")->where('id',$zifen[0]['province_id'])->find(); if($zifen): if(is_array($zifen) || $zifen instanceof \think\Collection || $zifen instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($zifen) ? array_slice($zifen,0,5, true) : $zifen->slice(0,5, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <li class="cate <?php if($key==0): ?>c-red<?php endif; ?>" data-item="<?php echo $vo['id']; ?>" <?php if($key==0): ?>data-sheng='<?php echo $firstsheng[shortName]; ?>'<?php endif; ?>><?php echo $vo['shortName']; ?></li>
                    <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                </ul>
                <!-- 更多城市按钮-->
                <img src=" /assets/addons/cms/src/image/more-city.png" class="more-city"  alt="">
            </div>
            <div class="box maps-box">
                <!-- 分子公司左边 -->
                <div class="box-left maps">
                    <div class="desc">长财咨询的业务遍及全国，截止2018年11月已设立分子公司50家，员工1000人以上，并成立华北、华东、华中、华南、东北、西北、成渝、山东、东南、西南10大区域技术咨询中心，可为各类客户提供各种财务、激励、商业运作的企业实战经验、工具、案例、技能辅导，帮助企业实现复制，打造赚钱到值钱的过程！</div>
                    <div id="china-main"></div>
                </div>
                <!-- 分子公司轮播部分 -->
                <div class="box-right">
                    <div class="swiper-container swiper-container-com">
                    </div>
                </div>
            </div>
        </div>
         <!-- 更多城市弹窗 -->
        <div class="share-modal hide" id="cityModal" >
            <div class="modal-box" style="height: 372px">
                <div class="box citys-box">
                    <h2>选择城市</h2>
                    <ul class="cate-group1">

                        <!-- <li class="cate1 city-item c-red">北京</li> -->
                        <?php if($zifen): if(is_array($zifen) || $zifen instanceof \think\Collection || $zifen instanceof \think\Paginator): if( count($zifen)==0 ) : echo "" ;else: foreach($zifen as $key=>$vo): ?>
                        <li class="cate1 city-item" data-item="<?php echo $vo['id']; ?>"><?php echo $vo['shortName']; ?></li>
                        <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                    </ul>
                    <img src=" /assets/addons/cms/src/image/close.png" class="c-close">
                </div>
            </div>
        </div>
        <script src="/assets/js/echarts.min.js?v=<?php echo \think\Config::get("site.version"); ?>"></script>
        <script src=" /assets/addons/cms/src/echarts/china.js"></script>
        <script>
      $('.c-close').click(function () {
        $('#cityModal').fadeOut();
    })
   window.onload=function(){
        //获取第一个城市数据
        var dataid =$('.citys .c-red').attr('data-item')
        //请求密钥
         $.ajax({
            url: '/addons/cms/api/getMoresclice',
            type: 'POST',
            data: {dataid:dataid},
            dataType: 'json',
            success: function (json) {
                if(json){
                    if(json.item.length>0){
                        var str='<div class="swiper-wrapper">';
                         for(var i=0;i<json.item.length;i++){
                            str+='<div class="swiper-slide"><a href='+json.item[i].url+'><img src="'+json.item[i].image+'" alt=""></a><div class="coms-desc"><h2>'+json.item[i].title+'</h2><p>联系地址：'+json.item[i].detailsArea+'</p ><p>联系方式：'+json.item[i].contact_way+'</p ></div></div>'
                        }
                        str+='</div><div class="lr-group"><img src="/assets/addons/cms/src/image/l-btn.png" alt="" class="b-left"><img src="/assets/addons/cms/src/image/r-btn.png" alt="" class="b-right"></div>';
                        $('.swiper-container-com').html(str);
                        //duiyingchengshi 添加选中类
                        $('li[data-item='+dataid+']').addClass('c-red').siblings().removeClass('c-red')
                         mySwiperCom = new Swiper ('.swiper-container-com', {
                            loop: true, // 循环模式选项
                            autoplay:{
                            disableOnInteraction : false,
                            delay:5000
                            }, // 自动播放
                            navigation: {
                            nextEl: '.b-right',
                            prevEl: '.b-left',
                            },
                        })
                    }else{
                        return false
                    }

                }else{
                    alert('出错了！')
                }
            },
            error: function () {
                alert('刷新页面重试')

            }
        });
        return false;
       
    }
     var citys = $('.citys>ul>.c-red').attr('data-sheng');
  var optionMap = {
        title : {
            text: '',
            subtext: '',
            left: 'center',
            top: 'top',
            textStyle: {
                color: '#fff'
            }
        },
        
        tooltip: {},
        
        backgroundColor: {
            type: 'linear',
            x: 0,
            y: 0,
            x2: 1,
            y2: 1,
            colorStops: [{
                offset: 0, color: '#fff' // 0% 处的颜色
            }, {
                offset: 1, color: '#fff' // 100% 处的颜色
            }],
            globalCoord: false // 缺省为 false
        },
        series: [
            {
                type: 'map',
                map: 'china',
                geoIndex: 2,
                aspectScale: 0.75, //长宽比
                showLegendSymbol: true, // 存在legend时显示
                label: {
                    normal: {
                        show: false,
                    },
                    emphasis: {
                        show: true,
                        textStyle: {
                            color: '#fff'
                        }
                    }
                },
                roam: false,
                itemStyle: {
                    normal: {
                        areaColor: '#D9D9D9',
                        borderColor: '#CCC6C2',
                        borderWidth: 1
                    },
                    emphasis: {
                        areaColor: '#D21F20'
                    }
                },
                data:[
                    {name:citys,selected:true }
                ]
            },
        ]
    };

      //初始化echarts实例
    var myChart = echarts.init(document.getElementById('china-main'));

    //使用制定的配置项和数据显示图表
    myChart.setOption(optionMap);
    // 点击地图切换右边分公司数据
    myChart.on('click', function(params){
        console.log(params);//此处写点击事件内容
        var  name = params.name;
       
        // 未完待续
         $.ajax({
            url: '/addons/cms/api/getMoresclice',
            type: 'POST',
            data: {prvice:name},
            dataType: 'json',
            success: function (json) {
                // obj.removeAttr("disabled");
                if(json){
                    if(json.item.length>0){
                         myChart.setOption({
                            series:[{data:[{name:name,selected:true}]}]
                        })
                        var str='<div class="swiper-wrapper">';
                        for(var i=0;i<json.item.length;i++){
                            str+='<div class="swiper-slide"><a href='+json.item[i].url+'><img src="'+json.item[i].image+'" alt=""></a><div class="coms-desc"><h2>'+json.item[i].title+'</h2><p>联系地址：'+json.item[i].detailsArea+'</p ><p>联系方式：'+json.item[i].contact_way+'</p ></div></div>'
                        }
                        str+='</div><div class="lr-group"><img src="/assets/addons/cms/src/image/l-btn.png" alt="" class="b-left"><img src="/assets/addons/cms/src/image/r-btn.png" alt="" class="b-right"></div>';
                        $('.swiper-container-com').html(str);
                        //duiyingchengshi 添加选中类
                        $('li[data-item='+json.shi+']').addClass('c-red').siblings().removeClass('c-red')
                         mySwiperCom = new Swiper ('.swiper-container-com', {
                            loop: true, // 循环模式选项
                            autoplay:{
                            disableOnInteraction : false,
                            delay:5000
                            }, // 自动播放
                            navigation: {
                            nextEl: '.b-right',
                            prevEl: '.b-left',
                            },
                        })
                    }else{
                        return false
                    }

                }else{
                    alert('出错了！')
                }
            },
            error: function () {
                btn.removeAttr("disabled");
                alert('刷新页面重试')

            }
        });
        return false;
    })


        </script>

        <!-- 共用底部 -->
        <div class="com-bottom">
            <div class="bot-box">
                <!-- 关于我们 -->
                <ul style="width:312px;">
                    <h5 class="title">关于长财</h5>
                    <?php $__7WrGXmYCan__ = \addons\cms\model\Channel::getChannelList(["type"=>"son","id"=>"guanyuzi","typeid"=>72,"model"=>6,"orderway"=>"asc"]); if(is_array($__7WrGXmYCan__) || $__7WrGXmYCan__ instanceof \think\Collection || $__7WrGXmYCan__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__7WrGXmYCan__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$guanyuzi): $mod = ($i % 2 );++$i;?>
                    <li class="detail-name"><a href="<?php echo $guanyuzi['url']; ?>"  ><?php echo $guanyuzi['name']; ?></a></li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <ul style="width:220px;">
                    <h5 class="title">产品与服务</h5>
                     <?php $__FgxTvBarsS__ = \addons\cms\model\Channel::getChannelList(["id"=>"chanpinzi","type"=>"son","orderway"=>"asc","ordery"=>"weigh","typeid"=>98]); if(is_array($__FgxTvBarsS__) || $__FgxTvBarsS__ instanceof \think\Collection || $__FgxTvBarsS__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__FgxTvBarsS__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$chanpinzi): $mod = ($i % 2 );++$i;?>
                    <li class="detail-name pro-name"><a href="<?php echo $chanpinzi['url']; ?>"  ><?php echo $chanpinzi['name']; ?></a></li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <ul style="width:335px;">
                    <h5 class="title">联系我们</h5>
                    <?php if($config['qrcode']): ?>
                    <li class="detail-name"><a href="tel:<?php echo $config['phone']; ?>"><?php echo $config['phone']; ?></a></li>
                    <?php endif; ?>
                    <li class="detail-name"><a href="sms:<?php echo $config['email']; ?>"><?php echo $config['email']; ?></a></li>
                    <?php if($config['dizhi']): ?>
                    <li class="detail-name"><a href="/cms/p/lianxi"><?php echo $config['dizhi']; ?></a></li>
                    <?php endif; if($config['weibo']): ?>

                    <a href="<?php echo $config['weibo']; ?>"  >
                        <img src=" /assets/addons/cms/src/image/t-weibo.png" alt="" class="bot-weibo">
                    </a>
                    <?php endif; ?>

                </ul>
                <?php if($config['qrcode']): ?>
                <div class="bot-weixin">
                    <img src="<?php echo cdnurl($config[qrcode]); ?>" alt="">
                    <span>关注长财咨询</span>
                </div>
                <?php endif; ?>
            </div>
            <?php if($config['beian']): ?>
            <div class="bot-copy"><?php echo $config['beian']; ?></div>
            <?php endif; ?>
        </div>
         <!-- 专家团队分享弹框 -->
        <div class="share-modal hide" id="teamModal" >
            <div class="modal-box">
                <div class="box bshare-custom">
                    <h2>分享到</h2>
                    <div class="icon-group">
                        <img src=" /assets/addons/cms/src/image/m-weixin.png" alt="" id="weixin">
                        <img src=" /assets/addons/cms/src/image/m-weibo.png"  alt="" id="weibo">
                        <img src=" /assets/addons/cms/src/image/m-qq.png" alt="" id="qq">
                        <img src=" /assets/addons/cms/src/image/m-q-zone.png" alt="" id="qzone">
                    </div>
                  <!--   <img src=" /assets/addons/cms/src/image/m-erweima.png" alt="" class="ma">
                    <p class="m-desc">微信扫码分享</p> -->
                    <img src=" /assets/addons/cms/src/image/close.png" alt="" class="close">
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/buttonLite.js#uuid=>"></script>
<script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/bshareC0.js"></script>
 <script type="text/javascript" src=" /assets/addons/cms/js/common.js"></script>  
 <script type="text/javascript">
      function local(url){
       return  window.location.href=url;
     }
   
     //bshare分享内容
        //预定义bshare分享按钮样式及配置参数
    var bShareOpt = {style:-1,uuid:'',mdiv:-1};

    function shareTo(event, shortName,obj) {
       //自定义设置内容，可动态获取当前页面内相应的参数进行传递
       var url= obj.fullurl || "http://www.bshare.cn/";
       var str_title = obj.title || "testTitle";
       var str_info = obj.description || "testSummary";
       var img = obj.image || "http://static.bshare.cn/images/bshare-logo-main.gif";
       //清除自定义分享内容的方法，在设置前清空，重新自定义内容
       bShare.entries = [];
       //添加自定义分享内容方法，不需要自定义的可以传递，bshare js会主动抓取页面相应值默认
       bShare.addEntry({
         title: str_title,
         url: url,
         summary: str_info,
      });
      //调用相应的分享方法，
      bShare.share(event, shortName,0);
    }
    console.log(bShare)
         //点击专家团队身上的分享按钮弹出模态框
        $('.share').click(function () {
            var obj=$(this)
            var dataid=obj.attr('data-id')
            $('#teamModal').fadeIn();
            $.ajax({
            url: '/addons/cms/api/share',
            type: 'POST',
            data: {dataid:dataid},
            dataType: 'json',
            success: function (json) {
                if(json){
                    console.log(json)
                    $('#weixin').click(function(){
                        // var name =$(this)        
                     shareTo(document.getElementById('weixin'),'weixin',json)

                    })
                    $('#weibo').click(function(){
                        // console.log($(this))
                        // var name =$(this)
                        
                      shareTo(document.getElementById('weibo'),'sinaminiblog',json)
                    })

                    $('#qq').click(function(){

                      shareTo(document.getElementById('qq'),'qqim',json)
                    })

                    $('#qzone').click(function(){

                     shareTo(document.getElementById('qzone'),'mqzone',json)
                    })

                }else{
                    alert('出错了！')
                }
            },
            error: function () {
                btn.removeAttr("disabled");
                alert('刷新页面重试')

            }
        });
            return false;
        })

 </script>