```
CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    documento VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

```

```
CREATE TABLE vuelos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    origen VARCHAR(255) NOT NULL,
    destino VARCHAR(255) NOT NULL,
    aerolinea VARCHAR(255) NOT NULL
);


```
```
INSERT INTO vuelos (origen, destino, aerolinea) VALUES
('Nueva York', 'Los Ángeles', 'American Airlines'),
('Londres', 'París', 'British Airways'),
('Tokio', 'Seúl', 'Japan Airlines'),
('Sídney', 'Melbourne', 'Qantas'),
('Ciudad de México', 'Cancún', 'Aeroméxico');


```

Para obtener los vuelos que llegan a Cartagena provenientes de Manizales y Medellín, puedes usar la cláusula `UNION` para combinar los resultados de dos consultas separadas. Aquí te muestro cómo hacerlo:

```sql
SELECT * FROM vuelos WHERE destino = 'Cartagena' AND origen = 'Manizales'
UNION
SELECT * FROM vuelos WHERE destino = 'Cartagena' AND origen = 'Medellín';
```

Esta consulta SQL seleccionará todas las filas de la tabla `vuelos` donde el destino sea 'Cartagena' y el origen sea 'Manizales', y luego combinará esos resultados con todas las filas donde el destino sea 'Cartagena' y el origen sea 'Medellín'. De esta manera, obtendrás todos los vuelos que llegan a Cartagena provenientes de Manizales y Medellín.