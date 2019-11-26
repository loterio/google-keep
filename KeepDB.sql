CREATE DATABASE keep;

USE keep;

CREATE TABLE notes (
	codigo INT AUTO_INCREMENT,
    titulo VARCHAR(60),
     texto VARCHAR(200),
  corFundo VARCHAR(20),
      tags VARCHAR(80),
	 ativa BINARY,
   estrela BINARY,	
PRIMARY KEY(codigo) 
);

DROP TABLE notes;
SELECT * FROM notes;

INSERT INTO notes(titulo, texto, corFundo, tags, ativa, estrela) VALUES 
('Lista Natal','Lembrar de comprar todos os presentes para o natal','#ff0000','#Xmas#Gifts',1,1),
('Tarefas da Semana','1. Limpar a casa; 2. Fazer tarefas; 3. Ir ao mercado','#2E64FE','#WorkHard#Unstopable',1,0),
('Recuperações','Quimica, Historia, Física e Português.','#FF00BF','#fear#OMG#help',0,0);