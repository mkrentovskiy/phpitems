<?
			
			
			$ri = $this->chart->get();
			for($i = 0; $i < count($ri); $i++) $ri[$i]['price'] = $ri[$i][$p];
			$res[0]['requested'] = $ri;
			
			$this->mailRequest($res[0]);			
			

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
		}