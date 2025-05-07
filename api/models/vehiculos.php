<?php

/*
create table vehiculos(
	id int auto_increment not null,
	matricula varchar(7) not null,
	tipo varchar(8) not null,
	asientosTotales int not null,
  primary key(id)  
);
*/

class vehiculos
{
	private $id;
	private $matricula;
	private $tipo;
	private $asientosTotales;

	public function __construct($id, $matricula, $tipo, $asientosTotales)
	{
		$this->id = $id;
		$this->matricula = $matricula;
		$this->tipo = $tipo;
		$this->asientosTotales = $asientosTotales;
	}

	// public function insertVehiculo($matricula, $tipo, $asientosTotales)
	// public function updateVehiculo($matricula, $tipo, $asientosTotales)
	// public function deleteVehiculo($id)
	// public function getVehiculos($id=null)
	// public function validateVehiculo($matricula, $tipo, $asientosTotales)
}
