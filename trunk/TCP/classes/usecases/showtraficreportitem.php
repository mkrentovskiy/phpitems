<?	class UCShowTraficReportItem extends UseCase 	{		function action($p)		{
			$s = $this->eachPage();
			$ta = new TraficAccounting();
			
			$s .= $ta->showTraficReportItem($this, $_GET['f_date'], $_GET['f_ip']);
			$p->add("<document>".$s."</document>");			return $p;		}	}?>