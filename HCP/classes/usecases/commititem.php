<?	class UCCommitItem extends UseCase 	{		function action($p) 		{			global $db;			$s = ''; 			$cf = new ClassFactory;			if(isset($_GET['_oid']) && is_numeric($_GET['_oid'])) {				$oid = $_GET['_oid'];
		                $noid = $cf->commitItem($this, $oid);				
				$s = $cf->showControlForm($this, $noid);        	   			
				$p->add("<ajaxdocument>".$s."</ajaxdocument>");										}			return $p;		}						function defaultAction($p)		{						$this->goToUsecase("Start");					}	}?>