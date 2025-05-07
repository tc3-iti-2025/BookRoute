<?php

/*
create table viajes(
  id int auto_increment not null,
  chofer int, 
  vehiculo int,
  ruta bigint not null,
  precio float not null,
  primary key (id),
  foreign key (chofer, vehiculo) references choferes_vehiculos(chofer, vehiculo)
);
*/

class viajes
{
  private $id;
  private $chofer;
  private $vehiculo;
  private $ruta;
  private $precio;

  public function __construct($id, $chofer, $vehiculo, $ruta, $precio)
  {
    $this->id = $id;
    $this->chofer = $chofer;
    $this->vehiculo = $vehiculo;
    $this->ruta = $ruta;
    $this->precio = $precio;
  }

  // public function insertViaje($chofer, $vehiculo, $ruta, $precio)
  // public function updateViaje($id, $chofer, $vehiculo, $ruta, $precio)
  // public function deleteViaje($id)
  // public function getViaje($id=null)
  // public function validateViaje($chofer, $vehiculo, $ruta, $precio)
}
