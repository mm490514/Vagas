-- vagas.candidatos definition

CREATE DATABASE `vagas` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

CREATE TABLE `candidatos` (
  `nome` varchar(255) DEFAULT NULL,
  `cpf` varchar(255) DEFAULT NULL,
  `data_nasc` date DEFAULT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  `id_grau_escolaridade` int DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `area_interesse` varchar(255) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `id_usuario` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- vagas.candidaturas definition

CREATE TABLE `candidaturas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_candidato` int DEFAULT NULL,
  `id_vaga` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- vagas.config definition

CREATE TABLE `config` (
  `nome_sistema` varchar(255) DEFAULT NULL,
  `email_adm` varchar(255) DEFAULT NULL,
  `endereco_site` varchar(255) DEFAULT NULL,
  `telefone_fixo` varchar(255) DEFAULT NULL,
  `telefone_whatsapp` varchar(255) DEFAULT NULL,
  `cnpj_site` varchar(255) DEFAULT NULL,
  `rodape_relatorios` varchar(255) DEFAULT NULL,
  `valor_multa` double DEFAULT NULL,
  `valor_juros_dia` double DEFAULT NULL,
  `frequencia_automatica` varchar(255) DEFAULT NULL,
  `relatorio_pdf` varchar(255) DEFAULT NULL,
  `fonte_comprovante` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `icone` varchar(255) DEFAULT NULL,
  `dias_carencia` int DEFAULT NULL,
  `alerta` date DEFAULT NULL,
  `impressao_automatica` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- vagas.grau_escolaridade definition

CREATE TABLE `grau_escolaridade` (
  `id` int DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- vagas.niveis definition

CREATE TABLE `niveis` (
  `nivel` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- vagas.nivel_cargo definition

CREATE TABLE `nivel_cargo` (
  `id` int DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- vagas.tipo_contrato definition

CREATE TABLE `tipo_contrato` (
  `id` int DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- vagas.usuarios definition

CREATE TABLE `usuarios` (
  `nome` varchar(255) DEFAULT NULL,
  `login` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `nivel` varchar(255) DEFAULT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- vagas.vagas definition

CREATE TABLE `vagas` (
  `cargo` varchar(255) DEFAULT NULL,
  `situacao` int DEFAULT NULL,
  `nome_empresa` varchar(255) DEFAULT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `id_nivel_cargo` int DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `localidade` varchar(255) DEFAULT NULL,
  `id_tipo_contrato` int DEFAULT NULL,
  `salario` float DEFAULT NULL,
  `id_user_empresa` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;