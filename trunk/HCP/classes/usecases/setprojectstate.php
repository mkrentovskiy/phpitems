<?	class UCSetProjectState extends UseCase 	{		function action($p) 		{			global $db;			if(isset($_GET['id']) && is_numeric($_GET['id']) &&				isset($_GET['state']) && is_numeric($_GET['state'])) {					$id = $_GET['id'];			 		$state = $_GET['state'];						    	if($this->user->filter('project', $id)) {										$db->query("UPDATE o_project SET state='$state', tchangestate=NOW() WHERE id='$id'");								};
					
				$cf = new ClassFactory;			
            	$s = $cf->getItem($this, 'project', $id);				}
						$p->add("<ajaxdocument><projectstate>".$s."</projectstate></ajaxdocument>");							return $p;		}						function defaultAction($p)		{						$this->goToUsecase("Start");					}	}?>