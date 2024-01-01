<?php
// the dbconnection file
require_once 'dbconnection.php';

class MonanDAL{
	/**
	 * Lấy danh sách món ăn theo từng sinh viên
	 *
	 * @param string mssv	Mã sinh viên
	 * @return array[] Danh sách món ăn
	 */
	public function get($mssv)
	{
		$dbConnection = new DBConnection();
		$conn = $dbConnection->getConnection();
		$query = 'SELECT ma, ten FROM monan_tbl WHERE mssv = ?';
		$stmt = $conn->prepare($query);
		$stmt->bind_param("s", $mssv);
		$list = array();
		$stmt->execute();
		$result = $stmt->get_result();
		$stmt->close();
		while ($row = $result->fetch_assoc())
		{
			$list[] = $row;
		}
		return $list;
	}
	
	/**
	 * Thêm 1 món ăn vào CSDL
	 *
	 * @param string mssv	Mã sinh viên
	 * @param string ten	Tên món ăn
	 * @return int	ID của món ăn mới thêm
	 */
	public function insert($mssv, $ten)
	{
		$ret = 0;
		$dbConnection = new DBConnection();
		$conn = $dbConnection->getConnection();
		$query = 'INSERT INTO monan_tbl (ten, mssv) VALUES (?, ?)';
		$stmt = $conn->prepare($query);
		$stmt->bind_param("ss", $ten, $mssv);
		$stmt->execute();
		$ret = $stmt->insert_id;
		$stmt->close();
		return $ret;
	}
	
	/**
	 * Xóa 1 món ăn
	 *
	 * @param string mssv	Mã sinh viên
	 * @param integer ma	Mã món ăn
	 * @return int	Số món ăn đã xóa
	 */
	public function delete($mssv, $ma)
	{
		$ret = 0;
		$dbConnection = new DBConnection();
		$conn = $dbConnection->getConnection();
		$query = 'DELETE FROM monan_tbl WHERE ma = ? AND mssv = ?';
		$stmt = $conn->prepare($query);
		$stmt->bind_param("is", $ma, $mssv);
		$stmt->execute();
		$ret = $stmt->affected_rows;
		$stmt->close();
		return $ret;
	}
}

