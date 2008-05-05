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

			//
			// PPNG background
			//

			if($("project") != null)
				$("project").style.background = "none"; 		
			if($("person") != null)
				$("person").style.background = "none"; 		
			if($("company") != null)
				$("company").style.background = "none"; 		

			if($("enter") != null)
				$("enter").style.background = "none"; 		

			if($("add") != null)
				$("add").style.background = "none"; 		
			if($("filter") != null)
				$("filter").style.background = "none"; 		
		}

	}


	Event.observe(window, 'load', initImages, false);

	function showHide(listid)
	{
		obj = $(listid + 'listitem');

		if(obj) {
			if(obj.style.display == 'none') {
				obj.style.display = 'block';
			} else {
				new Effect.Fade(obj, { duration: 1, from: 1.0, to: 0.0 });      						
			}
		}	
	}

	
/*

	AJAX functions

*/

	function showClassAddForm(fe)
	{
		if(fe.value.length > 0) {
			$("af_loader").src = "i/loading.gif";			
			fe.disabled = true;

			var url = "index.php";
			var pars = "usecase=ShowClassAddForm&id=" + escape(fe.value);
			var target = "addformitem";
			var myAjax = new Ajax.Updater(target, url, { 
				method: 'get', 
				parameters: pars,
				onComplete: function() { showClassAddFormCallback(); } 
			});
		}		
	}

	function showClassAddFormCallback()
	{
		switch($("_class").value) {
        	case 'person': 
				buildAutocomplete('i_title');
				break;

        	case 'address': 
				buildAutocomplete('i_state');
				buildAutocomplete('i_region');
				buildAutocomplete('i_city');
				buildAutocomplete('i_street');
				break;

        	case 'bill': 
				buildAutocomplete('i_bank');
				buildAutocomplete('i_corbill');
				buildAutocomplete('i_bik');
				break;

			case 'task':
   				new Control.Slider('i_pc_item','i_pc_bg',{
					sliderValue: [0,100], 
					range:$R(0,100),
      				onSlide: function(v) { $('i_pc').value = Math.round(v); $('i_pc_value').innerHTML = Math.round(v) + '%'; $('i_pc_track').style.width = Math.round(v) + '%'; },
      				onChange: function(v) { $('i_pc').value = Math.round(v); $('i_pc_value').innerHTML = Math.round(v) + '%'; $('i_pc_track').style.width = Math.round(v) + '%'; }
				});
				break;
		}
		
		$("af_loader").src = "i/spacer.gif";			
		$("_class").disabled = false;
	}

	function buildAutocomplete(name) 
	{
		var values = new Array();
		
		var list = $(name + '_list');

		if(list == null) return;

		var j = 0;
		for (var i = 0; i < list.childNodes.length; i++) {
			if(list.childNodes.item(i).nodeName == "LI") {
				values[j] = list.childNodes.item(i).childNodes[0].nodeValue;
				j++;
			}
        }

		new Autocompleter.Local(name, name + '_ac', values);					
	}

	function addObject(f)
	{
	    var isFileTransfer = false;
		
		if(validateForm(f)) {
			var iClass = $("_class").value;
			var iPID = $("_pid").value;
		
			$("afi_button").disabled = true;
			$("afi_loader").src = "i/loading.gif";	
			
			//
			// Check extra per class dependencies
			//

			switch(iClass) {
				case 'note': 
					var oEm = FCKeditorAPI.GetInstance('f_note') ;
					oEm.UpdateLinkedField();
					break;

				case 'file':
				case 'image':
				case 'record':
					$('i_frame_file').contentDocument.forms[0].submit();
					isFileTransfer = true;
	                break;
			}
			
	        if(isFileTransfer) return;
			
			var url = "index.php";
			var pars = "usecase=AddObject&_pid=" + iPID + "&_class=" + escape(iClass) + "&" + Form.serialize(f);
	
			var target = iClass + "list";
			var myAjax = new Ajax.Updater(target, url, { 
				method: 'get', 
				parameters: pars, 
				evalScripts: true,
				asynchronous: true 
			});
		
			//
			// Clear form			
			//
			
			Form.reset(f);
			
			switch(iClass) {
				case 'note': 
					var oEm = FCKeditorAPI.GetInstance('f_note') ;
					oEm.EditorDocument.body.innerHTML = "&nbsp;";
					break;

				case 'task':
					$('i_pc').value = 0; 
					$('i_pc_value').innerHTML = '0%'; 
					$('i_pc_track').style.width = '0%';
					$('i_pc_item').style.left = '0px';
					break;
			}

			$("afi_loader").src = "i/spacer.gif";
			$("afi_button").disabled = false;
		}
	}

	function fileTransferCallback(uf)
	{
		var iClass = $("_class").value;
		var iPID = $("_pid").value;

		var url = "index.php";
		var pars = "usecase=AddObject&_pid=" + iPID + "&_class=" + escape(iClass) + "&" + Form.serialize($('classAddForm'));		
		var target = iClass + "list";

		if(uf.length > 0) {
			var i;

			for(i = 0; i < uf.length; i++)
				pars = pars + '&' + uf[i][0] + '=' + escape(uf[i][1]);				

			var myAjax = new Ajax.Updater(target, url, { 
				evalScripts: true,
				method: 'get', 
				parameters: pars, 
				asynchronous: true, 
				onComplete: function() { 
					Form.reset($('classAddForm'));	
					$('i_frame_file').src = '?usecase=uploadFile&name=file&target=file';
				
					$("afi_loader").src = "i/spacer.gif";
					$("afi_button").disabled = false;	
				},
				onFailure: function() { 
					$("afi_loader").src = "i/spacer.gif";
					$("afi_button").disabled = false;	
				} 
			} );
		}
	}	

	function setProjectState(pid, state)
	{
		var url = "index.php";
		var pars = "usecase=SetProjectState&id=" + escape(pid) + "&state=" + escape(state);
		var target = "prs" + pid;
		var myAjax = new Ajax.Updater(target, url, { 
			method: 'get', 
			parameters: pars, 
			asynchronous: true 
		});
	}

/*

	Control form

*/
	function getControlForm(oid)
	{
		obj = $('i' + oid);
		
		if(obj) {
			obj.innerHTML = "<div style='padding: 20px;'><img src='i/loading.gif'/></div>";			
		
			var url = "index.php";
			var pars = "usecase=ShowControlForm&oid=" + oid;			
			var target = 'i' + oid;
			var myAjax = new Ajax.Updater(target, url, { 
				evalScripts: true,
				method: 'get', 
				parameters: pars, 
				asynchronous: true, 
				insertion: Insertion.After,
				onComplete: function() { 
					obj.remove();
					getControlFormCallback($('_form_' + oid)); 
				} 
			});
		}		
	}

	function getControlFormCallback(f)
	{
		var iClass = f['_class'].value;
		var id = f['_oid'].value;
		
		switch(iClass) {
				case 'person': 
					buildAutocomplete('i_title' + id);
					break;

        		case 'address': 
					buildAutocomplete('i_state' + id);
					buildAutocomplete('i_region' + id);
					buildAutocomplete('i_city' + id);
					buildAutocomplete('i_street' + id);
					break;

        		case 'bill': 
					buildAutocomplete('i_bank' + id);
					buildAutocomplete('i_corbill' + id);
					buildAutocomplete('i_bik' + id);
					break;

				case 'task':
					var v = f['i_pc' + id].value;
					
					var sl = new Control.Slider('i_pc'+ id +'_item','i_pc' + id + '_bg',{
						sliderValue: [0,100], 
						range:$R(0,100),
      					onSlide: function(v) { 
      						$('i_pc' + id).value = Math.round(v); 
      						$('i_pc' + id + '_value').innerHTML = Math.round(v) + '%'; 
      						$('i_pc' + id + '_track').style.width = Math.round(v) + '%'; 
      					},
      					onChange: function(v) { 
      						$('i_pc' + id).value = Math.round(v); 
      						$('i_pc' + id + '_value').innerHTML = Math.round(v) + '%'; 
      						$('i_pc' + id + '_track').style.width = Math.round(v) + '%'; 
      					}
					});
		
					sl.setValue(v);					
					break;
		}		
	}



	function commitItem(f, oid)
	{
	    var isFileTransfer = false;
		
		if(validateForm(f)) {
			var iClass = f["_class"].value;
		
			$("cui-" + oid + "-button").disabled = true;
			$("cui-" + oid + "-loader").src = "i/loading.gif";	
			
			//
			// Check extra per class dependencies
			//

			switch(iClass) {
				case 'note': 
					var nl = f['_note_link'].value;
					var oEm = FCKeditorAPI.GetInstance('f_note' + nl) ;
					oEm.UpdateLinkedField();
					break;

				case 'file':
				case 'image':
				case 'record':
					$('i_frame_file' + oid).contentDocument.forms[0].submit();
					isFileTransfer = true;
	                break;
			}
			
	        if(isFileTransfer) return;
			
			var url = "index.php";
			var pars = "usecase=CommitItem&" + Form.serialize(f);
			var target = "cf" + oid;
			
			var myAjax = new Ajax.Updater(target, url, { 
				evalScripts: true,
				method: 'get', 
				parameters: pars, 
				evalScripts: true,
				asynchronous: true,
				insertion: Insertion.After,
				onComplete: function() { 
					var ne = $('cf' + oid).next();
					var re = new RegExp('cf([0-9]*)', "g");
					var i = re.exec(ne.id);
					var nfn = '_form_' + i[1];
					
					getControlFormCallback($(nfn)); 
					$('cf' + oid).remove();
				},
				onFailure: function() { 
					$("cui-" + oid + "-button").disabled = false;
					$("cui-" + oid + "-loader").src = "i/spacer.gif";	
				} 
			});
		}
	}

	function fileTransferCommitCallback(uf, oid)
	{
		var f = $('_form_' + oid);
		var pars = "usecase=CommitItem&" + Form.serialize(f);
	
		if(uf.length > 0) {
			var i;

			for(i = 0; i < uf.length; i++)
				pars = pars + '&' + uf[i][0] + '=' + escape(uf[i][1]);				
		}

		var url = "index.php";
		var target = "cf" + oid;
			
		var myAjax = new Ajax.Updater(target, url, { 
			evalScripts: true,
			method: 'get', 
			parameters: pars, 
			evalScripts: true,
			asynchronous: true,
			insertion: Insertion.After,
			onComplete: function() { $('cf' + oid).remove(); },
			onFailure: function() { 
				$("cui-" + oid + "-button").disabled = false;
				$("cui-" + oid + "-loader").src = "i/spacer.gif";	
			} 
		});
	}	

	function copyItem(id, ctl)
	{
		if(ctl.value != '0') {
			ctl.disabled = true;

			var url = "index.php";
			var pars = "usecase=CopyObjectItem&oid=" + id + "&pid=" + ctl.value;			
			var target = 'cui-' + id + '-sel';
			var myAjax = new Ajax.Updater(target, url, { 
				evalScripts: true,
				method: 'get', 
				parameters: pars, 
				asynchronous: true, 
				onComplete: function() { 
					$('cui-' + id + '-cc').style.display = 'block';
					new Effect.Fade($('cui-' + id + '-cc'), { duration: 4, from: 1.0, to: 0.0 }); 
				}
			});		
			ctl.disabled = false;			
		}

	}

	function deleteItem(id)
	{
		if($('cd-' + id).checked) {
			obj = $('cf' + id);
		
			if(obj) {
				obj.innerHTML = "<div style='padding: 20px;'><img src='i/loading.gif'/></div>";			
		
				var url = "index.php";
				var pars = "usecase=DeleteObjectItem&oid=" + id;			
				var target = 'cf' + id;
				var myAjax = new Ajax.Updater(target, url, { 
					evalScripts: true,
					method: 'get', 
					parameters: pars, 
					asynchronous: true, 
					insertion: Insertion.After,
					onComplete: function() { new Effect.Fade(obj, { duration: 1, from: 1.0, to: 0.0 }); }
				});
			}	
		} else {
			new Effect.Pulsate($('cdi-' + id));
		}
	}

	// Interface
	function controlMenuSelected(id, num)
	{
		switch(num) {
			case(1):
				cmCloseAll(id);
				$('v_' + id).className = 'cnlactive';
				$('l-' + id + '-1').style.display = 'block';
				break;
			case(2):
				cmCloseAll(id);
				$('e_' + id).className = 'cnlactive';
				$('l-' + id + '-2').style.display = 'block';
				break;
			case(3):
				cmCloseAll(id);
				$('o_' + id).className = 'cnlactive';
				$('l-' + id + '-3').style.display = 'block';
				break;
			case(4):
				getObjectItem(id);
				break;			
		}
	}

	function cmCloseAll(id)
	{
		$('v_' + id).className = '';
		$('e_' + id).className = '';
		$('o_' + id).className = '';

		if($('l-' + id + '-1').style.display != 'none') 
			$('l-' + id + '-1').style.display = 'none';
		if($('l-' + id + '-2').style.display != 'none') 
			$('l-' + id + '-2').style.display = 'none';
		if($('l-' + id + '-3').style.display != 'none') 
			$('l-' + id + '-3').style.display = 'none';
	}	

	function getObjectItem(id)
	{
		obj = $('cf' + id);
		
		if(obj) {
			obj.innerHTML = "<div style='padding: 20px;'><img src='i/loading.gif'/></div>";			
		
			var url = "index.php";
			var pars = "usecase=ShowObjectItem&oid=" + id;			
			var target = 'cf' + id;
			var myAjax = new Ajax.Updater(target, url, { 
				evalScripts: true,
				method: 'get', 
				parameters: pars, 
				asynchronous: true, 
				insertion: Insertion.After,
				onComplete: function() { obj.remove(); }
			});
		}		
	}

/*

	Documents

*/	
	function getDocumentSubform(value) 
	{}

	function getRepeatSubform(value)
	{}
	
	function checkDocumentLinkTo(value)
	{}

	function addDocument(f)
	{}


/*

	Scheduler

*/
	
	function moveTask(id)
	{
		if($('_move_' + id).visible()) {
			$('_move_' + id).hide();
		} else {
			$('_move_' + id).show();
		} 
	}

	function moveTaskTo(f, id)
	{
		if(validateForm(f)) {
			$('taskpanelitem').innerHTML = "<div style='padding: 20px;'><img src='i/loading.gif'/></div>";			
		
			var url = "index.php";
			var pars = "usecase=MoveTask&id=" + id + '&tm=' + escape(f['f_moveto'].value);			
			var target = 'taskpanelitem';
			var myAjax = new Ajax.Updater(target, url, { 
				evalScripts: true,
				method: 'get', 
				parameters: pars, 
				asynchronous: true
			});
		}		
	}

	function removeTask(id)
	{
		obj = $('taskpanelitem');
		
		if(obj) {
			obj.innerHTML = "<div style='padding: 20px;'><img src='i/loading.gif'/></div>";			
		
			var url = "index.php";
			var pars = "usecase=RemoveTask&id=" + id;			
			var target = 'taskpanelitem';
			var myAjax = new Ajax.Updater(target, url, { 
				evalScripts: true,
				method: 'get', 
				parameters: pars, 
				asynchronous: true
			});
		}		
	}
	