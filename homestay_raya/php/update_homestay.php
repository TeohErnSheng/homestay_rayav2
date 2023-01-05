<?php
include_once("dbconnect.php");
$homestayId = $_POST['HomestayId'];
$name = $_POST['Name'];
$address = $_POST['Address'];
$pax = $_POST['Pax'];
$facility = $_POST['Facilities'];
$price = $_POST['Price'];
if (isset($_POST['image'])) {
    $encoded_string = $_POST['image'];
}
$sqlupdate = "UPDATE homestay SET Name='$name', Address ='$address',
Pax='$pax',Facilities='$facility',Price='$price' WHERE  HomestayId = '$homestayId'";
if ($conn -> query($sqlupdate) === TRUE) {
    $response = array('status' => 'success', 'data' => null);
    if (!empty($encoded_string)) {
        $decoded_string = base64_decode($encoded_string);
        $path = '../assets/images/'.$homestayId.'.png';
        $is_written = file_put_contents($path, $decoded_string);
    }
    sendJsonResponse($response);
} else {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
}
function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}
?>