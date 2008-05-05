<?	class UCCopyObjectItem extends UseCase 	{		function action($p) 		{			global $db;			if(isset($_GET['oid']) && is_numeric($_GET['oid']) &&
				isset($_GET['pid']) && is_numeric($_GET['pid'])) {				
				$cf = new ClassFactory;				
				$s = $cf->copyObject($this, $_GET['oid'], $_GET['pid']);								$p->add("<ajaxdocument>$s</ajaxdocument>");										}			return $p;		}						function defaultAction($p)		{						$this->goToUsecase("Start");					}	}?>