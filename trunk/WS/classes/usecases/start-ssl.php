<?
					$ip = getenv("REMOTE_ADDR");
					if(count($res) < 5) {
						$res = $db->query("SELECT id_sessions FROM sessions WHERE sid='$sid' AND tmark='$now' AND ip='$ip' AND obj='$obj'");