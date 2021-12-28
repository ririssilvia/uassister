<?php
require_once('../config.php');
$IdBarang = $_GET['idbarang'];
$myArray = array();
header('Content-type: application/json');

$sql = "SELECT * FROM barang  WHERE IdBarang = '$IdBarang' ";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
if(mysqli_num_rows($result) == 1) {
	echo json_encode([
		'status' => 200,
		'data' => $row
	]);
} else {
	echo json_encode(array('msg' => "not found"));
}
mysqli_close($conn);

// if ($result = mysqli_query($conn, "SELECT * FROM barang  WHERE IdBarang = '$IdBarang' " )) {
//     	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
//         	$myArray[] = $row;
//     	}
// 	mysqli_close($conn);
//     	echo json_encode($myArray);
// }