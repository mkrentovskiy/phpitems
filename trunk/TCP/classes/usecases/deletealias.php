<?
			$ta = new TraficAccounting();
			
			$s = $ta->deleteAlias($this, $_GET['f_ip']);
			$p->add("<ajaxdocument>".$s."</ajaxdocument>");;