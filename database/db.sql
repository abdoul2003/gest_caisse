-- use mysql;

-- drop database gest_caisse;

-- create database gest_caisse;

-- use gest_caisse;

-- create table users(
--     id int primary key not null auto_increment,
--     username varchar(255) not null,
--     mdp varchar(255) not null,
--     role varchar(100) not null
-- );

-- create table besoins(
--     id int primary key not null auto_increment,
--     designation varchar(255) not null,
--     qte int not null,
--     prixU int not null,
--     montant int not null,
--     payement int not null default 0,
--     status varchar(255) not null default 'en attente',
--     date date not null
-- );

create table entrees(
    id int primary key not null auto_increment,
    source varchar(255) not null,
    beneficiaire varchar(255) not null,
    motif varchar(255) not null,
    date date not null,
    mt_d int not null,
    description varchar(255) not null,
    mt_a int not null,
    remarque varchar(255) null,
    type_paye varchar(255) not null
);

-- create table depenses(
--     id int primary key not null auto_increment,
--     date date not null,
--     beneficiaire varchar(255) not null,
--     motif varchar(255) not null,
--     mt int not null
-- );

