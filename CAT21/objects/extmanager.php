<?

	class ExtManager
	{
		var	$user;
		
		function ExtManager()
		{
		}

		function execute()
		{
			global $cat_session;	

			$cat_need_auth = false;	
			if($cat_session->isRegistered('cat_session_user')) {
				$this->user = $cat_session->get('cat_session_user');
			};				
                        
			if(!$cat_need_auth) {
				if(is_object($this->user) && $this->user->isValid()) {
					$this->action();
				};
			};
		}

		//
		//
		//

		function action()
		{
			global $cat_session, $cat_obj, $cat_method;
			
			eval('$obj = new '.$cat_obj.';');
			if(is_object($obj)) {
				eval('$obj->'.$cat_method.'($this->user);');
			}; 	
		}

	}


?>