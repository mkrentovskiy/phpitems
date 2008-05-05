<?	class UCLogout extends UseCase 	{		function action($p)		{			global $session;					setcookie("c_logout", "1");
			$session->unregister('user');			
			$this->user = new User('anonymous','');			
			$s = $this->eachPage();			$p->add("<document>$s<relocate><url>?usecase=Start</url></relocate></document>");
			
			return $p;		}
		
		function defaultAction($p)
		{
			return $this->action($p);
		}	}?>