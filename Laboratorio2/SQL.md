```
CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    documento VARCHAR(20) NOT NULL,
    usuario VARCHAR(50) NOT NULL,
    contraseña VARCHAR(255) NOT NULL,
    salt VARCHAR(255) NOT NULL -- Nuevo campo para almacenar el valor de sal
);

```
# Imagen

![alt text](Anexos/image.png)

Protegiendo el archivo `config.php` 

`chmod 600 /ruta/a/tu/config.php`


tabla `mensaje de usuarios`
```
CREATE TABLE mensajes_contacto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255),
    email VARCHAR(255),
    telefono VARCHAR(15),
    mensaje TEXT,
    fecha_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

```
agregamos a la base de datos las siguientes columnas 'intentos_fallidos' y 'tiempo_bloqueo'

```
ALTER TABLE usuario ADD COLUMN intentos_fallidos INT DEFAULT 0;
ALTER TABLE usuario ADD COLUMN tiempo_bloqueo DATETIME;

```

![alt text](Anexos/time.png)