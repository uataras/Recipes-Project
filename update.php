<?php

	header("Access-Control-Allow-Origin: *");
	header("Content-Type: text/html; charset=utf-8");

	function connectDB() {
		$mysqli = new mysqli("localhost", "PHP", "12345", "php_lessons");
		mysqli_query($mysqli,"SET NAMES UTF8");
		return $mysqli;
	}

	function updateReceipt(){
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		$id = $request->id;
		$name = $request->name;
		$time = $request->time;
		$ingredient = $request->ingridient;
		$description = $request->description;
		$link = $request->linkImg;
		$mysqli = connectDB();
		
		//$res = $mysqli->query("SELECT * FROM receipts");
		$resultDB = $mysqli->query("UPDATE receipts SET
				name='$name',
				time='$time',
				ingredient='$ingredient',
				description='$description',
				link='$link' 
				WHERE id='$id';");
	}

	updateReceipt();

?>