<?php 

// Connect to MySQL database via PDO extension
function PDOConnect($dbname = 'idev_diykit', $user = 'root', $pass = '', $host = '127.0.0.1') {
	try {
		// Create database handler
		$dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		print "PDO Error: " . $e->getMessage() . "<br/>";
		die();
	}

	// Return database handler
	return $dbh;
}

// Query MySQL database using PDO extension
function PDOQuery($query, $dbh, $bindings = array()) {
	try {
		$stmt = $dbh->prepare($query);

		if(count($bindings) == 0) 
			$stmt->execute();
		else
			$stmt->execute($bindings);
		
	} catch (PDOException $e) {
		echo "A database error has occured. Please contact dmzhelp@ryerson.ca for assistance.";
		$message = "<b>".date('Y-m-d H:i:s')."</b><br>Location: ".$_SERVER['PHP_SELF']."<br>Attempted Query: ".$query."</br>Database error: ".$e->getMessage()."<br><br>"; 
		echo $message;
		die();
	}
	
	// Return statement handler
	return $stmt;
}

// Query MySQL database using PDO extension then return JSon Object
function PDOQueryToJson($query, $dbh, $formToDBMapping = array(), $bindings = array()) {
	try {
		$stmt = $dbh->prepare($query);

		if(count($bindings) == 0) 
			$stmt->execute();
		else
			$stmt->execute($bindings);

		$appData = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$toReturn = array();

		$idx = 0;
		foreach ($appData as $row) {
			$item = array();
			foreach ($row as $key => $value) {
				$item[array_search($key, $formToDBMapping)] = $value;
			}
			$toReturn[$idx++] = $item;
		}

		return '{"rows": '. json_encode($toReturn) .'}';
		
	} catch (PDOException $e) {
		echo "A database error has occured. Please contact dmzhelp@ryerson.ca for assistance.";
		$message = "<b>".date('Y-m-d H:i:s')."</b><br>Location: ".$_SERVER['PHP_SELF']."<br>Attempted Query: ".$query."</br>Database error: ".$e->getMessage()."<br><br>"; 
		echo $message;
		die();
	}
	
	// Return statement handler
	return $stmt;
}

// Encode
function encode($str) {
	return urlencode(base64_encode(convert_uuencode($str)));
}

// Decode
function decode($str) {
	return convert_uudecode(base64_decode($str));
}

// Print array in a readable format
function printArr($arr, $exit = false) {
	echo '<pre>', print_r($arr, true), '</pre>';
	
	if($exit) exit; // Optional exit flag (usually for debugging purposes)
}


?>