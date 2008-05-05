<?	class UCProcessChart extends UseCase 	{		function action($p)		{		        $s = $this->eachPage();			$this->chart->setPrice($this->user->getPrice()."_price");			$opt = (isset($_GET['opt']) && is_numeric($_GET['opt'])) ? $_GET['opt'] : 0 ;										if((count($this->chart->get()) == 0 || $this->chart->getTotal() == 0) and $opt != 3) {				$s .= $this->chart->getXML();			} else {				switch($opt) {					case(1): {						// Accepted						$s .= $this->acceptRequest();					    break;					}								case(2): {					    // Rejected					    $s .= $this->rejectRequest();						break;					}									case(3): {						// Finished						$s .= $this->getDocument("request_complete");						break;					}										default: {						$s .= $this->showChart();					}				}			}			$p->add("<document>".$s."</document>");			return $p;		}		function acceptRequest()		{			global $db, $order_email;			$s = "";					$uid = $this->user->getId();			$tmark = date("Y-m-d H:i:s");			$ip = getenv("REMOTE_ADDR");			$total = $this->chart->getTotal();						$db->query("INSERT INTO requests SET user='$uid', tmark='$tmark', ip='$ip', total='$total', state='1'");						$res = $db->query("SELECT * FROM requests WHERE user='$uid' AND tmark='$tmark' AND ip='$ip' AND total='$total' AND state='1'");			$rid = $res[0]['id_requests'];				$os = "<table border='1' width='100%' cellpadding='3' cellspacing='0' style='border: 1px solid #999999; border-collapse: collapse'>";			$a = $this->chart->get();			$p = $this->user->getPrice()."_price";			foreach($a as $r) {				$db->query("INSERT INTO request_items SET request='$rid', product='$r[id_products]', num='$r[num]', price='".$r[$p]."', title='$r[title]', pid='$r[id_products]'");				$db->query("UPDATE products SET saled = saled + $r[num] WHERE id_products='$r[id_products]'");				$os .= "<tr>";				$os .= "<td valign='top' align='left'>$r[id_products]</td>";				$os .= "<td valign='top' align='left'>$r[title]<br><small>$r[shortinfo]</small></td>";				$os .= "<td valign='top' align='right'>$r[num]</td>";				$os .= "<td valign='top' align='right'>".$r[$p]."</td>";				$os .= "</tr>";			}			$os .= "</table>";
						$res[0]['ritems'] = $os;
			
			$ri = $this->chart->get();
			for($i = 0; $i < count($ri); $i++) $ri[$i]['price'] = $ri[$i][$p];
			$res[0]['requested'] = $ri;			$res[0]['useritem'] = $this->user->getRow();			$res[0]['login'] = $this->user->getLogin();
						$this->mailDocument($this->user->getMail(), "[WebShop] Ваш заказ в интернет-магазине", 'new_request', $res[0]);
			$this->mailRequest($res[0]);			
						$this->chart->flush();			$s .= "<relocate><url>?usecase=ProcessChart&amp;opt=3</url></relocate>";			return $s;		}		function rejectRequest()		{			$s = "";			$this->chart->flush();			$s .= "<relocate><url>/</url></relocate>";			return $s;		}			function showChart()		{			$s = "";						$s .= "<request>"; 			$s .= $this->chart->getXML();			$s .= "</request>"; 			return $s;		}

		function mailRequest($r)
		{
			global $admin_email, $order_email, $root_xslt;

			$m = new MailMessage($admin_email);
			$t = new XMLPage();
			$rq = new XMLPage();
			
			$t->add("<maildocument>\n");
			$t->add($this->getDocument('new_request', $r));
			$t->add("</maildocument>\n");
			$s = $t->process("xsl/root.xslt");
			$m->applyInfo("[R: ".$r['id_requests']." ] Новый заказ", $s);
			
			$rq->add("<document>".$this->xmlize($r)."</document>");
			$z = $rq->process('xsl/requestitem.xslt');
			$z = str_replace("<?xml version=\"1.0\" encoding=\"UTF-8\"?>","<?xml version=\"1.0\"?>\n<?mso-application progid=\"Excel.Sheet\"?>", $z);
			$m->attachAsFile("web-".$r['id_requests'].".xls", $z);
			
			$m->sendTo($order_email);			
		}		function defaultAction($p)		{				$s = $this->eachPage();			$s .= $this->getDocument("access_denited");			$p->add("<document>".$s."</document>");			return $p;		}	}?>