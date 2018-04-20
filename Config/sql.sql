create database CRUD;
use CRUD;

create table Usuario
(
	id 		int			 not null primary key auto_increment,
	nome 	varchar(50) not null,
	email 	varchar(50) not null unique,
	senha 	varchar(10) not null
);

create table Produtos
(
	id int not null primary key auto_increment,
	descricao varchar(100) not null
);