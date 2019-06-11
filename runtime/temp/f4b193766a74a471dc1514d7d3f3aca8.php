<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:74:"/www/wwwroot/default/tpadmin/addons/cms/view/default/common/formfield.html";i:1549411004;s:71:"/www/wwwroot/default/tpadmin/addons/cms/view/default/list_zhunajia.html";i:1560140466;s:71:"/www/wwwroot/default/tpadmin/addons/cms/view/default/common/layout.html";i:1555567574;}*/ ?>
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
                     <?php $__SciNHuIm2L__ = \addons\cms\model\Channel::getChannelList(["id"=>"nav","typeid"=>"98,72,63","orderby"=>"weigh","orderway"=>"desc"]); if(is_array($__SciNHuIm2L__) || $__SciNHuIm2L__ instanceof \think\Collection || $__SciNHuIm2L__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__SciNHuIm2L__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?>
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
                <?php $__Es5h1AJ7eV__ = \addons\cms\model\Channel::getBreadcrumb(isset($__CHANNEL__)?$__CHANNEL__:[], isset($__ARCHIVES__)?$__ARCHIVES__:[], isset($__TAGS__)?$__TAGS__:[], isset($__PAGE__)?$__PAGE__:[]); if(is_array($__Es5h1AJ7eV__) || $__Es5h1AJ7eV__ instanceof \think\Collection || $__Es5h1AJ7eV__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__Es5h1AJ7eV__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;if($key==0): ?>
                <span onclick="local('<?php echo $item['url']; ?>')"><?php echo $item['name']; ?></span>
                <?php else: ?>
                 -<span onclick="local('<?php echo $item['url']; ?>')"><?php echo $item['name']; ?></span>
                <?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <?php endif; else: ?>
         <div class="crumbs">
                当前位置：
                <?php $__HIjJuTLUQY__ = \addons\cms\model\Channel::getBreadcrumb(isset($__CHANNEL__)?$__CHANNEL__:[], isset($__ARCHIVES__)?$__ARCHIVES__:[], isset($__TAGS__)?$__TAGS__:[], isset($__PAGE__)?$__PAGE__:[]); if(is_array($__HIjJuTLUQY__) || $__HIjJuTLUQY__ instanceof \think\Collection || $__HIjJuTLUQY__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__HIjJuTLUQY__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;if($key==0): ?>
                <span onclick="local('<?php echo $item['url']; ?>')"><?php echo $item['name']; ?></span>
                <?php else: ?>
                 -<span onclick="local('<?php echo $item['url']; ?>')"><?php echo $item['name']; ?></span>
                <?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </div>
        <?php endif; endif; ?>
          
    <link rel="stylesheet" href=" /assets/addons/cms/css/team.css?v=<?php echo \think\Config::get("site.version"); ?>">
    <style type="text/css">
    body{
        background:#f5f5f5;
    }
    </style>
  <div class="cont-box">
            <ul class="team-cate">
                <li class="t-cate c-red" data-id="all">全部</li>
                <?php $__Sf2uNJ1wdy__ = \addons\cms\model\Tags::getTagGroup(["id"=>tags,"channel_id"=>63]); if(is_array($__Sf2uNJ1wdy__) || $__Sf2uNJ1wdy__ instanceof \think\Collection || $__Sf2uNJ1wdy__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__Sf2uNJ1wdy__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tags): $mod = ($i % 2 );++$i;?>
                <li class="t-cate" data-id="<?php echo $tags['id']; ?>"><?php echo $tags['name']; ?></li>
                <?php endforeach; endif; else: echo "" ;endif; ?>

            </ul>
            <ul class="t-items">
                <?php $__WaRxCeUcKB__ = \addons\cms\model\Archives::getArchivesList(["id"=>"hot","orderway"=>"asc","orderby"=>"weigh publishtime","channel"=>63,"limit"=>"150"]); if(is_array($__WaRxCeUcKB__) || $__WaRxCeUcKB__ instanceof \think\Collection || $__WaRxCeUcKB__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__WaRxCeUcKB__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hot): $mod = ($i % 2 );++$i;?>
                <a href="<?php echo $hot['url']; ?>">
                     
                    <li>
                        <div class="t-imgs">
                            <?php echo $hot['img']; ?>
                        </div>
                        <div class="t-desc">
                            <p class="name"><?php echo $hot['title']; ?></p>
                            <?php $biaoqian = explode("\r\n",$hot['description']);
                                            for($i=0;$i<count($biaoqian);$i++){
                                            ?>
                                            <p class="desc"><?php echo $biaoqian[$i]; ?></p>
                                            <?php
                                            }
                                             ?>
                        </div>
                    </li>
                </a> 
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
         <script>
        
       
            $('.t-cate').click(function () {
                $(this).addClass('c-red').siblings().removeClass('c-red');
                 var channel_id="<?php echo $__CHANNEL__->id; ?>"
                 var tag =$(this).attr('data-id')
                var btn = $(this);
                btn.attr("disabled", "disabled");
                $.ajax({
                    url: '/addons/cms/Channel/get_experts',
                    type: 'POST',
                    data: {'channel_id':channel_id,'tag':tag,'timeStamp':new Date().getTime()},
                    dataType: 'json',
                    success: function (json) {
                        btn.removeAttr("disabled");
                       if(json){
                            $('.t-items').html(json); 
                       
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
                    <?php $__YByKn1dEht__ = \addons\cms\model\Channel::getChannelList(["type"=>"son","id"=>"guanyuzi","typeid"=>72,"model"=>6,"orderway"=>"asc"]); if(is_array($__YByKn1dEht__) || $__YByKn1dEht__ instanceof \think\Collection || $__YByKn1dEht__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__YByKn1dEht__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$guanyuzi): $mod = ($i % 2 );++$i;?>
                    <li class="detail-name"><a href="<?php echo $guanyuzi['url']; ?>"  ><?php echo $guanyuzi['name']; ?></a></li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <ul style="width:220px;">
                    <h5 class="title">产品与服务</h5>
                     <?php $__mdLGzXavrl__ = \addons\cms\model\Channel::getChannelList(["id"=>"chanpinzi","type"=>"son","orderway"=>"asc","ordery"=>"weigh","typeid"=>98]); if(is_array($__mdLGzXavrl__) || $__mdLGzXavrl__ instanceof \think\Collection || $__mdLGzXavrl__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__mdLGzXavrl__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$chanpinzi): $mod = ($i % 2 );++$i;?>
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