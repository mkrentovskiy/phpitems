<?	class UCRemoveTask extends UseCase 	{		function action($p) 		{			global $db;									$tf = new TasksFactory;
			
			if(isset($_GET['id']) && is_numeric($_GET['id'])) {
				$s = $tf->removeTask($this, $_GET['id']); 
			}
			
			$p->add("<ajaxdocument><scheduler>".$s."</scheduler></ajaxdocument>");
			return $p;		}						function defaultAction($p)		{						$this->goToUsecase("Start");					}	}?>