<?
	class PageBuilder
	{

		function execute()
		{
			global $cat_db;
			
			$r = '';
			$pg = array(); // Array for page collection, use array_push
			
			// Process making files 

			$menu = $this->resQuery("SELECT * FROM menu ORDER BY pos", "menu", "item");
			$blocks = $this->resQuery("SELECT * FROM blocks", "blocks", "item");

			$res = $cat_db->query("SELECT * FROM struct WHERE enable='1' ORDER BY i_base, pos");
			foreach($res as $r) {
				if($r['is_link'] > 0) continue;
				
				if(strlen($r['filename']) > 1) $fn = $r['filename'];			
				else $fn = $r['id_struct'].'.html';
				
				$bfn = $fn;
				if($r['i_base'] > 0) {
					$k = 0;
					
					$t = $r;
					while($t['i_base'] > 0 && $k < 1000) {
						foreach($res as $g) {
							if($g['id_struct'] == $t['i_base']) {
								$t = $g;
								break;
							}
						} 
						$k++;
					}
					if(strlen($t['filename']) > 1) $bfn = $t['filename'];			
					else $bfn = $t['id_struct'].'.html';
				}

				$s = "<document filename='$fn' basefilename='$bfn'>";
				$s .= $this->xmlize($r);
				$s .= $blocks;
				$s .= $menu;
				if($fn == 'index.html') {
					$s .= $this->resQueryStruct("SELECT id_products, i_base, title, is_leaf FROM products WHERE enable='1' ORDER BY i_base, pos", 'products', 'product', 'sub', 'id_products', 'i_base');
				}				
				$s .= "</document>";
				
				$p = new XMLPage($fn);
				$p->add($s);
				array_push($pg, $p);
			}
			
			$fn = 'map.html';
			$s = "<document filename='$fn'>";
			$s .= "<title>Карта сайта</title>";
			$s .= $this->resQueryStruct("SELECT * FROM struct WHERE enable='1' ORDER BY i_base, pos", 'maplist', 'map', 'mapitem', 'id_struct', 'i_base');
			$s .= $blocks;
			$s .= $menu;
			$s .= "</document>";
				
			$p = new XMLPage($fn);
			$p->add($s);
			array_push($pg, $p);
							
			// Generate all files
			$result = '';
			foreach($pg as $p) 
				$result .= $p->toFile('..', 'xsl/root.xslt').'<br/>';
			
		    return $result;
		}
		
		//
		// Common XML functions
		//


		function pager($total, $begin, $npp, $ppp, $URL, $prefix = '')
		{

		    if(($total % $npp) > 0) $npages = floor($total / $npp) + 1;
	    	else $npages = floor($total / $npp);
			
    		$begin++;
			$cpage = ($begin - ($begin % $npp)) / $npp;   
	    		
    		$bp = $cpage - $ppp / 2 + 1;
    		$ep = $cpage + $ppp / 2;	
	    	if($bp < 1) { $ep = $ep + (1 - $bp); $bp = 1; }; 
		    if($ep > $npages) { $bp = $bp - ($ep - $npages); $ep = $npages; };
	    	if($bp < 1 || $ep > $npages || $bp > $ep) { $bp = 1; $ep = $npages; }; 
    
			$s = "<pages total='$npages' records='$total'>";
	   		
	   		if($bp > 1) {
				$b = ($bp - 2) * $npp + 1;
				$e = ($bp - 1) * $npp;	
 	 	        $iurl = $URL."&amp;".$prefix."begin=".($b - 1);
				$s .= "<ppage begin='$b' end='$e' URL='$iurl'>&lt;</ppage>";
	    	};
    
	    	for($i = $bp; $i < ($ep + 1); $i++) {
				$b = ($i - 1) * $npp + 1;
				$e = $i * $npp;
 	 	        $iurl = $URL."&amp;".$prefix."begin=".($b - 1);
					
 	 	        if($begin >= $b && $begin <= $e) {
					$s .= "<cpage begin='$b' end='$e'>$i</cpage>";
				} else {
					$s .= "<tpage begin='$b' end='$e' URL='$iurl'>$i</tpage>";
				};
	    	};

	    	if($ep < $npages) {
				$b = $ep * $npp + 1;
				$e = ($ep + 1) * $npp;	
 	 	        $iurl = $URL."&amp;".$prefix."begin=".($b - 1);
				$s .= "<npage begin='$b' end='$e' URL='$iurl'>&gt;</npage>";
	    	};
			$s .= "</pages>";			

			return $s;
		}

		function xmlize($data)
		{
			$s = '';

			if(!is_array($data)) return $s;

			foreach($data as $key => $value) {
				if(!is_numeric($key)) 
					$s .= "<$key>".htmlspecialchars($value)."</$key>";
			};
			return $s;
		}		


		function checkValue($a, $name, $default, $ttl, $prefix)
		{
			if(isset($a[$name]) && is_numeric($a[$name])) {
				setcookie('c_'.$prefix.'_'.$name,$a[$name],time() + $ttl);		
				$value = $a[$name]; 
			} else if(isset($_COOKIE['c_'.$prefix.'_'.$name])) {
				$value = $_COOKIE['c_'.$prefix.'_'.$name]; 
			} else $value = $default;

			return $value;
		}		
		
		function getListFromInput($q, $ra, $id, $value, $prefix)
		{	
			$rq = array();
		
			foreach($ra as $k => $v) {			
				if(ereg("f_".$prefix."_([0-9]{1,16})",$k,$rg)) {
					if(is_numeric($v) && $v > 0) {
						for($i = 0; $i < count($q); $i++) {
							if($q[$i][$id] == $rg[1]) {
								$q[$i][$value] = $v;
								array_push($rq, $q[$i]);
								break;
							}
						}
					}
				}	
			}
			return $rq;
		}

		function resQuery($q, $d, $sd, $nofilter = false)
		{
		    global $cat_db;
			
			$s = '';
			$res = $cat_db->query($q);
			if(count($res) > 0) {
				$s .= "<$d>\n";
				foreach($res as $r) {
					$s .= "\t<$sd>";
					$s .= $this->xmlize($r);
					$s .= "</$sd>\n";
				}
				$s .= "</$d>\n";
			};
			return $s;	
		}


		function resQueryStruct($q, $d, $sd, $ssd, $id, $base)
		{
		    global $cat_db;
			
			$s = '';
			$res = $cat_db->query($q);
			if(count($res) > 0) {
				$s .= "<$d>";
				$s .= $this->resQueryStructIter($res, 0, 1, $sd, $ssd, $id, $base);
				$s .= "</$d>";
			};
			return $s;	
		}

		function resQueryStructIter($res, $par, $k, $sd, $ssd, $id, $base)
		{
	        if($k > 1000) return;
			foreach($res as $r) {
				if($r[$base] == $par) {
					$s .= "\n<$sd level='$k'>";
					$s .= $this->xmlize($r);
					$x = $this->resQueryStructIter($res, $r[$id], $k + 1, $sd, $ssd, $id, $base);
					if(strlen($x) > 0) 
						$s .= "\n\t<$ssd>".$x."</$ssd>\n";
					$s .= "</$sd>";
				};
			};
			return $s;	
		}
		
	};


?>