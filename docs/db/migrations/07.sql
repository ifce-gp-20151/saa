---------------------------------------------
---- remover acentos
---------------------------------------------
CREATE OR REPLACE FUNCTION saa.sem_acentos (VARCHAR) RETURNS VARCHAR AS
$body$
SELECT TRANSLATE($1, 'áéíóúàèìòùãõâêîôôäëïöüçÁÉÍÓÚÀÈÌÒÙÃÕÂÊÎÔÛÄËÏÖÜÇ', 'aeiouaeiouaoaeiooaeioucAEIOUAEIOUAOAEIOOAEIOUC')
$body$
LANGUAGE 'sql' VOLATILE CALLED ON NULL INPUT SECURITY INVOKER;

---------------------------------------------
---- ALTERADA AS TABELAS
---- 1- ALUNO(ACRESCENTADO O CAMPO SEMESTRE),
---- 2- CURSO (ACRESCENTADO O CAMPO ID_TURNO, REMOVIDO O CAMPO PERIODO)
---- CRIADO TABELA TURNO
---------------------------------------------
alter table saa.aluno add semestre SMALLINT NULL;
alter table saa.curso drop column id_periodo;
create table saa.turno
(
	id SERIAL PRIMARY KEY,
	descricao VARCHAR(10) not null
);
create table saa.campus
(
	id SERIAL PRIMARY KEY,
	descricao VARCHAR(100) not null
);
alter table saa.curso add id_turno INT REFERENCES saa.turno(id);
alter table saa.curso add id_campus INT REFERENCES saa.campus(id);

---------------------------------------------
---- POPULANDO ESTADO CIVIL
---------------------------------------------
ALTER SEQUENCE saa.estado_civil_id_seq RESTART WITH 1;
delete from saa.estado_civil;
insert into saa.estado_civil(descricao) values ('Solteiro'),('Casado'),('Separado'),('Divorciado'),('Viúvo');

---------------------------------------------
---------------------------------------------
---- *** INICIO DA MIGRACAO DE PESSOAS DO ARQUIVO
---------------------------------------------
---------------------------------------------
---select * from saa.temp
DROP TABLE IF EXISTS saa.temp;
CREATE TABLE saa.temp(Matricula VARCHAR(250),Nome VARCHAR(250),Situacao_Matricula VARCHAR(250),Situacao_Periodo VARCHAR(250),Turma VARCHAR(250),Nascimento VARCHAR(250),Renov_Matricula VARCHAR(250),Sexo VARCHAR(250),Per_Letivo_Inicial VARCHAR(250),Curso VARCHAR(250),Periodo VARCHAR(250),Turno VARCHAR(250),Naturalidade VARCHAR(250),Telefones VARCHAR(250),E_mail VARCHAR(250),Tipo_Forma_Ingresso_no_Periodo VARCHAR(250),Renda_Familiar VARCHAR(250),Renda_Familiar_Per_Capita VARCHAR(250),Renda_Familiar_Per_Capita_SIG VARCHAR(250),Renda_Familiar_Per_Capita_INEP VARCHAR(250),Escola_de_Origem VARCHAR(250),Area_Procedência_Escola_Origem VARCHAR(250),Agrupamento VARCHAR(250),CPF VARCHAR(250),Num_de_Identidade VARCHAR(250),Instituicao VARCHAR(250),Matriz_Curricular VARCHAR(250),Nome_do_Pai VARCHAR(250),Nome_da_Mae VARCHAR(250),Endereco VARCHAR(250),Numero VARCHAR(250),Complemento VARCHAR(250),Bairro VARCHAR(250),CEP VARCHAR(250),Cidade VARCHAR(250),N_Pasta VARCHAR(250),Pólo_Municipal VARCHAR(250),Percentual_Frequencia VARCHAR(250),Regime_Internato VARCHAR(250));

COPY saa.temp(Matricula,Nome,Situacao_Matricula,Situacao_Periodo,Turma,Nascimento,Renov_Matricula,Sexo,Per_Letivo_Inicial,Curso,Periodo,Turno,Naturalidade,Telefones,E_mail,Tipo_Forma_Ingresso_no_Periodo,Renda_Familiar,Renda_Familiar_Per_Capita,Renda_Familiar_Per_Capita_SIG,Renda_Familiar_Per_Capita_INEP,Escola_de_Origem,Area_Procedência_Escola_Origem,Agrupamento,CPF,Num_de_Identidade,Instituicao,Matriz_Curricular,Nome_do_Pai,Nome_da_Mae,Endereco,Numero,Complemento,Bairro,CEP,Cidade,N_Pasta,Pólo_Municipal,Percentual_Frequencia,Regime_Internato)
--FROM '/home/aldisiogm/Downloads/script/scripts atualizados/alunos_csv5.csv' WITH (FORMAT CSV, DELIMITER ';', QUOTE '~', NULL '', ENCODING 'UTF-8');
FROM '/home/aldisiogm/Downloads/script/alunos_csv5.csv' WITH (FORMAT CSV, DELIMITER ';', QUOTE '~', NULL '', ENCODING 'UTF-8');

---------------------------------------------
---- POPULANDO PESSOA
---------------------------------------------
---select * from saa.pessoa
ALTER SEQUENCE saa.pessoa_id_seq RESTART WITH 1;
INSERT INTO saa.pessoa(nome, cpf, rg, sexo,dt_nascimento,id_estado_civil)
SELECT distinct t.nome, replace(replace(t.cpf,'.',''),'-',''), t.num_de_identidade,t.sexo,TO_DATE(t.nascimento, 'DD/MM/YYYY'), 1 FROM saa.temp t;


---------------------------------------------
---- POPULANDO endereco
---------------------------------------------
---select * from saa.endereco
--start transaction
--rollback
alter table saa.endereco add column migracao_pessoa bigint;

ALTER SEQUENCE saa.endereco_id_seq RESTART WITH 1;
delete from saa.endereco;
insert into saa.endereco(id_bairro,logradouro,numero,cep,complemento,migracao_pessoa)
select 
distinct
CASE WHEN b.id IS NULL THEN 5827 ELSE b.id END as id_bairro,
CASE WHEN upper(trim(t.endereco)) IS NULL THEN 'NÃO INFORMADO' ELSE upper(trim(t.endereco)) END,
CASE WHEN t.numero IS NULL or length(trim(t.numero)) > 10 THEN '0' ELSE trim(t.numero) END,
CASE WHEN upper(trim(replace(t.cep,'-',''))) IS NULL OR length(trim(replace(t.cep,'-',''))) > 10 THEN '0' ELSE upper(trim(replace(t.cep,'-',''))) END,
CASE WHEN upper(trim(t.complemento)) IS NULL THEN '' ELSE upper(trim(t.complemento)) END,
p.id
from saa.temp t 
inner join saa.pessoa p ON replace(replace(t.cpf,'.',''),'-','') = p.cpf
inner join saa.cidade c ON (c.descricao = trim(upper(saa.sem_acentos(replace(trim(t.cidade),'- CE','')))))
left join saa.bairro b ON (trim(replace(replace(trim(b.descricao),'CONJUNTO',''),'PREFEITO','')) like trim(upper(saa.sem_acentos(trim(replace(replace(t.bairro,'Conjunto',''),'Prefeito',''))))) and b.id_cidade = c.id and c.id_uf = 6);

---------------------------------------------
---- POPULANDO pessoa_endereco
---------------------------------------------
delete from saa.pessoa_endereco;
insert into saa.pessoa_endereco(id_pessoa, id_endereco)
select distinct migracao_pessoa,id from saa.endereco; 

---------------------------------------------
---- POPULANDO saa.turno
---------------------------------------------
--select * from saa.turno;
insert into saa.turno(descricao) values ('MANHÃ'),('TARDE'),('NOITE'),('INTEGRAL');

---------------------------------------------
---- POPULANDO 
--select * from saa.campus;
---------------------------------------------
INSERT INTO saa.campus(descricao)
VALUES
('MARACANAÚ'),
('ACARAÚ'),
('ARACATI'),
('BATURITÉ'),
('CAMOCIM'),
('JAGUARIBE'),
('TIANGUÁ'),
('CANINDÉ'),
('CAUCAIA'),
('CEDRO'),
('CRATEÚS'),
('FORTALEZA'),
('IGUATU'),
('JUAZEIRO DO NORTE'),
('LIMOEIRO DO NORTE'),
('QUIXADÁ'),
('SOBRAL'),
('TABULEIRO DO NORTE'), 
('TAUÁ');

---------------------------------------------
---- POPULANDO saa.CURSO
---------------------------------------------
--- select * from saa.curso;
ALTER SEQUENCE saa.curso_id_seq RESTART WITH 1;
DELETE FROM saa.curso;
insert into saa.curso(descricao, id_turno, id_campus)
select distinct UPPER(curso),1,1 from saa.temp t;

---------------------------------------------
---- POPULANDO saa.aluno
---------------------------------------------
ALTER TABLE saa.acompanhamento DROP COLUMN matricula;
ALTER TABLE saa.aluno DROP COLUMN matricula;

ALTER TABLE saa.aluno ADD COLUMN matricula VARCHAR(50) UNIQUE;
ALTER TABLE saa.acompanhamento ADD COLUMN matricula VARCHAR(50) REFERENCES saa.aluno(matricula);

DELETE FROM saa.aluno;
insert into saa.aluno(matricula, id_curso, situacao_escolar, id_pessoa, semestre)
select t.matricula,c.id,t.situacao_periodo,p.id,CAST(t.periodo AS INT) from saa.temp t
inner join saa.pessoa p ON replace(replace(t.cpf,'.',''),'-','') = p.cpf
inner join saa.curso c ON c.descricao = UPPER(t.curso)
WHERE t.matricula ~ '^[0-9.-]+$'


---------------------------------------------
---- CONSULTA DE TESTE
---------------------------------------------
/*
SELECT p.id, p.nome, p.cpf, p.rg, p.sexo, e.logradouro, e.numero, e.cep, b.descricao, c.descricao, u.descricao, a.matricula,a.semestre,curso.descricao, turno.descricao from saa.pessoa p 
inner join saa.pessoa_endereco pe ON pe.id_pessoa = p.id
inner join saa.endereco e ON pe.id_endereco = e.id
inner join saa.bairro b ON b.id = e.id_bairro
inner join saa.cidade c ON c.id = b.id_cidade
inner join saa.uf u ON u.id = c.id_uf
inner join saa.aluno a ON a.id_pessoa = p.id
inner join saa.curso curso ON curso.id = a.id_curso
inner join saa.turno turno ON turno.id = curso.id_turno
where p.cpf = '04824584370'
*/
