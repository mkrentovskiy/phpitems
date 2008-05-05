<?
	class CImage extends ClassBase
	{
		function CImage($r)
		{
			$this->ClassBase($r);
		}


		function addItem($uc, $pv = '')
		{
			global $db;

			$c = array();	
			array_push($c,"title='".$_GET['f_title']."'");
			
			if(strlen($_GET['f_file']) > 1) {
				array_push($c,"filename='".$_GET['f_file']."'");
				$fl = $_GET['f_file'];
			} else {
				if(count($pv) > 1) {
					array_push($c,"filename='".$pv['filename']."'");
					$fl = $pv['filename'];
				}
			}
			
			array_push($c,"comment='".$_GET['f_comment']."'");

			if('on' === $_GET['f_preview']) {
				array_push($c,"has_preview='1'");
				
				if($pv['has_preview'] != '1' || $pv['filename'] != $fl) {

					$sz = getimagesize($fl);
					$img = new Image_Toolbox($fl);
					$tfn = $fl . "-t.png";
					
					@unlink($tfn);
					
					if($sz[0] > MAXIMGWIDTH) {					
						if(($sz[1] / MAXIMGHEIGHT) > ($sz[0] / MAXIMGWIDTH)) {
							$img->newOutputSize(0, MAXIMGHEIGHT);					
						} else {
							$img->newOutputSize(MAXIMGWIDTH, 0);
						}
					} else if($sz[1] > MAXIMGHEIGHT) {
						$img->newOutputSize(0, MAXIMGHEIGHT);
					} 

					$img->save($tfn, 'png');
				}
			} else {
				array_push($c,"has_preview='0'");
			}

			$r = array();
			$r['title'] = "Изображение: ".$_GET['f_title'];

			$db->query("INSERT INTO o_image SET ".implode(',', $c));
			$res = $db->query("SELECT id FROM o_image WHERE ".implode(' AND ', $c));
			$r['id'] = $res[0]['id'];

			return $r;
		}

	};

?>