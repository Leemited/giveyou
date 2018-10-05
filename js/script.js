$(function(){
	$(".mobile_menu_btn").click(function(){
		$(".mobile_menu").fadeIn(300,function(){
			$(".mobile_menu").addClass("active");
		});
	});
	$(".mobile_menu > span").click(function(){
		$(".mobile_menu").fadeOut(300,function(){
			$(".mobile_menu").removeClass("active");
		});
	
	});
	$(window).scroll(function(){
		$(".sub_call_pop").stop();
		var scroll=$(document).scrollTop();
		var w_width=$(window).width();
		s_top=scroll-108;
		if(scroll<138){
			s_top=138;
		}
		if(w_width>1480){
			$(".sub_call_pop").animate( { "top": s_top + "px" },1000);
		}else{
			if(scroll>128)
				$(".sub_call_pop").css( { "top":"10px" });
			else
				$(".sub_call_pop").css( { "top":"138px" });
		}
	});
	$(".file01 input").change(function(){
		var p=$(this).parent();
		var t_val=$(this).val();
		if(t_val){
			p.find("span").html(t_val);
		}else{
			p.find("span").html("파일을 선택해주세요");
		}
	});
});


function number_only(t){
	t.value = t.value.replace(/[^0-9]/g, '');
}

var hash_back="";
$(window).hashchange( function(){
	console.log( location.hash + " / " +hash_back );
	if(location.hash=="" && hash_back){
		if(hash_back=="#msg"){
			msg_close();
		}
		if(hash_back=="#modal"){
			modal_close();
		}
		if(hash_back=="#small_modal"){
			modal_close();
			small_modal_close();
		}
		if(hash_back=="#menu"){
			$('#mobile_menu').removeClass('active');
			$("html").css("overflow","auto");
		}
	}else if(location.hash=="" && hash_back == ""){
		modal_close();
		console.log( location.hash + " / " +hash_back );
	}else if(location.hash=="#modal" && hash_back=="#small_modal"){
		small_modal_close();
	}
});
function modal_active(){
	document.location.hash="#modal";
	hash_back="#modal";
	$(".modal").addClass('active');
	var div_height=$(".modal > div").height();
	var d_height=$(window).height();
	if(div_height>d_height){
		$(".modal > div").css("height",d_height+"px");
	}else{
		var div_top=(d_height-div_height)/2;
		$(".modal > div").animate({"top":div_top+"px"},500);
	}
	$("html").css("overflow","hidden");
}
function msg_active(){
	document.location.hash="#msg";
	hash_back="#msg";
	$(".msg").addClass('active');
	var div_height=$(".msg > div").height();
	var d_height=$(window).height();
	if(div_height>d_height){
		$(".msg > div").css("height",d_height+"px");
	}else{
		var div_top = (d_height/2)-(div_height/2);
		$(".msg > div").animate({"top":div_top+"px"},500);
	}
	$("html").css("overflow","hidden");
}
function modal_close(){
	$(".modal").html("");
	$('.modal').removeClass('active');
	if(location.hash=="#modal" && hash_back=="#modal"){
		hash_back="";
		window.history.back();
	}
	$("html").css("overflow","auto");
}
function msg_close(){
	$(".msg").html("");
	$('.msg').removeClass('active');
	if(location.hash=="#msg" && hash_back=="#msg"){
		hash_back="";
		 window.history.back();
	}
	$("html").css("overflow","auto");
}

function all_close(){
	msg_close();
	small_modal_close();
	modal_close();
	if(location.hash=="#msg" || location.hash=="#small_modal" || location.hash=="#modal"){
		hash_back="";
		history.back();
	}
	$("html").css("overflow","auto");
}

var fromHistoryBack = false;
var myHistory;
try {
    myHistory = JSON.parse(sessionStorage.getItem('myHistory'));
} catch (e) {};
if (myHistory) {
    if (myHistory[myHistory.length-1].href == window.location.href 
            && myHistory[myHistory.length-1].referrer == document.referrer) {
        //alert('새로고침 되었습니다.');
    } else {
        if (myHistory.length > 1) {
            if (myHistory[myHistory.length-2].href == window.location.href 
                    && myHistory[myHistory.length-2].referrer == document.referrer) {
                fromHistoryBack = true;
                myHistory.pop();
                sessionStorage.setItem('myHistory', JSON.stringify(myHistory));
            }
        }
        if (myHistory.length > 10 && !fromHistoryBack) {
            myHistory.shift();
            sessionStorage.setItem('myHistory', JSON.stringify(myHistory));
        }
        if (!fromHistoryBack) {
            myHistory.push({ 
                href: window.location.href,
                referrer: document.referrer
            });
            sessionStorage.setItem('myHistory', JSON.stringify(myHistory));
        }
    }
} else {
    var newHistory = [{ 
        href: window.location.href, 
        referrer: document.referrer
    }];
    sessionStorage.setItem('myHistory', JSON.stringify(newHistory));
}
