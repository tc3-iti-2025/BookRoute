<?php

require_once '../db/db.php';
class vehiculos
{
	public $id;
	public $matricula;
	public $tipo;
	public $asientosTotales;

	public function __construct($id = null, $matricula = null, $tipo = null, $asientosTotales = null)
	{
		$this->id = $id;
		$this->matricula = $matricula;
		$this->tipo = $tipo;
		$this->asientosTotales = $asientosTotales;
	}

	public function insertVehiculo($matricula, $tipo, $asientosTotales)
	{
		global $db;
		$query = "INSERT INTO vehiculos (matricula, tipo, asientosTotales) VALUES (?, ?, ?)";
		$stmt = $db->prepare($query);
		$stmt->bind_param("ssi", $matricula, $tipo, $asientosTotales);
		if ($stmt->execute()) {
			return $db->insert_id;
		} else {
			return false;
		}
	}
	public function updateVehiculo($matricula, $tipo, $asientosTotales)
	{
		global $db;
		$query = "UPDATE vehiculos SET tipo=?, asientosTotales=? WHERE matricula=?";
		$stmt = $db->prepare($query);
		$stmt->bind_param("sis", $tipo, $asientosTotales, $matricula);
		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	public function deleteVehiculo($id)
	{
		global $db;
		$query = "UPDATE vehiculos SET is_active=false WHERE id=?";
		$stmt = $db->prepare($query);
		$stmt->bind_param("i", $id);
		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	public function getVehiculos($id = null)
	{
		global $db;
		if ($id) {
			$query = "SELECT * FROM vehiculos WHERE id=? AND is_active=true";
			$stmt = $db->prepare($query);
			$stmt->bind_param("i", $id);
		} else {
			$query = "SELECT * FROM vehiculos WHERE is_active=true";
			$stmt = $db->prepare($query);
		}
		if ($stmt->execute()) {
			return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
		} else {
			return false;
		}
	}
	public function validateVehiculo($matricula, $tipo, $asientosTotales)
	{
		global $db;
		$query = "SELECT * FROM vehiculos WHERE matricula=? AND tipo=? AND asientosTotales=? AND is_active=true";
		$stmt = $db->prepare($query);
		$stmt->bind_param("ssi", $matricula, $tipo, $asientosTotales);
		if ($stmt->execute()) {
			return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
		} else {
			return false;
		}
	}
}
