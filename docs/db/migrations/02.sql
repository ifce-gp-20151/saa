START TRANSACTION;

DROP FUNCTION IF EXISTS saa.to_cpf(numeric);

CREATE OR REPLACE FUNCTION saa.to_cpf(numeric)
  RETURNS text AS
$BODY$
BEGIN
  RETURN to_char($1, 'FM000"."000"."000"-"00');
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;

DROP FUNCTION IF EXISTS saa.to_telefone(numeric);

CREATE OR REPLACE FUNCTION saa.to_telefone(numeric)
  RETURNS text AS
$BODY$
BEGIN
  RETURN to_char($1, 'FM(00)" "0000"-"0000');
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;

CREATE OR REPLACE FUNCTION saa.to_cep(numeric)
  RETURNS text AS
$BODY$
BEGIN
  RETURN to_char($1, 'FM00"."000"-"000');
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;

COMMIT;