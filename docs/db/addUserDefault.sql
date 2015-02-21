-- CRIAÇÃO DO USUÁRIO admin com senha 1

INSERT INTO saa.estado_civil
( descricao )
values
( 'casado' ),
( 'solteiro' );

INSERT INTO saa.pessoa
( nome, cpf, rg, sexo, dt_nascimento, id_estado_civil )
values
( 'admin', '0', '0', 'M', '01/01/2000', 1 );

INSERT INTO saa.cargo
( descricao )
values
( 'administrador' );

INSERT INTO saa.servidor
( id, siape, id_cargo )
values
( 1, '0', 1 );

INSERT INTO saa.usuario
( id, login, senha, role_id )
values
( 1, 'admin', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 4 );

-- CRIAÇÃO DO ALUNO
INSERT INTO saa.periodo
( descricao )
values
( 'Manhã' );

INSERT INTO saa.curso
( id_periodo, descricao )
values
( 1, 'Ciência da Computação' );

INSERT INTO saa.aluno
( matricula, id_curso, situacao_escolar, id_pessoa )
values
( '201117050122', 1, 'Regular', 1 );
