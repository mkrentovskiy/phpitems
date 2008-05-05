<?

	//
	// Class for all trafic acctounting cotrol
	//
	class TraficAccounting
	{

		function TraficAccounting() {}

		function showControlPanel($uc)
		{
			
			$s = "<controlpanel>";	

			$s .= "<fdate>". $_COOKIE['c_fdate']."</fdate>";
			$s .= "<tdate>". $_COOKIE['c_tdate']."</tdate>";
			$s .= "<ldate>". $_COOKIE['c_ldate']."</ldate>";
			
			// show aliases
			$s .= $this->showAliases($uc);
			
			$s .= "</controlpanel>";
			
			return $s;
		}
			
		function addAlias($uc, $ip, $name)
		{
			global $db; 
			
			$group = $this->getGroupForIP($ip);
			$db->query("INSERT INTO ip_names SET ip='$ip', name='$name', gr='$group'");
			return $this->showAliases($uc);
		}
		
		function commitAlias($uc, $oldip, $ip, $name)
		{
			global $db; 
			
			$db->query("DELETE FROM ip_names WHERE ip='$oldip'");
			return $this->addAlias($uc, $ip, $name);
		}
		
		function deleteAlias($uc, $ip)
		{
			global $db; 
			
			$db->query("DELETE FROM ip_names WHERE ip='$ip'");
			return "";
		}
		
		function showTraficReport($uc, $dfrom, $dto, $grs, $perday)
		{
			global $db;
			
			$s = "<report from='$dfrom' to='$dto' perday='$perday'>";
			
			$a_g = $this->getGroups();
			$a_ip = $this->getAliases();
			
			list($fd, $fm, $fy) = explode('.', $dfrom); 
			list($td, $tm, $ty) = explode('.', $dto); 
			
			$res = $db->query("SELECT ip_dst, SUM(bytes) FROM acct_v2 WHERE stamp_inserted > '$fy-$fm-$fd 00:00:00' AND stamp_inserted < '$ty-$tm-$td 23:59:59' AND NOT(ip_dst LIKE '192.168.%'  AND ip_src LIKE '192.168.%') GROUP BY ip_dst ORDER BY ip_dst");
			$total = 0;
			foreach($a_g as $gid => $gname) {
				if(in_array($gid, $grs)) {
					$s .= "<group name='$gname'>";
					$tg = 0;
					foreach($res as $r) {
						if($this->getGroupForIP($r['ip_dst']) == $gid) {
							$user = $uc->getUser();
							if(!$this->hideIP($user->getLogin(), $r['ip_dst'])) {
								$s .= "<entry>";	

								list($ia, $ib, $ic, $id) = explode('.', $r['ip_dst']);
								$s .= "<key>".($ic * 1000 + $id)."</key>";	
								$s .= "<ip>". $r['ip_dst']."</ip>";	
								$s .= "<name>". (strlen($a_ip[($r['ip_dst'])]) ? $a_ip[($r['ip_dst'])] : $r['ip_dst'])."</name>";	
								$s .= "<value>".$this->dNice($r['SUM(bytes)'])."</value>";
								$s .= "<bytes>".$r['SUM(bytes)']."</bytes>";
								$s .= "</entry>";
							
								$tg += $r['SUM(bytes)'];
								$total += $r['SUM(bytes)'];
							}
						}
					}
					$s .= "<total>".$this->dNice($tg)."</total>";
					$s .= "</group>";
				}
			}
			$s .= "<total>".$this->dNice($total)."</total>";
			
			if($perday) {
				$s .= "<perday>";
				$res = $db->query("SELECT DATE_FORMAT(stamp_inserted, '%e.%m.%Y') AS day, SUM(bytes) FROM acct_v2 WHERE stamp_inserted > '$fy-$fm-$fd 00:00:00' AND stamp_inserted < '$ty-$tm-$td 23:59:59' AND NOT(ip_dst LIKE '192.168.%'  AND ip_src LIKE '192.168.%') GROUP BY day ORDER BY day");
				foreach($res as $r) {
					$s .= "<entry>";	
					$s .= "<day>". $r['day']."</day>";	
					$s .= "<value>".$this->dNice($r['SUM(bytes)'])."</value>";
					$s .= "</entry>";		
				}
				$s .= "</perday>";			
			}
			$s .=  '</report>';
			
			return $s;
		}
		
		function showTraficReportItem($uc, $tmark, $ip)
		{
			global $db;
			$s = '<reportitem>';

			$a_ip = $this->getAliases();
		
			if(isset($tmark)) {
				$s .= '<date>'.$tmark.'</date>';
				if(isset($ip) && strlen($ip) > 8) $s .= '<host>'.(strlen($a_ip[$ip]) ? $a_ip[$ip] : $ip).'</host>';

				list($d, $m, $y) = explode('.', $tmark);
			
				if(isset($ip) && strlen($ip) > 8)
					$res = $db->query("SELECT ip_src, ip_dst, bytes, DATE_FORMAT(stamp_inserted, '%k:%i') AS tm FROM acct_v2 WHERE stamp_inserted > '$y-$m-$d 00:00:00' AND stamp_inserted < '$y-$m-$d 23:59:59' AND ip_dst='$ip' AND NOT(ip_src LIKE '192.168.%') ORDER BY tm");
				else
					$res = $db->query("SELECT ip_src, ip_dst, bytes, DATE_FORMAT(stamp_inserted, '%k:%i') AS tm FROM acct_v2 WHERE stamp_inserted > '$y-$m-$d 00:00:00' AND stamp_inserted < '$y-$m-$d 23:59:59' AND NOT(ip_dst LIKE '192.168.%'  AND ip_src LIKE '192.168.%') ORDER BY tm");
					
				$total = 0;
				foreach($res as $r) {
					$user = $uc->getUser();		
					if(!$this->hideIP($user->getLogin(), $r['ip_src']) && 
						!$this->hideIP($user->getLogin(), $r['ip_dst'])) {
						$r['shost'] = strlen($a_ip[($r['ip_src'])]) ? $a_ip[($r['ip_src'])] : $r['ip_src'];
						$r['dhost'] = strlen($a_ip[($r['ip_dst'])]) ? $a_ip[($r['ip_dst'])] : $r['ip_dst'];

						list($ia, $ib, $ic, $id) = explode('.', $r['ip_src']);
						$r['skey'] = $ia * 100000000 + $ib * 1000000 + $ic * 1000 + $id;
						list($ia, $ib, $ic, $id) = explode('.', $r['ip_dst']);
						$r['dkey'] = $ia * 100000000 + $ib * 1000000 + $ic * 1000 + $id;

						$r['total'] = $this->dNice($r['bytes']);
						$total += $r['bytes'];
					
						$s .= "<entry>";	
						$s .= $uc->xmlize($r);
						$s .= "</entry>";
					}		
				}
				$s .= "<total>".$this->dNice($total)."</total>";
			} 
			$s .= '</reportitem>';
			return $s;
		}
		
		function showLogReport($uc, $date, $grs)
		{
			global $db;
			
			$s = "<log date='$date'>";
			
			$a_g = $this->getGroups();
			$a_ip = $this->getAliases();
			
			list($d, $m, $y) = explode('.', $date); 
			
			$res = $db->query("SELECT *, DATE_FORMAT(`time`, '%k:%i') AS tm FROM squid WHERE `time` > '$y-$m-$d 00:00:00' AND `time` < '$y-$m-$d 23:59:59' ORDER BY `time`");
			
			foreach($a_g as $gid => $gname) {
				if(in_array($gid, $grs)) {
					$s .= "<group name='$gname'>";
					foreach($res as $r) {
						if($this->getGroupForIP($r['ip']) == $gid) {
							$user = $uc->getUser();
							if(!$this->hideIP($user->getLogin(), $r['ip'])) {
								$r['host'] = strlen($a_ip[($r['ip'])]) ? $a_ip[($r['ip'])] : $r['ip'];
								$r['bt'] = $this->dNice($r['bytes']);
							
								$s .= "<entry>";	
								$s .= $uc->xmlize($r);
								$s .= "</entry>";
							}
						}
					}
					$s .= "</group>";
				}
			}
			$s .=  '</log>';
			
			return $s;
		}
		
		// Private
		function showAliases($uc)
		{
			global $db; 
			
			$s = "<aliases>";	

			$res = $db->query("SELECT * FROM ip_groups ORDER BY id");
			$qes = $db->query("SELECT * FROM ip_names ORDER BY ip"); 
			foreach($res as $r) {
				$s .= "<group>";
				$s .= $uc->xmlize($r);
				
				$s .= "<list>";
				foreach($qes as $q) {
					if($q['gr'] == $r['id']) {
						$s .= "<item>" . $uc->xmlize($q) . "</item>";
					}
				}
				$s .= "</list>";
				
				$s .= "</group>";
			}
			
			$s .= "</aliases>";

			return $s;
		}
		
		function getGroupForIP($ip)
		{
			$gi = array(
					"0" => "1", 
					"1" => "1", 
					"2" => "2", 
					"3" => "2",
					"4" => "3", 
					"6" => "1" 		
				);
					
			list($a, $b, $c, $d) = explode('.', $ip);
			return ( ($a == '192' && $b == '168') ? $gi[$c] : 0);
		}
		
		function getGroups()
		{
			global $db;			
			$a = array();
			
			$res = $db->query("SELECT * FROM ip_groups ORDER BY id");
			$qes = $db->query("SELECT * FROM ip_names ORDER BY ip"); 
			foreach($res as $r) {
				$a[($r['id'])] = $r['name'];
			}
			return $a;
		}
		
		function getAliases()
		{
			global $db;			
			$a = array();
			
			$res = $db->query("SELECT * FROM ip_names ORDER BY ip");
			foreach($res as $r) $a[($r['ip'])] = $r['name'];
			return $a;
		}
		
		function dNice($k)
		{
			$s = array();

			$n = sprintf("%u",$k);
			$i = strlen($n);			
			do {
				if($i == strlen($n)) $j = $i % 3;
				else $j = 3;
				if($j == 0) $j = 3; 
				
				$t = substr($n, strlen($n) - $i, $j);
				array_push($s,$t);	
				$i = $i - $j;		
			} while($i > 0);
			return (implode(' ',$s));
		}
		
		function hideIP($user, $ip)
		{
			if($user == "occ") return false;
			else if($ip == "192.168.0.50" || $ip == "192.168.6.2") return true;
		}
	}
	
?>