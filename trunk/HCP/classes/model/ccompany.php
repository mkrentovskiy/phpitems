<?
	class CCompany extends ClassBase
	{
		function CCompany($r)
		{
			$this->ClassBase($r);
		}

		function getObject($uc, $id)
		{
			global $db;
						
			$s = '';
			$res = $db->query("SELECT o_company.*, DATE_FORMAT(o_company.tborn,'%e.%m.%Y') AS tb,
						s_objects.id AS oid FROM o_company, s_objects  
						WHERE s_objects.id='$id' AND s_objects.enable > 0 AND s_objects.link=o_company.id");

			$s .= "<item>".$uc->xmlize($res[0])."</item>";
			$s .= $uc->resQuery("SELECT * FROM d_companytypes ORDER BY pos", 'types', 'item', true);
			return $s;
		}

		function getObjectsTree($uc, $pid)
		{
			global $db;
						
			$s = '';

			$res = $db->query("SELECT o_company.*, DATE_FORMAT(o_company.tborn,'%e.%m.%Y') AS tb,
						s_objects.id AS oid FROM o_company, s_objects  
						WHERE s_objects.pid='$pid' AND s_objects.enable > 0 AND s_objects.class='company' 
						AND s_objects.link=o_company.id ORDER BY o_company.title");


			foreach($res as $r) {
			 	list($dd, $mm, $yy) = explode('.', $r['tb']);
				if($dd == date("d") && $mm == date("m"))
					$s .= "<item><bd>1</bd>".$uc->xmlize($r)."</item>";
				else
					$s .= "<item>".$uc->xmlize($r)."</item>";
			}						
			$s .= $uc->resQuery("SELECT * FROM d_companytypes ORDER BY pos", 'types', 'item', true);
			return $s;
		}

		function showAddForm($uc)
		{
		 	$s = implode('', file("xml/company.xml"));
			$s .= $uc->resQuery("SELECT * FROM d_companytypes ORDER BY pos", 'types', 'item', true);

			return $s;			
		}

		function addItem($uc, $pv = '')
		{
			global $db;
						
			$c = array();	
			array_push($c,"title='".$_GET['f_title']."'");
			array_push($c,"fform='".$_GET['f_fform']."'");

			array_push($c,"email='".$_GET['f_email']."'");
			array_push($c,"inn='".$_GET['f_inn']."'");
			array_push($c,"kpp='".$_GET['f_kpp']."'");
			array_push($c,"okved='".$_GET['f_okved']."'");
			array_push($c,"okpo='".$_GET['f_okpo']."'");

			list($dd, $mm, $yy) = explode('.', $_GET['f_tborn']);
			array_push($c,"tborn='$yy-$mm-$dd'");

			array_push($c,"type='".$_GET['f_type']."'");

			$r = array();
			$r['title'] = $_GET['f_title'];
			
			$db->query("INSERT INTO o_company SET ".implode(',', $c));
			$res = $db->query("SELECT id FROM o_company WHERE ".implode(' AND ', $c));
			$r['id'] = $res[0]['id'];

			return $r;
		}

	};

?>