<?

	class Chart
    {
		var	$objects;
		var	$id;
		var	$price;
	
		function Chart()
		{
			$this->objects = array();
			$this->id = 'id_products';
			$this->price = 'c_price';
		}

		function setPrice($p)
		{
			$this->price = $p;
		}

		function insert($r)
		{
			if($r['num'] < 1) return;
			$x = true;
			for($i = 0; $i < count($this->objects); $i++) {
				if($r[$this->id] == $this->objects[$i][$this->id]) {
					$this->objects[$i]['num'] += $r['num'];
					$x = false;
				};
			}				
			if($x) array_push($this->objects,$r);
		}

		function update($r)
		{
			for($i = 0; $i < count($this->objects); $i++) {
				if($r[$this->id] == $this->objects[$i][$this->id]) {
					$this->objects[$i]['num'] = $r['num'];
				};
			}				
		}

		function delete($r)
		{
			$z = array();
			for($i = 0; $i < count($this->objects); $i++) {
				if($r[$this->id] != $this->objects[$i][$this->id]) {
					array_push($z, $this->objects[$i]);
				};
			}				
			$this->objects = $z;			
		}

		function limit($r,$max)
		{
			if($max < 1) {
				$this->delete($r);
				return;
			};
			for($i = 0; $i < count($this->objects); $i++) {
				if($r[$this->id] == $this->objects[$i][$this->id]) {
					if($this->objects[$i]['num'] > $max) 
						$this->objects[$i]['num'] = $max;
				};
			}				
		}

		function flush()
		{
			$this->objects = array();
			$this->price = 'c_price';
			
		}


		function get()
		{
			return $this->objects;
		}

		function set($obj)
		{
			$this->objects = $obj;
		}

		function getTotal()
		{
			$sum = 0;
			foreach($this->objects as $r) $sum += $r['num'] * $r[$this->price];
			return $sum;
		}

		function getXML()
		{
			$total = 0;

			$s = "<chart>";
			if(count($this->objects) > 0) { 
				$sum = 0;
				foreach($this->objects as $r) {
					$s .= "<chartitem id='".$r[$this->id]."'>";
					$s .= $this->xmlize($r);
					$s .= "</chartitem>";
					
					$sum += $r['num'] * $r[$this->price];
				}				
				$s .= "<total>$sum</total>";
			};
			$s .= "</chart>";	
			return $s;
		}

		function getById($id)
		{
			$z = array();
			foreach($this->objects as $r) {
				if($r[$this->id] == $id) {
					$z = $r;
				}
			}				
			return $z;			
		}

		function xmlize($data)
		{
			$s = '';

			foreach($data as $key => $value) {
				if(!is_numeric($key)) 
					$s .= "<$key>".htmlspecialchars($value)."</$key>";
			};
			return $s;
		}		
						
    };

?>