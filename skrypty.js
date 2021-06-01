$(document).ready(function(){
	online();
	setInterval(function(){online();},60000);
	$("body").on("click","#typer_form input",function(e){$(e.target).val("");});
	$("body").on("click",".typer a",function(e){
		e.preventDefault();
		var elem = $(e.target);
		var tf = $("#typer_form");
		$("a.active").removeClass("active");
		elem.addClass("active");
		typ_text = elem.text().split(":");
		if($.isNumeric(typ_text[0])){$("#gosp").val(typ_text[0]);$("#gosc").val(typ_text[1]);}else{$("#gosp").val("");$("#gosc").val("");}
		pos = elem.position();
		tf.is(":visible")?tf.animate({"top":pos.top-10},400):tf.css({top:pos.top-10,left:pos.left-75}).fadeIn();
		$("#gosp").focus();
	});
	$("body").on("click","#typ_usun",function(e){
		$("#typer_form").fadeOut();
		$(".active").removeClass("active");
	});
	$("body").on("click","#typ_typuj",function(e){
		var elem = $(e.target);
		var idm = $(".active").closest("tr").attr("id_m");
		var gosp = $("#gosp").val();
		var gosc = $("#gosc").val();
		var cm = $(".active").attr("href");
		if($.isNumeric(gosp)&& $.isNumeric(gosc) && (gosp!=typ_text[0] || gosc!=typ_text[1])){
			var score = $("#gosp").val()+":"+$("#gosc").val();
			$("#loading").clone().appendTo($("#typer_form")).show().css({"margin-top":"-6px","margin-right":"4px","display":"inline-block"});
			$.ajax({
				url:'../../typuj.php',
				type: "GET",
				data:{id:idm,wynik:score,c_m:cm},
				success:function(data){
					var test = $(".active").text(score).removeClass("active").parents("tr").next("tr").find("a").addClass("active").text();
					//$(".active").text(score).removeClass(".active");
					var posTF = $("#typer_form").position(); 
					if(test=="typuj"){$("#typer_form").animate({"top":"+=16"},400);$("#gosp").val("");$("#gosc").val("");}else{$("#typer_form").fadeOut()};
					$("#typer_form > #loading").remove();
					
				},
				error:function(data){
					alert("Wystąpił nieoczekiwany błąd");
					$("#typer_form > #loading").remove();
					$("#typer_form").fadeOut();
				}
			});	
		}else{
			$("#typer_form").fadeOut();
		};
	});
	$(".komentarze").find(".odp_btn").click(function(e){
		e.preventDefault();
		$(e.target).closest(".komentarz").append($("#dod_kom").hide().slideDown(300));
		$("#kom_text").focus();
	});
	$("#cancel_btn").click(function(e){
		e.preventDefault();
		$("#dod_kom").hide().appendTo(".dodaj").slideDown(500);
	});
	$("#dodaj_kom_btn").click(function(e){
		e.preventDefault();
		var id=$(".komentarze").attr("id").replace("news_","");
		var cid=$(e.target).parent().parent().attr("class")=="dodaj"?'0':$(e.target).closest(".komentarz").attr("id").replace("kom","");
		if($("#kom_text").val()=='')alert("Napisz coś...");else{
			$.ajax({
				url:"../dodaj_kom.php",
				type:"POST",
				data:"news_id="+id+"&cytat="+cid+"&"+$("#dod_kom").serialize(),
				beforeSend:function(){$("#kom_text").val("");},
				success:function(data){
					data = $(data).filter("#odp").html();
					$(".dodaj").before(data);
					$("#cancel_btn").click();
					
				}
			});
		}
	});
	/**
	$(".opis_meczu").find("p").click(function(e){
		if($(".editing").length>0){
			$(".editing").html($("#edit").val()).removeClass("editing").unwrap();
		}
		var elem = $(e.target);
		var id = elem.attr("class");
		var h = elem.height()+50;
		elem.wrap("<textarea class=\"edit\" id=\"edit\"/>").addClass("editing");
		$("#edit").val(elem.html()).css({height:h});
	});
	**/
	$("body").on("mouseenter","#fb-lb a",function(){
		$("#fb-lb").animate({"right":"2px"});
	});
	$("#fb-lb").mouseleave(function(){
		$(this).animate({"right":"-301px"});
	});
});
function online(){
	$.ajax( {
		url : 'http://www.rolnikskapa.cba.pl/online.php',//http://localhost/rolnik/online.php http://www.rolnikskapa.cba.pl/online.php
		success : function(data) {
			var json = jQuery.parseJSON(data);
			$("#on").html(json.on);
		}
	});	
}
function loadingBg(elem){
	elem.offsetParent().css('background-color', 'red')
	var offset = elem.position();
	var x = offset.left;
	var y = offset.top;
	var h = elem.height();
	var w = elem.width();
	$("#loader").css({left:x+"px",top:y+"px",width:w+"px",height:h+"px"}).show();
	
}