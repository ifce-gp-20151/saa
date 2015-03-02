COPY pessoa(nome, cpf, dt_nascimento, sexo, id_estado_civil)
FROM '/tmp/text.csv' WITH (FORMAT CSV, DELIMITER ';', QUOTE '~', NULL '', ENCODING 'UTF-8');


COPY (SELECT nome, to_char(cpf, 'FM00000000000'), data_nascimento, sexo, 1
		FROM pessoa WHERE cpf > 0
) TO '/tmp/text.csv' WITH CSV DELIMITER ';';
