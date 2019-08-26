//滚动栏目一
TouchSlide({ 
	slideCell:"#tab-news",
	titCell:".tab-news-hd li",
	mainCell:".tab-news-con",
	effect:"leftLoop"
}); 

//滚动栏目二
TouchSlide({ 
	slideCell:"#tab-size",
	titCell:".tab-size-hd li",
	mainCell:".tab-size-con",
	effect:"leftLoop"
}); 

//滚动栏目三
TouchSlide({ 
	slideCell:"#tab-di",
	titCell:".tab-di-hd li",
	mainCell:".tab-di-con",
	effect:"leftLoop"
}); 


//滚动栏目
TouchSlide({ 
	slideCell:"#tab-xinqing",
	titCell:".tab-xinqing-hd li",
	mainCell:".tab-xinqing-con active",
	effect:"leftLoop"
}); 


//栏目导航菜单
function myNav(){
	if($("#nav").hasClass("openNav")){
		$("#nav-over").css("display","none");
		$("#nav").removeClass("openNav");
		$("#warmp").removeClass("openMenu");
	}else{
		$("#nav-over").css("display","block");
		$("#nav").addClass("openNav");
		$("#warmp").addClass("openMenu");
				
		$("#scrollerBox").height($(window).height() - $("#nav h3").outerHeight());
		//new IScroll('#scrollerBox',{preventDefault:false});		
		$(window).resize(function(){
			$("#scrollerBox").height($(window).height() - $("#nav h3").outerHeight());
		})
	}	
}
$("#nav-over").bind("click",function(){
	$("#nav-over").css("display","none");
	$("#warmp").removeClass("openMenu");
	$("#nav").removeClass("openNav");
	$("#warmp").removeClass("openMenu")	
})
//$("#nav-over").bind("touchmove touch",function(e){e.preventDefault()},false);//阴止默认事件
$(".navHome").bind("click",myNav);

//返回顶部
$("body").append('<div class="gotop" id="gotop"><div>');
$(window).scroll(function(){$(document).scrollTop()>300?$("#gotop").fadeIn():$("#gotop").fadeOut()});
$("#gotop").click(function(){$("html,body").animate({scrollTop:0},300)})