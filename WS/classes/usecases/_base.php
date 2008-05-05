<?		class UseCase	{		var	$user;		var $chart;
				function getUser()		{			return $this->user;		}				function execute()		{			global $session, $db;						$need_auth = false;				$check_cookie = true;			if(isset($_COOKIE['c_logout']) && $_COOKIE['c_logout'] == '1') 				$check_cookie = false;			if(strlen($_POST['AUTH_USER']) > 0 && strlen($_POST['AUTH_PW']) > 0) {				$this->user = new User($_POST['AUTH_USER'],$_POST['AUTH_PW']);				if(is_object($this->user) && $this->user->isValid()) {							$session->set('user',$this->user);				} else {	            			$need_auth = true;				}				if(isset($_POST['REMEMBERME']) && $_POST['REMEMBERME'] == 'on') {					setcookie("c_ruser", $_POST['AUTH_USER'], time() + 2678400);					setcookie("c_rpassword", $_POST['AUTH_PW'], time() + 2678400);				}			} else {
				
				if($session->isRegistered('user')) {					$this->user = $session->get('user');
				}

				if((is_object($this->user) && $this->user->getId() == 0) || !is_object($this->user) ) {										if(isset($_COOKIE['c_ruser']) && isset($_COOKIE['c_rpassword']) && 					   strlen($_COOKIE['c_ruser']) > 0 && strlen($_COOKIE['c_rpassword']) > 0 &&					   $check_cookie) {						$this->user = new User($_COOKIE['c_ruser'], $_COOKIE['c_rpassword']);						if(is_object($this->user) && $this->user->isValid()) {									$session->set('user',$this->user);						}					} else {								if(isset($_GET['USERSM']) && is_numeric($_GET['USERSM'])) {								$id = $_GET['USERSM'];							$ip = getenv("REMOTE_ADDR");							$sessionid = $session->getId();							
							$res =  $db->query("SELECT * FROM sessions WHERE ip='$ip' AND sid='$sessionid' AND tmark > DATE_SUB(now(), INTERVAL 20 MINUTE) AND id_sessions='$id' ORDER BY tmark DESC");							if(count($res) > 0) {																	$this->user = unserialize($res[0]['obj']);
								if(is_object($this->user)) {											$session->set('user',$this->user);
								}							} else {								$need_auth = true;							}													} else {							$need_auth = true;						}					};				};			};			
			
			// print serialize($this->user);
			
			if($session->isRegistered('r_chart') && is_object($session->get('r_chart'))) {
		            	$this->chart = $session->get('r_chart');
			} else {
				$this->chart = new Chart();
				$session->set('r_chart', $this->chart);
			}
			
			if(!$need_auth) {				if(is_object($this->user) && $this->user->isValid()) {
					if($this->user->allow(get_class($this))) 						$p = $this->action(new XMLPage);					else						$p = $this->defaultAction(new XMLPage);					$session->set('user',$this->user);				} else {					$this->user = new User('anonymous','');					$p = $this->defaultAction(new XMLPage);				};				} else {				if(!is_object($this->user)) $this->user = new User('anonymous','');								$p = $this->defaultAction(new XMLPage);			};						$session->set('usecase',$GLOBALS['uc']); 			if(is_object($p)) {				print $p->process("xsl/root.xslt");			};		}		//		// Action functions		//		function action($p)		{			return $this->defaultAction($p);						}		function defaultAction($p)		{			return $this->action($p);		}		function eachPage()		{		   global	$db, $session;						$s = $this->user->getUserInfo();
			$s .= $this->resQuery("SELECT * FROM menu ORDER BY pos", "menu", "item");
			
			if($session->isRegistered("_cat_tree"))
				$s .= $session->get("_cat_tree");
			else { 
				$z .= $this->resQueryStruct("SELECT * FROM categories WHERE enable='1' ORDER BY pos", "categories", "item", "subcat", "id_categories", "i_base");			
				$s .= $z;
				$session->set("_cat_tree", $z);
			}
				
			// print $s;
			// Dirty hack
			// if($GLOBALS['uc'] == 'Registration') $prefix = "https://webshop.ru/";
			// else $prefix = '';
	
			$s .= "<mcurrent>".$prefix.htmlspecialchars("?usecase=".$GLOBALS['uc'].((isset($_GET['id']) && is_numeric($_GET['id'])) ? "&id=".$_GET['id']:""))."</mcurrent>";
			return $s;		}		//		// Common XML functions		//		function pager($total, $begin, $npp, $ppp, $URL, $prefix = '')		{		    if(($total % $npp) > 0) $npages = floor($total / $npp) + 1;	    	else $npages = floor($total / $npp);			    		$begin++;			$cpage = ($begin - ($begin % $npp)) / $npp;   	    		    		$bp = $cpage - $ppp / 2 + 1;    		$ep = $cpage + $ppp / 2;		    	if($bp < 1) { $ep = $ep + (1 - $bp); $bp = 1; }; 		    if($ep > $npages) { $bp = $bp - ($ep - $npages); $ep = $npages; };	    	if($bp < 1 || $ep > $npages || $bp > $ep) { $bp = 1; $ep = $npages; };     			$s = "<pages total='$npages' records='$total'>";	   		if($bp > 1) {				$b = ($bp - 2) * $npp + 1;				$e = ($bp - 1) * $npp;	 	 	        $iurl = $URL."&amp;".$prefix."begin=".($b - 1);				$s .= "<ppage begin='$b' end='$e' URL='$iurl'>&lt;</ppage>";	    	};    	    	for($i = $bp; $i < ($ep + 1); $i++) {				$b = ($i - 1) * $npp + 1;				$e = $i * $npp; 	 	        $iurl = $URL."&amp;".$prefix."begin=".($b - 1);				if($begin >= $b && $begin <= $e) {					$s .= "<cpage begin='$b' end='$e'>$i</cpage>";				} else {					$s .= "<tpage begin='$b' end='$e' URL='$iurl'>$i</tpage>";				};	    	};	    	if($ep < $npages) {				$b = $ep * $npp + 1;				$e = ($ep + 1) * $npp;	 	 	    	$iurl = $URL."&amp;".$prefix."begin=".($b - 1);				$s .= "<npage begin='$b' end='$e' URL='$iurl'>&gt;</npage>";	    	};			$s .= "</pages>";						return $s;		}		function goToUsecase($usecase)		{			global	$db, $session;							header("Set-Cookie: PHPSESSID=" . session_id() . "; path=/");			header("Location: index.php?usecase=$usecase");			print "<html><body><script language='JavaScript'>window.location.href = 'index.php?usecase=$usecase'; </script></body></html>";						$session->commit();			$db->disconnect();						exit();		}				function xmlize($data)		{			$s = '';			if(!is_array($data)) return $s;			foreach($data as $key => $value) {				if(!is_numeric($key)) $k = $key;
				else $k = "field_".$key;
				if(is_array($value)) {
					$s .= "<$k>\n";
					foreach($value as $j => $t) {
						if(is_array($t)) {
							if(is_numeric($j))
								$s .= "<item key='$j'>".$this->xmlize($t)."</item>\n";
							else 
								$s .= "<$j>".$this->xmlize($t)."</$j>\n";	
						} else {
							if(is_numeric($j))
								$s .= "<item key='$j'>".htmlspecialchars($t)."</item>\n";
							else 
								$s .= "<$j>".htmlspecialchars($t)."</$j>\n";	
						}
					}
					$s .= "</$k>\n";
				} else {					$s .= "<$k>".htmlspecialchars($value)."</$k>\n";
				}			};			return $s;		}				function checkValue($a, $name, $default, $ttl, $prefix = "")		{			if(isset($a[$name]) && is_numeric($a[$name])) {				setcookie('c_'.$prefix.'_'.$name,$a[$name],time() + $ttl);						$value = $a[$name]; 			} else if(isset($_COOKIE['c_'.$prefix.'_'.$name])) {				$value = $_COOKIE['c_'.$prefix.'_'.$name]; 			} else $value = $default;			return $value;		}		function mailDocument($to, $subj, $id, $par)		{			global $admin_email, $root_xslt;			$m = new MailMessage($admin_email);			$t = new XMLPage();			$t->add("<maildocument>\n");			$t->add($this->getDocument($id, $par));			$t->add("</maildocument>\n");			$s = $t->process("xsl/root.xslt");			$m->applyInfo($subj, $s);			$m->sendTo($to);					}                                             				function getDocument($id, $par = 0)		{			global $db;			$s = $this->resQuery("SELECT * FROM documents WHERE id='".$id."'", "block", "item");							if(is_array($par)) {				foreach($par as $k => $v) {					$s = str_replace("@$k@", htmlspecialchars($v), $s);				}			};			return $s;		}		function getListFromInput($q, $ra, $id, $value, $prefix)		{				$rq = array();					foreach($ra as $k => $v) {							if(ereg("f_".$prefix."_([0-9]{1,16})",$k,$rg)) {					if(is_numeric($v) && $v > 0) {						for($i = 0; $i < count($q); $i++) {							if($q[$i][$id] == $rg[1]) {								$q[$i][$value] = $v;								array_push($rq, $q[$i]);								break;							}						}					}				}				}			return $rq;		}		function resQuery($q, $d, $sd, $nofilter = true)		{		    global $db;						$s = '';			$res = $db->query($q);			if(count($res) > 0) {				$s .= "<$d>\n";				foreach($res as $r) {					if($nofilter) {						$s .= "\t<$sd>";						$s .= $this->xmlize($r);						$s .= "</$sd>\n";					}				}				$s .= "</$d>\n";			};			return $s;			}		function resQueryStruct($q, $d, $sd, $ssd, $id, $base, $nofilter = false)		{		        global $db;						$s = '';			$res = $db->query($q);			if(count($res) > 0) {				$s .= "<$d>";				$s .= $this->resQueryStructIter($res, 0, 1, $sd, $ssd, $id, $base, $nofilter);				$s .= "</$d>";			};			return $s;			}		function resQueryStructIter($res, $par, $k, $sd, $ssd, $id, $base, $nofilter)		{	        	global $db;						if($k > 1000) return;			foreach($res as $r) {				if($r[$base] == $par) {					$s .= "\n<$sd level='$k' sid='$sid'>";					$s .= $this->xmlize($r);					$x = $this->resQueryStructIter($res, $r[$id], $k + 1, $sd, $ssd, $id, $base, $sid);					if(strlen($x) > 0) 						$s .= "\n\t<$ssd>".$x."</$ssd>\n";					$s .= "</$sd>";				};			};			return $s;			}		//		// Specials : )		//						function userGetLogin()		{			return $this->user->getLogin();		}		function userGetInfo()		{						return $this->user->getUserInfo();		}	}?>