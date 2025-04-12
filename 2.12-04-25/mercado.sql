#banco mercado
#tabela produto
#id_produto,nome_produto,valor_produto,qtd_produto,data_entradamdata_saida

create database mercado;

use mercado;

create table produto (
	id_produto int auto_increment primary key,
	nome_produto varchar(100) not null,
	valor_produto decimal(10,2),
    #decimal recebe (casas, casas depois da ,)
	qtd_produto int,
	data_entrada datetime,
	data_saida datetime);
    #ideal colocar date default() now()
    

ALTER TABLE produto 
drop column data_entrada;

ALTER TABLE produto 
drop column data_saida ;
#dropando colunas

select * from produto;

ALTER TABLE produto
ADD data_entrada date not null;

ALTER TABLE produto
ADD data_saida date;
#adicionando colunas

insert into produto (nome_produto, valor_produto, qtd_produto, data_entrada) 
values (
"Arroz",32.50,50, now());

select * from produto;

insert into produto (nome_produto, valor_produto, qtd_produto, data_entrada) 
values 
("Tomate", 10.00, 50, now()),
("Feijão", 15.90, 30, now()),
("Macarrão", 8.75, 100, now()),
("Açúcar", 4.50, 200, now()),
("Óleo", 7.99, 80, now());

select * from produto where id_produto = 4;

select * from produto where valor_produto > 10;

select * from produto where valor_produto > 10 and valor_produto < 30;

update produto set valor_produto = 50.00 where id_produto = 6;

update produto set valor_produto = 8.30, qtd_produto = 20 where id_produto = 2;

select * from produto;

delete from produto where id_produto = 6;
#o ideal é nao usar delete mas mudar o status pra bloqueado/inativo

select * from produto order by valor_produto asc;

select * from produto order by valor_produto desc;

select * from produto order by nome_produto asc;

select * from produto order by nome_produto desc;

select count(*) from produto;

select count(*) as quantidade_produtos from produto;

select count(*) as quantidade_produtos from produto where valor_produto > 10.00;

select count(*) as estoque_alto from produto where qtd_produto > 30;

select nome_produto, valor_produto, (select count(*) from produto where valor_produto > 10) as maior_dez from produto where valor_produto > 10;

select * from produto limit 3;

select * from produto order by valor_produto desc limit 5;

select * from produto where valor_produto > 10.00 order by valor_produto desc limit 5;

select nome_produto, sum(valor_produto * qtd_produto) as valor_total_estoque from produto group by nome_produto;

select valor_produto, count(*) as quantidade_produtos from produto where valor_produto between 10.01 and 20.00 group by valor_produto;

select * from produto;

select * from produto where nome_produto like "F%";

select * from produto where nome_produto like "%e";

select * from produto where nome_produto like "%Arroz%";



