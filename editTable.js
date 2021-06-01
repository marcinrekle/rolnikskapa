$(document).ready(function(){
	function updateTable(obj){
		//var isdis = $( ".dateP" ).datepicker( "isDisabled" );
		//var newDate = $( ".dateP" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
		//var newVal = newDate==null? $(this).val():newDate;
		var newVal = obj.val();
		if(newVal!=obj.attr("oldValue")){
			var table = $("#"+obj.attr("table"));
			var col = table.find("th").eq($(".edited").index()).text();
			var id = $("td:first",$(".edited").parent("tr")).text();
			var query = "UPDATE `"+table.attr("id")+"` SET `"+col+"`='"+newVal+"' WHERE `id`="+id;
			$(".cText").append($("#loading"));
			$("#loading").show();
			$.post("sql.php",{query:query}).done(function(data){
				var json = $.parseJSON(data);
				$(".edited").text(newVal).removeClass("edited");
				$("div.cText :first-child").appendTo("body").fadeOut();
				$("body").append($("#loading"));
				$(".cText").fadeOut();
				$("#loading").hide();
				$("#message").fadeIn().find("span").text(json.Status);
				setTimeout(function(){$("#message").fadeOut()},3000);
			});
		}else {
			$(".edited").removeClass("edited");
			$("div.cText :first-child").appendTo("body").fadeOut();
			$("body").append($("#loading"));
			$(".cText").fadeOut();
		};
	}
	//wywolywana w momecie klikniecia na pole tabeli w celu edycji zawartosci
	$("body").on("click","td:not(:first-child,:last-child)",function(e){
		var obj = $(e.target);
		var top = obj.offset().top;
		var left = obj.offset().left;
		var height = obj.outerHeight();
		var width = obj.outerWidth();
		var font = "11px";
		var table = obj.parents("table").attr("id");
		if (obj.hasClass("date")){
			$("input.dateP").appendTo($(".cText"));
			$("input.dateP").click();
		}else{
			$(".text").appendTo($(".cText"));
		}
		obj.addClass("edited");
		$(".cText").fadeIn().css({left:left,top:top});
		$("div.cText :first-child").val(obj.text()).css({height:height,width:width,'font-size':font,display:"block"}).attr({"oldValue":obj.text(),"table":table}).focus();
		$("#loading").css({height:height+4,width:height+4,left:width-5});
	});
	//$("body").on("change",".dateP",function(){updateTable(this);});
	$("body").on("focusout","div.cText textarea",function(){updateTable($(this));});
	//wcisniecie przycisku dodaj do tabeli
	$("body").on("click",".add",function(e){
		var obj = $(e.target).parent().next("table").attr("id");
		var newTable="<h1>Dodawanie nowego elementu</h1><table name=\""+obj+"\">";
		var nn="",nc="",cl="";
		$("tr:nth-child(1)","#"+obj).children("th:not(:last-child)").each(function(){
			nn=$(this).hasClass("not_null")?'not_null':'';
			nc=$(this).text();
			cl=$(this).attr("title");
			var inp = (cl=="datetime"||cl=="time"||cl=="date")?"<input type=\"text\" class=\""+cl+"\" id=\""+nc+"\">":"<textarea class=\""+cl+"\" id=\""+nc+"\"></textarea>";
			newTable+="<tr><th>"+$(this).text()+"</th><td class=\""+nn+"\">"+inp+"</td></tr>";
		});
		newTable+="</table><br><span class=\"send\">Wyślij</span><span class=\"cancel close\">Anuluj</span>";
		$("#newRow").html(newTable).fadeIn();
		$("body").scrollTop(100);
		//$("tr:nth-child(1)","table").clone().appendTo("table");
		//$("tr:last","table").children("th").wrapInner("<textarea />");
	});
	//dodanie jquery ui button do bottonow obliczania tabeli ligowej,typerow oraz strona glowna
	$("#operations button,.add").button().click(function( event ){event.preventDefault();});
	//zamkniecie div'ov z przyciskiem o klasie .close
	$("body").on("click",".close",function(e){
		$(e.target).parent().fadeOut();
	});
	//wcisniecie przycisku strona glowna
	$("#goHome").click(function(){
		  window.location = "index.php";
	});
	//wcisniecie przycisku obliczenia tabeli
	$("#oblTab").click(function(e){
		$.post('rozgrywki/obl_tabela.php').done(function(data){data = $.parseJSON(data);alert(data.Status)});
	});
	//wcisniecie przycisku obliczenia tabeli typerów
	$("#oblTabTyp").click(function(e){
		$.post('dodatki/tabela_typerow.php').done(function(data){data = $.parseJSON(data);alert(data.Status)});
	});
	//wcisniecie przycisku wyslij w panelu dodawania do tabeli
	$("body").on("click","#newRow .send",function(e){
		var len=0;
		$("#newRow td.not_null textarea,#newRow td.not_null input").each(function(index){
			if(!$.trim($(this).val()))len++;
			if(index==1) len=0;
		});
		if(len==0){
			var table = $("#newRow table").attr("name");
			var row=$("tr:last","#"+table).clone();
			$row2=$("tr:last","#"+table).clone();
			var query= "INSERT INTO `"+table+"` VALUES (";
			$("#newRow textarea,#newRow input").each(function(index){
				query+=(index==0?"'":",'")+$(this).val()+"'";
				row.children("td").eq(index).text($(this).val());
				$row2.children("td").eq(index).text($(this).val());
			});
			query+=")";
			$.post("sql.php",{query:query}).done(function(data){
				var json = $.parseJSON(data);
				row.children("td").eq(0).text(json.lid);
				$row2.children("td").eq(0).text(json.lid);
				$("tbody",$("#"+table)).append($row2);
				$("#newRow").fadeOut();
				$("#message").fadeIn().find("span").text(json.Status);
				setTimeout(function(){$("#message").fadeOut()},3000);
			});
		}
		//$("#newRow td.not_null > textarea:empty").css("background","red");
		
	});
	//wcisniecie przycisku usun w wierszu tabeli
	$("body").on("click",".delete",function(e){
		e.preventDefault();
		var obj = $(e.target);
		var table = obj.parents("table").attr("id");
		var id=obj.parents("tr").children("td").eq(0).text();
		var query="DELETE FROM "+table+" WHERE id="+id;
		var r=confirm(query);
		if(r){
			$.post("sql.php",{query:query}).done(function(data){
				var json = $.parseJSON(data);
				obj.parents("tr").remove();
				$("#message").fadeIn().find("span").text(json.Status);
				setTimeout(function(){$("#message").fadeOut()},3000);
			});
		}
	});
	//podswietlanie wiersza w tabeli
	$("table").on("mouseover","td",function(e){
		$(e.target).parents("tr").children("td").toggleClass("b_blue");
	});
	//wylaczenie podswietlanie wiersza
	$("table").on("mouseout","td",function(e){
		$(e.target).parents("tr").children("td").toggleClass("b_blue");
	});
	$(".datetime").datetimepicker({
		inline: true,
		dateFormat: "yy-mm-dd",
		changeYear: true,
		yearRange: "1970:2020",
		timeFormat: 'HH:mm'
	});
	//dodanie jquery ui datepicker do pola input podczas edycji tabeli
	$(".dateP").datepicker({
		inline: true,
		dateFormat: "yy-mm-dd",
		changeYear: true,
		changeMonth: true,
		yearRange: "1970:2020",
		onSelect: function(dateText, inst){updateTable($(this));$(inst).hide();},
		onClose: function(dateText, inst){updateTable($(this));}
	});
	//$("textarea,input").autocomplete({source:"http://localhost/rolnik/search.php"});
	$("body").on("focus", "input.string:not(.ui-autocomplete-input),textarea.string:not(.ui-autocomplete-input),input.int:not(.ui-autocomplete-input),textarea.int:not(.ui-autocomplete-input)", function(event) { $(this).autocomplete({source:"search.php",minLength:2}); });
	$("#newRow").on("click",".datetime",function(e){
		var a = $(e.target);
		var b = $(this);
	});
	$("body").on("focus", ".datetime", function(event) { $(this).datetimepicker({
		inline: true,
		dateFormat: "yy-mm-dd",
		changeYear: true,
		changeMonth: true,
		stepMinute:30,
		yearRange: "1970:2020",
		timeFormat: 'HH:mm',
		hourMin: 10,
		hourMax: 18
	});$(this).click(); });
	$("body").on("focus",".time",function(event){$(this).timepicker({
		timeFormat: 'hh:mm'
	});});
	$("#accordion").accordion({header:".tyt",heightStyle: "content",collapsible: true,create: function( event, ui ) {$("#accordion div.tyt:first-child").click()}});
});