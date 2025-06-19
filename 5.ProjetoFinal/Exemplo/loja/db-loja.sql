create DATABASE loja;
USE loja;

CREATE TABLE produtos (
  Id_Produto INT AUTO_INCREMENT PRIMARY KEY,
  Titulo_Produto VARCHAR(100),
  Descricao_Produto TEXT,
  Preco_Produto DECIMAL(10, 2),
  Imagem_Produto VARCHAR(255)
);

Create table usuarios (
  Id_Usuario INT AUTO_INCREMENT PRIMARY KEY,
  Nome_Usuario VARCHAR(100),
  Email_Usuario VARCHAR(100),
  Senha_Usuario VARCHAR(255),
  Telefone_Usuario VARCHAR(20),
  Endereco_Usuario TEXT
);

CREATE TABLE pedidos (
  Id_Pedido INT AUTO_INCREMENT PRIMARY KEY,
  Usuario_Id INT,
  Data_Pedido DATETIME,
  Status_Pedido VARCHAR(50),
  FOREIGN KEY (Usuario_Id) REFERENCES usuarios(Id_Usuario)
);

CREATE TABLE itens_pedido (
  Id_Item INT AUTO_INCREMENT PRIMARY KEY,
  Pedido_Id INT,
  Produto_Id INT,
  Quantidade INT,
  Preco_Unitario DECIMAL(10, 2),
  FOREIGN KEY (Pedido_Id) REFERENCES pedidos(Id_Pedido),
  FOREIGN KEY (Produto_Id) REFERENCES produtos(Id_Produto)
);