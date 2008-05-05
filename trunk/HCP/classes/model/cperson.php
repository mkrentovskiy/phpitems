<?
	class CPerson extends ClassBase
	{
		function CPerson($r)
		{
			$this->ClassBase($r);
		}

		function getObject($uc, $id)
		{
			global $db;
						
			$s = '';

			$res = $db->query("SELECT o_person.*,
						DATE_FORMAT(o_person.dtmark,'%e.%m.%Y') AS tdtmark, 
						DATE_FORMAT(o_person.tborn,'%e.%m.%Y') AS ttborn, 
						DATE_FORMAT(s_objects.tmark,'%e.%m.%Y (%k:%i)') AS tb,
						s_objects.id AS oid FROM o_".$this->id.", s_objects  
						WHERE s_objects.id='$id' AND s_objects.enable > 0 AND s_objects.link=o_".$this->id.".id");			

			foreach($res as $r) {
				$s .= "<item>".$uc->xmlize($r)."</item>";
			}		

			// print $s;				
			return $s;
		}
		
		
		function getObjectsTree($uc, $pid)
		{
			global $db;
						
			$s = '';

			$res = $db->query("SELECT o_person.*, DATE_FORMAT(o_person.tborn,'%e.%m.%Y') AS tb,
						s_objects.id AS oid FROM o_person, s_objects  
						WHERE s_objects.pid='$pid' AND s_objects.enable > 0 AND s_objects.class='person' 
						AND s_objects.link=o_person.id ORDER BY o_person.lname");			
			
			foreach($res as $r) {
			 	list($dd, $mm, $yy) = explode('.', $r['tb']);
				if($dd == date("d") && $mm == date("m"))
					$s .= "<item><bd>1</bd>".$uc->xmlize($r)."</item>";
				else
					$s .= "<item>".$uc->xmlize($r)."</item>";
			}						
			return $s;
		}

		function showAddForm($uc)
		{
		 	$s = implode('', file("xml/person.xml"));

			// Autocomplete data sets
			$s .= $uc->resQuery("SELECT title AS value FROM o_person GROUP BY title ORDER BY title", 'titles', 'item', true);

			return $s;			
		}

		function addItem($uc, $pv = '')
		{
			global $db;
						
			$c = array();	
			array_push($c,"lname='".$_GET['f_lname']."'");
			array_push($c,"fname='".$_GET['f_fname']."'");
			array_push($c,"mname='".$_GET['f_mname']."'");
			array_push($c,"title='".$_GET['f_title']."'");
			array_push($c,"sex='".$_GET['f_sex']."'");
			array_push($c,"dserial='".$_GET['f_dserial']."'");
			array_push($c,"dnumber='".$_GET['f_dnumber']."'");
			array_push($c,"ddpt='".$_GET['f_ddpt']."'");

			if(isset($_GET['f_tborn']) && strlen($_GET['f_tborn']) > 0) {
				list($dd, $mm, $yy) = explode('.', $_GET['f_tborn']);
				array_push($c,"tborn='$yy-$mm-$dd'");
			}
				
			if(isset($_GET['f_dtmark']) && strlen($_GET['f_dtmark']) > 0) {
				list($dd, $mm, $yy) = explode('.', $_GET['f_dtmark']);
				array_push($c,"dtmark='$yy-$mm-$dd'");
			}

			$r = array();
			$r['title'] = $_GET['f_lname']." ".$_GET['f_fname']." ".$_GET['f_mname'];
			
			$db->query("INSERT INTO o_person SET ".implode(',', $c));
			$res = $db->query("SELECT id FROM o_person WHERE ".implode(' AND ', $c));
			$r['id'] = $res[0]['id'];

			return $r;
		}

	};

?>