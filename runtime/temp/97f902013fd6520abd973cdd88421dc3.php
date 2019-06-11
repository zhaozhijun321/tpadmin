<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:85:"D:\phpStudy\PHPTutorial\WWW\tpadmin2019611\tpadmin\addons\cms\view\default\index.html";i:1556431127;s:93:"D:\phpStudy\PHPTutorial\WWW\tpadmin2019611\tpadmin\addons\cms\view\default\common\layout.html";i:1555567574;}*/ ?>
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
                     <?php $__U3JPFHXm6k__ = \addons\cms\model\Channel::getChannelList(["id"=>"nav","typeid"=>"98,72,63","orderby"=>"weigh","orderway"=>"desc"]); if(is_array($__U3JPFHXm6k__) || $__U3JPFHXm6k__ instanceof \think\Collection || $__U3JPFHXm6k__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__U3JPFHXm6k__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?>
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
                <?php $__qil5AL7pGn__ = \addons\cms\model\Channel::getBreadcrumb(isset($__CHANNEL__)?$__CHANNEL__:[], isset($__ARCHIVES__)?$__ARCHIVES__:[], isset($__TAGS__)?$__TAGS__:[], isset($__PAGE__)?$__PAGE__:[]); if(is_array($__qil5AL7pGn__) || $__qil5AL7pGn__ instanceof \think\Collection || $__qil5AL7pGn__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__qil5AL7pGn__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;if($key==0): ?>
                <span onclick="local('<?php echo $item['url']; ?>')"><?php echo $item['name']; ?></span>
                <?php else: ?>
                 -<span onclick="local('<?php echo $item['url']; ?>')"><?php echo $item['name']; ?></span>
                <?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <?php endif; else: ?>
         <div class="crumbs">
                当前位置：
                <?php $__3m6y20DMaG__ = \addons\cms\model\Channel::getBreadcrumb(isset($__CHANNEL__)?$__CHANNEL__:[], isset($__ARCHIVES__)?$__ARCHIVES__:[], isset($__TAGS__)?$__TAGS__:[], isset($__PAGE__)?$__PAGE__:[]); if(is_array($__3m6y20DMaG__) || $__3m6y20DMaG__ instanceof \think\Collection || $__3m6y20DMaG__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__3m6y20DMaG__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;if($key==0): ?>
                <span onclick="local('<?php echo $item['url']; ?>')"><?php echo $item['name']; ?></span>
                <?php else: ?>
                 -<span onclick="local('<?php echo $item['url']; ?>')"><?php echo $item['name']; ?></span>
                <?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </div>
        <?php endif; endif; ?>
        
        <!-- 首页大轮播图 -->
        <div class="swiper-container swiper-container1">
            <div class="swiper-wrapper">
                <?php $__Vjlg25hxyr__ = \addons\cms\model\Block::getBlockList(["id"=>"block","name"=>"focus","row"=>"5"]); if(is_array($__Vjlg25hxyr__) || $__Vjlg25hxyr__ instanceof \think\Collection || $__Vjlg25hxyr__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__Vjlg25hxyr__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$block): $mod = ($i % 2 );++$i;?>
                <div class="swiper-slide" onclick="location.href='<?php echo $block['url']; ?>'"><img src="<?php echo $block['image']; ?>">
                     
                </div>

                <?php endforeach; endif; else: echo "" ;endif; ?>

            </div>
            <!-- 如果需要分页器 -->
            <div class="swiper-pagination1 swiper-pagination"></div>
        </div>
        <!-- 最近新闻 -->
        <div class="news-box">
            <?php $__rozVXYwARk__ = \addons\cms\model\Channel::getChannelList(["id"=>"xinwen","cache"=>"true","typeid"=>3]); if(is_array($__rozVXYwARk__) || $__rozVXYwARk__ instanceof \think\Collection || $__rozVXYwARk__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__rozVXYwARk__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$xinwen): $mod = ($i % 2 );++$i;?>
            <div class="box-title" onclick="local('<?php echo $xinwen['url']; ?>')">
                <h2 class="a-link">最近新闻</h2>
                <a href="<?php echo $xinwen['url']; ?>">
                    <img src=" /assets/addons/cms/src/image/more2.png" alt="">
                </a>

            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>

            <div class="news-items">
                <?php $__PQSuhydoBW__ = \addons\cms\model\Archives::getArchivesList(["id"=>"new","channel"=>"3,7,5,4","orderway"=>"desc","orderby"=>"publishtime","row"=>"4"]); if(is_array($__PQSuhydoBW__) || $__PQSuhydoBW__ instanceof \think\Collection || $__PQSuhydoBW__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__PQSuhydoBW__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$new): $mod = ($i % 2 );++$i;?>
                <div class="item">
                    <?php echo $new['imglink']; ?>
                    <div class="item-con">
                        <a href="<?php echo $new['url']; ?>">
                            <h5><?php echo $new['title']; ?></h5>
                        </a>
                        <p class="cont"><?php echo $new['description']; ?></p>
                        <p class="date"><?php echo date('Y.m.d',$new['publishtime']); ?></p>
                    </div>
                </div>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
        <!-- 日历部分 -->
        <div class="date-box">
            <?php $__SsRrewiuq2__ = \addons\cms\model\Channel::getChannelList(["id"=>"kecheng","cache"=>"true","typeid"=>97]); if(is_array($__SsRrewiuq2__) || $__SsRrewiuq2__ instanceof \think\Collection || $__SsRrewiuq2__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__SsRrewiuq2__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$kecheng): $mod = ($i % 2 );++$i;?>

            <div class="box-title">
                <h2>长财咨询课程日历</h2>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>

            <!-- 日历控件 -->
            <div class="date-com">
                <div id="cc_date" class="cc_date"></div>
                <!-- 日历控件右侧详情 -->
                <div class="date-cont">
                    <!-- 当前是当天没有课程的样式 -->
                   <!--  <div class="month-ke">
                       
                    </div> -->
                   <!--  <div class="day-ke">
                       
                    </div> -->
                    <?php
                    
                    $laydateint= new addons\cms\controller\Api;
                
                    echo  $laydateint->beginToday()['html'];
                    ?>
                </div>
            </div>
        </div>

        <!-- 关于我们 -->
        <div class="guanyu">
            <?php $__jhHwRicpOb__ = \addons\cms\model\Channel::getChannelList(["id"=>"guanyu","cache"=>"true","typeid"=>73]); if(is_array($__jhHwRicpOb__) || $__jhHwRicpOb__ instanceof \think\Collection || $__jhHwRicpOb__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__jhHwRicpOb__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$guanyu): $mod = ($i % 2 );++$i;?>

            <div class="box-title" onclick="local('<?php echo $guanyu['url']; ?>')">
                <h2 class="a-link">关于长财</h2>
                <a href="<?php echo $guanyu['url']; ?>">
                    <img src=" /assets/addons/cms/src/image/more2.png" alt="">
                </a>
            </div>

            <div class="box">
                <!-- 关于我们左边 -->
                <div class="box-left">
                    <h2>长财咨询</h2>
                    <div class="heng1"></div>

                    <p class="cont"><?php echo $guanyu['description']; ?></p>
                  <!--   <a href="/cms/c/jianjie.html" target="_blank" class="get-more1">
                        了解更多
                        <img src=" /assets/addons/cms/src/image/more2.png" alt="">
                    </a> -->
                    <div class="get-more1"></div>  
                    <ul>
                        <li><p class="nums">100+</p><p class="txt">专家老师</p></li>
                        <li><p class="nums">10000+</p><p class="txt">服务客户数量</p></li>
                        <li><p class="nums">1000+</p><p class="txt">员工</p></li>
                        <li><p class="nums">60+</p><p class="txt">分公司</p></li>
                    </ul>
                </div>

                <!-- 视频部分 -->
                <div class="box-right" id="video">
                    
                </div>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>

        </div>
        <!-- 产品与服务 -->
        <div class="product">
            <div class="p-box">
                    <?php $__Blpy4fjS3Z__ = \addons\cms\model\Channel::getChannelList(["id"=>"channel","cache"=>"true","typeid"=>98]); if(is_array($__Blpy4fjS3Z__) || $__Blpy4fjS3Z__ instanceof \think\Collection || $__Blpy4fjS3Z__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__Blpy4fjS3Z__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$channel): $mod = ($i % 2 );++$i;?>

                <div class="box-title" onclick="local('<?php echo $channel['url']; ?>')">
                    <h2 class="a-link">产品与服务</h2>
                    <a href="<?php echo $channel['url']; ?>">
                        <img src=" /assets/addons/cms/src/image/more2.png" alt="">
                    </a>
                </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>

                <div class="swiper-container2 swiper-container">
                    <div class="swiper-wrapper">
                       <?php if(is_array($chanpin) || $chanpin instanceof \think\Collection || $chanpin instanceof \think\Paginator): if( count($chanpin)==0 ) : echo "" ;else: foreach($chanpin as $key=>$chanpinid): ?>
                        <div class="swiper-slide ">
                            <ul class="p-items">
                            <?php if(is_array($chanpinid) || $chanpinid instanceof \think\Collection || $chanpinid instanceof \think\Paginator): if( count($chanpinid)==0 ) : echo "" ;else: foreach($chanpinid as $key=>$vo): ?>
                                <li>
                                    <?php echo $vo['img']; ?>
                                    <div class="p-heng"></div>
                                    <a href="<?php echo $vo['url']; ?>" class="liaojie">了解更多</a>
                                </li>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                       
                            </ul>
                        </div>
                       <?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                    <!-- 如果需要分页器 -->
                    <div class="swiper-pagination2 swiper-pagination">

                    </div>
                </div>
            </div>
        </div>

        <!-- 专家团队 -->
        <div class="team">
            <div class="t-box">
                   <?php $__l8KIjLpcYE__ = \addons\cms\model\Channel::getChannelList(["id"=>"zhuajia","cache"=>"true","typeid"=>63]); if(is_array($__l8KIjLpcYE__) || $__l8KIjLpcYE__ instanceof \think\Collection || $__l8KIjLpcYE__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__l8KIjLpcYE__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$zhuajia): $mod = ($i % 2 );++$i;?>

                <div class="box-title" onclick="local('<?php echo $zhuajia['url']; ?>')">
                    <h2 class="a-link">专家团队</h2>
                    <a href="<?php echo $zhuajia['url']; ?>">
                        <img src=" /assets/addons/cms/src/image/more2.png" alt="">
                    </a>
                </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>

                <div class="swiper-container3 swiper-container">
                    <div class="swiper-wrapper">
                       <?php if(is_array($zhuanjia) || $zhuanjia instanceof \think\Collection || $zhuanjia instanceof \think\Paginator): if( count($zhuanjia)==0 ) : echo "" ;else: foreach($zhuanjia as $key=>$vo): ?>
                        <div class="swiper-slide">
                            <ul class="t-items">
                                <?php $biaoqian=[]; if(is_array($vo) || $vo instanceof \think\Collection || $vo instanceof \think\Paginator): if( count($vo)==0 ) : echo "" ;else: foreach($vo as $key=>$v): ?>
                                    <li>
                                        <div class="t-imgs" onclick="local('<?php echo $v['url']; ?>')">
                                        <!-- <a href="<?php echo $v['url']; ?>"> -->

                                        <?php echo $v['img']; ?>
                                        </div>

                                        <div class="t-desc">
                                            <p class="name"><?php echo $v['title']; ?></p>
                                            <?php $biaoqian = explode("\r\n",$v['description']);
                                            for($i=0;$i<count($biaoqian);$i++){
                                            ?>
                                            <p class="desc"><?php echo $biaoqian[$i]; ?></p>
                                            <?php
                                            }
                                             ?>
                                           
                                        </div>
                                        <img src=" /assets/addons/cms/src/image/t-share.png" alt="    <?php echo $v['description']; ?>" class="share" data-url="<?php echo $v['url']; ?>" data-id="<?php echo $v['id']; ?>" >
                                    </li>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            
                            </ul>
                        </div>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                      
                    </div>
                    <!-- 如果需要分页器 -->
                    <div class="swiper-pagination3 swiper-pagination"></div>
                </div>
            </div>
        </div>
        <!-- 今日长财 -->

       <div class="news-box todys" style="background: #fff">
            <?php $__Vx5qIvtoGm__ = \addons\cms\model\Channel::getChannelList(["id"=>"jinri","cache"=>"true","typeid"=>92]); if(is_array($__Vx5qIvtoGm__) || $__Vx5qIvtoGm__ instanceof \think\Collection || $__Vx5qIvtoGm__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__Vx5qIvtoGm__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jinri): $mod = ($i % 2 );++$i;?>
            <div class="box-title" onclick="local('<?php echo $jinri['url']; ?>')">
                <h2 class="a-link">今日长财</h2>
                <a href="<?php echo $jinri['url']; ?>">
                    <img src=" /assets/addons/cms/src/image/more2.png" alt="">
                </a>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>

            <!-- 今日长才分类 -->
            <div class="cates">
                <ul class="cate-group">
                    <?php $__kzCpusOrdQ__ = \addons\cms\model\Channel::getChannelList(["id"=>"channel","typeid"=>90,"type"=>"son","orderway"=>"asc","orderby"=>"weigh"]); if(is_array($__kzCpusOrdQ__) || $__kzCpusOrdQ__ instanceof \think\Collection || $__kzCpusOrdQ__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__kzCpusOrdQ__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$channel): $mod = ($i % 2 );++$i;?>
                    
                    <li class="cate <?php if($key==0): ?> c-red <?php endif; ?>"><?php echo $channel['name']; ?></li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
            <!-- 此处代码每个模块对应一部分 需要全部遍历制作显示隐藏切换效果 志军注意-->
            <!-- 精彩回放 -->
            <div class="news-items tody ">
                <?php $__pltE7HUv4g__ = \addons\cms\model\Archives::getArchivesList(["id"=>"item","row"=>"4","orderby"=>"publishtime","orderway"=>"desc","channel"=>92]); if(is_array($__pltE7HUv4g__) || $__pltE7HUv4g__ instanceof \think\Collection || $__pltE7HUv4g__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__pltE7HUv4g__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
                <div class="item">
                    <a href="<?php echo $item['url']; ?>">
                        <?php echo $item['img']; ?>
                    </a>
                    <div class="item-con">
                        <a href="<?php echo $item['url']; ?>">
                            <h5><?php echo $item['title']; ?></h5>
                        </a>
                        <p class="cont"><?php echo $item['description']; ?></p>
                        <p class="date"><?php echo date('Y.m.d',$item['publishtime']); ?></p>
                    </div>
                </div>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <!-- 客户见证 -->
            <div class="news-items tody hide">
                 <?php $__tKXkYCf4Zd__ = \addons\cms\model\Archives::getArchivesList(["id"=>"item","row"=>"4","orderby"=>"publishtime","orderway"=>"desc","channel"=>93]); if(is_array($__tKXkYCf4Zd__) || $__tKXkYCf4Zd__ instanceof \think\Collection || $__tKXkYCf4Zd__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__tKXkYCf4Zd__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
                <div class="item">
                    <a href="<?php echo $item['url']; ?>">
                       <?php echo $item['img']; ?>
                    </a>
                    <div class="item-con">
                        <a href="<?php echo $item['url']; ?>">
                            <h5><?php echo $item['title']; ?></h5>
                        </a>
                        <p class="cont"><?php echo $item['description']; ?></p>
                        <p class="date"><?php echo date('Y.m.d',$item['publishtime']); ?></p>
                    </div>
                </div>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <!-- 长财猎头 -->
          <!--  <div class="news-items tody hide">
                <?php $__0dRhtSeWJo__ = \addons\cms\model\Archives::getArchivesList(["id"=>"lietou","row"=>"4","orderby"=>"id","orderway"=>"desc","channel"=>94]); if(is_array($__0dRhtSeWJo__) || $__0dRhtSeWJo__ instanceof \think\Collection || $__0dRhtSeWJo__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__0dRhtSeWJo__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lietou): $mod = ($i % 2 );++$i;?>
                <div class="item">
                    <a href="<?php echo $lietou['url']; ?>">
                       <?php echo $lietou['img']; ?>
                    </a>
                    <div class="item-con">
                        <a href="<?php echo $lietou['url']; ?>">
                            <h5><?php echo $lietou['title']; ?></h5>
                        </a>
                        <p class="cont"><?php echo $lietou['description']; ?></p>
                        <p class="date"><?php echo date('Y.m.d',$lietou['publishtime']); ?></p>
                    </div>
                </div>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div> -->
            <!-- 研讨会信息 -->
            <div class="to-box tody hide">
                  <!--   <div class="swiper-container4 swiper-container">
                    <div class="swiper-wrapper"> -->
                        <!-- <div class="swiper-slide"> -->
                            <ul class="items">
                                <?php if(is_array($yantaohuis) || $yantaohuis instanceof \think\Collection || $yantaohuis instanceof \think\Paginator): if( count($yantaohuis)==0 ) : echo "" ;else: foreach($yantaohuis as $key=>$yantaohui): ?>
                                <li class="item" onclick="local('<?php echo $yantaohui->channel->url; ?>')">
                                    <h2 class="title">
                                        <?php echo $yantaohui->chanpin->title; ?>
                                       </h2>
                                    <p><span>讲师： </span><span><?php if(!empty($yantaohui->archives)): if(is_array($yantaohui->archives) || $yantaohui->archives instanceof \think\Collection || $yantaohui->archives instanceof \think\Paginator): if( count($yantaohui->archives)==0 ) : echo "" ;else: foreach($yantaohui->archives as $key=>$laoshi): ?><?php echo $laoshi->title; ?>&nbsp;<?php endforeach; endif; else: echo "" ;endif; endif; ?></span></p>
                                    <p><span>时间：</span><span><?php echo date('m.d',strtotime($yantaohui->begintime)); ?>-<?php echo date('d',strtotime($yantaohui['endtime'])); ?></span></p>
                                    <p class="address"><span>地点：</span><span><?php echo strip_tags($yantaohui->area); ?></span></p>
                                   <?php if($yantaohui->qitafile): ?>
                                    <img src=" /assets/addons/cms/src/image/icon-pdf.png" alt="" class="download" data-id=<?php echo $yantaohui['id']; ?>>
                                    <?php endif; ?>
                                
                                </li>
                                <?php endforeach; endif; else: echo "" ;endif; ?>

                            </ul>
                        <!-- </div> -->
                    <!-- 如果需要分页器 -->
             <!--        <div class="swiper-pagination4 swiper-pagination"></div> -->
                <!-- </div> -->
            </div>
            
        </div>
        <!-- 分子公司 -->
        <div class="guanyu comps">
            <div class="box-title">
                <h2>分子公司</h2>
            </div>
            <!-- 分子公司城市分类 -->
            <div class="cates citys">
                <ul class="cate-group ">
                    <?php if($zifen): if(is_array($zifen) || $zifen instanceof \think\Collection || $zifen instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($zifen) ? array_slice($zifen,0,5, true) : $zifen->slice(0,5, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <li class="cate <?php if($key==0): ?>c-red<?php endif; ?>" <?php if($key==0): ?>data-sheng='<?php echo $firstsheng[shortName]; ?>'<?php endif; ?>data-item="<?php echo $vo['id']; ?>"><?php echo $vo['shortName']; ?></li>
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
                       <!--  <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src=" /assets/addons/cms/src/image/coms.png" alt="">
                                <div class="coms-desc">
                                <h2>北京分公司1</h2>
                                <p>联系地址：北京市亦庄经济技术开发区6号201室</p >
                                <p>联系方式：陈奕讯 18967105815</p >
                                </div>
                            </div>
                        </div> -->
                        <!-- 轮播图左右点击按钮 -->
                       <!--  <div class="lr-group">
                            <img src=" /assets/addons/cms/src/image/l-btn.png" alt="" class="b-left">
                            <img src=" /assets/addons/cms/src/image/r-btn.png" alt="" class="b-right">
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- 合作企业 -->
        <div class="imgs-box">
            <div class="box-title">
                <h2>合作企业</h2>
            </div>
            <div class="box" style="margin-top:80px;height: 365px;margin-bottom: 100px">
                <?php $__4Jtn8jmTOA__ = \addons\cms\model\Block::getBlockList(["id"=>"hezuoqiye","name"=>"hezuoqiye"]); if(is_array($__4Jtn8jmTOA__) || $__4Jtn8jmTOA__ instanceof \think\Collection || $__4Jtn8jmTOA__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__4Jtn8jmTOA__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hezuoqiye): $mod = ($i % 2 );++$i;?>
                <img src="<?php echo $hezuoqiye['image']; ?>" alt="">
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
        <!-- 留言 -->
        <div class="liuyan">
            <div class="ly-box">
                <h2>问题留言</h2>
                <div class="heng3"></div>
                <p>一次留言或许就是成就一个合作的开端</p>
                <img src=" /assets/addons/cms/src/image/msg-index.png" class="msg" alt="">
            </div>
            <!-- 表单部分 -->
            <div class="msg-form" id="msg-form">
                <h2 class="title">填写您的信息</h2>
                <form id="new-form" method="post" action="<?php echo addon_url('cms/diyform/post'); ?>">
                    <?php echo token(); ?>
                    <?php echo $diyform['fieldslist'] ?>
                    
                </form>
                <div class="btn send">发送</div>
            </div>
            <!-- 提交成功之后的样式 -->
            <div class="success hide">
                <img src=" /assets/addons/cms/src/image/send.png" alt="" class="send-img">
                <p>您的需求已成功发送</p>
                <p>我们将在72小时内与您取得联系</p>
                <div class="sure">确定</div>
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
    <!-- 回到顶部按钮 -->
    <div class="back-top hide">
        <img src=" /assets/addons/cms/src/image/back-top.png" alt="">
    </div>
 <script src="/assets/js/echarts.min.js?v=<?php echo \think\Config::get("site.version"); ?>"></script>
 <script src=" /assets/addons/cms/src/echarts/china.js"></script>
 <script src="/assets/addons/ckplayer/ckplayer/ckplayer.min.js"></script>
<script>
    <?php

   echo $laydateint->beginToday()['jsonhtml'];
   echo $laydateint->getLocation('','china-main')['eachart'];
  unset($laydateint);
    ?>
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
   
    <?php $__ghoEy3IM0a__ = \addons\cms\model\Block::getBlockList(["id"=>"video","name"=>"video"]); if(is_array($__ghoEy3IM0a__) || $__ghoEy3IM0a__ instanceof \think\Collection || $__ghoEy3IM0a__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__ghoEy3IM0a__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): $mod = ($i % 2 );++$i;?>
    var videocontent ='<?php echo cdnurl($video['url']); ?>' 
    var videoimg ='<?php echo $video['image']; ?>' 
    <?php endforeach; endif; else: echo "" ;endif; ?>
    //视频播放
   var videoObject = {
        container: '#video',//“#”代表容器的ID，“.”或“”代表容器的class
        variable: 'player',//该属性必需设置，值等于下面的new chplayer()的对象
        flashplayer:false,//如果强制使用flashplayer则设置成true
        video:videocontent,//视频地址
        poster: videoimg,
        autoplay: false,//是否自动播放
    };
    var player=new ckplayer(videoObject);
</script>
        <!-- 共用底部 -->
        <div class="com-bottom">
            <div class="bot-box">
                <!-- 关于我们 -->
                <ul style="width:312px;">
                    <h5 class="title">关于长财</h5>
                    <?php $__RfAEFzmC0P__ = \addons\cms\model\Channel::getChannelList(["type"=>"son","id"=>"guanyuzi","typeid"=>72,"model"=>6,"orderway"=>"asc"]); if(is_array($__RfAEFzmC0P__) || $__RfAEFzmC0P__ instanceof \think\Collection || $__RfAEFzmC0P__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__RfAEFzmC0P__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$guanyuzi): $mod = ($i % 2 );++$i;?>
                    <li class="detail-name"><a href="<?php echo $guanyuzi['url']; ?>"  ><?php echo $guanyuzi['name']; ?></a></li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <ul style="width:220px;">
                    <h5 class="title">产品与服务</h5>
                     <?php $__ywPaB3UsOD__ = \addons\cms\model\Channel::getChannelList(["id"=>"chanpinzi","type"=>"son","orderway"=>"asc","ordery"=>"weigh","typeid"=>98]); if(is_array($__ywPaB3UsOD__) || $__ywPaB3UsOD__ instanceof \think\Collection || $__ywPaB3UsOD__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__ywPaB3UsOD__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$chanpinzi): $mod = ($i % 2 );++$i;?>
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