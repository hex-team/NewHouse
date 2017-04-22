<?php
	final class TblUsers extends DbActionTemplate
	{
		private $id;

		public function __construct ()
		{
			parent::__construct(DB_DATA, TBL_USERS);
		}

		public function insert ($_username, $_password, $_firstname, $_lastname)
		{
			return parent::_insert([
				'username' => $_username,
				'password' => $_password,
				'first_name' => $_firstname,
				'last_name' => $_lastname]);
		}

		public function get ($_user = null)
		{
			$where = null;
			$fetchedResult = [];

			if ($_user != null) $where = (Validation::isNumber($_user) ? 'id = ' . $_user . ' OR ' : null) . 'username = \'' . $_user . '\'';

			$result = parent::_select(['*'], $where);

			while ($row = $result -> fetch(PDO::FETCH_ASSOC)) $fetchedResult[] = $row;

			return $fetchedResult;
		}

		public function getCount ($_user = null)
		{
			if ($_user != null) $where = 'id = ' . $_user . ' OR username = \'' . $_user . '\'';

			$result = parent::_select(['COUNT(*)'], $where);

			return $result -> fetchColumn();
		}

		public function update ($_user, $_params)
		{
			$where = null;

			if ($_user != null) $where = (Validation::isNumber($_user) ? 'id = ' . $_user . ' OR ' : null) . 'username = \'' . $_user . '\'';

			return parent::_update($_params, $where);
		}
	}
?>