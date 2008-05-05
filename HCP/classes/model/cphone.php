<?
	class CPhone extends ClassBase
	{
		function CPhone($r)
		{
			$this->ClassBase($r);
		}

		function addItem($uc, $pv = '')
		{
			global $db;
						
			$c = array();	
			array_push($c,"country='".$_GET['f_country']."'");
			array_push($c,"area='".$_GET['f_area']."'");
			array_push($c,"number='".$_GET['f_number']."'");
		
			if('on' === $_GET['f_is_cellular']) array_push($c,"is_cellular='1'");
			else array_push($c,"is_cellular='0'"); 

			if('on' === $_GET['f_is_fax']) array_push($c,"is_fax='1'");
			else array_push($c,"is_fax='0'"); 
			
			$r = array();
			$r['title'] = "+".$_GET['f_country']." (".$_GET['f_area'].") ".$_GET['f_number'];

			$db->query("INSERT INTO o_phone SET ".implode(',', $c));
			$res = $db->query("SELECT id FROM o_phone WHERE ".implode(' AND ', $c));
			$r['id'] = $res[0]['id'];

			return $r;
		}

	};

?>