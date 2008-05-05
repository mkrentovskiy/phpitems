<?

	class ExcelImport 
	{
		var	$cats;
		var	$items;
		var	$flags;

		function parseXMLParams($xml)
		{
		    global $cat_db;
			
			$this->cats = array();
			$this->items = array();
			$this->flags = array();

	        $xml = str_replace('&#10;', ' ', $xml);
		    $xml = str_replace('&quot;', '"', $xml);
			$xml = str_replace('&lt;', '', $xml);
		    $xml = str_replace('&gt;', '', $xml);

			$this->flags['parent'] = 0;
			$this->flags['top'] = 0;
			$this->flags['subtop'] = 0;
			$this->flags['k'] = 0;
			$this->flags['p'] = 0;
	        
			$parser = xml_parser_create();
      		
			//xml_set_object($parser, &$this);  
			xml_set_element_handler($parser, "_begin", "_end");
			xml_set_character_data_handler($parser, "_item");

   			if(!xml_parse($parser, $xml)) {
				print( xml_error_string(xml_get_error_code($parser)) . " - " . xml_get_current_line_number($parser));
   			}
			xml_parser_free($parser);

			// print_r($this->cats);
			// print_r($this->items);

			$cat_db->query("DELETE FROM categories");
			foreach($this->cats as $p) {
				$cat_db->query("INSERT INTO categories SET id_categories='$p[id]', title='".str_replace("'", "\'",$p['title'])."', pos='$p[pos]', enable='1', i_base='$p[base]'");
			};

			$a = array();
			$res = $cat_db->query("SELECT id_products FROM products");
			foreach($res as $r) array_push($a, $r['id_products']);
		
			foreach($this->items as $p) {
				if(in_array($p['id'], $a)) {
					$cat_db->query("UPDATE products SET title='".str_replace("'", "\'",$p['title'])."', category='$p[cat]', c_price='$p[price]', d_price='$p[price]' WHERE id_products='$p[id]'");
				} else {
					$cat_db->query("INSERT INTO products SET id_products='$p[id]', title='".str_replace("'", "\'",$p['title'])."', category='$p[cat]', c_price='$p[price]', d_price='$p[price]', warranty='$p[warranty] месяцев', saled='0', is_lead='0'");
				}
			}
		}

		function _begin($par, $name, $attr)
		{
			if(strtolower($name) == 'row') {
				$this->flags['t'] = array();
				$this->flags['rt'] = 0;				
			} else if(strtolower($name) == 'cell') {
				@$this->flags['style'] = $attr['SS:STYLEID'];
			} else if(strtolower($name) == 'data') {
				$this->flags['now'] = true;				
			}			
		}

		function _end($par, $name)
		{
			if(strtolower($name) == 'row') {
				if(strlen($this->flags['t']['title']) < 1) return;
				if(strlen($this->flags['t']['id']) < 1 && $this->flags['rt'] == 3) {
					$this->flags['rt'] = 2;
				}
				
				switch($this->flags['rt']) {
					case(1): {
						// Category
						$id = $this->flags['k'] + 1;

						$this->flags['t']['id'] = $id;
						$this->flags['t']['base'] = 0;
						$this->flags['t']['pos'] = $id;
						$this->flags['parent'] = $id;
						$this->flags['top'] = $id;
						$this->flags['subtop'] = 0;
						$this->flags['k'] = $id;
						
						array_push($this->cats, $this->flags['t']);												
						break;
					}
					case(2): {
					    // Subcategory
						$id = $this->flags['k'] + 1;

						$this->flags['t']['id'] = $id;
						$this->flags['t']['pos'] = $id;
						$this->flags['t']['base'] = $this->flags['top'];
						
						$this->flags['subtop'] = $id;
						$this->flags['parent'] = $id;
						$this->flags['k'] = $id;
						
						array_push($this->cats, $this->flags['t']);																		
						break;
					}

					case(4): {
					    // Subsubcategory
						$id = $this->flags['k'] + 1;

						$this->flags['t']['id'] = $id;
						$this->flags['t']['pos'] = $id;
						$this->flags['t']['base'] = $this->flags['subtop'];

						$this->flags['parent'] = $id;
						$this->flags['k'] = $id;
						
						array_push($this->cats, $this->flags['t']);																		
						break;
					}
					
					
					case(3): {
						// Item
						$this->flags['t']['cat'] = $this->flags['parent'];

						array_push($this->items, $this->flags['t']);								
					  	break;
					} 
				}
                $this->flags['rt'] = 0;
			} else if(strtolower($name) == 'data') {
				$this->flags['now'] = false;				
			}
		}

		function _item($par, $data)
		{
			if($this->flags['now']) {
				switch($this->flags['style']) {
					case('s95') : {
			            // id
						$this->flags['t']['id'] = trim($data);
						$this->flags['rt'] = 3;
						break;
					}
					case('s96') : {
			            // title
						if(strlen($this->flags['t']['title']) > 1) {
							$this->flags['t']['title'] .= " ".str_replace('/', ', ', trim($data));
						} else {
							$this->flags['t']['title'] = str_replace('/', ', ', trim($data));
						}
						$this->flags['rt'] = 3;
						break;
					}
					case('s97') : {
						// price
						$this->flags['t']['price'] = trim($data);
						$this->flags['rt'] = 3;			
						break;
					}
					case('s98') : {
						// warraty
						$this->flags['t']['warranty'] = trim($data);
						$this->flags['rt'] = 3;
						break;
					}
					
					case('s161') : 
					case('s164') : {
						// top header
						$this->flags['t']['title'] = str_replace('/', ', ', trim($data));
						$this->flags['rt'] = 1;
						break;
					}
					case('s90') :
					case('s100') : {
						// header
						$this->flags['t']['title'] = str_replace('/', ', ', trim($data));
						$this->flags['rt'] = 2;		
						break;
					}
					case('s89') : {
						// subheader
						$this->flags['t']['title'] = str_replace('/', ', ', trim($data));
						$this->flags['rt'] = 4;			
						break;
					}
				}
			} 
		}

	}

	//
	// Test
	//

	// $a = new ExcelImport;
	// $a->parseXMLParams(implode('', file("products.xml")));
	
?>