create database agenda_contato;

#Contato é uma entidade
create table CONTATO(
	Id_Contato int auto_increment primary key,
    Nome_Contato varchar(100),
    Email_Contato varchar(100)
);

create table TELEFONE(
	Id_Telefone int auto_increment primary key,
    Numero_Telefone varchar(20),
    Contato_Id int,
    foreign key (Contato_Id) references CONTATO(Id_Contato)
);

insert into CONTATO (Nome_Contato, Email_Contato)  values (
"Joao da Silva","joao.silva@gmail.com"
);

insert into CONTATO (Nome_Contato, Email_Contato)  values (
"Pedro da Silva","pedro.silva@gmail.com"
);

insert into TELEFONE (Numero_Telefone, Contato_Id)  values (
"(11)98636-4702", 1
);

insert into TELEFONE (Numero_Telefone, Contato_Id)  values (
"(11)93686-0247", 2
);

insert into TELEFONE (Numero_Telefone, Contato_Id)  values (
"(11)95462-8454", 1
);

select * from CONTATO;
select * from TELEFONE;

select * from CONTATO inner join TELEFONE on Id_Contato = Contato_Id;