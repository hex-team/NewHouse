<?php
	class UserView
	{
		public function show ($_view)
		{
			try
			{
				$_view = Maintenance::getViewOutput($_view);

				if (!@include_once $_view) throw new Exception(MODULE_MSG);
			}
			catch (Exception $ex)
			{
				Maintenance::handleExceptions($ex);
			}
		}
	}
?>