create database BookRoute;

use database BookRoute;

create table
  personas (
    id int auto_increment not null,
    ci int (8) not null,
    pri_nom varchar(30) not null,
    seg_nom varchar(30),
    pri_ape varchar(40) not null,
    seg_ape varchar(40),
    is_active boolean default true,
    created_at timestamp not null DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp not null default CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at timestamp NULL,
    primary key (id)
  );

create table
  tel_personas (
    persona int (8),
    telefono varchar(9) not null,
    is_active boolean default true,
    created_at timestamp not null DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp not null default CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at timestamp NULL,
    primary key (persona, telefono),
    foreign key (persona) references personas (id)
  );

create table
  roles (
    id int auto_increment not null,
    nombre varchar(20) not null,
    primary key (id)
  );
create table
  usuarios (
    id int auto_increment not null,
    persona int,
    correo varchar(75) not null,
    password varchar(20) not null,
    rol int,
    is_active boolean default true,
    created_at timestamp not null DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp not null default CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at timestamp NULL,
    primary key (id),
    foreign key (persona) references personas (id),
    foreign key (rol) references roles (id)
  );

create table
  choferes (
    id int auto_increment not null,
    persona int,
    vencimiento_libreta date not null,
    categoria_libreta varchar(3) not null,
    habilitado boolean default true,
    is_active boolean default true,
    created_at timestamp not null DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp not null default CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at timestamp NULL,
    primary key (id),
    foreign key (persona) references personas (id)
  );

create table
  vehiculos (
    id int auto_increment not null,
    matricula varchar(7) not null,
    tipo varchar(8) not null,
    asientosTotales int not null,
    is_active boolean default true,
    created_at timestamp not null DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp not null default CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at timestamp NULL,
    primary key (id)
  );
create table
  choferes_vehiculos (
    chofer int,
    vehiculo int,
    is_active boolean default true,
    created_at timestamp not null DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp not null default CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at timestamp NULL,
    primary key (chofer, vehiculo),
    foreign key (chofer) references choferes (id),
    foreign key (vehiculo) references vehiculos (id)
  );

create table
  rutas (
    id int auto_increment not null,
    origen varchar(100) not null,
    destino varchar(100) not null,
    distancia int (4) not null,
    is_active boolean default true,
    created_at timestamp not null DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp not null default CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at timestamp NULL,
    primary key (id)
  );

create table
  paradas_intermedias (
    ruta int,
    parada varchar(100) not null,
    is_active boolean default true,
    created_at timestamp not null DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp not null default CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at timestamp NULL,
    primary key (ruta, parada),
    foreign key (ruta) references rutas (id)
  );

create table
  viajes (
    id int auto_increment not null,
    chofer int (8),
    vehiculo varchar(7),
    ruta bigint not null,
    precio float not null,
    is_active boolean default true,
    created_at timestamp not null DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp not null default CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at timestamp NULL,
    primary key (id),
    foreign key (chofer) references choferes_vehiculos (chofer),
    foreign key (vehiculo) references choferes_vehiculos (vehiculo)
  );

create table
  reservas (
    id int auto_increment not null,
    usuario int,
    viaje int,
    fecha date not null,
    horario time not null,
    validacion boolean default false,
    is_active boolean default false,
    created_at timestamp not null DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp not null default CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at timestamp NULL,
    primary key (id),
    foreign key (usuario) references usuarios (id),
    foreign key (viaje) references viajes (id)
  );

insert into
  roles (nombre)
values
  ('admin'),
  ('usuario');
