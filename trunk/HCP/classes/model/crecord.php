<?
	class CRecord extends ClassBase
	{
		function CRecord($r)
		{
			$this->ClassBase($r);
		}


		function addItem($uc, $pv = '')
		{
			global $db;
						
			$c = array();	
			array_push($c,"title='".$_GET['f_title']."'");
			array_push($c,"comment='".$_GET['f_comment']."'");
			
			if(strlen($_GET['f_file']) > 1) {
				array_push($c,"filename='".$_GET['f_file']."'");
			} else {
				if(count($pv) > 1)
					array_push($c,"filename='".$pv['filename']."'");
			}
			
			$r = array();
			$r['title'] = "Запись: ".$_GET['f_title'];
			
			$db->query("INSERT INTO o_record SET ".implode(',', $c));
			$res = $db->query("SELECT id FROM o_record WHERE ".implode(' AND ', $c));
			$r['id'] = $res[0]['id'];

			return $r;
		}

	};

?>