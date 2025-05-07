<?php

/*
create table rutas(
	id int auto_increment not null,
	origen varchar(100) not null,
	destino varchar(100) not null,
  distancia int(4) not null,
  primary key (id)
);*/

class rutas
{
	private $id;
	private $origen;
	private $destino;
	private $distancia;

	public function __construct($id, $origen, $destino, $distancia)
	{
		$this->id = $id;
		$this->origen = $origen;
		$this->destino = $destino;
		$this->distancia = $distancia;
	}

	// public function insertRuta($origen, $destino, $distancia)
	// public function updateRuta($origen, $destino, $distancia)
	// public function deleteRuta($id)
	// public function getRutas($id=null)
	// public function validateRuta($origen, $destino, $distancia)
}
