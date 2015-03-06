-- Altera o tipo de dados hora_inicio, hora_fim da agenda para time.

ALTER TABLE saa.agenda
   ALTER COLUMN hora_inicio TYPE time without time zone;

ALTER TABLE saa.agenda
   ALTER COLUMN hora_fim TYPE time without time zone;
