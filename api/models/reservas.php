<?php

require_once '../db/db.php';
class reservas
{
	public $id;
	public $usuario;
	public $viaje;
	public $fecha;
	public $horario;
	public $validacion;
	public $cancelada;

	public function __construct($id = null, $usuario = null, $viaje = null, $fecha = null, $horario = null, $validacion = null, $cancelada = null)
	{
		$this->id = $id;
		$this->usuario = $usuario;
		$this->viaje = $viaje;
		$this->fecha = $fecha;
		$this->horario = $horario;
		$this->validacion = $validacion;
		$this->cancelada = $cancelada;
	}

	public function insertReserva($usuario, $viaje, $fecha, $horario, $validacion, $cancelada)
	{
		global $db;
		$query = "INSERT INTO reservas (usuario, viaje, fecha, horario, validacion, cancelada) VALUES (?, ?, ?, ?, ?, ?)";
		$stmt = $db->prepare($query);
		$stmt->bind_param("iissss", $usuario, $viaje, $fecha, $horario, $validacion, $cancelada);
		if ($stmt->execute()) {
			return $db->insert_id;
		} else {
			return false;
		}
	}
	public function updateReserva($usuario, $viaje, $fecha, $horario, $validacion, $cancelada, $id)
	{
		global $db;
		$query = "UPDATE reservas SET usuario=?, viaje=?, fecha=?, horario=?, validacion=?, cancelada=? WHERE id=?";
		$stmt = $db->prepare($query);
		$stmt->bind_param("iissssi", $usuario, $viaje, $fecha, $horario, $validacion, $cancelada, $id);
		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	public function deleteReserva($id)
	{
		global $db;
		$query = "UPDATE reservas SET cancelada=true WHERE id=?";
		$stmt = $db->prepare($query);
		$stmt->bind_param("i", $id);
		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	public function getReservas($id = null)
	{
		global $db;
		if ($id) {
			$query = "SELECT * FROM reservas WHERE id=? AND cancelada=false";
			$stmt = $db->prepare($query);
			$stmt->bind_param("i", $id);
		} else {
			$query = "SELECT * FROM reservas WHERE cancelada=false";
			$stmt = $db->prepare($query);
		}
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_all(MYSQLI_ASSOC);
	}

	public function getReservasByUsuario($usuarioId)
	{
		global $db;
		$query = "
		SELECT reservas.id, reservas.fecha, reservas.horario, rutas.origen, rutas.destino, rutas.distancia, vehiculos.matricula, vehiculos.tipo, vehiculos.asientos_totales
	from reservas
  left join viajes on reservas.viaje = viajes.id
  left join rutas on viajes.ruta = rutas.id
  left join vehiculos on viajes.vehiculo = vehiculos.id
	where reservas.usuario = ? and reservas.cancelada = false;
		";
		$stmt = $db->prepare($query);
		$stmt->bind_param("i", $usuarioId);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_all(MYSQLI_ASSOC);
	}
}
