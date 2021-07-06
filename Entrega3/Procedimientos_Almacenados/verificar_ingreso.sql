CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
verificar_ingreso (urut varchar, ucontraseña INT)

-- declaramos lo que retorna 
RETURNS BOOLEAN AS $$

-- declaramos las variables a utilizar si es que es necesario
DECLARE

-- variable1;
-- variable2;

-- definimos nuestra función
BEGIN

    IF urut NOT IN (SELECT rut from usuarios) THEN
        RETURN FALSE;
    END IF;

    IF ucontraseña NOT IN (SELECT contrasena from usuarios WHERE usuarios.rut = urut) THEN
        RETURN FALSE;
    END IF;

    RETURN TRUE;

END
$$ language plpgsql