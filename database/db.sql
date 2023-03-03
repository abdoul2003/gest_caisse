use mysql;

create database gest_caisse;

use gest_caisse;

create table users(
    id int(11) primary key not null auto_increment,
    nom varchar(100) not null,
    prenom varchar(100) not null,
    role varchar(200) not null,
    email varchar(255) not null,
    mdp varchar(255) not null
);


