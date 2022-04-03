<?php
class DB {
    protected $conn;
    function __construct()
	{
		$dsn = "mysql:host=" . HOST . "; dbname=" . DB;
		try {
			$this->conn = new PDO($dsn, USER, PASS);
			$this->conn->query("set names 'utf8' ");
		} catch (Exception $e) {
			echo 'Lỗi: ' . $e->getMessage();
			exit;
		}
	}
	public function __destruct()
	{
		$this->conn = null;
	}

	public function query($sql, $arr = array())
	{
		$stm = $this->conn->prepare($sql);
		$stm->execute($arr);
		$data = $stm->fetchAll(PDO::FETCH_ASSOC);
		return $data;
	}
}

?>