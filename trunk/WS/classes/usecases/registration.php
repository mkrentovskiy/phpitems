<?	class UCRegistration extends UseCase 	{		function defaultAction($p)		{			$p->add("<document>");			$p->add($this->eachPage());						$s = '<registration>';				if(isset($_POST['f_login']) && strlen($_POST['f_login']) > 0) {				$r['login'] = strip_tags($_POST['f_login']);				$r['passwd'] = strip_tags($_POST['f_passwd']);
				$r['passwdd'] = strip_tags($_POST['f_passwdd']);
				$r['name'] = strip_tags($_POST['f_name']);
				$r['mail'] = strip_tags($_POST['f_mail']);
				$r['phone'] = strip_tags($_POST['f_phone']);
				$r['ip'] = getenv("REMOTE_ADDR");				$r['activation_code'] = md5(uniqid(rand(), true));				if($this->checkLogin($r['login'])) {					$s .= $this->getDocument('login_invalid');					$s .= "<values>".$this->xmlize($r)."</values>";				} else {					$this->mailDocument($r['mail'], "[WebShop] Регистрация в интернет-магазине", 'mail_registration', $r);					$this->addUser($r);					$s .= "<relocate><url>?usecase=Registration&amp;id=1</url></relocate>";				};			} else {				if(isset($_GET['id'])) {										$s .= $this->getDocument('registration_done');				} else {					$s .= $this->getDocument('registration_info');				}			}			$s .= '</registration>';				$p->add($s);			$p->add("</document>");			return $p;		}		function action($p)		{				$s = $this->eachPage();			$s .= $this->getDocument('reply_already_registered');				$p->add("<document>".$s."</document>");			return $p;		}				function checkLogin($login)		{						global $db;			if(ereg("([A-Za-z0-9]*)", $login, $rg)) {				        $login = $rg[1];								if(strlen($login) > 1) {					$res = $db->query("SELECT * FROM r_user WHERE login='$login'");							if(count($res) > 0) return true;					else return false;				} else return true;			} else return true;		}		function checkPassword($p1, $p2)		{						if(ereg("([A-Za-z0-9]*)", $p1, $rg)) {				$p1 = $rg[1];										if(strlen($p1) >= 6 && strlen($p1) == strlen($p2) && !strcmp($p1, $p2) ) {			    	return false;				} else return true;			} else return true;		}		function addUser($r)		{			global $db;												$res = $db->query("INSERT INTO r_user SET name='$r[name]', mail='$r[mail]', phone='$r[phone]', login='$r[login]', passwd='$r[passwd]', enable='0', activation_code='$r[activation_code]', in_group='1', tmark=NOW(), ip='$r[ip]', price='c'");		}               	}?>