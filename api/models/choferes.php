<?php

/*
create table choferes(
  id int auto_increment not null,
  persona int,
  vencimiento_libreta date not null,
  categoria_libreta varchar(3) not null,
  habilitado boolean default true,
  primary key(id),
  foreign key (persona) references personas(id)
);
*/

require_once '../db/db.php';
class choferes
{
  private $id;
  private $persona;
  private $vencimiento_libreta;
  private $categoria_libreta;
  private $habilitado;

  public function __construct($id, $persona, $vencimiento_libreta, $categoria_libreta, $habilitado)
  {
    $this->id = $id;
    $this->persona = $persona;
    $this->vencimiento_libreta = $vencimiento_libreta;
    $this->categoria_libreta = $categoria_libreta;
    $this->habilitado = $habilitado;
  }

  // public function insertChofer($persona, $vencimiento_libreta, $categoria_libreta, $habilitado)
  // public function updateChofer($persona, $vencimiento_libreta, $categoria_libreta, $habilitado)
  // public function deleteChofer($id)
  // public function getChoferes($id=null)
  // public function validateChofer($persona, $vencimiento_libreta, $categoria_libreta, $habilitado)
}
