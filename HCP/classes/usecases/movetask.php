<?
			
			if(isset($_GET['id']) && is_numeric($_GET['id'])
				&& ereg("([0-9]{2}).([0-9]{2}).([0-9]{4})", $_GET['tm'])) {
				$s = $tf->moveTask($this, $_GET['id'], $_GET['tm']); 
			}
			
			return $p;