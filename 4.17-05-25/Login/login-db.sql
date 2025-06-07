create database login;
use login;
create table usuario(
    Id_Usuario int auto_increment primary key,
    Email_Usuario varchar(100) not null unique,
    Senha_Usuario varchar(255) not null
);


insert into usuario(Email_Usuario,Senha_Usuario)values("admin","1234");