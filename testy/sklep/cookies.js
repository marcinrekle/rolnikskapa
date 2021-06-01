function addLoadEvent() {
	var oldonload = window.onload;
	
	if (typeof window.onload != 'function') {
		window.onload = cookiesAccept;
	} else {
		window.onload = function() {
			if (oldonload) { oldonload(); }
			cookiesAccept();
		}
	}
} 

addLoadEvent();

function cookiesAccept() {

	checkCookie();

	function getCookie(c_name) {
		var i, x, y, ARRcookies = document.cookie.split(";");
		
		for (i = 0; i < ARRcookies.length; i++) {
			x = ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
			y = ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
			x = x.replace(/^\s+|\s+$/g,"");
			if (x == c_name) { return unescape(y); }
		}
	}
	
	function setCookie() {
		var exdate = new Date();
		exdate.setDate(exdate.getDate() + 365);
		var c_value = escape('1') + ((365==null) ? "" : "; expires=" + exdate.toUTCString());
		document.cookie = 'cookies_info' + "=" + c_value;
		
		document.getElementById('cookie_info').style.display = 'none';
	}
	
	function checkCookie() {
		var cookies_info = getCookie("cookies_info");
		if (cookies_info == null || cookies_info == "") { 
		
			var cookiesContainer = document.createElement("div");
				cookiesContainer.setAttribute("id", "cookie_info");
				cookiesContainer.innerHTML = '<div class="user_information"><div class="options"><a href="http://wszystkoociasteczkach.pl" title="Dowiedz się więcej o polityce plików "cookies" portalu Fuertigo.pl">Dowiedz się więcej</a><a id="close_info_cookie">x</a></div>Ta strona używa ciasteczek. Dowiedz się więcej o celu ich używania<br /> i możliwości zmiany ustawień w przeglądarce.</div>';
			
			document.getElementsByTagName("body").item(0).appendChild(cookiesContainer);
			
			var newlink = document.createElement("style");
				newlink.setAttribute("rel", "stylesheet");
				newlink.setAttribute("type", "text/css");
				css="#cookie_info{ z-index:999; position:fixed; bottom:0; width:100%; left:0; height:80px; background:rgba(70, 113, 213,.8); border-top:1px solid rgba(70, 113, 213,1)} .user_information{width:810px; margin:0 auto; margin-top:20px; text-align: left !important; font-size:16px !important; padding-right:30px; padding-left:120px; color:white !important} .user_information:before{content:' '; display:block; padding:40px; width:65px; height:42px; background-repeat:no-repeat; background-image:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADcAAAArCAYAAADczxCmAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyRpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoTWFjaW50b3NoKSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDpENkJCMUM5ODhFODQxMUUyOTc4QzhBREJBODY5QzUzMyIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDpENkJCMUM5OThFODQxMUUyOTc4QzhBREJBODY5QzUzMyI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOkQ2QkIxQzk2OEU4NDExRTI5NzhDOEFEQkE4NjlDNTMzIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOkQ2QkIxQzk3OEU4NDExRTI5NzhDOEFEQkE4NjlDNTMzIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+a32zCQAAD0FJREFUeNrsWmuM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); background-size:55px 43px; position:absolute; margin-left:-85px} .options{float:right; margin-top:10px} .options a{margin-right:15px;color:white;} .options #close_info_cookie:hover{cursor:pointer} .options #close_info_cookie { float:right; color: transparent; text-shadow: none; margin-top: 3px } #close_info_cookie:before { content: ' '; width: 16px; height: 16px; display: block; color: transparent; padding: 8px; background-repeat: no-repeat; background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAA6ElEQVR42tVX2w3DIAxkhI6QESKxCCNkFEbJKIyQUbwBxRIIqU6CcdSeauk+IpvcgXnYTmve+7UgFqQCKsgfoOqLHOvMJolD/XGeROKxT4iXIbFeyGKZNT0ilukJWvLNQKDFppl5/jLCXc7pBwLodE+YNpwdCbD0AsEy+73guPGzb1evQrvhtOQ1/nUh4mAfx0yIWDk46si7dRGSnG1CRFQtfyeQIga+cRra0TOLsJMzyLUPqwgbeUcXYBYhyf9KADwF8E0IP4bwiwh+FUMfI/hzDC5I8CUZvijFl+X4xgTfmuGbU3h7/gZr6ab9CbsVbQAAAABJRU5ErkJggg==); background-size: 16px 16px;}";if(newlink.styleSheet && !newlink.sheet) newlink.styleSheet.cssText=css; else newlink.appendChild(document.createTextNode(css));
			
			document.getElementsByTagName("head").item(0).appendChild(newlink);
			
			var element = document.getElementById('close_info_cookie');
			
			if (element.addEventListener) { element.addEventListener('click', function() { setCookie() } , false); }
			else if (element.attachEvent) { element.attachEvent('onclick', function() { setCookie() }); }
		
		}
	}
	
}