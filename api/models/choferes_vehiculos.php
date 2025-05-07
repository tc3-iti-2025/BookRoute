<?php

/*
create table choferes_vehiculos(
  chofer int,
  vehiculo int,
  primary key (chofer, vehiculo),  
  foreign key (chofer) references choferes(id),
  foreign key (vehiculo) references vehiculos(id)
);
*/

class choferes_vehiculos
{
  private $chofer;
  private $vehiculo;

  public function __construct($chofer, $vehiculo)
  {
    $this->chofer = $chofer;
    $this->vehiculo = $vehiculo;
  }

  // public function insertChoferVehiculo($chofer, $vehiculo)
  // public function updateChoferVehiculo($chofer, $vehiculo)
  // public function deleteChoferVehiculo($chofer, $vehiculo)
  // public function getChoferesVehiculos($chofer=null, $vehiculo=null)
  // public function validateChoferVehiculo($chofer, $vehiculo)
}
