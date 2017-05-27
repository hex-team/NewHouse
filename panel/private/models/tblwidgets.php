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
			var_dump($_data);
			return parent::_insert([
				'name' => $_name,
				'data' => $_data,
				'last_update' => NOW,
				'is_active' => $_isActive]);
		}

		public function get ($_name)
		{
			$where = 'name = \'' . $_name . '\'';

			$result = parent::_select(['id', 'name', 'data'], $where);

			while ($row = $result -> fetch(PDO::FETCH_ASSOC)) $fetchedResult[] = $row;

			return $fetchedResult;
		}

		public function update ($_id, $_params)
		{
			$where = 'id = \'' . $_id . '\'';

			return parent::_update($_params, $where);
		}

		public function delete ($_id)
		{
			$whereStr = 'id = ' . $_id;

			$dQuery = 'DELETE FROM ' . $this -> tableName . (empty($_whereStr) ? null : ' WHERE ' . $_whereStr) . ';';

			return (bool) $this -> dbh -> execute($dQuery);
		}
	}
?>