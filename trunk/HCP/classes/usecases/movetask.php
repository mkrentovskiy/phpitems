<?	class UCMoveTask extends UseCase 	{		function action($p) 		{			global $db;									$tf = new TasksFactory;
			
			if(isset($_GET['id']) && is_numeric($_GET['id'])
				&& ereg("([0-9]{2}).([0-9]{2}).([0-9]{4})", $_GET['tm'])) {
				$s = $tf->moveTask($this, $_GET['id'], $_GET['tm']); 
			}
						$p->add("<ajaxdocument><scheduler>".$s."</scheduler></ajaxdocument>");
			return $p;		}						function defaultAction($p)		{						$this->goToUsecase("Start");					}	}?>