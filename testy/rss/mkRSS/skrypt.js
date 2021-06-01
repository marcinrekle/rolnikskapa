$(document).ready(
		function(){
			lewa();
			function lewa(){
				$(document).ready(function(){
					refreshRssMenu();
					$(".rssMenu .arrow").click(function (e) {
						 $(e.target).toggleClass("arrowLeft").toggleClass("arrowDown");
						 var id = $(e.target).parent().attr('id');
						 $("#"+id+"-content").toggleClass("hide");  
					});	

					$(".rssMenu a").click(function (e){
						e.preventDefault();
						var link=$(e.target).attr("href");
						$.post("loadFeeds.php",link,function(data){
							$("#contentRss").html(data);
							addEventRssContent();
						});
					});
					$("#refresh2").click(function(e){
						$.post("index.php");
						$.post("lewa.php",function(data){
							$("#lewa").html(data);
							$("#lewa .cbalink").remove();
						});
						
					});
					$("#refresh").click(function(e){
						refreshRssMenu();
					});
			
				
				});	
			}
			
			function updateRssMenuUnread(data){
				$("#lewa").append(data);	
				$("#lewa .cbalink").remove();
				var json=eval('('+$("#jsonData").html()+')');
				$("#jsonData").remove();
				for(var i in json){
					json[i]>0?$("#"+i).html(" ("+json[i]+")").parent().removeClass("unread").addClass("unread"):$("#"+i).html("").parent().removeClass("unread");
				}
				var licznik=$("#licznik").html();
				parseInt(licznik);
				licznik++;
				$("#licznik").html(licznik);
			}
			function refreshRssMenu(){
				$.ajax({url:"unread.php",
					type:'POST',
					success:updateRssMenuUnread
						});
				setTimeout(function(){refreshRssMenu();},300000);
			};
			function addEventRssContent(){
				$("#contentRss .item").click(function(e){
					var idi=$(this).attr("id");
					$(this).removeClass("read0").removeClass("read1").addClass("read2");
					$.ajax({url:"unread.php",
						cache: false,
						type:'POST',
						data:{act:'updateUnread',id:idi,value:'2'}
							});
				});	
				$("#contentRss .item").mouseover(function(e){
					var idi=$(this).attr("id");
					if($(this).hasClass("read0")){
						$(this).removeClass("read0").addClass("read1");
						$.ajax({url:"unread.php",
							cache: false,
							type:'POST',
							data:{act:'updateUnread',id:idi,value:'1'},
							success:updateRssMenuUnread
								});
					}
				}); 	
			}
});