    -- Exclusão do banco de dados glg
    DROP DATABASE geral;

    -- Criação do banco de dados glg
    CREATE DATABASE geral;

    -- Selecionar o banco de dados glg
    USE geral;

    -- Criação da tabela funcao
    CREATE TABLE funcao (
        Id INT AUTO_INCREMENT PRIMARY KEY,
        nomeFunc VARCHAR(255) NOT NULL,
        perm_Adm_FB BOOLEAN NOT NULL,
        perm_Adm_An BOOLEAN NOT NULL,
        perm_Adm_Ar BOOLEAN NOT NULL,
        perm_Adm_Geral BOOLEAN NOT NULL,
        perm_User BOOLEAN NOT NULL
    );
    ------------------------------ Inputs das Funções ------------------------------

    INSERT INTO funcao (nomeFunc, perm_Adm_FB, perm_Adm_An, perm_Adm_Ar, perm_Adm_Geral, perm_User)
    VALUES ('Adm FeedBack', TRUE, FALSE, FALSE, FALSE, FALSE);

    INSERT INTO funcao (nomeFunc, perm_Adm_FB, perm_Adm_An, perm_Adm_Ar, perm_Adm_Geral, perm_User)
    VALUES ('Adm Anuncio', FALSE, TRUE, FALSE, FALSE, FALSE);

    INSERT INTO funcao (nomeFunc, perm_Adm_FB, perm_Adm_An, perm_Adm_Ar, perm_Adm_Geral, perm_User)
    VALUES ('Adm Armario', FALSE, FALSE, TRUE, FALSE, FALSE);

    INSERT INTO funcao (nomeFunc, perm_Adm_FB, perm_Adm_An, perm_Adm_Ar, perm_Adm_Geral, perm_User)
    VALUES ('Adm Geral', TRUE, TRUE, TRUE, TRUE, TRUE);

    INSERT INTO funcao (nomeFunc, perm_Adm_FB, perm_Adm_An, perm_Adm_Ar, perm_Adm_Geral, perm_User)
    VALUES ('user', FALSE, FALSE, FALSE, FALSE, FALSE);

    --------------------------------------------------------------------------------


    -- Criação da tabela usuario
    CREATE TABLE usuario (
        Id INT AUTO_INCREMENT PRIMARY KEY,
        id_func INT NOT NULL,
        CPF CHAR(11) NOT NULL,
        nome VARCHAR(255) NOT NULL UNIQUE,
        email VARCHAR(255) NOT NULL,
        senha VARCHAR(255) NOT NULL,
        prontuario VARCHAR(255) NOT NULL,
        dataInscricao VARCHAR(255) NOT NULL,
        FOREIGN KEY (id_func) REFERENCES funcao(Id)
    );

    ------------------------------ Inputs do Adm Geral ------------------------------

    INSERT INTO usuario (id_func, CPF, nome, email, senha, prontuario, dataInscricao)
    VALUES (4, '00000000000', 'User 0', 'userEmail@gmail.com', '12345678', '0000000', now());


    ----------------------------------- Parte do Grupo dos Anuncios -----------------------------------

    -- Criação da tabela Form
    CREATE TABLE Form (
        Id INT AUTO_INCREMENT PRIMARY KEY,
        Titulo VARCHAR(255) NOT NULL,
        Descricao VARCHAR(255) NOT NULL,
        DtInicio date NOT NULL,
        DtFinal date NOT NULL,
        HrIni time NOT NULL,
        HrFinal time NOT NULL,
        Tipo VARCHAR(255) NOT NULL,
        pubAlv VARCHAR(255) NOT NULL
    );

    -- Criação da tabela Artes
    CREATE TABLE Artes (
        Id_artes INT,
        Titulo VARCHAR(255),
        caminhoImg VARCHAR(255),
        PRIMARY KEY (Id_artes),
        FOREIGN KEY (Id_artes) REFERENCES Form(Id)
    );


    ----------------------------------- Fim da parte do Grupo dos Anuncios -----------------------------------

    ----------------------------------- Parte do Grupo dos Armarios -----------------------------------

    -- Criação da tabela Form
    CREATE TABLE Armario (
        Id INT AUTO_INCREMENT PRIMARY KEY,
        Estado Boolean NOT NULL,
        Id_usuario INT,
        Nome VARCHAR (255) NOT NULL,
        Dt_Emprestimo DATETIME NOT NULL,
        FOREIGN KEY (Id_usuario) REFERENCES usuario(Id)
    );

    ----------------------------------- Fim da parte do Grupo dos Armarios -----------------------------------
    ----------------------------------- Parte do Grupo do Feedback -----------------------------------
    CREATE TABLE feedback (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(65) NOT NULL,
        feedback VARCHAR(10) NOT NULL,
        conteudo TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        visible BOOLEAN DEFAULT TRUE,
        modificado_por VARCHAR (65), 
        ultima_modificacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );

    CREATE TABLE sugestoes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(65) NOT NULL,
        email VARCHAR(125) NOT NULL,
        conteudo TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        visible BOOLEAN DEFAULT TRUE,
        modificado_por VARCHAR (65), 
        ultima_modificacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );

    CREATE TABLE criticas (
        id INT AUTO_INCREMENT PRIMARY KEY,
        conteudo TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        visible BOOLEAN DEFAULT TRUE,
        modificado_por VARCHAR (65), 
        ultima_modificacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );

    CREATE TABLE denuncia (
        id INT AUTO_INCREMENT PRIMARY KEY,
        usado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );
    ----------------------------------- Fim da parte do Grupo do Feedback -----------------------------------
