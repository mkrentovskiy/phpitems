<?	class UCAddAlias extends UseCase 	{		function action($p)		{
			$ta = new TraficAccounting();
			
			$s = $ta->addAlias($this, $_GET['f_ip'], $_GET['f_name']);
			$p->add("<ajaxdocument>".$s."</ajaxdocument>");			return $p;		}	}?>