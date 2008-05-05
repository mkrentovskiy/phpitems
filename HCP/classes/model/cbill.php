<?
	class CBill extends ClassBase
	{
		function CBill($r)
		{
			$this->ClassBase($r);
		}

		function showAddForm($uc)
		{
		 	$s = implode('', file("xml/bill.xml"));

			// Autocomplete data sets
			$s .= $uc->resQuery("SELECT bank AS value FROM o_bill GROUP BY bank ORDER BY bank", 'bank', 'item', true);
			$s .= $uc->resQuery("SELECT corbill AS value FROM o_bill GROUP BY corbill ORDER BY corbill", 'corbill', 'item', true);
			$s .= $uc->resQuery("SELECT bik AS value FROM o_bill GROUP BY bik ORDER BY bik", 'bik', 'item', true);

			return $s;			
		}


		function addItem($uc, $pv = '')
		{
			global $db;
						
			$c = array();	
			array_push($c,"bill='".$_GET['f_bill']."'");
			array_push($c,"bank='".$_GET['f_bank']."'");
			array_push($c,"corbill='".$_GET['f_corbill']."'");
			array_push($c,"bik='".$_GET['f_bik']."'");

			$r = array();
			$r['title'] = "Счет ".$_GET['f_bill'];			

			$db->query("INSERT INTO o_bill SET ".implode(',', $c));
			$res = $db->query("SELECT id FROM o_bill WHERE ".implode(' AND ', $c));
			$r['id'] = $res[0]['id'];

			return $r;
		}

	};

?>