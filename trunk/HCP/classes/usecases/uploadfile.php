<?
			
			if(count($_FILES) > 0) {
				$path = (ereg("([a-z]+)", $_POST['target'])) ? '/'.$_POST['target'] : '';	
				// print_r($_FILES);
				
				foreach($_FILES as $k => $f) {
						$nfn = FILEPATH.$path.'/'.$fn;
						if(file_exists($nfn)) 
						@move_uploaded_file($_FILES[$k]['tmp_name'], $nfn);				
							$z = round($z / 1048576, 3).' Мб';					
						} else {
					}
				}
				
				$p->add("<iframedocument><uploadedfile id='$id'>$s</uploadedfile></iframedocument>");							
			
			} else { 
				$id = (isset($_GET['id']) && is_numeric($_GET['id'])) ? $_GET['id'] : 0;
				if(isset($_GET['name']) && ereg("([a-z]+)", $_GET['name']) && ereg("([a-z]+)", $_GET['target'])) {
					$p->add("<iframedocument><file><name>".$_GET['name']."</name><target>".$_GET['target']."</target><id>$id</id></file></iframedocument>");							
				}
			}								
			