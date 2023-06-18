CREATE DATABASE froggers;
USE froggers;

CREATE TABLE clientes(
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(45),
    email VARCHAR(40),
    senha VARCHAR(15),
    PRIMARY KEY (id)
);

CREATE TABLE pedidos(
    id INT NOT NULL AUTO_INCREMENT,
    total FLOAT,
    IDcliente INT,
    PRIMARY KEY(id),
    FOREIGN KEY(IDcliente) REFERENCES clientes(id)
);

CREATE TABLE categorias(
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(45),
    PRIMARY KEY(id)
);

CREATE TABLE produtos(
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(45),
    preco FLOAT,
    IDcategoria INT,
    PRIMARY KEY(id),
    FOREIGN KEY(IDcategoria) REFERENCES categorias(id)
);

CREATE TABLE itens_pedido(
    id INT NOT NULL AUTO_INCREMENT,
    quantidade INT,
    precoUn FLOAT,
    IDprodutos INT,
    IDpedidos INT,
    PRIMARY KEY(id),
    UNIQUE KEY item_pedido_unique (IDprodutos, IDpedidos),
    FOREIGN KEY(IDprodutos) REFERENCES produtos(id),
    FOREIGN KEY(IDpedidos) REFERENCES pedidos(id)
);

