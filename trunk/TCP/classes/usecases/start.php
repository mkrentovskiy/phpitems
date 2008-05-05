<?	class UCStart extends UseCase 	{		function defaultAction($p)		{						$s = $this->eachPage();			$p->add("<document>".$s."</document>");			return $p;		}		function action($p)		{
			$s = $this->eachPage();
			$ta = new TraficAccounting();
			
			$s .= $ta->showControlPanel($this);
			$p->add("<document>".$s."</document>");			return $p;		}	}?>