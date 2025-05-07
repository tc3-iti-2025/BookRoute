<?php

require_once '../db/db.php';
class rutas
{
	public $id;
	public $origen;
	public $destino;
	public $distancia;

	public function __construct($id = null, $origen = null, $destino = null, $distancia = null)
	{
		$this->id = $id;
		$this->origen = $origen;
		$this->destino = $destino;
		$this->distancia = $distancia;
	}

	public function insertRuta($origen, $destino, $distancia)
	{
		global $db;
		$query = "INSERT INTO rutas (origen, destino, distancia) VALUES (?, ?, ?)";
		$stmt = $db->prepare($query);
		$stmt->bind_param("ssi", $origen, $destino, $distancia);
		if ($stmt->execute()) {
			return $db->insert_id;
		} else {
			return false;
		}
	}
	public function updateRuta($origen, $destino, $distancia, $id)
	{
		global $db;
		$query = "UPDATE rutas SET origen=?, destino=?, distancia=? WHERE id=?";
		$stmt = $db->prepare($query);
		$stmt->bind_param("ssii", $origen, $destino, $distancia, $id);
		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	public function deleteRuta($id)
	{
		global $db;
		$query = "UPDATE rutas SET is_active=false WHERE id=?";
		$stmt = $db->prepare($query);
		$stmt->bind_param("i", $id);
		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	public function getRutas($id = null)
	{
		global $db;
		if ($id) {
			$query = "SELECT * FROM rutas WHERE id=? AND is_active=true";
			$stmt = $db->prepare($query);
			$stmt->bind_param("i", $id);
		} else {
			$query = "SELECT * FROM rutas WHERE is_active=true";
			$stmt = $db->prepare($query);
		}
		if ($stmt->execute()) {
			return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
		} else {
			return false;
		}
	}
}
