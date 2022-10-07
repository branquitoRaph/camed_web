/* camed_logico: */

CREATE TABLE MEDICAMENTO (
    idMedicamento integer PRIMARY KEY,
    nomeMedicamento varchar(150),
    PMVC decimal(10,2),
    necessarioReceita BIT,
    imagem text
);

CREATE TABLE SINTOMA (
    idSintoma integer PRIMARY KEY,
    nomeSintoma varchar(150)
);

CREATE TABLE TIPO_CONTATO (
    idTipo integer PRIMARY KEY,
    descriTipoContato varchar(150)
);

CREATE TABLE USUARIO (
    idUsuario integer PRIMARY KEY,
    nomeUsuario varchar(150),
    senha varchar(150),
    dataNascimento date,
    sobrenomeUsuario varchar(150)
);

CREATE TABLE ENDERECO (
    idEndereco integer PRIMARY KEY,
    numero integer,
    CEP varchar(150),
    descricao varchar(150),
    FK_TIPO_LOGRADOURO_idTipo_Logradouro integer,
    FK_USUARIO_idUsuario integer,
    FK_BAIRRO_idBairro integer
);

CREATE TABLE TIPO_LOGRADOURO (
    idTipo_Logradouro integer PRIMARY KEY,
    descriLogradouro varchar(150)
);

CREATE TABLE BAIRRO (
    idBairro integer PRIMARY KEY,
    descriBairro varchar(150),
    FK_MUNICIPIO_idMunicipio integer
);

CREATE TABLE MUNICIPIO (
    idMunicipio integer PRIMARY KEY,
    descriMunicipio varchar(150),
    FK_ESTADO_idEstado integer
);

CREATE TABLE ESTADO (
    idEstado integer PRIMARY KEY,
    descriEstado varchar(150)
);

CREATE TABLE COMPLEMENTO (
    idComplemento integer PRIMARY KEY,
    descriComplemento varchar(150),
    FK_ENDERECO_idEndereco integer
);

CREATE TABLE MENSAGEM (
    idMensagem integer PRIMARY KEY,
    descriMensagem varchar(500),
    FK_USUARIO_idUsuario integer,
    FK_CATEGORIA_MENSAGEM_idCategoriaMensagem integer
);

CREATE TABLE CATEGORIA_MENSAGEM (
    idCategoriaMensagem integer PRIMARY KEY,
    descriCategoriaMensagem varchar(150)
);

CREATE TABLE FARMACIA (
    idFarmacia integer,
    nomeFarmacia varchar(150)
);

CREATE TABLE SINTOMA_MEDICAMENTO (
    FK_SINTOMA_idSintoma integer,
    FK_MEDICAMENTO_idMedicamento integer
);

CREATE TABLE USUARIO_TIPO_CONTATO (
    FK_USUARIO_idUsuario integer,
    FK_TIPO_CONTATO_idTipo integer,
    descricao varchar(150)
);

CREATE TABLE SINTOMA_USUARIO (
    FK_SINTOMA_idSintoma integer,
    FK_USUARIO_idUsuario integer,
    dataSintoma date
);

CREATE TABLE MEDICAMENTO_FARMACIA (
    FK_MEDICAMENTO_idMedicamento integer,
    preco decimal(10.2)
);
 
ALTER TABLE ENDERECO ADD CONSTRAINT FK_ENDERECO_2
    FOREIGN KEY (FK_TIPO_LOGRADOURO_idTipo_Logradouro)
    REFERENCES TIPO_LOGRADOURO (idTipo_Logradouro)
    ON DELETE RESTRICT;
 
ALTER TABLE ENDERECO ADD CONSTRAINT FK_ENDERECO_3
    FOREIGN KEY (FK_USUARIO_idUsuario)
    REFERENCES USUARIO (idUsuario)
    ON DELETE RESTRICT;
 
ALTER TABLE ENDERECO ADD CONSTRAINT FK_ENDERECO_4
    FOREIGN KEY (FK_BAIRRO_idBairro)
    REFERENCES BAIRRO (idBairro)
    ON DELETE RESTRICT;
 
ALTER TABLE BAIRRO ADD CONSTRAINT FK_BAIRRO_2
    FOREIGN KEY (FK_MUNICIPIO_idMunicipio)
    REFERENCES MUNICIPIO (idMunicipio)
    ON DELETE RESTRICT;
 
ALTER TABLE MUNICIPIO ADD CONSTRAINT FK_MUNICIPIO_2
    FOREIGN KEY (FK_ESTADO_idEstado)
    REFERENCES ESTADO (idEstado)
    ON DELETE RESTRICT;
 
ALTER TABLE COMPLEMENTO ADD CONSTRAINT FK_COMPLEMENTO_2
    FOREIGN KEY (FK_ENDERECO_idEndereco)
    REFERENCES ENDERECO (idEndereco)
    ON DELETE CASCADE;
 
ALTER TABLE MENSAGEM ADD CONSTRAINT FK_MENSAGEM_2
    FOREIGN KEY (FK_USUARIO_idUsuario)
    REFERENCES USUARIO (idUsuario)
    ON DELETE CASCADE;
 
ALTER TABLE MENSAGEM ADD CONSTRAINT FK_MENSAGEM_3
    FOREIGN KEY (FK_CATEGORIA_MENSAGEM_idCategoriaMensagem)
    REFERENCES CATEGORIA_MENSAGEM (idCategoriaMensagem)
    ON DELETE RESTRICT;
 
ALTER TABLE SINTOMA_MEDICAMENTO ADD CONSTRAINT FK_SINTOMA_MEDICAMENTO_1
    FOREIGN KEY (FK_SINTOMA_idSintoma)
    REFERENCES SINTOMA (idSintoma)
    ON DELETE RESTRICT;
 
ALTER TABLE SINTOMA_MEDICAMENTO ADD CONSTRAINT FK_SINTOMA_MEDICAMENTO_2
    FOREIGN KEY (FK_MEDICAMENTO_idMedicamento)
    REFERENCES MEDICAMENTO (idMedicamento)
    ON DELETE RESTRICT;
 
ALTER TABLE USUARIO_TIPO_CONTATO ADD CONSTRAINT FK_USUARIO_TIPO_CONTATO_1
    FOREIGN KEY (FK_USUARIO_idUsuario)
    REFERENCES USUARIO (idUsuario)
    ON DELETE RESTRICT;
 
ALTER TABLE USUARIO_TIPO_CONTATO ADD CONSTRAINT FK_USUARIO_TIPO_CONTATO_2
    FOREIGN KEY (FK_TIPO_CONTATO_idTipo)
    REFERENCES TIPO_CONTATO (idTipo)
    ON DELETE SET NULL;
 
ALTER TABLE SINTOMA_USUARIO ADD CONSTRAINT FK_SINTOMA_USUARIO_1
    FOREIGN KEY (FK_SINTOMA_idSintoma)
    REFERENCES SINTOMA (idSintoma)
    ON DELETE SET NULL;
 
ALTER TABLE SINTOMA_USUARIO ADD CONSTRAINT FK_SINTOMA_USUARIO_2
    FOREIGN KEY (FK_USUARIO_idUsuario)
    REFERENCES USUARIO (idUsuario)
    ON DELETE SET NULL;
 
ALTER TABLE MEDICAMENTO_FARMACIA ADD CONSTRAINT FK_MEDICAMENTO_FARMACIA_1
    FOREIGN KEY (FK_MEDICAMENTO_idMedicamento)
    REFERENCES MEDICAMENTO (idMedicamento)
    ON DELETE RESTRICT;
