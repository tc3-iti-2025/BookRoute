use BookRoute;

insert into personas(ci,pri_nom,seg_nom,pri_ape,seg_ape) 
  values 
    ("55813692","Ignacio","","Tejera",""),
    ("09182383","Pedro","","Picapiedra",""),
    ("09182384","Pablo","","Picapiedra",""),
    ("09182385","Juan","","Picapiedra",""),
    ("09182386","Maria","","Picapiedra",""),
    ("09182387","Jose","","Picapiedra",""),
    ("09182388","Ana","","Picapiedra",""),
    ("09182389","Luis","","Picapiedra",""),
    ("09182390","Laura","","Picapiedra",""),
    ("09182391","Javier","","Picapiedra","");


insert into tel_personas(persona,telefono)
  values 
    (1,"099123456"),
    (1,"098765432"),
    (2,"091234567"),
    (2,"091234568");

insert into usuarios(persona,correo,password,rol)
  values 
    (1,"itejera01@gmail.com","123456","1"),
    (2,"pepe@gmail,com","123456","2");

insert into choferes(persona,vencimiento_libreta,categoria_libreta)
  values 
    (5,"2026-12-31","F"),
    (6,"2027-12-31","F");

insert into vehiculos(matricula,tipo,asientosTotales)
  values 
    ("ABC1234","MICROBUS",10),
    ("DEF5678","OMNIBUS",20),
    ("GHI9012","MICROBUS",5),
    ("JKL3456","MINIBUS",10),
    ("MNO7890","OMNIBUS",20);

insert into choferes_vehiculos(chofer,vehiculo)
  values
    (1,1),
    (1,2),
    (2,3),
    (2,4);

insert into rutas(origen,destino,distancia)
  values 
    ("Ruta 1","Ruta de prueba 1",10),
    ("Ruta 2","Ruta de prueba 2",20),
    ("Ruta 3","Ruta de prueba 3",30),
    ("Ruta 4","Ruta de prueba 4",40),
    ("Ruta 5","Ruta de prueba 5",50);

insert into viajes(chofer,vehiculo, ruta, precio)
  values 
    (1,1,1,10000),
    (1,2,2,10500),
    (2,3,3,20000),
    (2,4,4,20500),
    (1,5,5,30000);

insert into reservas(usuario, viaje, fecha, horario)
  values 
    (2,3,"2025-10-03","12:00"),
    (2,4,"2025-10-04","13:00");



