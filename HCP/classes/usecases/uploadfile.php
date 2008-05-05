<?	class UCUploadFile extends UseCase 	{		function action($p) 		{			global $db;			$s = ''; 
			
			if(count($_FILES) > 0) {				$id = (isset($_POST['id']) && is_numeric($_POST['id'])) ? $_POST['id'] : 0;
				$path = (ereg("([a-z]+)", $_POST['target'])) ? '/'.$_POST['target'] : '';					$s = '';				
				// print_r($_FILES);
				
				foreach($_FILES as $k => $f) {					$limit_search = strtr(rawurldecode($limit_search), $src, $dst);										$fn = $this->translit($_FILES[$k]['name']);					if(strlen($fn) > 0) {
						$nfn = FILEPATH.$path.'/'.$fn;						$z = $_FILES[$k]['size'];					
						if(file_exists($nfn)) 							$nfn = FILEPATH.$path.'/'.date("dmYHis_").$fn;					
						@move_uploaded_file($_FILES[$k]['tmp_name'], $nfn);															if($z > 1048576) {
							$z = round($z / 1048576, 3).' Мб';					
						} else {							if($z > 1024) $z = round($z / 1024, 3).' Кб';												else $z = $z.' б';						};																$s .= "<$k size='$z'>$nfn</$k>";
					}
				}
				
				$p->add("<iframedocument><uploadedfile id='$id'>$s</uploadedfile></iframedocument>");							
			
			} else { 
				$id = (isset($_GET['id']) && is_numeric($_GET['id'])) ? $_GET['id'] : 0;
				if(isset($_GET['name']) && ereg("([a-z]+)", $_GET['name']) && ereg("([a-z]+)", $_GET['target'])) {
					$p->add("<iframedocument><file><name>".$_GET['name']."</name><target>".$_GET['target']."</target><id>$id</id></file></iframedocument>");							
				}
			}								
						return $p;		}						function defaultAction($p)		{						$this->goToUsecase("Start");					}		function translit($cs) {			$tr = array(				"А"=>"A","Б"=>"B","В"=>"V","Г"=>"G",				"Д"=>"D","Е"=>"E","Ж"=>"ZH","З"=>"Z","И"=>"I",				"Й"=>"Y","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N",				"О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T",				"У"=>"U","Ф"=>"F","Х"=>"H","Ц"=>"TS","Ч"=>"CH",				"Ш"=>"SH","Щ"=>"SCH","Ъ"=>"'","Ы"=>"YI","Ь"=>"",				"Э"=>"E","Ю"=>"YU","Я"=>"YA",				"а"=>"a","б"=>"b",				"в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"zh",				"з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",				"м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",				"с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",				"ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"'",				"ы"=>"yi","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya", 				" "=>"_");			return strtr($cs, $tr);		}	}?>