CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
insertar_persona (pnombre varchar, prut varchar, psexo varchar, pedad INT)

-- declaramos lo que retorna 
RETURNS BOOLEAN AS $$

-- declaramos las variables a utilizar si es que es necesario
DECLARE
pidmax int;
randomi int;

-- variable1;
-- variable2;

-- definimos nuestra función
BEGIN
    SELECT INTO pidmax
    MAX(pid)
    FROM Personal;

    IF 'contrasena' NOT IN (SELECT column_name FROM information_schema.columns WHERE table_name='personal') THEN
        ALTER TABLE personal ADD contrasena int;
        FOR id in 0 .. pidmax LOOP
            SELECT INTO randomi
            floor(random() * (9999 - 1000 + 1) + 1000)::int;
            UPDATE personal SET contrasena = randomi WHERE pid = id;
        END LOOP;
    END IF;

    IF prut IN (SELECT rut from Personal) THEN
        RETURN FALSE;
    END IF;

    SELECT INTO randomi
    floor(random() * (9999 - 1000 + 1) + 1000)::int;

    insert into personal values(pidmax + 1, pnombre, prut, psexo, pedad, randomi);
    RETURN TRUE;
    -- control de flujo
    -- IF condicion THEN
    --    pasa algo
    
    --ELSE
    --    pasa otra cosa

    --END IF;

    --FOR condicion LOOP
    --    hacer cosas
    -- END LOOP;
-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql