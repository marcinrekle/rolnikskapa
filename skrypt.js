$(document).ready(function(){
	$("#rej_start").click(function(e){
		e.preventDefault();
		$("#panelRej").fadeIn();
	});
	$("body").on("click","#start",function(e){
		e.preventDefault();
		$(this).slideToggle();
		$("#rej").slideToggle();
		var adres = $("#panelRej").attr("name");
	})
			
			$("body").on("keyup change","#rej input:not(#phaslo)",function(){
				var obj = $(this);
				if(obj.val().length>=3){
					$.post("rej_spr.php", {
						val : obj.val(),
						dzialanie : "spr_"+obj.attr('id')
					},function(data){
						var json = jQuery.parseJSON(data);
						obj.css("background","rgba("+(json.odp=="blad"?"255,0":"0,255")+",0,1)")
					});
				}
			});//on #rej input:not(#phaslo)
			$("body").on("keyup","#phaslo",function(){
				$(this).css("background","rgba("+($(this).val()!=$("#rej #haslo").val()?"255,0":"0,255")+",0,1)")
			});
			$(".close").click(function(e){
					$(e.target).parents("div").fadeOut();
				});
			$("body").on("click","input#rejestruj.btn",function(e){
				e.preventDefault();
				var check = "true";
				$("#rej input:not(#rejestruj)").each(function(){
					if($(this).css("background-color")+""!="rgb(0, 255, 0)"){check="false";alert("false");return false;}
				});
				if (check=="true"){
					$.post("rej_spr.php",{
						dzialanie:"zarejestruj",
						login:$("#login").val(),
						haslo:$("#haslo").val(),
						imie:$("#imie").val(),
						miej:$("#miej").val(),
						mail:$("#email").val()
					},function(){
						$("#panelRej").html("<h3>Konto zostało utworzone</h3><br>Panel zostanie zamknięty");
						$("#panelRej").slideDown(1000).delay(3000).fadeOut(1500);
					})
				}
			});//rejestruj.btn click
		});//ready

function sprawdz(href) {
		//wyswietl(href);
	}

	
	function wyswietl(adres){
					$.ajax( {
						url : adres,
						success : function(data) {
							$("#on").html(data);
							setTimeout(function(){wyswietl(adres);},60000);
						}
					});	
					
	}
	
	function wyswietl_edycja_meczu(id) {
		var el = document.getElementById(id);
		el.style.display = 'block';
	}

	function ukryj_edycja_meczu(id) {
		var el = document.getElementById(id);
		el.style.display = 'none';
	}

	function wyswietl_cos(id) {
		var el = document.getElementById(id);
		var gosp = document.getElementById('f' + id).gosp;
		var gosc = document.getElementById('f' + id).gosc;
		if (gosp.value == " " || gosc.value == " " || gosp.value == ''
				|| gosc.value == '')
			wynik = " ";
		else
			wynik = gosp.value + ":" + gosc.value;
		var r = typeof XMLHttpRequest == "undefined" ? new ActiveXObject(
				'Microsoft.XMLHttp') : new XMLHttpRequest();
		r.onreadystatechange = function() {
			if (r.readyState == 4 && r.status == 200) {
				zmienna = this.responseText;
				var x = document.getElementById(id);
				x.innerHTML = zmienna;
				if (wynik == "" || wynik == " ")
					wynik = "Edytuj";
				var y = document.getElementById('m' + id).innerHTML = wynik;
				x.style.display = "none";
			}
		};
		r.open('GET', 'rozgrywki/1213/obliczanie_tab.php?id=' + id + '&wynik='
				+ wynik, true);
		r.send(null);

	}

	function typuj(id) {
	
					var gosp = document.getElementById("gosp");
					var gosc = document.getElementById("gosc");
					wynik = gosp.selectedIndex + ":" + gosc.selectedIndex;
					$('#' + id).append('<div class="czekaj"> </div>');
					if ($("#formularz"))
						$("#formularz").remove();
					$.ajax( {
						url : 'typuj.php?id=' + id + '&wynik=' + wynik,
						success : function(data) {
							if ($('#' + id + ' .typ_typ').text() == 'typuj')
								txt = 'Typ został dodany';
							else if ($('#' + id + ' .typ_typ').text() == wynik)
								txt = 'Typ bez zmian';
							else
								txt = 'Typ został zmieniony';
							$('#' + id + ' .typ_typ').html(data);
							$('#' + id).append(
									'<div class="sukces">' + txt + '</div>');
							$('.czekaj').remove();
							$(".sukces").hide().fadeToggle(500).delay(2000)
									.fadeToggle(500);

						}
					});
		$(".sukces").remove();
	}// typuj
	function pok(id) {
		var el = document.getElementById('f' + id);
		var el2 = document.getElementById(id);
		el2.innerHTML = el.gosp.selectedIndex;
	}
	function pokaz_typuj2(id) {
		var el = document.getElementById(id);
		var formularz = document.getElementById("formularz");
		var link = document.getElementById("typ_typuj");
		var link2 = document.getElementById("typ_usun");
		if (link)
			link.parentNode.removeChild(link);
		if (link2)
			link2.parentNode.removeChild(link2);
		var typ_text = el.getElementsByClassName("typ_typ")[0].children[0].text;
		var typ = typ_text.split(":");
		if (formularz) {
			formularz.parentNode.removeChild(formularz);
		}
		var txt = '<form id="formularz"><br><select id="gosp"><option> </option>';
		for (i = 0; i <= 10; i++) {
			i == typ[0] ? txt += '<option selected>' + i + '</option>'
					: txt += '<option>' + i + '</option>';
		}
		txt += '</select><select id="gosc"><option></option>';
		for (i = 0; i <= 10; i++) {
			i == typ[1] ? txt += '<option selected>' + i + '</option>'
					: txt += '<option>' + i + '</option>';
		}
		txt += '</select><a href="javascript:typuj('
				+ id
				+ ')" title="typuj" id="typ_typuj"> </a><a href="javascript:ukryj_typuj('
				+ id + ')" title="ukryj" id="typ_usun"> </a></form">';
		el.innerHTML += txt;
		var gosp = document.getElementById("gosp");
		var gosc = document.getElementById("gosc");
		link = document.getElementById("typ_typuj");
	}
	function pokaz_typuj(id) {
		if ($(".typ_typuj"))
			$(".typ_typuj").remove();
		if ($(".typ_usun"))
			$(".typ_usun").remove();
		var typ_text = $("#" + id + " .typ_typ").text();
		var typ = typ_text.split(":");
		if ($("#formularz"))
			$("#formularz").remove();
		var txt = '<form id="formularz"><br><select id="gosp">';
		for (i = 0; i <= 10; i++) {
			i == typ[0] ? txt += '<option selected>' + i + '</option>'
					: txt += '<option>' + i + '</option>';
		}
		txt += '</select><select id="gosc">';
		for (i = 0; i <= 10; i++) {
			i == typ[1] ? txt += '<option selected>' + i + '</option>'
					: txt += '<option>' + i + '</option>';
		}
		txt += '</select><a href="javascript:typuj('
				+ id
				+ ')" title="typuj" id="typ_typuj"> </a><a href="javascript:ukryj_typuj('
				+ id + ')" title="ukryj" id="typ_usun"> </a></form">';
		$("#" + id).append(txt);
	}
	function ukryj_typuj(id) {
		var el = document.getElementById(id);
		formularz = document.getElementById("formularz");
		link = document.getElementById("typ_typuj");
		link2 = document.getElementById("typ_usun");
		if (formularz) {
			formularz.parentNode.removeChild(formularz);
		}
		if (link)
			link.parentNode.removeChild(link);
		if (link2)
			link2.parentNode.removeChild(link2);
	}
	function sort_strzelcy(typ) {

		var r = typeof XMLHttpRequest == "undefined" ? new ActiveXObject(
				'Microsoft.XMLHttp') : new XMLHttpRequest();
		r.onreadystatechange = function() {
			if (r.readyState == 4 && r.status == 200) {
				zmienna = this.responseText;
				var el = document.getElementById("strzelcy");
				el.innerHTML = zmienna;
			}
		};
		r.open('GET', 'strz.php?sort=' + typ, true);
		r.send(null);

	}
	function jqtest() {
		$(document).ready(function() {
			$("#link").click(function() {
				alert('KLIK!');
			});
		});
	}

	function editKal(id, co) {
		$(document).ready(
				function() {
					$.ajax( {
						url : "kalendarz.php?id=" + id + "&op=" + co,
						success : function(data) {
							$("#editKal").html(data);
							$("#a" + id).mouseover(
									function() {
										var godz = $("input[name=godz]").val();
										var data = $("input[id=data]").val();
										var wyd = $("input[name=rodzaj]").val();
										var miejsce = $("input[name=opis]").val();
										$(this).attr(
												"href",
												"javascript:zmienKal(" + id
														+ ",'zmien','" + data
														+ "','" + godz + "','"
														+ wyd + "','" + miejsce
														+ "')");
									});
						}
					});

				});
	}
	function pokazKal() {
		$(document).ready(function() {
			$.ajax( {
				url : "kalendarz.php",
				success : function(data) {
					$("#editKal").html(data).toggle("slow");
					$('#editKal input').click(function() {
						$(this).val("");
					});
					$('input#data').click(function(){
						$(this).datepicker($.datepicker.regional['pl']);
					});
				}
			});

		});
	}
	function zmienKal(id, co, data, godz, wyd, miejsce) {
		$(document).ready(
				function() {
					$.ajax( {
						url : "kalendarz.php?id=" + id + "&op=" + co + "&data="
								+ data + "&godz=" + godz + "&wyd=" + wyd
								+ "&miejsce=" + miejsce,
						success : function(data) {
							$("#editKal").html(data);
						}
					});

				});
	}
	function dodajKal() {
		$(document).ready(
				function() {
					var godz = $("input[name=godz]").val();
					var data = $("input[id=data]").val();
					var wyd = $("input[name=rodzaj]").val();
					var miejsce = $("input[name=opis]").val();
					$.ajax( {
						url : "kalendarz.php?op=ins&d='" + data + "'&g=" + godz
								+ "&w=" + wyd + "&m=" + miejsce,
						success : function(data) {
							$("#editKal").html(data);
						}
					});
				});
	}
	function pokazDiv(co, gdzie) {
		$(document).ready(function() {
			$("#" + gdzie).load(co).toggle("slow");
		});
	}
	function dodajBramke(gdzie, id, znak) {
		$(document).ready(
				function() {
					$.ajax( {
						url : "rozgrywki/1213/edit_strzelcy.php?id=" + id + "&roz="
								+ gdzie + "&znak=" + znak,
						success : function(data) {
							$("#editStrz").html(data);
						}
					});
				});
	}
	function dodajStrzelca(id) {
		$(document).ready(function() {
			$.ajax( {
				url : "rozgrywki/1213/edit_strzelcy.php?id=" + id + "&ins=1",
				success : function(data) {
					$("#editStrz").html(data);
				}
			});
		});
	}
	function ladujNews(url) {
		$("#news_text").load(url);
		$("#news_edit").slideToggle(1000);
	}
	function zmienNews(el, znak) {
		txt=$('#news_edit #' + el).val();
		$('#news_edit #' + el).focus();
		$('#news_edit #' + el).val(txt+znak);
	}
	function ENpokaz(txt, txt2) {
		$(document).ready(function() {
			$(txt).slideToggle(1000);
			$(txt).attr("name", txt2);
		});
	}
	function ENdodaj(txt, txt2) {
		$(document).ready(function() {
			var id = $(txt).attr("name");
			$(txt).slideToggle(1000);
			$("#" + id + " .zaw").html(txt2);
		});
	}
	function ENdodajStat(txt, txt2) {
		$(document).ready(function() {
			var id = $(txt).attr("name");
			$(txt).slideToggle(1000);
			if ($("#" + id + " .stat").text() == "Stat")
				$("#" + id + " .stat").html("");
			$("#" + id + " .stat").append("<img src='../../PLIKI/" + txt2 + "'> ");
		});
	}
	function ENusunStat(txt) {
		$(document).ready(function() {
			$("#" + txt + " .stat").text("Stat");
		});
	}
	function ENpokazZm(txt) {
		$(document)
				.ready(
						function() {
							var id = 1;
							for (i = 0; i <= 15; i++) {
								if ($("#zm" + i).length == 1)
									id = i + 1;
							}
							$(txt)
									.append(
											"<div id=\"zm"
													+ id
													+ "\"><a href=\"javascript:ENusun('"
													+ txt
													+ "','"
													+ id
													+ "')\" class=\"poz\">usuń</a><a href=\"javascript:ENpokaz('#zmiennicy','"
													+ id
													+ "')\" class=\"zaw\">Dodaj</a><a href=\"javascript:ENpokaz('#stat','zm"
													+ id
													+ "')\" class=\"stat\">Stat</a><a href=\"javascript:ENusunStat('"
													+ id
													+ "')\">-</a><a href=\"javascript:ENpokazZm('"
													+ txt
													+ "')\" class=\"zm\"><img src=\"../../PLIKI/zmiana.gif\"/></a></div>");
						});
	}
	function ENusun(txt, id) {
		$(document).ready(function() {
			$("#zm" + id).remove();
		});
	}
	function ENdodajZm(txt, txt2) {
		$(document).ready(function() {
			var id = $(txt).attr("name");
			$(txt).slideToggle(1000);
			$("#zm" + id).html(txt2);
		});
	}
	function EnNowyZaw(txt) {
		$(document)
				.ready(
						function() {
							var id = 0;
							for (i = 0; i <= 20; i++) {
								if ($("#zaw" + i).length == 1)
									id = i + 1;
							}
							$(txt)
									.append(
											"<div id=\"zaw"
													+ id
													+ "\" class=\"zawodnik\"><a href=\"javascript:EnUsunZaw('#zaw"
													+ id
													+ "')\" class=\"btn_mod\">-</a><a href=\"javascript:ENpokaz('#pozycje','#zaw"
													+ id
													+ " .poz')\" class=\"poz\">Poz</a><a href=\"javascript:ENpokaz('#zawodnicy','#zaw"
													+ id
													+ " .zaw')\" class=\"zaw\">Imię Nazwisko</a><a href=\"javascript:ENpokaz('#stat','#zaw"
													+ id
													+ " .stat')\" class=\"stat\">Stat</a><a href=\"javascript:EnClearStat('#zaw"
													+ id
													+ "')\">-</a><a href=\"javascript:EnNowyRez("
													+ id
													+ ")\" class=\"zm\"><img src=\"../../PLIKI/zmiana.gif\"/></a></div>");
						});
	}
	function EnNowyRez(idz) {
		$(document)
				.ready(
						function() {
							if (idz == '') {
								var id = 0;
								for (i = 0; i <= 20; i++) {
									if ($("#rez" + i).length == 1
											|| $("#rezg" + i).length == 1)
										id = i + 1;
								}
								$("#en_rezerwowi")
										.append(
												"<div id=\"rez"
														+ id
														+ "\" class=\"zawodnik\"><a href=\"javascript:EnUsunZaw('#rez"
														+ id
														+ "')\" class=\"btn_mod\">-</a><a href=\"javascript:ENpokaz()\" class=\"poz\">REZ</a><a href=\"javascript:ENpokaz('#zawodnicy','#rez"
														+ id
														+ " .zaw')\" class=\"zaw\">Imię Nazwisko</a><a href=\"javascript:ENpokaz('#stat','#rez"
														+ id
														+ " .stat')\" class=\"stat\">Stat</a><a href=\"javascript:EnClearStat('#rez"
														+ id + "')\">-</a></div>");
							} else {
								$("#zaw" + idz)
										.after(
												"<div id=\"rezg"
														+ idz
														+ "\" class=\"rez\"><a href=\"javascript:EnUsunZaw('#rezg"
														+ idz
														+ "')\" class=\"btn_mod\">-</a><a href=\"javascript:ENpokaz()\" class=\"poz\">REZ</a><a href=\"javascript:ENpokaz('#zawodnicy','#rezg"
														+ idz
														+ " .zaw')\" class=\"zaw\">Imię Nazwisko</a><a href=\"javascript:ENpokaz('#stat','#rezg"
														+ idz
														+ " .stat')\" class=\"stat\">Stat</a><a href=\"javascript:EnClearStat('#rezg"
														+ idz + "')\">-</a></div>");
								$("#en_rezerwowi")
										.append(
												"<div id=\"rezl"
														+ idz
														+ "\" class=\"zawodnik\"><a href=\"javascript:EnUsunZaw('#rezl"
														+ idz
														+ "')\" class=\"btn_mod\">-</a><a href=\"javascript:ENpokaz()\" class=\"poz\">REZ</a><a href=\"javascript:ENpokaz('#zawodnicy','#rezl"
														+ idz
														+ " .zaw')\" class=\"zaw\">Imię Nazwisko</a><a href=\"javascript:ENpokaz('#stat','#rezl"
														+ idz
														+ " .stat')\" class=\"stat\">Stat</a><a href=\"javascript:EnClearStat('#rezl"
														+ idz + "')\">-</a></div>");
							}
						});
	}
	function EnUsunZaw(txt) {
		$(document).ready(function() {
			$(txt).remove();
		});
	}
	function EnPokaz(txt, name) {
		$(document).ready(function() {
			$(txt).slideToggle(500);
			$(txt).attr("name", name);
		});
	}
	function EnWstaw(popup, txt) {
		$(document).ready(function() {
			var id = $(popup).attr("name");
			if (popup == "#stat") {
				if ($(id).text() == "Stat")
					$(id).text("");
				$(id).append("<img src='../../PLIKI/" + txt + "'> ");
			} else {
				$(id).text(txt);
				$(popup).slideToggle(500);
			}
		});
	}
	function EnClearStat(id) {
		$(document).ready(function() {
			$(id + " .stat").text("Stat");
		});
	}
	function EnZapiszSklad() {
		$(document)
				.ready(
						function() {
							$p = $("#sklad_gotowy");
							var i = 0;
							$p
									.text($p.text()
											+ '<div class="sklad">\n<div class="sklad_boisko">\n');
							var licz = 10;
							for (i = 0; i <= licz; i++) {
								if (i >= 20)
									break;
								var poz = $("#zaw" + i + " .poz").text();
								poz = poz.toLowerCase();
								var zaw = $("#zaw" + i + " .zaw").text();
								if (poz == '' || zaw == '') {
									licz++;
									continue;
								}
								$p.text($p.text() + "<div class=\"sklad_" + poz
										+ "\"><div class=\"naz\">" + zaw
										+ "</div>\n</div>\n");
							}// for
							txt = $p.text();
							$p
									.text(txt
											+ '\n</div>\n<div class="sklad_sklad">\n<div class="sklad_zaw"></div>\n');
							var licz = 10;
							for (i = 0; i <= licz; i++) {
								if (i >= 20)
									break;
								var poz = $("#zaw" + i + " .poz").text();
								var zaw = $("#zaw" + i + " .zaw").text();
								var stat = $("#zaw" + i + " .stat").text();
								if (stat == 'Stat')
									stat = '';
								if (poz == '' || zaw == '') {
									licz++;
									continue;
								}
								$p.text($p.text() + "<div class=\"sklad_zaw\">"
										+ zaw + stat + "</div>\n");
								var rzaw = $("#rezg" + i + " .zaw").text();
								var rstat = $("#rezg" + i + " .stat").text();
								if (rstat == 'Stat')
									rstat = '';
								if (rzaw == '')
									continue;
								$p.text($p.text() + "<div class=\"sklad_zmiana\">"
										+ rzaw + rstat + "</div>\n");
							}// for
							txt = $p.text();
							$p.text(txt + '\nŁawka rezerwowych\n');
							var licz = 10;
							for (i = 0; i <= licz; i++) {
								if (i >= 20)
									break;
								var rzaw = $("#rez" + i + " .zaw").text();
								if (rzaw == '')
									var rzaw = $("#rezl" + i + " .zaw").text();
								if (rzaw == '') {
									licz++;
									continue;
								}
								$p.text($p.text() + "<div class=\"sklad_zaw\">"
										+ rzaw + "</div>\n");
							}// for
							$p.text($p.text() + "\n</div>\n</div>\n");
							$("#sklad_obr").html($("#sklad_gotowy").text());
						}// function
				);
	}
	function pokaz2(adres2) {
		$(document).ready(function() {
						$("#panelRej").remove();
						$("body").append("<div id=\"panelRej\">a</div>");
						$("#panelRej").load(adres2+"rejestracja_panel2.php");
						//$("#panel").fadeToggle();
						//$("#panelRej").attr("name", adres2);	
		});
	}

	function pokaz(adres2) {
						var adres=adres2+"rejestracja_panel2.php";
						$("#panelRej").remove();
						$("body").append("<div id=\"panelRej\"></div>");
						$.ajax({
						url:adres,
						cache:false,
						success:function(data){
							$("#panelRej").html(data);	
						}
						});
						$("#panelRej").attr("name", adres2);	
	}
	function rej2(){
		$(document).ready(function(){
			var adres = $("#panelRej").attr("name");
			$("#start").slideToggle();
			$("#rej").slideToggle();
		});
	}
/**
	function rejestracja() {
		$(document)
				.ready(
						function() {
							var adres = $("#panelRej").attr("name");
							$("#start").slideToggle();
							$("#rej").slideToggle();
							$("#login")
									.focusout(
											function() {
												$("#rejestruj").val("Rejestruj");
												var login = $("#login").val();
												$("#login").css('background-color',
														'grey');
												var foo = "spr_login";
												$.post(adres + "rej_spr.php", {
													'login' : login,
													'dzialanie' : foo
												}, function(data) {
													var json = jQuery.parseJSON(data);
													json.odp=="blad"?$("#login").css("background","rgba(255,0,0,1)"):$("#login").css("background","rgb(0,240,0)").val(json.odp);
												}, "html");
											});

							$("#haslo")
									.focusout(
											function() {
												$("#rejestruj").val("Rejestruj");
												var haslo = $("#haslo").val();
												var foo = "spr_haslo";
												$("#haslo").css('background-color',
														'grey');
												$.post(adres + "rej_spr.php", {
													'haslo' : haslo,
													'dzialanie' : foo
												}, function(data) {
													$("#haslo").after(data);
													if ($("#odp").text() == 'blad')
														$("#haslo").css(
																"background",
																"rgba(255,0,0,1)");
													else {
														$("#haslo").css(
																"background",
																"rgb(0,240,0)");
														$("#haslo").val(
																$("#odp").html());
													}
													$("#odp").remove();
												}, "html");
											});

							$("#phaslo").focusout(
									function() {
										$("#rejestruj").val("Rejestruj");
										var haslo = $("#haslo").val();
										var phaslo = $("#phaslo").val();
										haslo == phaslo ? $("#phaslo").css(
												"background", "rgb(0,240,0)") : $(
												"#phaslo").css("background",
												"rgba(255,0,0,1)");

									});

							$("#email")
									.focusout(
											function() {
												$("#rejestruj").val("Rejestruj");
												var mail = $("#email").val();
												var foo = "spr_mail";
												$("#email").css('background-color',
														'grey');
												$.post(adres + "rej_spr.php", {
													'mail' : mail,
													'dzialanie' : foo
												}, function(data) {
													$("#email").after(data);
													if ($("#odp").text() == 'blad')
														$("#email").css(
																"background",
																"rgba(255,0,0,1)");
													else {
														$("#email").css(
																"background",
																"rgb(0,240,0)");
														$("#email").val(
																$("#odp").html());
													}
													$("#odp").remove();
												}, "html");
											});

							$("#miej").focusout(
									function() {
										$("#rejestruj").val("Rejestruj");
										var miej = $("#miej").val();
										var foo = "spr_miej";
										$("#miej").css('background-color', 'grey');
										$.post(adres + "rej_spr.php", {
											'miej' : miej,
											'dzialanie' : foo
										}, function(data) {
											$("#miej").after(data);
											if ($("#odp").text() == 'blad')
												$("#miej").css("background",
														"rgba(255,0,0,1)");
											else {
												$("#miej").css("background",
														"rgb(0,240,0)");
												$("#miej").val($("#odp").html());
											}
											$("#odp").remove();
										}, "html");
									});

							$("#imie").focusout(
									function() {
										$("#rejestruj").val("Rejestruj");
										var imie = $("#imie").val();
										var foo = "spr_imie";
										$("#imie").css('background-color', 'grey');
										$.post(adres + "rej_spr.php", {
											'imie' : imie,
											'dzialanie' : foo
										}, function(data) {
											$("#imie").after(data);
											if ($("#odp").text() == 'blad')
												$("#imie").css("background",
														"rgba(255,0,0,1)");
											else {
												$("#imie").css("background",
														"rgb(0,240,0)");
												$("#imie").val($("#odp").html());
											}
											$("#odp").remove();
										}, "html");
									});

							$("#rejestruj")
									.click(
											function() {
												bg = 'rgb(0, 240, 0)';
												cl = $("#login").css(
														"background-color");
												ch = $("#haslo").css(
														"background-color");
												cph = $("#phaslo").css(
														"background-color");
												cm = $("#email").css(
														"background-color");
												cmi = $("#miej").css(
														"background-color");
												ci = $("#imie").css(
														"background-color");
												lv = $("#login").val();
												hv = $("#haslo").val();
												phv = $("#phaslo").val();
												mv = $("#email").val();
												miv = $("#miej").val();
												iv = $("#imie").val();
												if (cl == bg && ch == bg
														&& cph == bg && cm == bg
														&& cmi == bg && ci == bg) {
													$
															.post(
																	adres
																			+ "rej_spr.php",
																	{
																		'login' : lv,
																		'haslo' : hv,
																		'mail' : mv,
																		'miej' : miv,
																		'imie' : iv,
																		'dzialanie' : 'zarejestruj'
																	},
																	function(data) {
																		$(
																				"#rejestruj")
																				.after(
																						data);
																		if ($(
																				"#odp")
																				.text() == 'ok') {
																			$(
																					"#panel")
																					.css(
																							"text-align",
																							'center');
																			$(
																					"#panel")
																					.html(
																							"<h3>Konto zostało utworzone</h3><br>[Zamknij]");
																			$(
																					"#panel")
																					.click(
																							function() {
																								$(
																										"#panel")
																										.fadeToggle();
																							});
																		}
																	}, "html");

												} else
													$("#rejestruj")
															.val("Popraw błędy")
															.delay(5000)
															.queue(
																	function() {
																		$(
																				"#rejestruj")
																				.val(
																						"Zarejestruj")
																	});
											});

						});
	}**/
	function usun(element) {
		$(element).fadeToggle(1000, function() {
			$(element).remove();
		});

	}
	function browser() {
		$(document).ready(function() {
			$("#przeg").html($.browser.name);
		});
	}
	function dodaj_kom(id) {
		$(document).ready(function() {
			var dane = "news_id=" + id + "&" + $("#dod_kom").serialize();
			$.post('../../../dodaj_kom.php', dane, function(data) {
				$.ajax( {
					url : "../../../komentarz.php?news_id=" + id,
					success : function(data) {
						$("#kom_content").html(data);
					}
				});
			});

		});

	}
	function odp(id, kom) {
		$(document).ready(
				function() {
					$("#odp").remove();
					$("#kom" + kom).append('<div id="odp"></div>');
					$("#odp").load(
							"../../../komentarz.php?pok=1&id=" + id + "&kom=" + kom);
				}

		);

	}
	function dodaj_odp(id, kom) {
		$(document).ready(
				function() {
					var dane = "news_id=" + id + "&" + "cytat=" + kom + "&"
							+ $("#dod_odp").serialize();
					$.post('../../../dodaj_kom.php', dane, function(dane2) {
						$.ajax( {
							url : "../../../komentarz.php?news_id=" + id,
							success : function(data) {
								$("#kom_content").html(data);
							}
						});
					});

				});

	}
	function calendar() {
		$(document).ready(function() {
			$(function() {
				$("#kalendarz").progressbar( {
					value : 37
				});
			});
		});
	}
	function dodajZawodnika() {
		$(document)
				.ready(
						function() {
							var stat = '';
							zaw_id = $("#zaw_id").val();
							poz = $("#poz").val();
							zaw = $("#zaw").val();
							nr = $("#nr").val();
							bramki = $("#bramki").val();
							zk = $("#zk").val();
							czk = $("#czk").val();
							sbramki = $("#sbramki").val();
							kontuzja = $("#kontuzja").attr("checked");
							var status = $("input[name='stan']:checked").val();
							if (status == 'Podstawowy' || status == 'Zmiennik') {
								kontuzja == 'checked' ? stat = '<img class="kon" alt="kontuzja" src="../../PLIKI/kontuzja.png">'
										: stat = '';
								for (i = 0; i < zk; i++)
									stat += '<img class="zk" alt="zolta" src="../../PLIKI/z.png">';
								for (i = 0; i < czk; i++)
									stat += '<img class="czk" alt="czerwona" src="../../PLIKI/cz.png">';
								for (i = 0; i < bramki; i++)
									stat += '<img class="gol" alt="gol" src="../../PLIKI/gol.gif">';
								for (i = 0; i < sbramki; i++)
									stat += '<img class="sam" alt="samoboj" src="../../PLIKI/gol_s.png">';
								if (status == 'Podstawowy')
									$("#" + poz).remove();
								status == 'Podstawowy' ? txt = '<div class="zawodnik" id="'
										+ poz + '">'
										: txt = '<div class="zawodnik zmiana" id="zm_'
												+ poz + '">';
								txt += '<div class="nr">' + nr + '</div><b>' + zaw
										+ '</b>' + stat + '</div>';
								if (status == 'Podstawowy') {
									$(".news_sklad_p").append(txt)
									zawSpace = zaw.indexOf(" ");
									zaw2 = zaw.slice(0, zawSpace);
									$(".gracz." + poz.toLowerCase() + " .nazwisko")
											.text(zaw2);
									$(".gracz." + poz.toLowerCase()).attr("style",
											"opacity:1");
									$("#" + poz).click(function(e) {
										pokazOpcje($(this), e);

									});
								} else {
									$("#" + poz).after(txt);
									txt_rez = '<span id="rez_' + poz + '"><b>'
											+ zaw + '</b></span>';
									$("#lawka").append(txt_rez);
									$("#zm_" + poz).click(function(e) {
										pokazOpcje($(this), e);

									});
									$("#rez_" + poz).click(function(e) {
										pokazOpcje($(this), e);

									});
								}
							} else {
								txt_rez = '<span class="ng" id="rez_' + zaw_id
										+ '"><b>' + zaw + '</b></span>';
								$("#lawka").append(txt_rez);
								$("#rez_" + zaw_id).click(function(e) {
									pokazOpcje($(this), e);

								});
								$("#zaw_id").val(parseInt(zaw_id) + 1);
							}

							$("#nr").val(parseInt(nr) + 1);
							$("#bramki").val(0);
							$("#zk").val(0);
							$("#czk").val(0);
							$("#sbramki").val(0);
							$("#kontuzja").removeAttr("checked");
						});
	}
	function usunZawodnika(zid) {
		$(document).ready(function() {
			id = $("#" + zid).attr("id").toLowerCase();
			$(".gracz." + id + " .nazwisko").text('');
			$(".gracz." + id).attr("style", "opacity:0");
			$("#" + zid).remove();
			ukryjOpcje();
		});
	}
	function edytujZawodnika(zid) {
		$(document).ready(function() {
			$("#bramki").val($("#" + zid + " .gol").length);
			$("#sbramki").val($("#" + zid + " .sam").length);
			$("#zk").val($("#" + zid + " .zk").length);
			$("#cz").val($("#" + zid + " .czk").length);
			$("#kontuzja").val($("#" + zid + " .kon").length);
			$("#zaw").val($("#" + zid + " b").text());
			$("#nr").val($("#" + zid + " .nr").text());
			var id = $("#" + zid).attr("id");
			id.length == 2 ? $("#poz").val(id) : $("#poz").val(id.slice(3));
			var id2 = $("#" + zid).attr("class");
			ukryjOpcje();
			var radio = $("input[name='stan']");
			if (id2 == 'zawodnik') {
				radio[0].checked = true;
			} else if (id2 == 'zawodnik zmiana') {
				radio[1].checked = true;
			} else
				radio[2].checked = true;
			radio.button("refresh");
		});
	}
	function pokazOpcje(a, e) {
		$(document)
				.ready(
						function() {
							zaw_id = a.attr("id");
							$("#opcje")
									.html(
											'<a href="javascript:edytujZawodnika(\''
													+ zaw_id
													+ '\')">[Edit] </a><a href="javascript:usunZawodnika(\''
													+ zaw_id
													+ '\')"> [Usuń] </a><a href="javascript:ukryjOpcje()"> [Anuluj]</a>');
							if ($("#opcje").css("display") != 'block')
								$("#opcje").fadeToggle("3000");
							$("#opcje").css( {
								left : e.pageX - 170,
								top : e.pageY - 10
							});
						});
	}
	function ukryjOpcje() {
		$(document).ready(function() {
			$("#opcje").html('');
			$("#opcje").fadeToggle("3000");
		});
	}
	function dodajSklad() {
		$(document).ready(function() {
			$("#news_sklad").focus();
			$("#news_sklad").val($("#sklad_kontener").html());
		});
	}
	function upload() {
		$(document).ready(function() {
			dane = $("#userfile").serialize();
			$.post('upload.php', dane, function(data) {
				$("#userfile").after(data);
			});
		});
	}
	function ENdodajWynik() {
		$(document).ready(
				function() {
					$(".news_wynik_gosp").text($("#gospodarz").val());
					$(".news_wynik_wynik").text(
							$("#ggosp").val() + ':' + $("#ggosc").val());
					$(".news_wynik_gosc").text($("#gosc").val());
				});
	}
	function ENdodajStrzelca(kto) {
		$(document).ready(
				function() {
					br_gosp=$(".news_bramki_gosp .bramka").length;
					br_gosc=$(".news_bramki_gosc .bramka").length;
					br_gosp>=br_gosc?h=60+br_gosp*15:h=60+br_gosc*15;
					$(".news_omeczu").attr("style","height:"+h+"px;")
					if (kto == 'rol') {
						strzelec=$("#strz_rol").val().slice(0,$("#strz_rol").val().indexOf(" "));
						var bramka = '<div class="bramka">' + strzelec+ '</div>';
						$(".news_wynik_gosp").text() == 'Rolnik Skąpa' ? $(".news_bramki_gosp").append(bramka) : $(".news_bramki_gosc").append(bramka);
					} else {
						strzelec=$("#strz_rywal").val();
						var bramka = '<div class="bramka">' + strzelec + '</div>';
						$(".news_wynik_gosp").text() != 'Rolnik Skąpa' ? $(".news_bramki_gosp").append(bramka) : $(".news_bramki_gosc").append(bramka);
					}
				});
	}
	function ENusunStrzelca(kto){
					$(document).ready(
							function(){
								if(kto=='rol' && $(".news_wynik_gosp").text() == 'Rolnik Skąpa')$(".news_bramki_gosp").text('');else 
								if(kto=='rol' && $(".news_wynik_gosc").text() == 'Rolnik Skąpa')$(".news_bramki_gosc").text('');else  
								if(kto!='rol' && $(".news_wynik_gosp").text() != 'Rolnik Skąpa')$(".news_bramki_gosp").text('');else $(".news_bramki_gosc").text(''); 	
								br_gosp=$(".news_bramki_gosp .bramka").length;
								br_gosc=$(".news_bramki_gosc .bramka").length;
								br_gosp>=br_gosc?h=60+br_gosp*15:h=60+br_gosc*15;
								$(".news_omeczu").attr("style","height:"+h+"px;")
							}
					);
	}
	function ENwynikGotowe(){
		$(document).ready(
				function(){
					$("#news_omeczu").focus();
					$("#news_omeczu").html($("#news_omeczu_kontener").html());
				}
		);
	}
	function SbScroll(opcja){
		$(document).ready(
				function(){
					var l=parseInt($("#SbLicz").text());
					var ile=parseInt($("#SbIle").text());
					if(opcja=='start'){
						for(i=ile;i>ile-3;i--){
							$("#SbText"+i).fadeToggle("fast");
							}
						}
						if(opcja=='up'){
							a=ile-l;
							b=ile-l+3;
							$("#SbText"+a).delay(500).fadeToggle("fast");
							$("#SbText"+b).fadeToggle("fast");
						l<=3?l=3:l-=1;
						}
						if(opcja=='down'){
							a=ile-l;
							b=ile-l+3;
							$("#SbText"+a).delay(500).fadeToggle("fast");
							$("#SbText"+b).fadeToggle("fast");
						l>=ile-3?l=ile-3:l+=1;	
						}
						$("#SbLicz").text(l);
				}
		);
	}	
