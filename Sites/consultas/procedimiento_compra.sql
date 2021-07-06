CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
generar_compra (id_producto_ingresado INTEGER, id_tienda_ingresado INTEGER, id_usuario_fijado INTEGER)

-- declaramos lo que retorna 
-- RETURNS VARCHAR(250) AS $$
RETURNS INTEGER AS $$

-- declaramos las variables a utilizar si es que es necesario
DECLARE
coidmax INTEGER;
did INTEGER;
precio VARCHAR(10);
nombre_direccion VARCHAR(200);
-- idcomuna int;
-- randomi int;

-- definimos nuestra función
BEGIN
    
    -- ¿La tienda vende el producto? (RETORNAR MENSAJE)
    IF id_tienda_ingresado NOT IN (SELECT vende.id_tienda
    FROM productos, vende
    WHERE id_tienda_ingresado = vende.id_tienda
    AND productos.id = vende.id_producto
    AND productos.id = id_producto_ingresado) THEN
        -- RETURN "La tienda no vende este producto. Intenta con otro ID.";
        RETURN 0;
    END IF;

    -- ¿La tienda despacha al menos a una dirección del usuario? (RETORNAR MENSAJE)
    -- SELECT COUNT(*) FROM (query))

    IF (SELECT direcciones.id
    FROM direcciones, comunas, despacha_a
    WHERE direcciones.id_comuna = comunas.id
    AND comunas.id = despacha_a.id_comuna
    AND despacha_a.id_tienda = id_tienda_ingresado

    INTERSECT

    SELECT direcciones.id
    FROM direcciones, direcciones_usuarios
    WHERE direcciones.id = direcciones_usuarios.id_direccion
    AND direcciones_usuarios.id_usuario = id_usuario
    LIMIT 1) IS NULL THEN
        -- RETURN "La tienda no despacha a ninguna de las comunas de tus direcciones.";
        RETURN 1;
    END IF;

    -- IF (SELECT direcciones.id
    -- FROM direcciones, comunas, despacha_a
    -- WHERE direcciones.id_comuna = comunas.id
    -- AND comunas.id = despacha_a.id_comuna
    -- AND despacha_a.id_tienda = id_tienda_ingresado

    -- INTERSECT

    -- SELECT direcciones.id
    -- FROM direcciones, direcciones_usuarios
    -- WHERE direcciones.id = direcciones_usuarios.id_direccion
    -- AND direcciones_usuarios.id_usuario = id_usuario) IS NULL THEN
    --     -- RETURN "La tienda no despacha a ninguna de las comunas de tus direcciones.";
    --     RETURN 1;
    -- END IF;
    
    -- SELECT generar_compra(394, 5, 1);

    -- Determinación de valores para generar compra (DESPLEGAR INFO DE LA COMPRA GENERADA)

    -- coid
    SELECT INTO coidmax
    MAX(id)
    FROM compras;

    -- did
    SELECT * INTO did FROM (
        SELECT direcciones.id
        FROM direcciones, comunas, despacha_a
        WHERE direcciones.id_comuna = comunas.id
        AND comunas.id = despacha_a.id_comuna
        AND despacha_a.id_tienda = id_tienda_ingresado

        INTERSECT

        SELECT direcciones.id
        FROM direcciones, direcciones_usuarios
        WHERE direcciones.id = direcciones_usuarios.id_direccion
        AND direcciones_usuarios.id_usuario = id_usuario_fijado
        LIMIT 1) AS foo;

    -- nombre dirección
    SELECT INTO nombre_direccion
    direcciones.direccion
    FROM direcciones
    WHERE direcciones.id = did
    ;

    -- precio del producto
    SELECT INTO precio
    productos.precio
    FROM productos
    WHERE productos.id = id_producto_ingresado
    ;
    
    INSERT INTO compras VALUES(coidmax + 1, id_usuario_fijado, did, id_tienda_ingresado);
    INSERT INTO producto_comprado VALUES(coidmax + 1, id_producto_ingresado, 1);
    -- RETURN CONCAT('¡Se ha realizado con éxito tu compra!\nCompra #', (coidmax + 1), '\n', 'Precio total: ', precio, '\n', 'Envío con dirección ', nombre_direccion);
    RETURN 2;

END;
$$ language plpgsql;



SELECT direcciones.direccion FROM direcciones, direcciones_usuarios WHERE direcciones_usuarios.id_usuario = 0 AND direcciones_usuarios.id_direccion = direcciones.id;