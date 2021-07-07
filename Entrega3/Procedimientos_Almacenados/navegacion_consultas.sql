
--variable con valor de id usuario loggeado -> id_usuario

--SE ESCOGE UNA TIENDA DE UNA LISTA
--variable con valor de id tienda -> id_tienda_ingresado 
--testeado con id_tienda_ingresado = 14

-- 1
--  SE CLICKEA UN BOTÓN
--  3 productos más baratos para cada categoría de productos vendidos por la tienda (separar por No Comestible/Comestible)


SELECT productos.id, productos.nombre, productos.precio 
FROM productos, vende
WHERE id_tienda_ingresado = vende.id_tienda
AND productos.id = vende.id_producto
AND productos.categoria = 'comestible'
ORDER BY productos.precio ASC
LIMIT 3
;

SELECT productos.id, productos.nombre, productos.precio 
FROM productos, vende
WHERE id_tienda_ingresado = vende.id_tienda
AND productos.id = vende.id_producto
AND productos.categoria = 'no comestible'
ORDER BY productos.precio ASC
LIMIT 3
;


-- 2
--  SE INGRESA EL NOMBRE Y BOTÓN
--  Se entreguen todos los productos (nombre, categoría, descripción) vendidos por dicha tienda con este nombre ('nombre ingresado')
--  Case insensitive (strtolower en el php a nombre ingresado) y matching parcial (LIKE)

SELECT productos.nombre, productos.categoria, productos.descripcion
FROM productos, vende
WHERE id_tienda_ingresado = vende.id_tienda
AND productos.id = vende.id_producto
AND productos.nombre LIKE '%nombre ingresado%'
;


-- 3
--  SE INGRESA EL ID DEL PRODUCTO (O DROPDOWN) Y BOTÓN
--variable con valor de id producto -> id_producto_ingresado

-- 3.a

-- hacer ifs en el php para los casos de que se encuentre tienda o no (tabla vacía)

SELECT vende.id_tienda
FROM productos, vende
WHERE id_tienda_ingresado = vende.id_tienda
AND productos.id = vende.id_producto
AND productos.id = id_producto_ingresado


-- 3.b

-- hacer ifs en el php para los casos de que la tienda despache a su(s) domicilio(s) o no (tabla vacía)

SELECT direcciones.id
FROM direcciones, comunas, despacha_a
WHERE direcciones.id_comuna = comunas.id
AND comunas.id = despacha_a.id_comuna
AND despacha_a.id_tienda = id_tienda_ingresado

INTERSECT

SELECT direcciones.id
FROM direcciones, direcciones_usuarios
WHERE direcciones.id = direcciones_usuarios.id_direccion
AND direcciones_usuarios.id_usuario = id_usuario
;


-- 3.c

INSERT INTO compras VALUES(id_compra, id_usuario_ingresado, id_direccion_usuario, id_tienda_ingresado);

-- para determinar id_compra 
-- si no funciona el +1 en consulta, ponerlo en php

SELECT (compras.id + 1)
FROM compras
ORDER BY compras.id DESC
LIMIT 1


-- para determinar id_direccion_usuario (asumiendo que se manda a primer domicilio válido encontrado)

SELECT direcciones.id
FROM direcciones, comunas, despacha_a
WHERE direcciones.id_comuna = comunas.id
AND comunas.id = despacha_a.id_comuna
AND despacha_a.id_tienda = id_tienda_ingresado

INTERSECT

SELECT direcciones.id
FROM direcciones, direcciones_usuarios
WHERE direcciones.id = direcciones_usuarios.id_direccion
AND direcciones_usuarios.id_usuario = id_usuario
LIMIT 1
;

