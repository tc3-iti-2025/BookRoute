<?php

/*
create table reservas(
  id int auto_increment not null,
	usuario int,
	viaje int,
	fecha date not null,
	horario time not null,
	validacion boolean default false,
	cancelada boolean default false,
  primary key (id),
  foreign key (usuario) references usuarios(id),
  foreign key (viaje) references viajes(id)
);*/

class reservas
{
	private $id;
	private $usuario;
	private $viaje;
	private $fecha;
	private $horario;
	private $validacion;
	private $cancelada;

	public function __construct($id, $usuario, $viaje, $fecha, $horario, $validacion, $cancelada)
	{
		$this->id = $id;
		$this->usuario = $usuario;
		$this->viaje = $viaje;
		$this->fecha = $fecha;
		$this->horario = $horario;
		$this->validacion = $validacion;
		$this->cancelada = $cancelada;
	}

	// public function insertReserva($usuario, $viaje, $fecha, $horario, $validacion, $cancelada)
	// public function updateReserva($usuario, $viaje, $fecha, $horario, $validacion, $cancelada)
	// public function deleteReserva($id)
	// public function getReservas($id=null)
	// public function validateReserva($usuario, $viaje, $fecha, $horario, $validacion, $cancelada)
}
