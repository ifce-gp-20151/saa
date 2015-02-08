--
-- PostgreSQL database dump
--

-- Dumped from database version 9.3.4
-- Dumped by pg_dump version 9.3.4
-- Started on 2015-02-08 00:28:47 BRT

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- TOC entry 6 (class 2615 OID 26522)
-- Name: saa; Type: SCHEMA; Schema: -; Owner: -
--

CREATE SCHEMA saa;


SET search_path = saa, pg_catalog;

SET default_with_oids = false;

--
-- TOC entry 211 (class 1259 OID 26854)
-- Name: acl_actions; Type: TABLE; Schema: saa; Owner: -
--

CREATE TABLE acl_actions (
    id integer NOT NULL,
    action character varying(50) NOT NULL
);


--
-- TOC entry 210 (class 1259 OID 26847)
-- Name: acl_controllers; Type: TABLE; Schema: saa; Owner: -
--

CREATE TABLE acl_controllers (
    id integer NOT NULL,
    controller character varying(50) NOT NULL
);


--
-- TOC entry 209 (class 1259 OID 26840)
-- Name: acl_modules; Type: TABLE; Schema: saa; Owner: -
--

CREATE TABLE acl_modules (
    id integer NOT NULL,
    module character varying(50) NOT NULL
);


--
-- TOC entry 214 (class 1259 OID 26895)
-- Name: acl_privileges; Type: TABLE; Schema: saa; Owner: -
--

CREATE TABLE acl_privileges (
    resource_id integer NOT NULL,
    role_id integer NOT NULL,
    allow boolean DEFAULT false NOT NULL
);


--
-- TOC entry 213 (class 1259 OID 26873)
-- Name: acl_resources; Type: TABLE; Schema: saa; Owner: -
--

CREATE TABLE acl_resources (
    id integer NOT NULL,
    module_id integer NOT NULL,
    controller_id integer NOT NULL,
    action_id integer NOT NULL
);


--
-- TOC entry 212 (class 1259 OID 26861)
-- Name: acl_roles; Type: TABLE; Schema: saa; Owner: -
--

CREATE TABLE acl_roles (
    id integer NOT NULL,
    role character varying(50) NOT NULL,
    parent integer
);


--
-- TOC entry 216 (class 1259 OID 26929)
-- Name: acompanhamento_id_seq; Type: SEQUENCE; Schema: saa; Owner: -
--

CREATE SEQUENCE acompanhamento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 205 (class 1259 OID 26683)
-- Name: acompanhamento; Type: TABLE; Schema: saa; Owner: -
--

CREATE TABLE acompanhamento (
    id bigint DEFAULT nextval('acompanhamento_id_seq'::regclass) NOT NULL,
    matricula bigint,
    motivo text NOT NULL,
    encaminhado character varying(255),
    id_servidor bigint
);


--
-- TOC entry 206 (class 1259 OID 26691)
-- Name: acompanhamento_individual; Type: TABLE; Schema: saa; Owner: -
--

CREATE TABLE acompanhamento_individual (
    id bigint NOT NULL,
    numero_encontro integer NOT NULL,
    descricao text NOT NULL,
    id_acompanhamento bigint
);


--
-- TOC entry 208 (class 1259 OID 26704)
-- Name: agenda; Type: TABLE; Schema: saa; Owner: -
--

CREATE TABLE agenda (
    id bigint NOT NULL,
    data date NOT NULL,
    fl_ocorreu boolean NOT NULL,
    hora_inicio timestamp without time zone,
    hora_fim timestamp without time zone
);


--
-- TOC entry 207 (class 1259 OID 26699)
-- Name: agenda_acompanhamento; Type: TABLE; Schema: saa; Owner: -
--

CREATE TABLE agenda_acompanhamento (
    id_acompanhamento bigint NOT NULL,
    id_agenda bigint NOT NULL
);


--
-- TOC entry 197 (class 1259 OID 26640)
-- Name: aluno; Type: TABLE; Schema: saa; Owner: -
--

CREATE TABLE aluno (
    matricula bigint NOT NULL,
    id_curso integer NOT NULL,
    situacao_escolar text NOT NULL,
    id_pessoa bigint NOT NULL
);


--
-- TOC entry 183 (class 1259 OID 26578)
-- Name: atividade_remunerada; Type: TABLE; Schema: saa; Owner: -
--

CREATE TABLE atividade_remunerada (
    id_pessoa bigint NOT NULL,
    id_profissao integer NOT NULL,
    fl_ativo boolean,
    salario numeric(10,2)
);


--
-- TOC entry 175 (class 1259 OID 26538)
-- Name: bairro; Type: TABLE; Schema: saa; Owner: -
--

CREATE TABLE bairro (
    id bigint NOT NULL,
    descricao character varying(255) NOT NULL,
    id_cidade bigint
);


--
-- TOC entry 174 (class 1259 OID 26536)
-- Name: bairro_id_seq; Type: SEQUENCE; Schema: saa; Owner: -
--

CREATE SEQUENCE bairro_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2256 (class 0 OID 0)
-- Dependencies: 174
-- Name: bairro_id_seq; Type: SEQUENCE OWNED BY; Schema: saa; Owner: -
--

ALTER SEQUENCE bairro_id_seq OWNED BY bairro.id;


--
-- TOC entry 204 (class 1259 OID 26677)
-- Name: cargo; Type: TABLE; Schema: saa; Owner: -
--

CREATE TABLE cargo (
    id integer NOT NULL,
    descricao character varying(255) NOT NULL
);


--
-- TOC entry 203 (class 1259 OID 26675)
-- Name: cargo_id_seq; Type: SEQUENCE; Schema: saa; Owner: -
--

CREATE SEQUENCE cargo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2257 (class 0 OID 0)
-- Dependencies: 203
-- Name: cargo_id_seq; Type: SEQUENCE OWNED BY; Schema: saa; Owner: -
--

ALTER SEQUENCE cargo_id_seq OWNED BY cargo.id;


--
-- TOC entry 173 (class 1259 OID 26530)
-- Name: cidade; Type: TABLE; Schema: saa; Owner: -
--

CREATE TABLE cidade (
    id bigint NOT NULL,
    descricao character varying(255) NOT NULL,
    id_uf integer
);


--
-- TOC entry 172 (class 1259 OID 26528)
-- Name: cidade_id_seq; Type: SEQUENCE; Schema: saa; Owner: -
--

CREATE SEQUENCE cidade_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2258 (class 0 OID 0)
-- Dependencies: 172
-- Name: cidade_id_seq; Type: SEQUENCE OWNED BY; Schema: saa; Owner: -
--

ALTER SEQUENCE cidade_id_seq OWNED BY cidade.id;


--
-- TOC entry 193 (class 1259 OID 26619)
-- Name: contato; Type: TABLE; Schema: saa; Owner: -
--

CREATE TABLE contato (
    id bigint NOT NULL,
    id_tipo_contato integer,
    contato character varying(255) NOT NULL
);


--
-- TOC entry 192 (class 1259 OID 26617)
-- Name: contato_id_seq; Type: SEQUENCE; Schema: saa; Owner: -
--

CREATE SEQUENCE contato_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2259 (class 0 OID 0)
-- Dependencies: 192
-- Name: contato_id_seq; Type: SEQUENCE OWNED BY; Schema: saa; Owner: -
--

ALTER SEQUENCE contato_id_seq OWNED BY contato.id;


--
-- TOC entry 199 (class 1259 OID 26651)
-- Name: curso; Type: TABLE; Schema: saa; Owner: -
--

CREATE TABLE curso (
    id integer NOT NULL,
    id_periodo integer,
    descricao character varying(255) NOT NULL
);


--
-- TOC entry 198 (class 1259 OID 26649)
-- Name: curso_id_seq; Type: SEQUENCE; Schema: saa; Owner: -
--

CREATE SEQUENCE curso_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2260 (class 0 OID 0)
-- Dependencies: 198
-- Name: curso_id_seq; Type: SEQUENCE OWNED BY; Schema: saa; Owner: -
--

ALTER SEQUENCE curso_id_seq OWNED BY curso.id;


--
-- TOC entry 188 (class 1259 OID 26598)
-- Name: dados_familiares; Type: TABLE; Schema: saa; Owner: -
--

CREATE TABLE dados_familiares (
    id bigint NOT NULL,
    nome character varying(255) NOT NULL,
    idade integer NOT NULL,
    id_profissao integer,
    id_grau_parentesco integer,
    fl_mora boolean NOT NULL
);


--
-- TOC entry 196 (class 1259 OID 26633)
-- Name: dados_familiares_contato; Type: TABLE; Schema: saa; Owner: -
--

CREATE TABLE dados_familiares_contato (
    id_dados_familiares bigint NOT NULL,
    id_contato bigint NOT NULL
);


--
-- TOC entry 187 (class 1259 OID 26596)
-- Name: dados_familiares_id_seq; Type: SEQUENCE; Schema: saa; Owner: -
--

CREATE SEQUENCE dados_familiares_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2261 (class 0 OID 0)
-- Dependencies: 187
-- Name: dados_familiares_id_seq; Type: SEQUENCE OWNED BY; Schema: saa; Owner: -
--

ALTER SEQUENCE dados_familiares_id_seq OWNED BY dados_familiares.id;


--
-- TOC entry 177 (class 1259 OID 26546)
-- Name: endereco; Type: TABLE; Schema: saa; Owner: -
--

CREATE TABLE endereco (
    id bigint NOT NULL,
    id_bairro bigint,
    logradouro character varying(255) NOT NULL,
    numero character varying(10) NOT NULL,
    cep character varying(10),
    complemento character varying(255)
);


--
-- TOC entry 176 (class 1259 OID 26544)
-- Name: endereco_id_seq; Type: SEQUENCE; Schema: saa; Owner: -
--

CREATE SEQUENCE endereco_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2262 (class 0 OID 0)
-- Dependencies: 176
-- Name: endereco_id_seq; Type: SEQUENCE OWNED BY; Schema: saa; Owner: -
--

ALTER SEQUENCE endereco_id_seq OWNED BY endereco.id;


--
-- TOC entry 182 (class 1259 OID 26572)
-- Name: estado_civil; Type: TABLE; Schema: saa; Owner: -
--

CREATE TABLE estado_civil (
    id integer NOT NULL,
    descricao character varying(50) NOT NULL
);


--
-- TOC entry 181 (class 1259 OID 26570)
-- Name: estado_civil_id_seq; Type: SEQUENCE; Schema: saa; Owner: -
--

CREATE SEQUENCE estado_civil_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2263 (class 0 OID 0)
-- Dependencies: 181
-- Name: estado_civil_id_seq; Type: SEQUENCE OWNED BY; Schema: saa; Owner: -
--

ALTER SEQUENCE estado_civil_id_seq OWNED BY estado_civil.id;


--
-- TOC entry 190 (class 1259 OID 26606)
-- Name: grau_parentesco; Type: TABLE; Schema: saa; Owner: -
--

CREATE TABLE grau_parentesco (
    id integer NOT NULL,
    descricao character varying(50) NOT NULL
);


--
-- TOC entry 189 (class 1259 OID 26604)
-- Name: grau_parentesco_id_seq; Type: SEQUENCE; Schema: saa; Owner: -
--

CREATE SEQUENCE grau_parentesco_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2264 (class 0 OID 0)
-- Dependencies: 189
-- Name: grau_parentesco_id_seq; Type: SEQUENCE OWNED BY; Schema: saa; Owner: -
--

ALTER SEQUENCE grau_parentesco_id_seq OWNED BY grau_parentesco.id;


--
-- TOC entry 201 (class 1259 OID 26659)
-- Name: periodo; Type: TABLE; Schema: saa; Owner: -
--

CREATE TABLE periodo (
    id integer NOT NULL,
    descricao character varying(255) NOT NULL
);


--
-- TOC entry 200 (class 1259 OID 26657)
-- Name: periodo_id_seq; Type: SEQUENCE; Schema: saa; Owner: -
--

CREATE SEQUENCE periodo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2265 (class 0 OID 0)
-- Dependencies: 200
-- Name: periodo_id_seq; Type: SEQUENCE OWNED BY; Schema: saa; Owner: -
--

ALTER SEQUENCE periodo_id_seq OWNED BY periodo.id;


--
-- TOC entry 180 (class 1259 OID 26562)
-- Name: pessoa; Type: TABLE; Schema: saa; Owner: -
--

CREATE TABLE pessoa (
    id bigint NOT NULL,
    nome character varying(255) NOT NULL,
    cpf character(11) NOT NULL,
    rg character varying(20),
    sexo character(1),
    dt_nascimento date NOT NULL,
    id_estado_civil integer NOT NULL
);


--
-- TOC entry 191 (class 1259 OID 26612)
-- Name: pessoa_contato; Type: TABLE; Schema: saa; Owner: -
--

CREATE TABLE pessoa_contato (
    id_pessoa bigint NOT NULL,
    id_contato bigint NOT NULL
);


--
-- TOC entry 178 (class 1259 OID 26555)
-- Name: pessoa_endereco; Type: TABLE; Schema: saa; Owner: -
--

CREATE TABLE pessoa_endereco (
    id_pessoa bigint NOT NULL,
    id_endereco bigint NOT NULL
);


--
-- TOC entry 186 (class 1259 OID 26591)
-- Name: pessoa_familiares; Type: TABLE; Schema: saa; Owner: -
--

CREATE TABLE pessoa_familiares (
    id_pessoa bigint NOT NULL,
    id_familiares bigint NOT NULL
);


--
-- TOC entry 179 (class 1259 OID 26560)
-- Name: pessoa_id_seq; Type: SEQUENCE; Schema: saa; Owner: -
--

CREATE SEQUENCE pessoa_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2266 (class 0 OID 0)
-- Dependencies: 179
-- Name: pessoa_id_seq; Type: SEQUENCE OWNED BY; Schema: saa; Owner: -
--

ALTER SEQUENCE pessoa_id_seq OWNED BY pessoa.id;


--
-- TOC entry 185 (class 1259 OID 26585)
-- Name: profissao; Type: TABLE; Schema: saa; Owner: -
--

CREATE TABLE profissao (
    id integer NOT NULL,
    descricao character varying(50) NOT NULL
);


--
-- TOC entry 184 (class 1259 OID 26583)
-- Name: profissao_id_seq; Type: SEQUENCE; Schema: saa; Owner: -
--

CREATE SEQUENCE profissao_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2267 (class 0 OID 0)
-- Dependencies: 184
-- Name: profissao_id_seq; Type: SEQUENCE OWNED BY; Schema: saa; Owner: -
--

ALTER SEQUENCE profissao_id_seq OWNED BY profissao.id;


--
-- TOC entry 202 (class 1259 OID 26665)
-- Name: servidor; Type: TABLE; Schema: saa; Owner: -
--

CREATE TABLE servidor (
    id bigint NOT NULL,
    siape integer NOT NULL,
    id_cargo integer NOT NULL
);


--
-- TOC entry 195 (class 1259 OID 26627)
-- Name: tipo_contato; Type: TABLE; Schema: saa; Owner: -
--

CREATE TABLE tipo_contato (
    id integer NOT NULL,
    descricao character varying(255) NOT NULL
);


--
-- TOC entry 194 (class 1259 OID 26625)
-- Name: tipo_contato_id_seq; Type: SEQUENCE; Schema: saa; Owner: -
--

CREATE SEQUENCE tipo_contato_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2268 (class 0 OID 0)
-- Dependencies: 194
-- Name: tipo_contato_id_seq; Type: SEQUENCE OWNED BY; Schema: saa; Owner: -
--

ALTER SEQUENCE tipo_contato_id_seq OWNED BY tipo_contato.id;


--
-- TOC entry 171 (class 1259 OID 26523)
-- Name: uf; Type: TABLE; Schema: saa; Owner: -
--

CREATE TABLE uf (
    id integer NOT NULL,
    descricao character varying(255) NOT NULL,
    sigla character(2) NOT NULL
);


--
-- TOC entry 215 (class 1259 OID 26911)
-- Name: usuario; Type: TABLE; Schema: saa; Owner: -
--

CREATE TABLE usuario (
    id bigint NOT NULL,
    login character varying(70) NOT NULL,
    senha character varying(100) NOT NULL,
    role_id integer NOT NULL
);


--
-- TOC entry 2019 (class 2604 OID 26541)
-- Name: id; Type: DEFAULT; Schema: saa; Owner: -
--

ALTER TABLE ONLY bairro ALTER COLUMN id SET DEFAULT nextval('bairro_id_seq'::regclass);


--
-- TOC entry 2030 (class 2604 OID 26680)
-- Name: id; Type: DEFAULT; Schema: saa; Owner: -
--

ALTER TABLE ONLY cargo ALTER COLUMN id SET DEFAULT nextval('cargo_id_seq'::regclass);


--
-- TOC entry 2018 (class 2604 OID 26533)
-- Name: id; Type: DEFAULT; Schema: saa; Owner: -
--

ALTER TABLE ONLY cidade ALTER COLUMN id SET DEFAULT nextval('cidade_id_seq'::regclass);


--
-- TOC entry 2026 (class 2604 OID 26622)
-- Name: id; Type: DEFAULT; Schema: saa; Owner: -
--

ALTER TABLE ONLY contato ALTER COLUMN id SET DEFAULT nextval('contato_id_seq'::regclass);


--
-- TOC entry 2028 (class 2604 OID 26654)
-- Name: id; Type: DEFAULT; Schema: saa; Owner: -
--

ALTER TABLE ONLY curso ALTER COLUMN id SET DEFAULT nextval('curso_id_seq'::regclass);


--
-- TOC entry 2024 (class 2604 OID 26601)
-- Name: id; Type: DEFAULT; Schema: saa; Owner: -
--

ALTER TABLE ONLY dados_familiares ALTER COLUMN id SET DEFAULT nextval('dados_familiares_id_seq'::regclass);


--
-- TOC entry 2020 (class 2604 OID 26549)
-- Name: id; Type: DEFAULT; Schema: saa; Owner: -
--

ALTER TABLE ONLY endereco ALTER COLUMN id SET DEFAULT nextval('endereco_id_seq'::regclass);


--
-- TOC entry 2022 (class 2604 OID 26575)
-- Name: id; Type: DEFAULT; Schema: saa; Owner: -
--

ALTER TABLE ONLY estado_civil ALTER COLUMN id SET DEFAULT nextval('estado_civil_id_seq'::regclass);


--
-- TOC entry 2025 (class 2604 OID 26609)
-- Name: id; Type: DEFAULT; Schema: saa; Owner: -
--

ALTER TABLE ONLY grau_parentesco ALTER COLUMN id SET DEFAULT nextval('grau_parentesco_id_seq'::regclass);


--
-- TOC entry 2029 (class 2604 OID 26662)
-- Name: id; Type: DEFAULT; Schema: saa; Owner: -
--

ALTER TABLE ONLY periodo ALTER COLUMN id SET DEFAULT nextval('periodo_id_seq'::regclass);


--
-- TOC entry 2021 (class 2604 OID 26565)
-- Name: id; Type: DEFAULT; Schema: saa; Owner: -
--

ALTER TABLE ONLY pessoa ALTER COLUMN id SET DEFAULT nextval('pessoa_id_seq'::regclass);


--
-- TOC entry 2023 (class 2604 OID 26588)
-- Name: id; Type: DEFAULT; Schema: saa; Owner: -
--

ALTER TABLE ONLY profissao ALTER COLUMN id SET DEFAULT nextval('profissao_id_seq'::regclass);


--
-- TOC entry 2027 (class 2604 OID 26630)
-- Name: id; Type: DEFAULT; Schema: saa; Owner: -
--

ALTER TABLE ONLY tipo_contato ALTER COLUMN id SET DEFAULT nextval('tipo_contato_id_seq'::regclass);


--
-- TOC entry 2096 (class 2606 OID 26860)
-- Name: acl_actions_action_key; Type: CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY acl_actions
    ADD CONSTRAINT acl_actions_action_key UNIQUE (action);


--
-- TOC entry 2098 (class 2606 OID 26858)
-- Name: acl_actions_pkey; Type: CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY acl_actions
    ADD CONSTRAINT acl_actions_pkey PRIMARY KEY (id);


--
-- TOC entry 2092 (class 2606 OID 26853)
-- Name: acl_controllers_controller_key; Type: CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY acl_controllers
    ADD CONSTRAINT acl_controllers_controller_key UNIQUE (controller);


--
-- TOC entry 2094 (class 2606 OID 26851)
-- Name: acl_controllers_pkey; Type: CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY acl_controllers
    ADD CONSTRAINT acl_controllers_pkey PRIMARY KEY (id);


--
-- TOC entry 2088 (class 2606 OID 26846)
-- Name: acl_modules_module_key; Type: CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY acl_modules
    ADD CONSTRAINT acl_modules_module_key UNIQUE (module);


--
-- TOC entry 2090 (class 2606 OID 26844)
-- Name: acl_modules_pkey; Type: CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY acl_modules
    ADD CONSTRAINT acl_modules_pkey PRIMARY KEY (id);


--
-- TOC entry 2108 (class 2606 OID 26900)
-- Name: acl_privileges_pkey; Type: CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY acl_privileges
    ADD CONSTRAINT acl_privileges_pkey PRIMARY KEY (resource_id, role_id);


--
-- TOC entry 2104 (class 2606 OID 26879)
-- Name: acl_resources_module_id_controller_id_action_id_key; Type: CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY acl_resources
    ADD CONSTRAINT acl_resources_module_id_controller_id_action_id_key UNIQUE (module_id, controller_id, action_id);


--
-- TOC entry 2106 (class 2606 OID 26877)
-- Name: acl_resources_pkey; Type: CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY acl_resources
    ADD CONSTRAINT acl_resources_pkey PRIMARY KEY (id);


--
-- TOC entry 2100 (class 2606 OID 26865)
-- Name: acl_roles_pkey; Type: CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY acl_roles
    ADD CONSTRAINT acl_roles_pkey PRIMARY KEY (id);


--
-- TOC entry 2102 (class 2606 OID 26867)
-- Name: acl_roles_role_key; Type: CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY acl_roles
    ADD CONSTRAINT acl_roles_role_key UNIQUE (role);


--
-- TOC entry 2082 (class 2606 OID 26698)
-- Name: acompanhamento_individual_pkey; Type: CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY acompanhamento_individual
    ADD CONSTRAINT acompanhamento_individual_pkey PRIMARY KEY (id);


--
-- TOC entry 2080 (class 2606 OID 26690)
-- Name: acompanhamento_pkey; Type: CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY acompanhamento
    ADD CONSTRAINT acompanhamento_pkey PRIMARY KEY (id);


--
-- TOC entry 2084 (class 2606 OID 26703)
-- Name: agenda_acompanhamento_pkey; Type: CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY agenda_acompanhamento
    ADD CONSTRAINT agenda_acompanhamento_pkey PRIMARY KEY (id_acompanhamento, id_agenda);


--
-- TOC entry 2086 (class 2606 OID 26708)
-- Name: agenda_pkey; Type: CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY agenda
    ADD CONSTRAINT agenda_pkey PRIMARY KEY (id);


--
-- TOC entry 2070 (class 2606 OID 26648)
-- Name: aluno_pkey; Type: CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY aluno
    ADD CONSTRAINT aluno_pkey PRIMARY KEY (matricula);


--
-- TOC entry 2050 (class 2606 OID 26582)
-- Name: atividade_remunerada_pkey; Type: CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY atividade_remunerada
    ADD CONSTRAINT atividade_remunerada_pkey PRIMARY KEY (id_pessoa, id_profissao);


--
-- TOC entry 2038 (class 2606 OID 26543)
-- Name: bairro_pkey; Type: CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY bairro
    ADD CONSTRAINT bairro_pkey PRIMARY KEY (id);


--
-- TOC entry 2078 (class 2606 OID 26682)
-- Name: cargo_pkey; Type: CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY cargo
    ADD CONSTRAINT cargo_pkey PRIMARY KEY (id);


--
-- TOC entry 2036 (class 2606 OID 26535)
-- Name: cidade_pkey; Type: CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY cidade
    ADD CONSTRAINT cidade_pkey PRIMARY KEY (id);


--
-- TOC entry 2064 (class 2606 OID 26624)
-- Name: contato_pkey; Type: CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY contato
    ADD CONSTRAINT contato_pkey PRIMARY KEY (id);


--
-- TOC entry 2072 (class 2606 OID 26656)
-- Name: curso_pkey; Type: CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY curso
    ADD CONSTRAINT curso_pkey PRIMARY KEY (id);


--
-- TOC entry 2068 (class 2606 OID 26637)
-- Name: dados_familiares_contato_pkey; Type: CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY dados_familiares_contato
    ADD CONSTRAINT dados_familiares_contato_pkey PRIMARY KEY (id_dados_familiares, id_contato);


--
-- TOC entry 2058 (class 2606 OID 26603)
-- Name: dados_familiares_pkey; Type: CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY dados_familiares
    ADD CONSTRAINT dados_familiares_pkey PRIMARY KEY (id);


--
-- TOC entry 2040 (class 2606 OID 26554)
-- Name: endereco_pkey; Type: CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY endereco
    ADD CONSTRAINT endereco_pkey PRIMARY KEY (id);


--
-- TOC entry 2048 (class 2606 OID 26577)
-- Name: estado_civil_pkey; Type: CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY estado_civil
    ADD CONSTRAINT estado_civil_pkey PRIMARY KEY (id);


--
-- TOC entry 2060 (class 2606 OID 26611)
-- Name: grau_parentesco_pkey; Type: CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY grau_parentesco
    ADD CONSTRAINT grau_parentesco_pkey PRIMARY KEY (id);


--
-- TOC entry 2074 (class 2606 OID 26664)
-- Name: periodo_pkey; Type: CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY periodo
    ADD CONSTRAINT periodo_pkey PRIMARY KEY (id);


--
-- TOC entry 2062 (class 2606 OID 26616)
-- Name: pessoa_contato_pkey; Type: CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY pessoa_contato
    ADD CONSTRAINT pessoa_contato_pkey PRIMARY KEY (id_pessoa, id_contato);


--
-- TOC entry 2044 (class 2606 OID 26569)
-- Name: pessoa_cpf_key; Type: CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY pessoa
    ADD CONSTRAINT pessoa_cpf_key UNIQUE (cpf);


--
-- TOC entry 2042 (class 2606 OID 26559)
-- Name: pessoa_endereco_pkey; Type: CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY pessoa_endereco
    ADD CONSTRAINT pessoa_endereco_pkey PRIMARY KEY (id_pessoa, id_endereco);


--
-- TOC entry 2056 (class 2606 OID 26595)
-- Name: pessoa_familiares_pkey; Type: CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY pessoa_familiares
    ADD CONSTRAINT pessoa_familiares_pkey PRIMARY KEY (id_pessoa, id_familiares);


--
-- TOC entry 2046 (class 2606 OID 26567)
-- Name: pessoa_pkey; Type: CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY pessoa
    ADD CONSTRAINT pessoa_pkey PRIMARY KEY (id);


--
-- TOC entry 2052 (class 2606 OID 26928)
-- Name: profissao_descricao_key; Type: CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY profissao
    ADD CONSTRAINT profissao_descricao_key UNIQUE (descricao);


--
-- TOC entry 2054 (class 2606 OID 26590)
-- Name: profissao_pkey; Type: CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY profissao
    ADD CONSTRAINT profissao_pkey PRIMARY KEY (id);


--
-- TOC entry 2076 (class 2606 OID 26669)
-- Name: servidor_pkey; Type: CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY servidor
    ADD CONSTRAINT servidor_pkey PRIMARY KEY (id);


--
-- TOC entry 2066 (class 2606 OID 26632)
-- Name: tipo_contato_pkey; Type: CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY tipo_contato
    ADD CONSTRAINT tipo_contato_pkey PRIMARY KEY (id);


--
-- TOC entry 2034 (class 2606 OID 26527)
-- Name: uf_pkey; Type: CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY uf
    ADD CONSTRAINT uf_pkey PRIMARY KEY (id);


--
-- TOC entry 2110 (class 2606 OID 26915)
-- Name: usuario_pk; Type: CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT usuario_pk PRIMARY KEY (id);


--
-- TOC entry 2141 (class 2606 OID 26901)
-- Name: acl_privileges_resource_id_fkey; Type: FK CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY acl_privileges
    ADD CONSTRAINT acl_privileges_resource_id_fkey FOREIGN KEY (resource_id) REFERENCES acl_resources(id);


--
-- TOC entry 2142 (class 2606 OID 26906)
-- Name: acl_privileges_role_id_fkey; Type: FK CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY acl_privileges
    ADD CONSTRAINT acl_privileges_role_id_fkey FOREIGN KEY (role_id) REFERENCES acl_roles(id);


--
-- TOC entry 2138 (class 2606 OID 26880)
-- Name: acl_resources_action_id_fkey; Type: FK CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY acl_resources
    ADD CONSTRAINT acl_resources_action_id_fkey FOREIGN KEY (action_id) REFERENCES acl_actions(id);


--
-- TOC entry 2139 (class 2606 OID 26885)
-- Name: acl_resources_controller_id_fkey; Type: FK CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY acl_resources
    ADD CONSTRAINT acl_resources_controller_id_fkey FOREIGN KEY (controller_id) REFERENCES acl_controllers(id);


--
-- TOC entry 2140 (class 2606 OID 26890)
-- Name: acl_resources_module_id_fkey; Type: FK CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY acl_resources
    ADD CONSTRAINT acl_resources_module_id_fkey FOREIGN KEY (module_id) REFERENCES acl_modules(id);


--
-- TOC entry 2137 (class 2606 OID 26868)
-- Name: acl_roles_parent_fkey; Type: FK CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY acl_roles
    ADD CONSTRAINT acl_roles_parent_fkey FOREIGN KEY (parent) REFERENCES acl_roles(id);


--
-- TOC entry 2132 (class 2606 OID 26814)
-- Name: acompanhamento_aluno_fk; Type: FK CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY acompanhamento
    ADD CONSTRAINT acompanhamento_aluno_fk FOREIGN KEY (matricula) REFERENCES aluno(matricula);


--
-- TOC entry 2134 (class 2606 OID 26824)
-- Name: acompanhamento_individual__acompanhamento_fk; Type: FK CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY acompanhamento_individual
    ADD CONSTRAINT acompanhamento_individual__acompanhamento_fk FOREIGN KEY (id_acompanhamento) REFERENCES acompanhamento(id);


--
-- TOC entry 2133 (class 2606 OID 26819)
-- Name: acompanhamento_servidor_fk; Type: FK CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY acompanhamento
    ADD CONSTRAINT acompanhamento_servidor_fk FOREIGN KEY (id_servidor) REFERENCES servidor(id);


--
-- TOC entry 2135 (class 2606 OID 26829)
-- Name: agenda_acompanhamento__acompanhamento_fk; Type: FK CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY agenda_acompanhamento
    ADD CONSTRAINT agenda_acompanhamento__acompanhamento_fk FOREIGN KEY (id_acompanhamento) REFERENCES acompanhamento(id);


--
-- TOC entry 2136 (class 2606 OID 26834)
-- Name: agenda_acompanhamento__agenda_fk; Type: FK CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY agenda_acompanhamento
    ADD CONSTRAINT agenda_acompanhamento__agenda_fk FOREIGN KEY (id_agenda) REFERENCES agenda(id);


--
-- TOC entry 2129 (class 2606 OID 26799)
-- Name: aluno_curso_fk; Type: FK CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY aluno
    ADD CONSTRAINT aluno_curso_fk FOREIGN KEY (id_curso) REFERENCES curso(id);


--
-- TOC entry 2128 (class 2606 OID 26794)
-- Name: aluno_pessoa_fk; Type: FK CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY aluno
    ADD CONSTRAINT aluno_pessoa_fk FOREIGN KEY (id_pessoa) REFERENCES pessoa(id);


--
-- TOC entry 2117 (class 2606 OID 26739)
-- Name: atividade_remunerada__pessoa_fk; Type: FK CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY atividade_remunerada
    ADD CONSTRAINT atividade_remunerada__pessoa_fk FOREIGN KEY (id_pessoa) REFERENCES pessoa(id);


--
-- TOC entry 2118 (class 2606 OID 26744)
-- Name: atividade_remunerada__profissao_fk; Type: FK CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY atividade_remunerada
    ADD CONSTRAINT atividade_remunerada__profissao_fk FOREIGN KEY (id_profissao) REFERENCES profissao(id);


--
-- TOC entry 2112 (class 2606 OID 26714)
-- Name: bairro_cidade_fk; Type: FK CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY bairro
    ADD CONSTRAINT bairro_cidade_fk FOREIGN KEY (id_cidade) REFERENCES cidade(id);


--
-- TOC entry 2111 (class 2606 OID 26709)
-- Name: cidade_uf_fk; Type: FK CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY cidade
    ADD CONSTRAINT cidade_uf_fk FOREIGN KEY (id_uf) REFERENCES uf(id);


--
-- TOC entry 2125 (class 2606 OID 26789)
-- Name: contato__tipo_contato_fk; Type: FK CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY contato
    ADD CONSTRAINT contato__tipo_contato_fk FOREIGN KEY (id_tipo_contato) REFERENCES tipo_contato(id);


--
-- TOC entry 2130 (class 2606 OID 26804)
-- Name: curso_periodo_fk; Type: FK CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY curso
    ADD CONSTRAINT curso_periodo_fk FOREIGN KEY (id_periodo) REFERENCES periodo(id);


--
-- TOC entry 2113 (class 2606 OID 26719)
-- Name: endereco_bairro_fk; Type: FK CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY endereco
    ADD CONSTRAINT endereco_bairro_fk FOREIGN KEY (id_bairro) REFERENCES bairro(id);


--
-- TOC entry 2121 (class 2606 OID 26759)
-- Name: familiares__profissao_fk; Type: FK CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY dados_familiares
    ADD CONSTRAINT familiares__profissao_fk FOREIGN KEY (id_profissao) REFERENCES profissao(id);


--
-- TOC entry 2127 (class 2606 OID 26774)
-- Name: familiares_contato__contato_fk; Type: FK CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY dados_familiares_contato
    ADD CONSTRAINT familiares_contato__contato_fk FOREIGN KEY (id_contato) REFERENCES contato(id);


--
-- TOC entry 2126 (class 2606 OID 26769)
-- Name: familiares_contato__familiares_fk; Type: FK CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY dados_familiares_contato
    ADD CONSTRAINT familiares_contato__familiares_fk FOREIGN KEY (id_dados_familiares) REFERENCES dados_familiares(id);


--
-- TOC entry 2122 (class 2606 OID 26764)
-- Name: familiares_grau__parentesco_fk; Type: FK CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY dados_familiares
    ADD CONSTRAINT familiares_grau__parentesco_fk FOREIGN KEY (id_grau_parentesco) REFERENCES grau_parentesco(id);


--
-- TOC entry 2124 (class 2606 OID 26784)
-- Name: pessoa_contato__contato_fk; Type: FK CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY pessoa_contato
    ADD CONSTRAINT pessoa_contato__contato_fk FOREIGN KEY (id_contato) REFERENCES contato(id);


--
-- TOC entry 2123 (class 2606 OID 26779)
-- Name: pessoa_contato__pessoa_fk; Type: FK CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY pessoa_contato
    ADD CONSTRAINT pessoa_contato__pessoa_fk FOREIGN KEY (id_pessoa) REFERENCES pessoa(id);


--
-- TOC entry 2114 (class 2606 OID 26724)
-- Name: pessoa_endereco__endereco_fk; Type: FK CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY pessoa_endereco
    ADD CONSTRAINT pessoa_endereco__endereco_fk FOREIGN KEY (id_endereco) REFERENCES endereco(id);


--
-- TOC entry 2115 (class 2606 OID 26729)
-- Name: pessoa_endereco__pessoa_fk; Type: FK CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY pessoa_endereco
    ADD CONSTRAINT pessoa_endereco__pessoa_fk FOREIGN KEY (id_pessoa) REFERENCES pessoa(id);


--
-- TOC entry 2116 (class 2606 OID 26734)
-- Name: pessoa_estado_civil_fk; Type: FK CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY pessoa
    ADD CONSTRAINT pessoa_estado_civil_fk FOREIGN KEY (id_estado_civil) REFERENCES estado_civil(id);


--
-- TOC entry 2120 (class 2606 OID 26754)
-- Name: pessoa_familiares__familiares_fk; Type: FK CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY pessoa_familiares
    ADD CONSTRAINT pessoa_familiares__familiares_fk FOREIGN KEY (id_familiares) REFERENCES dados_familiares(id);


--
-- TOC entry 2119 (class 2606 OID 26749)
-- Name: pessoa_familiares__pessoa_fk; Type: FK CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY pessoa_familiares
    ADD CONSTRAINT pessoa_familiares__pessoa_fk FOREIGN KEY (id_pessoa) REFERENCES pessoa(id);


--
-- TOC entry 2131 (class 2606 OID 26809)
-- Name: servidor_cargo_fk; Type: FK CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY servidor
    ADD CONSTRAINT servidor_cargo_fk FOREIGN KEY (id_cargo) REFERENCES cargo(id);


--
-- TOC entry 2143 (class 2606 OID 26916)
-- Name: usuario_id_fkey; Type: FK CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT usuario_id_fkey FOREIGN KEY (id) REFERENCES servidor(id);


--
-- TOC entry 2144 (class 2606 OID 26921)
-- Name: usuario_role_fkey; Type: FK CONSTRAINT; Schema: saa; Owner: -
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT usuario_role_fkey FOREIGN KEY (role_id) REFERENCES acl_roles(id);


-- Completed on 2015-02-08 00:28:49 BRT

--
-- PostgreSQL database dump complete
--

