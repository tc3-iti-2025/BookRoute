<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Allow: GET, POST, PUT, DELETE');
header('content-Type: application/json; charset=utf-8');

require_once '../models/reservas.php';
$reservas = new reservas();

switch ($_SERVER['REQUEST_METHOD']) {
	case 'GET':
		if (!isset($_GET['id']) && !isset($_GET['usuario'])) {
			$result = $reservas->getReservas();
			echo json_encode($result);
			break;
		}
		if (isset($_GET['usuario'])) {
			$usuario = $_GET['usuario'];
			$result = $reservas->getReservasByUsuario($usuario);
			echo json_encode($result);
			break;
		}
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$result = $reservas->getReservas($id);
			if ($result) {
				echo json_encode($result);
			} else {
				http_response_code(404);
				echo json_encode(array("message" => "Reserva no encontrada."));
			}
		}
		break;
	case 'POST':
		$data = json_decode(file_get_contents("php://input"));
		if (isset($data->usuario) && isset($data->viaje) && isset($data->fecha) && isset($data->horario) && isset($data->validacion) && isset($data->cancelada)) {
			$result = $reservas->insertReserva($data->usuario, $data->viaje, $data->fecha, $data->horario, $data->validacion, $data->cancelada);
			if ($result) {
				http_response_code(201);
				echo json_encode(array("message" => "Reserva creada con éxito.", "id" => $result));
			} else {
				http_response_code(500);
				echo json_encode(array("message" => "Error al crear la reserva."));
			}
		} else {
			http_response_code(400);
			echo json_encode(array("message" => "Datos incompletos."));
		}
		break;
	case 'PUT':
		$data = json_decode(file_get_contents("php://input"));
		if (isset($data->usuario) && isset($data->viaje) && isset($data->fecha) && isset($data->horario) && isset($data->validacion) && isset($data->cancelada) && isset($data->id)) {
			$result = $reservas->updateReserva($data->usuario, $data->viaje, $data->fecha, $data->horario, $data->validacion, $data->cancelada, $data->id);
			if ($result) {
				echo json_encode(array("message" => "Reserva actualizada con éxito."));
			} else {
				http_response_code(500);
				echo json_encode(array("message" => "Error al actualizar la reserva."));
			}
		} else {
			http_response_code(400);
			echo json_encode(array("message" => "Datos incompletos."));
		}
		break;
	case 'DELETE':
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$result = $reservas->deleteReserva($id);
			if ($result) {
				echo json_encode(array("message" => "Reserva eliminada con éxito."));
			} else {
				http_response_code(500);
				echo json_encode(array("message" => "Error al eliminar la reserva."));
			}
		} else {
			http_response_code(400);
			echo json_encode(array("message" => "ID de reserva no proporcionado."));
		}
		break;
	default:
		http_response_code(405);
		echo json_encode(array("message" => "Método no permitido."));
		break;
}
