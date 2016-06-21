<?php

	header("Access-Control-Allow-Origin: *");
	header("Content-Type: text/html; charset=utf-8");

	function connectDB() {
		$mysqli = new mysqli("localhost", "PHP", "12345", "php_lessons");
		mysqli_query($mysqli,"SET NAMES UTF8");
		return $mysqli;
	}

	function readReceipts() {
		$mysqli = connectDB();
		$result = $mysqli->query("SELECT id,name,time,
		ingredient,description,link FROM receipts");
		$count = 0;
		while($rows = $result->fetch_assoc()){
			$objArr[$count] = $rows;
			$count++;
		}
		return json_encode($objArr);
	}	

	if(isset($_GET['boot'])){
		header('Content-Type: application/json');
		echo readReceipts();
	}

	if(isset($_GET['delete'])){
		$id = abs((int)$_GET['delete']);
		$mysqli = connectDB();
		$mysqli->query("DELETE FROM receipts WHERE id='$id'");
	}

	if(isset($_GET['update'])){
		$id = abs((int)$_GET['update']);
		$mysqli = connectDB();
		$res = $mysqli->query("SELECT * FROM receipts WHERE id='$id'");
		$row = $res->fetch_assoc();
		echo json_encode($row);
	}

?>