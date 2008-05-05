<?
	class CTask extends ClassBase
	{
		function CTask($r)
		{
			$this->ClassBase($r);
		}

		function getObject($uc, $id)
		{
			global $db;
			
			$res = $db->query("SELECT o_task.*, DATE_FORMAT(s_objects.tmark,'%e.%m.%Y (%k:%i)') AS tb,
						DATE_FORMAT(o_task.tmark,'%e.%m.%Y') AS ttmark,
						DATE_FORMAT(o_task.deadline,'%e.%m.%Y') AS tdeadline,
						s_objects.id AS oid FROM o_task, s_objects  
						WHERE s_objects.id='$id' AND s_objects.enable > 0 AND s_objects.link=o_task.id");

			foreach($res as $r) {
				$s .= "<item>".$uc->xmlize($r)."</item>";
			}		

			
			$s .= $uc->resQuery("SELECT * FROM d_tasktypes ORDER BY pos", 'types', 'item', true);			
			return $s;

		}

		function getObjectsTree($uc, $pid)
		{
			global $db;

			$res = $db->query("SELECT o_task.*, DATE_FORMAT(s_objects.tmark,'%e.%m.%Y (%k:%i)') AS tb,
						DATE_FORMAT(o_task.tmark,'%e.%m.%Y') AS ttmark,
						DATE_FORMAT(o_task.deadline,'%e.%m.%Y') AS tdeadline,
						s_objects.id AS oid FROM o_task, s_objects  
						WHERE s_objects.pid='$pid' AND s_objects.class='task' AND s_objects.enable > 0 AND s_objects.link=o_task.id");

			foreach($res as $r) {
				$s .= "<item>".$uc->xmlize($r)."</item>";
			}		

			$s .= $uc->resQuery("SELECT * FROM d_tasktypes ORDER BY pos", 'types', 'item', true);			
			return $s;
		}

		function showAddForm($uc, $ois = '')
		{
		 	$s = implode('', file("xml/task.xml"));

			// Dictionaries
			$s .= $uc->resQuery("SELECT * FROM d_tasktypes ORDER BY pos", 'types', 'item', true);			

			return $s;			
		}

		function addItem($uc, $pv = '')
		{
			global $db;
						
			$c = array();	
			array_push($c,"type='".$_GET['f_type']."'");
			array_push($c,"title='".$_GET['f_title']."'");
			array_push($c,"description='".$_GET['f_comment']."'");
			array_push($c,"pc='".$_GET['f_pc']."'");
			array_push($c,"tmark='".date("Y-m-d H:i:s")."'");

			list($dd, $mm, $yy) = explode('.', $_GET['f_deadline']);
			array_push($c,"deadline='$yy-$mm-$dd'");

			$r = array();
			$r['title'] = "Задача: ".$_GET['f_title'];

			$db->query("INSERT INTO o_task SET ".implode(',', $c));
			$res = $db->query("SELECT id FROM o_task WHERE ".implode(' AND ', $c));
			$r['id'] = $res[0]['id'];

			return $r;
		}

	};

?>