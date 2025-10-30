CREATE DATABASE IF NOT EXISTS cadastro_produtos;

USE cadastro_produtos;

CREATE TABLE IF NOT EXISTS `produtos` (
  `id_prod` int PRIMARY KEY AUTO_INCREMENT,
  `preco` decimal(10,2) NOT NULL,
  `nomeprod` varchar(255) NOT NULL unique,
  `categorias` varchar(100) NOT NULL
);