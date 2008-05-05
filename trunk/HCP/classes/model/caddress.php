<?
	class CAddress extends ClassBase
	{
		function CAddress($r)
		{
			$this->ClassBase($r);
		}

		function showAddForm($uc)
		{
		 	$s = implode('', file("xml/address.xml"));

			// Autocomplete data sets
			$s .= $uc->resQuery("SELECT state AS value FROM o_address GROUP BY state ORDER BY state", 'state', 'item', true);
			$s .= $uc->resQuery("SELECT region AS value FROM o_address GROUP BY region ORDER BY region", 'region', 'item', true);
			$s .= $uc->resQuery("SELECT city AS value FROM o_address GROUP BY city ORDER BY city", 'city', 'item', true);
			$s .= $uc->resQuery("SELECT street AS value FROM o_address GROUP BY street ORDER BY street", 'street', 'item', true);
			return $s;			
		}

		function addItem($uc, $pv = '')
		{
			global $db;
						
			$c = array();	
			array_push($c,"zip='".$_GET['f_zip']."'");
			array_push($c,"state='".$_GET['f_state']."'");
			array_push($c,"region='".$_GET['f_region']."'");
			array_push($c,"city='".$_GET['f_city']."'");
			array_push($c,"street='".$_GET['f_street']."'");
			array_push($c,"house='".$_GET['f_house']."'");
			array_push($c,"flat='".$_GET['f_flat']."'");
			array_push($c,"comment='".$_GET['f_comment']."'");
			
			$r = array();
			$r['title'] = iconv(FROMCP, TOCP, $_GET['f_state']) . ", " . 
				iconv(FROMCP, TOCP, $_GET['f_city']) . ", " .
				iconv(FROMCP, TOCP, $_GET['f_street']) . ", " .
				iconv(FROMCP, TOCP, $_GET['f_house']);
			
			$db->query("INSERT INTO o_address SET ".implode(',', $c));
			$res = $db->query("SELECT id FROM o_address WHERE ".implode(' AND ', $c));
			$r['id'] = $res[0]['id'];

			return $r;
		}
	};

?>