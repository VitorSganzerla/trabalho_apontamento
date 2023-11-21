CREATE TABLE Bobina (
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  metragem float NOT NULL,
  peso float NOT NULL,
  operador int(11) NOT NULL,
  item int(11) NOT NULL,
  cliente int(11),
  criado_em timestamp NOT NULL DEFAULT current_timestamp(),
  atualizado_em timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (id),
  FOREIGN KEY (operador) REFERENCES Operador (id),
  FOREIGN KEY (cliente) REFERENCES Cliente (id),
  FOREIGN KEY (item) REFERENCES Item(id)
)

CREATE TABLE Cliente (
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nome varchar(120) NOT NULL,
  cidade varchar(120) NOT NULL,
  criado_em timestamp NOT NULL DEFAULT current_timestamp(),
  atualizado_em timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) 

CREATE TABLE Item (
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  cliente int(11) NOT NULL,
  nome varchar(200) NOT NULL,
  criado_em timestamp NOT NULL DEFAULT current_timestamp(),
  atualizado_em timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  FOREIGN KEY (cliente) REFERENCES Cliente (id)
) 

CREATE TABLE Operador (
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nome varchar(90) NOT NULL,
  numero_matricula int(11) NOT NULL UNIQUE,
  criado_em timestamp NOT NULL DEFAULT current_timestamp(),
  atualizado_em timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) 