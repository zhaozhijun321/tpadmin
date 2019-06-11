 $(function (){
    apikey ={};riliarr={}
  
    //收藏
     function AddFavorite(sURL, sTitle) {
        if (/firefox/i.test(navigator.userAgent)) {
            return false;
        } else if (window.external && window.external.addFavorite) {
            window.external.addFavorite(sURL, sTitle);
            return true;
        } else if (window.sidebar && window.sidebar.addPanel) {
            window.sidebar.addPanel(sTitle, sURL, "");
            return true;
        } else {
            var touch = (navigator.userAgent.toLowerCase().indexOf('mac') != -1 ? 'Command' : 'CTRL');
            alert('请使用 ' + touch + ' + D 添加到收藏夹.');
            return false;
        }
    }
     // 点击收藏
    $(".share-con").children('.share-txt').eq(2).click(function () {
        return !AddFavorite(window.location.href, $(this).attr("title"));
    });
    //点击专家团队身上的分享按钮弹出模态框
    // $('.share').click(function () {
    //     $('#teamModal').fadeIn();
    //     return false;
    // })
    // 点击转团队分享的关闭按钮
    $('body').delegate('.close','click',function () {
        $('#teamModal').fadeOut();
    })

    // 点击今日长财分类按钮操作
    $('.todys .cate').click(function () {
        var index = $(this).index();
        $(this).addClass('c-red').siblings().removeClass('c-red');
        $('.tody').eq(index).show().siblings('.tody').hide();
    })
    $('.citys .cate').click(function () {
        // var index = $(this).index();
        // $(this).addClass('c-red').siblings().removeClass('c-red');
        var btn = $(this);

        ajaxcity(btn)
        // $('.tody').eq(index).show().siblings('.tody').hide();
    })
    // 点击模态框城市按钮操作
    $('.city-item').click(function () {
       
        var btn = $(this);
        // console.log(convertData)
        ajaxcity(btn)

    })
    function  ajaxcity(obj){
        var dataid = obj.attr('data-item');
        var city_name = obj.text(); //当前城市名字
        obj.addClass('c-red').siblings().removeClass('c-red');
        $('#cityModal').fadeOut(); //模态框隐藏
        // 执行切换城市的数据
        // 执行ajax请求
        
        obj.attr("disabled", "disabled");
        $.ajax({
            url: '/addons/cms/api/getMoresclice',
            type: 'POST',
            data: {dataid:dataid},
            dataType: 'json',
            success: function (json) {
                obj.removeAttr("disabled");
                if(json){
                    if(json.item.length>0){
                         myChart.setOption({
                            series:[{data:[{name:json.sheng,selected:true}]}]
                        })
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
                btn.removeAttr("disabled");
                alert('刷新页面重试')

            }
        });
        return false;
    }
    // 点击更多城市按钮
    $('.more-city').click(function (){
        $('#cityModal').fadeIn(); //更多城市模态框显示
    })
   
    // 点击提交表单之后之后的操作
    $('.send').click(function () {
        var btn = $(this);
        var form = $("#new-form");
        btn.attr("disabled", "disabled");
        $.ajax({
                url: form.prop("action"),
                type: 'POST',
                data: form.serialize(),
                dataType: 'json',
                success: function (json) {
                    btn.removeAttr("disabled");
                    if (json.code == 1) {
                      $('#new-form')[0].reset();
                       $('#msg-form').hide();
                        $('.ly-box').hide();
                        $('.success').show();
                    } else {
                        alert(json.msg)
                    }
                    if (json.data && json.data.token) {
                        $("#postform input[name='__token__']").val(json.data.token);
                    }
                },
                error: function () {
                    btn.removeAttr("disabled");
                     alert('刷新页面重试')

                }
            });
            return false;
        // $('#msg-form').hide();
        // $('.ly-box').hide();
        // $('.success').show();
    })
    //点击表单成功之后的确认按钮
    $('.sure').click(function () {
        $('#msg-form').show();
        $('.ly-box').show();
        $('.success').hide();
    })

    // 初始化首页大轮播图组件
    var mySwiper = new Swiper ('.swiper-container1', {
        loop: true, // 循环模式选项
        autoplay:{
            disableOnInteraction : false,
            delay:5000
        }, // 自动播放
        
        // spaceBetween: 30,
        // effect: 'fade',
        pagination: {// 如果需要分页器
            el: '.swiper-pagination1',
            clickable: true,
        },
        on:{
            init:function(swiper){
                slide=this.slides.eq(0);
                slide.addClass('ani-slide');
            },
            transitionStart: function(){
                for(i=0;i<this.slides.length;i++){
                    slide=this.slides.eq(i);
                    slide.removeClass('ani-slide');
                }
            },
            transitionEnd: function(){
                slide=this.slides.eq(this.activeIndex);
                slide.addClass('ani-slide');
                
            },
        }
        
    })   

    // 初始化产品与服务轮播图组件
    var mySwiper1 = new Swiper ('.swiper-container2', {
        loop: true, // 循环模式选项
        autoplay:{
            disableOnInteraction : false,
            delay:5000
        }, // 自动播放
        
        // spaceBetween: 30,
        // effect: 'fade',
        pagination: {// 如果需要分页器
            el: '.swiper-pagination2',
            clickable: true,
        }
    })
    
    // 初始化专家团队轮播图组件
    var mySwiper2 = new Swiper ('.swiper-container3', {
        loop: true, // 循环模式选项
        autoplay:{
            disableOnInteraction : false,
            delay:5000
        }, // 自动播放
        
        // spaceBetween: 30,
        // effect: 'fade',
        pagination: {// 如果需要分页器
            el: '.swiper-pagination3',
            clickable: true,
        }
    })
   
    // 初始化研讨会信息轮播图组件
    // var mySwiper2 = new Swiper ('.swiper-container4', {
    //     loop: true, // 循环模式选项
    //     autoplay:{
    //         disableOnInteraction : false,
    //         delay:5000
    //     }, // 自动播放
        
    //     // spaceBetween: 30,
    //     // effect: 'fade',
    //     pagination: {// 如果需要分页器
    //         el: '.swiper-pagination4',
    //         clickable: true,
    //     }
    // })
    // //日历组件嵌套在指定容器中
    // laydate.render({
    //     elem: '#cc_date',
    //     position: 'static',
    //     mark:{ //后期用来接收是都有课程的日期
    //         '2019-01-09':'',
    //         '2019-01-15':'',
    //         '2019-01-25':'',
    //         '2019-01-26':'',
    //         '2019-01-27':'',
    //         '2019-01-28':'',
    //     },
    //     btns: ['now'],//底部显示的按钮
    //     // theme: '#D21F20',
    //     change: function(value, date){ //监听日期被切换

    //         // 模拟数据
    //         const defaultValue = ['2019-01-09','2019-01-15','2019-01-25','2019-01-26','2019-01-27','2019-01-28'];
    //         // 如果当天没有课程显示最近一个月的课程
    //         // console.log(value);
    //         var vst = defaultValue.indexOf(value);
    //         if(defaultValue.indexOf(value) == -1 ) {
    //             $('.month-ke').show();
    //             $('.day-ke').hide();
    //         } else {
    //             $('.month-ke').hide();
    //             $('.day-ke').show();
    //         }
    //         // 待完善
    //          // 点击日历进行ajax请求，请求课程
    //         $.post('/addons/cms/api/laydate',{apikey,date:value,vst:vst},function(data){
    //             // if()
    //         })
            
    //     },
    // });


    //跳转
   

    // 监听页面滚动
    $(window).scroll(function () {
    var tops = $(document).scrollTop();
    if (tops > 600) {
    $('.back-top').show();
    return;
    }
    if (tops < 600) {
    $('.back-top').hide();
    return;
    }
    })
    //点击回到顶部
    $('.back-top').click(function () {
    $('html,body').animate({
    scrollTop: '0px'
    }, 800);
    })

    $('body').delegate('.download','click',function(){
        var obj=$(this);

        var dataid =obj.attr('data-id')
        obj.attr("disabled", "disabled");
        location.href="/addons/cms/api/ajaxDownload?dataid="+dataid
       
        // return false;
    })

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

})


        