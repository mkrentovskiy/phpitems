<?
			$s = $this->eachPage();
			$ta = new TraficAccounting();
			
			$s .= $ta->showControlPanel($this);
			$p->add("<document>".$s."</document>");