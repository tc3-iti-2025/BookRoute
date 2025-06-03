<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Allow: GET, POST, PUT, DELETE');
header('content-Type: application/json; charset=utf-8');

require_once '../models/rutas.php';
$rutas = new rutas();

switch ($_SERVER['REQUEST_METHOD']) {
	case 'GET':
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$result = $rutas->getRutas($id);
			if ($result) {
				echo json_encode($result);
			} else {
				http_response_code(404);
				echo json_encode(array("message" => "Ruta no encontrada."));
			}
		} else {
			$result = $rutas->getRutas();
			echo json_encode($result);
		}
		break;
	case 'POST':
		$data = json_decode(file_get_contents("php://input"));
		if (isset($data->origen) && isset($data->destino) && isset($data->distancia)) {
			$result = $rutas->insertRuta($data->origen, $data->destino, $data->distancia);
			if ($result) {
				http_response_code(201);
				echo json_encode(array("message" => "Ruta creada con éxito.", "id" => $result));
			} else {
				http_response_code(500);
				echo json_encode(array("message" => "Error al crear la ruta."));
			}
		} else {
			http_response_code(400);
			echo json_encode(array("message" => "Datos incompletos."));
		}
		break;
	case 'PUT':
		$data = json_decode(file_get_contents("php://input"));
		if (isset($data->id) && isset($data->origen) && isset($data->destino) && isset($data->distancia)) {
			$result = $rutas->updateRuta($data->origen, $data->destino, $data->distancia, $data->id);
			if ($result) {
				echo json_encode(array("message" => "Ruta actualizada con éxito."));
			} else {
				http_response_code(500);
				echo json_encode(array("message" => "Error al actualizar la ruta."));
			}
		} else {
			http_response_code(400);
			echo json_encode(array("message" => "Datos incompletos."));
		}
		break;
	case 'DELETE':
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$result = $rutas->deleteRuta($id);
			if ($result) {
				echo json_encode(array("message" => "Ruta eliminada con éxito."));
			} else {
				http_response_code(500);
				echo json_encode(array("message" => "Error al eliminar la ruta."));
			}
		} else {
			http_response_code(400);
			echo json_encode(array("message" => "ID de ruta no proporcionado."));
		}
		break;
	default:
		http_response_code(405);
		echo json_encode(array("message" => "Método no permitido."));
		break;
}
