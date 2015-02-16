START TRANSACTION;

ALTER TABLE saa.acompanhamento_individual ADD COLUMN data_criacao TIMESTAMP NOT NULL DEFAULT now();

COMMIT;
