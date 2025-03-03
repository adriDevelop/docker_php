
<?php




try {
    require_once "connection.php";
    $data = json_decode(file_get_contents('php://input'));
    $dni = htmlspecialchars($data->dni);
    $inmueble = htmlspecialchars($data->inmueble);

    $jsondata["data"] = array();
	$stmt = $pdo->prepare("INSERT INTO reservas VALUES(NULL,'$dni',$inmueble, CURDATE())");
	$stmt->execute();
	$jsondata["data"] = $stmt->fetchall();
} catch (PDOException $e) {
	$jsondata["mensaje"] = $e;
}


echo json_encode($jsondata);
$pdo = null;

exit();