/*
	
	View  functions

*/
	function initImages() 
	{
		if (document.body.filters != null) {		
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
					var imgOnClick = img.onClick;         

				        if (img.align == "left") imgStyle = "float:left;" + imgStyle;
				        if (img.align == "right") imgStyle = "float:right;" + imgStyle;
			
					var strNewHTML = "<span " + imgID + imgClass + imgTitle
						+ " onClick=\"" + imgOnClick + "\""
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


	function editAlias(ip)
	{
		var obj = $('i_alias_' + ip);
		
		if(obj && $('i_alias_' + ip + '_ip') && 
			$('i_alias_' + ip + '_name')) {
			var	form = $('_hidden_form_alias').innerHTML;
			var ip = $('i_alias_' + ip + '_ip').innerHTML;
			var name = $('i_alias_' + ip + '_name').innerHTML;
		
			form = form.replace(/_ip_/g, ip);
			form = form.replace(/_name_/g, name);
			
			obj.style.background = '#efe';
			obj.style.padding = '12px';
			obj.style.cursor = 'default';
			
			obj.onClick = function () {};
			
			obj.innerHTML = form;
		} 
	}
	
	function commitAlias(f)
	{
		if(validateForm(f))
		{
			$('addLoading').src = 'i/loading.gif';
			var pars = "usecase=CommitAlias&" + $(f.id).serialize();
			
			var myAjax = new Ajax.Updater('iAliases', 'index.php', { 
				method: 'get', 
				parameters: pars,
				onComplete: function() { $('addLoading').src = 'i/spacer.gif'; } 
			});
		}
		return false;
	}
	
	function deleteAlias(ip)
	{
		if(confirm('Вы действительно хотите удалить эту запись?')) {
			$('addLoading').src = 'i/loading.gif';
			var pars = "usecase=DeleteAlias&f_ip=" + ip;
			var myAjax = new Ajax.Updater('null', 'index.php', { 
					method: 'get', 
					parameters: pars,
				onComplete: function() { $('i_alias_' + ip).remove(); $('addLoading').src = 'i/spacer.gif'; } 
			});
		}	
	}
	
	function addAlias(f)
	{
		if(validateForm(f))
		{
			$('addLoading').src = 'i/loading.gif';
			var pars = "usecase=AddAlias&" + $(f.id).serialize();
			var myAjax = new Ajax.Updater('iAliases', 'index.php', { 
				method: 'get', 
				parameters: pars,
				onComplete: function() { f.reset(); $('addLoading').src = 'i/spacer.gif'; } 
			});
		}
		return false;		
	}


	function select(ip)
	{
		$('entry_' + ip).className = 'ss';
	}
	
	function unselect(ip)
	{
		$('entry_' + ip).className = $('entry_' + ip).getAttribute('dclass');		
	}
	