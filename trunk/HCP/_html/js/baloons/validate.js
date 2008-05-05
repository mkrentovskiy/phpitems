// (C) Netlogic, 2003

function ValidateForms() {
	for (i = 0; i < document.forms.length; i++) {
		if(document.forms[i].onsubmit) continue;

		document.forms[i].onsubmit = function(e) {
			var form = e ? e.target : window.event.srcElement;

			for(var i=0; i<form.elements.length; i++) {
				var value = form.elements[i].value;
				var mb = form.elements[i].getAttribute('mustbe');
			
				switch(form.elements[i].type) {
					case 'text':
					case 'password':
					case 'textarea':
						pattern = form.elements[i].getAttribute('pattern');

						if(pattern) {
							switch(pattern) {
								case 'string':
									if(!value.length && mb == "1") {
										return ValidateNotice(form.elements[i]);
									}
									break;
	
								case 'integer':
									if(!isInteger(value, mb)) {
										return ValidateNotice(form.elements[i]);
									}
									break;

								case 'float':
									if(!isFloat(value, mb)) {
										return ValidateNotice(form.elements[i]);
									}
									break;

								case 'url':
									if(!isUrl(value, mb)) {
										return ValidateNotice(form.elements[i]);
									}
									break;

								case 'email':
									if(!isEmail(value, mb)) {
										return ValidateNotice(form.elements[i]);
									}
									break;

								default:	
									if(!isPattern(pattern, value, mb)) {
										return ValidateNotice(form.elements[i]);
									}
									break;
							}
						}
						break;

					case 'radio':
					case 'checkbox':
						min = form.elements[i].getAttribute('min') ? form.elements[i].getAttribute('min') : 0;
						max = form.elements[i].getAttribute('max') ? form.elements[i].getAttribute('max') : document.getElementsByName(form.elements[i].getAttribute('name')).length;

						if(min || max) {
							var items = document.getElementsByName(form.elements[i].getAttribute('name'));
							var count = 0;

							for(var l=0; l<items.length; l++){
								if(items[l].checked) {
									count++;
								}
							}

							if((count < min || count > max) && mb == "1") {
								return ValidateNotice(form.elements[i]);
							}
						}
						break;

					case 'select-one':
					case 'select-multiple':
						selected = form.elements[i].options[form.elements[i].selectedIndex];
						if(selected && selected.getAttribute('notselected') && mb == "1") {
							return ValidateNotice(form.elements[i]);
						}
						break;

						break;

					case 'file':
						break;

					case 'image':
					case 'button':
					case 'submit':
					case 'reset':
						break;

					default:
						break;
				}
			}

			return true;
		}
	}

}

function isUrl(str, mb) {
	return isPattern("^https?:\\/\\/(?:[a-z0-9_-]{1,32}(?::[a-z0-9_-]{1,32})?@)?(?:(?:[a-z0-9-]{1,128}\\.)+(?:com|net|org|mil|edu|arpa|gov|biz|info|aero|inc|name|[a-z]{2})|(?!0)(?:(?!0[^.]|255)[0-9]{1,3}\\.){3}(?!0|255)[0-9]{1,3})(?:\\/[a-z0-9.,_@%&?+=\\~\\/-]*)?(?:#[^ '\"&<>]*)?$", str.toLowerCase());
}

function isNumeric(str, mb) {
	return isPattern("^[0-9]+$", str, mb);
}

function isInteger(str, mb) {
	return isNumeric(str, mb);
}

function isFloat(str, mb) {
	return isPattern("^[1-9]?[0-9]+(\\.[0-9]+)?$", str, mb);
}

function isEmail(str, mb) {
	return isPattern("^([a-z0-9_-]+)(\\.[a-z0-9_-]+)*@((([a-z0-9-]+\\.)+(com|net|org|mil|edu|gov|arpa|info|biz|inc|name|[a-z]{2}))|([0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}))$", str.toLowerCase(), mb);
}

function isPattern(pattern, str, mb) {
	if(str.length && pattern.length) {
		var re = new RegExp(pattern, "g");
		return re.test(str);
	}
	if(mb == "1") {  
		return false;
	} else {
		return true;
	}
}

function ValidateNotice(input) {
	ShowBaloon(input);
	return false;
}

Event.observe(window, 'load', ValidateForms, false);
Event.observe(window, 'load', CreateBaloon, false);