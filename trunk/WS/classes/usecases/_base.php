<?
		
				
				if($session->isRegistered('user')) {
				}

				if((is_object($this->user) && $this->user->getId() == 0) || !is_object($this->user) ) {					
							$res =  $db->query("SELECT * FROM sessions WHERE ip='$ip' AND sid='$sessionid' AND tmark > DATE_SUB(now(), INTERVAL 20 MINUTE) AND id_sessions='$id' ORDER BY tmark DESC");
								if(is_object($this->user)) {		
								}
			
			// print serialize($this->user);
			
			if($session->isRegistered('r_chart') && is_object($session->get('r_chart'))) {
		            	$this->chart = $session->get('r_chart');
			} else {
				$this->chart = new Chart();
				$session->set('r_chart', $this->chart);
			}
			
			if(!$need_auth) {
					if($this->user->allow(get_class($this))) 
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
			return $s;
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
				} else {
				}