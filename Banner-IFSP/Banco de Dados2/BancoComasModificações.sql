-- Criação do banco de dados geral
CREATE DATABASE geral;

-- Selecionar o banco de dados geral
USE geral;

-- Criação da tabela funcao
CREATE TABLE funcao (
    idFunc INT AUTO_INCREMENT PRIMARY KEY,
    nomeFunc VARCHAR(255) NOT NULL,
    perm_Adm_FB BOOLEAN NOT NULL,
    perm_Adm_An BOOLEAN NOT NULL,
    perm_Adm_Ar BOOLEAN NOT NULL,
    perm_Adm_Geral BOOLEAN NOT NULL,
    perm_User BOOLEAN NOT NULL
);

-- Inserção das funções
INSERT INTO funcao (nomeFunc, perm_Adm_FB, perm_Adm_An, perm_Adm_Ar, perm_Adm_Geral, perm_User)
VALUES 
('Adm FeedBack', TRUE, FALSE, FALSE, FALSE, FALSE),
('Adm Anuncio', FALSE, TRUE, FALSE, FALSE, FALSE),
('Adm Armario', FALSE, FALSE, TRUE, FALSE, FALSE),
('Adm Geral', TRUE, TRUE, TRUE, TRUE, TRUE),
('user', FALSE, FALSE, FALSE, FALSE, FALSE);

-- Criação da tabela usuario
CREATE TABLE usuario (
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    idFunc INT NOT NULL,
    CPF CHAR(11) NOT NULL,
    nome VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    prontuario VARCHAR(255) NOT NULL,
    dataInscricao VARCHAR(255) NOT NULL,
    FOREIGN KEY (idFunc) REFERENCES funcao(idFunc)
);

-- Inserção de um usuário administrador
INSERT INTO usuario (idFunc, CPF, nome, email, senha, prontuario, dataInscricao)
VALUES (1, '12345678901', 'Admin User', 'admin@example.com', 'senhaSegura123', '1234567', NOW());

-- Criação da tabela Form
CREATE TABLE Form (
    IdForm INT AUTO_INCREMENT PRIMARY KEY,
    Titulo VARCHAR(255) NOT NULL,
    Descricao VARCHAR(255) NOT NULL,
    DtInicio DATE NOT NULL,
    DtFinal DATE NOT NULL,
    HrIni TIME NOT NULL,
    HrFinal TIME NOT NULL,
    Tipo VARCHAR(255) NOT NULL,
    pubAlv VARCHAR(255) NOT NULL
);

-- Criação da tabela UserForm
CREATE TABLE UserForm (
    IdUserForm INT AUTO_INCREMENT PRIMARY KEY,
    Titulo VARCHAR(255) NOT NULL,
    Descricao VARCHAR(255) NOT NULL,
    DtInicio DATE NOT NULL,
    DtFinal DATE NOT NULL,
    HrIni TIME NOT NULL,
    HrFinal TIME NOT NULL,
    Tipo VARCHAR(255) NOT NULL,
    pubAlv VARCHAR(255) NOT NULL,
    NomeUsuario VARCHAR(255),
    EmailUsuario VARCHAR(255),
    idUsuario INT,
    FOREIGN KEY (idUsuario) REFERENCES usuario(idUsuario)
);

-- Criação da tabela Artes
CREATE TABLE Artes (
    IdArtes INT AUTO_INCREMENT PRIMARY KEY,
    IdForm INT,
    Titulo VARCHAR(255),
    caminhoImg VARCHAR(255),
    FOREIGN KEY (IdForm) REFERENCES Form(IdForm)
);

-- Criação da tabela Armario
CREATE TABLE Armario (
    idArmario INT AUTO_INCREMENT PRIMARY KEY,
    Estado BOOLEAN NOT NULL,
    Id_usuario INT,
    Nome VARCHAR(255) NOT NULL,
    Dt_Emprestimo DATETIME NOT NULL,
    FOREIGN KEY (Id_usuario) REFERENCES usuario(idUsuario)
);

-- Criação da tabela feedback
CREATE TABLE feedback (
    idFeed INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(65) NOT NULL,
    feedback VARCHAR(10) NOT NULL,
    conteudo TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    visible BOOLEAN DEFAULT TRUE,
    modificado_por VARCHAR(65), 
    ultima_modificacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Criação da tabela sugestoes
CREATE TABLE sugestoes (
    idSugestion INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(65) NOT NULL,
    email VARCHAR(125) NOT NULL,
    conteudo TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    visible BOOLEAN DEFAULT TRUE,
    modificado_por VARCHAR(65), 
    ultima_modificacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Criação da tabela criticas
CREATE TABLE criticas (
    idCrit INT AUTO_INCREMENT PRIMARY KEY,
    conteudo TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    visible BOOLEAN DEFAULT TRUE,
    modificado_por VARCHAR(65), 
    ultima_modificacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Criação da tabela denuncia
CREATE TABLE denuncia (
    idDenuncia INT AUTO_INCREMENT PRIMARY KEY,
    usado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
