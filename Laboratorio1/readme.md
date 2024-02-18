### Práctica número 1:

1. **No mostrar información sensible en etiquetas de desarrollo**:

- Es importante evitar mostrar mensajes que revelen información sensible, como si la contraseña es incorrecta o si el usuario no existe, en las etiquetas de desarrollo. Estos mensajes podrían ser pistas para atacantes sobre posibles debilidades en el sistema y facilitar ataques de fuerza bruta o intentos de intrusión.
2. **Código susceptible a tablas de arcoíris**:
    
    - Se identifica que el código puede ser vulnerable a ataques de inyección SQL, específicamente a ataques de "tablas de arcoíris". Esto implica que la manipulación maliciosa de datos de entrada podría permitir la manipulación de la base de datos, lo que puede llevar a una violación de la seguridad y pérdida de datos.
3. **Las peticiones de los formularios no deben ir por GET**:
    
    - Se menciona que las peticiones de los formularios están siendo realizadas utilizando el método GET. Dependiendo del contexto y la sensibilidad de los datos transmitidos, utilizar GET puede no ser la mejor práctica, ya que los datos enviados son visibles en la URL y pueden ser susceptibles a ataques de modificación y recopilación de información. Se recomienda evaluar si el uso de POST sería más apropiado para el escenario específico.