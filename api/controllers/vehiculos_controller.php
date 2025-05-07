<?php

require_once '../models/vehiculos.php';
$vehiculos = new vehiculos();

switch ($_SERVER['REQUEST_METHOD']) {
	case 'GET':
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$result = $vehiculos->getVehiculos($id);
			if ($result) {
				echo json_encode($result);
			} else {
				echo json_encode(array("message" => "Vehiculo not found."));
			}
		} else {
			$result = $vehiculos->getVehiculos();
			echo json_encode($result);
		}
		break;
	case 'POST':
		if (isset($_POST['matricula']) && isset($_POST['tipo']) && isset($_POST['asientosTotales'])) {
			$matricula = $_POST['matricula'];
			$tipo = $_POST['tipo'];
			$asientosTotales = $_POST['asientosTotales'];
			$result = $vehiculos->insertVehiculo($matricula, $tipo, $asientosTotales);
			if ($result) {
				echo json_encode(array("message" => "Vehiculo created successfully.", "id" => $result));
			} else {
				echo json_encode(array("message" => "Failed to create vehiculo."));
			}
		} else {
			echo json_encode(array("message" => "Required fields not provided."));
		}
		break;
	case 'PUT':
		parse_str(file_get_contents("php://input"), $_PUT);
		if (isset($_PUT['id']) && isset($_PUT['matricula']) && isset($_PUT['tipo']) && isset($_PUT['asientosTotales'])) {
			$id = $_PUT['id'];
			$matricula = $_PUT['matricula'];
			$tipo = $_PUT['tipo'];
			$asientosTotales = $_PUT['asientosTotales'];
			$result = $vehiculos->updateVehiculo($id, $matricula, $tipo, $asientosTotales);
			if ($result) {
				echo json_encode(array("message" => "Vehiculo updated successfully."));
			} else {
				echo json_encode(array("message" => "Failed to update vehiculo."));
			}
		} else {
			echo json_encode(array("message" => "Required fields not provided."));
		}
		break;
	case 'DELETE':
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$result = $vehiculos->deleteVehiculo($id);
			if ($result) {
				echo json_encode(array("message" => "Vehiculo deleted successfully."));
			} else {
				echo json_encode(array("message" => "Failed to delete vehiculo."));
			}
		} else {
			echo json_encode(array("message" => "ID not provided."));
		}
		break;
	default:
		echo json_encode(array("message" => "Method not allowed."));
		break;
}
