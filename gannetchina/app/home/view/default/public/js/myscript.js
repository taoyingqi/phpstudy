if(GetUrl("ad_source")!="")
{
	setCookie("ad_source",GetUrl("ad_source"),1);
}

if(GetUrl("utm_source")!=""||GetUrl("utm_medium")!=""||GetUrl("utm_term")!=""||GetUrl("utm_content")!=""||GetUrl("utm_campaign")!="")
{
	setCookie("utm_source",GetUrl("utm_source"),0);
	setCookie("utm_medium",GetUrl("utm_medium"),0);
	setCookie("utm_term",GetUrl("utm_term"),0);
	setCookie("utm_content",GetUrl("utm_content"),0);
	setCookie("utm_campaign",GetUrl("utm_campaign"),0);
}


jQuery(document).ready(function($){
   $(function() {
		$.datepicker.regional["zh-CN"] = { closeText: "关闭", prevText: "&#x3c;上月", nextText: "下月&#x3e;", currentText: "今天", monthNames: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"], monthNamesShort: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"], dayNames: ["星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六"], dayNamesShort: ["周日", "周一", "周二", "周三", "周四", "周五", "周六"], dayNamesMin: ["日", "一", "二", "三", "四", "五", "六"], weekHeader: "周", dateFormat: "yy-mm-dd", firstDay: 1, isRTL: !1, showMonthAfterYear: !0, yearSuffix: "年" }
		$.datepicker.setDefaults($.datepicker.regional["zh-CN"]);
	});
	if(getCookie("utm_source")!=""||getCookie("utm_medium")!=""||getCookie("utm_term")!=""||getCookie("utm_content")!=""||getCookie("utm_campaign")!="")
	{
		$(".fixed_header .button_purple").attr("href",'https://myaccount.vantagefx.cn/tradingaccounts/registerdemo?utm_source='+getCookie("utm_source")+'&utm_medium='+getCookie("utm_medium")+'&utm_term='+getCookie("utm_term")+'&utm_content='+getCookie("utm_content")+'&utm_campaign='+getCookie("utm_campaign"));
		$("#header .button_purple").attr("href",'https://myaccount.vantagefx.cn/tradingaccounts/registerdemo?utm_source='+getCookie("utm_source")+'&utm_medium='+getCookie("utm_medium")+'&utm_term='+getCookie("utm_term")+'&utm_content='+getCookie("utm_content")+'&utm_campaign='+getCookie("utm_campaign"));
		$(".slider_link .link_trial_demo").attr("href",'https://myaccount.vantagefx.cn/tradingaccounts/registerdemo?utm_source='+getCookie("utm_source")+'&utm_medium='+getCookie("utm_medium")+'&utm_term='+getCookie("utm_term")+'&utm_content='+getCookie("utm_content")+'&utm_campaign='+getCookie("utm_campaign"));
	}
	if(GetUrl("utm_source")!=""||GetUrl("utm_medium")!=""||GetUrl("utm_term")!=""||GetUrl("utm_content")!=""||GetUrl("utm_campaign")!="")
	{
		$(".fixed_header .button_purple").attr("href",'https://myaccount.vantagefx.cn/tradingaccounts/registerdemo?utm_source='+GetUrl("utm_source")+'&utm_medium='+GetUrl("utm_medium")+'&utm_term='+GetUrl("utm_term")+'&utm_content='+GetUrl("utm_content")+'&utm_campaign='+GetUrl("utm_campaign"));
		$("#header .button_purple").attr("href",'https://myaccount.vantagefx.cn/tradingaccounts/registerdemo?utm_source='+GetUrl("utm_source")+'&utm_medium='+GetUrl("utm_medium")+'&utm_term='+GetUrl("utm_term")+'&utm_content='+GetUrl("utm_content")+'&utm_campaign='+GetUrl("utm_campaign"));
		$(".slider_link .link_trial_demo").attr("href",'https://myaccount.vantagefx.cn/tradingaccounts/registerdemo?utm_source='+GetUrl("utm_source")+'&utm_medium='+GetUrl("utm_medium")+'&utm_term='+GetUrl("utm_term")+'&utm_content='+GetUrl("utm_content")+'&utm_campaign='+GetUrl("utm_campaign"));
	}
	$( ".input_time" ).datepicker({changeMonth: true,changeYear: true,dateFormat: 'yy-mm-dd'});
	$(".table_list_title li a").click(function(){
		var thisrel=$(this).attr("rel");
		$(".table_list_title li a").removeClass("active");
		$(this).addClass("active");
		$(".table_list_content_box").hide();
		$("#table_"+thisrel).show();
		return false;
	});
	$(".table_list_title li a").eq(0).click();
	$("#home_slider").bxSlider({auto:true,speed:1000,pause:12000,pager:true,
		onSliderLoad: function() {
			//$(".container_home_slider").css("opacity","1");
		}
	});
	$("#fx_slider").bxSlider({auto:true,speed:1000,pause:12000,pager:true,
		onSliderLoad: function() {
			//$(".container_home_slider").css("opacity","1");
		}
	});
	$(".view_pic").colorbox({rel:'group1',maxWidth:"90%"});
	$(".go_top,.go_top_right_fixed,.mobile_goTop").click(function() {
		 var elementClicked = $(this).attr("href");
		 var destination = $(elementClicked).offset().top;
		 $("html:not(:animated),body:not(:animated)").animate({ scrollTop: destination}, 500 );
		 return false;
	});
	$(".mainnav").superfish();	
	
	$(".search_form_button").click(function(){
		if(!$(".search-wrap").hasClass("active"))
		{
			$(".search-wrap").addClass("active");
			$(".search-wrap").stop().animate({width: 'toggle'});
		}
		return false;
	});
	$(document).click(function(){
		if($(".search-wrap").hasClass("active"))
		{
			$(".search-wrap").removeClass("active");
			$(".search-wrap").stop().animate({width: 'toggle'});
		}
	});
	$('.search-wrap').click(function(event) {
		event.stopPropagation();
	});
	

	$("#partners_list").bxSlider({auto:true,speed:1000,pause:12000,pager:true,controls:false});
	
	$(".icon_menu").click(function(){
	
		  if(!$(".icon_menu").hasClass("current"))
		  {
		   $(".icon_menu").addClass("current");
		   $(".mobile_nav").slideDown("fast");
		  }
		  else
		  { 
		   $(".icon_menu").removeClass("current");
		   $(".mobile_nav").slideUp("fast");
		  }
		  return false;
	  
	 });
	 
	 
	 
	 /**************************************************** Fixed Header ***************************************************/
	 if($(".post_slider li").length>1){
	   $('.post_slider').bxSlider({
		pager: false,nextText: '下一张',prevText: '上一张',adaptiveHeight: true,
	   }); 
	  };
	 
	 
	 
	 
	/**************************************************** Fixed Header ***************************************************/
		function getScrollTop()
		{
		 var scrollTop=0;
		 if(document.documentElement&&document.documentElement.scrollTop)
		 {
		  scrollTop=document.documentElement.scrollTop;
		 }
		 else if(document.body)
		 {
		  scrollTop=document.body.scrollTop;
		 }
		 return scrollTop;
		}
		var logotag=1;
		var toptag=1;
		function Move()
		{
			if(getScrollTop()>152){			
				if(logotag==1)
				{
					jQuery(".fixed_header").stop().animate({top:"0px"},500);	
					logotag=2;
				}
			}
			if(getScrollTop()<200){			
				if(logotag==2)
				{
					jQuery(".fixed_header").stop().animate({top:"-71px"},500);
					logotag=1;
				}
			}
			if(getScrollTop()>400){			
				if(toptag==1)
				{
					jQuery(".go_top_right_fixed").fadeIn(500);
					jQuery(".mobile_goTop").fadeIn(500);
					toptag=2;
				}
			}
			if(getScrollTop()<400){			
				if(toptag==2)
				{
					jQuery(".go_top_right_fixed").fadeOut(500);
					jQuery(".mobile_goTop").fadeOut(500);
					toptag=1;
				}
			}
			setTimeout(function(){Move();},10);
		}	
		Move();		
	/*******************************************************************************************************/
	/*************************notification*************************************/
	 $(".notification_item_title").click(function(){
	  if(!$(this).hasClass("current"))
	  {
		$(this).addClass("current");	
		$(this).parent().find(".text_box").slideDown("fast");
	  }
	  else
	  { 
		$(this).removeClass("current");
		$(this).parent().find(".text_box").slideUp("fast");
		
	  }
	  return false;
	 });
});

function setCookie(name,value,days) {
  if (days) {
    var date = new Date();
    date.setTime(date.getTime()+(days*24*60*60*1000));
    var expires = "; expires="+date.toGMTString();
  }
  else expires = "";
  document.cookie = name+"="+value+expires+"; path=/";
}

function getCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(';');
  for(var i=0;i < ca.length;i++) {
    var c = ca[i];
    while (c.charAt(0)==' ') c = c.substring(1,c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
  }
  return "";
}

function GetUrl(sProp)    
{   
  
    var re = new RegExp("[&,?]"+sProp + "=([^\\&]*)", "i");   
  
    var a = re.exec(document.location.search);   
  
    if (a == null)   
  
        return "";   
  
    return a[1];   
}  