create database api

use api

create table if not exists usuarios(
    ID_USUARIO int auto_increment primary key,
    nombre varchar(20) not null,
    dni varchar(50) not null unique,
    correo varchar(50) not null unique,
    rol int not null,
    password varchar(50) not null,
    IDToken varchar(50) not null,
    fecha varchar(17) not null
)