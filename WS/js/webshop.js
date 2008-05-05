/*
	
	View  functions

*/
	function initImages() 
	{
		if (document.body.filters != null) {		
			//
			// Add transparent PNG
            //
			for(var i = 0; i < document.images.length; i++)
   			{
      				var img = document.images[i];
	      			var imgName = img.src.toUpperCase();

      				if (imgName.substring(imgName.length-3, imgName.length) == "PNG")
      				{	
        	 			var imgID = (img.id) ? "id='" + img.id + "' " : "";
	         			var imgClass = (img.className) ? "class='" + img.className + "' " : "";
         				var imgTitle = (img.title) ? "title='" + img.title + "' " : "title='" + img.alt + "' ";
         				var imgStyle = "display:inline-block;" + img.style.cssText; 
         
				        if (img.align == "left") imgStyle = "float:left;" + imgStyle;
				        if (img.align == "right") imgStyle = "float:right;" + imgStyle;
			
					var strNewHTML = "<span " + imgID + imgClass + imgTitle
         					+ " style=\"" + "width:" + img.width + "px; height:" + img.height + "px;" + imgStyle + ";"
         					+ "filter:progid:DXImageTransform.Microsoft.AlphaImageLoader"
	         				+ "(src=\'" + img.src + "\', sizingMethod='scale');\"></span>";
	         			img.outerHTML = strNewHTML;
					i = i - 1;
				}
	      		}
		}

	}
	Event.observe(window, 'load', initImages, false);
	
	function validateRegistration(f)
	{
		if(validateForm(f)) {
			if(f.f_passwd.value != f.f_passwdd.value) {
				alert("Пароли не совпадают! Пожалуйста, повторите ввод.");
				f.f_passwd.value = "";
				f.f_passwdd.value = "";
				return false; 
			} else {
				return true;
			}
		} else return false;
	}
	
		function GetCookie (name) {
		var arg = name + "=";
		var alen = arg.length;
		var clen = document.cookie.length;
		var i = 0;
  
		while (i < clen) {
    			var j = i + alen;
    			
			if (document.cookie.substring(i, j) == arg)
      				return getCookieVal (j);
    			i = document.cookie.indexOf(" ", i) + 1;
    			if (i == 0) break; 
  		}
  		return null;
	}

	function getCookieVal (offset) {
  		var endstr = document.cookie.indexOf (";", offset);
 
		if (endstr == -1)
    			endstr = document.cookie.length;
  		return unescape(document.cookie.substring(offset, endstr));
	}

	function SetCookie (name, value) {
  		var argv = SetCookie.arguments;
  		var argc = SetCookie.arguments.length;
  		var expires = (argc > 2) ? argv[2] : null;
  		var path = (argc > 3) ? argv[3] : null;
  		var domain = (argc > 4) ? argv[4] : null;
  		var secure = (argc > 5) ? argv[5] : false;

  		document.cookie = name + "=" + escape (value) +
    			((expires == null) ? "" : ("; expires=" + expires.toGMTString())) +
    			((path == null) ? "" : ("; path=" + path)) +
    			((domain == null) ? "" : ("; domain=" + domain)) +
    			((secure == true) ? "; secure" : "");
	}

    function changeMenu(id)
	{ 
 		if(document.getElementById("t" + id).style.display == 'block') {
			document.getElementById("t" + id).style.display = 'none';
			document.getElementById("i" + id).src = '/i/z.gif';
			SetCookie("c" + id, "0");
		} else {
			document.getElementById("t" + id).style.display = 'block';
			document.getElementById("i" + id).src = '/i/s.gif'; 
			SetCookie("c" + id, "1");
		};
	}

    function loadMenu()
	{ 
		var i;
		var a = document.getElementsByClassName('menubtn');

		a.each(function(item) {
			var id = item.getAttribute('number'); 
			var obj = document.getElementById("t" + id);
				
			if(obj) {
				if(GetCookie("c" + id) == "1") changeMenu(id);
			};
		});

	}
	Event.observe(window, 'load', loadMenu, false);
	