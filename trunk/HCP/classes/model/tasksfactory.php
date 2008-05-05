<?

	class TasksFactory
	{
		
		function TasksFactory()
		{}

		function getTaskPanel($uc, $id)
		{
			$s = "<taskpanel id='$id'>";
			$s .= $this->getLostTasks($uc, 1, 'dcalendarlost');
			$s .= $this->getNextTasks($uc, 1, 'dcalendar');
			$s .= "</taskpanel>";
			
			return $s;
		}
		
		function getLostTasks($uc, $area, $name)
		{
			global $db;
			
			$u = $uc->userGetLogin();
			$s = $uc->resQuery("SELECT id, DATE_FORMAT(tmark,'%e.%m.%Y') AS tm, task, comment 
				FROM s_scheduler WHERE is_done = '0' AND tmark < NOW() AND area = '$area' 
				AND user='$u'", $name, "item");
			
			return $s;
		}
		
		function getNextTasks($uc, $area, $name)
		{
			global $db;

			$u = $uc->userGetLogin();
			$s = $uc->resQuery("SELECT id, DATE_FORMAT(tmark,'%e.%m') AS tm, task, comment, is_done, (user = '$u') AS is_this_user 
				FROM s_scheduler WHERE tmark < ADDDATE(NOW(), INTERVAL 7 DAY) AND tmark > NOW() AND area = '$area'", 
				$name, "item");

			return $s;
		}
		
		function moveTask($uc, $id, $tm)
		{
			global $db;

			$res = $db->query("SELECT * FROM s_scheduler WHERE id='$id'");
			$u = $uc->userGetLogin();
			$i = $res[0]['area'] > 0 ? $res[0]['area'] : 1;
			
			if($res[0]['user'] == $u) {
				list($d, $m, $y) = explode('.', $tm); 		
				list($dt, $tm) = explode(' ', $res[0]['tmark']);
				
				$db->query("UPDATE s_scheduler SET tmark='$y-$m-$d $tm' WHERE id='$id'");
			}
		
			return $this->getTaskPanel($uc, $i);
		}

		function removeTask($uc, $id)
		{
			global $db;

			$res = $db->query("SELECT * FROM s_scheduler WHERE id='$id'");
			$u = $uc->userGetLogin();
			$i = $res[0]['area'] > 0 ? $res[0]['area'] : 1;
			
			if($res[0]['user'] == $u) {
				$db->query("UPDATE s_scheduler SET is_done='2' WHERE id='$id'");
			}
		
			return $this->getTaskPanel($uc, $i);
		}
		
	}

?>