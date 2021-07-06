CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
insertar_usuario (unombre varchar, urut varchar, uedad INT,usexo varchar, udireccion varchar, dcomuna varchar, es_jefe INT, clave INT)

-- declaramos lo que retorna 
RETURNS BOOLEAN AS $$

-- declaramos las variables a utilizar si es que es necesario
DECLARE
uidmax int;
didmax int;
idcomuna int;
randomi int;

-- variable1;
-- variable2;

-- definimos nuestra función
BEGIN

    SELECT INTO uidmax
    MAX(id)
    FROM usuarios;

    SELECT INTO didmax
    MAX(id)
    FROM direcciones;

    IF 'contrasena' NOT IN (SELECT column_name FROM information_schema.columns WHERE table_name='usuarios') THEN
        ALTER TABLE usuarios ADD contrasena int;
        FOR id_1 in 0 .. uidmax LOOP
            SELECT INTO randomi
            FLOOR(random() * (9999 - 1000 + 1) + 1000)::int;
            UPDATE usuarios SET contrasena = randomi WHERE id = id_1;
        END LOOP;
    END IF;

    IF urut IN (SELECT rut from usuarios) THEN
        RETURN FALSE;
    END IF;

    IF dcomuna NOT IN (SELECT nombre_comuna from comunas) THEN
        RETURN FALSE;
    END IF;

    SELECT INTO idcomuna
    comunas.id
    FROM comunas
    WHERE comunas.nombre_comuna = dcomuna;

    SELECT INTO randomi
    floor(random() * (9999 - 1000 + 1) + 1000)::int;

    insert into usuarios values(uidmax + 1, unombre, urut, uedad, usexo, es_jefe, clave);
    insert into direcciones values(didmax + 1, udireccion, idcomuna);
    insert into direcciones_usuarios values(uidmax + 1, didmax + 1);
    RETURN TRUE;

END
$$ language plpgsql