<?	class UCAddToChart extends UseCase 	{		function defaultAction($p)		{			        global $db, $session;										if(isset($_GET['id']) && is_numeric($_GET['id'])) {				$id = $_GET['id'];				$res = $db->query("SELECT * FROM products WHERE id_products='$id'");				if(count($res) == 1) {					$r = $res[0];					$r['num'] = 1;					$this->chart->insert($r);				} else {					// $this->goToUsecase("Start");				}			} else {				$this->goToUsecase("Start");			}            		$session->set('r_chart', $this->chart);													$this->goToUsecase("ShowChart");						return $p;		}	}?>