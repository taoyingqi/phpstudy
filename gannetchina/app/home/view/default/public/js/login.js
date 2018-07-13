$(function(){
	
	(function(){
	$(".nav li").click(function(){
	$(".nav li").siblings('li').removeClass('active');
	$(this).addClass('active');
	if($("#on").attr("class")=="active"){
		$(".content1").hide();
		$(".content2").show();
	}
		else{
			$(".content1").show();
		$(".content2").hide();
		}
		
		
})
	
		
	$(".selector").click(function(){
		$(".droplist").toggle();
	})
	
	
	
	})()
	
});

//




$(function(){
	
	(function(){
		
	$(".title-right").click(function(){
	   if($(".email").attr("placeholder")=="用户名/邮箱"){
		   $(".email").attr("class","phone");
		   $(".phone").attr("placeholder","手机");
           $(".s-nation").show();
		   $(".title-left").text("手机");
		   $(".title-right").text("换成邮箱");
		   $(".email2").attr("class","phone2");
		    $(".phone2").attr("placeholder","手机");
		}
	else{
		if($(".phone").attr("placeholder")=="手机"){
			$(".phone").attr("class","email");
			$(".email").attr("placeholder","用户名/邮箱");
			$(".s-nation").hide();
			$(".title-left").text("邮箱");
		    $(".title-right").text("换成手机");
			$(".phone2").attr("class","email2");
			$(".email2").attr("placeholder","邮箱");
		}
		
		
	}

	})
	
	
	
		
	})()
	
})
















