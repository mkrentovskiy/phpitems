<?
	class ClassFactory
	{
		var	$res;
		var	$co;

		function ClassFactory()
		{
			global $db;

			$this->res = $db->query("SELECT * FROM s_classes ORDER BY priority");

			foreach($this->res as $r) {
				if(class_exists('C'.$r['id'])) { 
					@eval('$obj = new C'.$r['id'].'($r);');
					if(is_object($obj)) $this->co[($r['id'])] = $obj;
				}		
			}

		}


		function getObjectsTree($uc, $id, $filter = array())
		{

			$s = "<objectstree id='$id'>";
			$s .= $this->getObjectsTo($uc, $id);

			foreach($this->co as $k => $v) {
				
				if(count($filter) == 0 || $filter[$k] != 0) {
					$s .= "<$k>"; 				
					$s .= $v->getObjectsTree($uc, $id);
					$s .= "</$k>";
				}				
			}
			
			$s .= "<classes>";
			foreach($this->res as $r) {
				if(count($filter) == 0 || $filter[($r['id'])] != 0) {
					$s .= "<item>".$uc->xmlize($r)."</item>";
				}
			}
			$s .= "</classes>";
			
			$s .= "</objectstree>";

			return $s;
		}

		function getTreeElement($uc, $class, $id)
		{
			$s = "<$class>"; 				
			if(is_object($this->co[$class]))
				$s .= $this->co[$class]->getObjectsTree($uc, $id);
			$s .= "</$class>";

			return $s;
		}
		
		function getItem($uc, $class, $id)
		{
			$s = "<$class>"; 				
			if(is_object($this->co[$class]))
				$s .= $this->co[$class]->getObjectItem($uc, $id);
			$s .= "</$class>";

			return $s;
		}
		
		function showAddForm($uc, $class)
		{
			$s = "<form>"; 				
			if(is_object($this->co[$class]))
				$s .= $this->co[$class]->showAddForm($uc);
			$s .= "</form>";

			return $s;
		}

		function addItem($uc, $class, $pid)
		{
			global $db;
			
			$r = $this->co[$class]->addItem($uc, array());
			
			$db->query("INSERT s_objects SET pid='$pid', class='$class', link='".$r['id']."', version='1', tmark=NOW(), user='".
				$uc->userGetLogin()."', enable='1', title='".$r['title']."'");	
		}
		
		function getObjectsTo($uc, $id)
		{
			global $db;

			$s = "<path>";

			if($id > 0) {
				$pid = $id;
				$k = 1;
				$a = array();

				while($pid > 0 && $k < LOOPMAX) {
					$res = $db->query("SELECT * FROM s_objects WHERE id='$pid'");
					if(count($res) == 1) {
						array_push($a, $res[0]);	
						$pid = $res[0]['pid'];	
					}
					$k++;
				}
				
				$a = array_reverse($a);				
				
				foreach($a as $v) {
					
					$s .= "<item>";
					$s .= $uc->xmlize($v);
					
					$s .= "<$v[class]>"; 				
					if(is_object($this->co[($v['class'])]))
						$s .= $this->co[($v['class'])]->getObject($uc, $v['id']);
					$s .= "</$v[class]>";
					$s .= "</item>";
				}
			}
			
			$s .= "</path>";

			// print $s;
			return $s;
		}

		function showControlForm($uc, $oid)
		{
			global $db;

			$res = $db->query("SELECT *, DATE_FORMAT(tmark,'%e.%m.%Y (%k:%i)') AS tb FROM s_objects WHERE id='$oid'");

			if(count($res) == 1) {
				$r = $res[0];

				$s = "<control>";
				$s .= $uc->xmlize($r);

				$s .= "<".$r['class'].">";
				if(is_object($this->co[($r['class'])]))
					$s .= $this->co[($r['class'])]->showControlItem($uc, $r, $this);
				$s .= "</".$r['class'].">";
				
				$s .= "<form>";					
				if(is_object($this->co[($r['class'])]))
					$s .= $this->co[($r['class'])]->showControlForm($uc, $r, $this);
				$s .= "</form>";

				$s .= "<info>";
				$s .= $this->treeBuild();
				$s .= "</info>";

				$s .= "</control>";
			}
			
			// print htmlspecialchars($s);

			return $s;
		}
		
		function getDescription($uc, $oid)
		{
			global $db;
			
			$res = $db->query("SELECT * FROM s_objects WHERE id='$oid'");
			return $res[0];
		}
		
		function getObject($uc, $v)
		{
			if(is_object($this->co[($v['class'])]))
				$s = $this->co[($v['class'])]->getObject($uc, $v['id']);						
			return $s;
		}

		function commitItem($uc, $oid)
		{
			global $db;
			
			$q = $this->getDescription($us, $oid);
			
			$res = $db->query("SELECT * FROM o_".$q['class']." WHERE id='".$q['link']."'");
			$r = $this->co[($q['class'])]->addItem($uc, $res[0]);
			
			$db->query("UPDATE s_objects SET enable='0' WHERE id='$oid'");

			$c = array();
			array_push($c,"pid='".$q['pid']."'");
			array_push($c,"vid='".$oid."'");
			array_push($c,"class='".$q['class']."'");
			array_push($c,"link='".$r['id']."'");
			array_push($c,"version='".($q['version'] + 1)."'");
			array_push($c,"tmark='".date("Y-m-d H:i:s")."'");
			array_push($c,"user='".$uc->userGetLogin()."'");
			array_push($c,"enable='1'");
			array_push($c,"title='".$r['title']."'");
	
			$db->query("INSERT INTO s_objects SET ".implode(',', $c));
			$res = $db->query("SELECT id FROM s_objects WHERE ".implode(' AND ', $c));
			
			$db->query("UPDATE s_objects SET pid='".$res[0]['id']."' WHERE pid='$oid'");
			
			return $res[0]['id'];
		}
		
		function copyObject($uc, $oid, $pid)
		{
			global $db;
			
			$res = $db->query("SELECT * FROM s_objects WHERE id='$oid'");
			$r = $res[0];
			
			if(count($res) == 1 && $r['pid'] != $pid && $oid != $pid) {
				$a = array();
				array_push($a, "pid='$pid'");
				array_push($a, "vid='$r[vid]'");
				array_push($a, "class='$r[class]'");
				array_push($a, "link='$r[link]'");
				array_push($a, "version='$r[version]'");
				array_push($a, "tmark=NOW()");
				array_push($a, "user='".$uc->userGetLogin()."'");
				array_push($a, "enable='1'");
				array_push($a, "title='$r[title]'");
			
				$db->query("INSERT INTO s_objects SET ".implode(',', $a));
				$db->query("COMMIT");
			}		
	
			return $this->treeBuild();
		}
		
		function deleteObject($uc, $oid)
		{
			global $db;
			
			$res = $db->query("SELECT id FROM s_objects WHERE pid='$oid'");
			foreach($res as $r) $this->deleteObject($uc, $r['id']);
			
			$db->query("UPDATE s_objects SET enable='0' WHERE id='$oid'");
		}
		
		
		//
		// Tree build functions
		//

		function treeBuild()
		{
			global $db;

			$tm = $this->getCacheTime('ObjectTree');
			if(isset($tm)) {
				$res = $db->query("SELECT COUNT(id) FROM s_objects WHERE tmark > '$tm'");
				if($res[0]['COUNT(id)'] == 0) {
					return $this->getCachedItem('ObjectTree');
				} 
			}

			// Cache fault
			$res = $db->query("SELECT * FROM s_objects WHERE enable > 0 AND class != 'note' ORDER BY class, tmark DESC");
			$s = "<tree>".$this->treeBuildIter($res, 0, 1)."</tree>";	
			
			// Cache me!			
			$this->setCacheItem('ObjectTree', $s);
	
			return $s;
		}

		function treeBuildIter($res, $pid, $k) 
		{	
			if($k > LOOPMAX) return '';

			$s = '';
			foreach($res as $r) {
				if($r['pid'] == $pid) {
					if(is_object($this->co[($r['class'])])) {
						$s .= "<node oid='".$r['id']."' level='$k' class='".$r['class']."'>";
						$s .= "<title>".htmlspecialchars($r['title'])."</title>";
						
						$x = $this->treeBuildIter($res, $r['id'], $k + 1);
						if(strlen($x) > 0) $s .= "<childs>".$x."</childs>";

						$s .= "</node>";
					}
				}
			}
			return $s;		
		} 

		//
		// Cache
		//
	
		function setCacheItem($name, $value) 
		{
			global $session;
					
			$session->set(CACHEPREFIX.$name, $value);		 		
			$session->set(CACHEPREFIX.$name.'_tmark', date("Y-m-d H:i:s"));
		}


		function getCacheTime($name) 
		{
			global $session;
			
			return $session->get(CACHEPREFIX.$name.'_tmark');	
		}

		function getCachedItem($name) 
		{
			global $session;
		
			return $session->get(CACHEPREFIX.$name);		 								 		
		}
	};

?>