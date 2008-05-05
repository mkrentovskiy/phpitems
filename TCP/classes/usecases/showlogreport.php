<?	class UCShowLogReport extends UseCase 	{		function action($p)		{
			$s = $this->eachPage();
			$ta = new TraficAccounting();
			
			setcookie('c_ldate', $_POST['f_date'], time() + 3600);
			$s .= $ta->showLogReport($this, $_POST['f_date'], $_POST['f_groups']);
			$p->add("<document>".$s."</document>");			return $p;		}	}?>