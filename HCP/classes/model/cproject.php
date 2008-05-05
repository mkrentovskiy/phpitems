<?
	class CProject extends ClassBase
	{
		function CProject($r)
		{
			$this->ClassBase($r);
		}

		function getObject($uc, $id)
		{
			global $db;
						
			$s = '';

			$res = $db->query("SELECT o_project.*, DATE_FORMAT(o_project.tmark,'%e.%m.%Y') AS tm, 
						DATEDIFF(NOW(), o_project.tmark) AS tmlong, s_objects.id AS oid 		
						FROM o_project, s_objects  WHERE s_objects.id='$id' AND s_objects.enable > 0 AND s_objects.class='project' AND s_objects.link=o_project.id
						ORDER BY o_project.tmark DESC");


			$s .= "<item>".$uc->xmlize($res[0])."</item>";
			
			$s .= $uc->resQuery("SELECT * FROM d_projecttypes ORDER BY pos", 'types', 'item', true);
			$s .= $uc->resQuery("SELECT * FROM d_projectstates ORDER BY pos", 'states', 'item', true);
			
			return $s;

		}
		
		function getObjectItem($uc, $id)
		{
			global $db;
						
			$s = '';
			$res = $db->query("SELECT * FROM o_".$this->id." WHERE id='$id'");
			foreach($res as $r) {
				$s .= "<item>".$uc->xmlize($r)."</item>";
			}		
			
			$s .= $uc->resQuery("SELECT * FROM d_projecttypes ORDER BY pos", 'types', 'item', true);
			$s .= $uc->resQuery("SELECT * FROM d_projectstates ORDER BY pos", 'states', 'item', true);
		
			return $s;
		}
		

		function getObjectsTree($uc, $pid)
		{
			global $db;
						
			$s = '';

			$d = "s_objects.pid='$pid' AND s_objects.enable > 0 AND s_objects.class='project' AND s_objects.link=o_project.id";

			$res = $db->query("SELECT o_project.*, DATE_FORMAT(o_project.tmark,'%e.%m.%Y') AS tm, 
						DATEDIFF(NOW(), o_project.tmark) AS tmlong, s_objects.id AS oid 		
						FROM o_project, s_objects  WHERE $d ORDER BY o_project.tmark DESC");

			$begin = $uc->checkValue($_GET, 'project_begin', 0, 120, 'project');			
			$npp = $this->r['npp'];
			$ppp = $this->r['ppp'];
			$total = count($res);
			
			for($i = $begin; $i < (($begin + $npp < $total) ? $begin + $npp : $total); $i++) {
				$s .= "<item>".$uc->xmlize($res[$i])."</item>";
			}			

			$s .= $uc->pager($total, $begin, $npp, $ppp, '?usecase=ShowObjectsTree&amp;id='.$pid, 'project_');
			
			$s .= $uc->resQuery("SELECT * FROM d_projecttypes ORDER BY pos", 'types', 'item', true);
			$s .= $uc->resQuery("SELECT * FROM d_projectstates ORDER BY pos", 'states', 'item', true);
			
			return $s;
		}

		function showAddForm($uc, $oid = '')
		{
		 	$s = implode('', file("xml/project.xml"));

			$s .= $uc->resQuery("SELECT * FROM d_projecttypes ORDER BY pos", 'types', 'item', true);
			$s .= $uc->resQuery("SELECT * FROM d_projectstates ORDER BY pos", 'states', 'item', true);
			return $s;			
		}

		function addItem($uc, $pv = '')
		{
			global $db;
						
			$c = array();	
			array_push($c,"type='".$_GET['f_type']."'");
			array_push($c,"title='".$_GET['f_title']."'");
			array_push($c,"description='".$_GET['f_description']."'");;

			if(count($pv) > 1) {
				array_push($c,"state='".$pv['state']."'");
				array_push($c,"tmark='".$pv['tmark']."'");
				array_push($c,"tchangestate='".$pv['tchangestate']."'");
			} else {
				array_push($c,"tmark=NOW()");
			}
			
			$r = array();
			$r['title'] = "Проект: ".$_GET['f_title'];
			
			$db->query("INSERT INTO o_project SET ".implode(',', $c));
			$res = $db->query("SELECT id FROM  o_project WHERE ".implode(' AND ', $c));
			$r['id'] = $res[0]['id'];

			return $r;
		}

	};

?>