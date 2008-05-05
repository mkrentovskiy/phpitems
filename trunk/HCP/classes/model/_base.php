<?
	class ClassBase
	{
		var	$id;
		var	$title;
		var	$r;

		function ClassBase($r)
		{
			$this->id = $r['id'];
			$this->title = $r['title'];
			$this->r = $r;
		}

		function getObject($uc, $id)
		{
			global $db;
						
			$s = '';

			$res = $db->query("SELECT o_".$this->id.".*, DATE_FORMAT(s_objects.tmark,'%e.%m.%Y (%k:%i)') AS tb,
						s_objects.id AS oid FROM o_".$this->id.", s_objects  
						WHERE s_objects.id='$id' AND s_objects.enable > 0 AND s_objects.link=o_".$this->id.".id");


			foreach($res as $r) {
				$s .= "<item>".$uc->xmlize($r)."</item>";
			}		

			// print $s;				
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
			return $s;
		}

		function getObjectsTree($uc, $pid)
		{
			global $db;
						
			$s = '';

			$res = $db->query("SELECT o_".$this->id.".*, DATE_FORMAT(s_objects.tmark,'%e.%m.%Y (%k:%i)') AS tb,
						s_objects.id AS oid FROM o_".$this->id.", s_objects  
						WHERE s_objects.pid='$pid' AND s_objects.enable > 0 AND s_objects.class='".$this->id."' 
						AND s_objects.link=o_".$this->id.".id ORDER BY s_objects.tmark DESC");


			foreach($res as $r) {
				$s .= "<item>".$uc->xmlize($r)."</item>";
			}						
			return $s;
		}

		function showAddForm($uc, $r = '')
		{
		 	$s = implode('', file("xml/".$this->id.".xml"));
			return $s;			
		}

		function showControlItem($uc, $r)
		{
		    $s = $this->getObject($uc, $r['id']);
			return $s;
		}

		function showControlForm($uc, $r, $cf)
		{
			return $this->showAddForm($uc, $r);
		}
	
		function emNote($name, $value = '')
		{
		    $s = "<embed name='$name'>";
			
			$e = new FCKeditor($name);
			$e->BasePath = (strlen(dir($PHP_SELF)) > 0 ? dir($PHP_SELF).'/' : '').CLASSPATH.'controls/FCKeditor/';
			$e->ToolbarSet = 'Note';
			$e->Height = '500';
			$e->Value = $value;
			
			$s .= htmlspecialchars($e->CreateHtml());

			$s .= "</embed>";
			return $s;
		}

	};

?>