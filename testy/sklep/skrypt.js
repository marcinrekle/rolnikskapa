$(document).ready(function(){
	$(".textContact").click(function(e){
		if($(this).val()=="E-mail"||$(this).val()=="Temat")$(this).val("");
	});
	$("#formContact input[type='submit']").click(function(e){
		e.preventDefault();
		$("#formContact input,textarea").attr("style","");
		$("#formContact span").remove();
		var mail = $("input[name='email']").val();
		var sub = $("input[name='subject']").val();
		var txt = $("#taText").val();
		var status = true;
		if(mail==""||mail=="E-mail"||mail.length<8){$("input[name='email']").after("<span>Pole zawiera błędy</span>").css("border-color","red");status=false;}
		if(txt==""||txt===undefined||txt.length<5||txt=="Wiadomość została wysłana"){$("#taText").after("<span>Nic jeszcze nie wpisałeś/aś</span>").css("border-color","red");status=false;}
		if(status){
			$(this).css({"background":"rgba(70, 113, 213,.8) url(img/loader.gif) 0px 19px no-repeat"}).val("Wysyłanie");
			//alert($("#taText").val());
			$.post("mail.php",{email:mail,subject:sub,text:txt}).done(function(data){$("#formContact input[type='submit']").attr("style","").val("Wysłano");setTimeout(function(){$("#formContact input[type='submit']").val("Wyślij");$("#taText").val("Wiadomość została wysłana");},3000)});
		}
		
	});
	$(".btnPlus2").click(function(e){
		e.preventDefault();
		$(this).next("input").val(parseInt($(this).next().val())+1);
		var id=$("li").index($(this).closest("li"));
		$.post("function.php",{foo:"plusItem",id:id}).done(function(){
			//alert(parseFloat($(e.target).parent().next().text()));
			var itemSum = parseFloat($(".itemSum").text().replace("Razem : ",""));
			var allSum = parseFloat($(".allSum").text().replace("Do zapłaty : ",""));
			var itemPrice = parseFloat($(e.target).parent().next().text());
			$(".itemSum").text("Razem : "+(itemSum+itemPrice)+" zł");
			$(".allSum").text("Do zapłaty : "+(allSum+itemPrice)+" zł");
			$(".delivery").change();
		});
	});
	$(".btnPlus").click(function(e){
		e.preventDefault();
		var valOld = $(this).next("input").val();
		$(this).next("input").val(parseInt($(this).next().val())<11? parseInt($(this).next().val())+1:$(this).next().val() );
		//$(this).next("input").val(parseInt($(this).next().val())+1);
		if(valOld!=$(this).next("input").val()){
			var id=$(this).closest("li").attr("id");
			var itemPrice = parseFloat($(e.target).parent().next().text());
			var itemCount = $(e.target).next().val();
			$.post("function.php",{foo:"plusItemN",id:id,itemPrice:itemPrice,itemCount:itemCount}).done(function(data){
				var json = $.parseJSON(data);
				$("a[href='cart.php']").html("<span id=\"itemsCount\">"+json.allItemCount+"</span> "+json.text+" za <span id=\"itemsPrice\">"+json.price+"</span> zł" );
				$(".itemSum").text("Razem : "+json.price+" zł");
				$(".allSum").text("Do zapłaty : "+json.price+" zł");
				$(e.target).next().val(json.itemCount);
				$(".delivery").change();
			});
		}
	});
	$(".btnMinus").click(function(e){
		e.preventDefault();
		var valOld = $(this).prev("input").val();
		$(this).prev("input").val(parseInt($(this).prev().val())>1? parseInt($(this).prev().val())-1:$(this).prev().val() );
		//$(this).prev("input").val(parseInt($(this).prev().val())+1);
		if(valOld!=$(this).prev("input").val()){
			var id=$(this).closest("li").attr("id");
			var itemPrice = parseFloat($(e.target).parent().next().text());
			var itemCount = $(e.target).prev().val();
			$.post("function.php",{foo:"minusItem",id:id,itemPrice:itemPrice,itemCount:itemCount}).done(function(data){
				var json = $.parseJSON(data);
				$("a[href='cart.php']").html("<span id=\"itemsCount\">"+json.allItemCount+"</span> "+json.text+" za <span id=\"itemsPrice\">"+json.price+"</span> zł" );
				$(".itemSum").text("Razem : "+json.price+" zł");
				$(".allSum").text("Do zapłaty : "+json.price+" zł");
				$(e.target).prev().val(json.itemCount);
				$(".delivery").change();
			});
		}
	});

	$(".cart .itemDelete").click(function(e){
		e.preventDefault();
		var id=$(this).closest("li").attr("id");
		var itemPrice = parseFloat($(this).prev().text());
		var itemCount = $(this).closest("li").find(".quantity").val();
		$.post("function.php",{foo:"deleteItem",id:id,itemPrice:itemPrice,itemCount:itemCount}).done(function(data){
				var json = $.parseJSON(data);
				if(json.size==0){
					$(".emptyCart").show();
					$(".fullCart").hide();
					$("a[href='cart.php']").text("Koszyk jest pusty");
				}else{
					$("a[href='cart.php']").html("<span id=\"itemsCount\">"+json.allItemCount+"</span> "+json.text+" za <span id=\"itemsPrice\">"+json.price+"</span> zł" );
					$(".itemSum").text("Razem : "+json.price+" zł");
					$(".allSum").text("Do zapłaty : "+json.price+" zł");
				}
				$(e.target).parent().remove();
				$(".delivery").change();
		});
		});
	$(".delivery").change(function(){
		var val = parseFloat($(this).val());
		if(val!=-1){
			if(val==0){sum=0} else{
				var sum=0;
				var itemQuantity=0;
				$(".itemQuantity input.quantity").each(function(){itemQuantity+=parseInt($(this).val())});
				if(itemQuantity==1){sum=val}else{
					//newItemQuantity=itemQuantity--;
					sum=val+itemQuantity-1;
				}}
			$(".deliverySum").text("Przesyłka : "+sum+" zł");
			var itemSum = parseFloat($(".itemSum").text().replace("Razem : ",""));
			$(".allSum").text("Do zapłaty : "+(itemSum+sum)+" zł");
			$(".buyPay").text((val==12.70||val==0)?"Zamów":"Zapłać");
			$("input[name='z24_kwota']").val((itemSum+sum)*100);
			$("input[name='z24_delivery']").val($(".delivery option:checked").text());
			$("input[name='z24_delivery_cost']").val(sum);

		}
	});
	$(".returnToShop").click(function(e){
		e.preventDefault();
		document.location.href="index.php";
	});
	$(".payForShopping").click(function(e){
		e.preventDefault();
		$(".address").slideDown();
	});
	$(".buyPay").click(function(e){
		//e.preventDefault();
		var test=true;
		$(".address input.quantity").each(function(){
			if($(this).val()==""){
				test=false;
				$(this).css("border-color","red");
			}else{$(this).attr("style","");}
		});
		if($(".delivery").val()=="-1"){test=false;$(".delivery").css("background","rgba(255,0,0,.5)");}else{$(".delivery").attr("style","");}
		if(test){
			document.location.href="summary.php";
		}else{e.preventDefault();}
	});
	$(".buyZ24").click(function(e){
		e.preventDefault();
		$.get("done.php",$("#z24").serialize()).done(function(data){
			document.location.href="https://sklep.przelewy24.pl/zakup.php?"+$("#z24").serialize();
		});
		
	});
});
function allSum(){
	var allSum=0;
	$(".cart li").each(function(){
		allSum+=parseFloat($(this).find(".price").text())*parseFloat($(this).find(".quantity").val());
	});
}