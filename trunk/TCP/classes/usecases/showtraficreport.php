<?	class UCShowTraficReport extends UseCase 	{		function action($p)		{
			$s = $this->eachPage();
			$ta = new TraficAccounting();

			setcookie('c_fdate', $_POST['f_dfrom'], time() + 3600);
			setcookie('c_tdate', $_POST['f_dto'], time() + 3600);
			
			$s .= $ta->showTraficReport($this, $_POST['f_dfrom'], $_POST['f_dto'], $_POST['f_groups'], $_POST['f_perday'] == 'on');
			$p->add("<document>".$s."</document>");			return $p;		}	}?>