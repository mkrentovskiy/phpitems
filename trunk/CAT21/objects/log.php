<?
	//
	//
	//
        define('CAT_LOG_CLEAR',1);

	class Log
	{
		var	$user;
		var	$valid;

		function Log($user)
		{
			$this->user = $user;
			if(strlen($this->user) > 0) $this->valid = true;
			else $this->valid = false;
		}

		function setUser($user)
		{
			if(strlen($user) > 0) {
				$this->valid = true;
				$this->user = $user;
			};
		}

		function event($object,$event)
		{
			if($this->valid) {
				global $cat_db;
		
				$ip = getenv("REMOTE_ADDR");
				$cat_db->query("insert into cat_log values(now(),'$object','$this->user','$event','$ip')");
			};
		}
	
		function show($begin)
		{
			global $cat_db, $cat_tv_npp, $cat_tv_ppp, $cat_pos, $cat_mod, $cat_obj;
			
			$s = "";

			if(empty($begin)) $begin = 0;
			
			$res = $cat_db->query("select * from cat_log order by tmark desc limit $begin,$cat_tv_npp");
			$s .= "<table width='100%' border='0' cellpadding='2' cellspacing='1' class='pt9'><tr>";
			$s .= "<td class='header' align='center'>$GLOBALS[cat_m_log_tmark]</td>";
			$s .= "<td class='header' align='center'>$GLOBALS[cat_m_log_object]</td>";
			$s .= "<td class='header' align='center'>$GLOBALS[cat_m_log_user]</td>";
			$s .= "<td class='header' align='center'>$GLOBALS[cat_m_log_event]</td>";
			$s .= "<td class='header' align='center'>$GLOBALS[cat_m_log_ip]</td>";
			$s .= "</tr>";

			for($j = 0; $j < count($res); $j++) {
				$s .= "<tr>";	
				if($j % 2 == 0) $class = 'finfo'; else $class = 'ninfo';
				$s .= "<td class='$class'>".dateToStr($res[$j][tmark])."</td>";
				$s .= "<td class='$class'>".$res[$j][object]."</td>";
				$s .= "<td class='$class'>".$res[$j][user]."</td>";
				$s .= "<td class='$class'>".$res[$j][event]."</td>";
				$s .= "<td class='$class'>".$res[$j][ip]."</td>";
				$s .= "</tr>";
			};
			$s .= "</table><br>";

			$URL = "?cat_pos=$cat_pos&cat_mod=$cat_mod&cat_obj=$cat_obj";
			$res = $cat_db->query("select count(tmark) from cat_log");
			if(count($res) == 1) $total = $res[0]['count(tmark)'];
			else $total = 0; 	

			$s .= "<div align='right'>$GLOBALS[cat_m_pages] : ";
		        if(($total % $cat_tv_npp) > 0) $npages = floor($total / $cat_tv_npp) + 1;
	    		else $npages = floor($total / $cat_tv_npp);
			
			$begin++; 
	    		$bp = floor($begin / $cat_tv_ppp) - $cat_tv_ppp / 2 + 1;
	    		$ep = floor($begin / $cat_tv_ppp) + $cat_tv_ppp / 2;
	    		if($bp < 1) { $ep = $ep + (1 - $bp); $bp = 1; }; 
		    	if($ep > $npages) { $bp = $bp - ($ep - $npages); $ep = $npages; };
	    		if($bp < 1 || $ep > $npages || $bp > $ep) { $bp = 1; $ep = $npages; }; 
    
	   		if($bp > 1) {
				$b = ($bp - 2) * $cat_tv_npp + 1;
				$e = ($bp - 1) * $cat_tv_npp;	
				$s .= "&nbsp;<a title='[$b-$e]' href='$URL&cat_begin=$b' class='pages'>&lt;</a>&nbsp;|&nbsp;";
	    		};
    
	    		for($i = $bp; $i < ($ep + 1); $i++) {
				$b = ($i - 1) * $cat_tv_npp + 1;
				$e = $i * $cat_tv_npp;
				if($begin >= $b && $begin <= $e) {
				if($i < $ep)
		    			$s .= "&nbsp;<b><font class='cpage'>$i</font></b>&nbsp;|";
				else 
					$s .= "&nbsp;<b><font class='cpage'>$i</font>&nbsp;</b>";		
				} else {
					if($i < $ep)
		    				$s .= "&nbsp;<a title='[$b-$e]' href='$URL&cat_begin=$b' class='pages'>$i</a>&nbsp;|";
					else
		    				$s .= "&nbsp;<a title='[$b-$e]' href='$URL&cat_begin=$b' class='pages'>$i</a>&nbsp;";
				};
	    		};

	    		if($ep < $npages) {
				$b = $ep * $cat_tv_npp + 1;
				$e = ($ep + 1) * $cat_tv_npp;	
				$s .= "|&nbsp;<a title='[$b-$e]' href='$URL&cat_begin=$b' class='pages'>&gt;</a>&nbsp;";
	    		};
	    
			$s .= " <br>$GLOBALS[cat_m_total] : <b><font class='cpage'>$total</font></b> &nbsp;</div>";					
			return $s;
		}

		function showClearForm()
		{
			global	$cat_pos, $cat_mod, $cat_obj, $cat_m_month, $cat_m_years;

			$date[2] = date("d");
			$date[1] = date("m");
			$date[0] = date("Y");
			$URL = "?cat_pos=$cat_pos&cat_mod=$cat_mod&cat_obj=$cat_obj";
			$s = "<table width='100%' border='0' cellpadding='1' cellspacing='0' bgcolor='#a9a9a9'><tr><td align='center'>";
			$s .= "<table width='100%' border='0' cellpadding='10' cellspacing='0' bgcolor='#f9f9f9' class='pt9'><tr><td align='right'>";
			$s .= "<form action='$URL' method='POST'><input type='hidden' name='cat_opt' value='".CAT_LOG_CLEAR."'>";
			$s .= "<input type='submit' class='sub' value='$GLOBALS[cat_m_clear]'> $GLOBALS[cat_m_log_from] ";
	    		$s .= "<select name='cat_log_clear_d' size=1>";
	    		for($i = 1; $i < 32; $i++) {
				if($i == $date[2])
		    			$s .= "<option value='$i' selected> $i";	
				else
		    			$s .= "<option value='$i'> $i";	
	    		};
	    		$s .= "</select>.<select name='cat_log_clear_m' size=1>";
	    		for($i = 1; $i < count($cat_m_month) + 1; $i++) {
				$j = $i - 1;
				if($i == $date[1])
		    			$s .= "<option value='$i' selected> $cat_m_month[$j]";	
				else
		    			$s .= "<option value='$i'> $cat_m_month[$j]";	
	    		};
	    		$s .= "</select>.<select name='cat_log_clear_y' size=1>";
	    		for($i = 0; $i < count($cat_m_years); $i++) {
				if($cat_m_years[$i] == $date[0])
		    			$s .= "<option value='$cat_m_years[$i]' selected> $cat_m_years[$i]";	
				else
		    			$s .= "<option value='$cat_m_years[$i]'> $cat_m_years[$i]";	
	    		};
	    		$s .= "</select></form></td></tr></table>";
			$s .= "</td></tr></table><img src='images/spacer.gif' width='1' height='3' alt='' border='0'>";
			return $s;
		}

		function clear($y,$m,$d)
		{
			global $cat_db;

			$res = $cat_db->query("select count(tmark) from cat_log where to_days(tmark) < to_days('$y-$m-$d 00:00:00')");
			$r = $cat_db->query("delete from cat_log where to_days(tmark) < to_days('$y-$m-$d 00:00:00')");
                        $s = "<table width='100%' border='0' cellpadding='1' cellspacing='0' bgcolor='#a9a9a9'><tr><td align='center'>";
			$s .= "<table width='100%' border='0' cellpadding='10' cellspacing='0' bgcolor='#f9f9f9' class='pt8'><tr><td align='center'>";
			$s .= $GLOBALS[cat_m_cleared].' '.$res[0]['count(tmark)'].' '.$GLOBALS[cat_m_entries].'.';
			$s .= "</td></tr></table>";
			$s .= "</td></tr></table><img src='images/spacer.gif' width='1' height='3' alt='' border='0'>";
			return $s;
		}
		
		function execute()
		{
			global 	$cat_opt, $cat_begin;
			
			$str = "<font class='title'>$GLOBALS[cat_m_log_title]</font><br><img src='images/spacer.gif' width='1' height='3' alt='' border='0'>";
			switch($cat_opt) {
				case(CAT_LOG_CLEAR): {
				        global 	$cat_log_clear_y, $cat_log_clear_m, $cat_log_clear_d;
					
					$str .= $this->clear($cat_log_clear_y, $cat_log_clear_m, $cat_log_clear_d); 
					$str .= $this->showClearForm();
					$str .= $this->show(0);
					break;
				}
				default: {
					$str .= $this->showClearForm();
					$str .= $this->show($cat_begin);						
				}
			};
			return $str;
		}
		
	};
    
?>