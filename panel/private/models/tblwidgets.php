<?php
	final class TblWidgets extends DbActionTemplate
	{
		private $id;

		public function __construct ()
		{
			parent::__construct(DB_DATA, TBL_WIDGETS);
		}

		public function insert ($_name, $_data, $_isActive = ENABLE)
		{
			return parent::_insert([
				'name' => $_name,
				'data' => $_data,
				'is_active' => $_isActive]);
		}

		public function get ($_name)
		{
			$where = 'name = \'' . $_name . '\'';

			$result = parent::_select(['name', 'data'], $where);

			$fetchedResult = $result -> fetch(PDO::FETCH_ASSOC);

			return $fetchedResult;
		}

		public function update ($_name, $_params)
		{
			$where = null;

			$where = 'name = \'' . $_name . '\'';

			return parent::_update($_params, $where);
		}
	}
?>