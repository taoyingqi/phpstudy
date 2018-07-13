<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:62:"D:\test_www\yuxin\theme/home_view/template/index\download.html";i:1524488003;s:43:"theme/home_view/template/public/header.html";i:1524470528;s:43:"theme/home_view/template/public/footer.html";i:1524484105;}*/ ?>
<!DOCTYPE html>
<html class="smart-design-mode">
<head>
    <meta name="baidu-site-verification" content="xbQJjGRV5x" />
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="<?php echo $seo['description']; ?>" />
    <meta name="keywords" content="<?php echo $seo['keyword']; ?>" />
    <meta name="renderer" content="webkit" />
    <title><?php echo $seo['title']; ?></title>
    <link href="__static__/css/reset.css" rel="stylesheet" type="text/css"/>
    <link href="__static__/css/iconfont.css" rel="stylesheet" type="text/css"/>
    <link href="__static__/css/pager.css" rel="stylesheet" type="text/css"/>


    <link href="__static__/css/40118_Pc_zh-CN.css" rel="stylesheet" />
    <script src="__static__/js/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="__static__/js/jquery.lazyload.min.js" type="text/javascript"></script>
    <script src="__static__/js/smart.animation.min.js" type="text/javascript"></script>
    <script src="__static__/js/kino.razor.min.js" type="text/javascript"></script>
    <script src="__static__/js/common.min.js" type="text/javascript"></script>
    <script src="__static__/js/admin.validator.min.js" type="text/javascript"></script>
    <script src="__static__/js/jquery.cookie.js" type="text/javascript"></script>
    <script type='text/javascript' id='jssor-all' src='__static__/js/jssor.slider-22.2.16-all.min.js' ></script>
    <script type='text/javascript' id='slideshown' src='__static__/js/slideshow.js' ></script>
    <script type="text/javascript">
        $.ajaxSetup({
            cache: false,
            beforeSend: function (jqXHR, settings) {
                settings.data = settings.data && settings.data.length > 0 ? (settings.data + "&") : "";
                settings.data = settings.data + "__RequestVerificationToken=" + $('input[name="__RequestVerificationToken"]').val();
                return true;
            }
        });
    </script>
    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?8da48fe42f540ef830cde5e93b8f6c3b";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
</head>
<body id="smart-body" area="main">
<input type="hidden" id="pageinfo"
       value="40118"
       data-type="1"
       data-device="Pc"
       data-entityid="40118" />
<input id="txtDeviceSwitchEnabled" value="show" type="hidden" />
<link href="__static__/css/view.css" rel="stylesheet" type="text/css"/>
<div class="m-deviceSwitch" style="display: none;">
    <ul class="m-switch-ul f-clearfix">
        <li class="m-switch-item" data-device="Pc">
            <a href="javascript:void(0)" class="m-switch-link"><i class="icon icon-pc-black"></i></a>
            <div class="lzprompt-plan" style="margin-left: -28px;"><span class="lzprompt-txt">点击预览PC版</span><span class="lzprompt-point lzprompt-point-bottom"></span></div>
        </li>
        <li class="m-switch-item" data-device="Mobile">
            <a href="javascript:void(0)" class="m-switch-link"><i class="icon icon-mobile-black"></i></a>
            <div class="lzprompt-plan" style="margin-left: -32px;"><span class="lzprompt-txt">点击预览手机版</span><span class="lzprompt-point lzprompt-point-bottom"></span></div>
        </li>
    </ul>
</div>
<input type="hidden" id="secUrl" />

<script type="text/javascript">

    function initialDeviceSwitch() {
        var pageinfo = $("#pageinfo");
        var l = window.location;
        if (pageinfo.length == 0 && window.frames.length > 0) {
            pageinfo = $(window.frames[0].document).find("#pageinfo");
            l = window.frames[0].document.location;
        }
        $(".m-deviceSwitch").show();
        if (pageinfo.length == 0) {
            $(".m-deviceSwitch").hide();
            return;
        }
        $("#secUrl").attr("data-host", l.host).attr("data-pathname", l.pathname).attr("data-search", l.search).attr("data-hash", l.hash);
        var pagedevice = pageinfo.attr("data-device");
        $(".m-deviceSwitch").find("li[data-device=" + pagedevice + "]").addClass("active").find("a").addClass("z-current");
        $(".m-deviceSwitch").find("li").not(".active").click(function () {
            var secUrl = $("#secUrl");
            var host = secUrl.attr("data-host");
            var pathname = secUrl.attr("data-pathname");
            var search = secUrl.attr("data-search");
            var hash = secUrl.attr("data-hash");
            var npagedevice = $(this).attr("data-device");
            var mobileUrl = "http://" + host;
            if (npagedevice == "Pc") {
                mobileUrl = mobileUrl + pathname + search.replace("deviceModel=mobile", "deviceModel=pc") + hash;
            } else if (npagedevice == "Mobile") {
                var toUrl = pathname + search.replace("deviceModel=pc", "deviceModel=mobile") + hash;
                mobileUrl = mobileUrl + "/Runtime/MobileContainer?url=" + encodeURIComponent(toUrl);
            }
            // change device
            $.ajax({
                cache: false,
                url: "/Common/ChangeRunTimeDeviceMode",
                type: "post",
                data: { type: npagedevice },
                dataType: "json",
                success: function (result) {
                    if (result.IsSuccess) {
                        window.top.location.href = mobileUrl;
                    }
                },
                error: function () { }
            });
        });
    }
    $(function () {
        if ($("#prevMainFrame").length > 0) {
            $("#prevMainFrame").load(initialDeviceSwitch);
        } else {
            initialDeviceSwitch();
        }
    });
</script>    <div id="mainContentWrapper" style="background-color: transparent; background-image: none; background-repeat: no-repeat;background-position:0 0; background:-moz-linear-gradient(top, none, none);background:-webkit-gradient(linear, left top, left bottom, from(none), to(none));background:-o-linear-gradient(top, none, none);background:-ms-linear-gradient(top, none, none);background:linear-gradient(top, none, none);;
     position: relative; width: 100%;min-width:1000px;background-size: auto;" bgScroll="none">
    <div style="background-color: transparent; background-image: none; background-repeat: no-repeat;background-position:0 0; background:-moz-linear-gradient(top, none, none);background:-webkit-gradient(linear, left top, left bottom, from(none), to(none));background:-o-linear-gradient(top, none, none);background:-ms-linear-gradient(top, none, none);background:linear-gradient(top, none, none);;
         position: relative; width: 100%;min-width:1000px;background-size: auto;" bgScroll="none">
        <div class=" header" cpid="4894" id="smv_Area0" style="width: 1000px; height: 139px;  position: relative; margin: 0 auto">
            <div id="smv_tem_28_31" ctype="image"  class="esmartMargin smartAbs " cpid="4894" cstyle="Style1" ccolor="Item0" areaId="Area0" isContainer="False" pvid="" tareaId="Area0"  re-direction="all" daxis="All" isdeletable="True" style="height: 66px; width: 215px; left: 3px; top: 47px;z-index:7;"><div class="yibuFrameContent tem_28_31  image_Style1  " style="overflow:visible;;" >
                <div class="w-image-box" data-fillType="2" id="div_tem_28_31">
                    <a target="_self" href="">
                        <img src="__static__/img/512229.png" alt="微信图片_20171215102750" title="微信图片_20171215102750" id="img_smv_tem_28_31" style="width: 215px; height:66px;">
                    </a>
                </div>

                <script type="text/javascript">
                    $(function () {
                        InitImageSmv("tem_28_31", "201", "65", "2");
                    });
                </script>

            </div></div><div id="smv_tem_62_38" ctype="nav"  class="esmartMargin smartAbs " cpid="4894" cstyle="Style5" ccolor="Item0" areaId="Area0" isContainer="False" pvid="" tareaId="Area0"  re-direction="all" daxis="All" isdeletable="True" style="height: 70px; width: 697px; left: 228px; top: 47px;z-index:10010;"><div class="yibuFrameContent tem_62_38  nav_Style5  " style="overflow:visible;;" ><div id="nav_tem_62_38" class="nav_pc_t_5">
            <ul class="w-nav" navstyle="style5">
    <li class="w-nav-inner" style="height:70px;line-height:70px;width:16.6666666666667%;">
        <div class="w-nav-item">
            <a href="/" target="_self" class="w-nav-item-link">
                <span class="mw-iconfont"></span>
                <span class="w-link-txt">首页</span>
            </a>
            <a href="/" target="_self" class="w-nav-item-link hover">
                <span class="mw-iconfont"></span>
                <span class="w-link-txt">首页</span>
            </a>
        </div>
    </li>
    <li class="w-nav-inner" style="height:70px;line-height:70px;width:16.6666666666667%;">
        <div class="w-nav-item">
            <a href="<?php echo url('home/index/company_info'); ?>" target="_self" class="w-nav-item-link">
                <span class="mw-iconfont"></span>
                <span class="w-link-txt">公司介绍</span>
            </a>
            <a href="<?php echo url('home/index/company_info'); ?>" target="_self" class="w-nav-item-link hover">
                <span class="mw-iconfont"></span>
                <span class="w-link-txt">公司介绍</span>
            </a>
        </div>
    </li>
    <li class="w-nav-inner" style="height:70px;line-height:70px;width:16.6666666666667%;">
        <div class="w-nav-item">
            <a href="<?php echo url('home/index/product'); ?>" target="_self" class="w-nav-item-link">
                <span class="mw-iconfont"></span>
                <span class="w-link-txt">产品服务</span>
            </a>
            <a href="<?php echo url('home/index/product'); ?>" target="_self" class="w-nav-item-link hover">
                <span class="mw-iconfont"></span>
                <span class="w-link-txt">产品服务</span>
            </a>
        </div>
    </li>
    <li class="w-nav-inner" style="height:70px;line-height:70px;width:16.6666666666667%;">
        <div class="w-nav-item">
            <a href="<?php echo url('home/index/download'); ?>" target="_self" class="w-nav-item-link">
                <span class="mw-iconfont"></span>
                <span class="w-link-txt">软件下载</span>
            </a>
            <a href="<?php echo url('home/index/download'); ?>" target="_self" class="w-nav-item-link hover">
                <span class="mw-iconfont"></span>
                <span class="w-link-txt">软件下载</span>
            </a>
        </div>
    </li>
    <li class="w-nav-inner" style="height:70px;line-height:70px;width:16.6666666666667%;">
        <div class="w-nav-item">
            <a href="<?php echo url('home/index/reg'); ?>" target="_blank" class="w-nav-item-link">
                <span class="mw-iconfont"></span>
                <span class="w-link-txt">开户交易</span>
            </a>
            <a href="<?php echo url('home/index/reg'); ?>" target="_blank" class="w-nav-item-link hover">
                <span class="mw-iconfont"></span>
                <span class="w-link-txt">开户交易</span>
            </a>
        </div>
    </li>
    <li class="w-nav-inner" style="height:70px;line-height:70px;width:16.6666666666667%;">
        <div class="w-nav-item">
            <a href="<?php echo url('home/index/about'); ?>" target="_self" class="w-nav-item-link">
                <span class="mw-iconfont"></span>
                <span class="w-link-txt">联系我们</span>
            </a>
            <a href="<?php echo url('home/index/about'); ?>" target="_self" class="w-nav-item-link hover">
                <span class="mw-iconfont"></span>
                <span class="w-link-txt">联系我们</span>
            </a>
        </div>
    </li>

</ul>
        </div>
            <script>
                $(function () {
                    var itemHover, $this, item, itemAll, link;
                    $('#nav_tem_62_38 .w-nav').find('.w-subnav').hide();
                    $('#nav_tem_62_38 .w-nav').off('mouseenter').on('mouseenter', '.w-nav-inner', function () {
                        itemAll = $('#nav_tem_62_38 .w-nav').find('.w-subnav');
                        $this = $(this);
                        link = $this.find('.w-nav-item-link').eq(1);
                        item = $this.find('.w-subnav');
                        link.stop().fadeIn(400).css("display", "block");
                        item.slideDown();
                    }).off('mouseleave').on('mouseleave', '.w-nav-inner', function () {
                        $this = $(this);
                        item = $this.find('.w-subnav');
                        link = $this.find('.w-nav-item-link').eq(1);
                        link.stop().fadeOut(400);
                        item.stop().slideUp();
                    });
                    SetNavSelectedStyle('nav_tem_62_38');//选中当前导航
                });
            </script></div></div><div id="smv_tem_61_56" ctype="text"  class="esmartMargin smartAbs " cpid="4894" cstyle="Style1" ccolor="Item3" areaId="Area0" isContainer="False" pvid="" tareaId="Area0"  re-direction="all" daxis="All" isdeletable="True" style="height: 28px; width: 237px; left: 794px; top: 7px;z-index:10002;"><div class="yibuFrameContent tem_61_56  text_Style1  " style="overflow:hidden;;" ><div id='txt_tem_61_56' style="height: 100%;">
            <div class="editableContent" id="txtc_tem_61_56" style="height: 100%; word-wrap:break-word;">
                <p><span style="color:#2980b9"><span style="font-size:18px">客服热线：400-8898-021</span></span></p>

            </div>
        </div>
        </div></div>
        </div>
    </div>
    <div class="main-layout-wrapper" id="smv_AreaMainWrapper" style="background-color: rgb(255, 255, 255); background-image: none;
         background-repeat: no-repeat;background-position:0 0; background:-moz-linear-gradient(top, none, none);background:-webkit-gradient(linear, left top, left bottom, from(none), to(none));background:-o-linear-gradient(top, none, none);background:-ms-linear-gradient(top, none, none);background:linear-gradient(top, none, none);;background-size: auto;"
         bgScroll="none">
        <div class="main-layout" id="tem-main-layout11" style="width: 100%;">
            <div style="display: none">

            </div>
            <div class="" id="smv_MainContent" rel="mainContentWrapper" style="width: 100%; min-height: 300px; position: relative; ">

                <div class="smvWrapper"  style="min-width:1000px;  position: relative; background-color: transparent; background-image: none; background-repeat: no-repeat; background:-moz-linear-gradient(top, none, none);background:-webkit-gradient(linear, left top, left bottom, from(none), to(none));background:-o-linear-gradient(top, none, none);background:-ms-linear-gradient(top, none, none);background:linear-gradient(top, none, none);;background-position:0 0;background-size:auto;" bgScroll="none"><div class="smvContainer" id="smv_Main" cpid="40118" style="min-height:400px;width:1000px;height:1460px;  position: relative; "><div id="smv_con_6_24" ctype="slideset"  class="esmartMargin smartAbs " cpid="40118" cstyle="Style1" ccolor="Item0" areaId="Main" isContainer="True" pvid="" tareaId="Main"  re-direction="y" daxis="Y" isdeletable="True" style="height: 243px; width: 1000px; left: 0px; top: 1px;z-index:6;"><div class="yibuFrameContent con_6_24  slideset_Style1  " style="overflow:visible;;" >
                    <!--w-slide-->
                    <div class="w-slide" id="slider_smv_con_6_24">
                        <div class="w-slide-inner" data-u="slides">

                            <div class="content-box" data-area="Area1">
                                <div id="smc_Area1" cid="con_6_24" class="smAreaC slideset_AreaC">
                                    <div id="smv_con_9_24" ctype="text"  class="esmartMargin smartAbs " cpid="40118" cstyle="Style1" ccolor="Item3" areaId="Area1" isContainer="False" pvid="con_6_24" tareaId=""  re-direction="all" daxis="All" isdeletable="True" style="height: 18px; width: 107px; left: 632px; top: 94px;z-index:5;"><div class="yibuFrameContent con_9_24  text_Style1  " style="overflow:hidden;;" ><div id='txt_con_9_24' style="height: 100%;">
                                        <div class="editableContent" id="txtc_con_9_24" style="height: 100%; word-wrap:break-word;">
                                            <p><img alt="" src="//ntemimg.wezhan.cn/contents/sitefiles2000/10000348/images/-2897.png" />&nbsp;<span style="color:#cccccc"><span style="font-family:&quot;Microsoft YaHei&quot;; font-size:14px">您所在位置：</span></span></p>

                                        </div>
                                    </div>
                                    </div></div><div id="smv_con_10_34" ctype="breadcrumb"  class="esmartMargin smartAbs " cpid="40118" cstyle="Style1" ccolor="Item0" areaId="Area1" isContainer="False" pvid="con_6_24" tareaId="Main"  re-direction="x" daxis="All" isdeletable="True" style="height: 34px; width: 200px; left: 745px; top: 87px;z-index:9;"><div class="yibuFrameContent con_10_34  breadcrumb_Style1  " style="overflow:visible;;" ><!--crumbs-->
                                    <div class="w-crumbs">
                                        <a href="index.html" class="w-crumbs-item" pageid="32">首页</a>&nbsp;            <i class="w-arrowicon mw-iconfont ">&#xa132;</i>&nbsp;            <a class="w-crumbs-item w-item-current" pageid="40118">开户交易</a>

                                    </div>
                                    <!--/crumbs--></div></div><div id="smv_con_7_24" ctype="text"  class="esmartMargin smartAbs " cpid="40118" cstyle="Style1" ccolor="Item0" areaId="Area1" isContainer="False" pvid="con_6_24" tareaId=""  re-direction="all" daxis="All" isdeletable="True" style="height: 31px; width: 360px; left: 634px; top: 46px;z-index:2;"><div class="yibuFrameContent con_7_24  text_Style1  " style="overflow:hidden;;" ><div id='txt_con_7_24' style="height: 100%;">
                                    <div class="editableContent" id="txtc_con_7_24" style="height: 100%; word-wrap:break-word;">
                                        <p><span style="color:#cccccc"><span style="font-family:&quot;Microsoft YaHei&quot;; font-size:24px">服务项目</span><span style="font-size:20px"><span style="font-family:&quot;Microsoft YaHei&quot;"> / SERVICE ITEMS</span></span></span></p>

                                    </div>
                                </div>
                                </div></div>                </div>
                                <div class="content-box-inner" style="background-image:url(__static__/img/-9079.jpg);background-position:50% 50%;background-repeat:no-repeat;background-size: cover;background-color:#ffffff;opacity:1"></div>

                            </div>
                        </div>
                        <!-- Bullet Navigator -->
                        <div data-u="navigator" class="w-slide-btn-box  f-hide " data-autocenter="1">
                            <!-- bullet navigator item prototype -->
                            <div class="w-slide-btn" data-u="prototype"></div>
                        </div>

                        <!-- 1Arrow Navigator -->
    <span data-u="arrowleft" class="w-slide-arrowl  slideArrow  f-hide  " data-autocenter="2" id="left_con_6_24">
        <i class="w-itemicon mw-iconfont">&#xb133;</i>
    </span>
    <span data-u="arrowright" class="w-slide-arrowr slideArrow  f-hide " data-autocenter="2" id="right_con_6_24">
        <i class="w-itemicon mw-iconfont">&#xb132;</i>
    </span>
                    </div>
                    <!--/w-slide-->
                    <script type="text/javascript">
                        con_6_24_page = 1;
                        con_6_24_sliderset3_init = function () {
                            var jssor_1_options_con_6_24 = {
                                $AutoPlay: "False"=="True"?false:"on" == "on",//自动播放
                                $PlayOrientation: 1,//2为向上滑，1为向左滑
                                $Loop: 1,//循环
                                $Idle: parseInt("5000"),//切换间隔
                                $SlideDuration: "5000",//延时
                                $SlideEasing: $Jease$.$OutQuint,

                                $CaptionSliderOptions: {
                                    $Class: $JssorCaptionSlideo$,
                                    $Transitions: GetSlideAnimation("1", "5000"),
                                },

                                $ArrowNavigatorOptions: {
                                    $Class: $JssorArrowNavigator$
                                },
                                $BulletNavigatorOptions: {
                                    $Class: $JssorBulletNavigator$,
                                    $ActionMode: "1"
                                }
                            };
                            //初始化幻灯
                            var slide = new $JssorSlider$("slider_smv_con_6_24", jssor_1_options_con_6_24);
                            $('#smv_con_6_24').data('jssor_slide', slide);

                            //resize游览器的时候触发自动缩放幻灯秀
                            $(window).bind("resize", function (e) {
                                if (e.target == this) {
                                    var $this = $('#slider_smv_con_6_24');
                                    var ww = $(window).width();
                                    var width = $this.parent().width();

                                    if (ww > width) {
                                        var left = parseInt((ww - width) * 10 / 2) / 10;
                                        $this.css({ 'left': -left });
                                    } else {
                                        $this.css({ 'left': 0 });
                                    }
                                    slide.$ScaleWidth(ww);
                                }
                            });

                            //幻灯栏目自动或手动切换时触发的事件
                            slide.$On($JssorSlider$.$EVT_PARK, function (slideIndex, fromIndex) {
                                var $slideWrapper = $("#slider_smv_con_6_24 .w-slide-inner:last");
                                var $fromSlide = $slideWrapper.find(".content-box:eq(" + fromIndex + ")");
                                var $curSlide = $slideWrapper.find(".content-box:eq(" + slideIndex + ")");

                                $("#smv_con_6_24").attr("selectArea", $curSlide.attr("data-area"));
                                $fromSlide.find(".animated").smanimate("stop");
                                $curSlide.find(".animated").smanimate("stop");
                                $("#switch_con_6_24 .page").html(slideIndex + 1);
                                $curSlide.find(".animated").smanimate("replay");
                                return false;
                            });
                            //切换栏点击事件
                            $("#switch_con_6_24 .left").unbind("click").click(function () {
                                if(con_6_24_page==1){
                                    con_6_24_page =1;
                                } else {
                                    con_6_24_page = con_6_24_page - 1;
                                }
                                $("#switch_con_6_24 .page").html(con_6_24_page);
                                slide.$Prev();
                                return false;
                            });
                            $("#switch_con_6_24 .right").unbind("click").click(function () {
                                if(con_6_24_page==1){
                                    con_6_24_page = 1;
                                } else {
                                    con_6_24_page = con_6_24_page + 1;
                                }
                                $("#switch_con_6_24 .page").html(con_6_24_page);
                                slide.$Next();
                                return false;
                            });
                        };


                        $(function () {
                            //获取幻灯显示动画类型
                            var $this = $('#slider_smv_con_6_24');
                            var dh = $(document).height();
                            var wh = $(window).height();
                            var ww = $(window).width();
                            var width = 1000;
                            //区分页头、页尾、内容区宽度
                            if ($this.parents(".header").length > 0 ) {
                                width = $this.parents(".header").width();
                            } else if ($this.parents(".footer").length > 0 ){
                                width = $this.parents(".footer").width();
                            } else {
                                width = $this.parents(".smvContainer").width();
                            }

                            if (ww > width) {
                                var left = parseInt((ww - width) * 10 / 2) / 10;
                                $this.css({ 'left': -left, 'width': ww });
                            } else {
                                $this.css({ 'left': 0, 'width': ww });
                            }

                            //解决手机端预览PC端幻灯秀时不通栏问题
                            if (VisitFromMobile()) {
                                $this.css("min-width", width);
                                setTimeout(function () {
                                    var boxleft = (width - 330) / 2;
                                    $this.find(".w-slide-btn-box").css("left", boxleft + "px");
                                }, 300);
                            }
                            $this.children().not(".slideArrow").css({ "width": $this.width() });

                            con_6_24_sliderset3_init();

                            var areaId = $("#smv_con_6_24").attr("tareaid");
                            if(areaId==""){
                                var mainWidth = $("#smv_Main").width();
                                $("#smv_con_6_24 .slideset_AreaC").css({"width":mainWidth+"px","position":"relative","margin":"0 auto"});
                            }else{
                                var controlWidth = $("#smv_con_6_24").width();
                                $("#smv_con_6_24 .slideset_AreaC").css({"width":controlWidth+"px","position":"relative","margin":"0 auto"});
                            }
                            $("#smv_con_6_24").attr("selectArea", "Area1");

                            var arrowHeight = $('#slider_smv_con_6_24 .w-slide-arrowl').eq(-1).outerHeight();
                            var arrowTop = (18 - arrowHeight) / 2;
                            $('#slider_smv_con_6_24 .w-slide-arrowl').eq(-1).css('top', arrowTop);
                            $('#slider_smv_con_6_24 .w-slide-arrowr').eq(-1).css('top', arrowTop);
                        });
                    </script>
                </div></div><div id="smv_con_15_41" ctype="banner"  class="esmartMargin smartAbs " cpid="40118" cstyle="Style1" ccolor="Item0" areaId="" isContainer="True" pvid="" tareaId=""  re-direction="y" daxis="Y" isdeletable="True" style="height: 561px; width: 100%; left: 0px; top: 284px;z-index:11;"><div class="yibuFrameContent con_15_41  banner_Style1  " style="overflow:visible;;" ><div class="fullcolumn-inner smAreaC" id="smc_Area0" cid="con_15_41">
                    <div id="smv_con_16_46" ctype="text"  class="esmartMargin smartAbs " cpid="40118" cstyle="Style1" ccolor="Item0" areaId="Area0" isContainer="False" pvid="con_15_41" tareaId=""  re-direction="all" daxis="All" isdeletable="True" style="height: 49px; width: 256px; left: 355px; top: 9px;z-index:2;"><div class="yibuFrameContent con_16_46  text_Style1  " style="overflow:hidden;;" ><div id='txt_con_16_46' style="height: 100%;">
                        <div class="editableContent" id="txtc_con_16_46" style="height: 100%; word-wrap:break-word;">
                            <p><span style="color:#ffffff"><span style="font-size:30px">逸信国际交易系统</span></span></p>

                        </div>
                    </div>
                    </div></div><div id="smv_con_17_1" ctype="text"  class="esmartMargin smartAbs " cpid="40118" cstyle="Style1" ccolor="Item1" areaId="Area0" isContainer="False" pvid="con_15_41" tareaId=""  re-direction="all" daxis="All" isdeletable="True" style="height: 29px; width: 1118px; left: -61px; top: 49px;z-index:3;"><div class="yibuFrameContent con_17_1  text_Style1  " style="overflow:hidden;;" ><div id='txt_con_17_1' style="height: 100%;">
                    <div class="editableContent" id="txtc_con_17_1" style="height: 100%; word-wrap:break-word;">
                        <p><span style="font-size:14px"><span style="color:#ffffff">逸信国际自主研发的智能化操盘软件， 下单速度极其快捷， 专为华人设计的使用界面， 清晰简约，高端大气。 操作易上手，分析功能强大。 科技助力现代金融，点燃财富梦想。</span></span></p>

                    </div>
                </div>
                </div></div><div id="smv_con_19_2" ctype="button"  class="esmartMargin smartAbs " cpid="40118" cstyle="Style1" ccolor="Item3" areaId="Area0" isContainer="False" pvid="con_15_41" tareaId=""  re-direction="all" daxis="All" isdeletable="True" style="height: 38px; width: 263px; left: 108px; top: 104px;z-index:5;"><div class="yibuFrameContent con_19_2  button_Style1  " style="overflow:visible;;" ><a target="_self" href="http://download.lanyee.net:4001/APP/2020合誉/逸信国际行情交易终端.zip" class="w-button f-ellipsis" style="width: 261px; height: 36px; line-height: 36px;">
    <span class="w-button-position">
        <em class="w-button-text f-ellipsis">
            <i class="mw-iconfont w-button-icon w-icon-hide"></i>☟点击下载逸信国际（实盘）交易系统
        </em>
    </span>
                </a>
                    <script type="text/javascript">
                        $(function () {
                        });
                    </script>
                </div></div><div id="smv_con_20_43" ctype="button"  class="esmartMargin smartAbs " cpid="40118" cstyle="Style1" ccolor="Item3" areaId="Area0" isContainer="False" pvid="con_15_41" tareaId=""  re-direction="all" daxis="All" isdeletable="True" style="height: 38px; width: 265px; left: 417px; top: 105px;z-index:6;"><div class="yibuFrameContent con_20_43  button_Style1  " style="overflow:visible;;" ><a target="_self" href="http://download.lanyee.net:4001/APP/1001逸信公测/逸信行情交易系统(试用).zip" class="w-button f-ellipsis" style="width: 263px; height: 36px; line-height: 36px;">
    <span class="w-button-position">
        <em class="w-button-text f-ellipsis">
            <i class="mw-iconfont w-button-icon w-icon-hide"></i>☟点击下载逸信国际（模拟）交易系统
        </em>
    </span>
                </a>
                    <script type="text/javascript">
                        $(function () {
                        });
                    </script>
                </div></div><div id="smv_con_21_56" ctype="text"  class="esmartMargin smartAbs " cpid="40118" cstyle="Style1" ccolor="Item0" areaId="Area0" isContainer="False" pvid="con_15_41" tareaId=""  re-direction="all" daxis="All" isdeletable="True" style="height: 45px; width: 261px; left: 350px; top: 173px;z-index:7;"><div class="yibuFrameContent con_21_56  text_Style1  " style="overflow:hidden;;" ><div id='txt_con_21_56' style="height: 100%;">
                    <div class="editableContent" id="txtc_con_21_56" style="height: 100%; word-wrap:break-word;">
                        <p><span style="color:#ffffff"><span style="font-size:24px">逸信手機APP交易終端</span></span></p>

                    </div>
                </div>
                </div></div><div id="smv_con_22_55" ctype="button"  class="esmartMargin smartAbs " cpid="40118" cstyle="Style1" ccolor="Item3" areaId="Area0" isContainer="False" pvid="con_15_41" tareaId=""  re-direction="all" daxis="All" isdeletable="True" style="height: 38px; width: 135px; left: 731px; top: 106px;z-index:8;"><div class="yibuFrameContent con_22_55  button_Style1  " style="overflow:visible;;" ><a target="_self" href="http://download.lanyee.net:4001/APP/2020合誉/逸信国际风控员终端.zip" class="w-button f-ellipsis" style="width: 133px; height: 36px; line-height: 36px;">
    <span class="w-button-position">
        <em class="w-button-text f-ellipsis">
            <i class="mw-iconfont w-button-icon w-icon-hide"></i>風控员終端
        </em>
    </span>
                </a>
                    <script type="text/javascript">
                        $(function () {
                        });
                    </script>
                </div></div><div id="smv_con_23_0" ctype="image"  class="esmartMargin smartAbs " cpid="40118" cstyle="Style1" ccolor="Item0" areaId="Area0" isContainer="False" pvid="con_15_41" tareaId=""  re-direction="all" daxis="All" isdeletable="True" style="height: 172px; width: 180px; left: 151px; top: 232px;z-index:9;"><div class="yibuFrameContent con_23_0  image_Style1  " style="overflow:visible;;" >
                    <div class="w-image-box" data-fillType="2" id="div_con_23_0">
                        <a target="_self" href="">
                            <img src="__static__/img/532559.png" alt="微信图片_20171219115532" title="微信图片_20171219115532" id="img_smv_con_23_0" style="width: 180px; height:172px;">
                        </a>
                    </div>

                    <script type="text/javascript">
                        $(function () {
                            InitImageSmv("con_23_0", "180", "172", "2");
                        });
                    </script>

                </div></div><div id="smv_con_24_31" ctype="image"  class="esmartMargin smartAbs " cpid="40118" cstyle="Style1" ccolor="Item0" areaId="Area0" isContainer="False" pvid="con_15_41" tareaId=""  re-direction="all" daxis="All" isdeletable="True" style="height: 170px; width: 175px; left: 611px; top: 227px;z-index:10;"><div class="yibuFrameContent con_24_31  image_Style1  " style="overflow:visible;;" >
                    <div class="w-image-box" data-fillType="2" id="div_con_24_31">
                        <a target="_self" href="">
                            <img src="__static__/img/532590.png" alt="微信图片_20171219115536" title="微信图片_20171219115536" id="img_smv_con_24_31" style="width: 175px; height:170px;">
                        </a>
                    </div>

                    <script type="text/javascript">
                        $(function () {
                            InitImageSmv("con_24_31", "175", "170", "2");
                        });
                    </script>

                </div></div><div id="smv_con_25_10" ctype="text"  class="esmartMargin smartAbs " cpid="40118" cstyle="Style1" ccolor="Item1" areaId="Area0" isContainer="False" pvid="con_15_41" tareaId=""  re-direction="all" daxis="All" isdeletable="True" style="height: 112px; width: 360px; left: 59px; top: 418px;z-index:11;"><div class="yibuFrameContent con_25_10  text_Style1  " style="overflow:hidden;;" ><div id='txt_con_25_10' style="height: 100%;">
                    <div class="editableContent" id="txtc_con_25_10" style="height: 100%; word-wrap:break-word;">
                        <p><span style="font-size:16px"><span style="line-height:1.5"><span style="color:#ffffff">iOS版逸信交易軟體可以到蘋果APP Store搜索&ldquo;逸信&rdquo;下載iOS版的逸信交易APP軟體，使用帳號密碼登錄即可進行行情查詢、入金和下單交易。</span></span></span></p>

                    </div>
                </div>
                </div></div><div id="smv_con_26_55" ctype="line"  class="esmartMargin smartAbs " cpid="40118" cstyle="Style2" ccolor="Item3" areaId="Area0" isContainer="False" pvid="con_15_41" tareaId=""  re-direction="y" daxis="All" isdeletable="True" style="height: 207px; width: 20px; left: 457px; top: 214px;z-index:12;"><div class="yibuFrameContent con_26_55  line_Style2  " style="overflow:visible;;" ><!-- w-line -->
                    <div style="position:relative; width:100%">
                        <div class="w-line" style="position:absolute;left:50%;" linetype="vertical"></div>
                    </div>
                </div></div><div id="smv_con_27_13" ctype="text"  class="esmartMargin smartAbs " cpid="40118" cstyle="Style1" ccolor="Item1" areaId="Area0" isContainer="False" pvid="con_15_41" tareaId=""  re-direction="all" daxis="All" isdeletable="True" style="height: 46px; width: 360px; left: 533px; top: 414px;z-index:13;"><div class="yibuFrameContent con_27_13  text_Style1  " style="overflow:hidden;;" ><div id='txt_con_27_13' style="height: 100%;">
                    <div class="editableContent" id="txtc_con_27_13" style="height: 100%; word-wrap:break-word;">
                        <p><span style="font-size:16px"><span style="line-height:1.5"><span style="color:#ffffff">Android版APP軟體可以直接點擊這裡進行下載</span></span></span></p>

                    </div>
                </div>
                </div></div><div id="smv_con_28_33" ctype="button"  class="esmartMargin smartAbs " cpid="40118" cstyle="Style1" ccolor="Item3" areaId="Area0" isContainer="False" pvid="con_15_41" tareaId=""  re-direction="all" daxis="All" isdeletable="True" style="height: 38px; width: 135px; left: 633px; top: 457px;z-index:14;"><div class="yibuFrameContent con_28_33  button_Style1  " style="overflow:visible;;" ><a target="_self" href="http://www.lanyee.hk/outer/detailsy-mzqhbc.html#" class="w-button f-ellipsis" style="width: 133px; height: 36px; line-height: 36px;">
    <span class="w-button-position">
        <em class="w-button-text f-ellipsis">
            <i class="mw-iconfont w-button-icon w-icon-hide"></i>點擊下載
        </em>
    </span>
                </a>
                    <script type="text/javascript">
                        $(function () {
                        });
                    </script>
                </div></div></div>
                    <div id="bannerWrap_con_15_41" class="fullcolumn-outer" style="position: absolute; top: 0; bottom: 0;">
                    </div>

                    <script type="text/javascript">

                        $(function () {
                            var resize = function () {
                                $("#smv_con_15_41 >.yibuFrameContent>.fullcolumn-inner").width($("#smv_con_15_41").parent().width());
                                $('#bannerWrap_con_15_41').fullScreen(function (t) {
                                    if (VisitFromMobile()) {
                                        t.css("min-width", t.parent().width())
                                    }
                                });
                            }
                            $(window).resize(function (e) {
                                if (e.target == this) {
                                    resize();
                                }
                            });
                            resize();
                        });
                    </script>
                </div></div><div id="smv_con_29_1" ctype="image"  class="esmartMargin smartAbs " cpid="40118" cstyle="Style1" ccolor="Item0" areaId="" isContainer="False" pvid="" tareaId=""  re-direction="all" daxis="All" isdeletable="True" style="height: 470px; width: 834px; left: 72px; top: 879px;z-index:15;"><div class="yibuFrameContent con_29_1  image_Style1  " style="overflow:visible;;" >
                    <div class="w-image-box" data-fillType="2" id="div_con_29_1">
                        <a target="_self" href="">
                            <img src="__static__/img/532983.png" alt="xe" title="xe" id="img_smv_con_29_1" style="width: 834px; height:470px;">
                        </a>
                    </div>

                    <script type="text/javascript">
                        $(function () {
                            InitImageSmv("con_29_1", "834", "470", "2");
                        });
                    </script>

                </div></div></div></div><input type='hidden' name='__RequestVerificationToken' id='token__RequestVerificationToken' value='JozMIMyQ3KVZLDjDlK9S0kfBlebHTeppkVL3Rj0q_LREvQsSMlyRV0aNPgK7PuKXUFnHi1YFbaZV_ARQSlVoMkEDuE-tPgq2HtWqZm8x5901' />
            </div>
        </div>
    </div>
    <div style="background-color: transparent; background-image: none; background-repeat: no-repeat;background-position:0 0; background:-moz-linear-gradient(top, none, none);background:-webkit-gradient(linear, left top, left bottom, from(none), to(none));background:-o-linear-gradient(top, none, none);background:-ms-linear-gradient(top, none, none);background:linear-gradient(top, none, none);;
         position: relative; width: 100%;min-width:1000px;background-size: auto;" bgScroll="none">
        <div class=" footer" cpid="4780" id="smv_Area3" style="width: 1000px; height: 373px; position: relative; margin: 0 auto;">
    <div id="smv_tem_44_31" ctype="banner" class="esmartMargin smartAbs " cpid="4780" cstyle="Style1" ccolor="Item0" areaid="Area3" iscontainer="True" pvid="" tareaid="Area3" re-direction="y" daxis="Y" isdeletable="True" style="height: 311px; width: 100%; left: 0px; top: 59px;z-index:0;"><div class="yibuFrameContent tem_44_31  banner_Style1  " style="overflow:visible;;"><div class="fullcolumn-inner smAreaC" id="smc_Area0" cid="tem_44_31" style="width: 1000px;">
        <div id="smv_tem_53_29" ctype="text" class="esmartMargin smartAbs " cpid="4780" cstyle="Style1" ccolor="Item3" areaid="Area0" iscontainer="False" pvid="tem_44_31" tareaid="Area3" re-direction="all" daxis="All" isdeletable="True" style="height: 48px; width: 1095px; left: 6px; top: 20px;z-index:14;"><div class="yibuFrameContent tem_53_29  text_Style1  " style="overflow:hidden;;"><div id="txt_tem_53_29" style="height: 100%;">
            <div class="editableContent" id="txtc_tem_53_29" style="height: 100%; word-wrap:break-word;">
                <p style="text-align:center">
                    <span style="font-size:16px">
                        <span style="font-family:&quot;Microsoft YaHei&quot;">
                        <a href="/"><span style="color:#7f8c8d">首页</span></a>
                        <span style="color:#7f8c8d"> &nbsp; &nbsp; &nbsp;</span>
                        <a href="<?php echo url('home/index/company_info'); ?>"><span style="color:#7f8c8d">公司介绍</span></a>
                        <span style="color:#7f8c8d"> &nbsp; &nbsp; &nbsp;</span>
                        <a href="<?php echo url('home/index/product'); ?>"><span style="color:#7f8c8d">产品服务</span></a>
                        <span style="color:#7f8c8d">&nbsp; &nbsp; &nbsp;</span>
                        <a href="<?php echo url('home/index/download'); ?>"><span style="color:#7f8c8d">软件下载</span></a>
                        <span style="color:#7f8c8d">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
                        <a href="<?php echo url('home/index/about'); ?>"><span style="color:#7f8c8d">联系我们 </span></a>
                        <span style="color:#7f8c8d">&nbsp; &nbsp;</span><span style="color:#2980b9">&nbsp;</span>
                    </span>
                    </span>
                </p>

            </div>
        </div>
        </div></div><div id="smv_tem_42_15" ctype="line" class="esmartMargin smartAbs " cpid="4780" cstyle="Style1" ccolor="Item0" areaid="Area0" iscontainer="False" pvid="tem_44_31" tareaid="Area3" re-direction="x" daxis="All" isdeletable="True" style="height: 20px; width: 1396px; left: -196px; top: 52px;z-index:12;"><div class="yibuFrameContent tem_42_15  line_Style1  " style="overflow:visible;;"><!-- w-line -->
        <div style="position:relative; height:100%">
            <div class="w-line" style="position:absolute;top:50%;" linetype="horizontal"></div>
        </div>
    </div></div><div id="smv_tem_43_51" ctype="text" class="esmartMargin smartAbs " cpid="4780" cstyle="Style1" ccolor="Item1" areaid="Area0" iscontainer="False" pvid="tem_44_31" tareaid="Area3" re-direction="all" daxis="All" isdeletable="True" style="height: 110px; width: 1095px; left: -47px; top: 58px;z-index:13;"><div class="yibuFrameContent tem_43_51  text_Style1  " style="overflow:hidden;;"><div id="txt_tem_43_51" style="height: 100%;">
        <div class="editableContent" id="txtc_tem_43_51" style="height: 100%; word-wrap:break-word;">
            <p style="text-align:center">&nbsp;</p>

            <p style="text-align:center"><span style="line-height:1.5"><span style="color:#999999">&nbsp; &nbsp; &nbsp;&nbsp;<span style="font-size:14px">免责声明</span></span></span></p>

            <p style="text-align:center">&nbsp;</p>

            <p style="text-align:center"><span style="line-height:1.5"><span style="color:#999999"><span style="font-size:14px">逸信国际平台软件方，仅对外提供官方信息发布和平台技术支持服务。在此郑重提醒：客户须妥善保管交易账户和密码，切勿交付他人管理或交易；客户应知悉任何机构或个人针对交易的任何获利保证或不发生亏损的承诺均为虚假承诺；逸信国际不对外提供代客操盘，客户应自行作出具体交易决定，并对其交易行为负责。如因以上行为引起的责任和经济损失，与交易平台无关。</span></span></span></p>

            <p style="text-align:center">&nbsp;</p>

            <p style="text-align:center">&nbsp;</p>

            <p style="text-align:center">&nbsp;</p>

        </div>
    </div>
    </div></div><div id="smv_tem_55_17" ctype="text" class="esmartMargin smartAbs " cpid="4780" cstyle="Style1" ccolor="Item4" areaid="Area0" iscontainer="False" pvid="tem_44_31" tareaid="Area3" re-direction="all" daxis="All" isdeletable="True" style="height: 32px; width: 507px; left: 250px; top: 261px;z-index:15;"><div class="yibuFrameContent tem_55_17  text_Style1  " style="overflow:hidden;;"><div id="txt_tem_55_17" style="height: 100%;">
        <div class="editableContent" id="txtc_tem_55_17" style="height: 100%; word-wrap:break-word;">
            <p><span style="font-size:14px"><span style="color:#95a5a6">版权所有：逸信国际 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </span><a href="//www.miitbeian.gov.cn"><span style="color:#95a5a6">豫ICP备：17046234号</span></a></span></p>

        </div>
    </div>
    </div></div><div id="smv_tem_56_39" ctype="image" class="esmartMargin smartAbs " cpid="4780" cstyle="Style1" ccolor="Item0" areaid="Area0" iscontainer="False" pvid="tem_44_31" tareaid="Area3" re-direction="all" daxis="All" isdeletable="True" style="height: 48px; width: 131px; left: 276px; top: 188px;z-index:16;"><div class="yibuFrameContent tem_56_39  image_Style1  " style="overflow:visible;;">
        <div class="w-image-box" data-filltype="2" id="div_tem_56_39" style="width: 131px; height: 48px;">
            <a target="_self" style="width: 100%; height: 100%;">
                <img src="/public/static/home/img/514505.png" alt="f_img1" title="f_img1" id="img_smv_tem_56_39" style="width: 131px; height:48px;">
            </a>
        </div>

        <script type="text/javascript">
            $(function () {
                InitImageSmv("tem_56_39", "131", "48", "2");
            });
        </script>

    </div></div><div id="smv_tem_57_21" ctype="image" class="esmartMargin smartAbs " cpid="4780" cstyle="Style1" ccolor="Item0" areaid="Area0" iscontainer="False" pvid="tem_44_31" tareaid="Area3" re-direction="all" daxis="All" isdeletable="True" style="height: 47px; width: 130px; left: 449px; top: 187px;z-index:17;"><div class="yibuFrameContent tem_57_21  image_Style1  " style="overflow:visible;;">
        <div class="w-image-box" data-filltype="2" id="div_tem_57_21" style="width: 130px; height: 47px;">
            <a target="_self" style="width: 100%; height: 100%;">
                <img src="/public/static/home/img/514514.png" alt="f_img2" title="f_img2" id="img_smv_tem_57_21" style="width: 130px; height:47px;">
            </a>
        </div>

        <script type="text/javascript">
            $(function () {
                InitImageSmv("tem_57_21", "130", "47", "2");
            });
        </script>

    </div></div><div id="smv_tem_58_39" ctype="image" class="esmartMargin smartAbs " cpid="4780" cstyle="Style1" ccolor="Item0" areaid="Area0" iscontainer="False" pvid="tem_44_31" tareaid="Area3" re-direction="all" daxis="All" isdeletable="True" style="height: 48px; width: 129px; left: 618px; top: 186px;z-index:18;"><div class="yibuFrameContent tem_58_39  image_Style1  " style="overflow:visible;;">
        <div class="w-image-box" data-filltype="2" id="div_tem_58_39" style="width: 129px; height: 48px;">
            <a target="_self" style="width: 100%; height: 100%;">
                <img src="/public/static/home/img/514522.png" alt="f_img3" title="f_img3" id="img_smv_tem_58_39" style="width: 129px; height:48px;">
            </a>
        </div>

        <script type="text/javascript">
            $(function () {
                InitImageSmv("tem_58_39", "129", "48", "2");
            });
        </script>

    </div></div></div>
        <div id="bannerWrap_tem_44_31" class="fullcolumn-outer" style="position: absolute; top: 0px; bottom: 0px; left: -132.5px; width: 1265px;">
        </div>

        <script type="text/javascript">

            $(function () {
                var resize = function () {
                    $("#smv_tem_44_31 >.yibuFrameContent>.fullcolumn-inner").width($("#smv_tem_44_31").parent().width());
                    $('#bannerWrap_tem_44_31').fullScreen(function (t) {
                        if (VisitFromMobile()) {
                            t.css("min-width", t.parent().width())
                        }
                    });
                }
                $(window).resize(function (e) {
                    if (e.target == this) {
                        resize();
                    }
                });
                resize();
            });
        </script>
    </div></div>
</div>
    </div>
</div>

<script src="//nwzimg.wezhan.cn/static/lzparallax/1.0.0/lz-parallax.min.js" type="text/javascript"></script>        <script type="text/javascript">
    $(function () {
        jsmart.autoContainer = 0;
        jsmart.autoComputeCallback = function () {
            if (jsmart.autoContainer) {
                clearTimeout(jsmart.autoContainer);
                jsmart.autoContainer = 0;
            }
            jsmart.autoContainer = setTimeout(function () {
                if (window.refreshBgScroll) {
                    window.refreshBgScroll();
                }
            }, 50);
        }
        $("div[bgscroll]").each(function () {
            var bgscroll = $(this).attr("bgscroll");
            $(this).lzparallax({ effect: bgscroll, autoPosition: false, clone: true });
        });
    });
    window.refreshBgScroll = function () {
        $("div[bgscroll]").each(function () {
            var bgscroll = $(this).attr("bgscroll");
            var bgclear = $(this).attr("bgclear");
            $(this).removeAttr("bgclear");
            $(this).lzparallax("refresh", bgscroll, bgclear);
        });
    }
</script>


<script type="text/javascript">
    $(function() {
        $("img.lazyload").lazyload({ skip_invisible: false, effect: "fadeIn", failure_limit: 15, threshold: 100 });
        $('.animated').smanimate();
        $('.smartRecpt').smrecompute();
        setCurrentPageTitle('软件下载', 2);
        xwezhan.initWz();

        if ($("#txtDeviceSwitchEnabled").val() == "hide") {
            $(".m-deviceSwitch").css("display", "none");
        }
    });
</script>
<div id="systemDialogLayer" style="position:relative;z-index:100000"></div>
</body>
</html>
