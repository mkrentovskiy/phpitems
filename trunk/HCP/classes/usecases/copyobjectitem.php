<?
				isset($_GET['pid']) && is_numeric($_GET['pid'])) {
				$cf = new ClassFactory;				
				$s = $cf->copyObject($this, $_GET['oid'], $_GET['pid']);