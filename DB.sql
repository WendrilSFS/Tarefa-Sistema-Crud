create database sistema;

use sistema;

create table cliente(
id int not null auto_increment,
nome varchar(100) not null,
cpf char(11) not null,
email varchar(100),
primary key (id)
);

create table produto(
id int not null auto_increment,
nome varchar(50) not null,
valor decimal(10,2) not null,
quantidade int not null,
primary key (id)
);

CREATE TABLE nota (
    id INT NOT NULL AUTO_INCREMENT,
    numero INT NOT NULL,
    data DATE,
    cliente_id INT,
    produto_id INT,
    quantidade INT NOT NULL,
    valor_total DECIMAL(10, 2) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (cliente_id) REFERENCES cliente(id),
    FOREIGN KEY (produto_id) REFERENCES produto(id)
);

show tables;

select * from nota;



