<?	class UCShowDocumentItem extends UseCase 	{		function action($p) 		{			global $db;									$s = $this->eachPage();			
			$df = new DocumentsFactory;
			$s .= $df->showDocumentItem($this);
						$p->add("<document menuid='2'>".$s."</document>");			return $p;		}						function defaultAction($p)		{						$this->goToUsecase("Start");					}	}?>