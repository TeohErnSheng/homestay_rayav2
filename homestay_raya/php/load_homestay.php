<?php
	include_once("dbconnect.php");
	$username = $_POST['Username'];
	$sqlloadproduct = "SELECT * FROM homestay WHERE Username = '$username'";
	$result = $conn -> query($sqlloadproduct);
	if ($result -> num_rows > 0) {
		$homestayarray["homestay"] = array();
		while ($row = $result -> fetch_assoc()) {
			$hslist = array();
			$hslist['HomestayId'] = $row['HomestayId'];
			$hslist['Name'] = $row['Name'];
			$hslist['Username'] = $row['Username'];
			$hslist['Address'] = $row['Address'];
			$hslist['Pax'] = $row['Pax'];
			$hslist['Facilities'] = $row['Facilities'];
			$hslist['Price'] = $row['Price'];
			$hslist['State'] = $row['State'];
			$hslist['Locality'] = $row['Locality'];
			$hslist['Latitude'] = $row['Latitude'];
			$hslist['Longitude'] = $row['Longitude'];
			array_push($homestayarray["homestay"],$hslist);
		}
		$response = array('status' => 'success', 'data' => $homestayarray);
    sendJsonResponse($response);
		}else{
		$response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
	}
	
	function sendJsonResponse($sentArray)
	{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
	}