<?
			$session->unregister('user');			
			$this->user = new User('anonymous','');
			$s = $this->eachPage();
			
			return $p;
		
		function defaultAction($p)
		{
			return $this->action($p);
		}