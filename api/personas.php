<?php

require_once 'db/db.php';
/*
create table personas(
	id int auto_increment not null,
  ci int(8) not null,
  pri_nom varchar(30) not null,
  seg_nom varchar(30),
  pri_ape varchar(40) not null,
  seg_ape varchar(40),
  primary key (id)
);
*/


class personas
{
  private $ci;
  private $pri_nom;
  private $seg_nom;
  private $pri_ape;
  private $seg_ape;

  public function __construct($ci, $pri_nom, $seg_nom, $pri_ape, $seg_ape)
  {
    $this->ci = $ci;
    $this->pri_nom = $pri_nom;
    $this->seg_nom = $seg_nom;
    $this->pri_ape = $pri_ape;
    $this->seg_ape = $seg_ape;
  }


}
