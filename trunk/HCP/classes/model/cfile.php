<?
	class CFile extends ClassBase
	{
		function CFile($r)
		{
			$this->ClassBase($r);
		}

		function addItem($uc, $pv = '')
		{
			global $db;
						
			$c = array();	
			array_push($c,"title='".$_GET['f_title']."'");
			
			if(strlen($_GET['f_file']) > 1) {
				array_push($c,"filename='".$_GET['f_file']."'");
			} else {
				if(count($pv) > 1)
					array_push($c,"filename='".$pv['filename']."'");
			}
				
			array_push($c,"type='".strtolower(substr($_GET['f_file'], -3, 3))."'");
			array_push($c,"comment='".$_GET['f_comment']."'");

			$r = array();
			$r['title'] = "Файл: ".$_GET['f_title'];
			
			$db->query("INSERT INTO o_file SET ".implode(',', $c));
			$res = $db->query("SELECT id FROM o_file WHERE ".implode(' AND ', $c));
			$r['id'] = $res[0]['id'];

			return $r;
		}

	};

?>