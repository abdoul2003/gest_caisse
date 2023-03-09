use mysql;

drop database gest_caisse;

create database gest_caisse;

use gest_caisse;

create table users(
    id int primary key not null auto_increment,
    nom varchar(255) not null,
    prenom varchar(255) not null,
    role varchar(200) not null,
    telephone varchar(255) not null,
    email varchar(255) unique not null,
    status int not null default 0,
    active int not null default 0,
    mdp varchar(255) not null
);

create table entrees(
    id int primary key not null auto_increment,
    source varchar(255) not null,
    beneficiaire varchar(255) not null,
    motif varchar(255) not null,
    date date not null,
    mt_d int not null,
    description varchar(255) not null,
    mt_a int not null,
    remarque varchar(255) not null,
    type_paye varchar(255) not null,
    status varchar(255) not null default 'en attente' 
);

create table depenses(
    id int primary key not null auto_increment,
    date date not null,
    beneficiaire varchar(255) not null,
    motif varchar(255) not null,
    mt int not null,
    status varchar(255) not null default 'en attente'
);

create table societe(
    nom varchar(255) not null,
    motif varchar(255) not null
);

create table besoins(
    id int primary key not null auto_increment,
    designation varchar(255) not null,
    qte int not null,
    prix_unitaire_es int not null,
    mt_es int not null,
    status varchar(255) not null default 'en attente',
    date date not null
);

create table roles(
    id int primary key not null auto_increment,
    nom varchar(200) not null
);

insert into roles values(NULL,'caisse');
insert into roles values(NULL,'comptabilite');
insert into roles values(NULL,'rac');
insert into roles values(NULL,'directeur');
