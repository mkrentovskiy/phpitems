<?
	class CNote extends ClassBase
	{
		function CNote($r)
		{
			$this->ClassBase($r);
		}

		function showAddForm($uc, $r = '')
		{
			if(count($r) > 1) {
				global $db;
				
				$res = $db->query("SELECT note FROM o_note WHERE id='".$r['link']."'");
				$value = $res[0]['note'];
			}
			
		 	$s = implode('', file("xml/".$this->id.".xml"));
			$s .= $this->emNote("f_note".$r['link'], $value);
			return $s;			
		}

		function addItem($uc, $pv = '')
		{
			global $db;
					
			$a = $uc->userGetInfo();	

			$c = array();	
			$nn = 'f_note' . $pv['id'];

			array_push($c,"note='".$_GET[$nn]."'");
			array_push($c,"author='".$a['name']."'");
			array_push($c,"tmark='".date("Y-m-d H:i:s")."'");
			
			
			$db->query("INSERT INTO o_note SET ".implode(',', $c));
			$res = $db->query("SELECT id FROM o_note WHERE ".implode(' AND ', $c));
			
			$r = array();
			$r['id'] = $res[0]['id'];

			return $r;
		}

	};

?>