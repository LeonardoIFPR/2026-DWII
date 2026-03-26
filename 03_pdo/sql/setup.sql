/*
  Disciplina : Desenvolvimento Web II (DWII)
  Aula       : 05 — PHP + MariaDB: persistencia de dados via PDO
  Autor      : Leonardo Garbuio
  Data       : 21/03/2026
  Caminho    : /workspaces/2026-DWII/03_pdo/sql/setup.sql
*/

CREATE TABLE IF NOT EXISTS tecnologias (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    descricao TEXT,
    ano_criacao INT,
    criado_em TIMESTAMP DEFAULT current_timestamp(),
);

INSERT INTO tecnologias (nome, categoria, descricao, ano_criacao) VALUES
('HTML', 'Frontend', 'Linguagem de marcação para estrutura de páginas web.', 1993),
('CSS', 'Frontend', 'Linguagem de estilos para apresentação visual de páginas.', 1996),
('PHP', 'Backend', 'Linguagem server-side amplamente usada para web dinâmica.', 1994),
('MariaDB', 'Banco de Dados', 'Sistema de gerenciamento de banco de dados relacional open-source.', 2009),
('JavaScript', 'Frontend', 'Linguagem de programação para interatividade no navegador.', 1995),
('Git', 'DevOps', 'Sistema de controle de versão distribuído.', 2005);