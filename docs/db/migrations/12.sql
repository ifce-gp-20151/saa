---------------------------------------------
---- **** ATENÇÃO ***
-- (1) - Antes de executar o script é necessário fazer o restore do arquivo sirem2.backup para que sejam incluidas as tabelas temporarias no schema public
-- com os dados a serem migrados para o schema saa.
-- (2) - No final deste script o schema public é dropado e criado novamente.
---------------------------------------------


-- Total Pessoas base SIREN
-- 23168
-- Total a ser Migradao
---23024
-- Total existente
-- 1725 (antes) 
-- 24749 (depois)
START TRANSACTION;
--ROLLBACK;
alter table saa.pessoa add migracao_siren BOOLEAN DEFAULT false;
alter table saa.pessoa add migracao_acad BOOLEAN DEFAULT false;

--select * from saa.pessoa
---------------------------------------------
---- MIGRANDO PESSOA
---------------------------------------------

INSERT INTO saa.pessoa(nome, cpf, rg, sexo,dt_nascimento,id_estado_civil,migracao_siren)
SELECT P.nome, LPAD(CAST(P.cpf AS VARCHAR),11, '0') AS cpf, '' as rg, P.sexo, P.data_nascimento, 1 as estado_civil, TRUE as migracao_siren 
FROM public.pessoa P where P.cpf not in (
---------------------------------------
-- CPF coincidentes com a base do SAA
SELECT distinct psi.cpf FROM public.pessoa psi
INNER JOIN saa.pessoa psa ON lpad(CAST(psi.cpf AS varchar),11,'0') = psa.cpf
);

---------------------------------------------
---- FIM MIGRANDO PESSOA
---------------------------------------------

---------------------------------------------
---- MIGRANDO CARGO
---------------------------------------------
-- Inserindo o cargo de servidor
--select * from saa.cargo;

DELETE FROM saa.cargo;
ALTER SEQUENCE saa.cargo_id_seq RESTART WITH 1;
INSERT INTO saa.cargo(descricao)
SELECT distinct nome_cargo FROM public.cargo;

---------------------------------------------
---- FIM MIGRANDO CARGO
---------------------------------------------
---------------------------------------------
---- MIGRANDO SERVIDOR
---------------------------------------------
-- Inserindo o cargo de servidor
-- Criando sequencia para tabela servidor
CREATE SEQUENCE saa.servidor_id_seq
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 1
  CACHE 1;
ALTER TABLE saa.servidor_id_seq
  OWNER TO postgres;

-- alterando o camp id da tabela servidor para sequencial
ALTER TABLE saa.servidor ALTER COLUMN id SET DEFAULT nextval('saa.servidor_id_seq'::regclass);
ALTER TABLE saa.servidor ADD id_pessoa BIGINT REFERENCES saa.pessoa(id);

-- inserindo servidores
INSERT INTO saa.servidor(siape, id_cargo,id_pessoa)
select s.siape,csa.id as id_cargo,psa.id from public.servidor s 
inner join saa.pessoa psa ON lpad(CAST(s.cpf AS varchar),11,'0') = psa.cpf
inner join saa.cargo csa ON csa.id = s.id_cargo; 

---------------------------------------------
---- FIM MIGRANDO SERVIDOR
---------------------------------------------

---------------------------------------------
---- MIGRANDO Endereco
---------------------------------------------
insert into saa.endereco(id_bairro,logradouro,numero,cep,complemento,migracao_pessoa)
select 
distinct
CASE WHEN b.id IS NULL THEN 5827 ELSE b.id END as id_bairro,
CASE WHEN upper(trim(t.endereco)) IS NULL THEN 'NÃO INFORMADO' ELSE upper(trim(t.endereco)) END,
CASE WHEN t.numero_casa IS NULL THEN '0' ELSE t.numero_casa END,
CASE WHEN upper(trim(replace(cast(t.cep as varchar),'-',''))) IS NULL OR length(trim(replace(cast(t.cep as varchar),'-',''))) > 10 THEN '0' ELSE upper(trim(replace(cast(t.cep as varchar),'-',''))) END,
'' as complemento,
p.id
from public.pessoa t 
inner join saa.pessoa p ON replace(replace(cast(t.cpf as varchar),'.',''),'-','') = p.cpf
left join public.municipios m ON t.id_municipio = m.id_municipio
left join saa.cidade c ON upper(saa.sem_acentos(m.nome)) = c.descricao and c.id_uf = 6
left join saa.bairro b ON upper(saa.sem_acentos(t.bairro)) = b.descricao and b.id_cidade = c.id and c.id_uf = 6
where trim(cast(numero_casa as varchar)) ~ '^[0-9.-]+$';

---------------------------------------------
---- POPULANDO pessoa_endereco
---------------------------------------------
insert into saa.pessoa_endereco(id_pessoa, id_endereco)
select 
distinct migracao_pessoa,e.id 
from saa.endereco e 
inner join saa.pessoa p ON p.id = e.migracao_pessoa and p.migracao_siren = true; 

drop schema public cascade;
create schema public;

-- ROLLBACK;
COMMIT;
