--Todos los vuelos que salen de Manizales
SELECT origen, destino, aerolinea
FROM vuelos
WHERE origen = 'manizales'

--Todos los vuelos que llegan a Bogota
SELECT origen, destino, aerolinea
FROM vuelos
WHERE destino = 'bogota'

---Que aerolineas me llevan de Manizales a Cartagena
SELECT aerolinea
FROM vuelos
WHERE origen = 'manizales' AND destino = 'cartagena'

--Todos los vuelos que salen de Manizales con alias de columnas
SELECT origen as desde, destino as hasta, aerolinea as operador
FROM vuelos
WHERE origen = 'manizales'

--Los vuelos que llegan a Cartagena provenientes de Manizales y/o Medellin
SELECT origen as desde, destino as hasta, aerolinea as operador
FROM vuelos
WHERE destino = 'cartagena' AND origen = 'manizales'
UNION
SELECT origen as desde, destino as hasta, aerolinea as operador
FROM vuelos
WHERE destino = 'cartagena' AND origen = 'medellin'