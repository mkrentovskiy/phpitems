<?	class UCDeleteAlias extends UseCase 	{				function action($p)		{
			$ta = new TraficAccounting();
			
			$s = $ta->deleteAlias($this, $_GET['f_ip']);
			$p->add("<ajaxdocument>".$s."</ajaxdocument>");;			return $p;		}	}?>