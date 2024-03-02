Enlace repositorio profesor: [enlace](https://github.com/joseucarvajal/2024_01_sgd_dllo_sftw/tree/main/tareas/corte-1)

### Mejora al codigo

- codificar la URL 
- encriptar la contraseña en la base de datos
- requisitos para crear una contraseña segura
   Al menos 8 caracteres de longitud.
   Al menos una mayúscula.
   Al menos una minúscula.
   Al menos un carácter especial.
- reCAPTCHA
- Número de intentos permitidos
-



Fecha de entrega: 7 de marzo
Modelo de calificacion: trabajo:35%, sustentacion: 65%;
Fecha de sustentacion: 15 de marzo.

Buscar una empresa y crear una aplicacion web que aplique los conocimientos
del modelo cliente-servidor.

Deben aplicar las buenas practicas de seguridad vistas en clase y evitar los problemas de codigo
inseguro vistos en clase.

Se deben crear al menos 3 formularios y se debe incluir un formulario de 'Registro de usuarios'.


# Aplicando la siguientes practicas en el laboratorio

1. **No mostrar información sensible en etiquetas de desarrollo**:
   
   - Es importante evitar mostrar mensajes que revelen información sensible, como si la contraseña es incorrecta o si el usuario no existe, en las etiquetas de desarrollo. Estos mensajes podrían ser pistas para atacantes sobre posibles debilidades en el sistema y facilitar ataques de fuerza bruta o intentos de intrusión.

2. **Código susceptible a inyección SQL**:
   
   - Se identifica que el código puede ser vulnerable a ataques de inyección SQL, específicamente a ataques de "tablas de arcoíris". Esto implica que la manipulación maliciosa de datos de entrada podría permitir la manipulación de la base de datos, lo que puede llevar a una violación de la seguridad y pérdida de datos.

3. **Las peticiones de los formularios no deben ir por GET**:
   
   - Se menciona que las peticiones de los formularios están siendo realizadas utilizando el método GET. Dependiendo del contexto y la sensibilidad de los datos transmitidos, utilizar GET puede no ser la mejor práctica, ya que los datos enviados son visibles en la URL y pueden ser susceptibles a ataques de modificación y recopilación de información. Se recomienda evaluar si el uso de POST sería más apropiado para el escenario específico.

4. **Base de datos en una DMZ con lista blanca de acceso solo para el servidor**:
   
   - La base de datos expuesta al exterior debe estar en una DMZ, con una lista blanca de acceso solo para el servidor. Esto ayuda a controlar y restringir quién puede acceder a la base de datos desde el exterior, reduciendo así la superficie de ataque.

5. **Deshabilitar usuarios o claves predeterminados del sistema**:
   
   - Es importante deshabilitar usuarios o claves predeterminados del sistema, como "admin" o "xammp", para evitar accesos no autorizados que podrían comprometer la seguridad del sistema.

6. **Crear usuarios con privilegios mínimos**:
   
   - Se deben crear usuarios con privilegios mínimos en lugar de utilizar los predefinidos por los sistemas. Asignar permisos de manera específica y restringida ayuda a limitar el impacto de posibles brechas de seguridad.

7. **Crear perfiles de acceso exclusivos para la base de datos**:
   
   - Se deben crear diferentes perfiles o usuarios que tengan accesos exclusivos a la base de datos, dependiendo del tipo de acceso necesario. Esto ayuda a controlar quién puede acceder a qué datos y con qué permisos.

8. **Evitar el almacenamiento de accesos en el código**:
   
   - Los accesos a bases de datos o repositorios sensibles no pueden estar quemados en el código. Es importante evitar almacenar credenciales o información de acceso directamente en el código fuente, ya que esto podría exponerlos a personas no autorizadas.

9. **Utilizar secret store para almacenar datos sensibles**:
   
   - Para almacenar datos sensibles de las aplicaciones, se debe utilizar un secret store, como Kubernetes o Vault. Estas herramientas proporcionan un entorno seguro para almacenar y gestionar credenciales y otros datos sensibles.

10. **Limpiar variables de memoria para evitar fugas de información**:
    
    - Las variables que están en memoria se deben limpiar para evitar que los sniffers o memory dumps puedan acceder a información sensible que se encuentre en ellas. Esto ayuda a proteger los datos mientras están en tránsito o en uso en la memoria del sistema.