<?
				$r['passwdd'] = strip_tags($_POST['f_passwdd']);
				$r['name'] = strip_tags($_POST['f_name']);
				$r['mail'] = strip_tags($_POST['f_mail']);
				$r['phone'] = strip_tags($_POST['f_phone']);
				$r['ip'] = getenv("REMOTE_ADDR");