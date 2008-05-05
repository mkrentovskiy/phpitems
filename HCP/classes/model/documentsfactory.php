<?
	
	class DocumentsFactory
	{
		
		function DocumentsFactory()
		{
		}
		
		function getDocumentsPanel($uc)
		{
			global $db;
			
			$s = '<documents>';
					
			$s .= implode('', file('xml/document.xml'));
			$s .= $uc->resQuery("SELECT id, type FROM d_documentstype ORDER BY pos", "documentstypes", "item");

			$cf =  new ClassFactory;
			$s .= $cf->treeBuild();			
			
			$tf = new TasksFactory;
			$s .= $tf->getTaskPanel($uc, 1);
			
			$s .= '</documents>';
			
			print htmlspecialchars($s);
			
			return $s;
		}
		
	}

?>