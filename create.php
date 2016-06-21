<?php
	
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: text/html; charset=utf-8");

	function connectDB() {
		$mysqli = new mysqli("localhost", "PHP", "12345", "php_lessons");
		mysqli_query($mysqli,"SET NAMES UTF8");
		return $mysqli;
	}

	function addRec(){
	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata);
	$name = $request->name;
	$time = $request->time;
	$ingredient = $request->ingredient;
	$description = $request->description;
	$link = $request->link;
	$mysqli = connectDB();
	$mysqli->query("INSERT INTO receipts 
				(name,time,ingredient,description,link) 
				VALUES
				('$name','$time','$ingredient','$description','$link')");
	}

	addRec();

?>