$(document).ready(function() {
	//update();
	dateAndTime();
	iconUpdate();
	setInterval(function(){dateAndTime()},1000);
	//setInterval(function(){update();},30000);
	setInterval(function(){iconUpdate();},30000);
	$("#TRESC").on("click",".btn",function(e){
		$("#PopupNewValue").text($(e.target).text());
		$("#PopupNewValue").val("");
		$("#PopupLog").text("");
		$(".submit").attr("disabled","disabled");
		$("#popup").show();
		$("#PopupNewValue").focus();
		$("#popupContent").attr("tid",$(this).attr("id"));
	});
	$(".cancel").click(function(){
		$("#popup").hide();
	});
	$("input").click(function(){
		var id = $(this).attr("id");
		if(id=="cbIMspusty"){
			$(".infoItem:not(.event1, .event2, .date)").hide();
		}else $(".infoItem").show();
	});
	$(".submit").click(function(){
		$.ajax({
			 type: "POST",
			 url: "set.php",
			 data: { newValue: $("#PopupNewValue").val(), tid: $("#popupContent").attr("tid"), pass: $("#PopupPass").val() },
			 success:function(data){
				if(data=='Błąd'){
					$("#popupLog").html("Niestety błędne hasło");
				}else{
					$("#popupLog").html("Nowa nastawa to  :"+data);
					$("#"+$("#popupContent").attr("tid")).text(data);
					hideAfter("#popup",3000);
				 }
			 }
		});
	});
	$("#PopupNewValue").keyup(function(){
		var val = $(this).val();
		$.isNumeric(val) && val>0 && val < 1000?$(".submit").removeAttr("disabled"):$(".submit").attr("disabled","disabled");
	});
	
});
function update(){
	$("#zbiorniki").load("zbiorniki.php");
	$(".infoContent").load("event.php",function(){$("input:checked").click();});
}
function hideAfter( obj, time){
	setTimeout(function(){$(obj).hide();},time);
}
function dateAndTime(){
	var now = new Date(),
	h = now.getHours(),
	m = now.getMinutes(),
	s = now.getSeconds(),
	wd = now.getDay(),
	d = now.getDate(),
	mth = now.getMonth();
	$("#time").html("<span class=\"\">"+zero(h)+"</span>:<span class=\"\">"+zero(m)+"</span>:<span class=\"\">"+zero(s)+"</span>");
	$("#time span").eq(2).css("display","none").fadeIn(500);
	if(s==0)$("#time span").eq(1).css("display","none").fadeIn(500);
	if(m==0)$("#time span").eq(0).css("display","none").fadeIn(500);
	if(s==0&&m==0&&h==0 || $("#dateDay").html()=="" || $("#dateDate").html()==""){
	$("#dateDay").html(weekDay(wd));
	$("#dateDate").html(zero(d)+" "+months(mth));
	}
}
function iconUpdate(){
	$.getJSON("iconUpdate.php",function(json){
		$("#plcState img").attr("src","img/monitor"+json.plcState+".png");
	});
}
function countdown(){
	var time = new Date();
	var sylwester = new Date(2012,11,31,20);
	var rest = sylwester.getTime()/1000-time.getTime()/1000;
	var ret = "";
	var temp = Math.floor(rest/86400);
	ret=ret+temp+" | ";
	rest = Math.floor(rest - temp*86400);
	temp = Math.floor(rest/3600);
	ret=ret+zero(temp)+" | ";
	rest = Math.floor(rest - temp*3600);
	temp = Math.floor(rest/60);
	ret=ret+zero(temp)+" | ";
	rest = Math.floor(rest - temp*60);
	return ret=ret+zero(rest);
}
function zero(number){
	return number<10?'0'+number:number;
}
function weekDay(day){
	switch(day){
	case 0: return "niedziela";break;
	case 1: return "poniedziałek";break;
	case 2: return "wtorek";break;
	case 3: return "środa";break;
	case 4: return "czwartek";break;
	case 5: return "piątek";break;
	case 6: return "sobota";break;
	}
}
function months(month){
	switch(month){
	case 0: return "stycznia";break;
	case 1: return "lutego";break;
	case 2: return "marca";break;
	case 3: return "kwietnia";break;
	case 4: return "maja";break;
	case 5: return "czerwca";break;
	case 6: return "lipca";break;
	case 7: return "sierpnia";break;
	case 8: return "września";break;
	case 9: return "października";break;
	case 10: return "listopada";break;
	case 11: return "grudnia";break;
	}
}