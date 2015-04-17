<?php

	namespace Models\Interfaces;

	class Database
	{
		private $db; // database connection
		private $sth; // prepared query

		public function __construct($name, $host, $user, $pass)
		{
			$this->db = new \PDO('mysql:dbname=' . $name .
				';host=' . $host, $user, $pass);
		}

		public function setQuery($query)
		{
			$this->sth = $this->db->prepare($query);

			return $this;
		}

		public function setParam($params)
		{
			$count = count($params);

			for ($i = 1; $i <= $count; $i++) {
				$this->sth->bindParam($i, $params[$i - 1]);
			}

			return $this;
		}

		public function execute()
		{
			$this->sth->execute();

			return $this;
		}

		public function getResult()
		{
			return $this->sth->fetchAll();
		}

		public function __destruct()
		{
			$this->db = null;
		}
	}