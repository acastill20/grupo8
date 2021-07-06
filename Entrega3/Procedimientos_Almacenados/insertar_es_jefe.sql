CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
insertar_es_jefe()

-- declaramos lo que retorna 
RETURNS void AS $$

-- declaramos las variables a utilizar si es que es necesario
DECLARE

-- variable1;
-- variable2;

-- definimos nuestra función
BEGIN

    IF 'jefe' NOT IN (SELECT column_name FROM information_schema.columns WHERE table_name='usuarios') THEN
        ALTER TABLE usuarios ADD jefe int;
        UPDATE usuarios SET jefe = 0;
    END IF;

END
$$ language plpgsql