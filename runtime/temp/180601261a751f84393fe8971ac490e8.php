<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:74:"/www/wwwroot/default/tpadmin/addons/cms/view/default/common/formfield.html";i:1549411004;s:65:"/www/wwwroot/default/tpadmin/addons/cms/view/default/channel.html";i:1550163874;s:71:"/www/wwwroot/default/tpadmin/addons/cms/view/default/common/layout.html";i:1555567574;}*/ ?>
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
                     <?php $__UK4QmNfhr5__ = \addons\cms\model\Channel::getChannelList(["id"=>"nav","typeid"=>"98,72,63","orderby"=>"weigh","orderway"=>"desc"]); if(is_array($__UK4QmNfhr5__) || $__UK4QmNfhr5__ instanceof \think\Collection || $__UK4QmNfhr5__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__UK4QmNfhr5__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?>
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
                <?php $__Uh5bpGJW98__ = \addons\cms\model\Channel::getBreadcrumb(isset($__CHANNEL__)?$__CHANNEL__:[], isset($__ARCHIVES__)?$__ARCHIVES__:[], isset($__TAGS__)?$__TAGS__:[], isset($__PAGE__)?$__PAGE__:[]); if(is_array($__Uh5bpGJW98__) || $__Uh5bpGJW98__ instanceof \think\Collection || $__Uh5bpGJW98__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__Uh5bpGJW98__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;if($key==0): ?>
                <span onclick="local('<?php echo $item['url']; ?>')"><?php echo $item['name']; ?></span>
                <?php else: ?>
                 -<span onclick="local('<?php echo $item['url']; ?>')"><?php echo $item['name']; ?></span>
                <?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <?php endif; else: ?>
         <div class="crumbs">
                当前位置：
                <?php $__JY3ONopADw__ = \addons\cms\model\Channel::getBreadcrumb(isset($__CHANNEL__)?$__CHANNEL__:[], isset($__ARCHIVES__)?$__ARCHIVES__:[], isset($__TAGS__)?$__TAGS__:[], isset($__PAGE__)?$__PAGE__:[]); if(is_array($__JY3ONopADw__) || $__JY3ONopADw__ instanceof \think\Collection || $__JY3ONopADw__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__JY3ONopADw__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;if($key==0): ?>
                <span onclick="local('<?php echo $item['url']; ?>')"><?php echo $item['name']; ?></span>
                <?php else: ?>
                 -<span onclick="local('<?php echo $item['url']; ?>')"><?php echo $item['name']; ?></span>
                <?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </div>
        <?php endif; endif; ?>
            
    <link rel="stylesheet" href=" /assets/addons/cms/css/about.css?v=<?php echo \think\Config::get("site.version"); ?>">
        <div class="box-title" style="margin-top: 100px">
           <!--  <ul> -->
             <h2><?php echo $__CHANNEL__['name']; ?></h2>
                
            <!-- </ul> -->
        </div>
        <!-- 法律声明 -->
        <div class="joins falv nav-item">
            <div class="cont">
                <!-- 里面为富文本返回数据 -->
                <p><?php echo $__CHANNEL__['description']; ?></p>
            </div>
        </div>

        <!-- 共用底部 -->
        <div class="com-bottom">
            <div class="bot-box">
                <!-- 关于我们 -->
                <ul style="width:312px;">
                    <h5 class="title">关于长财</h5>
                    <?php $__LJhG0rZQWq__ = \addons\cms\model\Channel::getChannelList(["type"=>"son","id"=>"guanyuzi","typeid"=>72,"model"=>6,"orderway"=>"asc"]); if(is_array($__LJhG0rZQWq__) || $__LJhG0rZQWq__ instanceof \think\Collection || $__LJhG0rZQWq__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__LJhG0rZQWq__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$guanyuzi): $mod = ($i % 2 );++$i;?>
                    <li class="detail-name"><a href="<?php echo $guanyuzi['url']; ?>"  ><?php echo $guanyuzi['name']; ?></a></li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <ul style="width:220px;">
                    <h5 class="title">产品与服务</h5>
                     <?php $__8EYrPJMeox__ = \addons\cms\model\Channel::getChannelList(["id"=>"chanpinzi","type"=>"son","orderway"=>"asc","ordery"=>"weigh","typeid"=>98]); if(is_array($__8EYrPJMeox__) || $__8EYrPJMeox__ instanceof \think\Collection || $__8EYrPJMeox__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__8EYrPJMeox__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$chanpinzi): $mod = ($i % 2 );++$i;?>
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