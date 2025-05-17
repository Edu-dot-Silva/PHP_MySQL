create database contato;

use contato;

create table Pessoa(
    Id_pessoa int auto_increment primary key,
    Nome_pessoa varchar(100),
    Email_pessoa varchar(100),
    Telefone_pessoa varchar(20),
    Descricao_pessoa text,
);

insert into Pessoa (Nome_pessoa, Email_pessoa, Telefone_pessoa, Descricao_pessoa) 
values (
    "Carlos Almeida", 
    "carlos.almeida@gmail.com", 
    "11987654321", 
    "Amante de tecnologia e música, sempre em busca de novos desafios."
);

insert into Pessoa (Nome_pessoa, Email_pessoa, Telefone_pessoa, Descricao_pessoa) 
values (
    "Mariana Costa", 
    "mariana.costa@example.com", 
    "21998765432", 
    "Apaixonada por literatura e viagens, sempre explorando novos horizontes."
);