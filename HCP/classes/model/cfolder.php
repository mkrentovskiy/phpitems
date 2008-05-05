<?
	class CFolder extends ClassBase
	{
		function CFolder($r)
		{
			$this->ClassBase($r);
		}

		function addItem($uc, $pv = '')
		{
			global $db;
						
			$c = array();	
			array_push($c,"name='".$_GET['f_name']."'");
			array_push($c,"color='".$_GET['f_color']."'");
			array_push($c,"tmark='".date("Y-m-d H:i:s")."'");

			$r = array();
			$r['title'] = "Папка: ".$_GET['f_name'];

			$db->query("INSERT INTO o_folder SET ".implode(',', $c));
			$res = $db->query("SELECT id FROM o_folder WHERE ".implode(' AND ', $c));
			$r['id'] = $res[0]['id'];

			return $r;
		}

	};

?>